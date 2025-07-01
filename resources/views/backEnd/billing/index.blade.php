@extends('home')
@section('title', 'Bills Management')
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
                        <li class="breadcrumb-item active">Bills</li>
                        <li class="ms-5">
                            <a class="btn btn-secondary-gradien" href="{{ route('admin.billing.generate') }}" type="button" title="Generate Bills">
                                <i class="fa fa-plus"></i> Generate Monthly Bills
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <x-common.data-table label='Bills'>
        <table class="display" id="basic-9">
            <thead>
                <tr>
                    <th>Bill Date</th>
                    <th>Customer</th>
                    <th>Package</th>
                    <th>Amount</th>
                    <th>Due Date</th>
                    <th>Last Payment Date</th>
                    <th>Payment Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bills as $bill)
                <tr>
                    <td>{{ optional($bill->created_at)->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.billing.customer', $bill->user_id) }}">
                            {{ $bill->user->name }}
                        </a>
                    </td>
                    <td>{{ optional($bill->package)->plan_name }}</td>
                    <td>{{ number_format($bill->purchasePackage->amount, 2) }}</td>
                    <td>
                        {{ optional($bill->purchasePackage->end_date)->format('d M Y') }}
                        {{-- @if($bill->status != 'paid' && optional($bill->due_date) && $bill->due_date < now())
                            <span class="text-danger">{{ $bill->due_date->format('d M Y') }}</span>
                        @else
                            
                        @endif --}}
                    </td>
                    <td>{{ optional($bill->purchasePackage->last_payment_date)->format('d M Y') }}</td>
                    <td>
                        @if($bill->status == 'paid')
                            <span class="badge bg-success">Paid</span>
                        @elseif($bill->status == 'payment_pending')
                            <span class="badge bg-info">Payment Pending</span>
                        @elseif($bill->status == 'pending' && (!$bill->due_date || $bill->due_date >= now()))
                            <span class="badge bg-warning">Not Paid</span>
                        @else
                            <span class="badge bg-danger">Overdue</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.billing.show', $bill->id) }}" 
                               class="btn btn-info btn-sm" title="View Details">
                                <i class="fa fa-eye"></i>
                            </a>
                            @if($bill->status == 'payment_pending')
                                <button type="button" 
                                        class="btn btn-success btn-sm"
                                        title="Approve Payment"
                                        onclick="showApprovalModal('{{ $bill->id }}', '{{ $bill->amount }}')">
                                    <i class="fa fa-check"></i>
                                </button>
                                <button type="button" 
                                        class="btn btn-danger btn-sm"
                                        title="Reject Payment"
                                        onclick="showRejectionModal('{{ $bill->id }}')">
                                    <i class="fa fa-times"></i>
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </x-common.data-table>
</div>

<!-- Payment Approval Modal -->
<div class="modal fade" id="approvalModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Approve Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="approvalForm" method="POST">
                @csrf
                <div class="modal-body">
                    <p>Are you sure you want to approve this payment?</p>
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <div class="input-group">
                            <span class="input-group-text">৳</span>
                            <input type="text" class="form-control" id="paymentAmount" name="amount" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Payment Method <span class="text-danger">*</span></label>
                        <select name="payment_method" class="form-control" required>
                            <option value="cash">Cash</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Note</label>
                        <textarea name="note" class="form-control" rows="3" placeholder="Optional: Add any additional notes"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check me-2"></i>Approve Payment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Payment Rejection Modal -->
<div class="modal fade" id="rejectionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="rejectionForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Rejection Note</label>
                        <textarea name="rejection_note" class="form-control" rows="3" placeholder="Please provide a reason for rejection"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-times me-2"></i>Reject Payment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function showApprovalModal(billId, amount) {
        const modal = document.getElementById('approvalModal');
        const form = document.getElementById('approvalForm');
        const amountInput = document.getElementById('paymentAmount');
        
        // Set form action
        form.action = `{{ url('admin/billing') }}/${billId}/approve`;
        
        // Format and set amount
        const formattedAmount = parseFloat(amount).toFixed(2);
        amountInput.value = formattedAmount;

        // Reset form (but keep the amount)
        const currentAmount = amountInput.value;
        form.reset();
        amountInput.value = currentAmount;
        
        // Show modal
        new bootstrap.Modal(modal).show();

        // Handle form submission
        form.onsubmit = function(e) {
            e.preventDefault();

            // Show loading state
            Swal.fire({
                title: 'Processing...',
                text: 'Please wait while we process your request.',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Get form data
            const formData = new FormData(form);

            // Send AJAX request
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: data.message
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Something went wrong. Please try again.'
                });
            });
        };
    }

    function showRejectionModal(billId) {
        const modal = document.getElementById('rejectionModal');
        const form = document.getElementById('rejectionForm');
        form.action = `{{ url('admin/billing') }}/${billId}/reject`;

        // Reset form
        form.reset();
        
        // Show modal
        new bootstrap.Modal(modal).show();

        // Handle form submission
        form.onsubmit = function(e) {
            e.preventDefault();

            // Validate rejection note
            const rejectionNote = form.querySelector('textarea[name="rejection_note"]').value;
            if (!rejectionNote.trim()) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Please provide a rejection reason.'
                });
                return;
            }

            // Show loading state
            Swal.fire({
                title: 'Processing...',
                text: 'Please wait while we process your request.',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Get form data
            const formData = new FormData(form);

            // Send AJAX request
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: data.message
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Something went wrong. Please try again.'
                });
            });
        };
    }
</script>
@endsection