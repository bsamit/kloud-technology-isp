@extends('home')
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
                        <li class="breadcrumb-item">Customers</li>
                        <li class="breadcrumb-item active"><a href="#">Blocked Customer</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-12 col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border">
                    <h4>Blocked Customers</h4><span>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive custom-scrollbar">
                        <table class="display" id="basic-9">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($blockedCustomers as $key => $customer)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->mobile }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->address }}</td>
                                    <td>
                                        <a href="{{ route('customers.blocked-customer.unblock', $customer->id) }}" 
                                           class="btn btn-success btn-sm"
                                           onclick="return confirm('Are you sure you want to unblock this customer?')">
                                            Unblock
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
