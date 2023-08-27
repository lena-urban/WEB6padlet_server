<?php

namespace App\Http\Controllers;

use App\Models\Padlet;
use App\Models\Entry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class EntryController extends Controller
{
    public function getAllEntries(int $padlet_id): JsonResponse
    {
        $entries = Entry::where('padlet_id', $padlet_id)->with(['user'])->get();
        return response()->json($entries, 200);
    }

    public function delete(string $entrie_id) : JsonResponse {
        $entrie = Entry::where('id', $entrie_id)->first();
        if ($entrie != null) {
            $entrie->delete();
            return response()->json('Entrie (' . $entrie_id . ') successfully deleted', 200);
        }
        else
            return response()->json('Entrie could not be deleted - it does not exist', 422);
    }

    public function findByID (string $id) : JsonResponse {
        $entrie = Entry::where('id', $id)
            ->with(['user'])->first();
        return $entrie != null ? response()->json($entrie, 200) : response()->json(null, 200);
    }

    public function save(Request $request) : JsonResponse {

        $request = $this->parseRequest($request);
        DB::beginTransaction();

        try {
            $entrie = Entry::create($request->all());

            if (isset($request['users']) && is_array($request['users'])) {
                foreach ($request['users'] as $user) {
                    $user = User::firstOrNew([
                        'firstName' => $user['firstName'],
                        'lastName' => $user['lastName']
                    ]);
                    $entrie->authors()->save($user);
                }

            }

            DB::commit();
            // return a vaild http response
            return response()->json($entrie, 200);
        }

        catch (\Exception $e) {
// rollback all queries
            DB::rollBack();
            return response()->json("saving entrie failed: " . $e->getMessage(), 420);
        }

    }

    public function update(Request $request, string $entrie_id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $entrie = Entry::with(['user'])
                ->where('id', $entrie_id)->first();
            if ($entrie != null) {
                $request = $this->parseRequest($request);
                $entrie->update($request->all());
                $entrie->save();

                DB::commit();
                $entrie1 = Padlet::with(['user'])
                    ->where('id', $entrie_id)->first();
                // return a vaild http response
                return response()->json($entrie1, 201);
            }
            return response()->json("Entrie not found", 420);

        } catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("updating Entrie failed: " . $e->getMessage(), 420);
        }
    }

    private function parseRequest(Request $request) : Request {

        // convert date
        $date = new \DateTime($request->published);
        $request['published'] = $date;
        return $request;

    }
}
