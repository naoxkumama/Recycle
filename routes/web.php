<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\AdminReservationHistoryController;
use App\Http\Controllers\Admin\AdminContactHistoryController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\UserNewsController;
use App\Http\Controllers\User\UserReservationController;
use App\Http\Controllers\User\UserContactController;

Route::prefix('admin')->group(function () {

    // Route::middleware('guest:admin')->group(function () {
        Route::get('AdminLogin', [AdminAuthController::class, 'AdminLogin'])->name('admin.login');
        Route::post('Login', [AdminAuthController::class, 'Login']);
    // });

    // Route::middleware('auth:admin')->group(function () {
        Route::get('AdminHome', [AdminHomeController::class, 'AdminHome'])->name('admin.home');

        Route::get('/AdminNewsList', [AdminNewsController::class, 'index'])->name('admin.news.index');
        Route::get('/AdminNewsList/{news}', [AdminNewsController::class, 'show'])->name('admin.news.show'); // 詳細ページへ遷移
        Route::delete('/AdminNewsList/{news}', [AdminNewsController::class, 'destroy'])->name('admin.news.destroy');
        Route::get('/AdminNewsEdit', [AdminNewsController::class, 'create'])->name('admin.news.create'); // 新規ページへ遷移
        Route::post('/AdminNewsEdit', [AdminNewsController::class, 'store'])->name('admin.news.store');   // 保存処理
        Route::get('/AdminNewsEdit/{news}/edit', [AdminNewsController::class, 'edit'])->name('admin.news.edit'); // 編集ページへ遷移
        Route::put('/AdminNewsEdit/{news}', [AdminNewsController::class, 'update'])->name('admin.news.update');   // 更新処理

        Route::get('AdminBlogList', [AdminHomeController::class, 'AdminBlogList']);
        Route::get('AdminBlogDetail/{index}', [AdminHomeController::class, 'AdminBlogDetail']);
        Route::get('AdminBlogEdit', [AdminHomeController::class, 'AdminBlogEdit']);
        Route::get('AdminReservationHistory', [AdminReservationHistoryController::class, 'History']);
        Route::get('AdminContactHistory', [AdminContactHistoryController::class, 'history']);
        Route::post('Logout', [AdminAuthController::class, 'Logout'])->name('admin.logout');
    // });
});

Route::prefix('user')->group(function () {
    Route::get('home', [HomeController::class, 'home']);
    Route::get('UserBlogList', [HomeController::class, 'UserBlogList']);
    Route::get('UserBlogDetail/{index}', [HomeController::class, 'UserBlogDetail']);
    Route::get('UserDate', [HomeController::class, 'UserDate']);
    Route::get('UserFee', [HomeController::class, 'UserFee']);
    Route::get('UserReservation', [HomeController::class, 'UserReservation']);
    Route::get('UserContact', [HomeController::class, 'UserContact']);

    Route::get('UserReservationComplete', [HomeController::class, 'UserReservationComplete']);
    Route::get('UserContactComplete', [HomeController::class, 'UserContactComplete']);

    Route::get('news', [UserNewsController::class, 'index']);
    Route::get('news/{id}', [UserNewsController::class, 'show']);
    Route::post('/UserReservation', [UserReservationController::class, 'store']);
    Route::post('/UserContact', [UserContactController::class, 'store']);
});