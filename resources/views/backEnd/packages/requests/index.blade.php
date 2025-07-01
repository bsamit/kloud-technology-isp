@extends('home')
@section('title')
    Package Requests
@endsection
@section('dashboard_content')
<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Package Requests</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Request Date</th>
                                        <th>Customer</th>
                                        <th>Package</th>
                                        <th>Speed</th>
                                        <th>Monthly Cost</th>
                                        <th>Note</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($requests as $request)
                                        <tr>
                                            <td>{{ $request->created_at->format('d M Y') }}</td>
                                            <td>
                                                {{ $request->user->name }}<br>
                                                <small class="text-muted">{{ $request->user->email }}</small>
                                            </td>
                                            <td>{{ $request->package->plan_name }}</td>
                                            <td>{{ $request->package->speed }} Mbps</td>
                                            <td>TK. {{ $request->package->monthly_cost }}</td>
                                            <td>{{ $request->note ?? 'N/A' }}</td>
                                            <td>
                                                @if($request->status == 'pending')
                                                    <span class="badge badge-warning">Pending</span>
                                                @elseif($request->status == 'approved')
                                                    <span class="badge badge-success">Approved</span>
                                                @else
                                                    <span class="badge badge-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($request->status == 'pending')
                                                    <button type="button" class="btn btn-success btn-sm" 
                                                            onclick="approveRequest('{{ $request->id }}')">
                                                        Approve
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm" 
                                                            onclick="rejectRequest('{{ $request->id }}')">
                                                        Reject
                                                    </button>
                                                @else
                                                    @if($request->status == 'approved')
                                                        Approved by: {{ $request->approvedBy->name }}<br>
                                                        <small>{{ $request->approved_at->format('d M Y H:i') }}</small>
                                                    @else
                                                        Rejected: {{ $request->rejection_reason }}<br>
                                                        <small>{{ $request->rejected_at->format('d M Y H:i') }}</small>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No package requests found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $requests->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject Package Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="rejectForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Rejection Reason</label>
                        <textarea name="rejection_reason" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Reject Request</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function approveRequest(id) {
        if (confirm('Are you sure you want to approve this package request?')) {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ url("package-requests") }}/' + id + '/approve';
            form.innerHTML = '@csrf';
            document.body.appendChild(form);
            form.submit();
        }
    }

    function rejectRequest(id) {
        var modal = document.getElementById('rejectModal');
        var form = document.getElementById('rejectForm');
        form.action = '{{ url("admin/package-requests") }}/' + id + '/reject';
        var bsModal = new bootstrap.Modal(modal);
        bsModal.show();
    }
</script>
@endsection
