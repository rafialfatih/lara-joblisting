<?php

use App\Http\Controllers\Auth\AuthenticateUserController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Listing\ListingController;
use App\Http\Controllers\Listing\ManageListingController;
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

// User authentication routes
Route::middleware('guest')->group(function () {
  // User registration routes
  Route::controller(UserController::class)->group(function () {
    Route::get('/register', 'create');
    Route::post('/users', 'store');
  });

  // Authentication / Login routes
  Route::controller(AuthenticateUserController::class)->group(function () {
    Route::get('/login', 'create')->name('login');
    Route::post('/authenticate', 'store');
  });
});

// Authenticated routes
Route::middleware('auth')->group(function () {
  Route::get('/listing/manage', [ManageListingController::class, 'index']);

  // Listing management routes
  Route::controller(ListingController::class)->group(function () {
    Route::post('/listing', 'store');
    Route::get('/listing/edit/{listing}', 'edit');
    Route::put('/listing/{listing}', 'update');
    Route::delete('/listing/{listing}', 'destroy');
  });

  Route::post('/logout', [AuthenticateUserController::class, 'destroy']);
});

// Guests routes
Route::controller(ListingController::class)->group(function () {
  Route::get('/', 'index');
  Route::get('/listing/create', 'create');
  Route::get('/listing/{listing}', 'show');
});
