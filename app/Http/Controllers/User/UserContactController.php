<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;

class UserContactController extends Controller
{
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email'   => 'required|email',
            'message' => 'required|string',
        ]);

        // DBに保存（Contactモデルが必要）
        Contact::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        // 成功レスポンスを返す
        return redirect()->back()->with('success', 'お問い合わせを受け付けました！');
    }
}
