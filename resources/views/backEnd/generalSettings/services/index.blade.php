@extends('home')
@section('title')
    {{ @$editData ? 'Edit Services' : 'Services' }}
@endsection
@section('dashboard_content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h4>  {{ @$editData ? 'Edit' : '' }} Services</h4>
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
                <div class="col-xxl-4 col-sm-12">
                    <div class="card">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="card-wrapper border rounded-3 light-card checkbox-checked">
                                    @if(@$editData)
                                        <form class="row g-3" method="POST" action="{{ route('general-settings.front-settings.services.update', $editData->uuid) }}" enctype="multipart/form-data">
                                    @else
                                        <form class="row g-3" method="POST" action="{{ route('general-settings.front-settings.services.store') }}" enctype="multipart/form-data">
                                    @endif
                                        @csrf
                                        <input type="hidden" name="id" value="{{ @$editData->id }}"/>
                                        <x-common.input-field
                                            label="Title"
                                            :required="true"
                                            column=12
                                            name="title"
                                            placeholder="Enter Name"
                                            value="{{@$editData->title}}"
                                        />

                                        <x-common.text-area-field
                                            label="Description"
                                            :required="true"
                                            column=12
                                            name="description"
                                            rows="6"
                                            placeholder="Enter Description"
                                            value="{{@$editData->description}}"
                                        />

                                        <div class="col-12">
                                            <label class="form-label" for="image">Image*</label>
                                            <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="previewImage(this)">
                                            <div class="mt-2">
                                                <img id="imagePreview" src="{{ @$editData ? asset($editData->image) : '' }}" 
                                                    alt="Image Preview" style="max-width: 200px; display: {{ @$editData && @$editData->image ? 'block' : 'none' }}">
                                            </div>
                                        </div>

                                        <x-common.select-field
                                            label="Status"
                                            :required="true"
                                            column=12
                                            name="status"
                                            :options="[
                                                ['id' => 1, 'name' => 'Active'],
                                                ['id' => 2, 'name' => 'In Active']
                                            ]"
                                            value="{{@$editData->status}}"
                                        />

                                            @if (@$editData && count(@$editData->serviceDetails) > 0)
                                                <div class="repeater-container">
                                                    @foreach ($editData->serviceDetails as $key => $data)
                                                        <div class="repeater-item">
                                                            <x-common.input-field label="Attribute {{$key+1}}" :required="false" column=12
                                                                name="attributes[{{$key+1}}][name]" placeholder="Enter Attribute"
                                                                :value="$data->title" />
                                                            <x-common.text-area-field label="Value {{$key+1}}" :required="false" column=12
                                                                name="attributes[{{$key+1}}][value]" placeholder="Enter Value" :value="$data->description" />
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
                                                        <x-common.text-area-field label="Value" :required="false" column=12
                                                            name="attributes[1][value]" placeholder="Enter Value" value="" />
                                                        <button class="btn btn-pill btn-danger btn-air-danger btn-xs remove-item"
                                                            type="button"
                                                            title="btn btn-pill btn-danger btn-air-danger btn-xs">Delete</button>
                                                    </div>
                                                </div>
                                            @endif

                                        <div class="col-12 text-end">
                                            <button type="button" class="btn btn-warning add-more">Add More</button>
                                        </div>
                                        
                                        <div class="col-12 text-center">
                                            <button class="btn btn-primary" type="submit"> {{ @$editData ? 'Update' : 'Create' }}  Service</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xxl-8 col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border">
                            <h4>Services List</h4><span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive custom-scrollbar">
                                <table class="display" id="basic-9">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Details</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($services as $service)
                                            <tr>
                                                <td>{{ $service->title }}</td>
                                                <td>
                                                    @if($service->image)
                                                        <img src="{{ asset($service->image) }}" alt="{{ $service->title }}" class="table-img" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                                                    @else
                                                        <span class="text-muted">No Preview</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary badge rounded-pill badge-light-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$service->id}}">
                                                        View
                                                    </button>
                                                </td>
                                                <td>
                                                    <input class="tgl tgl-flip" id="cb5{{ $service->id }}" onchange="changeStatus('{{route('general-settings.front-settings.services.change-status')}}', '{{ $service->uuid }}')" type="checkbox" {{ $service->status == 1 ? 'checked' : '' }}>
                                                    <label class="tgl-btn" data-tg-off="In Active" data-tg-on="Active" for="cb5{{ $service->id }}"></label>
                                                <td>
                                                    <ul class="action">
                                                        <li class="edit">
                                                            <a href="{{ route('general-settings.front-settings.services.edit', $service->uuid) }}"><i class="icon-pencil-alt"></i></a>
                                                        </li>
                                                        <li class="delete">
                                                            <a href="#" onclick="deleteModal('{{route('general-settings.front-settings.services.delete')}}', '{{ $service->uuid }}')">
                                                                <i class="icon-trash"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="exampleModal{{$service->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLabel">Service Details</h5>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @foreach($service->serviceDetails as $detail)
                                                            <div class="card mb-3 shadow-sm">
                                                                <div class="card-body">
                                                                    <h6 class="card-title text-primary fw-bold">{{ $detail->title }}</h6>
                                                                    <p class="card-text text-muted">{{ $detail->description }}</p>
                                                                </div>
                                                            </div>
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
                
                // Clear all input and textarea values
                repeaterItem.find('input, textarea').val('');

                // Update name attributes for both input and textarea
                repeaterItem.find('input[name^="attributes"][name$="[name]"]')
                    .attr('name', 'attributes[' + counter + '][name]');
                repeaterItem.find('textarea[name^="attributes"][name$="[value]"]')
                    .attr('name', 'attributes[' + counter + '][value]');

                // Update labels
                repeaterItem.find('label:contains("Attribute")').text('Attribute ' + counter);
                repeaterItem.find('label:contains("Value")').text('Value ' + counter);

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
                    // Update name attributes for both input and textarea
                    $(this).find('input[name^="attributes"][name$="[name]"]')
                        .attr('name', 'attributes[' + newIndex + '][name]');
                    $(this).find('textarea[name^="attributes"][name$="[value]"]')
                        .attr('name', 'attributes[' + newIndex + '][value]');
                    
                    // Update labels
                    $(this).find('label:contains("Attribute")').text('Attribute ' + newIndex);
                    $(this).find('label:contains("Value")').text('Value ' + newIndex);
                });
                counter = $('.repeater-item').length;
            }
        });

        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }
    </script>
@endsection