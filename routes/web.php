<?php

use Illuminate\Support\Facades\Route;

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

Route::view("/", "welcome")->name('welcome');

Route::get('/locale/{locale}', 'Common\Locale@set')->name('web.locale.set');

Route::patch('/notification/{notification}/mark', 'Common\Notification@mark')->name('web.notification.mark');
Route::get('/notification/{notification}/read', 'Common\Notification@read')->name('web.notification.read');
Route::delete('/notification/{notification}/delete', 'Common\Notification@delete')->name('web.notification.delete');
Route::patch('/notification/mark_all', 'Common\Notification@mark_all')->name('web.notification.mark_all');
Route::delete('/notification/delete_all', 'Common\Notification@delete_all')->name('web.notification.delete_all');

Route::redirect('/administrator', '/administrator/dashboard');
Route::middleware('authc.guest:web.administrator.dashboard,administrator')->group(function () {
    Route::middleware('common.locale:en')->group(function () {
        Route::get('/administrator/login', 'Auth\AdministratorController@login_show')->name('web.administrator.login_show');
    });
    Route::post('/administrator/login', 'Auth\AdministratorController@login_perfom')->name('web.administrator.login_perform');
});
Route::middleware(['authc.basic:welcome,administrator'])->group(function () {
    Route::middleware(['common.locale:en', 'common.visitor'])->group(function () {
        Route::get('/administrator/dashboard', 'User\Administrator\DashboardController@dashboard')->name('web.administrator.dashboard');
        Route::get('/administrator/profile', 'User\Administrator\DashboardController@profile')->name('web.administrator.profile');
        Route::get('/administrator/notification', 'User\Administrator\DashboardController@notification')->name('web.administrator.notification');
        Route::get('/administrator/offline', 'User\Administrator\DashboardController@offline')->name('web.administrator.offline');
        Route::get('/administrator/empty', 'User\Administrator\DashboardController@empty')->name('web.administrator.empty');
        Route::get('/administrator/logout', 'Auth\AdministratorController@logout_perfom')->name('web.administrator.logout_perfom');
        Route::get('/administrator/archive', 'User\Administrator\DashboardController@empty')->name('web.administrator.archive');
        Route::get('/administrator/about', 'User\Administrator\DashboardController@empty')->name('web.administrator.about');

        /** SECTION - User */
        Route::get('/administrator/users', 'User\Administrator\DashboardController@empty')->name('web.administrator.users');

        Route::get('/administrator/users/administrator', 'User\Administrator\UserController@administrator_list')->name('web.administrator.users.administrator.list');
        Route::get('/administrator/users/administrator/create', 'User\Administrator\UserController@administrator_create')->name('web.administrator.users.administrator.create');
        Route::get('/administrator/users/administrator/{administrator}/update', 'User\Administrator\UserController@administrator_update')->name('web.administrator.users.administrator.update');
        /** !SECTION - User */
    });

    Route::patch('/administrator/change_password', 'User\Administrator\DashboardController@change_password')->name('web.administrator.change_password');
    Route::patch('/administrator/change_profile', 'User\Administrator\DashboardController@change_profile')->name('web.administrator.change_profile');
});

Route::middleware(['authc.basic:welcome,administrator'])->group(function () {
    Route::post('/resource/administrator', 'Resource\AdministratorController@create')->name('web.resource.administrator.create');
    Route::patch('/resource/administrator/{administrator}', 'Resource\AdministratorController@update')->name('web.resource.administrator.update');
    Route::delete('/resource/administrator', 'Resource\AdministratorController@delete_any')->name('web.resource.administrator.delete_any');
    Route::delete('/resource/administrator/{administrator}', 'Resource\AdministratorController@delete')->name('web.resource.administrator.delete');
});
