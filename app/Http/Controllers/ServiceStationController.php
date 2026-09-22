<?php

namespace App\Http\Controllers;

use App\Models\ServiceStation;
use Illuminate\Http\Request;

class ServiceStationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicestation = ServiceStation::withTrashed()->orderBy('deleted_at')->orderBy('name')->get();
        return view('servicestation.index', compact('servicestation'));
    }

    
    public function create()
    {
        return redirect()->route('servicestations.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        ServiceStation::create($request->all());

        return redirect()->route('servicestations.index')
            ->with('success', 'Service station created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceStation $servicestation)
    {
        return view('servicestation.show', compact('servicestation'));
    }

    
    public function edit(ServiceStation $servicestation)
    {
        return redirect()->route('servicestations.index');
    }

    
    public function update(Request $request, ServiceStation $servicestation)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $servicestation->update($validated);

        return back()->with('success', 'Service station updated.');
    }

    public function destroy(ServiceStation $servicestation)
    {
        $servicestation->delete();
        return back()->with('success', 'Service station soft deleted.');
    }

    public function restore($id)
    {
        ServiceStation::withTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'Service station restored.');
    }
}
