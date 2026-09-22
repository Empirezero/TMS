@extends('layouts.admin')


@section('content')

<div class="pagetitle">
    <h1>Motor Vehicle Service & Repair Requisition</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('servicerequests.index') }}">Service Requests</a>
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
                    <h5 class="card-title">Motor Vehicle Service & Repair Requisition Form</h5>
                    <form method="POST" action="{{ route('servicerequests.store') }}" enctype="multipart/form-data">
                        @csrf

                        @php
                        $today = date('Y-m-d');
                        @endphp

                        {{-- ================================================= --}}
                        {{-- 1. VEHICLE IDENTIFICATION --}}
                        {{-- ================================================= --}}

                        <div class="section-title border-bottom pb-2 mb-4">
                            <h5 class="fw-semibold"> 1. Vehicle Identification Details</h5>
                        </div>

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label"> Date of Request <span class="text-danger">*</span> </label>
                                <input type="date" name="request_date" value="{{ old('request_date', $today) }}" class="form-control @error('request_date') is-invalid @enderror" required>

                                @error('request_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Select Vehicle Registration<span class="text-danger">*</span></label> <select id="reg_no" name="reg_no" class="form-select @error('reg_no') is-invalid @enderror" required>
                                    <option value=""> -- Select Vehicle -- </option>
                                    @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->plate_number }}"
                                        data-make="{{ $vehicle->make }}"
                                        data-model="{{ $vehicle->model }}"
                                        data-last-km="{{ $vehicle->last_km }}"
                                        data-driver-name="{{ $vehicle->current_driver_name }}"
                                        {{ old('reg_no') == $vehicle->plate_number ? 'selected' : '' }}>
                                        {{ $vehicle->plate_number }}
                                    </option>
                                    @endforeach
                                </select>

                                @error('reg_no')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Make <span class="text-danger">*</span></label>
                                <input type="text" id="make_input" name="make" value="{{ old('make') }}" class="form-control bg-light" readonly required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Model / Type <span class="text-danger">*</span></label>
                                <input type="text" id="model_input" name="model" value="{{ old('model') }}" class="form-control bg-light" readonly required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Engine CC <span class="text-danger">*</span></label>
                                <input type="text" name="engine_cc" value="{{ old('engine_cc') }}" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Fuel Type <span class="text-danger">*</span></label>
                                <input type="text" name="fuel_type" value="{{ old('fuel_type') }}" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"> Previous Service Odometer Reading<span class="text-danger">*</span></label>
                                <input type="number" id="previous_km" name="previous_km" value="{{ old('previous_km') }}" class="form-control" required>
                                <div class="form-text"> Automatically populated from the vehicle's previous service record.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"> Current KM <span class="text-danger">*</span></label>
                                <input type="number" name="current_km" value="{{ old('current_km') }}" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Assigned Driver</label>
                                <select id="driver_id" name="assigned_driver" class="form-select">
                                    <option value=""> -- Select Driver -- </option>
                                    @foreach($drivers as $driver)
                                    <option value="{{ $driver->name }}"
                                        {{ old('assigned_driver') == $driver->name ? 'selected' : '' }}> {{ $driver->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Select Service Station<span class="text-danger">*</span></label>
                                <select id="service_station" name="service_station" class="form-select" required>
                                    <option value="">-- Select Service Station --</option>
                                    @foreach($serviceStations as $station)
                                    <option value="{{ $station->name }}" {{ old('service_station') == $station->name ? 'selected' : '' }}> {{ $station->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        {{-- ================================================= --}}
                        {{-- 2. SERVICE TYPE --}}
                        {{-- ================================================= --}}

                        <div class="section-title border-bottom pb-2 mt-5 mb-4">
                            <h5 class="fw-semibold">2. Type of Service Required </h5>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Service Type<span class="text-danger">*</span></label>
                                <select name="service_type" class="form-select" required>
                                    <option value="minor" {{ old('service_type') == 'minor' ? 'selected' : '' }}>
                                        Minor Service
                                    </option>
                                    <option value="major" {{ old('service_type') == 'major' ? 'selected' : '' }}>
                                        Major Service
                                    </option>
                                    <option value="other" {{ old('service_type') == 'other' ? 'selected' : '' }}>
                                        Other
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Other Specifications </label>
                                <input type="text" name="service_type_other" value="{{ old('service_type_other') }}" class="form-control">

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- 3. DESCRIPTION --}}
                        {{-- ================================================= --}}

                        <div class="section-title border-bottom pb-2 mt-5 mb-4">
                            <h5 class="fw-semibold">3. Detailed Description of Fault / Service Requirement</h5>
                        </div>

                        <div class="mb-3">
                            <textarea name="description" class="form-control" rows="5" placeholder="Describe the fault or service requirement...">{{ old('description') }}</textarea>
                        </div>


                        {{-- ================================================= --}}
                        {{-- 4. VEHICLE CONDITION --}}
                        {{-- ================================================= --}}

                        <div class="section-title border-bottom pb-2 mt-5 mb-4">
                            <h5 class="fw-semibold">4. Vehicle Condition Declaration </h5>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label"> Vehicle Drivable</label>
                                <select name="vehicle_drivable" class="form-select">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Warning Lights On </label>
                                <select name="warning_lights" class="form-select">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"> Visible Body Damage</label>
                                <select name="body_damage" class="form-select">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"> Fluid Leaks Observed </label>
                                <select name="fluid_leaks" class="form-select">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Tyre Condition </label>
                                <select name="tyre_condition" class="form-select">
                                    <option value="good">Good</option>
                                    <option value="worn">Fair</option>
                                    <option value="replace">Worn Out</option>
                                </select>
                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- 5. DRIVER DECLARATION --}}
                        {{-- ================================================= --}}

                        <div class="section-title border-bottom pb-2 mt-5 mb-4">

                            <h5>
                                <i class="bi bi-person-check me-2"></i>
                                5. Driver Declaration
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
                                    value="{{ Auth::user()->name }}"
                                    class="form-control bg-light"
                                    readonly
                                    required>

                            </div>


                            {{-- Driver ID --}}
                            <input type="hidden"
                                name="driver_id"
                                value="{{ Auth::id() }}">


                            {{-- Driver Date --}}
                            <div class="col-md-6">

                                <label class="form-label">
                                    Date
                                </label>

                                <input type="date"
                                    name="driver_date"
                                    value="{{ old('driver_date', $today) }}"
                                    class="form-control"
                                    required>

                            </div>


                            {{-- Signature --}}
                            <div class="col-12">

                                <label class="form-label">
                                    Driver Signature
                                </label>

                                <div class="border rounded bg-white p-2">

                                    <canvas id="signature-canvas"
                                        class="w-100"
                                        style="height: 200px; touch-action: none;">
                                    </canvas>

                                </div>

                                <input type="hidden"
                                    name="driver_signature"
                                    id="signature">

                                <button type="button"
                                    id="clear-signature"
                                    class="btn btn-sm btn-outline-danger mt-2">

                                    <i class="bi bi-eraser me-1"></i>
                                    Clear Signature

                                </button>

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- SUBMIT --}}
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

                                    <i class="bi bi-send me-1"></i>
                                    Submit Service Request

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
    ```

</section>

{{-- ================================================= --}}
{{-- VEHICLE AUTO-FILL --}}
{{-- ================================================= --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const vehicleSelect = document.getElementById('reg_no');

        const makeInput = document.getElementById('make_input');
        const modelInput = document.getElementById('model_input');

        const previousKm = document.getElementById('previous_km');

        const driverSelect = document.getElementById('driver_id');


        vehicleSelect.addEventListener('change', function() {

            const selected = this.options[this.selectedIndex];


            /*
            |--------------------------------------------------------------------------
            | Vehicle Make & Model
            |--------------------------------------------------------------------------
            */

            const make = selected.getAttribute('data-make') || '';
            const model = selected.getAttribute('data-model') || '';

            makeInput.value = make;
            modelInput.value = model;


            /*
            |--------------------------------------------------------------------------
            | Previous KM
            |--------------------------------------------------------------------------
            */

            const lastKm = selected.getAttribute('data-last-km');

            if (lastKm && lastKm !== '' && lastKm !== 'null') {

                previousKm.value = lastKm;
                previousKm.readOnly = true;

                previousKm.classList.add('bg-light');

                previousKm.placeholder = '';

            } else {

                previousKm.value = '';
                previousKm.readOnly = false;

                previousKm.classList.remove('bg-light');

                previousKm.placeholder =
                    'No history found - enter manually';

            }


            /*
            |--------------------------------------------------------------------------
            | Current Driver
            |--------------------------------------------------------------------------
            */

            const driverName =
                selected.getAttribute('data-driver-name');


            if (driverName &&
                driverName !== 'null' &&
                driverName !== '') {

                driverSelect.value = driverName;

                driverSelect.disabled = true;

                driverSelect.classList.add('bg-light');

            } else {

                driverSelect.value = '';

                driverSelect.disabled = false;

                driverSelect.classList.remove('bg-light');

            }

        });

    });
</script>

{{-- ================================================= --}}
{{-- SIGNATURE PAD --}}
{{-- ================================================= --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const canvas =
            document.getElementById('signature-canvas');

        const signatureInput =
            document.getElementById('signature');

        const clearBtn =
            document.getElementById('clear-signature');

        const ctx =
            canvas.getContext('2d');


        function resizeCanvas() {

            const ratio =
                Math.max(window.devicePixelRatio || 1, 1);

            const rect =
                canvas.getBoundingClientRect();

            canvas.width = rect.width * ratio;
            canvas.height = rect.height * ratio;

            ctx.scale(ratio, ratio);

        }


        resizeCanvas();


        window.addEventListener('resize', function() {

            resizeCanvas();

        });


        let drawing = false;


        function getPosition(e) {

            const rect =
                canvas.getBoundingClientRect();


            if (e.touches) {

                return {

                    x: e.touches[0].clientX - rect.left,

                    y: e.touches[0].clientY - rect.top

                };

            }


            return {

                x: e.clientX - rect.left,

                y: e.clientY - rect.top

            };

        }


        function startPosition(e) {

            e.preventDefault();

            drawing = true;

            const pos = getPosition(e);

            ctx.beginPath();

            ctx.moveTo(pos.x, pos.y);

        }


        function endPosition(e) {

            e.preventDefault();

            drawing = false;

            ctx.beginPath();

            signatureInput.value =
                canvas.toDataURL('image/png');

        }


        function draw(e) {

            e.preventDefault();

            if (!drawing) return;


            const pos = getPosition(e);


            ctx.lineWidth = 2;

            ctx.lineCap = 'round';

            ctx.lineJoin = 'round';

            ctx.strokeStyle = '#000';


            ctx.lineTo(pos.x, pos.y);

            ctx.stroke();

        }


        /*
        |--------------------------------------------------------------------------
        | Mouse
        |--------------------------------------------------------------------------
        */

        canvas.addEventListener(
            'mousedown',
            startPosition
        );

        canvas.addEventListener(
            'mouseup',
            endPosition
        );

        canvas.addEventListener(
            'mousemove',
            draw
        );


        /*
        |--------------------------------------------------------------------------
        | Touch
        |--------------------------------------------------------------------------
        */

        canvas.addEventListener(
            'touchstart',
            startPosition, {
                passive: false
            }
        );

        canvas.addEventListener(
            'touchend',
            endPosition, {
                passive: false
            }
        );

        canvas.addEventListener(
            'touchmove',
            draw, {
                passive: false
            }
        );


        /*
        |--------------------------------------------------------------------------
        | Clear
        |--------------------------------------------------------------------------
        */

        clearBtn.addEventListener('click', function() {

            ctx.clearRect(
                0,
                0,
                canvas.width,
                canvas.height
            );

            signatureInput.value = '';

        });

    });
</script>

@endsection