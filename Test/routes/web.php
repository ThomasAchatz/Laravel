<?php

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

use \Illuminate\Support\Facades;
use App\Book;

//das ist die default route - die startseite quasi
Route::get('/', 'BookController@index');

//das ist dann quasi die startseite
//aber sie zeigen auf die gleiche seite
Route::get('/books', 'BookController@index');
    //$books = DB::table('books')->get();


Route::get('books/{id}', 'BookController@show');
    //$book = DB::table('books')->find($id);

