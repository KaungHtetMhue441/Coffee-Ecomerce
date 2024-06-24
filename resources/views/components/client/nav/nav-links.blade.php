@props([
"navItems"=>[
[ "Home",
route("client.index")
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
<ul class="navbar-nav float-end">
    @foreach ($navItems as $navItem)
    <li class="">
        <a class="nav_link d-inline-block text-decoration-none py-0 px-0 me-3 @if(url()->current()== $navItem[1]) active @endif" aria-current="page" href="{{$navItem[1]}}">
            {{$navItem[0]}}
        </a>
    </li>
    @endforeach
</ul>