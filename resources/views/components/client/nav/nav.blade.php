<nav class="navbar navbar-expand-lg nav_container nav_text_color bg-body-tertiary px-5 py-3 shadow" style="position:sticky;top:0;z-index:1001;">
    <div class="container-fluid d-flex justify-content-between">
        <div class="col-md-3 col-12">
            <a class="navbar-brand" href="/">Coffee House</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="col-5 ">
            <div class="collapse navbar-collapse d-flex justify-content-center" id="navbarNav">
                <x-client.nav.nav-links></x-client.nav.nav-links>
            </div>
        </div>
        <div class="col-3 d-flex justify-content-end">

            @if (!auth()->user())
            <a class="btn btn-secondary" href="{{route("login")}}">Login</a>
            <a class="btn btn-outline-secondary ms-2" href="{{route("register")}}">Register</a>
            @else
            <div class="dropdown">
                <p class="dropdown-toggle mb-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{auth()->user()->name}}
                </p>
                <ul class="dropdown-menu">
                    <li>
                        <form action="{{route("logout")}}" method="POST">
                            @csrf
                            <button class="dropdown-item text-black" type="submit" style="color: black!important;" href="{{route("logout")}}">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
            <h4></h4>
            @endif
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