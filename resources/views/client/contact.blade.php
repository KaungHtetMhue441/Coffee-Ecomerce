<x-client.app>
    <x-slot name="title">
        Contact Us
    </x-slot>
    <x-slot name="content">
        <div class="row pt-3 py-5">
            <h4 class="text_primary text-center mb-3 fw-bolder">Contact Us</h4>
            <div class="col-12 shadow">
                <gmp-map center="43.4142989,-124.2301242" zoom="4" map-id="DEMO_MAP_ID" style="height: 400px">
                    <gmp-advanced-marker position="37.4220656,-122.0840897" title="Mountain View, CA"></gmp-advanced-marker>
                    <gmp-advanced-marker position="47.648994,-122.3503845" title="Seattle, WA"></gmp-advanced-marker>
                </gmp-map>
            </div>
            <div class="row justify-content-center pt-5">
                <div class="col-3">
                    <p class="fw-bolder text-center">Coffee House Shop</p>

                </div>
                <div class="col-3">
                    <p class="fw-bolder text-center">kaungcoffeeshop@gmail.com
                    </p>


                </div>
                <div class="col-3">
                    <p class="fw-bolder text-center">
                        Ph : 09795889472
                    </p>
                </div>

            </div>
        </div>
    </x-slot>
    <x-slot name="script">
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&libraries=maps,marker&v=beta" defer></script>
    </x-slot>
</x-client.app>