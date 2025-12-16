<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminReservationHistoryController;
use App\Http\Controllers\Admin\AdminContactHistoryController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\UserNewsController;
use App\Http\Controllers\User\UserBlogController;
use App\Http\Controllers\User\UserReservationController;
use App\Http\Controllers\User\UserContactController;

Route::get('/', function () { return redirect('/user/home');});

Route::prefix('admin')->group(function () {

    // Route::middleware('guest:admin')->group(function () {
        Route::get('AdminLogin', [AdminAuthController::class, 'AdminLogin'])->name('admin.login');
        Route::post('Login', [AdminAuthController::class, 'Login']);
    // });

    Route::middleware('auth:admin')->group(function () {
        Route::get('AdminHome', [AdminHomeController::class, 'AdminHome'])->name('admin.home');

        Route::get('AdminNewsList', [AdminNewsController::class, 'index']);         // 一覧ページへ遷移
        Route::get('AdminNewsList/{id}', [AdminNewsController::class, 'show']);     // 詳細ページへ遷移
        Route::post('AdminNewsListDelete/{id}', [AdminNewsController::class, 'destroy']); // 削除処理
        Route::get('AdminNewsEdit', [AdminNewsController::class, 'create']);        // 新規ページへ遷移
        Route::post('AdminNewsEditNew', [AdminNewsController::class, 'store']);        // 新規保存処理
        Route::get('AdminNewsEdit/{id}/edit', [AdminNewsController::class, 'edit']); // 編集ページへ遷移
        Route::post('AdminNewsEditUpdate/{id}', [AdminNewsController::class, 'update']);   // 更新処理

        Route::get('AdminBlogList', [AdminBlogController::class, 'index']);         // 一覧ページへ遷移
        Route::get('AdminBlogList/{id}', [AdminBlogController::class, 'show']);     // 詳細ページへ遷移
        Route::post('AdminBlogListDelete/{id}', [AdminBlogController::class, 'destroy']); // 削除処理
        Route::get('AdminBlogEdit', [AdminBlogController::class, 'create']);        // 新規ページへ遷移
        Route::post('AdminBlogEditNew', [AdminBlogController::class, 'store']);        // 新規保存処理
        Route::get('AdminBlogEdit/{id}/edit', [AdminBlogController::class, 'edit']); // 編集ページへ遷移
        Route::post('AdminBlogEditUpdate/{id}', [AdminBlogController::class, 'update']);   // 更新処理

        Route::get('AdminReservationHistory', [AdminReservationHistoryController::class, 'History']);
        Route::get('AdminContactHistory', [AdminContactHistoryController::class, 'history']);
        Route::post('Logout', [AdminAuthController::class, 'Logout'])->name('admin.logout');
    });
});

Route::prefix('user')->group(function () {
    Route::get('home', [HomeController::class, 'home']);
    Route::get('UserDate', [HomeController::class, 'UserDate']);
    Route::get('UserFee', [HomeController::class, 'UserFee']);
    Route::get('UserReservation', [HomeController::class, 'UserReservation']);
    Route::get('UserContact', [HomeController::class, 'UserContact']);

    Route::get('UserReservationComplete', [HomeController::class, 'UserReservationComplete']);
    Route::get('UserContactComplete', [HomeController::class, 'UserContactComplete']);

    Route::get('UserNewsList', [UserNewsController::class, 'index']);
    Route::get('UserNewsList/{id}', [UserNewsController::class, 'show']);

    Route::get('UserBlogList', [UserBlogController::class, 'index']);
    Route::get('UserBlogList/{id}', [UserBlogController::class, 'show']);

    Route::post('UserReservation', [UserReservationController::class, 'store']);
    Route::post('UserContact', [UserContactController::class, 'store']);
});