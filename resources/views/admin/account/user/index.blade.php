@props([
"breadCrumbs"=>['Account','users']
])
<x-layouts.admin>
    <x-slot name="header">
        User Accounts
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
                            <div class="inline-block float-end">
                                <form action="{{route('admin.account.admin.index')}}" method="get">
                                    <div class="row justify-end">
                                        <div class="col-8">
                                            <input type="text" name="name" value="{{request()->get("name")}}" class="form-control" placeholder="Enter name ">
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
                            <table class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->created_at->diffForHumans()}}</td>
                                        <td>
                                            <span>
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{$users->links()}}
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