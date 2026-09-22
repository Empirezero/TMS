@extends('layouts.admin')

@section('content')

<div class="pagetitle">
    <h1>Vehicle Requests</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Vehicle Requests</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    @if (session('success'))
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="bi bi-check-circle me-2"></i>
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">All Requests</h5>
                        <a href="{{ route('vehiclerequests.create') }}" class="btn btn-success">
                            <i class="bi bi-plus-lg me-1"></i> New Request
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Requestor</th>
                                    <th>Activity</th>
                                    <th>Dates</th>
                                    <th>Participants</th>
                                    <th>Transport Mode</th>
                                    <th>Status</th>
                                    <th>Assigned By</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($requests as $req)
                                <tr>
                                    <td>{{ $req->requestor->name }}</td>
                                    <td>{{ $req->activity_name }}</td>
                                    <td>
                                        {{ $req->start_date }} → {{ $req->end_date }}<br>
                                        <small class="text-muted">{{ $req->days }} day(s)</small>
                                    </td>
                                    <td>{{ $req->participants }}</td>
                                    <td>
                                        @if($req->transport_mode == 'taxi')
                                        <span class="badge bg-warning-subtle text-warning">Fare/Taxi</span>
                                        @elseif($req->transport_mode === 'vehicle')
                                        <span class="badge bg-primary-subtle text-primary">Vehicle Assigned</span>
                                        @else
                                        <span class="badge bg-secondary-subtle text-secondary">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($req->status == 'pending')
                                        <span class="badge bg-danger-subtle text-danger">Pending</span>
                                        @elseif($req->status === 'approved')
                                        <span class="badge bg-warning-subtle text-warning">Approved</span>
                                        @elseif($req->status === 'completed')
                                        <span class="badge bg-success-subtle text-success">Completed</span>
                                        @endif
                                    </td>
                                    <td>{{ $req->assignedBy->name ?? '—' }}</td>
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end align-items-center gap-2">
                                            <a href="{{ route('vehiclerequests.show', $req) }}" class="btn btn-sm btn-outline-primary" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            @if($req->status == 'pending' && in_array(Auth::user()->role, ['system_admin', 'transport_officer']))
                                            <a href="{{ route('vehiclerequests.assignForm', $req) }}" class="btn btn-sm btn-outline-success" title="Assign Vehicle">
                                                <i class="bi bi-truck me-1"></i> Assign
                                            </a>
                                            @endif

                                            {{-- <form action="{{ route('vehiclerequests.destroy', $req) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this request?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            </form> --}}
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">No requests found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($requests->hasPages())
                    <div class="mt-3">
                        {{ $requests->links() }}
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>

@endsection