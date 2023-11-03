@props(['streetlight'])

<div>
  <div class="h-80 lg:h-full w-full rounded-sm shadow-sm cursor-pointer hover:brightness-75" x-data="{ count: {{ $streetlight->images->count() }}, show: 1 }">
    @foreach ($streetlight->images as $item)
      <img class="h-full w-full object-cover" src="{{ $item->img_path }}" alt=""
        x-show="show == {{ $loop->iteration }}" x-on:click="show + 1 > count ? show = 1 : show++">
    @endforeach
  </div>
</div>
