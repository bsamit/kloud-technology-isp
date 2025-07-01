@extends('home')
@section('title')
    Change Password
@endsection
@section('dashboard_content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('images/design/icon-sprite.svg') }}#stroke-home">
                                        </use>
                                    </svg></a></li>
                              <li class="breadcrumb-item">
                                <a href="{{ route('customers.manage-customer.change-password-index') }}">
                                    Change Password
                                </a>
                              </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row size-column justify-content-center align-items-center">
                <div class="col-xxl-6 col-sm-6 box-col-6">
                    <div class="card height-equal">
                        <div class="card-header card-no-border total-revenue">
                            <h4>Change Password</h4>
                        </div>
                        <div class="card-body pt-0">
                            <div class="new-user">
                                <ul>
                                    <li>
                                        <div class="space-common">
                                            <div class="w-100">
                                                <div>
                                                    <form class="g-3" action="{{ route('customers.manage-customer.change-password-store') }}" method="POST" style="margin: 10px">
                                                        @csrf
                                                        <x-common.input-field 
                                                            label="Current Password" 
                                                            :required="true" 
                                                            column=12
                                                            name="current_password"
                                                            placeholder="Current Password"/>
                
                                                        <x-common.input-field 
                                                            label="New Password" 
                                                            :required="true" 
                                                            column=12
                                                            name="password"
                                                            placeholder="New Password"/>
                
                                                        <x-common.input-field
                                                            label="Re-Enter New Password"
                                                            :required="true" 
                                                            column=12
                                                            placeholder="Re-Enter New Password"
                                                            name="password_confirmation"/>
                
                                                        <div class="col-12 text-center mt-4">
                                                            <button class="btn btn-primary" type="submit">Change Password</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
