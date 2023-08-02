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
Route::get('/template/{template}', 'Common\Template@set')->name('web.template.set');

Route::patch('/notification/{notification}/mark', 'Common\Notification@mark')->name('web.notification.mark');
Route::get('/notification/{notification}/read', 'Common\Notification@read')->name('web.notification.read');
Route::delete('/notification/{notification}/delete', 'Common\Notification@delete')->name('web.notification.delete');
Route::patch('/notification/mark_all', 'Common\Notification@mark_all')->name('web.notification.mark_all');
Route::delete('/notification/delete_all', 'Common\Notification@delete_all')->name('web.notification.delete_all');

Route::redirect('/administrator', '/administrator/dashboard');
Route::middleware('authc.guest:web.administrator.dashboard,administrator')->group(function () {
    Route::middleware('common.locale')->group(function () {
        Route::get('/administrator/login', 'Auth\AdministratorController@login_show')->name('web.administrator.login_show');
        Route::get('/administrator/register', 'Auth\AdministratorController@register_show')->name('web.administrator.register_show');
    });
    Route::post('/administrator/login', 'Auth\AdministratorController@login_perfom')->name('web.administrator.login_perform');
    Route::post('/administrator/register', 'Auth\AdministratorController@register_perfom')->name('web.administrator.register_perform');
});
Route::middleware(['authc.basic:welcome,administrator'])->group(function () {
    Route::get('/administrator/logout', 'Auth\AdministratorController@logout_perfom')->name('web.administrator.logout_perfom');
    Route::middleware(['common.locale', 'common.visitor'])->group(function () {
        Route::get('/administrator/dashboard', 'User\Administrator\DashboardController@dashboard')->name('web.administrator.dashboard');
        Route::get('/administrator/profile', 'User\Administrator\DashboardController@profile')->name('web.administrator.profile');
        Route::get('/administrator/notification', 'User\Administrator\DashboardController@notification')->name('web.administrator.notification');
        Route::get('/administrator/offline', 'User\Administrator\DashboardController@offline')->name('web.administrator.offline');
        Route::get('/administrator/empty', 'User\Administrator\DashboardController@empty')->name('web.administrator.empty');
        Route::get('/administrator/archive', 'User\Administrator\DashboardController@empty')->name('web.administrator.archive');
        Route::get('/administrator/about', 'User\Administrator\DashboardController@empty')->name('web.administrator.about');

        /** SECTION - User */
        Route::get('/administrator/users', 'User\Administrator\DashboardController@empty')->name('web.administrator.users');

        Route::get('/administrator/users/administrator', 'User\Administrator\AdministratorController@index')->name('web.administrator.users.administrator.index');
        Route::get('/administrator/users/administrator/create', 'User\Administrator\AdministratorController@create')->name('web.administrator.users.administrator.create');
        Route::get('/administrator/users/administrator/{administrator}/update', 'User\Administrator\AdministratorController@update')->name('web.administrator.users.administrator.update');

        Route::get('/administrator/users/midwife', 'User\Administrator\MidwifeController@index')->name('web.administrator.users.midwife.index');
        Route::get('/administrator/users/midwife/create', 'User\Administrator\MidwifeController@create')->name('web.administrator.users.midwife.create');
        Route::get('/administrator/users/midwife/{midwife}/update', 'User\Administrator\MidwifeController@update')->name('web.administrator.users.midwife.update');

        Route::get('/administrator/users/patient', 'User\Administrator\PatientController@index')->name('web.administrator.users.patient.index');
        Route::get('/administrator/users/patient/create', 'User\Administrator\PatientController@create')->name('web.administrator.users.patient.create');
        Route::get('/administrator/users/patient/{patient}/update', 'User\Administrator\PatientController@update')->name('web.administrator.users.patient.update');

        Route::get('/administrator/service', 'User\Administrator\AdministratorController@service_index')->name('web.administrator.service.index');
        Route::get('/administrator/service/create', 'User\Administrator\AdministratorController@service_create')->name('web.administrator.service.create');
        Route::get('/administrator/service/{service}/update', 'User\Administrator\AdministratorController@service_update')->name('web.administrator.service.update');

        Route::get('/administrator/schedule', 'User\Administrator\AdministratorController@schedule_index')->name('web.administrator.schedule.index');
        Route::get('/administrator/schedule/create', 'User\Administrator\AdministratorController@schedule_create')->name('web.administrator.schedule.create');
        Route::get('/administrator/schedule/{schedule}/update', 'User\Administrator\AdministratorController@schedule_update')->name('web.administrator.schedule.update');

        Route::get('/administrator/order', 'User\Administrator\AdministratorController@order_index')->name('web.administrator.order.index');
        Route::get('/administrator/order/create', 'User\Administrator\AdministratorController@order_create')->name('web.administrator.order.create');
        Route::get('/administrator/order/{order}/update', 'User\Administrator\AdministratorController@order_update')->name('web.administrator.order.update');
        /** !SECTION - User */
    });

    Route::patch('/administrator/change_password', 'User\Administrator\DashboardController@change_password')->name('web.administrator.change_password');
    Route::patch('/administrator/change_profile', 'User\Administrator\DashboardController@change_profile')->name('web.administrator.change_profile');
});

