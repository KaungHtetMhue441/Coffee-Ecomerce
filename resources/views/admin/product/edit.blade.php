
@props([
    'breadCrumbs' => [
        'Product',
        'Edit'
    ]
])

<x-layouts.admin>
    <x-slot name="header">
        Products
    </x-slot>
    <x-slot name="script">
    </x-slot>
    <x-slot name="content">
      <div class="row">
        <div class="page-header ">
          <x-admin.breadcrumbs :items="$breadCrumbs">
  
          </x-admin.breadcrumbs>
        </div>
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Edit Product</div>
            </div>
            <div class="card-body">
              <form action="{{ route('product.update',$product->id)}}" method="POST">
              @method("PUT")
              @csrf
              <div class="form-group">
                <label for="email2">Product Name</label>
                <input
                  type="text"
                  class="form-control"
                  value="{{$product->name}}"
                  id="product"
                  name="name"
                  placeholder="Enter product Name"
                />
              </div>
              <div class="form-group">
                <label for="image">Product Name</label>
                <input
                  type="file"
                  class="form-control file"
                  value="{{$product->name}}"
                  id="image"
                  name="image"
                />
              </div>
              <div class="form-group">
                <label for="email2">Product Name</label>
                <input
                  type="text"
                  class="form-control"
                  value="{{$product->name}}"
                  id="product"
                  name="name"
                  placeholder="Enter product Name"
                />
              </div>
              <div class="form-group">
                <label for="email2">Product Name</label>
                <input
                  type="text"
                  class="form-control"
                  value="{{$product->name}}"
                  id="product"
                  name="name"
                  placeholder="Enter product Name"
                />
              </div>
              <div class="form-group">
                <label for="email2">Product Name</label>
                <input
                  type="text"
                  class="form-control"
                  value="{{$product->name}}"
                  id="product"
                  name="name"
                  placeholder="Enter product Name"
                />
              </div>
              <div class="card-action">
                <button class="btn btn-success" type="submit">Update</button>
                <button class="btn btn-danger" type="reset">Cancel</button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </x-slot>
    </div>
</x-layouts.admin>