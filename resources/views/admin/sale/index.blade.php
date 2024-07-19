@php
$breadCrumbs = ['Sale','all'];
@endphp
<x-layouts.admin>
    <x-slot name="header">
        Sale report
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
                            <div class="card-title">
                                All Sales
                                <div class="inline-block float-end">
                                    <form action="{{route('admin.sale.index')}}" method="get">
                                        <div class="d-flex justify-end">
                                            <input type="text" value="{{request()->get('category')}}" name="category" class="form-control me-3" placeholder="Enter Category Name"></input>
                                            <input type="text" value="{{request()->get('name')}}" name="name" class="form-control me-3" placeholder="Product Name">
                                            <button type="submit" class="btn btn-primary  float-end">Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr rowspan="2">
                                            <th colspan="3">Total Sale</th>
                                            <th colspan="3" class="text-success">{{$total_cost}} Kyats</th>
                                        </tr>
                                    </tfoot>
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