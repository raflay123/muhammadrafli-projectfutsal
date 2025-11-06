<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    public function index()
    {
        $venues = Venue::all();
        return view('admin.venues.index', compact('venues'));
    }

    public function create()
    {
        return view('admin.venues.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'price_per_hour' => 'required|numeric|min:0',
            'open_time' => 'required',
            'close_time' => 'required',
        ]);

        Venue::create($validated);

        return redirect()->route('admin.venues.index')
            ->with('success', 'Lapangan berhasil ditambahkan.');
    }

    public function edit(Venue $venue)
    {
        return view('admin.venues.edit', compact('venue'));
    }

    public function update(Request $request, Venue $venue)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'price_per_hour' => 'required|numeric|min:0',
            'open_time' => 'required',
            'close_time' => 'required',
        ]);

        $venue->update($validated);

        return redirect()->route('admin.venues.index')
            ->with('success', 'Lapangan berhasil diperbarui.');
    }

    public function destroy(Venue $venue)
    {
        $venue->delete();
        return redirect()->route('admin.venues.index')
            ->with('success', 'Lapangan berhasil dihapus.');
    }
}