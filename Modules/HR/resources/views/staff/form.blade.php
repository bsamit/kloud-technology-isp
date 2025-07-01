@extends('home')
@section('title')
    {{ @$editData ? 'Edit' : 'Create' }} Staff
@endsection
@section('dashboard_content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h4>{{ @$editData ? 'Edit' : 'Create' }} Staff</h4>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('images/design/icon-sprite.svg') }}#stroke-home">
                                        </use>
                                    </svg></a></li>
                            <li class="breadcrumb-item">Human Resources</li>
                              <li class="breadcrumb-item">
                                <a href="{{ route('human-resources.manage-staff.index') }}">
                                    Manage Staff
                                </a>
                              </li>
                            <li class="breadcrumb-item active">
                                <a href="{{ @$editData  ? route('human-resources.manage-staff.edit', $editData->uuid) :route('human-resources.manage-staff.create') }}">
                                    {{ @$editData ? 'Edit' : 'Create' }} Staff
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
                                        $action = @$editData ? route('human-resources.manage-staff.update', $editData->uuid) : route('human-resources.manage-staff.store');
                                    @endphp
                                    <form class="row g-3" action="{{ $action }}" method="POST">
                                        @csrf
                                        <x-common.input-field 
                                            label="Staff Full Name" 
                                            :required="true" 
                                            column=4
                                            name="name"
                                            placeholder="Staff Name" 
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

                                        <x-common.select-field
                                            label="Role" 
                                            :required="true" 
                                            column=4
                                            name="role_id"
                                            :options="$roles"
                                            :value="@$editData->role_id"/>

                                        <x-common.date-picker
                                            label="Date Of Birth"
                                            :required="false"
                                            column=4
                                            name="date_of_birth"
                                            :value="@$editData->date_of_birth ? storeDateFormat($editData->date_of_birth, 'Y-m-d') : ''"
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

                                        <x-common.input-field 
                                            label="Salary" 
                                            :required="false" 
                                            column=4
                                            name="salary"
                                            placeholder="Salary" 
                                            :value="@$editData->salary"/>

                                        <x-common.text-area-field 
                                            label="Address" 
                                            :required="false" 
                                            column=4
                                            name="address"
                                            placeholder="Address" 
                                            :value="@$editData->address" />

                                        <x-common.text-area-field 
                                            label="Reference Details" 
                                            :required="false" 
                                            column=4
                                            name="ref_details"
                                            placeholder="Reference Details" 
                                            :value="@$editData->ref_details" />

                                        <div class="col-md-12">
                                            <label class="col-form-label"><strong>Status</strong> </label>
                                            <div class="form-check-size rtl-input">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input me-2" id="inlineRadio1" type="radio"
                                                        name="status" value="1" checked="">
                                                    <label class="form-check-label" for="inlineRadio1">Active</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input me-2" id="inlineRadio2" type="radio"
                                                        name="status" value="0">
                                                    <label class="form-check-label" for="inlineRadio2">Inactive</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 text-center">
                                            <button class="btn btn-primary" type="submit">{{ @$editData ? 'Update' : 'Store' }} Staff</button>
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
