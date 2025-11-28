<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Inertia\Inertia;
use Illuminate\Http\Request;

class AdminReservationHistoryController extends Controller
{
    public function History(Request $request)
    {
        $field = $request->input('sort_field', 'created_at');
        $order = $request->input('sort_order', 'desc');

        $query = Reservation::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        if ($request->filled('first_from') && $request->filled('first_to')) {
            $query->whereBetween('first', [$request->first_from, $request->first_to]);
        } elseif ($request->filled('first_from')) {
            $query->whereDate('first', '>=', $request->first_from);
        } elseif ($request->filled('first_to')) {
            $query->whereDate('first', '<=', $request->first_to);
        }

        if ($request->filled('created_from') && $request->filled('created_to')) {
            $query->whereBetween('created_at', [$request->created_from, $request->created_to]);
        } elseif ($request->filled('created_from')) {
            $query->whereDate('created_at', '>=', $request->created_from);
        } elseif ($request->filled('created_to')) {
            $query->whereDate('created_at', '<=', $request->created_to);
        }

        $reservations = $query
            ->orderBy($field, $order)
            ->paginate(10)
            ->withQueryString()
            ->through(fn($item) => $item);

        return Inertia::render('Admin/AdminReservationHistory', [
            'reservations' => $reservations,
            'filters' =>
                $request -> only(['name', 'phone', 'first_from', 'first_to', 'created_from', 'created_to']),
        ]);
    }
}