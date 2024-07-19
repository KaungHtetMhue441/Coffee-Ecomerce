@php
$breadCrumbs = ['Product','all'];
@endphp
<x-layouts.admin>
  <x-slot name="header">
    Products
  </x-slot>

  <x-slot name="script">

    <x-slot name="content">
      <div class="page-header">
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
                  <form action="{{route('admin.product.index')}}" method="get">
                    <div class="d-flex justify-end">
                      <input type="text" value="{{request()->get('category')}}" name="category" class="form-control me-3" placeholder="Enter Category Name"></input>
                      <input type="text" value="{{request()->get('name')}}" name="name" class="form-control me-3" placeholder="Product Name">
                      <button type="submit" class="btn btn-primary  float-end">Search</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="display table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Code</th>
                      <th>Image</th>
                      <th>Price</th>
                      <th>Category</th>
                      <th>Description</th>
                      <th>created</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($products as $product)
                    <tr>
                      <td>{{$product->name}}</td>
                      <td>{{$product->code}}</td>
                      <td>
                        <div>
                          <img src="{{$product->imageUrl}}" class="rounded-circle" alt="" width="50px" height="50px">
                        </div>
                      </td>
                      <td>{{$product->price}}</td>
                      <td>{{$product->category->name}}</td>
                      <td>{{Str::words($product->description,5)}}</td>
                      <td>{{$product->created_at->diffForHumans()}}</td>
                      <td>
                        <span>
                          <a href="{{route("admin.product.edit",$product->id)}}">
                            <i class="fa fa-edit text-info"></i>
                          </a>
                        </span>
                        &nbsp;&nbsp;
                        <span>
                          <a href="{{route("admin.product.destroy",$product->id)}}" onclick="return confirm('Are you sure to delete')">
                            <i class="fa fa-trash text-danger"></i>
                          </a>
                        </span>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              {{$products->links()}}
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