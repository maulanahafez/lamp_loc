@props(['streetlight'])

<div class="relative" x-data="handleQrcode()">
  <div class="h-80 lg:h-full w-full rounded-sm shadow-sm border border-secondary" x-data="{ count: {{ $streetlight->images->count() }}, show: 1 }">
    @if ($streetlight->images->count() != 0)
      @foreach ($streetlight->images as $item)
        <img class="h-full w-full object-cover cursor-pointer hover:brightness-75" src="{{ $item->img_path }}"
          alt="" x-show="show == {{ $loop->iteration }}" x-on:click="show + 1 > count ? show = 1 : show++">
      @endforeach
    @else
      <div class="w-full h-full flex items-center justify-center px-8 text-center font-semibold">
        This streetlight doesn't have an image
      </div>
    @endif
  </div>
  <div class="absolute top-4 left-4">
    <button class="btn btn-sm btn-secondary bg-white btn-outline rounded-sm" type="button" x-on:click="toggle()">
      <i class="fa-solid fa-qrcode text-lg"></i>
    </button>
  </div>
  <div class="absolute inset-0 z-10 border border-secondary bg-white" x-show="show" x-cloak>
    <div class="relative w-full h-full">
      <div class="top-4 left-4 absolute z-10">
        <button class="btn btn-sm btn-secondary bg-white btn-outline rounded-sm" type="button" x-on:click="toggle()">
          <i class="fa-solid fa-xmark text-lg"></i>
        </button>
      </div>
      <div class="flex items-center justify-center h-full scale-150">
        {!! QrCode::generate("streetlight-$streetlight->id") !!}
      </div>
    </div>
  </div>
</div>
<script>
  function handleQrcode() {
    return {
      show: false,
      toggle() {
        this.show = !this.show
      },
    }
  }
</script>
