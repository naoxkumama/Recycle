<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminReservationHistoryController;
use App\Http\Controllers\Admin\AdminContactHistoryController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\UserReservationController;
use App\Http\Controllers\User\UserContactController;

Route::prefix('admin')->group(function () {

    // Route::middleware('guest:admin')->group(function () {
        Route::get('AdminLogin', [AdminAuthController::class, 'AdminLogin'])->name('admin.login');
        Route::post('Login', [AdminAuthController::class, 'Login']);
    // });

    // Route::middleware('auth:admin')->group(function () {
        Route::get('AdminHome', [AdminHomeController::class, 'AdminHome'])->name('admin.home');
        Route::get('AdminNewsList', [AdminHomeController::class, 'AdminNewsList']);
        Route::get('AdminNewsDetail/{index}', [AdminHomeController::class, 'AdminNewsDetail']);
        Route::get('AdminNewsEdit', [AdminHomeController::class, 'AdminNewsEdit']);
        Route::get('AdminBlogList', [AdminHomeController::class, 'AdminBlogList']);
        Route::get('AdminBlogDetail/{index}', [AdminHomeController::class, 'AdminBlogDetail']);
        Route::get('AdminBlogEdit', [AdminHomeController::class, 'AdminBlogEdit']);
        Route::get('AdminReservationHistory', [AdminReservationHistoryController::class, 'History']);
        Route::get('AdminContactHistory', [AdminContactHistoryController::class, 'history']);
        Route::post('Logout', [AdminAuthController::class, 'Logout'])->name('admin.logout');
    // });
});

Route::prefix('admin')->group(function () {
    Route::get('/AdminReservation/History', [AdminReservationHistoryController::class, 'History']);

    Route::get('/AdminContact/History', [AdminContactHistoryController::class, 'History']);
});

Route::prefix('user')->group(function () {
    Route::get('home', [HomeController::class, 'home']);
    Route::get('UserNewsList', [HomeController::class, 'UserNewsList']);
    Route::get('UserNewsDetail/{index}', [HomeController::class, 'UserNewsDetail']);
    Route::get('UserBlogList', [HomeController::class, 'UserBlogList']);
    Route::get('UserBlogDetail/{index}', [HomeController::class, 'UserBlogDetail']);
    Route::get('UserDate', [HomeController::class, 'UserDate']);
    Route::get('UserFee', [HomeController::class, 'UserFee']);
    Route::get('UserReservation', [HomeController::class, 'UserReservation']);
    Route::get('UserContact', [HomeController::class, 'UserContact']);

    Route::get('UserReservationComplete', [HomeController::class, 'UserReservationComplete']);
    Route::get('UserContactComplete', [HomeController::class, 'UserContactComplete']);

    Route::post('/UserReservation', [UserReservationController::class, 'store']);
    Route::post('/UserContact', [UserContactController::class, 'store']);
});