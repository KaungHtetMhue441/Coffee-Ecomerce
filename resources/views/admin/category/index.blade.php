@props([
  "breadCrumbs"=>['Category','All']
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
              <div class="card-title">
                All categories
                <div class="inline-block float-end">
                  <form action="{{route('category.index')}}" method="get">
                    @csrf
                    <div class="row justify-end">
                      <div class="col-8">
                        <input type="text" name="category" class="form-control" placeholder="Category name">
                      </div>
                      <div class="col-4">
                        <button type="submit" class="btn btn-primary">search</button> 
                      </div>                       
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table
                  class="display table table-striped table-hover"
                >
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>created</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($categories as $category)
                      <tr>
                        <td>{{$category->name}}</td>
                        <td>{{$category->created_at->diffForHumans()}}</td>
                        <td>
                          <span>
                           <a href="{{route("category.edit",$category->id)}}">
                            <i class="fa fa-edit text-info"></i>
                           </a>
                          </span>
                          &nbsp;&nbsp;
                          <span>
                            <a href="{{route("category.destroy",$category->id)}}"  onclick="return confirm('Are you sure to delete')" >
                             <i class="fa fa-trash text-danger"></i>
                           </a> 
                           </span>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </x-slot>
    <x-slot name="script">
      <script>
      </script>
    </x-slot>
</x-layouts.admin>

