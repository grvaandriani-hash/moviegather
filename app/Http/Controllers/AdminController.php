<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Search User
        $search = $request->search;

        // Statistik
        $totalUser = User::where('role', 'user')->count();
        $totalAdmin = User::where('role', 'admin')->count();
        $totalEvent = Event::count();
       $totalParticipant = \DB::table('participants')->count();

        // Daftar User
        $users = User::when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        return view('admin.dashboard', compact(
            'totalUser',
            'totalAdmin',
            'totalEvent',
            'totalParticipant',
            'users'
        ));
    }

    // Ubah Role User ↔ Admin
   public function changeRole(Request $request, User $user)
{
    // Tidak bisa mengubah akun sendiri
    if ($user->id == auth()->id()) {
        return back()->with('success', 'Kamu tidak bisa mengubah role akun sendiri.');
    }

    // Admin utama tidak bisa diubah
    if ($user->id == 1) {
        return back()->with('success', 'Admin Utama tidak dapat diubah.');
    }

    $user->update([
        'role' => $user->role == 'admin' ? 'user' : 'admin'
    ]);

    return back()->with('success', 'Role user berhasil diubah.');
}

    // Ban / Unban User
public function toggleBan(User $user)
{
    // Tidak bisa ban akun sendiri
    if ($user->id == auth()->id()) {
        return back()->with('success', 'Kamu tidak bisa memblokir akun sendiri.');
    }

    // Admin utama tidak bisa diban
    if ($user->id == 1) {
        return back()->with('success', 'Admin Utama tidak dapat diblokir.');
    }

    $user->update([
        'status' => $user->status == 'active'
            ? 'banned'
            : 'active'
    ]);

    return back()->with('success', 'Status user berhasil diperbarui.');
}
}