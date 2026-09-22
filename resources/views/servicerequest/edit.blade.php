@extends('layouts.admin')



@section('content')

<div class="pagetitle">

    ```
    <h1>Edit Motor Vehicle Service Request</h1>

    <nav>
        <ol class="breadcrumb">

            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Home</a>
            </li>

            <li class="breadcrumb-item">
                <a href="{{ route('servicerequests.index') }}">
                    Service Requests
                </a>
            </li>

            <li class="breadcrumb-item active">
                Edit Request
            </li>

        </ol>
    </nav>
    ```

</div>

<section class="section">

    ```
    <div class="row">

        <div class="col-lg-12">

            <div class="card">

                <div class="card-body">

                    <h5 class="card-title">
                        Motor Vehicle Service & Repair Requisition
                    </h5>


                    {{-- Validation Errors --}}

                    @if ($errors->any())

                    <div class="alert alert-danger alert-dismissible fade show">

                        <h6 class="alert-heading">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            Please correct the following errors:
                        </h6>

                        <ul class="mb-0">

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
                        action="{{ route('servicerequests.update', $serviceRequest->id) }}"
                        enctype="multipart/form-data">

                        @csrf

                        @method('PUT')


                        {{-- ================================================= --}}
                        {{-- 1. REQUEST INFORMATION --}}
                        {{-- ================================================= --}}

                        <div class="section-title border-bottom pb-2 mb-4">

                            <h5>
                                <i class="bi bi-calendar-check me-2"></i>
                                Request Information
                            </h5>

                        </div>


                        <div class="row g-3">

                            <div class="col-md-6">

                                <label class="form-label">
                                    Date of Request
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="date"
                                    name="request_date"
                                    value="{{ old('request_date', $serviceRequest->request_date) }}"
                                    class="form-control @error('request_date') is-invalid @enderror"
                                    required>

                                @error('request_date')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                                @enderror

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- 2. VEHICLE DETAILS --}}
                        {{-- ================================================= --}}

                        <div class="section-title border-bottom pb-2 mt-5 mb-4">

                            <h5>
                                <i class="bi bi-car-front me-2"></i>
                                Vehicle Identification Details
                            </h5>

                        </div>


                        <div class="row g-3">


                            {{-- Registration --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Vehicle Registration
                                    <span class="text-danger">*</span>
                                </label>

                                <select name="reg_no"
                                    class="form-select @error('reg_no') is-invalid @enderror"
                                    required>

                                    <option value="">
                                        Select Vehicle
                                    </option>

                                    @foreach($vehicles as $id => $reg_no)

                                    <option value="{{ $reg_no }}"
                                        {{ old('reg_no', $serviceRequest->reg_no) == $reg_no ? 'selected' : '' }}>

                                        {{ $reg_no }}

                                    </option>

                                    @endforeach

                                </select>

                                @error('reg_no')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                                @enderror

                            </div>


                            {{-- Make --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Make
                                </label>

                                <input type="text"
                                    name="make"
                                    value="{{ old('make', $serviceRequest->make) }}"
                                    class="form-control">

                            </div>


                            {{-- Model --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Model
                                </label>

                                <input type="text"
                                    name="model"
                                    value="{{ old('model', $serviceRequest->model) }}"
                                    class="form-control">

                            </div>


                            {{-- Engine CC --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Engine CC
                                </label>

                                <input type="text"
                                    name="engine_cc"
                                    value="{{ old('engine_cc', $serviceRequest->engine_cc) }}"
                                    class="form-control">

                            </div>


                            {{-- Fuel Type --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Fuel Type
                                </label>

                                <input type="text"
                                    name="fuel_type"
                                    value="{{ old('fuel_type', $serviceRequest->fuel_type) }}"
                                    class="form-control">

                            </div>


                            {{-- Previous KM --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Previous Service Odometer Reading
                                </label>

                                <input type="number"
                                    name="previous_km"
                                    value="{{ old('previous_km', $serviceRequest->previous_km) }}"
                                    class="form-control">

                            </div>


                            {{-- Current KM --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Current KM
                                </label>

                                <input type="number"
                                    name="current_km"
                                    value="{{ old('current_km', $serviceRequest->current_km) }}"
                                    class="form-control">

                            </div>


                            {{-- Assigned Driver --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Assigned Driver
                                </label>

                                <input type="text"
                                    name="assigned_driver"
                                    value="{{ old('assigned_driver', $serviceRequest->assigned_driver) }}"
                                    class="form-control">

                            </div>


                            {{-- Service Station --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Service Station
                                    <span class="text-danger">*</span>
                                </label>

                                <select name="service_station"
                                    class="form-select"
                                    required>

                                    <option value="">
                                        Select Service Station
                                    </option>

                                    @foreach($serviceStations as $station)

                                    <option value="{{ $station->name }}"
                                        {{ old('service_station', $serviceRequest->service_station) == $station->name ? 'selected' : '' }}>

                                        {{ $station->name }}

                                    </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- 3. SERVICE TYPE --}}
                        {{-- ================================================= --}}

                        <div class="section-title border-bottom pb-2 mt-5 mb-4">

                            <h5>
                                <i class="bi bi-tools me-2"></i>
                                Type of Service Required
                            </h5>

                        </div>


                        <div class="row g-3">

                            <div class="col-md-6">

                                <label class="form-label">
                                    Service Type
                                    <span class="text-danger">*</span>
                                </label>

                                <select name="service_type"
                                    class="form-select"
                                    required>

                                    <option value="minor"
                                        {{ old('service_type', $serviceRequest->service_type) == 'minor' ? 'selected' : '' }}>
                                        Minor Service
                                    </option>

                                    <option value="major"
                                        {{ old('service_type', $serviceRequest->service_type) == 'major' ? 'selected' : '' }}>
                                        Major Service
                                    </option>

                                    <option value="other"
                                        {{ old('service_type', $serviceRequest->service_type) == 'other' ? 'selected' : '' }}>
                                        Other
                                    </option>

                                </select>

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Other Service Type
                                </label>

                                <textarea name="service_type_other"
                                    rows="2"
                                    class="form-control">{{ old('service_type_other', $serviceRequest->service_type_other) }}</textarea>

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- 4. DESCRIPTION --}}
                        {{-- ================================================= --}}

                        <div class="section-title border-bottom pb-2 mt-5 mb-4">

                            <h5>
                                <i class="bi bi-card-text me-2"></i>
                                Detailed Description of Fault / Service Requirement
                            </h5>

                        </div>


                        <div class="mb-3">

                            <textarea name="description"
                                rows="5"
                                class="form-control"
                                placeholder="Describe the fault or service requirement...">{{ old('description', $serviceRequest->description) }}</textarea>

                        </div>


                        {{-- ================================================= --}}
                        {{-- 5. VEHICLE CONDITION --}}
                        {{-- ================================================= --}}

                        <div class="section-title border-bottom pb-2 mt-5 mb-4">

                            <h5>
                                <i class="bi bi-clipboard-check me-2"></i>
                                Vehicle Condition Declaration
                            </h5>

                        </div>


                        <div class="row g-3">


                            {{-- Vehicle Drivable --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Vehicle Drivable
                                </label>

                                <select name="vehicle_drivable"
                                    class="form-select">

                                    <option value="1"
                                        {{ old('vehicle_drivable', $serviceRequest->vehicle_drivable) == '1' ? 'selected' : '' }}>
                                        Yes
                                    </option>

                                    <option value="0"
                                        {{ old('vehicle_drivable', $serviceRequest->vehicle_drivable) == '0' ? 'selected' : '' }}>
                                        No
                                    </option>

                                </select>

                            </div>


                            {{-- Warning Lights --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Warning Lights On
                                </label>

                                <select name="warning_lights"
                                    class="form-select">

                                    <option value="1"
                                        {{ old('warning_lights', $serviceRequest->warning_lights) == '1' ? 'selected' : '' }}>
                                        Yes
                                    </option>

                                    <option value="0"
                                        {{ old('warning_lights', $serviceRequest->warning_lights) == '0' ? 'selected' : '' }}>
                                        No
                                    </option>

                                </select>

                            </div>


                            {{-- Body Damage --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Visible Body Damage
                                </label>

                                <select name="body_damage"
                                    class="form-select">

                                    <option value="1"
                                        {{ old('body_damage', $serviceRequest->body_damage) == '1' ? 'selected' : '' }}>
                                        Yes
                                    </option>

                                    <option value="0"
                                        {{ old('body_damage', $serviceRequest->body_damage) == '0' ? 'selected' : '' }}>
                                        No
                                    </option>

                                </select>

                            </div>


                            {{-- Fluid Leaks --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Fluid Leaks Observed
                                </label>

                                <select name="fluid_leaks"
                                    class="form-select">

                                    <option value="1"
                                        {{ old('fluid_leaks', $serviceRequest->fluid_leaks) == '1' ? 'selected' : '' }}>
                                        Yes
                                    </option>

                                    <option value="0"
                                        {{ old('fluid_leaks', $serviceRequest->fluid_leaks) == '0' ? 'selected' : '' }}>
                                        No
                                    </option>

                                </select>

                            </div>


                            {{-- Tyre Condition --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Tyre Condition
                                </label>

                                <select name="tyre_condition"
                                    class="form-select">

                                    <option value="good"
                                        {{ old('tyre_condition', $serviceRequest->tyre_condition) == 'good' ? 'selected' : '' }}>
                                        Good
                                    </option>

                                    <option value="worn"
                                        {{ old('tyre_condition', $serviceRequest->tyre_condition) == 'worn' ? 'selected' : '' }}>
                                        Fair
                                    </option>

                                    <option value="replace"
                                        {{ old('tyre_condition', $serviceRequest->tyre_condition) == 'replace' ? 'selected' : '' }}>
                                        Worn Out
                                    </option>

                                </select>

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- 6. DRIVER DECLARATION --}}
                        {{-- ================================================= --}}

                        <div class="section-title border-bottom pb-2 mt-5 mb-4">

                            <h5>
                                <i class="bi bi-person-check me-2"></i>
                                Driver Declaration
                            </h5>

                        </div>


                        <div class="row g-3">


                            {{-- Driver Name --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Driver Name
                                </label>

                                <input type="text"
                                    name="driver_name"
                                    value="{{ old('driver_name', $serviceRequest->driver_name) }}"
                                    class="form-control">

                            </div>


                            {{-- Driver ID --}}

                            <input type="hidden"
                                name="driver_id"
                                value="{{ Auth::id() }}">


                            {{-- Driver Date --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Driver Date
                                </label>

                                <input type="date"
                                    name="driver_date"
                                    value="{{ old('driver_date', $serviceRequest->driver_date) }}"
                                    class="form-control">

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- ACTION BUTTONS --}}
                        {{-- ================================================= --}}

                        <div class="border-top mt-5 pt-4">

                            <div class="d-flex justify-content-end gap-2">

                                <a href="{{ route('servicerequests.index') }}"
                                    class="btn btn-secondary">

                                    <i class="bi bi-arrow-left me-1"></i>
                                    Cancel

                                </a>


                                <button type="submit"
                                    class="btn btn-primary">

                                    <i class="bi bi-save me-1"></i>
                                    Update Service Request

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