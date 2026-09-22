<?php

namespace App\Http\Controllers;

use App\Models\fuel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\vehicle;

class FuelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (Auth::user()->role === 'driver') {

            $fuelLogs = fuel::with('vehicle')
                ->where('user_id', Auth::id())
                ->latest()->get();
        } else {
            // Admin/Transport Officer see all
            $fuelLogs = fuel::with('vehicle', 'user')->latest()->get();
        }

        return view('fuels.index', compact('fuelLogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // Drivers can only see their assigned vehicle
        if (Auth::user()->role === 'driver') {
            $vehicles = vehicle::whereHas('currentDriver', function ($q) {
                $q->where('user_id', Auth::id());
            })->get();
        } else {
            $vehicles = vehicle::all();
        }

        return view('fuels.create', compact('vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'date'  => 'required|date',
            'liters'     => 'required|numeric|min:0.1',
            'cost'       => 'nullable|numeric|min:0',
            'station'    => 'nullable|string|max:255',
            'receipt'    => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('receipt')) {
            $path = $request->file('receipt')->store('receipts', 'public');
        }
        // dd('path');
        fuel::create([
            'vehicle_id' => $request->vehicle_id,
            'user_id'    => Auth::id(),
            'date'  => $request->date,
            'liters'     => $request->liters,
            'cost'       => $request->cost,
            'station'    => $request->station,
            'receipt'      => $path,
        ]);

        return redirect()->route('fuels.index')
            ->with('success', 'Fuel log added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(fuel $fuel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(fuel $fuel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, fuel $fuel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(fuel $fuel)
    {
        //
    }
}
