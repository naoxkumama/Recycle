<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    public function AdminLogin()
    {
        return inertia('Admin/AdminLogin');
    }

    public function Login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            // 🔴 ここが超重要：422 を返す
            throw ValidationException::withMessages([
                'message' => 'メールアドレスまたはパスワードが正しくありません。',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended('/admin/AdminHome');
    }
}
