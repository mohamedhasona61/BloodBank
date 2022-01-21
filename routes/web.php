<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GovernorateController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DonationRequestController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppSettingsController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Front\FrontController;



Route::group(['namespace'=>'Front'],function(){
    Route::get('home',[FrontController::class,'home']);
    Route::get('about',[FrontController::class,'about']);
});





Route::get('/', function () {
    return view('welcome');
});

// Auth::routes()
Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('governorate',GovernorateController::class);
Route::resource('cities',CitiesController::class);
Route::resource('categories',CategoryController::class);
Route::resource('posts',PostController::class);
Route::resource('role',RoleController::class);
Route::resource('user',UserController::class);

// contact us
Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts.index');
Route::delete('/contacts/{id}', [ContactsController::class, 'destroy'])->name('contacts.destroy');
// donation request resource
Route::get('/donation-requests', [DonationRequestController::class, 'index'])->name('donationRequest.index');
Route::get('/donation-requests/{id}', [DonationRequestController::class, 'show'])->name('donationRequest.show');
Route::delete('/donation-requests/{id}', [DonationRequestController::class, 'destroy'])->name('donationRequest.destroy');


// settings
Route::get('/settings', [AppSettingsController::class, 'index'])->name('appSettings.index');
Route::get('/settings/edit', [AppSettingsController::class, 'edit'])->name('appSettings.edit');
Route::put('/settings', [AppSettingsController::class, 'update'])->name('appSettings.update');

// Client
Route::get('/clients', [ClientController::class, 'index'])->name('client.index');
Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('client.destroy');