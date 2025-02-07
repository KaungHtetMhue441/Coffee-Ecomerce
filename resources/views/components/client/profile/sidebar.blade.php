@props([
"pageName"=>null
])
<nav class="col-md-5 col-lg-3 sidebar bg_primary rounded profile pt-5">
    <div class="text-center">
        <div class="row justify-content-center">
            <div class=" overflow-hidden profile-pic-container">
                <img
                    id="profileImage"
                    class="profile-pic"
                    src="{{asset("images/coffee1.jpg")}}"
                    alt="User Profile" />
            </div>
        </div>
        <h5 id="userName" class="text-white">{{auth()->user()->name}}</h5>
        <p id="userEmail" class="text-white">
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
                class="nav-link text-white {{$pageName=="orders"?"k_active":""}} k_active_hover"
                href="{{route("profile.index")}}"
                data-tab="orders"><i class="fas fa-shopping-cart"></i> Orders</a>
        </li>
        <li class="nav-item my-1">
            <a class="nav-link text-white  {{$pageName=="inbox"?"k_active":""}} k_active_hover" href="{{route("profile.inbox")}}" data-tab="mailbox"><i class="fas fa-envelope"></i> Mailbox</a>
        </li>
        <li class="nav-item my-1">
            <a class="nav-link text-white  {{$pageName=="setting"?"k_active":""}} k_active_hover" href="{{route("profile.setting")}}" data-tab="settings"><i class="fas fa-cog"></i> Settings</a>
        </li>
    </ul>
</nav>