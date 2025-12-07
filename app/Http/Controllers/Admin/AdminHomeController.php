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

    public function AdminContactHistory()
    {
        return Inertia::render('Admin/AdminContactHistory');
    }

    public function AdminReservationHistory()
    {
        return Inertia::render('Admin/AdminReservationHistory');
    }
}
