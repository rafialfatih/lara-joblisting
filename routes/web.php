<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/register', [UserController::class, "create"]);

Route::get("/", [ListingController::class, "index"]);
Route::get('/listing/create', [ListingController::class, "create"]);
Route::post('/listing', [ListingController::class, "store"]);
Route::get('/listing/edit/{listing}', [ListingController::class, "edit"]);
Route::get('/listing/{listing}', [ListingController::class, "show"]);
Route::put('/listing/{listing}', [ListingController::class, "update"]);
Route::delete('/listing/{listing}', [ListingController::class, "destroy"]);
