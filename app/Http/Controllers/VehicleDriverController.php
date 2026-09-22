<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\vehicle;
use App\Models\User;
use App\Models\vehicledriver;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class VehicleDriverController extends Controller
{
    public function edit(Vehicle $vehicle)
    {
        $this->authorizeAdmin();

        $drivers = User::where('role', 'driver')->get();

        $currentAssignment = vehicledriver::where('vehicle_id', $vehicle->id)
            ->whereNull('unassigned_at')
            ->latest('assigned_at')
            ->first();

        return view('vehicles.assign', compact('vehicle', 'drivers', 'currentAssignment'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $this->authorizeAdmin();

        $request->validate([
            'user_id' => 'nullable|exists:users,id',
        ]);

        // Close current assignment if exists
        $current = vehicledriver::where('vehicle_id', $vehicle->id)
            ->whereNull('unassigned_at')
            ->latest('assigned_at')
            ->first();

        if ($current) {
            $current->update([
                'unassigned_at' => Carbon::today(),
            ]);
        }

        // Assign new driver if selected
        if ($request->user_id) {
            vehicledriver::create([
                'vehicle_id'    => $vehicle->id,
                'user_id'       => $request->user_id,
                'assigned_at'   => Carbon::today(),
                'unassigned_at' => null,
            ]);
        }

        return redirect()->route('vehicles.index')
            ->with('success', 'Driver assignment updated successfully.');
    }

    public function unassignFromList(Vehicle $vehicle)
    {
        $this->authorizeAdmin();

        $current = vehicledriver::where('vehicle_id', $vehicle->id)
            ->whereNull('unassigned_at')
            ->latest('assigned_at')
            ->first();

        if ($current) {
            $current->update(['unassigned_at' => now()]);
        }

        return redirect()->route('vehicles.index')
            ->with('success', 'Driver unassigned successfully.');
    }

    private function authorizeAdmin()
    {
        if (!in_array(Auth::user()->role, ['system_admin', 'transport_officer'])) {
            abort(403, 'You do not have permission to manage vehicle-driver assignments.');
        }
    }
}
