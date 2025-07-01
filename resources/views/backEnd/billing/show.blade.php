@extends('home')
@section('title', 'Bill Details')
@section('dashboard_content')
<div class="page-body">
<div class="container-fluid px-4">
    <div class="card my-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-file-invoice me-1"></i>
                    Bill Details
                </div>
                <div>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Customer Information</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td>{{ $bill->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $bill->user->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $bill->user->phone ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5>Package Information</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Package Name</th>
                            <td>{{ $bill->package?->plan_name }}</td>
                        </tr>
                        <tr>
                            <th>Speed</th>
                            <td>{{ optional($bill->package)->speed }} Mbps</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td>{{ number_format(optional($bill->package)->monthly_cost ?? 0, 2) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <h5>Bill Information</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Bill Date</th>
                            <td>{{ optional($bill->created_at)->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <th>Due Date</th>
                            <td>
                                @if($bill->status != 'paid' && optional($bill->due_date) && $bill->due_date < now())
                                    <span class="text-danger">{{ $bill->due_date->format('d M Y') }}</span>
                                @else
                                    {{ optional($bill->due_date)->format('d M Y') }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Amount</th>
                            <td>{{ number_format($bill->amount, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($bill->status == 'paid')
                                    <span class="badge bg-success">Paid</span>
                                @elseif($bill->status == 'pending' && (!$bill->due_date || $bill->due_date >= now()))
                                    <span class="badge bg-warning">Pending</span>
                                @else
                                    <span class="badge bg-danger">Overdue</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                
                @if($bill->payment)
                <div class="col-md-6">
                    <h5>Payment Information</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Payment Date</th>
                            <td>{{ optional($bill->payment->payment_date)->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <th>Amount Paid</th>
                            <td>{{ number_format(optional($bill->payment)->amount ?? 0, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Payment Method</th>
                            <td>{{ optional($bill->payment)->payment_method ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Transaction ID</th>
                            <td>{{ optional($bill->payment)->transaction_id ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
                @endif
            </div>

            @if($bill->status != 'paid')
            <div class="row mt-4">
                <div class="col-12">
                    <button type="button" 
                            class="btn btn-success" 
                            onclick="showPaymentModal('{{ $bill->id }}', '{{ $bill->amount }}')">
                        <i class="fas fa-money-bill"></i> Record Payment
                    </button>
                </div>
            </div>
            @endif
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
        form.attr('action', `{{ route('admin.billing.approve', ':id') }}`.replace(':id', billId));
        
        modal.modal('show');
    }
</script>
@endsection
