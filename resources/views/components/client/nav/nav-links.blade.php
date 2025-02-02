@props([
"navItems" => [
[
"Home",
route("client.index")
],
[
"Menu",
route("client.product")
],
[
"About",
route("client.about")
],
[
"Contact",
route("client.contact")
],
]
])
<ul class="navbar-nav w-100 d-flex justify-content-center">
    @foreach ($navItems as $navItem)
    <li class="nav-item mx-3">
        <a class="nav-link nav_link fs-18 p-0 @if($loop->index < count($navItems) - 1) me-3 @endif @if(url()->current() == $navItem[1]) custom_active @endif" aria-current="page" style="color:wheat;" href="{{$navItem[1]}}">
            {!!$navItem[0]!!}
        </a>
    </li>
    @endforeach
</ul>