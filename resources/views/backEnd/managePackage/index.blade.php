@extends('home')
@section('title')
    {{ @$editData ? 'Edit manage Package' : 'Manage Package' }}
@endsection
@section('dashboard_content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h4>{{ @$editData ? 'Edit' : 'Add' }} Packages</h4>
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
                            <li class="breadcrumb-item active">Manage Package</li>
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
                                    @php
                                        $action  = @$editData ? route('manage-package.package.update',$editData->uuid) : route('manage-package.package.store');
                                    @endphp
                                    <form class="row g-3" action="{{ $action }}" method="POST">
                                        @csrf
                                        <x-common.select-field 
                                            label="Select Package Category" 
                                            :required="true" column=12
                                            name="package_category_id" 
                                            :options="$package_category" 
                                            :value="@$editData->package_category_id" />

                                        <x-common.input-field label="Plan Name" :required="true" column=12
                                            name="plan_name" placeholder="Enter Plan Name" :value="@$editData->plan_name" />

                                        <x-common.input-field label="Title" :required="true" column=12
                                            name="title" placeholder="Enter Title" :value="@$editData->title" />

                                        <x-common.input-field label="Speed" :required="true" column=12 name="speed"
                                            placeholder="Enter Speed" :value="@$editData->speed" />

                                        <x-common.input-field label="Monthly Cost" :required="true" column=12
                                            name="monthly_cost" placeholder="Monthly Cost" :value="@$editData->monthly_cost" />
                                        <div>
                                            <hr>
                                        </div>
                                            @if (@$editData)
                                                <div class="repeater-container">
                                                    @foreach ($editData->packageDetails as $key => $data)
                                                        <div class="repeater-item">
                                                            <x-common.input-field label="Attribute {{$key+1}}" :required="false" column=12
                                                                name="attributes[{{$key+1}}][name]" placeholder="Enter Attribute"
                                                                :value="$data->name" />
                                                            <button class="btn btn-pill btn-danger btn-air-danger btn-xs remove-item"
                                                                type="button"
                                                                title="btn btn-pill btn-danger btn-air-danger btn-xs">Delete</button>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="repeater-container">
                                                    <div class="repeater-item">
                                                        <x-common.input-field label="Attribute" :required="false" column=12
                                                            name="attributes[1][name]" placeholder="Enter Attribute"
                                                            value="" />
                                                        <button class="btn btn-pill btn-danger btn-air-danger btn-xs remove-item"
                                                            type="button"
                                                            title="btn btn-pill btn-danger btn-air-danger btn-xs">Delete</button>
                                                    </div>
                                                </div>
                                            @endif
                                        
                                        <div class="col-12 text-end">
                                            <button type="button" class="btn btn-warning add-more">Add More</button>
                                        </div>
                                        <div class="col-12 mt-5 text-center">
                                             @can('create_package')
                                                <button class="btn btn-primary" type="submit">{{ @$editData ? 'Update' : 'Save' }} Package</button>
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
                            <h4>Package Lists</h4><span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive custom-scrollbar">
                                <table class="display" id="basic-9">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Category</th>
                                            <th>Plan Name</th>
                                            <th>Title</th>
                                            <th>Speed</th>
                                            <th>Cost(MO)</th>
                                            <th>Details</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($package_lists as $key => $package)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$package->packageCategory->name ?? ''}}</td>
                                                <td>{{$package->plan_name}}</td>
                                                <td>{{$package->title}}</td>
                                                <td>{{$package->speed}}</td>
                                                <td>{{$package->monthly_cost}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary badge rounded-pill badge-light-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$package->id}}">
                                                        View
                                                    </button>
                                                </td>
                                                <td>
                                                    <input class="tgl tgl-flip" id="cb5{{ $package->id }}" onchange="changeStatus('{{route('manage-package.package.change-status')}}', '{{ $package->uuid }}')" type="checkbox" {{ $package->status == 1 ? 'checked' : '' }}>
                                                    <label class="tgl-btn" data-tg-off="In Active" data-tg-on="Active" for="cb5{{ $package->id }}"></label>
                                                </td>
                                                <td>
                                                    <ul class="action">
                                                        <li class="edit"> 
                                                            <a href="{{route('manage-package.package.edit',$package->uuid)}}">
                                                                <i class="icon-pencil-alt"></i>
                                                            </a>
                                                        </li>
                                                        @if (!$package->plan_name)
                                                            <li class="delete"><a href="#" onclick="deleteModal('{{ route('manage-package.delete') }}', '{{ $package->uuid }}')"><i class="icon-trash"></i></a></li>
                                                        @endif
                                                    </ul>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="exampleModal{{$package->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLabel">Package Details</h5>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    @foreach($package->packageDetails as $detail)
                                                        <p>{{ $detail->name }}</p>
                                                    @endforeach
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
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
        $(document).ready(function() {
            let counter = $('.repeater-item').length;

            $('.add-more').click(function() {
                counter++;
                let repeaterItem = $('.repeater-item:first').clone();
                repeaterItem.find('input').val('');

                repeaterItem.find('input[name^="attributes"][name$="[name]"]')
                    .attr('name', 'attributes[' + counter + '][name]');

                repeaterItem.find('label:contains("Attribute")').text('Attribute ' + counter);

                $('.repeater-container').append(repeaterItem);
            });

            $(document).on('click', '.remove-item', function() {
                if ($('.repeater-item').length > 1) {
                    $(this).closest('.repeater-item').remove();
                    reorderItems();
                }
            });

            function reorderItems() {
                $('.repeater-item').each(function(index) {
                    let newIndex = index + 1;
                    $(this).find('input[name^="attributes"][name$="[name]"]')
                        .attr('name', 'attributes[' + newIndex + '][name]');
                    $(this).find('label:contains("Attribute")').text('Attribute ' + newIndex);
                });
                counter = $('.repeater-item').length;
            }
        });
    </script>
@endsection
