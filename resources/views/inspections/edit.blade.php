
@extends('layouts.admin')

@section('content')

<div class="pagetitle">
    <h1>Edit Inspection Record</h1>

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('inspections.index') }}">Inspections</a>
            </li>

            <li class="breadcrumb-item active">
                Edit Inspection
            </li>
        </ol>
    </nav>
</div>

<section class="section">

    <div class="row justify-content-center">



        <div class="card">

            <div class="card-body">

                <h5 class="card-title">
                    Edit Inspection Record
                </h5>

                <p class="text-muted mb-4">
                    Update the inspection record for
                    <strong>{{ $inspection->vehicle->plate_number }}</strong>.
                </p>

                <form method="POST"
                    action="{{ route('inspections.update', $inspection) }}"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    {{-- Vehicle --}}
                    <div class="mb-4">

                        <label for="vehicle_search" class="form-label">
                            Vehicle
                        </label>

                        <input
                            type="text"
                            id="vehicle_search"
                            list="vehicle_options"
                            value="{{ old('vehicle_plate', $inspection->vehicle->plate_number) }}"
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
                            value="{{ old('vehicle_id', $inspection->vehicle_id) }}">

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
                                value="{{ old('inspection_date', $inspection->inspection_date->format('Y-m-d')) }}"
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
                                value="{{ old('expiry_date', $inspection->expiry_date->format('Y-m-d')) }}"
                                class="form-control @error('expiry_date') is-invalid @enderror"
                                required>

                            @error('expiry_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>

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

                            @foreach(['valid', 'pending', 'expired'] as $option)

                            <option
                                value="{{ $option }}"
                                {{ old('status', $inspection->status) === $option ? 'selected' : '' }}>

                                {{ ucfirst($option) }}

                            </option>

                            @endforeach

                        </select>

                        @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>

                    {{-- Certificate --}}
                    <div class="mb-4">

                        <label for="certificate_file" class="form-label">
                            Inspection Certificate
                        </label>

                        @if($inspection->certificate_file)

                        <div class="alert alert-light border d-flex align-items-center mb-3">

                            <i class="bi bi-paperclip fs-4 me-2 text-primary"></i>

                            <div>
                                <a href="{{ Storage::url($inspection->certificate_file) }}"
                                    target="_blank"
                                    class="fw-semibold text-decoration-none">

                                    View current file

                                </a>

                                <div class="small text-muted">
                                    Uploading a new file below will replace it.
                                </div>
                            </div>

                        </div>

                        @endif

                        <input
                            type="file"
                            id="certificate_file"
                            name="certificate_file"
                            accept="image/*,.pdf"
                            class="form-control @error('certificate_file') is-invalid @enderror">

                        <div class="form-text">
                            JPG, PNG, or PDF. Maximum file size: 5MB.
                            Leave empty to keep the current file.
                        </div>

                        @error('certificate_file')
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
                            placeholder="Enter inspection notes...">{{ old('notes', $inspection->notes) }}</textarea>

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
                            Update Inspection

                        </button>

                    </div>

                </form>

            </div>

        </div>



    </div>

</section>

@endsection
