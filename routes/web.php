<?php

use Illuminate\Support\Facades\Route;
use League\Csv\Reader;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/download-csv', function () {
    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename="demo.csv"');

    $reader = Reader::createFromPath(storage_path("app/public/demo.csv"));
    $reader->output();
    die;
});
