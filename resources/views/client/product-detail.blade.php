<x-client.app>
    <x-slot name="title">
        Contact Us
    </x-slot>
    <x-slot name="content">
        <div class="row     p-5">
            <h3 class="text-center capitalize text_primary mb-3 mt-3">{{$product->name}}</h3>
            <div class="col-12 pt-3 col-md-6 shadow">
                <img class="w-100 rounded shadow" style="min-height: 300px;max-height:450px;min-width:100% ;" src="{{$product->image_url}}" alt="">
            </div>
            <div class="col-12 pt-3 col-md-6 shadow ">
                <table class="table  table-hover table-stripe table-border-top border-black">
                    <tbody>
                        <tr>
                            <th>Price</th>
                            <td>{{$product->price}} Kyats</td>
                        </tr>
                        <tr>
                            <th>Category name</th>
                            <td>{{$product->category->name}}</td>
                        </tr>

                    </tbody>

                </table>
                <p class="text-justify">
                    {{$product->description}}
                </p>
            </div>
            <div class="p-0 mt-3">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </x-slot>
</x-client.app>