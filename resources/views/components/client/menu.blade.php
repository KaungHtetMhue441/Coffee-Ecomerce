@props([
"product" => "",
"menuCount" => 3
])
<div class="col">
    <div class="card p-2">
        <img src="{{$product->image_url}}" class="card-img-top shadow rounded card_image" alt="...">
        <div class="card-body text-center px-1">
            <h6 class="card-title">{{$product->name}}</h6>
            <p class="card-text">{{$product->short_desc}}</p>
            <div class="d-flex justify-content-center mt-2 mb-2">
                <span>{{$product->price}} kyats</span>
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{route("client.product.show",$product->id)}}" class="btn btn-outline-info">See Details</a>
                <a class="btn btn-outline-success" onclick="addToCard('{{$product->id}}')">
                    <i class="fas fa-cart-plus"></i> Add
                </a>
            </div>
        </div>
    </div>
</div>
<!-- <div class="col-12 col-lg-{{$menuCount}} mb-3">
    <div class="card h-100 shadow p-2">
        <img src="{{$product->image_url}}" class="card-img-top shadow rounded card_image" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{$product->name}}</h5>
            <p class="card-text">${{$product->price}}</p>
            <p class="card-text pb-5">{{$product->short_desc}}</p>
            <div class="position-absolute w-100 px-3" style="bottom: 20px;left: 0px; z-index:2;">
                <div class="d-flex justify-content-between">
                    <a href="{{route("client.product.show",$product->id)}}" class="btn btn-primary">See Details</a>
                    <a class="btn btn-outline-primary" onclick="addToCard('{{$product->id}}')">
                        <i class="fa fa-plus">
                        </i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div> -->