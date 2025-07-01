@extends('home')
@section('title', 'Customer Bills')
@section('dashboard_content')
<div class="page-body">
<div class="container-fluid px-4">
    <div class="card my-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-table me-1"></i>
                    Customer Bills History
                </div>
                <div>
                    <a href="{{ route('admin.billing.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to All Bills
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Bill Date</th>
                            <th>Package</th>
                            <th>Amount</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bills as $bill)
                        <tr>
                            <td>{{ optional($bill->created_at)->format('d M Y') }}</td>
                            <td>{{ optional($bill->package)->plan_name }}</td>
                            <td>{{ number_format($bill->amount, 2) }}</td>
                            <td>
                                @if($bill->status != 'paid' && optional($bill->due_date) && $bill->due_date < now())
                                    <span class="text-danger">{{ $bill->due_date->format('d M Y') }}</span>
                                @else
                                    {{ optional($bill->due_date)->format('d M Y') }}
                                @endif
                            </td>
                            <td>
                                @if($bill->status == 'paid')
                                    <span class="badge bg-success">Paid</span>
                                @elseif($bill->status == 'pending' && (!$bill->due_date || $bill->due_date >= now()))
                                    <span class="badge bg-warning">Pending</span>
                                @else
                                    <span class="badge bg-danger">Overdue</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('customer.billing.show', $bill->id) }}" 
                                        class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($bill->status != 'paid')
                                        <button type="button" 
                                                class="btn btn-success btn-sm" 
                                                onclick="showPaymentModal('{{ $bill->id }}', '{{ $bill->amount }}')">
                                            <i class="fas fa-money-bill"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No bills found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $bills->links() }}
            </div>
        </div>
    </div>
</div>
</div>

<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Record Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="paymentForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="text" class="form-control" id="paymentAmount" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Payment Method</label>
                        <select name="payment_method" class="form-control" required>
                            <option value="">Select Payment Method</option>
                            <option value="cash">Cash</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="mobile_banking">Mobile Banking</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Transaction ID</label>
                        <input type="text" name="transaction_id" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Record Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function showPaymentModal(billId, amount) {
        const modal = $('#paymentModal');
        const form = $('#paymentForm');
        
        $('#paymentAmount').val(amount);
        form.attr('action', `{{ route('admin.billing.approve', '') }}/${billId}`);
        
        modal.modal('show');
    }
</script>
@endsection
