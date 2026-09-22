@extends('layouts.admin')

@section('content')

<div class="pagetitle">
    <h1>Review & Approve Service Request</h1>

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('servicerequests.index') }}">
                    Service Requests
                </a>
            </li>
            <li class="breadcrumb-item active">
                Review & Approve
            </li>
        </ol>
    </nav>
</div>

<section class="section">

    {{-- Validation Errors --}}
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h5 class="alert-heading">
            <i class="bi bi-exclamation-triangle"></i>
            Please correct the following errors:
        </h5>

        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>

        <button type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close">
        </button>
    </div>
    @endif


    {{-- Request Details --}}
    <div class="card">

        <div class="card-body">

            <h5 class="card-title">
                <i class="bi bi-file-text"></i>
                Service Request Details
            </h5>

            <div class="row">

                {{-- Reference Number --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        Reference Number
                    </label>
                    <div class="form-control-plaintext">
                        {{ $serviceRequest->reference_no }}
                    </div>
                </div>

                {{-- Request Date --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        Request Date
                    </label>
                    <div class="form-control-plaintext">
                        {{ $serviceRequest->request_date }}
                    </div>
                </div>

                {{-- Registration --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        Registration No
                    </label>
                    <div class="form-control-plaintext">
                        {{ $serviceRequest->reg_no }}
                    </div>
                </div>

                {{-- Make --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        Make
                    </label>
                    <div class="form-control-plaintext">
                        {{ $serviceRequest->make }}
                    </div>
                </div>

                {{-- Model --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        Model
                    </label>
                    <div class="form-control-plaintext">
                        {{ $serviceRequest->model }}
                    </div>
                </div>

                {{-- Engine CC --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        Engine CC
                    </label>
                    <div class="form-control-plaintext">
                        {{ $serviceRequest->engine_cc }}
                    </div>
                </div>

                {{-- Fuel Type --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        Fuel Type
                    </label>
                    <div class="form-control-plaintext">
                        {{ $serviceRequest->fuel_type }}
                    </div>
                </div>

                {{-- Previous KM --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        Previous KM
                    </label>
                    <div class="form-control-plaintext">
                        {{ $serviceRequest->previous_km }}
                    </div>
                </div>

                {{-- Current KM --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        Current KM
                    </label>
                    <div class="form-control-plaintext">
                        {{ $serviceRequest->current_km }}
                    </div>
                </div>

                {{-- Assigned Driver --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        Assigned Driver
                    </label>
                    <div class="form-control-plaintext">
                        {{ $serviceRequest->assigned_driver }}
                    </div>
                </div>

                {{-- Service Type --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        Service Type
                    </label>
                    <div class="form-control-plaintext">
                        {{ $serviceRequest->service_type }}
                    </div>
                </div>

                {{-- Service Type Details --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        Service Type Details
                    </label>
                    <div class="form-control-plaintext">
                        {{ $serviceRequest->service_type_other ?? 'N/A' }}
                    </div>
                </div>

                {{-- Vehicle Drivable --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        Vehicle Drivable
                    </label>

                    @if($serviceRequest->vehicle_drivable)
                    <span class="badge bg-success">
                        Yes
                    </span>
                    @else
                    <span class="badge bg-danger">
                        No
                    </span>
                    @endif
                </div>

                {{-- Warning Lights --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        Warning Lights
                    </label>

                    @if($serviceRequest->warning_lights)
                    <span class="badge bg-danger">
                        Yes
                    </span>
                    @else
                    <span class="badge bg-success">
                        No
                    </span>
                    @endif
                </div>

                {{-- Body Damage --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        Body Damage
                    </label>

                    @if($serviceRequest->body_damage)
                    <span class="badge bg-danger">
                        Yes
                    </span>
                    @else
                    <span class="badge bg-success">
                        No
                    </span>
                    @endif
                </div>

                {{-- Fluid Leaks --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        Fluid Leaks
                    </label>

                    @if($serviceRequest->fluid_leaks)
                    <span class="badge bg-danger">
                        Yes
                    </span>
                    @else
                    <span class="badge bg-success">
                        No
                    </span>
                    @endif
                </div>

                {{-- Tyre Condition --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        Tyre Condition
                    </label>

                    <div class="form-control-plaintext">
                        {{ $serviceRequest->tyre_condition }}
                    </div>
                </div>

                {{-- Driver Name --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        Driver Name
                    </label>

                    <div class="form-control-plaintext">
                        {{ $serviceRequest->driver_name }}
                    </div>
                </div>

                {{-- Driver Date --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        Driver Date
                    </label>

                    <div class="form-control-plaintext">
                        {{ $serviceRequest->driver_date }}
                    </div>
                </div>

            </div>


            {{-- Description --}}
            <div class="mt-3">

                <label class="form-label fw-bold">
                    Description
                </label>

                <div class="border rounded p-3 bg-light">
                    {{ $serviceRequest->description ?? 'N/A' }}
                </div>

            </div>


            {{-- Driver Signature --}}
            <div class="mt-4">

                <label class="form-label fw-bold">
                    Driver Signature
                </label>

                @if($serviceRequest->driver_signature)

                <div class="mt-2">
                    <img
                        src="{{ $serviceRequest->driver_signature }}"
                        alt="Driver Signature"
                        class="border rounded bg-white p-2"
                        style="max-width: 350px; height: 120px; object-fit: contain;">
                </div>

                @else

                <div class="alert alert-warning mt-2">
                    <i class="bi bi-exclamation-triangle"></i>
                    No signature provided.
                </div>

                @endif

            </div>

        </div>

    </div>


    {{-- Approval Section --}}
    @if($serviceRequest->status === 'pending')

    <div class="card">

        <div class="card-body">

            <h5 class="card-title">
                <i class="bi bi-check2-square"></i>
                Approval Section
            </h5>

            <form method="POST"
                action="{{ route('servicerequests.approve', $serviceRequest) }}">

                @csrf
                @method('PUT')

                <input type="hidden"
                    name="action"
                    value="approve">


                {{-- Inspection Findings --}}
                <div class="mb-4">

                    <label for="inspection_findings"
                        class="form-label fw-bold">

                        Inspection Findings and Recommendations:
                    </label>

                    <textarea
                        name="inspection_findings"
                        id="inspection_findings"
                        rows="5"
                        class="form-control @error('inspection_findings') is-invalid @enderror"
                        placeholder="Enter inspection findings or recommendations...">{{ old('inspection_findings', $serviceRequest->inspection_findings) }}</textarea>

                    @error('inspection_findings')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                </div>


                {{-- Approval Signature --}}
                <div class="mb-4">

                    <label class="form-label fw-bold">
                        Transport Officer Signature:
                    </label>

                    <div class="signature-wrapper border rounded bg-white">

                        <canvas
                            id="approval-canvas"
                            class="w-100"
                            style="height: 200px; touch-action: none;"></canvas>

                    </div>

                    <input
                        type="hidden"
                        name="approver_signature"
                        id="approval_signature">

                    <button
                        type="button"
                        id="clear-approval"
                        class="btn btn-outline-danger btn-sm mt-2">
                        <i class="bi bi-eraser"></i>
                        Clear Signature
                    </button>

                </div>


                {{-- Action Buttons --}}
                <div class="d-flex justify-content-end gap-2 mt-4">

                    <a
                        href="{{ route('servicerequests.index') }}"
                        class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i>
                        Cancel
                    </a>

                    <button
                        type="submit"
                        name="action"
                        value="reject"
                        class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to reject this service request?');">
                        <i class="bi bi-x-circle"></i>
                        Reject
                    </button>

                    <button
                        type="submit"
                        name="action"
                        value="approve"
                        class="btn btn-success">
                        <i class="bi bi-check-circle"></i>
                        Approve
                    </button>

                </div>

            </form>

        </div>

    </div>

    @else

    {{-- Already Processed --}}
    <div class="card">

        <div class="card-body">

            <h5 class="card-title">
                <i class="bi bi-info-circle"></i>
                Request Status
            </h5>

            <div class="alert
                    {{ $serviceRequest->status === 'approved'
                        ? 'alert-success'
                        : 'alert-danger' }}
                ">

                <strong>Status:</strong>

                @if($serviceRequest->status === 'approved')

                <span class="badge bg-success ms-2">
                    Approved
                </span>

                @else

                <span class="badge bg-danger ms-2">
                    {{ ucfirst($serviceRequest->status) }}
                </span>

                @endif

            </div>


            {{-- Approver Signature --}}
            @if($serviceRequest->approver_signature)

            <div class="mt-4">

                <label class="form-label fw-bold">
                    Approver Signature
                </label>

                <div>
                    <img
                        src="{{ $serviceRequest->approver_signature }}"
                        alt="Approver Signature"
                        class="border rounded bg-white p-2"
                        style="max-width: 350px; height: 120px; object-fit: contain;">
                </div>

            </div>

            @endif

        </div>

    </div>

    @endif


    {{-- Back to List --}}
    <div class="mb-4">

        <a
            href="{{ route('servicerequests.index') }}"
            class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i>
            Back to Service Requests
        </a>

    </div>

</section>


{{-- Signature Script --}}
@push('scripts')

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const canvas = document.getElementById('approval-canvas');

        if (!canvas) {
            return;
        }

        const input = document.getElementById('approval_signature');
        const clearBtn = document.getElementById('clear-approval');
        const ctx = canvas.getContext('2d');

        let drawing = false;

        function resizeCanvas() {

            const rect = canvas.getBoundingClientRect();

            canvas.width = rect.width;
            canvas.height = rect.height;

            ctx.lineWidth = 2;
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';

        }

        resizeCanvas();

        window.addEventListener('resize', resizeCanvas);


        function getPosition(e) {

            const rect = canvas.getBoundingClientRect();

            if (e.touches && e.touches.length > 0) {

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

            const position = getPosition(e);

            ctx.beginPath();
            ctx.moveTo(position.x, position.y);

        }


        function draw(e) {

            if (!drawing) {
                return;
            }

            e.preventDefault();

            const position = getPosition(e);

            ctx.lineTo(position.x, position.y);
            ctx.stroke();

            ctx.beginPath();
            ctx.moveTo(position.x, position.y);

        }


        function endPosition(e) {

            if (!drawing) {
                return;
            }

            e.preventDefault();

            drawing = false;

            ctx.beginPath();

            input.value = canvas.toDataURL('image/png');

        }


        // Mouse events
        canvas.addEventListener('mousedown', startPosition);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', endPosition);
        canvas.addEventListener('mouseleave', endPosition);


        // Touch events
        canvas.addEventListener('touchstart', startPosition, {
            passive: false
        });

        canvas.addEventListener('touchmove', draw, {
            passive: false
        });

        canvas.addEventListener('touchend', endPosition, {
            passive: false
        });


        // Clear signature
        clearBtn.addEventListener('click', function() {

            ctx.clearRect(
                0,
                0,
                canvas.width,
                canvas.height
            );

            input.value = '';

        });

    });
</script>

@endpush

@endsection
```