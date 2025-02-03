@props([
"pageName"=>null
])
<nav class="col-md-5 col-lg-3 sidebar bg_primary rounded profile pt-5">
    <div class="text-center">
        <img
            id="profileImage"
            src="{{asset("images/coffee1.jpg")}}"
            class="profile-pic"
            alt="User Profile" />
        <h5 id="userName">{{auth()->user()->name}}</h5>
        <p id="userEmail">
            <i class="fas fa-envelope"></i> {{auth()->user()->email}}
        </p>
        <button class="btn btn_primary btn-sm" id="editProfile">
            <i class="fas fa-edit"></i> Edit
        </button>
    </div>
    <hr />
    <ul class="nav flex-column">
        <li class="nav-item my-1">
            <a
                class="nav-link {{$pageName=="orders"?"k_active":""}} k_active_hover"
                href="{{route("profile.index")}}"
                data-tab="orders"><i class="fas fa-shopping-cart"></i> Orders</a>
        </li>
        <li class="nav-item my-1">
            <a class="nav-link {{$pageName=="inbox"?"k_active":""}} k_active_hover" href="{{route("profile.inbox")}}" data-tab="mailbox"><i class="fas fa-envelope"></i> Mailbox</a>
        </li>
        <li class="nav-item my-1">
            <a class="nav-link {{$pageName=="setting"?"k_active":""}} k_active_hover" href="{{route("profile.setting")}}" data-tab="settings"><i class="fas fa-cog"></i> Settings</a>
        </li>
    </ul>
</nav>