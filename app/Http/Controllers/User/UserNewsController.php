<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\NewsPost;
use Inertia\Inertia;

class NewsController extends Controller
{
    public function index()
    {
        // 新しい順で取得
        $posts = NewsPost::orderBy('created_at', 'desc')->get();

        return Inertia::render('User/UserNewsList', [
            'posts' => $posts,
        ]);
    }

    public function show($id)
    {
        $post = NewsPost::findOrFail($id);

        return Inertia::render('User/UserNewsDetail', [
            'post' => $post,
        ]);
    }
}
