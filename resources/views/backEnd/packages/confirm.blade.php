@extends('home')
@section('title')
    Confirm Package
@endsection
@section('dashboard_content')
<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-3 col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>{{$package->plan_name}}</h5>
                            <span class="badge badge-success">Active</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="package-price text-center mb-4">
                            <h2 class="mb-2">TK. {{$package->monthly_cost}}<small>/month</small></h2>
                            <p class="text-muted">{{$package->speed}} Mbps</p>
                        </div>
                        <ul class="package-features">
                            @foreach ($package->packageDetails as $detail)
                                <li>
                                    <i class="fa fa-check text-success me-2"></i>{{$detail->name}}
                                </li>
                            @endforeach
                        </ul>
                        
                        <form action="{{ route('package.purchase', $package->id) }}" method="POST" class="mt-4">
                            @csrf
                            <div class="form-group mb-3">
                                <label>Payment Method</label>
                                <select name="payment_method" class="form-control" required>
                                    <option value="cash">Cash Payment</option>
                                    <option value="bank">Bank Transfer</option>
                                    <option value="mobile_banking">Mobile Banking</option>
                                </select>
                            </div>
                            
                            <div id="payment_proof_section" class="form-group mb-3 d-none">
                                <label>Payment Proof</label>
                                <input type="file" name="payment_proof" class="form-control" accept="image/*,application/pdf">
                                <small class="text-muted">Upload payment receipt/screenshot</small>
                            </div>

                            <div class="form-group mb-3">
                                <label>Note (Optional)</label>
                                <textarea name="note" class="form-control" rows="3" placeholder="Any special requirements or notes"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                Confirm Purchase
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Package Information -->
            <div class="col-xxl-9 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Package Details & Terms</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Package Information</h6>
                                <ul class="list-unstyled">
                                    <li><strong>Speed:</strong> {{$package->speed}} Mbps</li>
                                    <li><strong>Monthly Cost:</strong> TK. {{$package->monthly_cost}}</li>
                                    <li><strong>Minimum Contract:</strong> {{$package->minimum_contract ?? 'No contract'}} months</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6>Terms & Conditions</h6>
                                <ul class="list-unstyled">
                                    <li>- Monthly bill must be paid within the due date</li>
                                    <li>- Service may be suspended for unpaid bills</li>
                                    <li>- Installation timeline depends on location</li>
                                    <li>- Actual speed may vary based on various factors</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('select[name="payment_method"]').change(function() {
            if ($(this).val() !== 'cash') {
                $('#payment_proof_section').removeClass('d-none');
            } else {
                $('#payment_proof_section').addClass('d-none');
            }
        });
    });
</script>
@endsection
