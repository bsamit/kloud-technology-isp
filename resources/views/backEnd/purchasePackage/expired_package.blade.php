@extends('backEnd.master')
@section('title', 'Expired Packages')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Expired Packages</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.purchase-package.add') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Assign New Package
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Package</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($expiredPackages as $package)
                                <tr>
                                    <td>{{ $package->user->name }}</td>
                                    <td>{{ $package->package->name }}</td>
                                    <td>{{ $package->start_date->format('Y-m-d') }}</td>
                                    <td>{{ $package->end_date->format('Y-m-d') }}</td>
                                    <td>
                                        <span class="badge badge-danger">Expired</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.purchase-package.add') }}?user_id={{ $package->user_id }}" 
                                           class="btn btn-primary btn-sm">
                                            Renew Package
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No expired packages found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $expiredPackages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
