@extends('home')
@section('title')
    Potential Customer
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
                              <li class="breadcrumb-item">Customers</li>
                              <li class="breadcrumb-item active">
                                <a href="{{ route('customers.potential-customer.index') }}">
                                    Potential Customer
                                </a>
                              </li>
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
                        <h4>Potential Customer List</h4><span>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive custom-scrollbar">
                          <table class="display" id="basic-9">
                            <thead>
                              <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($potential_customers as $customer)
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->mobile }}</td>
                                    <td>{{ $customer->address }}</td>
                                    <td>
                                        @if($customer->is_active == 2)
                                            <span class="badge rounded-pill badge-light-secondary">Verified</span>
                                        @else
                                            <span class="badge rounded-pill badge-light-primary">Not Verified</span>
                                        @endif
                                    </td>
                                    <td>
                                        <ul class="action">
                                            @if($customer->is_active == 2)
                                                <li class="edit">
                                                    <a href="#" onclick="confirmModal('{{ route('customers.potential-customer.add-to-active-customer',$customer->uuid)}}')">
                                                        <i class="fa fa-check-circle fa-5x text-success"></i>
                                                    </a>
                                                </li>
                                            @else
                                            @endif
                                        </ul>
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
@section('scripts')
<script>
    const confirmModal = function(route) {
        Swal.fire({
            title: 'Are You Sure To Add Active Customer?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Add To Active Customer'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'GET',
                    url: route,
                    success: function(response) {
                        Swal.fire({
                            title: "Success",
                            text: response.message,
                            icon: "success"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }
        });
    };
</script>
@endsection