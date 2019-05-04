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

//das ist die default route
Route::get('/', 'BookController@index');

//das ist dann  die startseite
Route::get('/books', 'BookController@index');
    //$books = DB::table('books')->get();


Route::get('books/{id}', 'BookController@show');
    //$book = DB::table('books')->find($id);

