@extends('layouts.admin')

@section('content')

<div class="pagetitle">
    <h1>Service Records</h1>

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item">Vehicle Management</li>
            <li class="breadcrumb-item active">Service Records</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">

        <div class="col-lg-12">

            <div class="card">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <div>
                            <h5 class="card-title mb-1">
                                Service Records
                            </h5>

                            <p class="text-muted mb-0">
                                Vehicle maintenance and service history
                            </p>
                        </div>

                        <a href="{{ route('services.create') }}"
                            class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i>
                            Add Service Record
                        </a>

                    </div>

                    {{-- Success Message --}}
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ session('success') }}

                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                    @endif

                    {{-- Error Message --}}
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-1"></i>
                        {{ session('error') }}

                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="table-responsive">

                        <table class="table table-hover datatable">

                            <thead>
                                <tr>
                                    <th>Ref. Number</th>
                                    <th>Vehicle</th>
                                    <th>Service Type</th>
                                    <th>Service Date</th>
                                    <th class="text-end">Cost (KES)</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($services as $service)

                                <tr>

                                    {{-- Reference Number --}}
                                    <td>
                                        <span class="badge bg-primary">
                                            {{ $service->reference_number }}
                                        </span>
                                    </td>

                                    {{-- Vehicle --}}
                                    <td>
                                        <div class="fw-bold">
                                            {{ $service->vehicle->plate_number }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $service->vehicle->make }}
                                            {{ $service->vehicle->model }}
                                        </small>
                                    </td>

                                    {{-- Service Type --}}
                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ $service->type }}
                                        </span>
                                    </td>

                                    {{-- Service Date --}}
                                    <td>
                                        <i class="bi bi-calendar3 me-1"></i>

                                        {{ \Carbon\Carbon::parse($service->service_date)->format('M d, Y') }}
                                    </td>

                                    {{-- Cost --}}
                                    <td class="text-end">

                                        @if($service->cost)
                                        <span class="fw-bold">
                                            KES {{ number_format($service->cost, 2) }}
                                        </span>
                                        @else
                                        <span class="text-muted">
                                            —
                                        </span>
                                        @endif

                                    </td>

                                </tr>

                                @empty

                                <tr>
                                    <td colspan="5" class="text-center py-5">

                                        <div class="mb-3">
                                            <i class="bi bi-clipboard-x"
                                                style="font-size: 3rem;"></i>
                                        </div>

                                        <h5>No Service Records Found</h5>

                                        <p class="text-muted mb-3">
                                            There are currently no service records available.
                                        </p>

                                        <a href="{{ route('services.create') }}"
                                            class="btn btn-primary">
                                            <i class="bi bi-plus-circle"></i>
                                            Add Service Record
                                        </a>

                                    </td>
                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

@endsection
