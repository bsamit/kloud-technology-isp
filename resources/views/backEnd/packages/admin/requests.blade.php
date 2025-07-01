@extends('home')
@section('title')
    Package Requests
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
                          <li class="breadcrumb-item">Manage Package</li>
                          <li class="breadcrumb-item active">Request</li>
                      </ol>
                  </div>
            </div>
        </div>
    </div>

    <x-common.data-table label='Package Requests'>
        <table class="display" id="basic-9">
            <thead>
                <tr>
                    <th>Request Date</th>
                    <th>Customer</th>
                    <th>Package</th>
                    <th>Speed</th>
                    <th>Monthly Cost</th>
                    <th>Note</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $request)
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
                            @if($request->payment_status == 'not_paid')
                                <span class="badge badge-danger">Not Paid</span>
                            @elseif($request->payment_status == 'paid')
                                <span class="badge badge-success">Paid</span>
                            @endif
                        </td>
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
                                <button type="button" class="btn btn-success btn-xs" onclick="confirmApprove('{{ $request->id }}')">
                                    <i class="fa fa-check"></i>
                                </button>

                                <button type="button" class="btn btn-danger btn-xs" onclick="confirmReject('{{ $request->id }}')">
                                    <i class="fa fa-times"></i>
                                </button>
                                
                            @else
                                @if($request->status == 'approved')
                                    Approved by: {{ optional($request->approvedBy)->name ?? 'N/A' }}<br>
                                    <small>{{ $request->approved_at ? $request->approved_at->format('d M Y H:i') : '' }}</small>
                                @else
                                    Reason: {{ $request->rejection_reason }}<br>
                                    <small>{{ $request->rejected_at ? $request->rejected_at->format('d M Y H:i') : '' }}</small>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-common.data-table>
</div>
@endsection

@section('scripts')
<script>
    function confirmApprove(id) {
        const currentDate = new Date();
        const endDate = new Date();
        endDate.setDate(currentDate.getDate() + 30);

        const formatDate = (date) => {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        };

        Swal.fire({
            title: 'Package Approval',
            html: `
                <div class="form-group mb-3">
                    <label class="col-form-label"><strong>Start Date</strong> <span class='font-danger'>*</span></label>
                    <input class="form-control flatpickr-input" id="start_date" type="text" value="${formatDate(currentDate)}" readonly>
                </div>
                <div class="form-group mb-3">
                    <label class="col-form-label"><strong>End Date</strong> <span class='font-danger'>*</span></label>
                    <input class="form-control flatpickr-input" id="end_date" type="text" value="${formatDate(endDate)}">
                </div>
                <div class="form-group mb-3">
                    <label class="col-form-label"><strong>Last Payment Date</strong> <span class='font-danger'>*</span></label>
                    <input class="form-control flatpickr-input" id="last_payment_date" type="text">
                </div>
            `,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, approve it!',
            didOpen: () => {
                // Initialize flatpickr for end_date and last_payment_date
                flatpickr("#end_date", {
                    dateFormat: "Y-m-d",
                    minDate: currentDate,
                    defaultDate: endDate
                });

                flatpickr("#last_payment_date", {
                    dateFormat: "Y-m-d",
                    minDate: currentDate
                });

                // Add validation listeners for end_date only
                const endDatePicker = document.querySelector("#end_date")._flatpickr;
                endDatePicker.config.onChange = function(selectedDates, dateStr) {
                    const startDate = new Date($('#start_date').val());
                    const endDate = new Date(dateStr);
                    if (startDate > endDate) {
                        Swal.showValidationMessage('End date must be greater than start date');
                        endDatePicker.clear();
                    }
                };
            },
            preConfirm: () => {
                const startDate = $('#start_date').val();
                const endDate = $('#end_date').val();
                const lastPaymentDate = $('#last_payment_date').val();

                if (!startDate || !endDate || !lastPaymentDate) {
                    Swal.showValidationMessage('All dates are required');
                    return false;
                }

                const startDateTime = new Date(startDate);
                const endDateTime = new Date(endDate);

                if (startDateTime > endDateTime) {
                    Swal.showValidationMessage('End date must be greater than start date');
                    return false;
                }

                return { startDate, endDate, lastPaymentDate };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('start_date', result.value.startDate);
                formData.append('end_date', result.value.endDate);
                formData.append('last_payment_date', result.value.lastPaymentDate);

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

                // Send AJAX request
                fetch('{{ url("manage-package/package-requests") }}/' + id + '/approve', {
                    method: 'POST',
                    body: formData
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
            }
        });
    }

    function confirmReject(id) {
        Swal.fire({
            title: 'Reject Package Request',
            input: 'textarea',
            inputLabel: 'Rejection Reason',
            inputPlaceholder: 'Enter your reason for rejection...',
            inputAttributes: {
                'required': true
            },
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Reject',
            showLoaderOnConfirm: true,
            preConfirm: (reason) => {
                if (!reason) {
                    Swal.showValidationMessage('Please enter a rejection reason');
                    return false;
                }
                
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ url("manage-package/package-requests") }}/' + id + '/reject';
                
                var csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);
                
                var reasonInput = document.createElement('input');
                reasonInput.type = 'hidden';
                reasonInput.name = 'rejection_reason';
                reasonInput.value = reason;
                form.appendChild(reasonInput);
                
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endsection
