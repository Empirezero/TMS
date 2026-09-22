
@extends('layouts.admin')

@section('content')

<div class="pagetitle">
    <h1>Assign Driver to Vehicle</h1>

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('vehicles.index') }}">Vehicles</a>
            </li>

            <li class="breadcrumb-item">
                <a href="{{ route('vehicles.show', $vehicle) }}">
                    {{ $vehicle->name }}
                </a>
            </li>

            <li class="breadcrumb-item active">
                Assign Driver
            </li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row justify-content-center">

        <div class="col-lg-7 col-md-9">

            <div class="card">
                <div class="card-body">

                    <h5 class="card-title">
                        Assign Driver to Vehicle: {{ $vehicle->name }}
                    </h5>

                    <form method="POST"
                        action="{{ route('vehicledrivers.update', $vehicle) }}">

                        @csrf
                        @method('PUT')

                        {{-- Driver --}}
                        <div class="mb-4">

                            <label for="user_id" class="form-label">
                                Driver
                            </label>

                            <select
                                name="user_id"
                                id="user_id"
                                class="form-select @error('user_id') is-invalid @enderror">

                                <option value="">
                                    -- No Driver --
                                </option>

                                @foreach ($drivers as $driver)

                                <option
                                    value="{{ $driver->id }}"
                                    {{ optional($currentAssignment?->user)->id == $driver->id ? 'selected' : '' }}>

                                    {{ $driver->name }}

                                </option>

                                @endforeach

                            </select>

                            @error('user_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex justify-content-between">

                            <a href="{{ route('vehicles.show', $vehicle) }}"
                                class="btn btn-secondary">

                                <i class="bi bi-arrow-left"></i>
                                Cancel

                            </a>

                            <button type="submit" class="btn btn-primary">

                                <i class="bi bi-person-check"></i>
                                Save Assignment

                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>
</section>

@endsection
