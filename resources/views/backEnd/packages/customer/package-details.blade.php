@extends('home')
@section('title')
    Package Details
@endsection
@section('dashboard_content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6"></div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('images/design/icon-sprite.svg') }}#stroke-home"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('customer.packages.my-packages') }}">My Packages</a>
                        </li>
                        <li class="breadcrumb-item active">Package Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Package Information Card -->
            <div class="col-sm-12 col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Package Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Package Name</th>
                                        <td>{{ $package->package->plan_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Category</th>
                                        <td>{{ $package->package->packageCategory->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Speed</th>
                                        <td>{{ $package->package->speed }} Mbps</td>
                                    </tr>
                                    <tr>
                                        <th>Monthly Fee</th>
                                        <td>TK. {{ $package->monthly_fee }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if($package->status == 'active')
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Start Date</th>
                                        <td>{{ optional($package->start_date)->format('d M Y') ?? 'Not set' }}</td>
                                    </tr>
                                    <tr>
                                        <th>End Date</th>
                                        <td>{{ optional($package->end_date)->format('d M Y') ?? 'Not set' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Last Payment Date</th>
                                        <td>{{ optional($package->last_payment_date)->format('d M Y') ?? 'No payment yet' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Package Features Card -->
            <div class="col-sm-12 col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Package Features</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    @foreach($package->package->packageDetails as $detail)
                                        <tr>
                                            <td>
                                                <i class="fa fa-check text-success me-2"></i>
                                                {{ $detail->name }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
