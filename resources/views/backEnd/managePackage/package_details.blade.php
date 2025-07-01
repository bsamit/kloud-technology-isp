@extends('home')
@section('title')
    Package Details
@endsection
@section('dashboard_content')
<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-3 col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>{{$package->plan_name}}</h5>
                            <span class="badge badge-success">Active</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="package-price text-center mb-4">
                            <h2 class="mb-2">TK. {{$package->monthly_cost}}<small>/month</small></h2>
                            <p class="text-muted">{{$package->speed}} Mbps</p>
                        </div>
                        <ul class="package-features">
                            @foreach ($package->packageDetails as $detail)
                                <li>
                                    <i class="fa fa-check text-success me-2"></i>{{$detail->name}}
                                </li>
                            @endforeach
                        </ul>
                        <div class="text-center mt-4">
                            @if(auth()->user()->role_id == 4)
                                @php
                                    $pendingRequest = \App\Models\PackageRequest::where('user_id', auth()->id())
                                        ->where('package_id', $package->id)
                                        ->where('status', 'pending')
                                        ->first();
                                @endphp

                                @if($pendingRequest)
                                    <div class="alert alert-warning">
                                        You already have a pending request for this package.
                                        <a href="{{ route('customer.package-requests') }}" class="btn btn-link">View Request</a>
                                    </div>
                                @else
                                    <form action="{{ route('customer.package-requests.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="package_id" value="{{ $package->id }}">
                                        <div class="form-group mb-3">
                                            <label>Note (Optional)</label>
                                            <textarea name="note" class="form-control" rows="3" 
                                                placeholder="Any special requirements or notes"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-lg w-100">
                                            Confirm This Package
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn btn-primary btn-lg w-100">
                                    Edit Package
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
