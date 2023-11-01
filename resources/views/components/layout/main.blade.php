<!DOCTYPE html>
<html class="light" data-theme="winter" lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Streetlamp Locator</title>
  {{-- CSS --}}
  @vite('resources/css/app.css')
  <link rel="stylesheet" href="{{ asset('css/dataTables.tailwindcss.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
  {{-- JS --}}
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/alpine.min.js') }}"></script>
  <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('js/dataTables.tailwindcss.min.js') }}"></script>
  <script src="{{ asset('js/select2.min.js') }}"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <header class="bg-secondary">
    <div class="container mx-auto px-4 py-2 max-w-[1280px]">
      <div class="flex items-center justify-center gap-x-4">
        <i class="fa-regular fa-lightbulb text-white text-2xl"></i>
        <div>
          <p class="text-lg text-white font-semibold tracking-widest">Lamp Loc</p>
          <p class="text-xs text-white/70">Streetlamp Locator</p>
        </div>
      </div>
    </div>
  </header>

  <nav class="border-b bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 pt-2">
      <ul class="tabs">
        <a class="tab tab-bordered text-black pb-2 {{ Route::is('dashboard.index') ? 'tab-active' : null }}"
          href="{{ route('dashboard.index') }}">
          <div class="flex items-center gap-x-2">
            <i class="fa-solid fa-gauge"></i>
            <span class="text-sm">Dashboard</span>
          </div>
        </a>
        <a class="tab tab-bordered text-black pb-2 {{ Route::is('streetlight.index') ? 'tab-active' : null }}"
          href="{{ route('streetlight.index') }}">
          <div class="flex items-center gap-x-2">
            <i class="fa-solid fa-bolt"></i>
            <span class="text-sm">Streetlight</span>
          </div>
        </a>
        <a class="tab tab-bordered text-black pb-2 {{ Route::is('report.index') ? 'tab-active' : null }}"
          href="{{ route('report.index') }}">
          <div class="flex items-center gap-x-2">
            <i class="fa-regular fa-flag"></i>
            <span class="text-sm">Report</span>
          </div>
        </a>
        <a class="tab tab-bordered text-black pb-2" href="{{ route('auth.logout') }}">
          <div class="flex items-center gap-x-2">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span class="text-sm">Logout</span>
          </div>
        </a>
      </ul>
    </div>
  </nav>

  <div class="container mx-auto px-4 py-4">
    @yield('content')
  </div>

  @yield('js')
</body>

</html>

{{-- <x-layout.main>
  @section('content')

  @endsection

  @section('js')
    <script>

    </script>
  @endsection
</x-layout.main> --}}
