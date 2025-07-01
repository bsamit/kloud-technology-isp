@extends('home')
@section('title')
    {{ @$editData ? 'Edit' : 'Create' }} Customer
@endsection
@section('dashboard_content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h4>{{ @$editData ? 'Edit' : 'Create' }} Customer</h4>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('images/design/icon-sprite.svg') }}#stroke-home">
                                        </use>
                                    </svg></a></li>
                            <li class="breadcrumb-item">Customers</li>
                              <li class="breadcrumb-item">
                                <a href="{{ route('customers.manage-customer.index') }}">
                                    Manage Customer
                                </a>
                              </li>
                            <li class="breadcrumb-item active">
                                <a href="{{ @$editData  ? route('customers.manage-customer.edit', $editData->uuid) : route('customers.manage-customer.create') }}">
                                    {{ @$editData ? 'Edit' : 'Create' }} Customer
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
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="card-wrapper border rounded-3 light-card checkbox-checked">
                                    @php
                                        $action = @$editData ? route('customers.manage-customer.update', $editData->uuid) : route('customers.manage-customer.store');
                                    @endphp
                                    <form class="row g-3" action="{{ $action }}" method="POST">
                                        @csrf
                                        <x-common.input-field 
                                            label="Customer Name" 
                                            :required="true" 
                                            column=4
                                            name="name"
                                            placeholder="Customer Name" 
                                            :value="@$editData->name" />

                                        <x-common.input-field 
                                            label="Email" 
                                            :required="true" 
                                            column=4
                                            name="email"
                                            placeholder="Email" 
                                            :value="@$editData->email" />

                                        <x-common.input-field
                                            label="Mobile Number"
                                            type="number"
                                            :required="true" 
                                            column=4 
                                            placeholder="Mobile Number"
                                            name="mobile"
                                            :value="@$editData->mobile" />

                                        <x-common.select-field
                                            label="Gender" 
                                            :required="false" 
                                            column=4
                                            name="gender_id"
                                            :options="\App\Constants::GENDER_LIST"
                                            :value="@$editData->gender_id"/>

                                        <x-common.date-picker
                                            label="Date Of Birth"
                                            :required="false"
                                            column=4
                                            name="date_of_birth"
                                            :value="@$editData->date_of_birth ? storeDateFormat($editData->date_of_birth, 'd-m-Y') : ''"
                                        />

                                        <x-common.input-field 
                                            label="NID" 
                                            :required="true" 
                                            column=4
                                            name="nid"
                                            placeholder="NID" 
                                            :value="@$editData->nid" />

                                        <x-common.input-field 
                                            label="Father Name" 
                                            :required="false" 
                                            column=4
                                            name="father_name" 
                                            placeholder="Father Name" 
                                            :value="@$editData->father_name" />

                                        <x-common.input-field 
                                            label="Mother Name" 
                                            :required="false" 
                                            column=4
                                            name="mother_name" 
                                            placeholder="Mother Name" 
                                            :value="@$editData->mother_name" />

                                        <x-common.text-area-field 
                                            label="Address" 
                                            :required="true" 
                                            column=4
                                            name="address"
                                            placeholder="Address" 
                                            :value="@$editData->address" />

                                        <div class="col-12 text-center">
                                            <button class="btn btn-primary" type="submit">{{ @$editData ? 'Update' : 'Store' }} Customer</button>
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
