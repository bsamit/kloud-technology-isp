@extends('home')
@section('title')
    {{ @$editData ? 'Edit Faq' : 'Faq' }}
@endsection
@section('dashboard_content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h4>  {{ @$editData ? 'Edit' : '' }} Faq</h4>
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
                                        <form class="row g-3" method="POST" action="{{ route('general-settings.front-settings.faq.update', $editData->uuid) }}">
                                    @else
                                        <form class="row g-3" method="POST" action="{{ route('general-settings.front-settings.faq.store') }}">
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

                                        <div class="col-12 text-center">
                                            <button class="btn btn-primary" type="submit"> {{ @$editData ? 'Update' : 'Create' }}  FAQ</button>
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
                            <h4>FAQ List</h4><span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive custom-scrollbar">
                                <table class="display" id="basic-9">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($faqs as $faq)
                                            <tr>
                                                <td>{{ $faq->title }}</td>
                                                <td>{{ $faq->description }}</td>
                                                <td>
                                                    <input class="tgl tgl-flip" id="cb5{{ $faq->id }}" onchange="changeStatus('{{route('general-settings.front-settings.faq.change-status')}}', '{{ $faq->uuid }}')" type="checkbox" {{ $faq->status == 1 ? 'checked' : '' }}>
                                                    <label class="tgl-btn" data-tg-off="In Active" data-tg-on="Active" for="cb5{{ $faq->id }}"></label>
                                                </td>
                                                <td>
                                                    <ul class="action">
                                                        <li class="edit">
                                                            <a href="{{ route('general-settings.front-settings.faq.edit', $faq->uuid) }}"><i class="icon-pencil-alt"></i></a>
                                                        </li>
                                                         <li class="delete">
                                                            <a href="#" onclick="deleteModal('{{ route('general-settings.front-settings.faq.delete', $faq->uuid) }}')">
                                                                <i class="icon-trash"></i>
                                                            </a>
                                                        </li>
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
