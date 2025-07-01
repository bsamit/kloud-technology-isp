@extends('home')
@section('title', 'Invoice Details')
@section('dashboard_content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Invoice Details</h3>
                </div>
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
                        <li class="breadcrumb-item active">Invoice Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-lg-10 col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <!-- Invoice Header -->
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <img src="{{ siteSettings()->company_main_logo }}" alt="Company Logo" class="img-fluid" style="max-height: 80px;">
                                </div>
                                <div>
                                    <h4 class="text-primary mb-1">{{ siteSettings()->company_name }}</h4>
                                    {{-- <p class="mb-1">{{ siteSettings()->address }}</p>
                                    <p class="mb-1">Phone: {{ siteSettings()->mobile }}</p>
                                    <p>Email: {{ siteSettings()->email }}</p> --}}
                                </div>
                            </div>
                            <div class="col-sm-6 text-sm-end">
                                <p class="mb-1">Bill Date: {{ optional($bill->bill_date)->format('d M Y') ?? 'N/A' }}</p>
                                <p class="mb-1">Due Date: {{ optional($bill->due_date)->format('d M Y') ?? 'N/A' }}</p>
                                <p class="mb-1">Last Payment Date: {{ optional($bill->last_payment_date)->format('d M Y') ?? 'N/A' }}</p>
                                <p class="mb-4">Status: 
                                    @if($bill->status == 'paid')
                                        <span class="badge bg-success">Paid</span>
                                    @elseif($bill->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @else
                                        <span class="badge bg-danger">{{ ucfirst($bill->status) }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Bill To Section -->
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <h5 class="mb-3 text-primary">Bill To:</h5>
                                <h6 class="mb-2">{{ optional($bill->user)->name ?? 'N/A' }}</h6>
                                <p class="mb-1">{{ optional($bill->user)->address ?? 'N/A' }}</p>
                                <p class="mb-1">Phone: {{ optional($bill->user)->mobile ?? 'N/A' }}</p>
                                <p>Email: {{ optional($bill->user)->email ?? 'N/A' }}</p>
                            </div>
                            <div class="col-sm-6">
                                <h5 class="mb-3 text-primary">Package Details:</h5>
                                <h6 class="mb-2">{{ optional($bill->package)->plan_name ?? 'N/A' }}</h6>
                                <p class="mb-1">Speed: {{ optional($bill->package)->speed ?? 'N/A' }} Mbps</p>
                                <p class="mb-1">Category: {{ optional($bill->package)->plan_name ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <!-- Bill Details -->
                        <div class="table-responsive mb-4">
                            <table class="table table-striped">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>Description</th>
                                        <th class="text-end">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Monthly Subscription Fee ({{ optional($bill->payment->payment_date)->format('d M Y') ?? 'N/A' }})</td>
                                        <td class="text-end">TK. {{ number_format($bill->amount ?? 0, 2) }}</td>
                                    </tr>
                                </tbody>
                                <tfoot class="bg-light">
                                    <tr>
                                        <td class="text-end"><strong>Subtotal</strong></td>
                                        <td class="text-end">TK. {{ number_format($bill->amount ?? 0, 2) }}</td>
                                    </tr>
                                    <tr class="bg-primary text-white">
                                        <td class="text-end"><strong>Total Amount</strong></td>
                                        <td class="text-end"><strong>TK. {{ number_format($bill->amount ?? 0, 2) }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Payment Information -->
                        @if($bill->status == 'paid')
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <h5 class="text-primary mb-3">Payment Information</h5>
                                <p class="mb-1"><strong>Payment Date:</strong> {{ optional($bill->payment->payment_date)->format('d M Y') ?? 'N/A' }}</p>
                                <p class="mb-1"><strong>Payment Method:</strong> {{ ucfirst($bill->payment->payment_method ?? 'N/A') }}</p>
                                <p><strong>Transaction ID:</strong> {{ $bill->payment->transaction_id ?? 'N/A' }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- Terms and Conditions -->
                        <div class="row mt-4">
                            <div class="col-sm-12">
                                <h5 class="text-primary mb-3">Terms & Conditions</h5>
                                <ul class="list-unstyled">
                                    <li class="mb-1"><strong>01. Last Payment Date Is: {{optional($bill->payment->payment_date)->format('d M Y') ?? 'N/A'}}</strong></li>
                                    <li class="mb-1"><strong>02. Late payments may result in service interruption</strong> </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row mt-4">
                            <div class="col-sm-12 text-end">
                                <button onclick="window.print()" class="btn btn-primary">
                                    <i class="fa fa-print me-2"></i>Print Invoice
                                </button>
                                @if($bill->status == 'pending')
                                <button type="button" class="btn btn-success ms-2" data-bs-toggle="modal" data-bs-target="#paymentModal">
                                    <i class="fa fa-credit-card me-2"></i>Pay Now
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Make Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('customer.billing.pay', $bill->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle me-2"></i>
                        Your payment will be pending until approved by an administrator.
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <select class="form-select @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method" required>
                            <option value="">Select Payment Method</option>
                            <option value="cash">Cash</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="mobile_banking">Mobile Banking</option>
                        </select>
                        @error('payment_method')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="transaction_id" class="form-label">Transaction ID</label>
                        <input type="text" class="form-control @error('transaction_id') is-invalid @enderror" id="transaction_id" name="transaction_id" required>
                        <div class="form-text">Please enter the transaction ID from your payment.</div>
                        @error('transaction_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="payment_proof" class="form-label">Payment Proof</label>
                        <input type="file" class="form-control @error('payment_proof') is-invalid @enderror" id="payment_proof" name="payment_proof">
                        <div class="form-text">Upload a screenshot or photo of your payment (optional). Supported formats: JPG, PNG, PDF. Max size: 2MB</div>
                        @error('payment_proof')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check me-2"></i>Submit Payment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
    @media print {
        .btn { display: none !important; }
        .breadcrumb { display: none !important; }
        .page-title { display: none !important; }
        .card { border: none !important; }
        .card-body { padding: 0 !important; }
    }
</style>
@endpush
@endsection
