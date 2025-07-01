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
                        <h4>Assign Permission to >> <b> {{ $role->name }}</b></h4>
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
                                    <a href="">
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

                <div class="col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border">
                            <h4>Permission List</h4><span>
                        </div>
                        {{-- @foreach ($permissions as $permission)
                        <div class="form-check col-md-5">
                            <input
                                class="form-check-input selctOption_{{$permission->name}}"
                                type="checkbox"
                                name="permissions[]"
                                value="{{ $permission->name }}"
                                {{in_array($permission->id, $rolePermissions) ? 'checked':''}}
                                />
                            <label class="form-check-label">
                                 {{$permission->label}}
                            </label>
                        </div>
                    @endforeach --}}
                    <form action="{{route('human-resources.role.givePermissionToRole')}}" method="POST">
                        @csrf
                         <input type="hidden" name="role_id" value="{{ $role->id }}" />
                        <div class="card-body">

                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="form-check">
    <input class="form-check-input" id="select-all" type="checkbox">
    <label class="form-check-label" for="select-all">Select All</label>
</div>
<hr>
</div>
                        @foreach ($permissions->groupBy('menu') as $menu => $groupedPermissions)
    <div class="col-md-4">
        <h5 style="color: #066;">{{ $menu }}</h5> <!-- Display menu name -->
        @foreach ($groupedPermissions as $permission)
            <div class="form-check">
                <input 
                    class="form-check-input permission-checkbox" 
                    name="permissions[]" 
                    id="{{ $permission->name }}" 
                    type="checkbox" 
                    value="{{ $permission->name }}" 
                    {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                >
                <label class="form-check-label" for="{{ $permission->name }}">
                    {{ $permission->label }}
                </label>
            </div>
        @endforeach
    </div>
@endforeach

                        </div>
                        <div class="mb-3"><br>
                            <button type="submit" class="btn btn-primary">Update Permission</button>
                        </div>
                    </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<script>
    document.getElementById('select-all').addEventListener('change', function () {
        // Get all checkboxes with the class 'permission-checkbox'
        const checkboxes = document.querySelectorAll('.permission-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
</script>
@endsection


