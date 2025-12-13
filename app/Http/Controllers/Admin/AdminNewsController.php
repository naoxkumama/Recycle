<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsPost;
use Inertia\Inertia;

class AdminNewsController extends Controller
{
     // 一覧
    public function index()
    {
        $news = NewsPost::latest()->get();

        return Inertia::render('Admin/AdminNewsList', [
            'news' => $news,
        ]);
    }

    public function show($id)
    {
        $news = NewsPost::findOrFail($id);

        return Inertia::render('Admin/AdminNewsDetail', [
            'news' => $news,
        ]);
    }

    // 新規作成画面
    public function create()
    {
        return Inertia::render('Admin/AdminNewsEdit');
    }

    // 新規保存
    public function store(Request $request)
    {
        NewsPost::create($request->only('title','content'));

        return redirect('/admin/AdminNewsList')
            ->with('success', '追加しました！');
    }

    // 編集画面
    public function edit($id)
    {
        $news = NewsPost::findOrFail($id);

        return Inertia::render('Admin/AdminNewsEdit', [
            'news' => $news,
        ]);
    }

    // 更新
    public function update($id, Request $request)
    {
        $news = NewsPost::findOrFail($id);
        $news->update($request->only('title', 'content'));

        return redirect('/admin/AdminNewsList')
            ->with('success', '更新しました！');
    }

    public function destroy($id)
    {
        $news = NewsPost::findOrFail($id);
        $news->delete();

        return redirect('/admin/AdminNewsList')
            ->with('success', '削除しました！');
    }
}
