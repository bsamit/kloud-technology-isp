@extends('home')
@section('title', 'My Packages')
@section('dashboard_content')
<div class="page-body">
    <div class="container-fluid px-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Current Package Section -->
        <div class="card my-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-wifi me-1"></i>
                        Current Package
                    </div>
                    <div>
                        <a href="{{ route('customer.packages.usage') }}" class="btn btn-info btn-sm">
                            <i class="fas fa-chart-line"></i> View Usage
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if($activePackage)
                    <div class="row">
                        <div class="col-md-6">
                            <h5>{{ $activePackage->package->name }}</h5>
                            <p class="text-muted">Speed: {{ $activePackage->package->speed }} Mbps</p>
                            <p class="text-muted">Monthly Cost: {{ number_format($activePackage->package->price, 2) }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Start Date:</strong> {{ $activePackage->start_date->format('d M Y') }}</p>
                            <p><strong>End Date:</strong> {{ $activePackage->end_date->format('d M Y') }}</p>
                            <p><strong>Status:</strong> 
                                <span class="badge bg-success">Active</span>
                            </p>
                        </div>
                    </div>
                @else
                    <div class="text-center py-3">
                        <p>You don't have any active package.</p>
                        <p>Please contact support to activate a package.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Unpaid Bills Alert -->
        @if($unpaidBills->count() > 0)
            <div class="alert alert-warning">
                <h5><i class="fas fa-exclamation-triangle"></i> Unpaid Bills</h5>
                <p>You have {{ $unpaidBills->count() }} unpaid bill(s). Please pay them to avoid service interruption.</p>
                <a href="{{ route('customer.packages.bills') }}" class="btn btn-warning btn-sm">
                    View Bills
                </a>
            </div>
        @endif

        <!-- Available Packages Section -->
        <div class="card my-4">
            <div class="card-header">
                <i class="fas fa-list me-1"></i>
                Available Packages
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($availablePackages as $package)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $package->name }}</h5>
                                    <p class="card-text">
                                        <strong>Speed:</strong> {{ $package->speed }} Mbps<br>
                                        <strong>Price:</strong> {{ number_format($package->price, 2) }}/month
                                    </p>
                                    <p class="card-text">{{ $package->description }}</p>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <button class="btn btn-primary btn-sm" 
                                            onclick="contactSupport('{{ $package->id }}')">
                                        Request Package
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Package History Section -->
        <div class="card my-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-history me-1"></i>
                        Package History
                    </div>
                    <div>
                        <a href="{{ route('customer.packages.renewal-history') }}" class="btn btn-secondary btn-sm">
                            View Full History
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Package</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($packageHistory as $history)
                                <tr>
                                    <td>{{ $history->package->name }}</td>
                                    <td>{{ $history->start_date->format('d M Y') }}</td>
                                    <td>{{ $history->end_date->format('d M Y') }}</td>
                                    <td>
                                        @if($history->end_date < now())
                                            <span class="badge bg-danger">Expired</span>
                                        @elseif($history->status == 'active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-warning">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('customer.packages.show', $history->id) }}" 
                                           class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No package history found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Support Modal -->
<div class="modal fade" id="contactSupportModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Contact Support</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Please contact our support team to request this package:</p>
                <p><i class="fas fa-phone"></i> Support Phone: <a href="tel:+1234567890">+123 456 7890</a></p>
                <p><i class="fas fa-envelope"></i> Support Email: <a href="mailto:support@example.com">support@example.com</a></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function contactSupport(packageId) {
        $('#contactSupportModal').modal('show');
    }
</script>
@endsection
