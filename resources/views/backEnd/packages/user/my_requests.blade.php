@extends('home')
@section('title')
    My Package Requests
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
                        <li class="breadcrumb-item">Packages</li>
                        <li class="breadcrumb-item active">My Requests</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <x-common.data-table label='My Package Requests'>
        <table class="display" id="basic-9">
            <thead>
                <tr>
                    <th>Request Date</th>
                    <th>Package</th>
                    <th>Speed</th>
                    <th>Monthly Cost</th>
                    <th>Note</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $request)
                    <tr>
                        <td>{{ $request->created_at->format('d M Y') }}</td>
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
                            @if($request->status == 'approved')
                                Approved by: {{ optional($request->approvedBy)->name ?? 'N/A' }}<br>
                                <small>{{ $request->approved_at ? $request->approved_at->format('d M Y H:i') : '' }}</small>
                            @elseif($request->status == 'rejected')
                                Reason: {{ $request->rejection_reason }}<br>
                                <small>{{ $request->rejected_at ? $request->rejected_at->format('d M Y H:i') : '' }}</small>
                            @else
                                <span class="text-warning">Awaiting Response</span>
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
    $(document).ready(function() {
        $('#basic-9').DataTable();
    });
</script>
@endsection
