<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use Inertia\Inertia;

class AdminBlogController extends Controller
{
     // 一覧
    public function index()
    {
        $blog = BlogPost::latest()->get();

        return Inertia::render('Admin/AdminBlogList', [
            'blog' => $blog,
        ]);
    }

    public function show($id)
    {
        $blog = BlogPost::findOrFail($id);

        return Inertia::render('Admin/AdminBlogDetail', [
            'blog' => $blog,
        ]);
    }

    // 新規作成画面
    public function create()
    {
        return Inertia::render('Admin/AdminBlogEdit');
    }

    // 新規保存
    public function store(Request $request)
    {
        BlogPost::create($request->only('title','content'));

        return redirect('/admin/AdminBlogList')
            ->with('success', '追加しました！');
    }

    // 編集画面
    public function edit($id)
    {
        $blog = BlogPost::findOrFail($id);

        return Inertia::render('Admin/AdminBlogEdit', [
            'blog' => $blog,
        ]);
    }

    // 更新
    public function update($id, Request $request)
    {
        $blog = BlogPost::findOrFail($id);
        $blog->update($request->only('title', 'content'));

        return redirect('/admin/AdminBlogList')
            ->with('success', '更新しました！');
    }

    public function destroy($id)
    {
        $blog = BlogPost::findOrFail($id);
        $blog->delete();

        return redirect('/admin/AdminBlogList')
            ->with('success', '削除しました！');
    }
}
