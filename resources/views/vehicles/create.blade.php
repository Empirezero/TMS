@extends('layouts.admin')

@section('content')

<div class="pagetitle">
    <h1>Register Vehicle</h1>

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>

            <li class="breadcrumb-item">
                <a href="{{ route('vehicles.index') }}">Vehicles</a>
            </li>

            <li class="breadcrumb-item active">
                Register Vehicle
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
                        <i class="bi bi-car-front me-2"></i>
                        Register New Vehicle
                    </h5>

                    {{-- Validation Errors --}}
                    @if ($errors->any())

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Please correct the following errors:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>

                    @endif

                    <form method="POST" action="{{ route('vehicles.store') }}">
                        @csrf

                        <div class="row">

                            {{-- Plate Number --}}
                            <div class="col-md-6 mb-3">
                                <label for="plate_number" class="form-label">
                                    Plate Number <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="plate_number" name="plate_number"
                                    class="form-control @error('plate_number') is-invalid @enderror"
                                    value="{{ old('plate_number') }}" required autofocus>
                                @error('plate_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Make --}}
                            <div class="col-md-6 mb-3">
                                <label for="make" class="form-label">
                                    Make <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="make" name="make"
                                    class="form-control @error('make') is-invalid @enderror"
                                    value="{{ old('make') }}" required>
                                @error('make')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Model --}}
                            <div class="col-md-6 mb-3">
                                <label for="model" class="form-label">
                                    Model <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="model" name="model"
                                    class="form-control @error('model') is-invalid @enderror"
                                    value="{{ old('model') }}" required>
                                @error('model')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Year --}}
                            <div class="col-md-6 mb-3">
                                <label for="year" class="form-label">Year</label>
                                <input type="number" id="year" name="year"
                                    class="form-control @error('year') is-invalid @enderror"
                                    value="{{ old('year') }}" min="1990" max="{{ date('Y') + 1 }}">
                                @error('year')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Passengers --}}
                            <div class="col-md-6 mb-3">
                                <label for="passengers" class="form-label">
                                    Passenger Capacity <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="passengers" name="passengers"
                                    class="form-control @error('passengers') is-invalid @enderror"
                                    value="{{ old('passengers') }}" required>
                                @error('passengers')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-lg me-1"></i>
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-lg me-1"></i>
                                Register Vehicle
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection