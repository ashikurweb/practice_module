<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        // Dynamic pagination with default 10 per page
        $perPage = $request->get('per_page', 10);
        $users = $query->latest()->paginate($perPage)->withQueryString();
        
        return view('admin.users.index', compact('users'));
    }
}