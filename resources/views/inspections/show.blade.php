
@extends('layouts.admin')

@section('content')

<div class="pagetitle">

    <h1>
        Inspection — {{ $inspection->vehicle->plate_number }}
    </h1>

    <nav>
        <ol class="breadcrumb">

            <li class="breadcrumb-item">
                <a href="{{ route('inspections.index') }}">
                    Inspections
                </a>
            </li>

            <li class="breadcrumb-item active">
                {{ $inspection->vehicle->plate_number }}
            </li>

        </ol>
    </nav>

</div>

<section class="section">

    <div class="row justify-content-center">


        {{-- Header Actions --}}
        <div class="d-flex justify-content-between align-items-center mb-3">

            <div>
                <h5 class="mb-1">
                    Inspection Details
                </h5>

                <p class="text-muted mb-0">
                    Vehicle inspection and annual license information.
                </p>
            </div>

            <div class="d-flex gap-2">

                <a href="{{ route('inspections.index') }}"
                    class="btn btn-outline-secondary btn-sm">

                    <i class="bi bi-arrow-left me-1"></i>
                    Back

                </a>

                @if(in_array(Auth::user()->role, ['system_admin', 'transport_officer']))

                <form method="POST"
                    action="{{ route('inspections.destroy', $inspection) }}"
                    onsubmit="return confirm('Delete this inspection record? This cannot be undone.');">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="btn btn-outline-danger btn-sm">

                        <i class="bi bi-trash me-1"></i>
                        Delete

                    </button>

                </form>

                @endif

            </div>

        </div>

        {{-- Inspection Card --}}
        <div class="card">

            <div class="card-body">

                <h5 class="card-title">
                    Inspection Information
                </h5>

                <div class="row g-4">

                    {{-- Vehicle --}}
                    <div class="col-md-6">

                        <div class="text-muted small mb-1">
                            Vehicle
                        </div>

                        <div class="fw-semibold">
                            {{ $inspection->vehicle->make }}
                            {{ $inspection->vehicle->model }}
                        </div>

                        <div class="text-muted">
                            {{ $inspection->vehicle->plate_number }}
                        </div>

                    </div>

                    {{-- Certificate --}}
                    <div class="col-md-6">

                        <div class="text-muted small mb-1">
                            Certificate
                        </div>

                        @if($inspection->certificate_file)

                        <a href="{{ Storage::url($inspection->certificate_file) }}"
                            target="_blank"
                            class="btn btn-sm btn-outline-primary">

                            <i class="bi bi-file-earmark-text me-1"></i>
                            View Certificate

                        </a>

                        @else

                        <span class="text-muted">
                            Not uploaded
                        </span>

                        @endif

                    </div>

                    {{-- Inspection Date --}}
                    <div class="col-md-6">

                        <div class="text-muted small mb-1">
                            Inspection Date
                        </div>

                        <div class="fw-semibold">
                            {{ $inspection->inspection_date->format('M d, Y') }}
                        </div>

                    </div>

                    {{-- Expiry Date --}}
                    <div class="col-md-6">

                        <div class="text-muted small mb-1">
                            Expiry Date
                        </div>

                        <div class="fw-semibold">
                            {{ $inspection->expiry_date->format('M d, Y') }}
                        </div>

                    </div>

                    {{-- Status --}}
                    <div class="col-md-6">

                        <div class="text-muted small mb-1">
                            Status
                        </div>

                        @if($inspection->effective_status === 'valid')

                        <span class="badge bg-success">
                            {{ $inspection->effective_status }}
                        </span>

                        @elseif($inspection->effective_status === 'expired')

                        <span class="badge bg-danger">
                            {{ $inspection->effective_status }}
                        </span>

                        @elseif($inspection->effective_status === 'pending')

                        <span class="badge bg-warning text-dark">
                            {{ $inspection->effective_status }}
                        </span>

                        @else

                        <span class="badge bg-secondary">
                            {{ $inspection->effective_status }}
                        </span>

                        @endif

                    </div>

                    {{-- Inspector --}}
                    <div class="col-md-6">

                        <div class="text-muted small mb-1">
                            Inspector
                        </div>

                        <div class="fw-semibold">
                            {{ $inspection->inspector?->name ?? '—' }}
                        </div>

                    </div>

                </div>

                {{-- Notes --}}
                @if($inspection->notes)

                <hr class="my-4">

                <div>

                    <h6 class="fw-semibold mb-2">
                        <i class="bi bi-chat-left-text me-1"></i>
                        Notes
                    </h6>

                    <div class="bg-light rounded p-3 text-muted">
                        {{ $inspection->notes }}
                    </div>

                </div>

                @endif

            </div>

        </div>



    </div>

</section>

@endsection
