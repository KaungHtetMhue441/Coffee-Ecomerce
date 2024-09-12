@props([
"breadCrumbs"=>['Menu','Create']
])
<x-layouts.admin>
  <x-slot name="header">
    Menu Create
  </x-slot>

  <x-slot name="script">

  </x-slot>
  <x-slot name="content">
    <div class="page-header">
      <x-admin.breadcrumbs :items="$breadCrumbs"></x-admin.breadcrumbs>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-12 col-md-6 mb-3">
                  <label for="name">Name in Myanmar</label>
                  <input type="text" class="form-control" id="product" name="name" placeholder="Enter Menu name in mm" />
                  @error('name')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-12 col-md-6">
                  <label for="en_name">Name in English</label>
                  <input type="text" class="form-control" id="product" name="en_name" placeholder="Enter Menu name in English" />
                  @error('en_name')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-12 col-md-6 mb-3">
                  <label for="code">Code</label>
                  <input type="text" class="form-control" id="code" name="code" placeholder="Enter Menu code" />
                  @error('code')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-12 col-md-6 mb-3">
                  <div class="mb-3">
                    <label for="formFile" class="form-label">Choose Menu's image</label>
                    <input class="form-control" name="file" type="file" id="formFile">
                    @error('file')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="col-12 col-md-6 mb-3">
                  <label for="category_id">Category</label>
                  <select class="form-control form-select" name="category_id">
                    @forelse ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @empty
                    @endforelse
                  </select>
                  @error('category_id')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-12 col-md-6 mb-3">
                  <label for="price">Price</label>
                  <input type="number" class="form-control" id="price" name="price" placeholder="Enter price" />
                  @error('price')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-12 mb-3">
                  <label for="description">Description</label>
                  <textarea name="description" class="form-control" id="description" cols="30" rows="5"></textarea>
                  @error('description')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
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