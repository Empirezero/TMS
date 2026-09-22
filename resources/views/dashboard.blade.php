@extends('layouts.admin')

@section('content')

<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div>

<section class="section dashboard">


    <div class="row">

        <!-- Vehicles Card -->
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">

                <div class="card-body">
                    <h5 class="card-title">Vehicles <span>| Active</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-car-front"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $totalVehicles }}</h6>

                        </div>
                    </div>
                </div>

            </div>
        </div><!-- End Sales Card -->

        <!-- Revenue Card -->
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">

                <div class="card-body">
                    <h5 class="card-title">Fuel Logged <span>| This Month</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div class="ps-3">
                            <h6>KES {{ number_format($totalfuelscosts, 1) }}</h6>
                            <!-- <span class="text-success small pt-1 fw-bold">8%</span> <span
                                class="text-muted small pt-2 ps-1">increase</span> -->

                        </div>
                    </div>
                </div>

            </div>
        </div><!-- End Revenue Card -->

        <!-- Customers Card -->
        <div class="col-xxl-4 col-xl-12">

            <div class="card info-card customers-card">

                <div class="card-body">
                    <h5 class="card-title">Maintenance <span>| This Year</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-wrench"></i>
                        </div>
                        <div class="ps-3">
                            <h6>KES {{ number_format($totalservicescosts, 0)}}</h6>
                            <!-- <span class="text-danger small pt-1 fw-bold">12%</span> <span
                                class="text-muted small pt-2 ps-1">decrease</span> -->

                        </div>
                    </div>

                </div>
            </div>

        </div><!-- End Customers Card -->


        <!-- Service Requests    -->
        <div class="col-12">
            <div class="card top-selling overflow-auto">



                <div class="card-body pb-0">
                    <h5 class="card-title">Service Requests <span>| Recent</span></h5>

                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Vehicle</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentServices as $request)
                            <tr>
                                <td>{{ $request->created_at->format('M d, Y') }}</td>
                                <td>{{ $request->reg_no }}</td>
                                <td class="align-middle">
                                    @switch(strtolower($request->status))
                                    @case('approved')
                                    <span class="badge bg-success-subtle text-success text-uppercase">{{ $request->status }}</span>
                                    @break
                                    @case('pending')
                                    <span class="badge bg-warning-subtle text-warning text-uppercase">{{ $request->status }}</span>
                                    @break
                                    @case('rejected')
                                    <span class="badge bg-danger-subtle text-danger text-uppercase">{{ $request->status }}</span>
                                    @break
                                    @default
                                    <span class="badge bg-secondary-subtle text-secondary text-uppercase">{{ $request->status }}</span>
                                    @endswitch
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-gray-500">No requests found.</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>

                </div>

            </div>
        </div><!-- End Service Requests -->

    </div>

</section>



@endsection