Route::redirect('/patient', '/patient/dashboard');
Route::middleware('authc.guest:web.patient.dashboard,patient')->group(function () {
    Route::middleware('common.locale')->group(function () {
        Route::get('/patient/login', 'Auth\PatientController@login_show')->name('web.patient.login_show');
        Route::get('/patient/register', 'Auth\PatientController@register_show')->name('web.patient.register_show');
    });
    Route::post('/patient/login', 'Auth\PatientController@login_perfom')->name('web.patient.login_perform');
    Route::post('/patient/register', 'Auth\PatientController@register_perfom')->name('web.patient.register_perform');
});
Route::middleware(['authc.basic:welcome,patient'])->group(function () {
    Route::get('/patient/logout', 'Auth\PatientController@logout_perfom')->name('web.patient.logout_perfom');
    Route::middleware(['common.locale', 'common.visitor'])->group(function () {
        Route::get('/patient/dashboard', 'User\Patient\DashboardController@dashboard')->name('web.patient.dashboard');
        Route::get('/patient/profile', 'User\Patient\DashboardController@profile')->name('web.patient.profile');
        Route::get('/patient/notification', 'User\Patient\DashboardController@notification')->name('web.patient.notification');
        Route::get('/patient/offline', 'User\Patient\DashboardController@offline')->name('web.patient.offline');
        Route::get('/patient/empty', 'User\Patient\DashboardController@empty')->name('web.patient.empty');
        Route::get('/patient/archive', 'User\Patient\DashboardController@empty')->name('web.patient.archive');
        Route::get('/patient/about', 'User\Patient\DashboardController@empty')->name('web.patient.about');
    });

    Route::patch('/patient/change_password', 'User\Patient\DashboardController@change_password')->name('web.patient.change_password');
    Route::patch('/patient/change_profile', 'User\Patient\DashboardController@change_profile')->name('web.patient.change_profile');
});

Route::redirect('/midwife', '/midwife/dashboard');
Route::middleware('authc.guest:web.midwife.dashboard,midwife')->group(function () {
    Route::middleware('common.locale')->group(function () {
        Route::get('/midwife/login', 'Auth\MidwifeController@login_show')->name('web.midwife.login_show');
        Route::get('/midwife/register', 'Auth\MidwifeController@register_show')->name('web.midwife.register_show');
    });
    Route::post('/midwife/login', 'Auth\MidwifeController@login_perfom')->name('web.midwife.login_perform');
    Route::post('/midwife/register', 'Auth\MidwifeController@register_perfom')->name('web.midwife.register_perform');
});
Route::middleware(['authc.basic:welcome,midwife'])->group(function () {
    Route::get('/midwife/logout', 'Auth\MidwifeController@logout_perfom')->name('web.midwife.logout_perfom');
    Route::middleware(['common.locale', 'common.visitor'])->group(function () {
        Route::get('/midwife/dashboard', 'User\Midwife\DashboardController@dashboard')->name('web.midwife.dashboard');
        Route::get('/midwife/profile', 'User\Midwife\DashboardController@profile')->name('web.midwife.profile');
        Route::get('/midwife/notification', 'User\Midwife\DashboardController@notification')->name('web.midwife.notification');
        Route::get('/midwife/offline', 'User\Midwife\DashboardController@offline')->name('web.midwife.offline');
        Route::get('/midwife/empty', 'User\Midwife\DashboardController@empty')->name('web.midwife.empty');
        Route::get('/midwife/archive', 'User\Midwife\DashboardController@empty')->name('web.midwife.archive');
        Route::get('/midwife/about', 'User\Midwife\DashboardController@empty')->name('web.midwife.about');
    });

    Route::patch('/midwife/change_password', 'User\Midwife\DashboardController@change_password')->name('web.midwife.change_password');
    Route::patch('/midwife/change_profile', 'User\Midwife\DashboardController@change_profile')->name('web.midwife.change_profile');
});

Route::middleware(['authc.basic:welcome,administrator'])->group(function () {
    Route::post('/resource/administrator', 'Resource\AdministratorController@create')->name('web.resource.administrator.create');
    Route::patch('/resource/administrator/{administrator}', 'Resource\AdministratorController@update')->name('web.resource.administrator.update');
    Route::delete('/resource/administrator', 'Resource\AdministratorController@delete_any')->name('web.resource.administrator.delete_any');
    Route::delete('/resource/administrator/{administrator}', 'Resource\AdministratorController@delete')->name('web.resource.administrator.delete');

    Route::post('/resource/midwife', 'Resource\MidwifeController@create')->name('web.resource.midwife.create');
    Route::patch('/resource/midwife/{midwife}', 'Resource\MidwifeController@update')->name('web.resource.midwife.update');
    Route::delete('/resource/midwife', 'Resource\MidwifeController@delete_any')->name('web.resource.midwife.delete_any');
    Route::delete('/resource/midwife/{midwife}', 'Resource\MidwifeController@delete')->name('web.resource.midwife.delete');

    Route::post('/resource/patient', 'Resource\PatientController@create')->name('web.resource.patient.create');
    Route::patch('/resource/patient/{patient}', 'Resource\PatientController@update')->name('web.resource.patient.update');
    Route::delete('/resource/patient', 'Resource\PatientController@delete_any')->name('web.resource.patient.delete_any');
    Route::delete('/resource/patient/{patient}', 'Resource\PatientController@delete')->name('web.resource.patient.delete');

    Route::post('/resource/service', 'Resource\ServiceController@create')->name('web.resource.service.create');
    Route::patch('/resource/service/{service}', 'Resource\ServiceController@update')->name('web.resource.service.update');
    Route::delete('/resource/service', 'Resource\ServiceController@delete_any')->name('web.resource.service.delete_any');
    Route::delete('/resource/service/{service}', 'Resource\ServiceController@delete')->name('web.resource.service.delete');

    Route::post('/resource/schedule', 'Resource\ServiceController@create')->name('web.resource.schedule.create');
    Route::patch('/resource/schedule/{schedule}', 'Resource\ServiceController@update')->name('web.resource.schedule.update');
    Route::delete('/resource/schedule', 'Resource\ServiceController@delete_any')->name('web.resource.schedule.delete_any');
    Route::delete('/resource/schedule/{schedule}', 'Resource\ServiceController@delete')->name('web.resource.schedule.delete');

    Route::post('/resource/order', 'Resource\ServiceController@create')->name('web.resource.order.create');
    Route::patch('/resource/order/{order}', 'Resource\ServiceController@update')->name('web.resource.order.update');
    Route::delete('/resource/order', 'Resource\ServiceController@delete_any')->name('web.resource.order.delete_any');
    Route::delete('/resource/order/{order}', 'Resource\ServiceController@delete')->name('web.resource.order.delete');
});
