<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use App\Models\vehicle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ServiceStation;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ServiceRequestRejectedMail;
use App\Models\vehicledriver;

class ServiceRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $servicerequests = ServiceRequest::latest()->paginate(10);
        return view('servicerequest.index', compact('servicerequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // $vehicles = vehicle::all();
        // $vehicles = Vehicle::addSelect([
        //     'last_km' => ServiceRequest::select('current_km')
        //         ->whereColumn('reg_no', 'vehicles.plate_number')
        //         ->where('status', 'approved')
        //         ->latest()
        //         ->limit(1),

        //     'current_driver_name' => User::select('name')
        //         ->whereIn('id', function ($query) {
        //             $query->select('user_id')
        //                 ->from('vehicledrivers')
        //                 ->whereColumn('vehicle_id', 'vehicles.id')
        //                 ->whereNull('unassigned_at')
        //                 ->latest()
        //                 ->limit(1);
        //         })->limit(1)
        // ])->get();
        $vehicles = Vehicle::addSelect([
            'last_km' => ServiceRequest::select('current_km')
                ->whereColumn('reg_no', 'vehicles.plate_number')
                ->where('status', 'approved')
                ->latest()
                ->limit(1),

            'current_driver_name' => User::select('name')
                // Join the driver table directly to the user subquery
                ->join('vehicledrivers', 'vehicledrivers.user_id', '=', 'users.id')
                ->whereColumn('vehicledrivers.vehicle_id', 'vehicles.id')
                ->whereNull('vehicledrivers.unassigned_at')
                ->whereNull('users.deleted_at')
                ->latest('vehicledrivers.created_at')
                ->limit(1)
        ])->get();

        $serviceStations = ServiceStation::all();
        $drivers = User::where('role', 'driver')->get();

        // dd($vehicles);
        return view('servicerequest.create', compact('vehicles', 'serviceStations', 'drivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'request_date' => 'required|date',
            'reg_no' => 'required|string|max:255',
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'engine_cc' => 'required|string|max:255',
            'fuel_type' => 'required|string|max:255',
            'previous_km' => 'required|integer',
            'current_km' => 'required|integer',
            'assigned_driver' => 'required|string|max:255',
            'service_station' => 'required|string|max:255',
            'service_type' => 'required|string|max:255',
            'service_type_other' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'vehicle_drivable' => 'required|boolean',
            'warning_lights' => 'required|boolean',
            'body_damage' => 'required|boolean',
            'fluid_leaks' => 'required|boolean',
            'tyre_condition' => 'required|string|max:255',
            'driver_name' => 'required|string|max:255',
            'driver_id' => 'required|integer',
            'driver_signature' => 'required|string',
            'driver_date' => 'required|date',

        ]);

        $prefix = 'KOTDA/01/06/';

        $newNumber = DB::transaction(function () use ($prefix) {
            $lastRecord = ServiceRequest::where('reference_no', 'like', $prefix . '%')
                ->latest('id')
                ->first();

            if ($lastRecord) {
                $lastSequence = substr($lastRecord->reference_no, strrpos($lastRecord->reference_no, '/') + 1);
                return $prefix . str_pad((int)$lastSequence + 1, 5, '0', STR_PAD_LEFT);
            }

            return $prefix . '00001';
        });

        // 3. Merge the generated number into the data
        $data['reference_no'] = $newNumber;


        ServiceRequest::create($data);
        return redirect()->route('servicerequests.index')->with('success', 'Service request created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceRequest $serviceRequest, $id)
    {
        //
        $serviceRequest = ServiceRequest::findOrFail($id);
        //dd($serviceRequest);
        return view('servicerequest.show', compact('serviceRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceRequest $serviceRequest, $id)
    {
        //
        $serviceRequest = ServiceRequest::findOrFail($id);
        $vehicles = Vehicle::pluck('plate_number', 'id');

        $serviceStations = ServiceStation::all();

        return view('servicerequest.edit', compact(
            'serviceRequest',
            'vehicles',
            'serviceStations'
        ));
    }


    public function update(Request $request, ServiceRequest $servicerequest)
    {

        $validated = $request->validate([
            'request_date' => 'required|date',
            'reg_no' => 'required|string|max:255',
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'engine_cc' => 'required|string|max:255',
            'fuel_type' => 'required|string|max:255',
            'previous_km' => 'required|integer',
            'current_km' => 'required|integer',
            'assigned_driver' => 'required|string|max:255',
            'service_station' => 'required|string|max:255',
            'service_type' => 'required|string|max:255',
            'service_type_other' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'vehicle_drivable' => 'required|boolean',
            'warning_lights' => 'required|boolean',
            'body_damage' => 'required|boolean',
            'fluid_leaks' => 'required|boolean',
            'tyre_condition' => 'required|string|max:255',
            'driver_name' => 'required|string|max:255',
            'driver_id' => 'required|string',
            'driver_date' => 'required|date',
        ]);

        if ($servicerequest->status == 'rejected') {
            $validated['status'] = 'pending';
        }

        $servicerequest->update($validated);


        return redirect()
            ->route('servicerequests.show', $servicerequest->id)
            ->with('success', 'Service request updated successfully');
    }

    /**
     * Open the approval form for the specified resource.
     */
    public function openapproval(ServiceRequest $serviceRequest, $id)
    {
        //
        $serviceRequest = ServiceRequest::findOrFail($id);
        return view('servicerequest.approve', compact('serviceRequest'));
    }


    public function approve(Request $request, ServiceRequest $servicerequest)
    {
        //dd($request->all());

        if (auth()->user()->role !== 'transport_officer' && auth()->user()->role !== 'system_admin') {
            abort(403);
        }


        $request->validate([
            'inspection_findings' => 'required|string',
            'approver_signature' => 'required|string',
        ]);


        // REJECT
        if ($request->action === 'reject') {

            $servicerequest->update([
                'status' => 'rejected',
                'inspection_findings' => $request->inspection_findings,
                'approver_signature' => $request->approver_signature,
                'approved_by' => auth()->id(),
                'approved_at' => now(),
            ]);
            if ($servicerequest->driver && $servicerequest->driver->email) {

                Mail::to($servicerequest->driver->email)
                    ->send(new ServiceRequestRejectedMail($servicerequest));
            }
        }

        // APPROVE
        if ($request->action === 'approve') {

            $request->validate([
                'approver_signature' => 'required'
            ]);

            $servicerequest->update([
                'status' => 'approved',
                'inspection_findings' => $request->inspection_findings,
                'approver_signature' => $request->approver_signature,
                'approved_by' => auth()->id(),
                'approved_at' => now(),
            ]);
        }

        return redirect()->route('servicerequests.index')->with('success', 'Service request updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceRequest $serviceRequest)
    {
        //
    }



    public function download(ServiceRequest $servicerequest)
    {
        if ($servicerequest->status !== 'approved') {
            abort(403, 'Only approved requests can be downloaded.');
        }

        $pdf = Pdf::loadView(
            'servicerequest.pdf',
            compact('servicerequest')
        );

        return $pdf->download(
            'Service_Request_' . $servicerequest->reg_no . '.pdf'
        );
    }
}
