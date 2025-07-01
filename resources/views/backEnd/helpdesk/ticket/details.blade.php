@extends('home')
@section('title')
    Ticket Details
@endsection

@section('css')
<style>
.ticket-container {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(31, 45, 61, 0.125);
    margin-bottom: 15px;
}

.ticket-header {
    padding: 10px 15px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
}

.ticket-id {
    font-weight: 600;
    font-size: 16px;
}

.status-badge {
    padding: 5px 10px;
    border-radius: 5px;
    color: white;
    font-size: 12px;
}

.divider {
    color: #94a3b8;
    margin: 0 8px;
}

.label {
    color: #64748b;
    font-size: 13px;
}

.value {
    color: #1e293b;
    font-weight: 500;
    font-size: 13px;
}

.description-section {
    padding: 10px 15px;
    background: #fff;
    border-bottom: 1px solid #e2e8f0;
}

.replies-section {
    padding: 15px;
    background: #fff;
}

.reply-card {
    border-radius: 8px;
    margin-bottom: 10px;
    border: 1px solid #e2e8f0;
}

.reply-card.customer-reply {
    background: #f0fdf4;
    border-left: 3px solid #22c55e;
}

.reply-card.admin-reply {
    background: #f8fafc;
    border-left: 3px solid #6366f1;
}

.reply-header {
    padding: 10px;
    border-bottom: 1px solid #e2e8f0;
}

.reply-content {
    padding: 10px;
}

.reply-form {
    background: #f8fafc;
    padding: 15px;
    border-radius: 8px;
    margin-top: 15px;
}

.submit-btn {
    padding: 8px 15px;
    border-radius: 5px;
    background: #6366f1;
    color: #fff;
}
</style>
@endsection

@section('dashboard_content')
<div class="page-body">
    <div class="container-fluid">
        <div class="ticket-container">
            <div class="ticket-header">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="ticket-id">#{{ $ticket->id }}</span>
                    </div>
                    <div class="col-auto">
                        <span class="label">Subject:</span>
                        <span class="value">{{ $ticket->subject }}</span>
                    </div>
                    <div class="col-auto">
                        <span class="divider">|</span>
                        <span class="label">Category:</span>
                        <span class="value">{{ $ticket->ticket_category->helpdesk_category_name ?? 'N/A' }}</span>
                    </div>
                    <div class="col-auto">
                        <span class="divider">|</span>
                        <span class="label">Last Reply:</span>
                        <span class="value">{{ $ticket->user->name ?? 'Unknown User' }}</span>
                    </div>
                    <div class="col-auto">
                        <span class="divider">|</span>
                        <span class="label">Created:</span>
                        <span class="value">{{ $ticket->created_at }}</span>
                    </div>
                    <div class="col">
                        <div class="float-end">
                            <span class="status-badge badge bg-{{ $ticket->status == 'open' ? 'success' : ($ticket->status == 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($ticket->status) }}
                            </span>
                        </div>
                    </div>                    
                </div>
            </div>

            <div class="description-section">
                <span class="label">Description:</span>
                <p class="value mb-0">{{ $ticket->details }}</p>
            </div>

            <div class="replies-section">
                <h6 class="mb-3">Conversation History</h6>
                
                @forelse($ticket->ticket_replies as $reply)
                    <div class="reply-card {{ $reply->user->role_id == 4 ? 'customer-reply' : 'admin-reply' }}">
                        <div class="reply-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ asset('images/design/avtar/3.jpg') }}" class="rounded-circle" width="32" height="32">
                                    <div>
                                        <h6 class="mb-0 fs-13">{{ $reply->user->name ?? 'Unknown User' }}</h6>
                                        <small class="text-muted">{{ $reply->created_at }}</small>
                                    </div>
                                </div>
                                <span class="badge bg-{{ $reply->user->role_id == 4 ? 'success' : 'primary' }}">
                                    {{ $reply->user->role_id == 4 ? 'Customer' : 'Admin' }}
                                </span>
                            </div>
                        </div>
                        <div class="reply-content">
                            {{ $reply->details }}
                        </div>
                    </div>
                @empty
                    <div class="text-center py-3">
                        <i class="fa fa-comments text-muted mb-2"></i>
                        <p class="mb-0">No replies available for this ticket.</p>
                    </div>
                @endforelse

                <div class="reply-form">
                    <h6 class="mb-3">Add Reply</h6>
                    <form action="{{ route('helpdesk.tickets.reply', $ticket->id) }}" method="POST" class="row g-3">
                        @csrf
                        <div class="col-12">
                            <textarea class="form-control" name="details" rows="3" 
                                placeholder="Type your reply here..." required></textarea>
                        </div>
                        
                        @if (auth()->user()->role_id == 1)
                            <div class="col-md-6">
                                <x-common.select-field
                                    :required="false"
                                    column=12
                                    name="status"
                                    :options="[
                                        ['id' => 'pending', 'name' => 'Pending'],
                                        ['id' => 'closed', 'name' => 'Closed']
                                    ]"
                                />
                            </div>
                        @endif
                        
                        <div class="col-12 text-end">
                            <button type="submit" class="submit-btn">
                                <i class="fa fa-paper-plane me-2"></i>Submit Reply
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
