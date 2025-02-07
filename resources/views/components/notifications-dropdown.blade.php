@props(['notifications'])

<div class="dropdown d-inline">
    <button class="btn p-0 me-3" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <x-notification-icon :count="auth()->user()->unreadNotifications->count()" />
    </button>
    <ul class="dropdown-menu dropdown-menu-end shadow" style="width: 400px; max-height: 400px; overflow-y: auto;">
        @forelse($notifications as $notification)
        <li>
            <a class="dropdown-item py-2 {{ !$notification->read_at ? 'bg-light' : '' }}"
                href="{{ route('order.show', $notification->data['order_id']) }}"
                onclick="event.preventDefault(); markAsRead('{{ $notification->id }}', '{{ route('order.tracking', $notification->data['order_id']) }}')">
                <div class="d-flex flex-column">
                    <span class="text-black">{{ $notification->data['message'] }}</span>
                    <small class="text-muted mt-1 text-black">{{ $notification->created_at->diffForHumans() }}</small>
                </div>
            </a>
        </li>
        @empty
        <li><span class="dropdown-item py-2">No notifications</span></li>
        @endforelse

        @if($notifications->count() > 0)
        <li>
            <hr class="dropdown-divider my-2">
        </li>
        <li>
            <form action="{{ route('notifications.markAllAsRead') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item py-2 text-primary">
                    <i class="fas fa-check-double me-2"></i> Mark all as read
                </button>
            </form>
        </li>
        @endif
    </ul>
</div>