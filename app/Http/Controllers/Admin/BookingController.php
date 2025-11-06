<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'venue'])->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function confirm(Booking $booking)
    {
        $booking->update(['status' => 'confirmed']);
        return redirect()->back()->with('success', 'Booking confirmed.');
    }

    public function cancel(Booking $booking)
    {
        $booking->update(['status' => 'cancelled']);
        return redirect()->back()->with('success', 'Booking cancelled.');
    }

    public function complete(Booking $booking)
    {
        $booking->update(['status' => 'completed']);
        return redirect()->back()->with('success', 'Booking completed.');
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $booking->update($validated);

        return redirect()->back()->with('success', 'Booking status updated.');
    }
}