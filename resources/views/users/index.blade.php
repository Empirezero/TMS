
@extends('layouts.admin')

@section('content')

<div class="pagetitle">
    <h1>Users</h1>

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Users</li>
        </ol>
    </nav>
</div>

<section class="section">




    <div class="card">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h5 class="card-title mb-0">
                    <i class="bi bi-people"></i>
                    System Users
                </h5>


                <a href="{{ route('users.create') }}"
                    class="btn btn-success">
                    <i class="bi bi-person-plus me-1"></i>
                    Add User

                </a>

            </div>



            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>
                            <th class="text-center">No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>

                    </thead>


                    <tbody>

                        @forelse($users as $user)

                        <tr>

                            <td class="text-center">
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <strong>
                                    {{ $user->name }}
                                </strong>
                            </td>

                            <td>
                                {{ $user->email }}
                            </td>

                            <td>

                                @switch($user->role)

                                @case('system_admin')
                                <span class="badge bg-danger">
                                    System Admin
                                </span>
                                @break

                                @case('transport_officer')
                                <span class="badge bg-primary">
                                    Transport Officer
                                </span>
                                @break

                                @case('driver')
                                <span class="badge bg-warning text-dark">
                                    Driver
                                </span>
                                @break

                                @default
                                <span class="badge bg-secondary">
                                    Staff
                                </span>

                                @endswitch

                            </td>


                            {{-- Status --}}
                            <td class="text-center">

                                @if($user->deleted_at)

                                <span class="badge bg-danger">
                                    <i class="bi bi-x-circle"></i>
                                    Deleted
                                </span>

                                @else

                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle"></i>
                                    Active
                                </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td class="text-center">

                                @if(!$user->deleted_at)

                                {{-- EDIT --}}
                                <a href="{{ route('users.edit', $user) }}"
                                    class="btn btn-sm btn-primary"
                                    title="Edit User">

                                    <i class="bi bi-pencil"></i>
                                    Edit User

                                </a>


                                {{-- DELETE --}}
                                <form
                                    action="{{ route('users.destroy', $user) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this user?');">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                        Delete
                                    </button>

                                </form>

                                @else

                                {{-- RESTORE --}}
                                <form
                                    action="{{ route('users.restore', $user->id) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-success">
                                        <i class="bi bi-arrow-counterclockwise"></i>
                                        Restore
                                    </button>

                                </form>

                                @endif

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="6"
                                class="text-center py-4 text-muted">

                                <i class="bi bi-people fs-2 d-block mb-2"></i>

                                No users found.

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
