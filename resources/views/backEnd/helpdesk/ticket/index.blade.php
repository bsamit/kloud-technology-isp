@extends('home')
@section('title')
    {{ "$status Ticket" }}
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
                              <li class="breadcrumb-item">Helpdesk</li>
                              <li class="breadcrumb-item active">
                                <a href="#">
                                    {{$status}} Ticket
                                </a>
                              </li>
                              @if (auth()->user()->role_id == 4)
                                <li class="ms-5">
                                    <a class="btn btn-secondary-gradien" href="{{ route('helpdesk.tickets.create') }}" type="button" title="Add Ticket">
                                        <i class="fa fa-plus"></i> Add Ticket
                                    </a>
                                </li>
                              @endif
                          </ol>
                      </div>
                </div>
            </div>
        </div>

        <x-common.data-table :label="$status . ' Ticket'">
            <table class="display" id="basic-9">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Details</th>
                        <th>Ticket Category</th>
                        <th>Status </th>
                        <th>Action </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->subject }}</td>
                        <td>{{ $ticket->details }}</td>
                        <td>{{ @$ticket->ticket_category->helpdesk_category_name }}</td>
                        <td>{{ucfirst($ticket->status)}}</td>
                        <td>
                            <ul class="action">
                                <li class="edit">
                                    <a href="{{ route('helpdesk.tickets.details', ['id' => $ticket->id, 'tab' => 'basic-info']) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </li>
                                @if (auth()->user()->role_id == 1)
                                    <li class="delete">
                                        <a href="javascript:void(0);" onclick="deleteModal('{{ route('helpdesk.tickets.delete') }}', '{{ $ticket->id }}')">
                                            <i class="icon-trash"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </x-common.data-table>
    </div>
@endsection
