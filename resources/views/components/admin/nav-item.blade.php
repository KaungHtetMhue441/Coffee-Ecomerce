@props([
"menus"=>[]
])
@forelse ($menus as $menu )
<li class="nav-item">
  <a data-bs-toggle="collapse" href="#sidebarLayouts{{$loop->index}}">
    {!!$menu['icon']!!}
    <p>{{$menu['name']}}</p>
    <span class="caret"></span>
  </a>
  <div class="collapse" id="sidebarLayouts{{$loop->index}}">
    <ul class="nav nav-collapse">
      @foreach ($menu["sub_menu"] as $sub_menu)
      <li>
        <a href="{{$sub_menu[1]}}">
          <span class="sub-item">{{$sub_menu[0]}}</span>
        </a>
      </li>
      @endforeach
    </ul>
  </div>
</li>
@empty

@endforelse