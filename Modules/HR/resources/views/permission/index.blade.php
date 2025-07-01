@extends('home')
@section('title')
    {{ 'Assign Permission' }}
@endsection
@section('dashboard_content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h4>Assign Permission</h4>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('images/design/icon-sprite.svg') }}#stroke-home">
                                        </use>
                                    </svg></a></li>
                            <li class="breadcrumb-item">Human Resources</li>
                              <li class="breadcrumb-item active">
                                    <a href="{{ route('human-resources.assign-permission.index') }}">
                                        Assign Permission
                                    </a>
                              </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-3 col-sm-12">
                    <div class="card">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="card-wrapper border rounded-3 light-card checkbox-checked">
                                    <form class="row g-3" action="{{ route('human-resources.role.assignRoleToUser') }}" method="POST">
                                        @csrf
                                        <x-common.select-field label="Users" :required="true" column=12 name="user_id"
                                        :options="$userOptions" />
                                        <x-common.select-field label="Roles" :required="true" column=12 name="roles"
                                            :options="$userRoles" />
                                        <div class="col-12">
                                            <button class="btn btn-primary" type="submit">Assign Role</button>
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
