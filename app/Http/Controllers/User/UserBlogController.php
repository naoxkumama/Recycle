<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Inertia\Inertia;

class UserBlogController extends Controller
{
    public function index()
    {
        // 新しい順で取得
        $posts = BlogPost::orderBy('created_at', 'desc')->get();

        return Inertia::render('User/UserBlogList', [
            'posts' => $posts,
        ]);
    }

    public function show($id)
    {
        $posts = BlogPost::findOrFail($id);

        return Inertia::render('User/UserBlogDetail', [
            'posts' => $posts,
        ]);
    }
}
