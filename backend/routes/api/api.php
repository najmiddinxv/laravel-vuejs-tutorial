<?php

// use App\Http\Controllers\Api\V1\AuthApiController;
// use App\Http\Controllers\Api\BaseApiController;
// use App\Http\Controllers\Api\V1\PostController;
// use App\Http\Controllers\Api\V1\UserController;
// use App\Http\Controllers\Api\VideoController;
// use App\Http\Controllers\Backend\TagController;
// use Illuminate\Support\Facades\Route;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::as('api')->name('api.')->middleware('addRequestHeader')->group(function () {
//     Route::controller(AuthApiController::class)->group(function () {
//         Route::post('register', 'register')->name('register');
//         Route::post('login', 'login')->name('login');
//         Route::post('logout', 'logout')->name('logout')->middleware('auth:sanctum');
//         Route::post('logout-all', 'logout_all_devices')->name('logout-all')->middleware('auth:sanctum');
//     });

//     Route::controller(BaseApiController::class)->group(function () {
//         Route::get('/', 'index')->name('index');
//     });

//     Route::apiResources([
//         'users' => UserController::class,
//         'posts' => PostController::class,
//     ]);

//     // Route::apiResource('users', UserController::class);
//     // Route::apiResource('posts', PostController::class);

//     // Route::apiResource('post',PostController::class);
//     // Route::controller(PostController::class)->name('post.')->group(function() {
//     //     Route::get('/posts', 'index')->name('index');
//     // });



// });
