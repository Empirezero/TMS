@extends('layouts.admin')

@section('content')

<div class="pagetitle">
    <h1>Notifications</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Notifications</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between border-bottom pt-4 pb-4 mb-4">
                        <h5 class="fw-semibold mb-0"><i class="bi bi-bell me-2"></i>All Notifications</h5>

                        @if($notifications->where('read_at', null)->count() > 0)
                        <form method="POST" action="{{ route('notifications.readAll') }}">
                            @csrf
                            @method('patch')
                            <button type="submit" class="btn btn-sm btn-outline-success">
                                <i class="bi bi-check2-all me-1"></i> Mark all as read
                            </button>
                        </form>
                        @endif
                    </div>

                    <div class="list-group list-group-flush">
                        @forelse($notifications as $notification)
                        <div class="list-group-item d-flex align-items-start justify-content-between gap-3 {{ is_null($notification->read_at) ? 'bg-success bg-opacity-10' : '' }}">
                            <div class="d-flex align-items-start gap-2">
                                @if(is_null($notification->read_at))
                                <i class="bi bi-exclamation-circle text-warning pt-1"></i>
                                @else
                                <i class="bi bi-info-circle text-secondary pt-1"></i>
                                @endif

                                <div>
                                    <p class="mb-1 fw-semibold">{{ $notification->data['title'] ?? 'Notification' }}</p>
                                    @if(!empty($notification->data['body']))
                                    <p class="mb-1 text-muted small">{{ $notification->data['body'] }}</p>
                                    @endif
                                    <p class="mb-0 text-muted extra-small" style="font-size: 11px;">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                            </div>

                            @if(is_null($notification->read_at))
                            <form method="POST" action="{{ route('notifications.read', $notification->id) }}" class="flex-shrink-0">
                                @csrf
                                @method('patch')
                                <button type="submit" class="btn btn-sm btn-outline-success">Mark read</button>
                            </form>
                            @endif
                        </div>
                        @empty
                        <div class="text-center text-muted py-4">No notifications yet.</div>
                        @endforelse
                    </div>

                    <div class="mt-4">
                        {{ $notifications->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection