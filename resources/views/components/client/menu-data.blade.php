@props([
"title" => "",
"products" => [],
"menuCount"=>""
])


<div class="mt-5">
    @if($title != "")
    <h3>{{$title}}</h3>
    <hr class="border-1  mb-4" style="border-color: black;">

    @endif
    <div class="row">
        @forelse ($products as $product)
        <x-client.menu :product="$product" :menuCount="$menuCount"></x-client.menu>
        @empty
        <h4>Nothing to Show</h4>
        @endforelse
    </div>
</div>