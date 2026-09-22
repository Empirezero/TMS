@extends('layouts.admin')
@section('content')

<div class="pagetitle">
    <h1>Add Fuel Log</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item">Fuel Management</li>
            <li class="breadcrumb-item active">Add Fuel Log</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <!-- 
        <div class="col-lg-10 mx-auto"> -->

        <div class="card">
            <div class="card-body">

                <h5 class="card-title">
                    Fuel Log Details
                </h5>

                {{-- Validation Errors --}}
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Please correct the following errors:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('fuels.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="row g-3">

                    @csrf

                    {{-- Vehicle --}}
                    <div class="col-md-12">
                        <label for="vehicle_id" class="form-label">
                            Vehicle <span class="text-danger">*</span>
                        </label>

                        <select name="vehicle_id"
                            id="vehicle_id"
                            class="form-select @error('vehicle_id') is-invalid @enderror"
                            required>

                            <option value="">-- Select Vehicle --</option>

                            @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}"
                                {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                {{ $vehicle->plate_number }} -
                                {{ $vehicle->make }}
                            </option>
                            @endforeach

                        </select>

                        @error('vehicle_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Fuel Date --}}
                    <div class="col-md-6">
                        <label for="date" class="form-label">
                            Fuel Date <span class="text-danger">*</span>
                        </label>

                        <input type="date"
                            name="date"
                            id="date"
                            value="{{ old('date') }}"
                            class="form-control @error('date') is-invalid @enderror"
                            required>

                        @error('date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Liters --}}
                    <div class="col-md-6">
                        <label for="liters" class="form-label">
                            Liters <span class="text-danger">*</span>
                        </label>

                        <div class="input-group">
                            <input type="number"
                                step="0.01"
                                name="liters"
                                id="liters"
                                value="{{ old('liters') }}"
                                class="form-control @error('liters') is-invalid @enderror"
                                placeholder="e.g. 45.50"
                                required>

                            <span class="input-group-text">L</span>
                        </div>

                        @error('liters')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Cost --}}
                    <div class="col-md-6">
                        <label for="cost" class="form-label">
                            Cost (KES)
                        </label>

                        <div class="input-group">
                            <span class="input-group-text">KES</span>

                            <input type="number"
                                step="0.01"
                                name="cost"
                                id="cost"
                                value="{{ old('cost') }}"
                                class="form-control @error('cost') is-invalid @enderror"
                                placeholder="e.g. 7500.00">
                        </div>

                        @error('cost')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Station --}}
                    <div class="col-md-6">
                        <label for="station" class="form-label">
                            Fuel Station
                        </label>

                        <input type="text"
                            name="station"
                            id="station"
                            value="{{ old('station') }}"
                            class="form-control @error('station') is-invalid @enderror"
                            placeholder="Enter fuel station">

                        @error('station')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Receipt --}}
                    <div class="col-md-12">
                        <label for="receipt" class="form-label">
                            Receipt (Image/PDF)
                        </label>

                        <input type="file"
                            name="receipt"
                            id="receipt"
                            class="form-control @error('receipt') is-invalid @enderror"
                            accept="image/*,application/pdf">

                        <div class="form-text">
                            Accepted formats: JPG, JPEG, PNG or PDF.
                        </div>

                        @error('receipt')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="col-12 mt-4">

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i>
                            Save Fuel Log
                        </button>

                        <a href="{{ route('fuels.index') }}"
                            class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i>
                            Cancel
                        </a>

                    </div>

                </form>

            </div>
        </div>

        <!-- </div> -->

    </div>
</section>

@endsection