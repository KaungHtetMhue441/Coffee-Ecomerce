@props([
  "breadCrumbs"=>['Category','Create']
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
              <div class="card-title">Category Create</div>
            </div>
            <div class="card-body">
             <form action="{{ route('admin.category.store')}}" method="POST">
              @csrf
              <div class="form-group">
                <label for="email2">Category Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="category"
                  name="name"
                  placeholder="Enter Category Name"
                />
              </div>
              <div class="card-action">
                <button class="btn btn-success">Submit</button>
                <button class="btn btn-danger">Cancel</button>
              </div>
             </form>
            </div>
            
          </div>
        </div>
      </div>
    </x-slot>

</x-layouts.admin>