@extends('home')
@section('title')
    {{ 'Manage Customer' }}
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
                                <a href="{{ route('customers.manage-customer.index') }}">
                                    Manage Customer
                                </a>
                              </li>
                              <li class="ms-5">
                                  @can('create_manage_customer')
                                <a class="btn btn-secondary-gradien" href="{{ route('customers.manage-customer.create') }}" type="button" title="Add Staff">
                                  <i class="fa fa-plus"></i> Add Customer
                                </a>
                                @endcan
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
                        <h4>Customer List</h4><span>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive custom-scrollbar">
                          <table class="display" id="basic-9">
                            <thead>
                              <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($customers as $customer)
                                <tr>
                                  <td>{{ $customer->name }}</td>
                                  <td>{{ $customer->email }}</td>
                                  <td>{{ $customer->mobile }}</td>
                                  <td>
                                    <input class="tgl tgl-flip" id="cb5{{ $customer->id }}" onchange="changeStatus('{{route('customers.manage-customer.toggle-access')}}', '{{ $customer->uuid }}')" type="checkbox" {{ $customer->status == 1 ? 'checked' : '' }}>
                                    <label class="tgl-btn" data-tg-off="In Active" data-tg-on="Active" for="cb5{{ $customer->id }}"></label>
                                  </td>
                                  <td>
                                    @can('edit_manage_customer')
                                      <a href="{{ route('customers.manage-customer.edit', $customer->uuid) }}" class="btn btn-primary btn-xs" title="Edit">
                                          <i class="fa fa-edit"></i>
                                      </a>
                                    @endcan
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
