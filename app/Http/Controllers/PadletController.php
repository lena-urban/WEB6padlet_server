<?php

namespace App\Http\Controllers;

use App\Models\Padlet;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PadletController extends Controller
{

    public function getAll() : JsonResponse {
        // alle Padlets mit Relationen
        $padlets = Padlet::with(['entries'])->get();
        return response()->json($padlets, 200);
    }

    public function findByID (string $id) : JsonResponse {
        $padlet = Padlet::where('id', $id)
            ->with(['entries', 'user'])->first();
        return $padlet != null ? response()->json($padlet, 200) : response()->json(null, 200);
    }

    public function checkID (string $id) : JsonResponse {
        $padlet = Padlet::where('id', $id)->first();
        return $padlet != null ? response()->json(true, 200) : response()->json(false, 200);
    }

    public function findBySearchTerm (string $searchTerm) : JsonResponse {
        $padlets = Padlet::with(['entries'])
            ->where('title', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('isPublic', 'LIKE', '%' . $searchTerm . '%')
            ->get();
        return response()->json($padlets, 200);

    }

    public function save(Request $request) : JsonResponse {

        $request = $this->parseRequest($request);
        DB::beginTransaction();

        try {
            $padlet = Padlet::create($request->all());

            if (isset($request['users']) && is_array($request['users'])) {
                foreach ($request['users'] as $user) {
                    $user = User::firstOrNew([
                        'firstName' => $user['firstName'],
                        'lastName' => $user['lastName']
                    ]);
                    $padlet->authors()->save($user);
                }

            }

            DB::commit();
            // return a vaild http response
            return response()->json($padlet, 200);
        }

        catch (\Exception $e) {
// rollback all queries
            DB::rollBack();
            return response()->json("saving padlet failed: " . $e->getMessage(), 420);
        }

    }


    private function parseRequest(Request $request) : Request {

        // convert date
        $date = new \DateTime($request->published);
        $request['published'] = $date;
        return $request;

    }

    public function update(Request $request, string $padlet_id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $padlet = Padlet::with(['user', 'entries'])
                ->where('id', $padlet_id)->first();
            if ($padlet != null) {
                $request = $this->parseRequest($request);
                $padlet->update($request->all());
                $padlet->save();

                DB::commit();
                $padlet1 = Padlet::with(['user', 'entries'])
                    ->where('id', $padlet_id)->first();
                // return a vaild http response
                return response()->json($padlet1, 201);
            }
            return response()->json("Padlet not found", 420);

        } catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("updating Padlet failed: " . $e->getMessage(), 420);
        }
    }

/*
    public function update(Request $request, string $padlet_id) : JsonResponse
    {
        DB::beginTransaction();
        try {
            $padlet = Padlet::with(['...'])
                ->where('id', $padlet_id)->first();
            if ($padlet != null) {
                $request = $this->parseRequest($request);
                $padlet->update($request->all());
                //delete all old images
                $padlet->title()->delete();

            }
            DB::commit();
            $book1 = Book::with(['authors', 'images', 'user'])
                ->where('isbn', $isbn)->first();
// return a vaild http response
            return response()->json($book1, 201);
        }
        catch (\Exception $e) {
// rollback all queries
            DB::rollBack();
            return response()->json("updating book failed: " . $e->getMessage(), 420);
        }
    }*/


    //isbn-id book-padlet
    public function delete(string $padlet_id) : JsonResponse {
        $padlet = Padlet::where('id', $padlet_id)->first();
        if ($padlet != null) {
            $padlet->delete();
            return response()->json('Padlet (' . $padlet_id . ') successfully deleted', 200);
        }
        else
            return response()->json('Padlet could not be deleted - it does not exist', 422);
    }
//grün datenbank name id
// lila wie in erster zeile padlet_id



    public function showPublicPadlets(): JsonResponse
    {
        $publicPadlets = Padlet::where('isPublic', 1)->with(['user', 'entries'])->get();
        return response()->json($publicPadlets, 200);
    }

    public function showPrivatePadlets(): JsonResponse
    {
        $publicPadlets = Padlet::where('isPublic', 0)->with(['user', 'entries'])->get();
        return response()->json($publicPadlets, 200);
    }
}

