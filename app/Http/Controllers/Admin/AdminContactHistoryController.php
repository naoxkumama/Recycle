<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Inertia\Inertia;
use Illuminate\Http\Request;

class AdminContactHistoryController extends Controller
{
    public function index()
    {
        Contact::where('is_read', false)->update([
            'is_read' => true
        ]);

        $contacts = Contact::orderBy('created_at', 'desc')->get();

        return Inertia::render('Admin/AdminContactHistory', [
            'contacts' => $contacts
        ]);
    }
    public function History(Request $request)
    {
        $field = $request->input('sort_field', 'created_at');
        $order = $request->input('sort_order', 'desc');

        $query = Contact::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('message')) {
            $query->where('message', 'like', '%' . $request->message . '%');
        }

        if ($request->filled('created_from') && $request->filled('created_to')) {
            $query->whereBetween('created_at', [$request->created_from, $request->created_to]);
        } elseif ($request->filled('created_from')) {
            $query->whereDate('created_at', '>=', $request->created_from);
        } elseif ($request->filled('created_to')) {
            $query->whereDate('created_at', '<=', $request->created_to);
        }

        $contacts = $query
            ->orderBy($field, $order)
            ->paginate(10)
            ->withQueryString()
            ->through(fn($item) => $item);

        return Inertia::render('Admin/AdminContactHistory', [
            'contacts' => $contacts,
            'filters' =>
                $request -> only(['name', 'phone', 'email', 'message', 'created_from', 'created_to']),
        ]);
    }
}