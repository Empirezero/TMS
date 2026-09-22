<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InspectionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $isAdmin = in_array($user->role, ['system_admin', 'transport_officer']);

        $inspections = Inspection::with(['vehicle', 'inspector'])
            ->when(!$isAdmin, function ($query) use ($user) {
                if ($user->role === 'driver') {
                    return $query->whereHas('vehicle.assignments', function ($q) use ($user) {
                        $q->where('user_id', $user->id)
                            ->whereNull('unassigned_at');
                    });
                }
                return $query->whereRaw('1 = 0');
            })
            ->latest('expiry_date')
            ->paginate(15);

        return view('inspections.index', compact('inspections'));
    }

    public function create()
    {
        $this->authorizeAdmin();

        $vehicles = vehicle::orderBy('plate_number')->get();
        return view('inspections.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'vehicle_id'          => 'required|exists:vehicles,id',
            'inspection_date'     => 'required|date',
            'expiry_date'         => 'required|date|after:inspection_date',
            'certificate_file'  => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'status'              => 'required|in:valid,expired,pending',
            'notes'               => 'nullable|string',
        ]);

        $validated['inspected_by'] = Auth::id();
        if ($request->hasFile('certificate_file')) {
            $validated['certificate_file'] = $request->file('certificate_file')->store('inspection_certificates', 'public');
        }

        Inspection::create($validated);

        return redirect()->route('inspections.index')
            ->with('status', 'Inspection record saved.');
    }

    public function show(Inspection $inspection)
    {
        $inspection->load(['vehicle', 'inspector']);
        return view('inspections.show', compact('inspection'));
    }

    public function edit(Inspection $inspection)
    {
        $this->authorizeAdmin();

        $vehicles = vehicle::orderBy('plate_number')->get();
        return view('inspections.edit', compact('inspection', 'vehicles'));
    }

    public function update(Request $request, Inspection $inspection)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'vehicle_id'          => 'required|exists:vehicles,id',
            'inspection_date'     => 'required|date',
            'expiry_date'         => 'required|date|after:inspection_date',
            'certificate_file'  => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'status'              => 'required|in:valid,expired,pending',
            'notes'               => 'nullable|string',
        ]);

        if ($request->hasFile('certificate_file')) {
            if ($inspection->certificate_file) {
                Storage::disk('public')->delete($inspection->certificate_file);
            }

            $validated['certificate_file'] = $request->file('certificate_file')->store('inspection_certificates', 'public');
        }

        $inspection->update($validated);

        return redirect()->route('inspections.index')
            ->with('status', 'Inspection record updated.');
    }

    public function destroy(Inspection $inspection)
    {
        $this->authorizeAdmin();

        if($inspection->certificate_file) {
            Storage::disk('public')->delete($inspection->certificate_file);
        }

        $inspection->delete();

        return redirect()->route('inspections.index')
            ->with('status', 'Inspection record deleted.');
    }

    private function authorizeAdmin()
    {
        if (!in_array(Auth::user()->role, ['system_admin', 'transport_officer'])) {
            abort(403, 'You do not have permission to manage inspections.');
        }
    }
}
