<?php

use Illuminate\Support\Facades\Route;
/*
 * Routes definieren vereinfacht gesagt, welche URL im Browser auf
 * welche View gemappt werden soll. Routen im File web.php werden dazu benutzt um alle
 * Routen zu definieren, die in der View dann zur Verfügung stehen.
 */
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
 * Der Code sagt, wenn wir die Homeseite aufrufen (“/), dann soll die welcome View angezeigt
 * werden. Diese Route reagiert auf Anfragen, die mittels dem HTTP Verb GET gesendet
 * werden. Views sind im Folder resources/views zu finden. Dort gibt es ein File
 * welcome.blade.php - Blade ist dabei die Template Engine von Laravel.
///////////
Route::get('/entrys', function () {
    $books = DB::table('entrys')->get();
    // dd($entrys);
    return view('entrys.index', compact('entrys'));
});
///////////
Route::get('/', function () {
    $entries = DB::table('entries')->get();
    //dd($entries);
    return view('welcome', compact('entries'));
});
//////////
Route::get('/entries/{id}', function ($id) {
    $entry = DB::table('entries')->find($id);
    //return view('entries.show', compact('entry'));
});*//////
/*
 * oder andere Schreibweise für genau 1 Element
 * Route::get('/', function () {
 *  return view('welcome')->with('name','World');
 * });
 *
 * mit Variablen:
 * Route::get('/', function () {
 *  $name = "Hannes";
 *  return view('welcome',[
 *      'name' => $name
 *  ]);
 * });
 *
 * Wenn Key und Name der Variable gleich sind, gibt es auch noch eine praktische
 * Kurzschreibweise:
 * Route::get('/', function () {
 *  $name = "Hannes";
 *  return view('welcome',compact('name'));
 * });
 *
 * Auch Arrays (oder Objekte) können natürlich übergeben werden:
 * Route::get('/', function () {
 *  $books = [
 *      'Herr der Ringe',
 *      'Harry Potter',
 *      'Laravel Einführung'
 *  ];
 *  return view('welcome',compact('books'));
 * });
 * -->  Hier muss man allerdings nun in der View aufpassen, da diese Werte nicht so einfach
 *      angezeigt werden können. Wir müssen eine Schleife in der View bauen. (welcome.blade.php)
 */
