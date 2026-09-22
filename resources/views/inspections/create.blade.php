@extends('layouts.admin')

@section('content')

<div class="pagetitle">
    <h1>New Inspection Record</h1>

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('inspections.index') }}">Inspections</a>
            </li>
            <li class="breadcrumb-item active">
                New Inspection
            </li>
        </ol>
    </nav>
</div>

<section class="section">

    <div class="row justify-content-center">



        <div class="card">
            <div class="card-body">

                <h5 class="card-title">
                    New Inspection Record
                </h5>

                <p class="text-muted mb-4">
                    Log an annual license inspection for a vehicle.
                </p>

                <form method="POST"
                    action="{{ route('inspections.store') }}"
                    enctype="multipart/form-data">

                    @csrf

                    {{-- Vehicle --}}
                    <div class="mb-4">

                        <label for="vehicle_search" class="form-label">
                            Vehicle
                        </label>

                        <input
                            type="text"
                            id="vehicle_search"
                            list="vehicle_options"
                            placeholder="Type plate number..."
                            class="form-control @error('vehicle_id') is-invalid @enderror"
                            oninput="document.getElementById('vehicle_id').value = (document.querySelector(`option[value='${this.value}']`)?.dataset.id) || ''"
                            required>

                        <datalist id="vehicle_options">

                            @foreach($vehicles as $vehicle)

                            <option
                                value="{{ $vehicle->plate_number }}"
                                data-id="{{ $vehicle->id }}">
                                {{ $vehicle->make }} {{ $vehicle->model }}
                            </option>

                            @endforeach

                        </datalist>

                        <input
                            type="hidden"
                            name="vehicle_id"
                            id="vehicle_id"
                            value="{{ old('vehicle_id') }}">

                        @error('vehicle_id')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>

                    {{-- Dates --}}
                    <div class="row">

                        <div class="col-md-6 mb-4">

                            <label for="inspection_date" class="form-label">
                                Inspection Date
                            </label>

                            <input
                                type="date"
                                id="inspection_date"
                                name="inspection_date"
                                value="{{ old('inspection_date') }}"
                                class="form-control @error('inspection_date') is-invalid @enderror"
                                required>

                            @error('inspection_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>

                        <div class="col-md-6 mb-4">

                            <label for="expiry_date" class="form-label">
                                Expiry Date
                            </label>

                            <input
                                type="date"
                                id="expiry_date"
                                name="expiry_date"
                                value="{{ old('expiry_date') }}"
                                class="form-control @error('expiry_date') is-invalid @enderror"
                                required>

                            @error('expiry_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>

                    </div>

                    {{-- Certificate --}}
                    <div class="mb-4">

                        <label for="certificate_file" class="form-label">
                            Inspection Certificate
                            <span class="text-muted">(optional)</span>
                        </label>

                        <input
                            type="file"
                            id="certificate_file"
                            name="certificate_file"
                            accept="image/*,.pdf"
                            class="form-control @error('certificate_file') is-invalid @enderror">

                        <div class="form-text">
                            JPG, PNG, or PDF. Maximum file size: 5MB.
                        </div>

                        @error('certificate_file')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>

                    {{-- Status --}}
                    <div class="mb-4">

                        <label for="status" class="form-label">
                            Status
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="form-select @error('status') is-invalid @enderror"
                            required>

                            <option value="valid"
                                {{ old('status') === 'valid' ? 'selected' : '' }}>
                                Valid
                            </option>

                            <option value="pending"
                                {{ old('status') === 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="expired"
                                {{ old('status') === 'expired' ? 'selected' : '' }}>
                                Expired
                            </option>

                        </select>

                        @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>

                    {{-- Notes --}}
                    <div class="mb-4">

                        <label for="notes" class="form-label">
                            Notes
                            <span class="text-muted">(optional)</span>
                        </label>

                        <textarea
                            id="notes"
                            name="notes"
                            rows="4"
                            class="form-control @error('notes') is-invalid @enderror"
                            placeholder="Enter any inspection notes...">{{ old('notes') }}</textarea>

                        @error('notes')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>

                    {{-- Actions --}}
                    <div class="d-flex justify-content-end gap-2 pt-2">

                        <a href="{{ route('inspections.index') }}"
                            class="btn btn-secondary">

                            <i class="bi bi-x-circle me-1"></i>
                            Cancel

                        </a>

                        <button type="submit"
                            class="btn btn-primary">

                            <i class="bi bi-check-circle me-1"></i>
                            Save Inspection

                        </button>

                    </div>

                </form>

            </div>
        </div>



    </div>

</section>

@endsection
```