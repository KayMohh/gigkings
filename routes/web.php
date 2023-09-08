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
Route::get('/listings/create', [ListingController::class, 'create']);


//Store Listing Data
Route::post('/listings', [ListingController::class, 'store']);

//Edit listings
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit']);

//Edit Submit to Update Listings
Route::put('/listings/{listing}', [ListingController::class, 'update']);

//Delete
Route::delete('/listings/{listing}', [ListingController::class, 'destroy']);

//Single Listings
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// sHOW REGISTER cEATE fORM
Route::get('/register', [UserController::class, 'create']);

//Create New User
Route::post('/users', [UserController::class, 'store']);

//Logout 
Route::post('/logout', [UserController::class, 'logout']);

//Show Login Form
Route::get('/login', [UserController::class, 'login']);
