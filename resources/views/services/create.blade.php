@extends('layouts.admin')

@section('content')

<div class="pagetitle">
    <h1>Service Record Form</h1>

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item">Vehicle Management</li>
            <li class="breadcrumb-item active">Service Record</li>
        </ol>
    </nav>
</div>

<section class="section">

    <div class="row">



        <div class="card">

            <div class="card-body">

                <h5 class="card-title">

                    Service Record Details
                </h5>

                {{-- Validation Errors --}}
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">

                    <i class="bi bi-exclamation-triangle me-1"></i>

                    <strong>Please correct the following errors:</strong>

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

                <form action="{{ route('services.store') }}"
                    method="POST"
                    class="row g-3">

                    @csrf

                    {{-- Reference Number --}}
                    <div class="col-md-12">

                        <label for="reference_number"
                            class="form-label">
                            Reference Number
                            <span class="text-danger">*</span>
                        </label>

                        <select id="reference_number"
                            name="reference_number"
                            class="form-select @error('reference_number') is-invalid @enderror"
                            required>

                            <option value="">
                                -- Select Reference --
                            </option>

                            @foreach($approvedRequests as $request)

                            <option value="{{ $request->reference_no }}"
                                data-vehicle-plate="{{ $request->reg_no }}"
                                data-vehicle-id="{{ $request->vehicle_id }}"
                                data-service-type="{{ $request->service_type }}"
                                {{ old('reference_number') == $request->reference_no ? 'selected' : '' }}>

                                {{ $request->reference_no }}

                            </option>

                            @endforeach

                        </select>

                        @error('reference_number')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                        <div class="form-text">
                            Select an approved service request.
                        </div>

                    </div>


                    {{-- Vehicle Plate --}}
                    <div class="col-md-6">

                        <label for="display_plate"
                            class="form-label">
                            Vehicle Plate
                        </label>

                        <input type="text"
                            id="display_plate"
                            class="form-control"
                            placeholder="Vehicle plate"
                            readonly
                            required>

                        {{-- Hidden vehicle ID --}}
                        <input type="hidden"
                            id="vehicle_id"
                            name="vehicle_id">

                    </div>


                    {{-- Service Type --}}
                    <div class="col-md-6">

                        <label for="service_type"
                            class="form-label">
                            Service Type
                        </label>

                        <input type="text"
                            id="service_type"
                            name="type"
                            class="form-control"
                            placeholder="Service type"
                            readonly>

                    </div>


                    {{-- Service Date --}}
                    <div class="col-md-6">

                        <label for="service_date"
                            class="form-label">
                            Service Date
                            <span class="text-danger">*</span>
                        </label>

                        <input type="date"
                            id="service_date"
                            name="service_date"
                            value="{{ old('service_date') }}"
                            class="form-control @error('service_date') is-invalid @enderror"
                            required>

                        @error('service_date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    {{-- Cost --}}
                    <div class="col-md-6">

                        <label for="cost"
                            class="form-label">
                            Cost (KES)
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                KES
                            </span>

                            <input type="number"
                                id="cost"
                                name="cost"
                                value="{{ old('cost') }}"
                                step="0.01"
                                min="0"
                                class="form-control @error('cost') is-invalid @enderror"
                                placeholder="0.00">

                        </div>

                        @error('cost')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    {{-- Notes --}}
                    <div class="col-md-12">

                        <label for="notes"
                            class="form-label">
                            Notes
                        </label>

                        <textarea id="notes"
                            name="notes"
                            rows="4"
                            class="form-control @error('notes') is-invalid @enderror"
                            placeholder="Enter service notes or additional information">{{ old('notes') }}</textarea>

                        @error('notes')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    {{-- Buttons --}}
                    <div class="col-12 mt-4">

                        <button type="submit"
                            class="btn btn-primary">

                            <i class="bi bi-save me-1"></i>
                            Save Service Record

                        </button>

                        <a href="{{ route('services.index') }}"
                            class="btn btn-secondary">

                            <i class="bi bi-x-circle me-1"></i>
                            Cancel

                        </a>

                    </div>

                </form>

            </div>

        </div>



    </div>

</section>


{{-- Auto Populate Vehicle and Service Type --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const referenceSelect =
            document.getElementById('reference_number');

        const displayPlate =
            document.getElementById('display_plate');

        const vehicleId =
            document.getElementById('vehicle_id');

        const serviceType =
            document.getElementById('service_type');


        function populateVehicleDetails() {

            const selectedOption =
                referenceSelect.options[referenceSelect.selectedIndex];

            if (!selectedOption || !selectedOption.value) {

                displayPlate.value = '';
                vehicleId.value = '';
                serviceType.value = '';

                return;
            }

            const plate =
                selectedOption.getAttribute('data-vehicle-plate');

            const id =
                selectedOption.getAttribute('data-vehicle-id');

            const type =
                selectedOption.getAttribute('data-service-type');


            // Visible vehicle plate
            displayPlate.value = plate || '';


            // Hidden vehicle ID
            vehicleId.value = id || '';


            // Service type
            serviceType.value = type || '';
        }


        referenceSelect.addEventListener(
            'change',
            populateVehicleDetails
        );


        // Populate fields if validation fails
        if (referenceSelect.value) {
            populateVehicleDetails();
        }

    });
</script>

@endsection
```