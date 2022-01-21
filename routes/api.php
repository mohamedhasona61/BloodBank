<?php

use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::Group(['prefix' =>'v1'] ,function(){
    Route::get('governorates', [MainController::class, 'governorates']);
    Route::get('cities', [MainController::class, 'cities']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('resetpassword', [AuthController::class, 'resetpassword']);
    Route::post('forgetpassword', [AuthController::class, 'forgetpassword']);
    Route::get('/app-settings', [MainController::class, 'appSettings']);
    Route::get('/blood-types', [MainController::class, 'bloodTypes']);

    Route::group(['middleware'=>'auth:api'],function(){
        Route::get('posts', [MainController::class, 'posts']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/posts/favourites', [MainController::class, 'favouritePosts']);
        Route::post('/posts/favourites/', [MainController::class, 'addToFavourites']);
        Route::get('/post', [MainController::class, 'singlePost']);
        Route::post('profile', [AuthController::class, 'profile']);
        Route::post('/donation-request', [MainController::class, 'donationRequestCreate']);
        Route::get('/donation-request', [MainController::class, 'getAllDonationRequests']);
        Route::get('/donation-request/{id}', [MainController::class, 'getSingleDonationRequest']);
        Route::post('/contact-us', [MainController::class, 'contactUsMsg']);
        Route::get('/notifications', [MainController::class, 'getAllNotifications']);
        Route::put('/notification/{id}', [MainController::class, 'updateReadNotification']);
        Route::get('/notification-settings', [MainController::class, 'getNotificationSettings']);
        Route::put('/notification-settings', [MainController::class, 'updateNotificationSettings']);
    });



});


