@props([
'breadCrumbs' => [
'Product',
'Edit'
]
])

<x-layouts.admin>
  <x-slot name="header">
    Edit Product
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
          <div class="card-body">
            <form action="{{ route('admin.product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
              @method("PUT")
              <div class="row">
                <div class="col-12 col-md-6 mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" value="{{$product->name}}" class="form-control" id="product" name="name" placeholder="Enter product name" />
                </div>
                <div class="col-12 col-md-6 mb-3">
                  <label for="en_name" class="form-label">Name in english</label>
                  <input type="text" class="form-control" value="{{$product->en_name}}" id="product" name="en_name" placeholder="Enter product name in English" />
                </div>
                <div class="col-12 col-md-6 mb-3">
                  <label for="code" class="form-label">Product's Code</label>
                  <input type="text" value="{{$product->code}}" class="form-control" id="code" name="code" placeholder="Enter product code" />
                </div>
                <div class="col-12 col-md-6 mb-3">
                  <label for="formFile" class="form-label">Choose product's image</label>
                  <input class="form-control" name="file" type="file" id="formFile">
                </div>
                <div class="col-12 col-md-6 mb-3">
                  <label for="price" class="form-label">Category</label>
                  <select class="form-control form-select" name="category_id">
                    @forelse ($categories as $category)
                    <option value="{{$category->id}}" @if($category->id==$product->category_id) selected @endif>{{$category->name}}</option>
                    @empty
                    @endforelse
                  </select>
                </div>
                <div class="col-12 col-md-6 mb-3">
                  <label for="price" class="form-label">Price</label>
                  <input type="number" value="{{$product->price}}" class="form-control" id="price" name="price" placeholder="Enter price" />
                </div>
                <div class="col-12">
                  <label for="description" class="form-label">Description</label>
                  <textarea name="description" class="form-control" id="description" cols="30" rows="5">{{$product->description}}</textarea>
                </div>
              </div>
              <div class="d-flex justify-content-end mt-3">
                <button class="btn btn-success me-3">Create</button>
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