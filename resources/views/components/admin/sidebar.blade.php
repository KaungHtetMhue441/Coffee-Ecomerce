@props([
  'menus'=>[
    [
      "name"=>"category",
      "sub_menu"=>[
        [
          "All Categories",
          route("category.index")
        ],
        [
          "Add Category",
          route('category.create')
        ]

      ]
    ],
    [
      "name"=>"Product",
      "sub_menu"=>[
        [
          "All Product",
          route("product.index")
        ],
        [
          "Add Product",
          route("product.create")
        ]
      ]
    ]

  ]
])
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="dark">
        <a href="index.html" class="logo">
          <img
            src="assets/img/kaiadmin/logo_light.svg"
            alt="navbar brand"
            class="navbar-brand"
            height="20"
          />
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
          <x-admin.nav-item :menus="$menus">

          </x-admin.nav-item>
        </ul>
      </div>
    </div>
  </div>