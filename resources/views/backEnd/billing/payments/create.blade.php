@extends('backEnd.layouts.master')

@section('title', 'Record Payment')

@section('content')
<div class="container-fluid px-4">
    <div class="card my-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-money-bill me-1"></i>
                    Record Payment
                </div>
                <div>
                    <a href="{{ route('billing.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to Bills
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Bill Details</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Customer:</th>
                            <td>{{ $bill->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Package:</th>
                            <td>{{ $bill->package->plan_name }}</td>
                        </tr>
                        <tr>
                            <th>Bill Amount:</th>
                            <td>{{ number_format($bill->amount, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Due Date:</th>
                            <td>{{ $bill->due_date->format('d M Y') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <form action="{{ route('billing.payments.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="bill_id" value="{{ $bill->id }}">
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="amount" class="form-label">Payment Amount</label>
                            <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" 
                                id="amount" name="amount" value="{{ old('amount', $bill->amount) }}" required>
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Payment Method</label>
                            <select class="form-select @error('payment_method') is-invalid @enderror" 
                                id="payment_method" name="payment_method" required>
                                <option value="">Select Payment Method</option>
                                <option value="cash">Cash</option>
                                <option value="bank_transfer">Bank Transfer</option>
                                <option value="mobile_banking">Mobile Banking</option>
                            </select>
                            @error('payment_method')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="transactionFields" style="display: none;">
                            <div class="mb-3">
                                <label for="transaction_id" class="form-label">Transaction ID</label>
                                <input type="text" class="form-control @error('transaction_id') is-invalid @enderror" 
                                    id="transaction_id" name="transaction_id" value="{{ old('transaction_id') }}">
                                @error('transaction_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="payment_proof" class="form-label">Payment Proof</label>
                                <input type="file" class="form-control @error('payment_proof') is-invalid @enderror" 
                                    id="payment_proof" name="payment_proof">
                                <small class="text-muted">Supported formats: JPG, JPEG, PNG, PDF (max: 2MB)</small>
                                @error('payment_proof')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="note" class="form-label">Note</label>
                            <textarea class="form-control @error('note') is-invalid @enderror" 
                                id="note" name="note" rows="3">{{ old('note') }}</textarea>
                            @error('note')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Record Payment</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('payment_method').addEventListener('change', function() {
        const transactionFields = document.getElementById('transactionFields');
        const transactionId = document.getElementById('transaction_id');
        const paymentProof = document.getElementById('payment_proof');
        
        if (this.value === 'cash') {
            transactionFields.style.display = 'none';
            transactionId.removeAttribute('required');
            paymentProof.removeAttribute('required');
        } else {
            transactionFields.style.display = 'block';
            transactionId.setAttribute('required', 'required');
            paymentProof.setAttribute('required', 'required');
        }
    });
</script>
@endpush