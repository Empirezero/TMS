
@extends('layouts.admin')

@section('content')

<div class="pagetitle">
    <h1>Vehicle Inspections</h1>

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('vehicles.index') }}">Vehicles</a>
            </li>
            <li class="breadcrumb-item active">
                Inspections
            </li>
        </ol>
    </nav>
</div>

<section class="section">

    {{-- Header --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">

        <div>
            <h5 class="mb-1">Vehicle Inspections</h5>
            <p class="text-muted mb-0">
                Annual license inspection records for the fleet.
            </p>
        </div>

        @if(in_array(Auth::user()->role, ['system_admin', 'transport_officer']))
        <a href="{{ route('inspections.create') }}"
            class="btn btn-primary">

            <i class="bi bi-plus-circle me-1"></i>
            New Inspection

        </a>
        @endif

    </div>

    {{-- Success Message --}}
    @if(session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">

        <i class="bi bi-check-circle me-1"></i>
        {{ session('status') }}

        <button type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close">
        </button>

    </div>
    @endif

    {{-- Inspections Table --}}
    <div class="card">

        <div class="card-body">

            <h5 class="card-title">
                Inspection Records
            </h5>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>Vehicle</th>
                            <th>Certificate</th>
                            <th>Inspected On</th>
                            <th>Expires</th>
                            <th>Status</th>
                            <th>Inspector</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($inspections as $inspection)

                        <tr>

                            {{-- Vehicle --}}
                            <td>
                                <strong>
                                    {{ $inspection->vehicle->plate_number }}
                                </strong>
                            </td>

                            {{-- Certificate --}}
                            <td>
                                @if($inspection->certificate_file)

                                <span class="badge bg-success">
                                    <i class="bi bi-paperclip"></i>
                                    Attached
                                </span>

                                @else

                                <span class="text-muted">
                                    —
                                </span>

                                @endif
                            </td>

                            {{-- Inspection Date --}}
                            <td>
                                {{ $inspection->inspection_date->format('M d, Y') }}
                            </td>

                            {{-- Expiry Date --}}
                            <td>
                                {{ $inspection->expiry_date->format('M d, Y') }}
                            </td>

                            {{-- Status --}}
                            <td>

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

                            </td>

                            {{-- Inspector --}}
                            <td>
                                {{ $inspection->inspector?->name ?? '—' }}
                            </td>

                            {{-- Actions --}}
                            <td class="text-end">

                                <div class="btn-group" role="group">

                                    {{-- View --}}
                                    <a href="{{ route('inspections.show', $inspection) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        title="View Inspection">

                                        <i class="bi bi-eye"></i>

                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('inspections.edit', $inspection) }}"
                                        class="btn btn-sm btn-outline-secondary"
                                        title="Edit Inspection">

                                        <i class="bi bi-pencil"></i>

                                    </a>

                                    {{-- Delete --}}
                                    @if(in_array(Auth::user()->role, ['system_admin', 'transport_officer']))

                                    <form method="POST"
                                        action="{{ route('inspections.destroy', $inspection) }}"
                                        class="d-inline"
                                        onsubmit="return confirm('Delete this inspection record? This cannot be undone.');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Delete Inspection">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7" class="text-center py-5">

                                <div class="text-muted">

                                    <i class="bi bi-clipboard-x fs-2 d-block mb-2"></i>

                                    No inspection records yet.

                                </div>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    {{-- Pagination --}}
    @if($inspections->hasPages())

    <div class="mt-4">
        {{ $inspections->links() }}
    </div>

    @endif

</section>

@endsection
