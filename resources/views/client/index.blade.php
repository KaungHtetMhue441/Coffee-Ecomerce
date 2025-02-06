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
    <x-slot name="style">
        <style>
            .hero {
                /* background: url("https://wallpapercave.com/wp/wp2352846.jpg") no-repeat center center; */
                background-size: cover;
                height: 400px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
            }

            .video-background {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: -1;
                /* Place it behind other content */
                object-fit: cover;
                /* Cover the entire area */
            }
        </style>
    </x-slot>
    <x-slot name="content">
        <div class="container-fluid hero" style="height: 90vh; position:relative">
            <video autoplay muted loop class="video-background">
                <source src="{{asset('videos/background-video.mp4')}}" type="video/mp4" />
                <!-- <source src="background-video.webm" type="video/webm" /> -->
                Your browser does not support the video tag.
            </video>
            <div class="row  my-md-5 justify-content-center h-100 align-items-center">
                <div class="col-12 col-md-5 text-justify p-3" style="border-radius:30px;">
                    <h1 class=" pb-2 text-white roboto-medium-italic">Coffee House Shop</h1>
                    <p class="text-pretty text-white text_justify">
                        Our baristas craft each cup with passion, ensuring the perfect blend of flavors in every sip. From classic espresso to specialty lattes, we cpater to every taste.<voluptatibus class="lo"></voluptatibus>
                    </p>
                    <a href="{{route("client.product")}}" class="btn btn-coffee btn-dark">See Menus</a>
                </div>
                <!-- <div class="col-12 col-md-6 shadow">
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
                </div> -->
            </div>
        </div>
        <div class="container-fluid px-5">

            <x-client.menu-data :title="$menus[0]" :products="$latestProducts">

            </x-client.menu-data>
            <x-client.menu-data :title="$menus[1]" :products="$upcommingProducts">

            </x-client.menu-data>
            <x-client.menu-data :title="$menus[2]" :products="$trendingProducts">

            </x-client.menu-data>
        </div>

    </x-slot>
    <x-slot name="script">
    </x-slot>
</x-client.app>