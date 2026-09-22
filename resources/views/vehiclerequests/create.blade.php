@extends('layouts.admin')

@section('content')

<div class="pagetitle">
    <h1>Vehicle Request</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('vehiclerequests.index') }}">Vehicle Requests</a>
            </li>
            <li class="breadcrumb-item active">New Request</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Vehicle Request Form</h5>
                    <form method="POST" action="{{ route('vehiclerequests.store') }}" enctype="multipart/form-data">
                        @csrf

                        @php
                        $today = date('Y-m-d');
                        @endphp

                        {{-- ================================================= --}}
                        {{-- 1. ACTIVITY DETAILS --}}
                        {{-- ================================================= --}}

                        <div class="section-title border-bottom pb-2 mb-4">
                            <h5 class="fw-semibold">1. Activity Details</h5>
                        </div>

                        <div class="row g-3">

                            <div class="col-md-12">
                                <label class="form-label">Activity Name <span class="text-danger">*</span></label>
                                <input type="text" name="activity_name" value="{{ old('activity_name') }}" class="form-control @error('activity_name') is-invalid @enderror" required autofocus>

                                @error('activity_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Start Date <span class="text-danger">*</span></label>
                                <input type="date" name="start_date" value="{{ old('start_date') }}" class="form-control @error('start_date') is-invalid @enderror" required>

                                @error('start_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">End Date <span class="text-danger">*</span></label>
                                <input type="date" name="end_date" value="{{ old('end_date') }}" class="form-control @error('end_date') is-invalid @enderror" required>

                                @error('end_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Number of Participants <span class="text-danger">*</span></label>
                                <input type="number" min="1" name="participants" value="{{ old('participants') }}" class="form-control @error('participants') is-invalid @enderror" required>

                                @error('participants')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- 2. VEHICLE PREFERENCE --}}
                        {{-- ================================================= --}}

                        <div class="section-title border-bottom pb-2 mt-5 mb-4">
                            <h5 class="fw-semibold">2. Vehicle Preference</h5>
                        </div>

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Select Vehicle (optional)</label>
                                <select id="preferred_vehicle_id" name="preferred_vehicle_id" class="form-select @error('preferred_vehicle_id') is-invalid @enderror">
                                    <option value="">— No Vehicle —</option>
                                    @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" {{ old('preferred_vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                        {{ $vehicle->plate_number }} ({{ $vehicle->make }} {{ $vehicle->model }})
                                    </option>
                                    @endforeach
                                </select>
                                <div class="form-text">Leave blank to let the Transport Officer assign a suitable vehicle.</div>

                                @error('preferred_vehicle_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- 3. SUPPORTING DOCUMENT --}}
                        {{-- ================================================= --}}

                        <div class="section-title border-bottom pb-2 mt-5 mb-4">
                            <h5 class="fw-semibold">3. Supporting Document</h5>
                        </div>

                        <div class="row g-3">

                            <div class="col-md-12">
                                <label class="form-label">Attach Document (optional)</label>
                                <input type="file" name="attachment" class="form-control @error('attachment') is-invalid @enderror">
                                <div class="form-text">Attach a memo, invitation, or supporting letter for this activity, if available.</div>

                                @error('attachment')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- 4. REQUESTER DECLARATION --}}
                        {{-- ================================================= --}}

                        <div class="section-title border-bottom pb-2 mt-5 mb-4">
                            <h5>
                                <i class="bi bi-person-check me-2"></i>
                                4. Requester Declaration
                            </h5>
                        </div>

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Requested By</label>
                                <input type="text" value="{{ Auth::user()->name }}" class="form-control bg-light" readonly>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Date</label>
                                <input type="date" value="{{ $today }}" class="form-control bg-light" readonly>
                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- SUBMIT --}}
                        {{-- ================================================= --}}

                        <div class="border-top mt-5 pt-4">
                            <div class="d-flex justify-content-end gap-2">

                                <a href="{{ route('vehiclerequests.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-1"></i>
                                    Cancel
                                </a>

                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-send me-1"></i>
                                    Submit Request
                                </button>

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection