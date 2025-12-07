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
        return Inertia::render('admin/AdminNewsList', [
            'news' => $news->toArray()
        ]);
    }

    public function show(NewsPost $news)
    {
        return Inertia::render('admin/AdminNewsDetail', [
            'news' => $news,
        ]);
    }

    // 新規保存
    public function store(Request $request)
    {
        NewsPost::create($request->only('title','content'));

        return redirect()->route('admin.news.index')
            ->with('success', '追加しました！');
    }

    public function create()
    {
        return Inertia::render('admin/AdminNewsEdit');
    }

    // 更新
    public function update(NewsPost $news, Request $request)
    {
        $news->update($request->only('title','content'));

        return redirect()->route('admin.news.index')
            ->with('success', '更新しました！');
    }

    // 編集画面
    public function edit(NewsPost $news)
    {
        return Inertia::render('admin/AdminNewsEdit', [
            'news' => $news
        ]);
    }

    public function destroy(NewsPost $news)
    {
        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', '削除しました！');
    }
}
