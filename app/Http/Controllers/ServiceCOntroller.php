<?php

namespace App\Http\Controllers;

use App\Models\service;
use Illuminate\Http\Request;
use App\Models\vehicle;
use App\Models\ServiceRequest;

class ServiceCOntroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $services = service::with('vehicle')->latest()->get();
        $services = Service::paginate(10);
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $vehicles = vehicle::all();
        // $approvedRequests = ServiceRequest::where('status', 'approved')
        //     ->whereNotIn('reference_number', function ($query) {
        //         $query->select('reference_number')->from('services');
        //     })
        //     ->get();
        $approvedRequests = ServiceRequest::join('vehicles', 'service_requests.reg_no', '=', 'vehicles.plate_number')
            ->where('service_requests.status', 'approved')
            ->whereNotIn('reference_number', function ($query) {
                $query->select('reference_number')->from('services');
            })
            ->select('service_requests.*', 'vehicles.id as vehicle_id')
            ->get();


        return view('services.create', compact('vehicles', 'approvedRequests'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'reference_number' => 'required|unique:services,reference_no',
            'vehicle_id'   => 'required|exists:vehicles,id',
            'service_date' => 'required|date',
            'type' => 'required|string|max:255',
            'cost'         => 'nullable|numeric',
            'notes'        => 'nullable|string',
        ]);

        service::create($request->all());

        return redirect()->route('services.index')
            ->with('success', 'Service record added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(service $service)
    {
        //
    }
}
