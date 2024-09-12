<x-layouts.admin>
   <x-slot name="header">
      Admin Dashboard
   </x-slot>
   <x-slot name="content">
      <div class="container mt-3">
         <div class="row">
            <div class="col-sm-6 col-md-3">
               <div class="card card-stats card-round">
                  <a href="{{route("admin.account.admin.index")}}">

                     <div class="card-body">
                        <div class="row align-items-center">
                           <div class="col-icon">
                              <div class="icon-big text-center icon-primary bubble-shadow-small">
                                 <i class="fas fa-users"></i>
                              </div>
                           </div>
                           <div class="col col-stats ms-3 ms-sm-0">
                              <div class="numbers">
                                 <p class="card-category">Users</p>
                                 <h4 class="card-title">{{$userCount}}</h4>
                              </div>
                           </div>
                        </div>
                     </div>
                  </a>

               </div>
            </div>
            <div class="col-sm-6 col-md-3">
               <div class="card card-stats card-round">
                  <a href="{{route("admin.category.index")}}">
                     <div class="card-body">
                        <div class="row align-items-center">
                           <div class="col-icon">
                              <div class="icon-big text-center icon-info bubble-shadow-small">
                                 <i class="fas fa-list"></i>
                              </div>
                           </div>
                           <div class="col col-stats ms-3 ms-sm-0">
                              <div class="numbers">
                                 <p class="card-category">Category</p>
                                 <h4 class="card-title">{{$categoryCount}}</h4>
                              </div>
                           </div>
                        </div>
                     </div>
                  </a>
               </div>
            </div>
            <div class="col-sm-6 col-md-3">
               <div class="card card-stats card-round">
                  <a href="{{route("admin.product.index")}}">
                     <div class="card-body">
                        <div class="row align-items-center">
                           <div class="col-icon">
                              <div class="icon-big text-center icon-success bubble-shadow-small">
                                 <i class="fas fa-luggage-cart"></i>
                              </div>
                           </div>
                           <div class="col col-stats ms-3 ms-sm-0">
                              <div class="numbers">
                                 <p class="card-category">Product</p>
                                 <h4 class="card-title">{{$productCount}}</h4>
                              </div>
                           </div>
                        </div>
                     </div>
                  </a>
               </div>
            </div>
            <div class="col-sm-6 col-md-3">
               <div class="card card-stats card-round">
                  <a href="{{route("admin.sale.index")}}">
                     <div class="card-body">
                        <div class="row align-items-center">
                           <div class="col-icon">
                              <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                 <i class="far fa-check-circle"></i>
                              </div>
                           </div>
                           <div class="col col-stats ms-3 ms-sm-0">
                              <div class="numbers">
                                 <p class="card-category">Sales</p>
                                 <h4 class="card-title">{{$saleCount}}</h4>
                              </div>
                           </div>
                        </div>
                     </div>
                  </a>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-4">
               <div class="card card-round">
                  <div class="card-body">
                     <div class="card-head-row card-tools-still-right">
                        <div class="card-title">New Customers</div>
                     </div>
                     <div class="card-list py-4">
                        @foreach ($latestUsers as $user)
                        <div class="item-list">
                           <div class="avatar">
                              <i class="fa fa-people"></i>
                              <!-- <img src="assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle" /> -->
                           </div>
                           <div class="info-user ms-3">
                              <div class="username">{{$user->name}}</div>
                              <div class="status">{{$user->email}}</div>
                           </div>
                        </div>
                        @endforeach
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-8">
               <div class="card card-round">
                  <div class="card-header">
                     <div class="card-head-row card-tools-still-right">
                        <div class="card-title w-100">
                           Pending Orders
                           <div class="col-2 float-end" style="text-align: end;">
                              {{$orderCount}} Total
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card-body p-0">
                     <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center mb-0">
                           <thead class="thead-light">
                              <tr>
                                 <th scope="col">Customer's Name</th>
                                 <th scope="col" class="text-end">Order Date</th>
                                 <th scope="col" class="text-end">Amount</th>
                                 <th scope="col" class="text-end">Status</th>
                              </tr>
                           </thead>
                           <tbody>
                              @forelse ($orders as $order)
                              <tr>
                                 <th>
                                    {{$order->user->name}}
                                 </th>
                                 <td class="text-end">{{$order->order_date?->format("M d,Y, H:m A")}}</td>
                                 <td class="text-end">{{$order->total_amount}}</td>
                                 <td class="text-end">
                                    <span class="badge badge-warning">Pending</span>
                                 </td>
                              </tr>
                              @empty

                              @endforelse

                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-12">
               <div class="card card-round">
                  <div class="card-header">
                     <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Transaction History</div>
                     </div>
                  </div>
                  <div class="card-body p-0">
                     <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center mb-0">
                           <thead class="thead-light">
                              <tr>
                                 <th scope="col">Payment Number</th>
                                 <th scope="col" class="text-end">Date & Time</th>
                                 <th scope="col" class="text-end">Amount</th>
                                 <th scope="col" class="text-end">Status</th>
                              </tr>
                           </thead>
                           <tbody>
                              @forelse ($latestSales as $sale)
                              <tr>
                                 <th>
                                    <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                       <i class="fa fa-check"></i>
                                    </button>
                                    Payment from #{{$sale->id}}
                                 </th>
                                 <td class="text-end">{{$sale->created_at->format("M d,Y, H:m A")}}</td>
                                 <td class="text-end">{{$sale->total_cost}}</td>
                                 <td class="text-end">
                                    <span class="badge badge-success">Completed</span>
                                 </td>
                              </tr>
                              @empty

                              @endforelse

                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </x-slot>
</x-layouts.admin>