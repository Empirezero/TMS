<?php

namespace App\Http\Controllers;

use App\Models\vehiclerequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\vehicle;
use App\Models\User;

class VehicleRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $isAdmin = in_array($user->role, ['system_admin', 'transport_officer']);

        $requests = vehiclerequests::with(['requestor', 'vehicle', 'driver'])
            ->when(!$isAdmin, function ($query) use ($user) {
                if ($user->role === 'driver') {
                    return $query->where(function ($q) use ($user) {
                        $q->where('driver_id', $user->id)
                            ->orWhere('requestor_id', $user->id);
                    });
                }

                if ($user->role === 'staff') {
                    return $query->where('requestor_id', $user->id);
                }

                return $query->whereRaw('1 = 0');
            })
            ->latest()
            ->paginate(10);

        return view('vehiclerequests.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $vehicles = Vehicle::where('status', 'active')->get();
        return view('vehiclerequests.create', compact('vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'activity_name'  => 'required|string|max:255',
            'participants'   => 'required|integer|min:1',
            'start_date'     => 'required|date',
            'end_date'       => 'required|date|after_or_equal:start_date',
            'attachment'     => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'preferred_vehicle_id' => 'nullable|exists:vehicles,id'
        ]);

        $validated['requestor_id'] = Auth::id();
        $validated['days'] = (new \Carbon\Carbon($validated['start_date']))
            ->diffInDays(new \Carbon\Carbon($validated['end_date'])) + 1;

        if ($request->hasFile('attachment')) {
            $validated['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }


        //dd($validated);

        vehiclerequests::create($validated);

        return redirect()->route('vehiclerequests.index')->with('success', 'Vehicle request submitted.');
    }

    public function assignForm(VehicleRequests $vehiclerequest)
    {
        // dd($vehiclerequest);
        $this->authorizeAdmin();

        $vehicles = Vehicle::where('status', 'active')->get();
        $drivers  = User::where('role', 'driver')->get();

        return view('vehiclerequests.assign', compact('vehiclerequest', 'vehicles', 'drivers'));
    }


    public function assign(Request $request, VehicleRequests $vehiclerequest)
    {

        //dd($request);
        $this->authorizeAdmin();

        $data = $request->validate([
            'transport_mode' => 'required|in:vehicle,taxi',
            'vehicle_id'     => 'nullable|exists:vehicles,id',
            'driver_id'      => 'nullable|exists:users,id',
        ]);

        if ($data['transport_mode'] === 'vehicle') {
            $vehiclerequest->update([
                'transport_mode' => 'vehicle',
                'vehicle_id'     => $data['vehicle_id'],
                'driver_id'      => $data['driver_id'],
                'assigned_by'    => Auth::id(),
                'status'         => 'assigned',
            ]);
            //  update vehicle status
            Vehicle::where('id', $data['vehicle_id'])->update(['status' => 'inactive']);
        } else { // taxi / fare
            $vehiclerequest->update([
                'transport_mode' => 'taxi',
                'vehicle_id'     => null,
                'driver_id'      => null,
                'assigned_by'    => Auth::id(),
                'status'         => 'approved',
            ]);
        }

        return redirect()->route('vehiclerequests.index')
            ->with('success', 'Request processed successfully.');
    }


    public function uploadWorkTicket(Request $request, VehicleRequests $vehicleRequest)
    {

        if ($vehicleRequest->days == 1 || $vehicleRequest->transport_mode !== 'vehicle') {
            return back()->with('info', 'No work ticket required for this request.');
        }

        $request->validate([
            'work_ticket' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $path = $request->file('work_ticket')->store('work_tickets', 'public');

        $vehicleRequest->update([
            'work_ticket' => $path,
            'status' => 'completed'
        ]);

        return back()->with('success', 'Work ticket uploaded successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(vehiclerequests $vehiclerequest)
    {
        $user = Auth::user();
        $isAdmin = in_array($user->role, ['system_admin', 'transport_officer']);

        if (!$isAdmin) {
            $isOwner = $vehiclerequest->requestor_id === $user->id
                || $vehiclerequest->driver_id === $user->id;

            abort_unless($isOwner, 403, 'You do not have permission to view this request.');
        }

        return view('vehiclerequests.show', compact('vehiclerequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(vehiclerequests $vehiclerequests)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, vehiclerequests $vehiclerequests)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(vehiclerequests $vehiclerequests)
    {
        //
    }

    private function authorizeAdmin()
    {
        if (!in_array(Auth::user()->role, ['system_admin', 'transport_officer'])) {
            abort(403, 'You do not have permission to assign vehicle requests.');
        }
    }
}
