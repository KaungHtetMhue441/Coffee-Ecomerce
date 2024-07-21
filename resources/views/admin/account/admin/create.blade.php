@props([
"breadCrumbs"=>['Account',"Admin",'Create']
])
<x-layouts.admin>
    <x-slot name="header">
        Admin Account create
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
                        <div class="card-title">Admin account Create</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.account.admin.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" />
                            </div>
                            <div class="form-group">
                                <label for="email">email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" />
                            </div>
                            <div class="form-group">
                                <label for="role_id"></label>
                                <select name="role_id" id="role_id" class="form form-select form-control">
                                    @foreach ($roles as $role )
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" class="form-control" id="password" name="password" placeholder="Enter Password" />
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Password</label>
                                <input type="text" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Reenter password" />
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success me-3">Create</button>
                                <button class="btn btn-danger">Cancel</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </x-slot>

</x-layouts.admin>