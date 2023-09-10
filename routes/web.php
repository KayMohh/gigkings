<?php

use \App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/', function () {
//     return view('listings', [
//         'heading' => 'Latest listings'
//     ]);
// });




//All Listings
Route::get('/', [ListingController::class, 'index']);

//Show create form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');


//Store Listing Data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

//Edit listings
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit']);

//Edit Submit to Update Listings
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

//Delete
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

//Single Listings
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// sHOW REGISTER cEATE fORM
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

//Create New User
Route::post('/users', [UserController::class, 'store']);

//Logout 
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

//Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

//Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
