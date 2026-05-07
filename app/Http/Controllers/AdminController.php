<?php

namespace App\Http\Controllers;

use App\Models\{Car, User, Tag};

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalCars'  => Car::count(),
            'totalUsers' => User::count(),
            'totalTags'  => Tag::count(),
            'recentCars' => Car::with('user')->latest()->take(8)->get(),
            'users'      => User::withCount('cars')->orderBy('name')->get(),
        ]);
    }

    public function users()
    {
        $users = User::withCount('cars')->orderBy('name')->paginate(20);
        return view('admin.users', compact('users'));
    }

    public function destroyUser(User $user)
    {
        if ($user->is_admin) {
            return back()->with('error', 'No pots eliminar un administrador.');
        }
        $user->delete();
        return back()->with('success', 'Usuari eliminat.');
    }
}
