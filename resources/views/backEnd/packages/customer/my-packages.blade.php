@extends('home')
@section('title')
    My Packages
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
                        <li class="breadcrumb-item">Packages</li>
                        <li class="breadcrumb-item active">My Packages</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <x-common.data-table label='My Active Packages'>
        <table class="display" id="basic-9">
            <thead>
                <tr>
                    <th>Package Name</th>
                    <th>Speed</th>
                    <th>Monthly Fee</th>
                    <th>Start Date</th>
                    <th>Expiry Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($packages as $package)
                    <tr>
                        <td>{{ $package->package->plan_name }}</td>
                        <td>{{ $package->package->speed }} Mbps</td>
                        <td>TK. {{ $package->monthly_fee }}</td>
                        <td>{{ $package->start_date ? $package->start_date->format('d M Y') : 'N/A' }}</td>
                        <td>{{ $package->end_date ? $package->end_date->format('d M Y') : 'N/A' }}</td>
                        <td>
                            @if($package->status == 'active')
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('customer.package.details', $package->uuid) }}" 
                                   class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i> Details
                                </a>
                                @if($package->status == 'active')
                                    @if($package->can_request_new)
                                        <a href="{{ route('customer.packages') }}" 
                                           class="btn btn-success btn-sm">
                                            <i class="fa fa-plus"></i> Request New Package
                                        </a>
                                    @else
                                        <button type="button" 
                                                class="btn btn-success btn-sm"
                                                onclick="showRenewModal('{{ $package->uuid }}')">
                                            <i class="fa fa-sync"></i> Renew
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-common.data-table>
</div>

<!-- Renew Modal -->
<div class="modal fade" id="renewModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Renew Package</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="renewForm" method="POST">
                @csrf
                <div class="modal-body">
                    <p>Are you sure you want to renew this package?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Renew Package</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function showRenewModal(uuid) {
        var modal = document.getElementById('renewModal');
        var form = document.getElementById('renewForm');
        form.action = '{{ url("customer/packages") }}/' + uuid + '/renew';
        var bsModal = new bootstrap.Modal(modal);
        bsModal.show();
    }

    $(document).ready(function() {
        $('#basic-9').DataTable();
    });
</script>
@endsection
