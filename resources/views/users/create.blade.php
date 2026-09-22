
@extends('layouts.admin')

@section('content')

<div class="pagetitle">
    <h1>Create User</h1>

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>

            <li class="breadcrumb-item">
                <a href="{{ route('users.index') }}">Users</a>
            </li>

            <li class="breadcrumb-item active">
                Create User
            </li>
        </ol>
    </nav>
</div>

<section class="section">

    <div class="row">

        <div class="col-lg-8">

            <div class="card">

                <div class="card-body">

                    <h5 class="card-title">
                        <i class="bi bi-person-plus me-2"></i>
                        User Information
                    </h5>

                    {{-- Validation Errors --}}
                    @if ($errors->any())

                    <div class="alert alert-danger">

                        <strong>
                            Please correct the following errors:
                        </strong>

                        <ul class="mb-0 mt-2">

                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                    @endif


                    <form action="{{ route('users.store') }}"
                        method="POST">

                        @csrf

                        {{-- Name --}}
                        <div class="mb-3">

                            <label for="name"
                                class="form-label">
                                Full Name
                            </label>

                            <input type="text"
                                id="name"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}"
                                required>

                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>


                        {{-- Email --}}
                        <div class="mb-3">

                            <label for="email"
                                class="form-label">
                                Email Address
                            </label>

                            <input type="email"
                                id="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                required>

                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>


                        {{-- Role --}}
                        <div class="mb-3">

                            <label for="role"
                                class="form-label">
                                Role
                            </label>

                            <select id="role"
                                name="role"
                                class="form-select @error('role') is-invalid @enderror"
                                required>

                                <option value="">
                                    Select Role
                                </option>

                                <option value="staff"
                                    {{ old('role') == 'staff' ? 'selected' : '' }}>
                                    Staff
                                </option>

                                <option value="driver"
                                    {{ old('role') == 'driver' ? 'selected' : '' }}>
                                    Driver
                                </option>

                                <option value="transport_officer"
                                    {{ old('role') == 'transport_officer' ? 'selected' : '' }}>
                                    Transport Officer
                                </option>

                                <option value="system_admin"
                                    {{ old('role') == 'system_admin' ? 'selected' : '' }}>
                                    System Administrator
                                </option>

                            </select>

                            @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>


                        {{-- Password --}}
                        <div class="mb-3">

                            <label for="password"
                                class="form-label">
                                Password
                            </label>

                            <input type="password"
                                id="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                required>

                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>


                        {{-- Confirm Password --}}
                        <div class="mb-4">

                            <label for="password_confirmation"
                                class="form-label">
                                Confirm Password
                            </label>

                            <input type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-control"
                                required>

                        </div>


                        {{-- Buttons --}}
                        <div class="d-flex justify-content-between">

                            <a href="{{ route('users.index') }}"
                                class="btn btn-secondary">

                                <i class="bi bi-arrow-left me-1"></i>
                                Cancel

                            </a>

                            <button type="submit"
                                class="btn btn-primary">

                                <i class="bi bi-person-plus me-1"></i>
                                Create User

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection
