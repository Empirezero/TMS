@extends('layouts.admin')

@section('content')

<div class="pagetitle">
    <h1>Service Request Details</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('servicerequests.index') }}">Service Requests</a>
            </li>
            <li class="breadcrumb-item active">Details</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">

        <div class="col-lg-12">

            {{-- Service Request Information --}}
            <div class="card">
                <div class="card-body">

                    <h5 class="card-title">Service Request Information</h5>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <strong>Reference Number:</strong>
                            <div class="text-muted">
                                {{ $serviceRequest->reference_no }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Request Date:</strong>
                            <div class="text-muted">
                                {{ $serviceRequest->request_date }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Registration No:</strong>
                            <div class="text-muted">
                                {{ $serviceRequest->reg_no }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Make:</strong>
                            <div class="text-muted">
                                {{ $serviceRequest->make }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Model:</strong>
                            <div class="text-muted">
                                {{ $serviceRequest->model }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Engine CC:</strong>
                            <div class="text-muted">
                                {{ $serviceRequest->engine_cc }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Fuel Type:</strong>
                            <div class="text-muted">
                                {{ $serviceRequest->fuel_type }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Previous Service KM:</strong>
                            <div class="text-muted">
                                {{ $serviceRequest->previous_km }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Current KM:</strong>
                            <div class="text-muted">
                                {{ $serviceRequest->current_km }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Assigned Driver:</strong>
                            <div class="text-muted">
                                {{ $serviceRequest->assigned_driver }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Service Type:</strong>
                            <div class="text-muted">
                                {{ $serviceRequest->service_type }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Service Type Details:</strong>
                            <div class="text-muted">
                                {{ $serviceRequest->service_type_other ?? 'N/A' }}
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <strong>Description:</strong>
                            <div class="text-muted">
                                {{ $serviceRequest->description ?? 'N/A' }}
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            {{-- Vehicle Condition --}}
            <div class="card">
                <div class="card-body">

                    <h5 class="card-title">Vehicle Condition</h5>

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <strong>Vehicle Drivable:</strong>
                            <div>
                                @if($serviceRequest->vehicle_drivable)
                                <span class="badge bg-success">Yes</span>
                                @else
                                <span class="badge bg-danger">No</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Warning Lights:</strong>
                            <div>
                                @if($serviceRequest->warning_lights)
                                <span class="badge bg-danger">Yes</span>
                                @else
                                <span class="badge bg-success">No</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Body Damage:</strong>
                            <div>
                                @if($serviceRequest->body_damage)
                                <span class="badge bg-danger">Yes</span>
                                @else
                                <span class="badge bg-success">No</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Fluid Leaks:</strong>
                            <div>
                                @if($serviceRequest->fluid_leaks)
                                <span class="badge bg-danger">Yes</span>
                                @else
                                <span class="badge bg-success">No</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Tyre Condition:</strong>
                            <div class="text-muted">
                                {{ $serviceRequest->tyre_condition }}
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            {{-- Driver Declaration --}}
            <div class="card">
                <div class="card-body">

                    <h5 class="card-title">Driver Declaration</h5>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <strong>Driver Name:</strong>
                            <div class="text-muted">
                                {{ $serviceRequest->driver_name }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Driver Date:</strong>
                            <div class="text-muted">
                                {{ $serviceRequest->driver_date }}
                            </div>
                        </div>

                        @if($serviceRequest->driver_signature)
                        <div class="col-md-12">
                            <strong>Driver Signature:</strong>

                            <div class="mt-2">
                                <img
                                    src="{{ $serviceRequest->driver_signature }}"
                                    alt="Driver Signature"
                                    class="border rounded p-2"
                                    style="max-width: 300px; height: auto;">
                            </div>
                        </div>
                        @endif

                    </div>

                </div>
            </div>

            {{-- Official Use Only --}}
            @if ($serviceRequest->status !== 'pending')

            <div class="card">
                <div class="card-body">

                    <h5 class="card-title">
                        Official Use Only
                    </h5>

                    <div class="row">

                        <div class="col-md-6 mb-4">
                            <strong>Transport Officer Comments:</strong>

                            <div class="mt-2 text-muted">
                                {{ $serviceRequest->inspection_findings ?? '-' }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <strong>Request Approver (Full Name):</strong>

                            <div class="mt-2 text-muted">
                                {{ $serviceRequest->approver?->name ?? '-' }}
                            </div>
                        </div>

                        <div class="col-md-12">
                            <strong>Request Approver Signature:</strong>

                            @if ($serviceRequest->approver_signature)

                            <div class="mt-2">
                                <img
                                    src="{{ $serviceRequest->approver_signature }}"
                                    alt="Approver Signature"
                                    class="border rounded p-2"
                                    style="max-width: 300px; height: auto;">
                            </div>

                            @else

                            <div class="text-muted mt-2">
                                -
                            </div>

                            @endif
                        </div>

                    </div>

                </div>
            </div>

            @endif

            {{-- Back Button --}}
            <div class="d-flex justify-content-between mb-4">

                <a
                    href="{{ route('servicerequests.index') }}"
                    class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i>
                    Back to Service Requests
                </a>

            </div>

        </div>

    </div>
</section>

@endsection