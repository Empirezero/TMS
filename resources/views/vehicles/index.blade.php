
@extends('layouts.admin')

@section('content')

<div class="pagetitle">
    <div class="d-flex justify-content-between align-items-center">

        <div>
            <h1>Vehicles</h1>

            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Vehicles</li>
                </ol>
            </nav>
        </div>

        <div>
            <a href="{{ route('vehicles.create') }}"
                class="btn btn-success">

                <i class="bi bi-plus-lg me-1"></i>
                Register Vehicle

            </a>
        </div>

    </div>
</div>


<section class="section">

    <div class="card">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h5 class="card-title mb-0">
                    Registered Vehicles
                </h5>

                <span class="badge bg-primary">
                    {{ $vehicles->total() }} Vehicles
                </span>

            </div>


            @if ($vehicles->isEmpty())

            {{-- Empty State --}}
            <div class="text-center py-5">

                <div class="mb-3">
                    <i class="bi bi-car-front fs-1 text-muted"></i>
                </div>

                <h5 class="text-muted">
                    No vehicles registered yet.
                </h5>

                <p class="text-muted mb-3">
                    Start by registering your first vehicle.
                </p>

                <a href="{{ route('vehicles.create') }}"
                    class="btn btn-primary">

                    <i class="bi bi-plus-lg me-1"></i>
                    Register Vehicle

                </a>

            </div>

            @else

            {{-- Vehicles Table --}}
            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>
                        <tr>

                            <th>
                                Plate & Identity
                            </th>

                            <th>
                                Make / Model
                            </th>

                            <th>
                                Assigned Driver
                            </th>

                            <th>
                                Status
                            </th>

                            <th class="text-end">
                                Actions
                            </th>

                        </tr>
                    </thead>


                    <tbody>

                        @foreach ($vehicles as $vehicle)

                        <tr>


                            <td>

                                <div class="fw-bold">
                                    {{ $vehicle->plate_number }}
                                </div>



                            </td>


                            {{-- Make / Model --}}
                            <td>

                                <span class="fw-semibold">
                                    {{ $vehicle->make }}
                                </span>

                                {{ $vehicle->model }}

                            </td>


                            {{-- Assigned Driver --}}
                            <td>

                                @if ($vehicle->current_driver)

                                <div class="d-flex align-items-center">

                                    <div class="rounded-circle bg-primary-subtle text-primary
                                                        d-flex align-items-center justify-content-center
                                                        fw-bold me-2"
                                        style="width: 36px; height: 36px;">

                                        {{ strtoupper(substr($vehicle->current_driver->name, 0, 1)) }}

                                    </div>

                                    <span class="fw-medium">
                                        {{ $vehicle->current_driver->name }}
                                    </span>

                                </div>

                                @else

                                <span class="text-muted fst-italic">
                                    Not Assigned
                                </span>

                                @endif

                            </td>


                            {{-- Status --}}
                            <td>

                                @if ($vehicle->status === 'active')

                                <span class="badge bg-success-subtle text-success">

                                    <i class="bi bi-circle-fill me-1"
                                        style="font-size: 7px;">
                                    </i>

                                    Available

                                </span>

                                @else

                                <span class="badge bg-danger-subtle text-danger">

                                    <i class="bi bi-circle-fill me-1"
                                        style="font-size: 7px;">
                                    </i>

                                    Off-Road

                                </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td class="text-end">

                                <div class="d-flex justify-content-end
                                                align-items-center gap-2">


                                    {{-- View --}}
                                    <a href="{{ route('vehicles.show', $vehicle) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        title="View Details">

                                        <i class="bi bi-eye"></i>

                                    </a>


                                    {{-- Driver Assignment --}}
                                    @if ($vehicle->current_driver)

                                    <form method="POST"
                                        action="{{ route('vehicles.unassign', $vehicle) }}"
                                        class="d-inline">

                                        @csrf
                                        @method('PATCH')

                                        <button type="submit"
                                            class="btn btn-sm btn-outline-warning"
                                            onclick="return confirm('Unassign current driver?')"
                                            title="Unassign Driver">

                                            <i class="bi bi-person-dash me-1"></i>
                                            Unassign

                                        </button>

                                    </form>

                                    @else

                                    <a href="{{ route('vehicledrivers.edit', $vehicle) }}"
                                        class="btn btn-sm btn-outline-success"
                                        title="Assign Driver">

                                        <i class="bi bi-person-plus me-1"></i>
                                        Assign Driver

                                    </a>

                                    @endif


                                    {{-- Status Toggle --}}
                                    <form method="POST"
                                        action="{{ route('vehicles.toggleStatus', $vehicle) }}"
                                        class="d-inline">

                                        @csrf
                                        @method('PATCH')

                                        @if ($vehicle->status === 'active')

                                        <button type="submit"
                                            class="btn btn-sm btn-outline-secondary"
                                            title="Mark Vehicle Down">

                                            <i class="bi bi-pause-circle me-1"></i>
                                            Mark Down

                                        </button>

                                        @else

                                        <button type="submit"
                                            class="btn btn-sm btn-outline-primary"
                                            title="Enable Vehicle">

                                            <i class="bi bi-play-circle me-1"></i>
                                            Enable

                                        </button>

                                        @endif

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            @if ($vehicles->hasPages())

            <div class="mt-3">

                {{ $vehicles->links() }}

            </div>

            @endif

            @endif

        </div>

    </div>

</section>

@endsection
