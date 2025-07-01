@extends('home')
@section('title')
    Available Packages
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
                        <li class="breadcrumb-item active">Available Packages</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <x-common.data-table label='Available Packages'>
        <table class="display" id="basic-9">
            <thead>
                <tr>
                    <th>Package Name</th>
                    <th>Category</th>
                    <th>Speed</th>
                    <th>Monthly Cost</th>
                    <th>Features</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($packages as $package)
                    <tr>
                        <td>{{ $package->plan_name }}</td>
                        <td>{{ $package->packageCategory->name }}</td>
                        <td>{{ $package->speed }} Mbps</td>
                        <td>TK. {{ $package->monthly_cost }}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" 
                                    onclick="showFeaturesModal('{{ $package->uuid }}', '{{ $package->plan_name }}', {{ json_encode($package->packageDetails) }})">
                                <i class="fa fa-list"></i> View Features
                            </button>
                        </td>
                        <td>
                            @if($package->can_request)
                                <button type="button" class="btn btn-primary btn-sm" 
                                        onclick="showRequestModal('{{ $package->id }}', '{{ $package->plan_name }}')">
                                    <i class="fa fa-paper-plane"></i> Request Package
                                </button>
                            @else
                                <button type="button" class="btn btn-secondary btn-sm" disabled>
                                    <i class="fa fa-ban"></i> Already Requested/Active
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-common.data-table>
</div>

<!-- Features Modal -->
<div class="modal fade" id="featuresModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Package Features</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h6 id="packageName" class="mb-3"></h6>
                <ul id="featuresList" class="list-group">
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Request Package Modal -->
<div class="modal fade" id="requestModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Request Package</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="requestForm" method="POST" action="{{ route('package-requests.store') }}">
                @csrf
                <input type="hidden" name="package_id" id="packageId">
                <div class="modal-body">
                    <h6 id="requestPackageName" class="mb-3"></h6>
                    <div class="form-group">
                        <label for="note">Additional Note (Optional)</label>
                        <textarea name="note" id="note" class="form-control" rows="3" 
                                placeholder="Any specific requirements or questions?"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit Request</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function showFeaturesModal(uuid, name, features) {
        const modal = document.getElementById('featuresModal');
        const packageName = document.getElementById('packageName');
        const featuresList = document.getElementById('featuresList');
        
        packageName.textContent = name;
        featuresList.innerHTML = '';
        
        features.forEach(feature => {
            const li = document.createElement('li');
            li.className = 'list-group-item';
            li.innerHTML = `<i class="fa fa-check text-success me-2"></i> ${feature.name}`;
            featuresList.appendChild(li);
        });
        
        const bsModal = new bootstrap.Modal(modal);
        bsModal.show();
    }

    function showRequestModal(id, name) {
        const modal = document.getElementById('requestModal');
        const packageName = document.getElementById('requestPackageName');
        const packageId = document.getElementById('packageId');
        
        packageName.textContent = name;
        packageId.value = id;
        
        const bsModal = new bootstrap.Modal(modal);
        bsModal.show();
    }

    $(document).ready(function() {
        $('#basic-9').DataTable();
    });
</script>
@endsection
