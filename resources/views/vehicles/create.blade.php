@extends('layouts.admin')

@section('content')

<div class="pagetitle">
    <h1>Vehicle Request</h1>

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>

            <li class="breadcrumb-item">
                <a href="{{ route('vehiclerequests.index') }}">Vehicle Requests</a>
            </li>

            <li class="breadcrumb-item active">
                New Request
            </li>
        </ol>
    </nav>
</div>

<section class="section">

    <div class="row">

        <div class="col-lg-8 mx-auto">

            <div class="card">

                <div class="card-body">

                    <h5 class="card-title">
                        <i class="bi bi-truck me-2"></i>
                        New Vehicle Request
                    </h5>

                    {{-- Validation Errors --}}
                    @if ($errors->any())

                    <div class="alert alert-danger alert-dismissible fade show"
                        role="alert">

                        <strong>
                            Please correct the following errors:
                        </strong>

                        <ul class="mb-0 mt-2">

                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                        </button>

                    </div>

                    @endif


                    <form method="POST"
                        action="{{ route('vehiclerequests.store') }}"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="row">


                            {{-- Activity Name --}}
                            <div class="col-md-12 mb-3">

                                <label for="activity_name"
                                    class="form-label">
                                    Activity Name
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                    id="activity_name"
                                    name="activity_name"
                                    class="form-control @error('activity_name') is-invalid @enderror"
                                    value="{{ old('activity_name') }}"
                                    required
                                    autofocus>

                                @error('activity_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>


                            {{-- Start Date --}}
                            <div class="col-md-6 mb-3">

                                <label for="start_date"
                                    class="form-label">
                                    Start Date
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="date"
                                    id="start_date"
                                    name="start_date"
                                    class="form-control @error('start_date') is-invalid @enderror"
                                    value="{{ old('start_date') }}"
                                    required>

                                @error('start_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>


                            {{-- End Date --}}
                            <div class="col-md-6 mb-3">

                                <label for="end_date"
                                    class="form-label">
                                    End Date
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="date"
                                    id="end_date"
                                    name="end_date"
                                    class="form-control @error('end_date') is-invalid @enderror"
                                    value="{{ old('end_date') }}"
                                    required>

                                @error('end_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>


                            {{-- Participants --}}
                            <div class="col-md-6 mb-3">

                                <label for="participants"
                                    class="form-label">
                                    Number of Participants
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="number"
                                    id="participants"
                                    name="participants"
                                    class="form-control @error('participants') is-invalid @enderror"
                                    value="{{ old('participants') }}"
                                    min="1"
                                    required>

                                @error('participants')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>


                            {{-- Preferred Vehicle --}}
                            <div class="col-md-6 mb-3">

                                <label for="preferred_vehicle_id"
                                    class="form-label">
                                    Select Vehicle (optional)
                                </label>

                                <select id="preferred_vehicle_id"
                                    name="preferred_vehicle_id"
                                    class="form-select @error('preferred_vehicle_id') is-invalid @enderror">

                                    <option value="">— No Vehicle —</option>

                                    @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" {{ old('preferred_vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                        {{ $vehicle->plate_number }} ({{ $vehicle->make }} {{ $vehicle->model }})
                                    </option>
                                    @endforeach

                                </select>

                                @error('preferred_vehicle_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>


                            {{-- Attachment --}}
                            <div class="col-md-12 mb-3">

                                <label for="attachment"
                                    class="form-label">
                                    Attach Document (optional)
                                </label>

                                <input type="file"
                                    id="attachment"
                                    name="attachment"
                                    class="form-control @error('attachment') is-invalid @enderror">

                                @error('attachment')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>


                        </div>


                        {{-- Buttons --}}
                        <div class="d-flex justify-content-end gap-2 mt-4">

                            <a href="{{ route('vehiclerequests.index') }}"
                                class="btn btn-secondary">

                                <i class="bi bi-x-lg me-1"></i>
                                Cancel

                            </a>

                            <button type="submit"
                                class="btn btn-success">

                                <i class="bi bi-check-lg me-1"></i>
                                Submit Request

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection