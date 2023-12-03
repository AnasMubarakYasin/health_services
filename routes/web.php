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

if (env('APP_ENV') == 'local') {
    Route::view("/", "welcome")->name('welcome');
    Route::get("/landing", "User\Patient\LandingController@index")->name('web.patient.landing');
} else {
    Route::view("/entry", "welcome")->name('entry');
    Route::get("/welcome", fn () => to_route('web.patient.landing'))->name('welcome');
    Route::get("/", "User\Patient\LandingController@index")->name('web.patient.landing');
    Route::get("/service/{service}", "User\Patient\LandingController@service")->name('web.patient.landing.service');
}

Route::middleware(['authc.basic.order:web.patient.login_show,patient'])->group(function () {
    Route::middleware(['common.locale', 'common.visitor'])->group(function () {
        Route::get('/patient/order/{midwife}/midwife', 'User\Patient\OrderController@web_order_midwife')->name('web.patient.order.midwife');
    });
    Route::post('/order/{midwife}', 'User\Patient\LandingController@api_order')->name('web.patient.landing.api_order');
    Route::post('/patient/order/{midwife}/midwife', 'User\Patient\OrderController@api_order_midwife')->name('web.patient.order.midwife.handle');

    Route::post('/patient/order/confirm/done/{order}', 'User\Patient\LandingController@order_confirm_yes')->name('web.patient.order.confirm.yes');
});

Route::get('/locale/{locale}', 'Common\Locale@set')->name('web.locale.set');
Route::get('/template/{template}', 'Common\Template@set')->name('web.template.set');

