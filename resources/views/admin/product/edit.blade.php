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
            <form action="{{ route('admin.product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
              @method("PUT")
              <div class="form-group">
                <label for="email2">Name</label>
                <input type="text" value="{{$product->name}}" class="form-control" id="product" name="name" placeholder="Enter product name" />
              </div>
              <div class="form-group">
                <label for="en_name">Name</label>
                <input type="text" class="form-control" value="{{$product->en_name}}" id="product" name="en_name" placeholder="Enter product name in English" />
              </div>
              <div class="form-group">
                <label for="code">Product's Code</label>
                <input type="text" value="{{$product->code}}" class="form-control" id="code" name="code" placeholder="Enter product code" />
              </div>
              <div class="form-group">
                <div class="mb-3">
                  <label for="formFile" class="form-label">Choose product's image</label>
                  <input class="form-control" name="file" type="file" id="formFile">
                </div>
              </div>
              <div class="form-group">
                <label for="price">Category</label>
                <select class="form-control form-select" name="category_id">
                  @forelse ($categories as $category)
                  <option value="{{$category->id}}" @if($category->id==$product->category_id) selected @endif>{{$category->name}}</option>
                  @empty
                  @endforelse
                </select>
              </div>
              <div class="form-group">
                <label for="price">Price</label>
                <input type="number" value="{{$product->price}}" class="form-control" id="price" name="price" placeholder="Enter price" />
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{$product->description}}</textarea>
              </div>
              <div class="card-action">
                <button class="btn btn-success">Create</button>
                <button class="btn btn-danger">Cancel</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </x-slot>
  </div>
</x-layouts.admin>