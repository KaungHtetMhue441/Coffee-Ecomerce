
@props([
    'breadCrumbs' => [
        'Category',
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
      <div class="page-header ">
        <x-admin.breadcrumbs :items="$breadCrumbs">

        </x-admin.breadcrumbs>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Edit Category</div>
            </div>
            <div class="card-body">
             <form action="{{ route('admin.category.update',$category->id)}}" method="POST">
              @method("PUT")
              @csrf
              <div class="form-group">
                <label for="email2">Category Name</label>
                <input
                  type="text"
                  class="form-control"
                  value="{{$category->name}}"
                  id="category"
                  name="name"
                  placeholder="Enter Category Name"
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
</x-layouts.admin>