@props(['count' => 0])

<div class="position-relative d-inline-block px-1">
    <i class="fas fa-bell text-light" style="font-size: 1.2rem;"></i>
    @if($count > 0)
    <span class="position-absolute top-0  start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.7rem;">
        {{ $count }}
    </span>
    @endif
</div>