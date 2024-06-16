
@php
  $breadCrumbs = ['Product','all'];
@endphp
<x-layouts.admin>
    <x-slot name="header">
        Products
    </x-slot>

    <x-slot name="script">

    <x-slot name="content">
      <div class="page-header ">
        <x-admin.breadcrumbs :items="$breadCrumbs">

        </x-admin.breadcrumbs>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="card-title">
                All products
                <div class="inline-block float-end">
                  <form action="{{route('product.index')}}" method="get">
                    @csrf
                    <div class="row justify-end">
                      <div class="col-8">
                        <input type="text" name="product" class="form-control" placeholder="product name">
                      </div>
                      <div class="col-4">
                        <button type="submit" class="btn btn-primary">search</button> 
                      </div>                       
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table
                  class="display table table-striped table-hover"
                >
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Image</th>                       
                      <th>Price</th>
                      <th>Description</th>
                      <th>created</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($products as $product)
                      <tr>
                        <td>{{$product->name}}</td>
                        <td>
                          <img src="{{$product->imageUrl}}" class="rounded-full" alt="" width="50px" height="50px">
                        </td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->category->name}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->created_at->diffForHumans()}}</td>
                        <td>
                          <span>
                            <a href="{{route("product.edit",$product->id)}}">
                            <i class="fa fa-edit text-info"></i>
                            </a>
                          </span>
                          &nbsp;&nbsp;
                          <span>
                            <a href="{{route("product.destroy",$product->id)}}"  onclick="return confirm('Are you sure to delete')" >
                              <i class="fa fa-trash text-danger"></i>
                            </a> 
                            </span>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </x-slot>
    </div>
    <x-slot name="script">
      <script>
      </script>
    </x-slot>
</x-layouts.admin>

