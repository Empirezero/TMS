@extends('layouts.admin')

@section('content')
<div class="pagetitle">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Vehicle Profile:<span class="text-danger">{{ $vehicle->plate_number }}</span></h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"> Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('vehicles.index') }}">Vehicles</a></li>
                    <li class="breadcrumb-item active"> {{ $vehicle->plate_number }}</li>
                </ol>
            </nav>
        </div>

        <div>
            <a href="{{ route('vehicles.index') }}" class="btn btn-danger"><i class="bi bi-arrow-left me-1"></i> Back to Fleet </a>
        </div>
    </div>
</div>

<section class="section">
    <div class="card mb-4">
        <div class="card-body">
            <div class="row align-items-center gy-4">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-3 bg-primary-subtle text-primary d-flex align-items-center justify-content-center me-3 mt-3" style="width:65px;height:65px;">
                            <i class="bi bi-truck fs-2"></i>
                        </div>
                        <div>
                            <small class="text-muted text-uppercase fw-bold">Make & Model</small>
                            <h4 class="mb-0 fw-bold"> {{ $vehicle->make }} {{ $vehicle->model }} </h4>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-2">
                    <small class="text-muted text-uppercase fw-bold"> Year</small>
                    <h5 class="fw-bold mb-0 mt-1">{{ $vehicle->year ?? 'N/A' }}</h5>
                </div>

                <div class="col-6 col-lg-2">
                    <small class="text-muted text-uppercase fw-bold">Capacity</small>
                    <h5 class="fw-bold mb-0 mt-1">{{ $vehicle->passengers ?? '—' }} <small class="text-muted">Pax</small></h5>
                </div>

                <div class="col-6 col-lg-2">
                    <small class="text-muted text-uppercase fw-bold">Plate Number</small>
                    <h5 class="fw-bold mb-0 mt-1 text-danger">{{ $vehicle->plate_number }}</h5>
                </div>

                <div class="col-6 col-lg-2 text-lg-end">
                    @if ($vehicle->status === 'active')
                    <span class="badge bg-success-subtle text-success px-3 py-2">
                        <i class="bi bi-circle-fill me-1" style="font-size:7px;"></i> ACTIVE
                    </span>
                    @else
                    <span class="badge bg-danger-subtle text-danger px-3 py-2">
                        <i class="bi bi-circle-fill me-1" style="font-size:7px;"></i>{{ strtoupper($vehicle->status) }}
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 col-xl-3 mb-3">
            <div class="card info-card sales-card h-100">
                <div class="card-body">
                    <h5 class="card-title">Fuel Spend</h5>
                    <div class="d-flex align-items-center">
                        <div class="class=" card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-fuel-pump"></i>
                        </div>
                        <div class="ps-3">
                            <h3 class="fw-bold">KES {{ number_format($totalFuelCost, 0) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 mb-3">
            <div class="card info-card revenue-card h-100">
                <div class="card-body">
                    <h5 class="card-title"> Liters Total</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-droplet"></i>
                        </div>
                        <div class="ps-3">
                            <h3 class="fw-bold">{{ number_format($totalLiters, 1) }} L</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 mb-3">
            <div class="card info-card customers-card h-100">
                <div class="card-body">
                    <h5 class="card-title">Service Spend</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-tools"></i>
                        </div>
                        <div class="ps-3">
                            <h3 class="fw-bold">KES {{ number_format($totalServiceCost, 0) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 mb-3">
            <div class="card info-card h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Costs</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                        <div class="ps-3">
                            <h3 class="fw-bold">KES {{ number_format($totalFuelCost + $totalServiceCost, 0) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body pt-3">
            <ul class="nav nav-tabs nav-tabs-bordered" id="vehicleHistoryTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="assignments-tab" data-bs-toggle="tab" data-bs-target="#assignments" type="button"
                        role="tab">

                        <i class="bi bi-person-check me-1"></i>
                        Assignments

                    </button>

                </li>


                <li class="nav-item"
                    role="presentation">

                    <button class="nav-link"
                        id="fuel-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#fuel"
                        type="button"
                        role="tab">

                        <i class="bi bi-fuel-pump me-1"></i>
                        Fuel Logs

                    </button>

                </li>


                <li class="nav-item"
                    role="presentation">

                    <button class="nav-link"
                        id="service-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#service"
                        type="button"
                        role="tab">

                        <i class="bi bi-tools me-1"></i>
                        Service History

                    </button>

                </li>

            </ul>


            <div class="tab-content pt-4"
                id="vehicleHistoryTabsContent">


                {{-- ================================================= --}}
                {{-- ASSIGNMENTS TAB --}}
                {{-- ================================================= --}}

                <div class="tab-pane fade show active"
                    id="assignments"
                    role="tabpanel"
                    aria-labelledby="assignments-tab">

                    <div class="d-flex justify-content-between
                                align-items-center mb-3">

                        <h5 class="card-title mb-0">
                            Driver Assignment History
                        </h5>

                    </div>


                    <div class="table-responsive">

                        <table class="table table-hover align-middle">

                            <thead>

                                <tr>

                                    <th>
                                        Driver Name
                                    </th>

                                    <th>
                                        Assigned Date
                                    </th>

                                    <th>
                                        Unassigned Date
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse($vehicle->assignments as $assignment)

                                <tr>

                                    <td>

                                        <div class="d-flex align-items-center">

                                            <div class="rounded-circle
                                                        bg-primary-subtle
                                                        text-primary
                                                        d-flex
                                                        align-items-center
                                                        justify-content-center
                                                        fw-bold me-2"
                                                style="width:36px;height:36px;">

                                                {{ strtoupper(substr($assignment->user->name, 0, 1)) }}

                                            </div>

                                            <span class="fw-semibold">
                                                {{ $assignment->user->name }}
                                            </span>

                                        </div>

                                    </td>


                                    <td>

                                        {{ \Carbon\Carbon::parse($assignment->assigned_at)->format('M d, Y') }}

                                    </td>


                                    <td>

                                        @if($assignment->unassigned_at)

                                        <span class="text-muted">

                                            {{ \Carbon\Carbon::parse($assignment->unassigned_at)->format('M d, Y') }}

                                        </span>

                                        @else

                                        <span class="badge bg-success-subtle text-success">

                                            Current Driver

                                        </span>

                                        @endif

                                    </td>

                                </tr>

                                @empty

                                <tr>

                                    <td colspan="3"
                                        class="text-center py-5">

                                        <i class="bi bi-person-x fs-1 text-muted"></i>

                                        <p class="text-muted mt-2 mb-0">
                                            No assignment history found.
                                        </p>

                                    </td>

                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- FUEL TAB --}}
                {{-- ================================================= --}}

                <div class="tab-pane fade"
                    id="fuel"
                    role="tabpanel"
                    aria-labelledby="fuel-tab">

                    <h5 class="card-title">
                        Refueling History
                    </h5>


                    <div class="table-responsive">

                        <table class="table table-hover align-middle">

                            <thead>

                                <tr>

                                    <th>
                                        Date
                                    </th>

                                    <th>
                                        Quantity
                                    </th>

                                    <th>
                                        Total Cost
                                    </th>

                                    <th>
                                        Station
                                    </th>

                                    <th class="text-end">
                                        Receipt
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse($vehicle->fuelLogs as $fuel)

                                <tr>

                                    <td>

                                        {{ \Carbon\Carbon::parse($fuel->date)->format('M d, Y') }}

                                    </td>


                                    <td class="fw-bold">

                                        {{ $fuel->liters }} Ltrs

                                    </td>


                                    <td class="fw-semibold text-success">

                                        KES {{ number_format($fuel->cost, 0) }}

                                    </td>


                                    <td>

                                        {{ $fuel->station ?? '—' }}

                                    </td>


                                    <td class="text-end">

                                        @if($fuel->receipt)

                                        <a href="{{ asset('storage/'.$fuel->receipt) }}"
                                            target="_blank"
                                            class="btn btn-sm btn-outline-primary">

                                            <i class="bi bi-file-earmark-text me-1"></i>
                                            View

                                        </a>

                                        @else

                                        <span class="text-muted">
                                            —
                                        </span>

                                        @endif

                                    </td>

                                </tr>

                                @empty

                                <tr>

                                    <td colspan="5"
                                        class="text-center py-5">

                                        <i class="bi bi-fuel-pump fs-1 text-muted"></i>

                                        <p class="text-muted mt-2 mb-0">
                                            No fuel logs recorded.
                                        </p>

                                    </td>

                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- SERVICE TAB --}}
                {{-- ================================================= --}}

                <div class="tab-pane fade"
                    id="service"
                    role="tabpanel"
                    aria-labelledby="service-tab">

                    <h5 class="card-title">
                        Maintenance & Repairs
                    </h5>


                    <div class="table-responsive">

                        <table class="table table-hover align-middle">

                            <thead>

                                <tr>

                                    <th>
                                        Date
                                    </th>

                                    <th>
                                        Description
                                    </th>

                                    <th>
                                        Service Notes
                                    </th>

                                    <th class="text-end">
                                        Cost
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse($vehicle->serviceLogs as $service)

                                <tr>

                                    <td>

                                        {{ \Carbon\Carbon::parse($service->service_date)->format('M d, Y') }}

                                    </td>


                                    <td>

                                        <span class="badge bg-primary-subtle text-primary text-uppercase">

                                            {{ $service->type }}

                                        </span>

                                    </td>


                                    <td>

                                        <span class="text-muted small">

                                            {{ Str::limit($service->notes, 50) }}

                                        </span>

                                    </td>


                                    <td class="text-end fw-bold">

                                        KES {{ number_format($service->cost, 0) }}

                                    </td>

                                </tr>

                                @empty

                                <tr>

                                    <td colspan="4"
                                        class="text-center py-5">

                                        <i class="bi bi-tools fs-1 text-muted"></i>

                                        <p class="text-muted mt-2 mb-0">
                                            No service history available.
                                        </p>

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
