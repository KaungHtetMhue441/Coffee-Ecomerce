<!-- <div class="d-flex mt-3 pt-3 rounded shadow justify-content-start" style="background-color: white;">
            @foreach ($categories as $category)
            @php
            if(request()['category_id']==$category->id)
            $categoryName="Menu for ".$category->name;
            @endphp
            <div class=" ms-3" style="min-width: 100px;">
                <a class="w-100 btn btn_primary text-center  
                    @if(request()['category_id']==$category->id) k_active
                    @endif mb-3" href="{{route("client.product")}}?category_id={{$category->id}}">{{$category->name}}</a>
            </div>

            @endforeach
        </div> -->
<!-- 
        <div class="row bg-white mt-3 px-0">
            <div class="d-flex justify-content-between px-5 pt-3 mb-3">
                <h4>{{$menuTitle}}</h4>
                <h4>Total - {{$products->count()}}</h4>

            </div>
            <hr>
            @forelse ($products as $product)
            <x-client.menu :product="$product" manuCount=""></x-client.menu>
            @empty
            <h4>Nothing to Show</h4>
            @endforelse
            <div class="row">
                {{$products->links()}}
            </div>

        </div> -->