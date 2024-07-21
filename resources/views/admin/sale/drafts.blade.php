@php
$category = App\Models\Category::first();
$breadCrumbs = ['Sale','all'];
@endphp
<x-layouts.admin>
    <x-slot name="header">
        Sale in Drafts
    </x-slot>

    <x-slot name="script">

        <x-slot name="content">
            <div class="page-header">
                <x-admin.breadcrumbs :items="$breadCrumbs">

                </x-admin.breadcrumbs>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display table-bordered border-black table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Total Cost</th>
                                            <th>Payment Type</th>
                                            <th>Admin</th>
                                            <th>created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sales as $sale)
                                        <tr>
                                            <td>{{$sale->customer}}</td>
                                            <td>{{$sale->total_cost}}</td>
                                            <td>
                                                {{$sale->payment_type}}
                                            </td>
                                            <td>{{$sale->admin->name}}</td>
                                            <td>{{$sale->created_at->diffForHumans()}}</td>
                                            <td>
                                                <a href="{{route("admin.sale.show",$sale->id)}}" class="m-3">
                                                    <i class="fa fa-eye fa-lg text-info"></i>
                                                </a>
                                                &nbsp;&nbsp;
                                                <span>
                                                    <a href="{{route("admin.sale.create",[$sale->id,$category->id])}}">
                                                        <i class="fa fa-edit text-info"></i>
                                                    </a>
                                                </span>
                                                &nbsp;&nbsp;
                                                <span>
                                                    <a href="{{route("admin.sale.destory",$sale->id,)}}" onclick="return confirm('Are you sure to delete')">
                                                        <i class="fa fa-trash text-danger"></i>
                                                    </a>
                                                </span>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{$sales->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
        </div>
        <x-slot name="script">
            <script>
            </script>
        </x-slot>
</x-layouts.admin>