@extends('layouts.admin')

@section('content')
<div class="pagetitle d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1>Service Requests</h1>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Service Requests</li>
            </ol>
        </nav>
    </div>

    <!-- New Request Action Button -->
    <a href="{{ route('servicerequests.create') }}" class="btn btn-success d-inline-flex align-items-center shadow-sm">
        <i class="bi bi-plus-lg me-1.5"></i> New Request
    </a>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

           
            <div class="card shadow-sm border-0">
                <div class="card-body pt-3">

                    <!-- Table Responsive Wrapper Container -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="py-3">Date</th>
                                    <th scope="col" class="py-3">Reference No</th>
                                    <th scope="col" class="py-3">Reg No</th>
                                    <th scope="col" class="py-3">Service Type</th>
                                    <th scope="col" class="py-3">Driver</th>
                                    <th scope="col" class="py-3 text-center">Status</th>
                                    <th scope="col" class="py-3 text-end pe-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($servicerequests as $request)
                                <tr>
                                    <td class="text-nowrap">
                                        {{ $request->created_at->format('Y-m-d') }}
                                    </td>
                                    <td class="fw-semibold text-secondary">
                                        {{ $request->reference_no }}
                                    </td>
                                    <td>
                                        {{ $request->reg_no }}
                                    </td>
                                    <td class="text-capitalize">
                                        {{ $request->service_type }}
                                    </td>
                                    <td>
                                        {{ $request->driver_name }}
                                    </td>
                                    <td class="text-center">
                                        @switch(strtolower($request->status))
                                        @case('pending')
                                        <span class="badge bg-warning-subtle text-warning text-uppercase px-2.5 py-1.5 fw-semibold" style="font-size: 11px;">
                                            Pending
                                        </span>
                                        @break
                                        @case('approved')
                                        <span class="badge bg-success-subtle text-success text-uppercase px-2.5 py-1.5 fw-semibold" style="font-size: 11px;">
                                            Approved
                                        </span>
                                        @break
                                        @default
                                        <span class="badge bg-danger-subtle text-danger text-uppercase px-2.5 py-1.5 fw-semibold" style="font-size: 11px;">
                                            Rejected
                                        </span>
                                        @endswitch
                                    </td>
                                    <td class="text-end pe-3">
                                        <div class="d-flex justify-content-end gap-1">

                                            <!-- View Action -->
                                            <a href="{{ route('servicerequests.show', $request) }}"
                                                class="btn btn-sm btn-light text-primary border-0"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="View Details">
                                                <i class="bi bi-eye fs-6"></i>
                                            </a>

                                            <!-- Edit Action (Only for Rejected) -->
                                            @if($request->status === 'rejected')
                                            <a href="{{ route('servicerequests.edit', $request) }}"
                                                class="btn btn-sm btn-light text-indigo border-0"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Edit Request"
                                                style="color: #6610f2;">
                                                <i class="bi bi-pencil fs-6"></i>
                                            </a>
                                            @endif

                                            <!-- Approve Action (Only for Pending) -->
                                            @if($request->status === 'pending')
                                            <a href="{{ route('servicerequests.openapproval', $request) }}"
                                                class="btn btn-sm btn-light text-success border-0"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Approve Request">
                                                <i class="bi bi-check-circle fs-6"></i>
                                            </a>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary opacity-50"></i>
                                        No service requests found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div><!-- End Table Responsive -->

                    <!-- Bootstrap 5 Pagination Wrapper -->
                    @if($servicerequests->hasPages())
                    <div class="d-flex justify-content-between align-items-center pt-3 mt-3 border-top">
                        <div class="text-muted small">
                            Showing {{ $servicerequests->firstItem() }} to {{ $servicerequests->lastItem() }} of {{ $servicerequests->total() }} entries
                        </div>
                        <div>
                            {{ $servicerequests->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                    @endif

                </div>
            </div><!-- End Card -->

        </div>
    </div>
</section>


@endsection