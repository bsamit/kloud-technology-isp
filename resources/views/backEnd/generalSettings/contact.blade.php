@extends('home')
@section('title')
    {{ @$editData ? 'Edit Contact' : 'Contact' }}
@endsection
@section('dashboard_content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h4>  {{ @$editData ? 'Edit' : '' }} Contact</h4>
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
                            <li class="breadcrumb-item">Contact</li>
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
                            <h4>Contact List</h4><span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive custom-scrollbar">
                                <table class="display" id="basic-9">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Message</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contacts as $contact)
                                            <tr>
                                                <td>{{ $contact->name }}</td>
                                                <td>{{ $contact->email }}</td>
                                                <td>{{ $contact->phone }}</td>
                                                <td>{{ $contact->message }}</td>
                                                 
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
