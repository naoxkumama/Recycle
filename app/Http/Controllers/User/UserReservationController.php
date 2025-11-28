<?php

namespace App\Http\Controllers\User;

use App\Models\Reservation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserReservationController extends Controller
{
    public function store(Request $request){
        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'first' => 'required|date',
            'second' => 'nullable|date',
            'third' => 'nullable|date',
        ]);

    // データ保存
        Reservation::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'first' => $request->first,
            'second' => $request->second,
            'third' => $request->third,
        ]);

        return redirect()->back()->with('success', '仮予約を受け付けました！');
    }
}