Route::middleware(['authc.basic:welcome,administrator,midwife,patient'])->group(function () {
    Route::patch('/notification/{notification}/mark', 'Common\Notification@mark')->name('web.notification.mark');
    Route::get('/notification/{notification}/read', 'Common\Notification@read')->name('web.notification.read');
    Route::delete('/notification/{notification}/delete', 'Common\Notification@delete')->name('web.notification.delete');
    Route::patch('/notification/mark_all', 'Common\Notification@mark_all')->name('web.notification.mark_all');
    Route::delete('/notification/delete_all', 'Common\Notification@delete_all')->name('web.notification.delete_all');
});

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
        Route::get('/administrator/database', 'User\Administrator\DashboardController@database')->name('web.administrator.database');
        Route::get('/administrator/database/download', 'User\Administrator\DashboardController@database_download')->name('web.administrator.database.download');
        Route::get('/administrator/folder', 'User\Administrator\DashboardController@folder')->name('web.administrator.folder');
        Route::get('/administrator/folder/download', 'User\Administrator\DashboardController@folder_download')->name('web.administrator.folder.download');
        Route::get('/administrator/command', 'User\Administrator\DashboardController@command')->name('web.administrator.command');
        Route::get('/administrator/orders_limit_set', 'User\Administrator\DashboardController@orders_limit_set')->name('web.administrator.orders_limit_set');
        Route::get('/administrator/location_set', 'User\Administrator\DashboardController@location_set')->name('web.administrator.location_set');

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

        Route::get('/administrator/service', 'User\Administrator\ServiceController@index')->name('web.administrator.service.index');
        Route::get('/administrator/service/create', 'User\Administrator\ServiceController@create')->name('web.administrator.service.create');
        Route::get('/administrator/service/{service}/update', 'User\Administrator\ServiceController@update')->name('web.administrator.service.update');

        Route::get('/administrator/schedule', 'User\Administrator\ScheduleController@index')->name('web.administrator.schedule.index');
        Route::get('/administrator/schedule/create', 'User\Administrator\ScheduleController@create')->name('web.administrator.schedule.create');
        Route::get('/administrator/schedule/{schedule}/update', 'User\Administrator\ScheduleController@update')->name('web.administrator.schedule.update');

        Route::get('/administrator/order', 'User\Administrator\OrderController@index')->name('web.administrator.order.index');
        Route::get('/administrator/order/create', 'User\Administrator\OrderController@create')->name('web.administrator.order.create');
        Route::get('/administrator/order/{order}/update', 'User\Administrator\OrderController@update')->name('web.administrator.order.update');
        /** !SECTION - User */
    });

    Route::post('/administrator/database/upload', 'User\Administrator\DashboardController@database_upload')->name('web.administrator.database.upload');
    Route::post('/administrator/folder/upload', 'User\Administrator\DashboardController@folder_upload')->name('web.administrator.folder.upload');
    Route::post('/administrator/command', 'User\Administrator\DashboardController@command')->name('web.administrator.command');
    Route::get('/administrator/command/async', 'User\Administrator\DashboardController@command_async')->name('web.administrator.command.async');

    Route::patch('/administrator/change_profile', 'User\Administrator\DashboardController@change_profile')->name('web.administrator.change_profile');
    Route::patch('/administrator/change_password', 'User\Administrator\DashboardController@change_password')->name('web.administrator.change_password');

    Route::patch('/administrator/orders_limit_set_handle', 'User\Administrator\DashboardController@orders_limit_set_handle')->name('web.administrator.orders_limit_set_handle');
    Route::patch('/administrator/location_set_handle', 'User\Administrator\DashboardController@location_set_handle')->name('web.administrator.location_set_handle');
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
Route::middleware(['authc.basic:web.patient.login_show,patient'])->group(function () {
    Route::get('/patient/logout', 'Auth\PatientController@logout_perfom')->name('web.patient.logout_perfom');
    Route::middleware(['common.locale', 'common.visitor'])->group(function () {
        Route::get('/patient/dashboard', 'User\Patient\DashboardController@dashboard')->name('web.patient.dashboard');
        Route::get('/patient/history', 'User\Patient\DashboardController@history')->name('web.patient.history');
        Route::get('/patient/history/{order}', 'User\Patient\DashboardController@history_detail')->name('web.patient.history.detail');
        Route::get('/patient/profile', 'User\Patient\DashboardController@profile')->name('web.patient.profile');
        Route::get('/patient/notification', 'User\Patient\DashboardController@notification')->name('web.patient.notification');
        Route::get('/patient/settings', 'User\Patient\DashboardController@settings')->name('web.patient.settings');
        Route::get('/patient/offline', 'User\Patient\DashboardController@offline')->name('web.patient.offline');
        Route::get('/patient/empty', 'User\Patient\DashboardController@empty')->name('web.patient.empty');
        Route::get('/patient/archive', 'User\Patient\DashboardController@empty')->name('web.patient.archive');
        Route::get('/patient/about', 'User\Patient\DashboardController@empty')->name('web.patient.about');

        Route::get('/order/{midwife}', 'User\Patient\LandingController@order')->name('web.patient.landing.order');
        Route::get('/order', 'User\Patient\LandingController@order_common')->name('web.patient.landing.order_common');
        Route::get('/map_select', 'User\Patient\LandingController@map_select')->name('web.patient.landing.map_select');
        Route::get('/map_navigation/{coord}', 'User\Patient\LandingController@map_navigation')->name('web.patient.landing.map_navigation');
        Route::get('/history', 'User\Patient\LandingController@history')->name('web.patient.landing.history');
        Route::get('/profile', 'User\Patient\LandingController@profile')->name('web.patient.landing.profile');
        Route::get('/notification', 'User\Patient\LandingController@notification')->name('web.patient.landing.notification');

        Route::get('/patient/order', 'User\Patient\OrderController@web_order')->name('web.patient.order');
    });

    Route::patch('/patient/change_profile', 'User\Patient\DashboardController@change_profile')->name('web.patient.change_profile');
    Route::patch('/patient/change_password', 'User\Patient\DashboardController@change_password')->name('web.patient.change_password');

    Route::post('/patient/order', 'User\Patient\OrderController@api_order')->name('web.patient.order.handle');
    Route::post('/patient/order_common', 'User\Patient\LandingController@api_order_common')->name('web.patient.order_common.handle');
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
        Route::get('/midwife/history', 'User\Midwife\DashboardController@history')->name('web.midwife.history');
        Route::get('/midwife/history/{order}', 'User\Midwife\DashboardController@history_detail')->name('web.midwife.history.detail');
        Route::get('/midwife/profile', 'User\Midwife\DashboardController@profile')->name('web.midwife.profile');
        Route::get('/midwife/notification', 'User\Midwife\DashboardController@notification')->name('web.midwife.notification');
        Route::get('/midwife/settings', 'User\Midwife\DashboardController@settings')->name('web.midwife.settings');
        Route::get('/midwife/offline', 'User\Midwife\DashboardController@offline')->name('web.midwife.offline');
        Route::get('/midwife/empty', 'User\Midwife\DashboardController@empty')->name('web.midwife.empty');
        Route::get('/midwife/archive', 'User\Midwife\DashboardController@empty')->name('web.midwife.archive');
        Route::get('/midwife/about', 'User\Midwife\DashboardController@empty')->name('web.midwife.about');

        Route::get('/midwife/schedule/create', 'User\Midwife\ScheduleController@web_create')->name('web.midwife.schedule.create');
        Route::get('/midwife/schedule/{schedule}', 'User\Midwife\ScheduleController@web_update')->name('web.midwife.schedule.update');

        Route::get('/midwife/record/{order}/edit', 'User\Midwife\RecordController@edit')->name('web.midwife.record.edit');
        Route::get('/midwife/record/{order}/report', 'User\Midwife\RecordController@add_report')->name('web.midwife.record.report.add');
        Route::get('/midwife/record/{order}/report/{report}', 'User\Midwife\RecordController@edit_report')->name('web.midwife.record.report.edit');

        Route::get('/midwife/map_navigation/{coord}', 'User\Midwife\DashboardController@map_navigation')->name('web.midwife.map_navigation');
        Route::get('/midwife/orders_limit_set', 'User\Midwife\DashboardController@orders_limit_set')->name('web.midwife.orders_limit_set');
    });

    Route::patch('/midwife/change_profile', 'User\Midwife\DashboardController@change_profile')->name('web.midwife.change_profile');
    Route::patch('/midwife/change_password', 'User\Midwife\DashboardController@change_password')->name('web.midwife.change_password');

    Route::post('/midwife/schedule', 'User\Midwife\ScheduleController@api_create')->name('web.midwife.schedule.handle.create');
    Route::patch('/midwife/schedule/{schedule}', 'User\Midwife\ScheduleController@api_update')->name('web.midwife.schedule.handle.update');
    Route::delete('/midwife/schedule/{schedule}', 'User\Midwife\ScheduleController@api_delete')->name('web.midwife.schedule.handle.delete');

    Route::patch('/patient/order/{order}/done', 'User\Midwife\OrderController@api_done')->name('web.midwife.order.done');

    Route::post('/midwife/record/{order}', 'User\Midwife\RecordController@create')->name('web.midwife.record.create');
    Route::patch('/midwife/record/{order}', 'User\Midwife\RecordController@update')->name('web.midwife.record.update');
    Route::post('/midwife/record/{order}/report', 'User\Midwife\RecordController@create_report')->name('web.midwife.record.report.create');
    Route::patch('/midwife/record/{order}/report/{report}', 'User\Midwife\RecordController@update_report')->name('web.midwife.record.report.update');
    Route::delete('/midwife/record/{order}/report/{report}', 'User\Midwife\RecordController@delete_report')->name('web.midwife.record.report.delete');

    Route::patch('/midwife/orders_limit_set_handle', 'User\Midwife\DashboardController@orders_limit_set_handle')->name('web.midwife.orders_limit_set_handle');
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

    Route::post('/resource/schedule', 'Resource\ScheduleController@create')->name('web.resource.schedule.create');
    Route::patch('/resource/schedule/{schedule}', 'Resource\ScheduleController@update')->name('web.resource.schedule.update');
    Route::delete('/resource/schedule', 'Resource\ScheduleController@delete_any')->name('web.resource.schedule.delete_any');
    Route::delete('/resource/schedule/{schedule}', 'Resource\ScheduleController@delete')->name('web.resource.schedule.delete');

    Route::post('/resource/order', 'Resource\OrderController@create')->name('web.resource.order.create');
    Route::patch('/resource/order/{order}', 'Resource\OrderController@update')->name('web.resource.order.update');
    Route::delete('/resource/order', 'Resource\OrderController@delete_any')->name('web.resource.order.delete_any');
    Route::delete('/resource/order/{order}', 'Resource\OrderController@delete')->name('web.resource.order.delete');
});
