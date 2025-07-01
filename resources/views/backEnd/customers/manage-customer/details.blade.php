@extends('home')
@section('title')
    Customer Details
@endsection
@section('css')
<style>
    .profile-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .profile-header {
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        padding: 30px 20px;
        text-align: center;
        color: white;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 5px solid rgba(255,255,255,0.5);
        margin: 0 auto 15px;
        overflow: hidden;
    }

    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-info {
        padding: 25px;
    }

    .info-group {
        background: #f8fafc;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 15px;
    }

    .info-item {
        display: flex;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .info-label {
        font-weight: 600;
        min-width: 140px;
        color: #4b5563;
    }

    .info-value {
        color: #1f2937;
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        margin-top: 20px;
    }

    .action-btn {
        flex: 1;
        padding: 12px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .package-card {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        margin-top: 20px;
        border: 1px solid #e5e7eb;
    }

    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .status-active {
        background: #dcfce7;
        color: #166534;
    }
</style>
@endsection
@section('dashboard_content')
    <div class="page-body">
        <div class="container-fluid">
            <!-- Breadcrumb section remains the same -->
            
            <div class="row">
                <div class="col-xl-4 col-lg-5">
                    <div class="profile-card">
                        <div class="profile-header">
                            {{-- <div class="profile-avatar">
                                <img src="{{ asset('assets/images/user/default-avatar.png') }}" alt="Profile">
                            </div> --}}
                            <h3 class="mb-1">{{ $customer->name }}</h3>
                            <p class="mb-0">{{ $customer->email }}</p>
                        </div>

                        <div class="profile-info">
                            <div class="info-group">
                                <div class="info-item">
                                    <span class="info-label">Customer ID</span>
                                    <span class="info-value">#{{ $customer->id }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Mobile</span>
                                    <span class="info-value">{{ $customer->mobile ?? 'N/A' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Status</span>
                                    <span class="status-badge status-active">Active</span>
                                </div>
                            </div>

                            {{-- <div class="package-card">
                                <h5 class="mb-3">Current Package</h5>
                                <div class="info-item">
                                    <span class="info-label">Plan</span>
                                    <span class="info-value">{{ $customer->package->name ?? 'No Package' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Speed</span>
                                    <span class="info-value">{{ $customer->package->speed ?? 'N/A' }} Mbps</span>
                                </div>
                            </div> --}}

                            {{-- <div class="action-buttons">
                                <button class="btn btn-primary action-btn" type="button">
                                    <i class="fa fa-wallet me-2"></i>Add Balance
                                </button>
                                <button class="btn btn-danger action-btn" type="button">
                                    <i class="fa fa-ban me-2"></i>Block
                                </button>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <div class="col-xl-8 col-lg-7">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Personal Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="info-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="info-item">
                                                    <span class="info-label">Father's Name</span>
                                                    <span class="info-value">{{ $customer->father_name ?? 'N/A' }}</span>
                                                </div>
                                                <div class="info-item">
                                                    <span class="info-label">Mother's Name</span>
                                                    <span class="info-value">{{ $customer->mother_name ?? 'N/A' }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info-item">
                                                    <span class="info-label">Date of Birth</span>
                                                    <span class="info-value">{{ $customer->date_of_birth ?? 'N/A' }}</span>
                                                </div>
                                                <div class="info-item">
                                                    <span class="info-label">NID</span>
                                                    <span class="info-value">{{ $customer->nid ?? 'N/A' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
