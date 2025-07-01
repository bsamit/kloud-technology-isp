@extends('home')
@section('title', 'Package Details')
@section('dashboard_content')
<div class="page-body">
    <div class="container-fluid px-4">
        <div class="card my-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-wifi me-1"></i>
                        Package Details
                    </div>
                    <div>
                        <a href="{{ route('customer.packages.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to Packages
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Package Information</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th>Package Name</th>
                                <td>{{ $package->package->name }}</td>
                            </tr>
                            <tr>
                                <th>Speed</th>
                                <td>{{ $package->package->speed }} Mbps</td>
                            </tr>
                            <tr>
                                <th>Monthly Cost</th>
                                <td>{{ number_format($package->package->price, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>{{ $package->package->description }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5>Subscription Details</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th>Start Date</th>
                                <td>{{ $package->start_date->format('d M Y') }}</td>
                            </tr>
                            <tr>
                                <th>End Date</th>
                                <td>{{ $package->end_date->format('d M Y') }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if($package->end_date < now())
                                        <span class="badge bg-danger">Expired</span>
                                    @elseif($package->status == 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-warning">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Bills Section -->
                <div class="row mt-4">
                    <div class="col-12">
                        <h5>Related Bills</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Bill Date</th>
                                        <th>Due Date</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($package->bills as $bill)
                                        <tr>
                                            <td>{{ $bill->bill_date->format('d M Y') }}</td>
                                            <td>
                                                @if($bill->status != 'paid' && $bill->due_date < now())
                                                    <span class="text-danger">{{ $bill->due_date->format('d M Y') }}</span>
                                                @else
                                                    {{ $bill->due_date->format('d M Y') }}
                                                @endif
                                            </td>
                                            <td>{{ number_format($bill->amount, 2) }}</td>
                                            <td>
                                                @if($bill->status == 'paid')
                                                    <span class="badge bg-success">Paid</span>
                                                @elseif($bill->status == 'pending' && $bill->due_date >= now())
                                                    <span class="badge bg-warning">Pending</span>
                                                @else
                                                    <span class="badge bg-danger">Overdue</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($bill->status != 'paid')
                                                    <a href="{{ route('customer.packages.pay-bill', $bill->id) }}" 
                                                       class="btn btn-primary btn-sm">
                                                        Pay Now
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No bills found</td>
                                        </tr>
                                    @endforelse
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
