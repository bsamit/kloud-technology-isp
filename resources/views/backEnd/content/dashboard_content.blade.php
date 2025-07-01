@extends('home')
@section('title')
    Dashboard
@endsection
@section('css')
<style>
    #dailyStatsChart {
        min-height: 400px;
    }
</style>
@endsection

@section('dashboard_content')
@php
    $user = auth()->user();
    $roleId = $user->role_id;
@endphp

@if($roleId == 4)
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
                                    <span class="badge badge-{{ $currentPackage->status === 'active' ? 'success' : 'warning' }}">
                                        {{ ucfirst($currentPackage->status) }}
                                    </span>
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
                                        <p><i class="fa fa-dollar-sign me-2"></i>Monthly Fee: ${{ number_format($currentPackage->package->price, 2) }}</p>
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
                                <a href="{{ route('customer.billing.index') }}" class="btn btn-primary btn-sm">View All</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Invoice No</th>
                                            <th>Date</th>
                                            <th>Package</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($billingHistory as $bill)
                                            <tr>
                                                <td>#{{ $bill->invoice_number }}</td>
                                                <td>{{ $bill->created_at->format('d M Y') }}</td>
                                                <td>{{ $bill->package->name }}</td>
                                                <td>${{ number_format($bill->amount, 2) }}</td>
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
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No billing history found</td>
                                            </tr>
                                        @endforelse
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
@else
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Dashboard</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="row">
                <!-- Total Customers Card -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <h6 class="text-muted mb-2">Total Customers</h6>
                                        <h4 class="mb-0">{{ $totalCustomers }}</h4>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="bg-primary text-white rounded-circle p-3 d-inline-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                            <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Potential Customers Card -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <h6 class="text-muted mb-2">Potential Customers</h6>
                                    <h4 class="mb-0">{{ $potentialCustomers }}</h4>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="bg-success text-white rounded-circle p-3 d-inline-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Packages Card -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <h6 class="text-muted mb-2">Total Packages</h6>
                                    <h4 class="mb-0">{{ $totalPackages }}</h4>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="bg-success text-white rounded-circle p-3 d-inline-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-box" viewBox="0 0 16 16">
                                            <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
                <!-- Pending Tickets Card -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <h6 class="text-muted mb-2">Pending Tickets</h6>
                                    <h4 class="mb-0">{{ $pendingTickets }}</h4>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="bg-warning text-white rounded-circle p-3 d-inline-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-ticket" viewBox="0 0 16 16">
                                            <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6V4.5ZM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5h-13Z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Daily Statistics Chart -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h5>Daily Statistics Overview</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="dailyStatsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('dailyStatsChart').getContext('2d');
        
        const data = {
            labels: {!! json_encode($dailyStats->map(function($stat) {
                return $stat['date'] . ' (' . $stat['day_name'] . ')';
            })) !!},
            datasets: [
                {
                    label: 'New Customers',
                    data: {!! json_encode($dailyStats->pluck('new_customers')) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Completed Payments',
                    data: {!! json_encode($dailyStats->pluck('completed_payments')) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }
            ]
        };

        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Count'
                        },
                        ticks: {
                            stepSize: 1,
                            precision: 0
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        },
                        ticks: {
                            maxRotation: 45,
                            minRotation: 45
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Daily Customer Entries and Completed Payments',
                        font: {
                            size: 16
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.dataset.label || '';
                                const value = context.parsed.y;
                                return `${label}: ${value} ${value === 0 ? '(No data)' : ''}`;
                            }
                        }
                    }
                }
            }
        };

        new Chart(ctx, config);
    });
</script>
@endsection