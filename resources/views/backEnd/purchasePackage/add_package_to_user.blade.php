@extends('home')
@section('title')
    Add Package
@endsection
@section('dashboard_content')
    <div class="page-body">
      <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Add Package</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('images/design/icon-sprite.svg') }}#stroke-home">
                                    </use>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Purchase Package</li>
                        <li class="breadcrumb-item">Active Package List</li>
                        <li class="breadcrumb-item active">Add Package </li>
                    </ol>
                </div>
            </div>
        </div>
      </div>

      <div class="container-fluid">
        <div class="row">
          <div class="col-xxl-12 col-sm-12">
            <div class="card">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="card-wrapper border rounded-3 light-card checkbox-checked">
                            @php
                                $action = @$editData ? route('human-resources.manage-staff.update', $editData->uuid) : route('purchase-package.add-package-to-user-store');
                            @endphp
                            <form class="row g-3" action="{{ $action }}" method="POST">
                                @csrf
                                <x-common.select-field
                                    label="Customer" 
                                    :required="true" 
                                    column=4
                                    name="user_id"
                                    :options="$users"
                                    :value="@$editData->user_id" />

                                <x-common.select-field
                                    label="Package" 
                                    :required="true" 
                                    column=4
                                    name="package_id"
                                    :options="$packages"
                                    :value="@$editData->package_id" />

                                <x-common.date-picker
                                    label="Start Date"
                                    :required="true"
                                    column=4
                                    name="start_date"
                                    :value="@$editData->start_date ? storeDateFormat($editData->start_date, 'Y-m-d') : ''"
                                />

                                <x-common.date-picker
                                    label="End Date"
                                    :required="true"
                                    column=4
                                    name="end_date"
                                    :value="@$editData->end_date ? storeDateFormat($editData->end_date, 'Y-m-d') : ''"
                                />

                                <x-common.date-picker
                                    label="Last Pay Date"
                                    :required="true"
                                    column=4
                                    name="last_payment_date"
                                    :value="@$editData->last_payment_date ? storeDateFormat($editData->last_payment_date, 'Y-m-d') : ''"
                                />

                                <x-common.input-field
                                    label="Monthly Fee"
                                    :required="true"
                                    column=4
                                    type="number"
                                    step="0.01"
                                    name="monthly_fee"
                                    :value="@$editData->monthly_fee"
                                />

                                <x-common.select-field
                                    label="Status"
                                    :required="true"
                                    column=4
                                    name="status"
                                    :options="[
                                        ['id' => 'active', 'name' => 'Active'],
                                        ['id' => 'inactive', 'name' => 'Inactive']
                                    ]"
                                    :value="@$editData->status"
                                />

                                <div class="col-12 text-center">
                                    <button class="btn btn-primary" type="submit">{{ @$editData ? 'Update' : 'Store' }} Package To User</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
      </div>
    </div>
@endsection
