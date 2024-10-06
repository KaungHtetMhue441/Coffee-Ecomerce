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
        <style>
            .badge {
                top: 10px;
                left: 10px;
            }

            .card {
                position: relative;
            }

            .card img {
                height: 180px;
                object-fit: cover;
            }
        </style>

        <div class="container-fluid mt-4">
            <div class="row">
                <!-- Sidebar for Categories -->
                <div class="col-12 col-md-3 mb-3">
                    <div class="card border-0 p-1">
                        <div class="card-header border-0">
                            <div class="card-title">
                                <h5>Categories</h5>
                            </div>
                        </div>
                        <div class="card-body px-0">
                            <ul class="list-group">
                                @foreach ($categories as $category)
                                @php
                                if(request()['category_id']==$category->id)
                                $categoryName="Menu for ".$category->name;
                                @endphp
                                <a class="nav-link w-100" href="{{route("client.product")}}?category_id={{$category->id}}">
                                    <li class="list-group-item  d-flex justify-content-between align-items-center  @if(request()['category_id']==$category->id) k_active @endif">
                                        {{$category->name}}
                                        <i class="fas fa-chevron-right"></i>
                                    </li>
                                </a>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-12 col-md-9">
                    <!-- <div class="d-flex justify-content-between"> -->
                    <h4 class="text-center title p-2 shadow">{{$menuTitle}}</h4>
                    <!-- </div> -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <form action="{{request()->fullUrl()}}" method="get" class="w-100">
                            <div class="d-flex w-100 flex-wrap justify-content-md-end">
                                <div class="col-12 mb-3 mb-md-0 col-md-6 d-flex justify-content-md-start justify-content-between">
                                    <input type="text" placeholder="...search" class="form-control me-3" style="width: 200px;" name="search" value="{{old("search")}}">
                                    <button type="submit" class="btn btn-info">Search</button>
                                    <a href="{{route("client.product")}}" class="btn btn-secondary ms-2">Reset</a>

                                </div>
                                <div class=" col-12 col-md-6 d-flex justify-content-between justify-content-md-end">
                                    <input type="hidden" name="category_id" value="{{request()['category_id']}}">
                                    @php
                                    $pages = [9,15,20,30];
                                    @endphp
                                    <select class="form-select w-auto me-2 float-end search-form" name="items" aria-label="Show number of 
                                    products">

                                        @forelse ( $pages as $page)
                                        <option value="{{$page}}" @if(request()['items']==$page) selected @endif>Show {{$page}}</option>

                                        @empty

                                        @endforelse
                                    </select>

                                    <select class="form-select search-form w-auto float-endxx" aria-label="Sort by" name="sort_by">
                                        <option selected value="">Sort by:</option>
                                        <option value="most-price" @if(request()['sort_by']=="most-price" ) selected @endif>Sort by most price</option>
                                        <option value="least-price" @if(request()['sort_by']=="least-price" ) selected @endif>Sort by least price</option>
                                        <option value="most-order" @if(request()['sort_by']=="most-order" ) selected @endif>Sort by most order</option>
                                        <option value="least-order" @if(request()['sort_by']=="least-order" ) selected @endif>Sort by least order</option>
                                    </select>
                                </div>
                            </div>
                        </form>

                    </div>

                    <!-- Product Grid -->
                    <div class="row row-cols-1 row-cols-sm-3 row-cols-md-3 g-4">
                        <!-- Example Product Card -->
                        @forelse ($products as $product)
                        <x-client.menu :product="$product" manuCount=""></x-client.menu>
                        @empty
                        @endforelse
                    </div>
                    <div class="row mt-3">
                        {{$products->links()}}
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="script">
        <script>
            $(".search-form").on("change", function() {
                $(this).closest("form").submit();
            })
        </script>
    </x-slot>
</x-client.app>