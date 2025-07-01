@extends('home')
@section('title')
    Send Notice
@endsection
@section('dashboard_content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3><i class="fa fa-envelope me-2"></i>Message Center</h3>
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
                        <li class="breadcrumb-item">Messaging</li>
                        <li class="breadcrumb-item active">Send Notice</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header pb-0">
                <div class="header-top">
                    <h5><i class="fa fa-paper-plane me-2"></i>New Message</h5>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('send.message') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="mb-3 text-center">
                                <div class="btn-group btn-group-lg" role="group">
                                    <button type="button" class="btn btn-outline-primary btn-air-primary active px-4" id="staffBtn">
                                        <i class="fa fa-users me-2"></i>Staff Members
                                        <span class="badge bg-success ms-2">Selected</span>
                                    </button>
                                    <button type="button" class="btn btn-outline-primary btn-air-primary px-4" id="customerBtn">
                                        <i class="fa fa-user-circle me-2"></i>Customers
                                        <span class="badge bg-success ms-2 d-none">Selected</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-form-label f-w-600">Select Recipients</label>
                                <div class="recipients-list" id="staffList">
                                    <select name="staff_recipients[]" class="form-select digits select2" multiple="multiple" id="staffSelect">
                                        <option value="all">Select All Staff</option>
                                        @foreach($staffMembers as $staff)
                                            <option value="staff_{{ $staff->id }}">{{ $staff->name }} ({{ $staff->email }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="recipients-list d-none" id="customerList">
                                    <select name="customer_recipients[]" class="form-select digits select2" multiple="multiple" id="customerSelect">
                                        <option value="all">Select All Customers</option>
                                        @foreach($customers as $customer)
                                            <option value="customer_{{ $customer->id }}">{{ $customer->name }} ({{ $customer->email }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-form-label f-w-600">Message Type</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-bell"></i></span>
                                    <select name="message_type" class="form-select digits" required>
                                        <option value="email">Email Message</option>
                                        <option value="sms">SMS Message</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-form-label f-w-600">Message Content</label>
                                <textarea name="message" class="form-control" rows="5" required placeholder="Type your message here..."></textarea>
                            </div>
                        </div>

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary btn-air-primary btn-lg">
                                <i class="fa fa-paper-plane me-2"></i>Send Message
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2({
            placeholder: "Select recipients",
            allowClear: true,
            width: '100%'
        });

        // Toggle between staff and customer lists
        $('#staffBtn').click(function() {
            $(this).addClass('active').find('.badge').removeClass('d-none');
            $('#customerBtn').removeClass('active').find('.badge').addClass('d-none');
            $('#staffList').removeClass('d-none');
            $('#customerList').addClass('d-none');
        });

        $('#customerBtn').click(function() {
            $(this).addClass('active').find('.badge').removeClass('d-none');
            $('#staffBtn').removeClass('active').find('.badge').addClass('d-none');
            $('#customerList').removeClass('d-none');
            $('#staffList').addClass('d-none');
        });

        // Handle select all functionality for staff
        $('#staffSelect').on('change', function() {
            if ($(this).val() && $(this).val().includes('all')) {
                var allStaffOptions = $(this).find('option').not('[value="all"]').map(function() {
                    return $(this).val();
                }).get();
                $(this).val(allStaffOptions).trigger('change');
            }
        });

        // Handle select all functionality for customers
        $('#customerSelect').on('change', function() {
            if ($(this).val() && $(this).val().includes('all')) {
                var allCustomerOptions = $(this).find('option').not('[value="all"]').map(function() {
                    return $(this).val();
                }).get();
                $(this).val(allCustomerOptions).trigger('change');
            }
        });
    });
</script>
@endsection
