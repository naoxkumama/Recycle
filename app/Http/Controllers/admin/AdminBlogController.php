<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;

class AdminBlogController extends Controller
{
    public function index()
    {
        return response()->json(BlogPost::orderBy('created_at', 'desc')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = BlogPost::create($request->only('title', 'content'));

        return response()->json($post, 201);
    }

    public function update(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $post->update($request->only('title', 'content'));
        return response()->json($post);
    }

    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);
        $post->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
