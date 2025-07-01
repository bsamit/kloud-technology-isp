@extends('home')
@section('title')
    {{ @$editData ? 'Edit' : 'Create' }} Ticket
@endsection
@section('dashboard_content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h4>{{ @$editData ? 'Edit' : 'Create' }} Ticket</h4>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('images/design/icon-sprite.svg') }}#stroke-home">
                                        </use>
                                    </svg></a></li>
                            <li class="breadcrumb-item">Tickets</li>
                              <li class="breadcrumb-item">
                                <a href="{{ route('helpdesk.tickets.index') }}">
                                    Ticket
                                </a>
                              </li>
                            <li class="breadcrumb-item active">
                                <a href="{{ @$editData  ? route('helpdesk.tickets.edit', $editData->id) : route('helpdesk.tickets.create') }}">
                                    {{ @$editData ? 'Edit' : 'Create' }} Ticket
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
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="card-wrapper border rounded-3 light-card checkbox-checked">
                                    @php
                                        $action = @$editData ? route('helpdesk.tickets.update', $editData->id) : route('helpdesk.tickets.store');
                                    @endphp
                                    <form class="row g-3" action="{{ $action }}" method="POST">
                                        @csrf
                                        <x-common.input-field 
                                            label="Ticket Subject" 
                                            :required="true" 
                                            column=4
                                            name="subject"
                                            placeholder="Ticket Subject" 
                                            :value="@$editData->subject" />

                                        <x-common.text-area-field 
                                            label="Ticket Details" 
                                            :required="true" 
                                            column=4
                                            name="details"
                                            placeholder="Ticket Details" 
                                            :value="@$editData->details" />

                                        <x-common.select-field
                                            label="Ticket Category" 
                                            :required="true" 
                                            column=4
                                            name="ticket_category_id"
                                            :options="$categories"
                                            :value="@$editData->ticket_category_id"/>

                                        <div class="col-12 text-center">
                                            <button class="btn btn-primary" type="submit">{{ @$editData ? 'Update' : 'Store' }} Ticket</button>
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
