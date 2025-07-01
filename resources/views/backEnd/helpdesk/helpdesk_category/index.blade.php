@extends('home')
@section('title')
    {{ @$editData ? 'Edit Ticket Category' : 'Ticket Category' }}
@endsection
@section('dashboard_content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h4>{{ @$editData ? 'Edit' : 'Add' }} Ticket Category</h4>
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
                            <li class="breadcrumb-item">Helpdesk</li>
                            <li class="breadcrumb-item">Ticket Category</li>
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
                                        $action  = @$editData ? route('helpdesk.helpdesk-categories.update',$editData->id) : route('helpdesk.helpdesk-categories.store');
                                    @endphp
                                    <form class="row g-3" action="{{ $action }}" method="POST">
                                        @csrf

                                        <x-common.input-field label="Category Name" :required="true" column=12
                                            name="helpdesk_category_name" placeholder="Enter Ticket Category Name" :value="@$editData->helpdesk_category_name" />
                                        
                                        <div class="col-12 mt-5 text-center">
                                            <button class="btn btn-primary" type="submit">{{ @$editData ? 'Edit' : 'Store' }} Ticket Category</button>
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
                            <h4>Ticket Category List</h4><span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive custom-scrollbar">
                                <table class="display" id="basic-9">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($helpdesk_categories as $key => $category)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$category->helpdesk_category_name}}</td>
                                                <td>
                                                    <input class="tgl tgl-flip" id="cb5{{ $category->id }}" onchange="changeStatus('{{route('helpdesk.helpdesk-categories.change-status')}}', '{{ $category->id }}')" type="checkbox" {{ $category->status == 1 ? 'checked' : '' }}>
                                                    <label class="tgl-btn" data-tg-off="In Active" data-tg-on="Active" for="cb5{{ $category->id }}"></label>
                                                </td>
                                                <td>
                                                    <ul class="action">
                                                        <li class="edit"> 
                                                            <a href="{{route('helpdesk.helpdesk-categories.edit',$category->id)}}">
                                                                <i class="icon-pencil-alt"></i>
                                                            </a>
                                                        </li>
                                                        <li class="delete"><a href="#" onclick="deleteModal('{{ route('helpdesk.helpdesk-categories.delete') }}', '{{ $category->id }}')"><i class="icon-trash"></i></a></li>
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
