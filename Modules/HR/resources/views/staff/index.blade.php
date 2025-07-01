@extends('home')
@section('title')
    {{ 'Staff List' }}
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
                              <li class="breadcrumb-item">Human Resources</li>
                              <li class="breadcrumb-item active">
                                <a href="{{ route('human-resources.manage-staff.index') }}">
                                    Manage Staff
                                </a>
                              </li>
                              <li class="ms-5">
                                  @can('create_staff')
                                <a class="btn btn-secondary-gradien" href="{{ route('human-resources.manage-staff.create') }}" type="button" title="Add Staff">
                                  <i class="fa fa-plus"></i> Add Staff
                                </a>
                                @endcan
                              </li>
                          </ol>
                      </div>
                </div>
            </div>
        </div>

        <x-common.data-table label='Staff List'>
            <table class="display" id="basic-9">
                <thead>
                  <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>NID</th>
                    <th>Mobile</th>
                    <th>Role</th>
                    <th>Status </th>
                    <th>Action </th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($staffs as $staff)
                        <tr>
                            <td>{{ $staff->name }}</td>
                            <td>{{ $staff->email }}</td>
                            <td>{{ collect(\App\Constants::GENDER_LIST)->firstWhere('id', $staff->gender_id ?? 1)['name'] }}</td>
                            <td>{{ $staff->nid }}</td>
                            <td>{{ $staff->mobile }}</td>
                            <td> <span class="badge rounded-pill badge-light-primary">  {{ $staff->role->name ?? 'No roles assigned' }}</span></td>
                            <td>
                                @if($staff->status == 0)
                                    <span class="badge rounded-pill badge-light-secondary">Inactive</span>
                                @else
                                    <span class="badge rounded-pill badge-light-primary">Active</span>
                                @endif
                            </td>
                            <td>
                                <ul class="action">
                                    <li class="edit">
                                        <a href="{{ route('human-resources.manage-staff.edit', $staff->uuid) }}">
                                            <i class="icon-pencil-alt"></i>
                                        </a>
                                    </li>
                                    <li class="delete">
                                        <a href="javascript:void(0);" onclick="confirmDelete('{{ route('human-resources.manage-staff.delete', $staff->uuid) }}')">
                                            <i class="icon-trash"></i>
                                        </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-common.data-table>
    </div>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(route) {
    Swal.fire({
        title: 'Are you sure to delete?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: route,
                type: 'GET',
                success: function(response) {
                    if(response.success) {
                        Swal.fire('Deleted!', 'The staff member has been deleted.', 'success');
                        location.reload();
                    } else {
                        Swal.fire('Error!', 'There was an issue deleting the staff member.', 'error');
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire('Error!', 'There was an issue deleting the staff member.', 'error');
                }
            });
        }
    });
}
</script>

@endsection
