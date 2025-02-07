@props(['notification'])

<a href="#"
    onclick="markAsRead('{{ $notification->id }}', event)"
    class="dropdown-item py-2 {{ !$notification->read_at ? 'bg-light' : '' }}">
    <div class="d-flex flex-column">
        <p class="text-justify">{{ $notification->data['message'] ?? 'Notification' }}</p>
        <small class="text-muted mt-1">{{ $notification->created_at->diffForHumans() }}</small>
    </div>
</a>