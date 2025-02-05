@props([
"product" => "",
"menuCount" => 3
])
@php
$col = 12 / $menuCount;
@endphp
<div class="col-{{$col}} mb-3">
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
                Quantity <input type="text" style="width:40px;" class="ps-2" value="{{$product->pivot->quantity}}" disabled>
            </div>
        </div>
    </div>
</div>