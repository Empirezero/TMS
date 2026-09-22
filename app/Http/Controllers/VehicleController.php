<?php

namespace App\Http\Controllers;

use App\Models\vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $vehicles = Vehicle::with('currentDriver')->paginate(10);
        return view('vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'plate_number' => 'required|unique:vehicles,plate_number',
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'nullable|integer',
            'passengers' => 'required|string|max:255',
        ]);

        Vehicle::create($validated);

        return redirect()->route('vehicles.index')
            ->with('success', 'Vehicle registered successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(vehicle $vehicle)
    {

        $vehicle->load([
            'assignments.user',
            'fuelLogs.user',
            'serviceLogs.user',
        ]);
        $totalFuelCost = $vehicle->fuelLogs()->sum('cost');
        $totalServiceCost = $vehicle->serviceLogs()->sum('total_amount');
        $totalLiters = $vehicle->fuelLogs()->sum('liters');

        return view('vehicles.show', compact('vehicle', 'totalFuelCost', 'totalServiceCost', 'totalLiters'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(vehicle $vehicle)
    {
        //
    }

    public function toggleStatus(Vehicle $vehicle)
    {
        $vehicle->update([
            'status' => $vehicle->status === 'active' ? 'inactive' : 'active',
        ]);

        return redirect()->route('vehicles.index')
            ->with('success', "Vehicle status changed to {$vehicle->status}.");
    }
}
