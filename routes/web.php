<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DataTablesController;
use App\Http\Controllers\PostController;

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


Route::get('customer', [CustomerController::class, 'index']);


Route::get('ajax-datatable-crud', [DataTablesController::class, 'index']);
Route::post('add-update-book', [DataTablesController::class, 'store']);
Route::post('edit-book', [DataTablesController::class, 'edit']);
Route::post('delete-book', [DataTablesController::class, 'destroy']);




Route::get('post', [PostController::class, 'index']);
Route::post('add-update-post', [PostController::class, 'store']);
Route::post('edit-post', [PostController::class, 'edit']);
Route::post('delete-post', [PostController::class, 'destroy']);
