<?php

use App\Http\Controllers\Api\V1\ProductController;
use \app\Http\Controllers\Api\V1\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


//Route::post('/auth/login', [\App\Http\Controllers\Api\V1\Auth\LoginController::class, 'login'])->name('auth.login');
//Route::delete('/auth/logout', [\App\Http\Controllers\Api\V1\Auth\LoginController::class, 'logout'])->name('auth.logout');
//Route::get('/auth/user', [\App\Http\Controllers\Api\V1\Auth\LoginController::class, 'user'])->name('auth.user');


Route::post('/login', [\App\Http\Controllers\Api\V1\Auth\LoginController::class, 'login'])->name('auth.login');


Route::apiResource('/products/{skip?}', \App\Http\Controllers\Api\V1\ProductController::class)->only([
    'index'
])->names('products');

Route::apiResource('/product', \App\Http\Controllers\Api\V1\ProductController::class)->only([
    'store', 'show', 'update', 'destroy'
])->names('product');


//Route::apiResource('/categories', \App\Http\Controllers\Api\V1\ProductCategoryController::class)->names('categories');

Route::apiResource('/categories/{skip?}', \App\Http\Controllers\Api\V1\ProductCategoryController::class)->only([
    'index'
])->names('categories');


Route::apiResource('/category', \App\Http\Controllers\Api\V1\ProductCategoryController::class)->only([
    'store', 'show', 'update', 'destroy'
])->names('category');


//Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/register', [\App\Http\Controllers\Api\V1\Auth\AuthController::class, 'register'])->name('auth.register');

Route::post('/auth/login', [\App\Http\Controllers\Api\V1\Auth\AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/me', function(Request $request) {
        return auth()->user();
    });

    Route::post('/auth/logout', [\App\Http\Controllers\Api\V1\Auth\AuthController::class, 'logout']);
});

