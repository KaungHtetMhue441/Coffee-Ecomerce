@props([
"showLogin"=>true
])

@php
if(auth()->user()){
$notifications = auth()->user()->notifications;
$notiCount = $notifications->count();
}
@endphp
<nav class="navbar navbar-expand-lg nav_container nav_text_color bg-body-tertiary px-md-5 shadow" style="position:sticky;top:0;z-index:1001; background-color:#212529!important">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            ANGEL COFFEE HOUSE
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNav">
            <x-client.nav.nav-links></x-client.nav.nav-links>
            @if($showLogin==true)

            @if(!auth()->user())
            <a class="btn btn-secondary" href="{{route("login")}}">Login</a>
            <a class="btn btn-outline-secondary ms-2" href="{{route("register")}}">Register</a>
            @else
            <div class="d-flex ">
                <x-notifications-dropdown :notifications="$notifications"></x-notifications-dropdown>
                <div class="dropdown">
                    <p class="dropdown-toggle mb-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{auth()->user()->name}}
                    </p>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route("profile.index") }}" class="ps-3" style="color:black!important;text-decoration: none;">Profile</a>
                        </li>
                        <li>
                            <form action="{{route("logout")}}" method="POST">
                                @csrf
                                <button class="dropdown-item text-black" type="submit" style="color: black!important;" href="{{route("logout")}}">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
                <div style="position: relative;">
                    <a href="{{route("cart.index")}}" class="ms-3" style="display:inline;text-decoration: none;">
                        <i class='fa fs-5 fa-cart-plus'>
                            <div style='position:relative;display: inline-block;'><span id='cart_count' style='color:coral;position:absolute; top:-25px;left: -3px;'></span></div>
                        </i>
                    </a>
                </div>
            </div>
            @endif
            @endif

        </div>

    </div>
    </div>
</nav>

<!-- <nav>
    <div class="nav_container nav_text_color text-black row px-5 py-2" style="background-color:gray;">
        <div class="container">
            <header>
                <dic class="d-flex justify-content-between">
                    <div>
                        <h4 class="text-bolder">Cofee House</h4>
                    </div>
                    <div class="nav justify-content-end">

                    </div>
                    <div>
                        <i class="fa fa-briefcase fa-lg cursor_pointer"></i>
                        <span class="px-3">

                        </span>
                        <i class="fa fa-bars fa-lg cursor_pointer"></i>
                    </div>
                </dic>
            </header>
        </div>
    </div>
</nav> -->