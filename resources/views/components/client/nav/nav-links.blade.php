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
[
"Cart <div style='position:relative;display: inline-block;'><span id='cart_count' style='color:coral;position:absolute; top:-25px;left: -3px;'></span></div>",
route("cart.index")
],
[
"Orders",
route("order.index")
],
]
])
<ul class="navbar-nav w-100 d-flex justify-content-center">
    @foreach ($navItems as $navItem)
    @if(($loop->index+2)<count($navItems) || auth()->user()!=null)
        <li class="nav-item">
            <a class="nav-link nav_link fs-18 p-0 @if($loop->index < count($navItems) - 1) me-3 @endif @if(url()->current() == $navItem[1]) custom_active @endif" aria-current="page" style="color:wheat;" href="{{$navItem[1]}}">
                {!!$navItem[0]!!}
            </a>
        </li>
        @endif
        @endforeach
</ul>