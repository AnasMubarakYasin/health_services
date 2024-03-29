<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/webpush/public_key', 'Common\WebPushController@public_key')->name('api.webpush.public_key');
    Route::post('/webpush/subscribe', 'Common\WebPushController@subscribe')->name('api.webpush.subscribe');
    Route::delete('/webpush/unsubscribe', 'Common\WebPushController@unsubscribe')->name('api.webpush.unsubscribe');
    Route::get('/webpush/subscribed', 'Common\WebPushController@subscribed')->name('api.webpush.subscribed');
});
