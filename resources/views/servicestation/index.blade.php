@extends('layouts.admin')

@section('content')
<div class="pagetitle">
    <h1>Service Stations</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Service Stations</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title mb-0">All Service Stations</h5>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addStationModal">
                    <i class="bi bi-plus-lg"></i> Add Service Station
                </button>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($servicestation as $station)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $station->name }}</td>
                        <td>
                            @if($station->deleted_at)
                            <span class="badge bg-danger">Deleted</span>
                            @else
                            <span class="badge bg-success">Active</span>
                            @endif
                        </td>
                        <td class="text-end">
                            @if(!$station->deleted_at)
                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editStationModal{{ $station->id }}">
                                Edit
                            </button>
                            <form action="{{ route('servicestations.destroy', $station) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this service station?');">Delete</button>
                            </form>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editStationModal{{ $station->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('servicestations.update', $station) }}" method="POST">
                                            @csrf @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Service Station</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <label class="form-label">Service Station Name</label>
                                                <input type="text" name="name" value="{{ old('name', $station->name) }}" class="form-control" required>
                                                @error('name')
                                                <p class="text-danger small mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @else
                            <form action="{{ route('servicestations.restore', $station->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">Restore</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">No service stations found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</section>

<!-- Add Modal -->
<div class="modal fade" id="addStationModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('servicestations.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Service Station</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label">Service Station Name</label>
                    <input type="text" name="name" class="form-control" required>
                    @error('name')
                    <p class="text-danger small mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection