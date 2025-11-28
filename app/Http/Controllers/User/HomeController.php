<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function home()
    {
        return Inertia::render('home');
    }

    public function UserDate()
    {
        return Inertia::render('UserDate');
    }

    public function UserFee()
    {
        return Inertia::render('UserFee');
    }

    public function UserNewsList()
    {
        return Inertia::render('UserNewsList');
    }

    public function UserNewsDetail($index)
    {
        return Inertia::render('UserNewsDetail');
    }

    public function UserBlogList()
    {
        return Inertia::render('UserBlogList');
    }

    public function UserBlogDetail($index)
    {
        return Inertia::render('UserBlogDetail', ['index' => (int)$index]);
    }

    public function UserReservation()
    {
        return Inertia::render('UserReservation');
    }

    public function UserReservationComplete()
    {
        return Inertia::render('UserReservationComplete');
    }

    public function UserContact()
    {
        return Inertia::render('UserContact');
    }

    public function UserContactComplete()
    {
        return Inertia::render('UserContactComplete');
    }
}
