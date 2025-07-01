@extends('home')
@section('title', 'Pay Bill')
@section('dashboard_content')
<div class="page-body">
    <div class="container-fluid px-4">
        <div class="card my-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-money-bill me-1"></i>
                        Pay Bill
                    </div>
                    <div>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>Bill Information</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th>Package</th>
                                <td>{{ $bill->package->name }}</td>
                            </tr>
                            <tr>
                                <th>Bill Date</th>
                                <td>{{ $bill->bill_date->format('d M Y') }}</td>
                            </tr>
                            <tr>
                                <th>Due Date</th>
                                <td>
                                    @if($bill->due_date < now())
                                        <span class="text-danger">{{ $bill->due_date->format('d M Y') }}</span>
                                    @else
                                        {{ $bill->due_date->format('d M Y') }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Amount</th>
                                <td>{{ number_format($bill->amount, 2) }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5>Payment Instructions</h5>
                        <div class="alert alert-info">
                            <h6>Bank Transfer</h6>
                            <p>Bank: Example Bank<br>
                            Account Name: ISP Company Ltd<br>
                            Account Number: 1234567890<br>
                            Branch: Main Branch</p>

                            <h6 class="mt-3">Mobile Banking</h6>
                            <p>bKash/Nagad Number: 01XXXXXXXXX<br>
                            Account Type: Merchant</p>

                            <p class="mt-3"><strong>Note:</strong> Please keep your transaction ID after making the payment.</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <form action="{{ route('customer.packages.process-payment', $bill->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Payment Method</label>
                                <select name="payment_method" class="form-control @error('payment_method') is-invalid @enderror" required>
                                    <option value="">Select Payment Method</option>
                                    <option value="bank_transfer">Bank Transfer</option>
                                    <option value="mobile_banking">Mobile Banking</option>
                                </select>
                                @error('payment_method')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Transaction ID</label>
                                <input type="text" 
                                       name="transaction_id" 
                                       class="form-control @error('transaction_id') is-invalid @enderror" 
                                       required>
                                @error('transaction_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Enter the transaction ID you received after making the payment
                                </small>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check"></i> Submit Payment
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
