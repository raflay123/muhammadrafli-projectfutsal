<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Venue;

class DashboardController extends Controller
{
    // Konstruktor
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan sudah login

        // Cek role admin
        $this->middleware(function ($request, $next) {
            // Asumsi: Model User memiliki kolom 'role'
            if (auth()->user()->role !== 'admin') {
                abort(403, 'Unauthorized Access');
            }
            return $next($request);
        });
    }

    public function index()
    {
        // Statistik umum
        $stats = [
            'total_users' => User::count(),
            'total_venues' => Venue::count(),
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
        ];

        // Booking terbaru (5 terakhir)
        $recentBookings = Booking::with(['user', 'venue'])
            ->latest()
            ->take(5)
            ->get();

        // Booking mendatang (upcoming)
        $upcomingBookings = Booking::with(['venue'])
            ->whereDate('booking_date', '>=', Carbon::today())
            ->where(function($query) {
                $query->where('status', 'pending')
                      ->orWhere('status', 'confirmed'); // Tampilkan pending dan confirmed
            })
            ->orderBy('booking_date', 'asc')
            ->orderBy('start_time', 'asc')
            ->get();

        // Kirim semua data ke view
        // Pastikan view Anda ada di resources/views/admin/dashboard.blade.php
        return view('admin.dashboard', compact('stats', 'recentBookings', 'upcomingBookings'));
    }
}