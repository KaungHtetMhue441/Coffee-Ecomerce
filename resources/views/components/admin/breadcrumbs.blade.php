
@props([
    "items"=>array()
])
<ul class="breadcrumbs m-0 mb-3">
    @foreach ($items as $item)
    <li class="nav-item">
        <a href="#">{{$item}}</a>
    </li>
    @if($loop->index<count($items)-1)
    <li class="separator">
        <i class="icon-arrow-right"></i>
    </li>
    @endif
    @endforeach
</ul>