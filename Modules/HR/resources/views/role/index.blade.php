@extends('home')
@section('title')
   @section('title')
    {{ @$id ? 'Edit' : 'Create' }} Role
@endsection
@endsection
@section('dashboard_content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h4>  {{ @$id ? 'Edit' : '' }} Role</h4>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('images/design/icon-sprite.svg') }}#stroke-home">
                                        </use>
                                    </svg>
                                </a>
                            </li>
                            <li class="breadcrumb-item">Human Resources</li>
                            <li class="breadcrumb-item">Role</li>
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
                                    @if(@$id)
                                    <form class="row g-3" method="POST" action="{{ route('human-resources.role.update') }}">
                                    @else
                                      <form class="row g-3" method="POST" action="{{ route('human-resources.role.store') }}">

                                    @endif
                                        @csrf
                                        <input type="hidden" name="id" value="{{ @$id }}" />
                                        <x-common.input-field
                                        label="Role Name"
                                        :required="true"
                                        column=12
                                        name="name"
                                        placeholder="Enter Role Name"
                                        value="{{ @$role->name }}"
                                    />
                                        <div class="col-12">
                                             @can('create_role')
                                            <button class="btn btn-primary" type="submit"> {{ @$id ? 'Update' : 'Create' }}  Role</button>
                                            @endcan
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-9 col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border">
                            <h4>Role List</h4><span>
                        </div>

                        <div class="card-body">
                               <div class="table-responsive custom-scrollbar">
                          <table class="display" id="basic-9">
                            <thead>
                              <tr>
                                <th>Role Name</th>
                                <th>Assign Permission </th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                              <tr>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a class="btn btn-pill btn-success-gradien" type="button" href="{{url('human-resources/roles/'.$role->id.'/give-permissions')}}">
                                        Assign Permission
                                    </a>
                                </td>
                                <td>
                                  <ul class="action">
                                    <li class="edit">
                                            <a href="{{ route('human-resources.role.edit', $role->id) }}"><i class="icon-pencil-alt"></i></a></li>
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
