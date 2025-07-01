@extends('home')
@section('title', 'Payments Management')
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
                          <li class="breadcrumb-item">Billing</li>
                          <li class="breadcrumb-item active">Payments</li>
                      </ol>
                  </div>
            </div>
        </div>
    </div>

    <x-common.data-table label='Bills'>
        <table class="display" id="basic-9">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Transaction ID</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->created_at->format('d M Y') }}</td>
                    <td>{{ $payment->user->name }}</td>
                    <td>{{ number_format($payment->amount, 2) }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</td>
                    <td>{{ $payment->transaction_id ?? 'N/A' }}</td>
                    <td>
                        @if($payment->status == 'approved')
                            <span class="badge bg-success">Approved</span>
                        @elseif($payment->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @else
                            <span class="badge bg-danger">Rejected</span>
                        @endif
                    </td>
                    <td>
                        @if($payment->status == 'pending')
                            <button class="btn btn-success btn-sm" onclick="approvePayment('{{ $payment->id }}')">
                                <i class="fas fa-check"></i> Approve
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="rejectPayment('{{ $payment->id }}')">
                                <i class="fas fa-times"></i> Reject
                            </button>
                        @endif
                        @if($payment->payment_proof)
                            <a href="{{ Storage::url($payment->payment_proof) }}" class="btn btn-info btn-sm" target="_blank">
                                <i class="fas fa-file"></i> View Proof
                            </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </x-common.data-table>
</div>

<!-- Reject Payment Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="rejectForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="note" class="form-label">Rejection Reason</label>
                        <textarea class="form-control" id="note" name="note" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Reject Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    function approvePayment(paymentId) {
        if (confirm('Are you sure you want to approve this payment?')) {
            window.location.href = `{{ url('billing/payments') }}/${paymentId}/approve`;
        }
    }

    function rejectPayment(paymentId) {
        const modal = document.getElementById('rejectModal');
        const form = document.getElementById('rejectForm');
        form.action = `{{ url('billing/payments') }}/${paymentId}/reject`;
        new bootstrap.Modal(modal).show();
    }
</script>
@endsection