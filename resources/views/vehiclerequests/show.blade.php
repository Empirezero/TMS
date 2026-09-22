@extends('layouts.admin')

@section('content')

<div class="pagetitle">
    <h1>Vehicle Request Details</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('vehiclerequests.index') }}">Vehicle Requests</a></li>
            <li class="breadcrumb-item active">View</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            {{-- Request Details --}}
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-4 pt-2 mb-4">
                        <h5 class="fw-semibold mb-0">
                            <i class="bi bi-info-circle me-2"></i>
                            Request Details
                        </h5>

                        @if($vehiclerequest->status === 'pending')
                        <span class="badge bg-danger-subtle text-danger">Pending</span>
                        @elseif($vehiclerequest->status === 'assigned')
                        <span class="badge bg-info-subtle text-info">Assigned</span>
                        @elseif($vehiclerequest->status === 'approved')
                        <span class="badge bg-warning-subtle text-warning">Approved</span>
                        @elseif($vehiclerequest->status === 'completed')
                        <span class="badge bg-success-subtle text-success">Completed</span>
                        @endif
                    </div>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Activity</label>
                            <div class="form-control-plaintext">{{ $vehiclerequest->activity_name }}</div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Requestor</label>
                            <div class="form-control-plaintext">{{ $vehiclerequest->requestor->name ?? '—' }}</div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Start Date</label>
                            <div class="form-control-plaintext">{{ $vehiclerequest->start_date }}</div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">End Date</label>
                            <div class="form-control-plaintext">{{ $vehiclerequest->end_date }}</div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Days</label>
                            <div class="form-control-plaintext">{{ $vehiclerequest->days }}</div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Participants</label>
                            <div class="form-control-plaintext">{{ $vehiclerequest->participants }}</div>
                        </div>

                        @if($vehiclerequest->attachment)
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Attachment</label>
                            <div>
                                <a href="{{ asset('storage/' . $vehiclerequest->attachment) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-paperclip me-1"></i> View Attachment
                                </a>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>

            {{-- Assignment Details --}}
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="fw-semibold border-bottom pb-2 mb-4">
                        <i class="bi bi-truck me-2"></i>
                        Assignment
                    </h5>

                    @if($vehiclerequest->status === 'pending')

                    <div class="alert alert-warning d-flex align-items-center mb-0" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        This request has not been assigned a vehicle or fare option yet.
                    </div>

                    @else

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Transport Mode</label>
                            <div>
                                @if($vehiclerequest->transport_mode === 'vehicle')
                                <span class="badge bg-primary-subtle text-primary">Vehicle Assigned</span>
                                @elseif($vehiclerequest->transport_mode === 'taxi')
                                <span class="badge bg-warning-subtle text-warning">Fare/Taxi</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Assigned By</label>
                            <div class="form-control-plaintext">{{ $vehiclerequest->assignedBy->name ?? '—' }}</div>
                        </div>

                        @if($vehiclerequest->transport_mode === 'vehicle')

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Vehicle</label>
                            <div class="form-control-plaintext">
                                {{ $vehiclerequest->vehicle->plate_number ?? '—' }}
                                @if($vehiclerequest->vehicle)
                                ({{ $vehiclerequest->vehicle->make }} {{ $vehiclerequest->vehicle->model }})
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Driver</label>
                            <div class="form-control-plaintext">{{ $vehiclerequest->driver->name ?? '—' }}</div>
                        </div>

                        @endif

                    </div>

                    @endif

                </div>
            </div>

            {{-- Actions --}}
            <div class="d-flex justify-content-end gap-2 mt-4">

                <a href="{{ route('vehiclerequests.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Back to List
                </a>

                @if($vehiclerequest->status === 'pending' && in_array(Auth::user()->role, ['system_admin', 'transport_officer']))
                <a href="{{ route('vehiclerequests.assignForm', $vehiclerequest) }}" class="btn btn-success">
                    <i class="bi bi-truck me-1"></i> Assign Vehicle / Fare
                </a>
                @endif

            </div>

        </div>
    </div>
</section>

@endsection