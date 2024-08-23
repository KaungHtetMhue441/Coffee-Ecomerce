@props([
"breadCrumbs"=>['Product','Create']
])
<x-layouts.admin>
  <x-slot name="header">
    Product Create
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
          <!-- <div class="card-header">
            <div class="card-title">Product Create</div>
          </div> -->
          <div class="card-body">
            <form action="{{ route('admin.product.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-12 col-md-6 mb-3">
                  <label for="name">Name in Myanmar</label>
                  <input type="text" class="form-control" id="product" name="name" placeholder="Enter product name in mm" />
                </div>
                <div class="col-12 col-md-6">
                  <label for="en_name">Name in English</label>
                  <input type="text" class="form-control" id="product" name="en_name" placeholder="Enter product name in English" />
                </div>
                <div class="col-12 col-md-6 mb-3">
                  <label for="code">Code</label>
                  <input type="text" class="form-control" id="code" name="code" placeholder="Enter product code" />
                </div>
                <div class="col-12 col-md-6 mb-3">
                  <div class="mb-3">
                    <label for="formFile" class="form-label">Choose product's image</label>
                    <input class="form-control" name="file" type="file" id="formFile">
                  </div>
                </div>
                <div class="col-12 col-md-6 mb-3">
                  <label for="price">Category</label>
                  <select class="form-control form-select" name="category_id">
                    @forelse ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @empty
                    @endforelse
                  </select>
                </div>
                <div class="col-12 col-md-6 mb-3">
                  <label for="price">Price</label>
                  <input type="number" class="form-control" id="price" name="price" placeholder="Enter price" />
                </div>
                <div class="col-12 mb-3">
                  <label for="description">Description</label>
                  <textarea name="description" class="form-control" id="description" cols="30" rows="5"></textarea>
                </div>
                <div class="form-group d-flex justify-content-end">
                  <button class="btn btn-success me-3">Create</button>
                  <button class="btn btn-danger">Cancel</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </x-slot>
  </div>
</x-layouts.admin>