@extends('layouts.admin')

@section('content')

<div class="pagetitle">
    <h1>Assign Vehicle / Fare</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('vehiclerequests.index') }}">Vehicle Requests</a></li>
            <li class="breadcrumb-item active">Assign</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            {{-- Request Details --}}
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="bi bi-info-circle me-2"></i>
                        Request Details
                    </h5>

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
                            <label class="form-label fw-bold">Participants</label>
                            <div class="form-control-plaintext">{{ $vehiclerequest->participants }}</div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Dates</label>
                            <div class="form-control-plaintext">{{ $vehiclerequest->start_date }} → {{ $vehiclerequest->end_date }}</div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Days</label>
                            <div class="form-control-plaintext">{{ $vehiclerequest->days }}</div>
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

            {{-- Assignment Form --}}
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="bi bi-truck me-2"></i>
                        Assignment
                    </h5>

                    <form method="POST" action="{{ route('vehiclerequests.assign', $vehiclerequest) }}">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Assignment Type</label>
                                <select name="transport_mode" id="transport_mode" class="form-select">
                                    <option value="vehicle" {{ old('transport_mode', $vehiclerequest->transport_mode) == 'vehicle' ? 'selected' : '' }}>Assign Vehicle</option>
                                    <option value="taxi" {{ old('transport_mode', $vehiclerequest->transport_mode) == 'taxi' ? 'selected' : '' }}>Use Fare/Taxi</option>
                                </select>
                            </div>

                        </div>

                        {{-- Vehicle + Driver Selection --}}
                        <div id="vehicle-fields" class="row g-3 mt-1">

                            <div class="col-md-6">
                                <label class="form-label">Select Vehicle</label>
                                <select name="vehicle_id" id="vehicle_id" class="form-select">
                                    <option value="">-- Select Vehicle --</option>
                                    @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" {{ old('vehicle_id', $vehiclerequest->vehicle_id) == $vehicle->id ? 'selected' : '' }}>
                                        {{ $vehicle->plate_number }} - {{ $vehicle->make }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Select Driver</label>
                                <select name="driver_id" id="driver_id" class="form-select">
                                    <option value="">-- Select Driver --</option>
                                    @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}" {{ old('driver_id', $vehiclerequest->driver_id) == $driver->id ? 'selected' : '' }}>
                                        {{ $driver->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        {{-- Fare Option (kept commented, matching original) --}}
                        {{-- <div id="fare-fields" class="row g-3 mt-1">
                            <div class="col-md-6">
                                <label class="form-label">Estimated Fare Cost</label>
                                <input type="number" step="0.01" name="fare_cost" value="{{ old('fare_cost', $vehiclerequest->fare_cost) }}" class="form-control @error('fare_cost') is-invalid @enderror">
                        @error('fare_cost')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div> --}}

            <div class="border-top mt-4 pt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('vehiclerequests.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Cancel
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle me-1"></i> Submit Assignment
                </button>
            </div>

            </form>
        </div>
    </div>

    </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modeSelect = document.getElementById('transport_mode');
        const vehicleFields = document.getElementById('vehicle-fields');

        function toggleFields() {
            vehicleFields.style.display = modeSelect.value === 'vehicle' ? 'flex' : 'none';
        }

        toggleFields();
        modeSelect.addEventListener('change', toggleFields);
    });
</script>

@endsection