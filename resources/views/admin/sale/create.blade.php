@props([
"breadCrumbs"=>['Sale','Create'],
])
@php
$sale = request()['sale'];
@endphp
<x-layouts.admin>
    <x-slot name="header">
        Sale Form
    </x-slot>
    <x-slot name="content">

        <div class="row">
            <div class="col-md-12 px-3">
                <div class="card">
                    <div class="card-body pb-0 pt-0 mt-3" style="border-top:1px solid grey;background-color:#e3f6f5;">
                        <form action="{{route("admin.sale.product.add",request()['sale']->id)}}" id="product-add" method="POST">
                            @csrf
                        </form>
                        <form action="{{route("admin.sale.product.update",request()['sale']->id)}}" id="product-update" method="POST">
                            @method("PUT")
                            @csrf
                        </form>
                        <form action="{{ route('admin.sale.store',$sale->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="container text-center rounded p-0">
                                <div class="row">
                                    <div class="col-5 px-2">
                                        <div class="card mt-3 p-2 mb-3">
                                            <div class="card-body p-0 pb-3 px-3">
                                                <ul class="nav">

                                                    @forelse ($categories as $category )
                                                    <li class="nav-item me-2 p-0" style="border: none;">
                                                        <a href="{{route('admin.sale.create',[
                                                                'sale'=>request()["sale"]->id,
                                                                'category'=>$category->id
                                                                ])}}" class="
                                                                nav-link 
                                                                btn btn-info
                                                                mt-3
                                                                px-3
                                                                fw-bolder fs-6
                                                                @if(request()['category']->id==$category->id) 
                                                                custom_active 
                                                                @endif" aria-current="page">
                                                            {{$category->name}}
                                                        </a>
                                                    </li>
                                                    @empty

                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="row px-3">
                                            <div class="card px-2">
                                                <div class="card-body p-0 pb-3 px-3">
                                                    <div class="row">
                                                        @forelse ( $products as $product)
                                                        <div class="col-3 p-0">
                                                            <div class=" rounded mt-3">
                                                                <a href="#" style="min-width: 85px;" class="product btn btn-sm btn-outline-success" value="{{$product->id}}" name="{{$product->name}}">

                                                                    {{$product->name}}

                                                                </a>
                                                            </div>
                                                        </div>
                                                        @empty

                                                        @endforelse
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-7 px-2 bg-white pt-2" style="border-left:1px solid grey;" class="">
                                        <div class="row mb-3" id="add_product_form">
                                            <div class="col-5">
                                                <input class="form-control" form="product-add" type="text" placeholder="Product name" id="product" value="" disabled />
                                                <!-- hidden input  -->
                                                <input type="hidden" class="form-control" name="product_id" id="product_id" form="product-add" />

                                                <!-- End hidden input -->
                                            </div>
                                            <div class="col-5">
                                                <input class="form-control" form="product-add" type="number" placeholder="Quantity" name="quantity" id="quantity" value="">
                                            </div>
                                            <div class="col-2 p-0">
                                                <button class="btn btn-info" id="product_add_btn" form="product-add" disabled>
                                                    Add
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row d-none" id="update_product_form">
                                            <div class="col-5">
                                                <input class="form-control" form="product-update" type="text" placeholder="Product name" id="update_product" value="" disabled />
                                                <!-- hidden input  -->
                                                <input type="hidden" class="form-control" name="product_id" id="update_product_id" form="product-update" />

                                                <!-- End hidden input -->
                                            </div>
                                            <div class="col-5">
                                                <input class="form-control" form="product-update" type="number" placeholder="Quantity" name="quantity" id="update_quantity" value="">
                                            </div>
                                            <div class="col-2">
                                                <button class="btn btn-info" id="product_update_btn" form="product-update">
                                                    Update
                                                </button>
                                            </div>
                                        </div>
                                        <div style="min-height: 150px;max-height:380px;overflow-y:scroll;background-color:white">
                                            <table class="table table-hover table-bordered border-secondary table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Price</th>
                                                        <th>QTY</th>
                                                        <th>Total price</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($saleProducts as $saleProduct)
                                                    <tr>
                                                        <td>{{$saleProduct->name}}</td>
                                                        <td>
                                                            {{$saleProduct->price}}
                                                        </td>
                                                        <td>
                                                            {{$saleProduct->pivot->quantity}}
                                                        </td>
                                                        <td>{{$saleProduct->pivot->price*$saleProduct->pivot->quantity}}</td>
                                                        <td>
                                                            <a class="btn btn-sm btn-primary
                                                             edit-product" productId="{{$saleProduct->id}}">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <a class="btn btn-sm btn-danger">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @empty

                                                    @endforelse

                                                </tbody>
                                            </table>
                                        </div>
                                        <hr>
                                        <div class="form-group border-top-1">
                                            <div class="d-flex justify-content-between mb-2">
                                                <label for="">Customer's Name</label>
                                                <input type="text" class="form-control w-50 " value="Guest" id="customer" name="customer_name" placeholder="Enter customer's name" />
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <label for="total">Total Price</label>
                                                <input type="text" class="form form-control w-50 text-primary bg-white" value="{{$total_price}} kyats " disabled>
                                            </div>
                                            <input type="number" class="d-none" name="total_cost" value="{{$total_price}}">
                                            <div class="d-flex justify-content-between">
                                                <label for="payment_type">Payment Type</label>
                                                <select class="form-select form-control w-50" name="payment_type" id="payment_type">
                                                    <option value="KBZ">KBZ PAY</option>
                                                    <option value="WAVE"> WAVE PAY</option>
                                                </select>
                                            </div>
                                            <div class="mt-3">
                                                <button type="submit " class="btn btn-success mb-3 float-end" onclick="openPdf()">

                                                    Pay Bill
                                                    <i class="fa fa-paper-plane "></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    </div>

    <x-slot name="script">
        <script type="text/javascript">
            function openPdf() {
                window.open("{{route('admin.bouncer',$sale->id)}}");
            }
            $(".product").each((index, product) => {
                $(product).click(function() {
                    $("#product").val($(product).attr("name"));
                    $("#product_id").val($(product).attr("value"));
                    $("#product_add_btn").prop('disabled', false);
                    $("#quantity").val(1);
                })
            });
            $(".edit-product").each((index, product) => {
                $(product).click(function() {
                    products = $(product).closest("tr").find("td");
                    $("#update_product_form").removeClass("d-none");
                    $("#add_product_form").addClass("d-none");
                    $("#update_product").val(products[0].innerText);
                    $("#update_quantity").val(products[2].innerText);
                    $("#update_product_id").val($(product).attr("productId"));
                })
            });
        </script>
    </x-slot>
</x-layouts.admin>