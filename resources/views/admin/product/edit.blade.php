@props([
'breadCrumbs' => [
'Menu',
'Edit'
]
])

<x-layouts.admin>
  <x-slot name="header">
    Edit Menu
  </x-slot>
  <x-slot name="script">
  </x-slot>
  <x-slot name="content">
    <div class="row">
      <div class="page-header ">
        <x-admin.breadcrumbs :items="$breadCrumbs"></x-admin.breadcrumbs>
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
                  <input type="text" value="{{ old('name', $product->name) }}" class="form-control" id="product" name="name" placeholder="Enter Menu name" />
                  @error('name')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-12 col-md-6 mb-3">
                  <label for="en_name" class="form-label">Name in English</label>
                  <input type="text" class="form-control" value="{{ old('en_name', $product->en_name) }}" id="product" name="en_name" placeholder="Enter Menu name in English" />
                  @error('en_name')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-12 col-md-6 mb-3">
                  <label for="code" class="form-label">Menu's Code</label>
                  <input type="text" value="{{ old('code', $product->code) }}" class="form-control" id="code" name="code" placeholder="Enter Menu code" />
                  @error('code')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-12 col-md-6 mb-3">
                  <label for="formFile" class="form-label">Choose Menu's image</label>
                  <input class="form-control" name="file" type="file" id="formFile">
                  @error('file')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-12 col-md-6 mb-3">
                  <label for="price" class="form-label">Category</label>
                  <select class="form-control form-select" name="category_id">
                    @forelse ($categories as $category)
                    <option value="{{ $category->id }}" @if($category->id == $product->category_id) selected @endif>
                      {{ $category->name }}
                    </option>
                    @empty
                    <option>No categories available</option>
                    @endforelse
                  </select>
                  @error('category_id')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-12 col-md-6 mb-3">
                  <label for="price" class="form-label">Price</label>
                  <input type="number" value="{{ old('price', $product->price) }}" class="form-control" id="price" name="price" placeholder="Enter price" />
                  @error('price')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-12">
                  <label for="description" class="form-label">Description</label>
                  <textarea name="description" class="form-control" id="description" cols="30" rows="5">{{ old('description', $product->description) }}</textarea>
                  @error('description')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="d-flex justify-content-end mt-3">
                <button class="btn btn-success me-3">Update</button>
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