@props([
"menus"=>[[
"name" => "Category",
"sub_menu" => [
[
"All Categories",
route("admin.category.index")
],
[
"Add Category",
route('admin.category.create')
]

]
],
[
"name" => "Product",
"sub_menu" => [
[
"All Product",
route("admin.product.index")
],
[
"Add Product",
route("admin.product.create")
]
]
],
[
"name" => "Sales",
"sub_menu" => [
[
"Create new sale",
route("admin.sale.new")
],
[
"Sale report",
route("admin.sale.index")
],
[
"Drafts sale",
route("admin.sale.drafts")
]
]
],
[
"name" => "Account",
"sub_menu" => [
[
"Users",
route("admin.account.user.index")
],
[
"Admins",
route("admin.account.admin.index")
],
]
],
]
])
<div class="sidebar" data-background-color="dark">
  <div class="sidebar-logo">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark">
      <a href="index.html" class="logo text-white">
        <!-- <img src="{{asset("images/logo.jpg")}}" alt="navbar brand" class="navbar-brand" height="20" /> -->
        Kaung Coffee
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
        <li class="nav-item">
          <a href="{{route("admin.dashboard")}}" class="collapsed">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <x-admin.nav-item :menus="$menus">

        </x-admin.nav-item>
      </ul>
    </div>
  </div>
</div>