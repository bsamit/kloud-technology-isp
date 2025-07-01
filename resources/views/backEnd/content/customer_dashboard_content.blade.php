@extends('home')
@section('title')
    Customer Dashboard
@endsection
@section('dashboard_content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="row">
                <!-- Current Package Card -->
                <div class="col-xxl-4 col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5><i class="fa fa-wifi me-2"></i>Current Package</h5>
                                @if($currentPackage && $currentPackage->package)
                                @else
                                    <span class="badge badge-danger">No Active Package</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            @if($currentPackage && $currentPackage->package)
                                <div class="package-info">
                                    <h3 class="mb-2">{{ $currentPackage->package->name }}</h3>
                                    <div class="current-plan-details">
                                        <p><i class="fa fa-calendar me-2"></i>Activation: {{ $currentPackage->start_date->format('d M Y') }}</p>
                                        <p><i class="fa fa-clock me-2"></i>Expires: {{ $currentPackage->end_date->format('d M Y') }}</p>
                                        <p><i class="fa fa-clock me-2"></i>Last Payment Date: {{ $currentPackage->last_payment_date->format('d M Y') }}</p>
                                        <p><i class="fa fa-dollar-sign me-2"></i>Monthly Fee: {{ number_format($currentPackage->amount, 2) }}</p>
                                        <p><i class="fa fa-tachometer-alt me-2"></i>Speed: {{ $currentPackage->package->speed }} Mbps</p>
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <p class="mb-2">You don't have any active package.</p>
                                    <a href="{{ route('package') }}" class="btn btn-primary">View Available Packages</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Billing History Table -->
                <div class="col-xxl-8 col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5><i class="fa fa-history me-2"></i>Recent Billing History</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive custom-scrollbar">
                                <table class="display" id="basic-9">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Package</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($billingHistory as $bill)
                                            <tr>
                                                <td>{{ $bill->created_at->format('d M Y') }}</td>
                                                <td>{{ $bill->package->plan_name }}</td>
                                                <td>{{ number_format($bill->amount, 2) }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $bill->status === 'paid' ? 'success' : ($bill->status === 'pending' ? 'warning' : 'danger') }}">
                                                        {{ ucfirst($bill->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('customer.billing.show', $bill->id) }}" class="btn btn-info btn-sm">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Support Tickets Summary -->
                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5><i class="fa fa-ticket-alt me-2"></i>Support Status</h5>
                                <a href="{{ route('helpdesk.tickets.index') }}" class="btn btn-primary btn-sm">View Tickets</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="support-stat text-center">
                                        <h3>{{ $pendingTickets }}</h3>
                                        <p>Pending Tickets</p>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <p class="mb-0">
                                        Need help? <a href="{{ route('helpdesk.tickets.create') }}" class="text-primary">Create a new support ticket</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection