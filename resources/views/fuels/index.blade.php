
@extends('layouts.admin')

@section('content')

<div class="pagetitle">
    <h1>Fuel Logs</h1>

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('vehicles.index') }}">Vehicles</a>
            </li>
            <li class="breadcrumb-item active">
                Fuel Logs
            </li>
        </ol>
    </nav>
</div>

<section class="section">

    {{-- Page Header --}}
    <div class="d-flex flex-column flex-md-row justify-content-end  mb-4 gap-3">



        <a href="{{ route('fuels.create') }}"
            class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>
            Add Fuel Log
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
            aria-label="Close">
        </button>

    </div>

    @endif

    {{-- Fuel Logs --}}
    <div class="card">

        <div class="card-body">

            <h5 class="card-title">
                Fuel Records
            </h5>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>Vehicle</th>
                            <th>Driver</th>
                            <th>Date</th>
                            <th>Liters</th>
                            <th>Cost</th>
                            <th>Station</th>
                            <th>Receipt</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($fuelLogs as $fuel)

                        <tr>

                            {{-- Vehicle --}}
                            <td>
                                <strong>
                                    {{ $fuel->vehicle->plate_number }}
                                </strong>
                            </td>

                            {{-- Driver --}}
                            <td>
                                {{ $fuel->user->name }}
                            </td>

                            {{-- Date --}}
                            <td>
                                {{ $fuel->date }}
                            </td>

                            {{-- Liters --}}
                            <td>
                                {{ $fuel->liters }}
                            </td>

                            {{-- Cost --}}
                            <td>
                                @if($fuel->cost)
                                <span class="fw-semibold">
                                    KES {{ number_format($fuel->cost, 2) }}
                                </span>
                                @else
                                <span class="text-muted">—</span>
                                @endif
                            </td>

                            {{-- Station --}}
                            <td>
                                {{ $fuel->station ?? '—' }}
                            </td>

                            {{-- Receipt --}}
                            <td>

                                @if($fuel->receipt)

                                <a href="{{ asset('storage/' . $fuel->receipt) }}"
                                    target="_blank"
                                    class="btn btn-sm btn-outline-primary">

                                    <i class="bi bi-receipt me-1"></i>
                                    View Receipt

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

                            <td colspan="7" class="text-center py-5">

                                <div class="text-muted">

                                    <i class="bi bi-fuel-pump fs-2 d-block mb-2"></i>

                                    No fuel logs found.

                                </div>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</section>

@endsection