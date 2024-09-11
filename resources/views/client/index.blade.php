@php
$menus = [
"Latest Menu",
"Upcoming Menu",
"Trending Menu"
]
@endphp
<x-client.app>
    <x-slot name="title">
        Home
    </x-slot>
    <x-slot name="content">
        <div class="row my-md-5 pb-3 pt-3 pb-5 px-3">
            <div class="col-12 col-md-6 text-justify my-md-5 mb-3 pb-3 pt-3">
                <h1 class="text_primary pb-2 text_shadow_primary roboto-medium-italic">Coffee House Shop</h1>
                <p class="text-pretty text_primary_soft text_justify">
                    Our baristas craft each cup with passion, ensuring the perfect blend of flavors in every sip. From classic espresso to specialty lattes, we cater to every taste.
                    Join us for a cup of coffee, and let’s make every moment a little warmer, one brew at a time.<voluptatibus class="lo"></voluptatibus>
                </p>
                <a href="{{route("client.product")}}" class="btn btn_primary">See Menus</a>
            </div>
            <div class="col-12 col-md-6 shadow">
                <div id="carouselExampleRide" class="carousel slide  rounded p-0 p-md-4 pt-3 px-3" data-bs-ride="carousel" data-bs-interval="1000">
                    <div class="carousel-inner rounded h-100" data-bs-interval="0">
                        <div class="carousel-item active">
                            <img src="{{asset("images/coffee1.jpg")}}" class="d-block w-100" width="" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{asset("images/coffee2.jpg")}}" class="d-block w-100" width="" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{asset("images/coffee1.jpg")}}" class="d-block w-100" width="" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>

        <x-client.menu-data :title="$menus[0]" :products="$latestProducts">

        </x-client.menu-data>
        <x-client.menu-data :title="$menus[1]" :products="$upcommingProducts">

        </x-client.menu-data>
        <x-client.menu-data :title="$menus[2]" :products="$trendingProducts">

        </x-client.menu-data>

    </x-slot>
    <x-slot name="script">
    </x-slot>
</x-client.app>