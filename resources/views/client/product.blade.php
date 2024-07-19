@php

$menuTitle="All menus are here...";
foreach($categories as $category){
if($category->id==request()["category_id"])
$menuTitle="Menus For ".$category->name."";
}
@endphp
<x-client.app>
    <x-slot name="title">
        Menus
    </x-slot>
    <x-slot name="content">
        <div class="row mt-3 pt-3 rounded shadow justify-content-start" style="background-color: white;">
            @foreach ($categories as $category)
            @php
            if(request()['category_id']==$category->id)
            $categoryName="Menu for ".$category->name;
            @endphp
            <div class="col-2">
                <a class=" ms-3 w-75 btn btn_primary text-center  
                    @if(request()['category_id']==$category->id) k_active
                    @endif mb-3" href="{{route("client.product")}}?category_id={{$category->id}}">{{$category->name}}</a>
            </div>

            @endforeach
        </div>

        <div class="row bg-white mt-3 px-0">
            <div class="d-flex justify-content-between px-5 pt-3 mb-3">
                <h4>{{$menuTitle}}</h4>
                <h4>Total - {{$category->count()}}</h4>

            </div>
            <hr>
            @forelse ($products as $product)
            <x-client.menu :product="$product" manuCount=""></x-client.menu>
            @empty
            <h4>Nothing to Show</h4>
            @endforelse

        </div>

    </x-slot>
</x-client.app>