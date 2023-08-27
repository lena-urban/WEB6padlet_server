<?php

use App\Http\Controllers\PadletController;
use App\Http\Controllers\EntryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/login', [AuthController::class,'login']);

Route::get('/', [PadletController::class,'getAll']);
Route::get('/padlets', [PadletController::class,'getAll']);
Route::get('/padlets/{id}', [PadletController::class,'findByID']);
Route::get('/padlets/checkid/{id}', [PadletController::class,'checkID']);
Route::get('/padlets/search/{searchTerm}', [PadletController::class,'findBySearchTerm']);

// methods which need authentication - JWT Token
/*Route::group(['middleware' => ['api','auth.jwt', 'auth.admin']], function(){
});*/

Route::post('padlets', [PadletController::class, 'save']);
Route::put('padlets/{id}', [PadletController::class, 'update']);
Route::delete('padlets/{id}', [PadletController::class, 'delete']);
Route::post('auth/logout', [AuthController::class,'logout']);

Route::get('publicPadlets', [PadletController::class, 'showPublicPadlets']);
Route::get('privatePadlets', [PadletController::class, 'showPrivatePadlets']);

// EntrieController
//Route::get('/', [EntryController::class,'index']);
Route::get('/padletEntries/{id}', [EntryController::class,'getAllEntries']);
Route::get('/entries/{id}', [EntryController::class,'findByID']);
Route::post('entries', [EntryController::class, 'save']);
Route::put('entries/{id}', [EntryController::class, 'update']);
Route::delete('entries/{id}', [EntryController::class, 'delete']);
