<?php

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Api\V1\{
    CategoryController,
    NewsController,
    PageController,
    PostController,
    TagController,
};
use App\Http\Controllers\Api\V1\Auth\AuthApiJwtController;
use App\Http\Controllers\Api\V1\Auth\AuthApiSanctumController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//=============================sanctum uchun===========================
// {{localhost}}/api/v1/login
// Route::post('register', [AuthApiSanctumController::class, 'register'])->name('api.auth.register');
Route::post('login', [AuthApiSanctumController::class, 'login'])->name('api.auth.login');
Route::post('refresh', [AuthApiSanctumController::class, 'refresh'])->name('api.auth.refresh');
Route::post('logout', [AuthApiSanctumController::class, 'logout'])->name('api.auth.logout')->middleware('auth:sanctum');
Route::post('logout-from-all-devices', [AuthApiSanctumController::class,'logoutFromAllDevices'])->name('api.auth.logoutFromAllDevices')->middleware('auth:sanctum');

//tokenni keshlamoqchi bo'lsak shu usuldan foydalanamiz. cache.token middleware yozilgan
// Route::middleware(['auth:sanctum', 'cache.token'])->group(function () {
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
//=================================================================php
//=============================jwt uchun===========================
// {{localhost}}/api/v1/login
//// Route::post('register', [AuthApiJwtController::class, 'register'])->name('api.auth.register');
// Route::post('login', [AuthApiJwtController::class, 'login'])->name('api.auth.login');
// Route::post('refresh', [AuthApiJwtController::class, 'refresh'])->name('api.auth.refresh');
// Route::post('logout', [AuthApiJwtController::class, 'logout'])->name('api.auth.logout')->middleware('auth:api');
// Route::get('me', [AuthApiJwtController::class, 'me'])->name('api.auth.me')->middleware('auth:api');
//=================================================================


Route::as('api')->name('api.')->middleware(['addRequestHeader'])->group(function () {

    Route::controller(BaseApiController::class)->group(function () {
        Route::get('/', 'baseApiIndex')->name('baseApiIndex')->middleware('role:admin|manager'); //spatie permission ishlayapti
    });

    Route::get('tags/edit/{id}',[TagController::class, 'edit'])->name('tags.edit');

    Route::apiResources([
        'posts' => PostController::class,
        'news' => NewsController::class,
        'pages' => PageController::class,
        'categories' => CategoryController::class,
        'tags' => TagController::class,
    ]);

});



