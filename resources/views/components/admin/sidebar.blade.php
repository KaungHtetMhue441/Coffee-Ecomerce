@php
$user = auth()->guard("admin")->user();
@endphp
<div class="sidebar" data-background-color="dark">
  <div class="sidebar-logo">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark">
      <a href="index.html" class="logo text-white">
        <img src="{{asset("logo.png")}}" alt="navbar brand" class="navbar-brand rounded me-2" height="30px" />
        Angel House
      </a>
      <div class="nav-toggle">
        <button class="btn btn-toggle toggle-sidebar">
          <i class="gg-menu-right"></i>
        </button>
        <button class="btn btn-toggle sidenav-toggler">
          <i class="gg-menu-left"></i>
        </button>
      </div>
      <button class="topbar-toggler more">
        <i class="gg-more-vertical-alt"></i>
      </button>
    </div>
    <!-- End Logo Header -->
  </div>
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav nav-secondary">

        <!-- Menu Item for Most Buy Customer -->
        @if ($user->role->name=="admin")

        <li class="nav-item">
          <a href="{{route("admin.dashboard")}}" class="collapsed">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.most_buy_products') }}" class="collapsed">
            <i class="fas fa-users"></i>
            <p>Best Selling Products</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('users.most.buy') }}" class="collapsed">
            <i class="fas fa-users"></i>
            <p>Top Purchased Customers</p>
          </a>
        </li>


        <li class="nav-item">
          <a href="{{ route('admin.profits') }}" class="collapsed">
            <i class="fas fa-chart-line"></i>
            <p>Analyzing Profits</p>
          </a>
        </li>

        <!-- Menu Item for Final Budget -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#sidebarLayoutsInventory">
            <i class="fas fa-th-list"></i>
            <p>Manage Inventory</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="sidebarLayoutsInventory">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('admin.inventory.create') }}">
                  <i class="fas fa-chart-bar"></i>
                  <p>Add Items</p>
                </a>
              </li>
              <li>
                <a href="{{ route('admin.inventory.index') }}">
                  <i class="fa fa-chart-line"></i>
                  <p>Manage Item</p>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#sidebarLayoutsFinalTransaction">
            <i class="fas fa-th-list"></i>
            <p>Final Report</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="sidebarLayoutsFinalTransaction">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('admin.reports.income') }}">
                  <i class="fas fa-chart-bar"></i>
                  <p>Incomes</p>
                </a>
              </li>
              <li>
                <a href="{{ route('admin.reports.outcome') }}">
                  <i class="fa fa-chart-line"></i>
                  <p>Expenses</p>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <!-- Category Menu Item -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#sidebarLayoutsCategory">
            <i class="fas fa-th-list"></i>
            <p>Category</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="sidebarLayoutsCategory">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('admin.category.index') }}">
                  <span class="sub-item">All Categories</span>
                </a>
              </li>
              <li>
                <a href="{{ route('admin.category.create') }}">
                  <span class="sub-item">Add Category</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <!-- Tables Management -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#sidebarLayoutsTables">
            <i class="fas fa-table"></i>
            <p>Tables</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="sidebarLayoutsTables">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('admin.tables.index') }}">
                  <span class="sub-item">All Tables</span>
                </a>
              </li>
              <li>
                <a href="{{ route('admin.tables.create') }}">
                  <span class="sub-item">Add Table</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <!-- Product Menu Item -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#sidebarLayoutsProduct">
            <i class="fas fa-box-open"></i>
            <p>Menu</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="sidebarLayoutsProduct">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('admin.product.index') }}">
                  <span class="sub-item">All Menus</span>
                </a>
              </li>
              <li>
                <a href="{{ route('admin.product.create') }}">
                  <span class="sub-item">Add Menu</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        @endif

        @if ($user->role->name=="admin"||$user->role->name=="cashier")

        <!-- Sales Menu Item -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#sidebarLayoutsSales">
            <i class="fas fa-tag"></i>
            <p>Sales</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="sidebarLayoutsSales">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('admin.sale.new') }}">
                  <span class="sub-item">Create New Sale</span>
                </a>
              </li>
              <li>
                <a href="{{ route('admin.sale.index') }}">
                  <span class="sub-item">Sales Report</span>
                </a>
              </li>
              <li>
                <a href="{{ route('admin.sale.drafts') }}">
                  <span class="sub-item">Drafts Sale</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        @endif

        @if ($user->role->name=="admin"||$user->role->name=="staff")
        <!-- Orders Menu Item -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#sidebarLayoutsOrders">
            <i class="fas fa-receipt"></i>
            <p>Orders</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="sidebarLayoutsOrders">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('admin.order.index', 'pending') }}">
                  <span class="sub-item">Pending Orders</span>
                </a>
              </li>
              <li>
                <a href="{{ route('admin.order.index', 'accepted') }}">
                  <span class="sub-item">Processing Orders</span>
                </a>
              </li>
              <li>
                <a href="{{ route('admin.order.index', 'arrived') }}">
                  <span class="sub-item">Completed Orders</span>
                </a>
              </li>
              <li>
                <a href="{{ route('admin.order.index', 'rejected') }}">
                  <span class="sub-item">Rejected Orders</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        @endif
        <!-- Account Menu Item -->
        @if ($user->role->name=="admin")
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#sidebarLayoutsAccount">
            <i class="fas fa-user"></i>
            <p>Account</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="sidebarLayoutsAccount">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('admin.account.user.index') }}">
                  <span class="sub-item">Users</span>
                </a>
              </li>
              <li>
                <a href="{{ route('admin.account.admin.index') }}">
                  <span class="sub-item">Admins</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        @endif

        @if ($user->role->name=="admin")
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#sidebarLayoutsEmployee">
            <i class="fas fa-user"></i>
            <p>Employees</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="sidebarLayoutsEmployee">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('admin.employees.index') }}">
                  <span class="sub-item">Lists</span>
                </a>
              </li>
              <li>
                <a href="{{ route('admin.employees.create') }}">
                  <span class="sub-item">Add New</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        @endif
        @if ($user->role->name=="admin")
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#sidebarLayoutsExpense">
            <i class="fas fa-user"></i>
            <p>Expense</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="sidebarLayoutsExpense">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('admin.purchases.index') }}">
                  <span class="sub-item">Purchases</span>
                </a>
              </li>
              <li>
                <a href="{{ route('admin.salaries.index') }}">
                  <span class="sub-item">salaries</span>
                </a>
              </li>
              <li>
                <a href="{{ route('admin.expenses.others.index') }}">
                  <span class="sub-item">Others</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        @endif
      </ul>
    </div>
  </div>
</div>