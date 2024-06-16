@props([
  "breadCrumbs"=>['Product','Create']
])
<x-layouts.admin>
    <x-slot name="header">
        Products
    </x-slot>

    <x-slot name="script">
        
    </x-slot>
    <x-slot name="content">
      <div class="page-header ">
        <x-admin.breadcrumbs :items="$breadCrumbs">

        </x-admin.breadcrumbs>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Product Create</div>
            </div>
            <div class="card-body">
              <form action="{{ route('product.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="email2">Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="product"
                  name="name"
                  placeholder="Enter product name"
                />
              </div>
              <div class="form-group">
                <div class="mb-3">
                  <label for="formFile" class="form-label">Choose product's image</label>
                  <input class="form-control" type="file" id="formFile">
                </div>                  
              </div>
              <div class="form-group">
                <label for="price">Price</label>
                <input
                  type="number"
                  class="form-control"
                  id="price"
                  name="price"
                  placeholder="Enter price"
                />
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
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