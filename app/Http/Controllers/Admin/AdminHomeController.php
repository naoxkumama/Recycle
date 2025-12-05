<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class AdminHomeController extends Controller
{
    public function AdminHome()
    {
        return Inertia::render('Admin/AdminHome');
    }

    public function AdminNews()
    {
        return Inertia::render('Admin/AdminNewsList');
    }

    public function AdminNewsDetail($index)
    {
        return Inertia::render('Admin/AdminNewsDetail', ['index' => (int)$index]);
    }

    public function AdminNewsEdit()
    {
        return Inertia::render('Admin/AdminNewsEdit');
    }

    public function AdminBlogList()
    {
        return Inertia::render('Admin/AdminBlogList');
    }

    public function AdminBlogDetail($index)
    {
        return Inertia::render('Admin/AdminBlogDetail', ['index' => (int)$index]);
    }

    public function AdminBlogEdit()
    {
        return Inertia::render('Admin/AdminBlogEdit');
    }

    public function AdminContactHistory()
    {
        return Inertia::render('Admin/AdminContactHistory');
    }

    public function AdminReservationHistory()
    {
        return Inertia::render('Admin/AdminReservationHistory');
    }
}
