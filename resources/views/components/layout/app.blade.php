<!DOCTYPE html>
<html data-theme="winter" lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Streetlamp Locator</title>
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

  {{-- CSS --}}
  @vite('resources/css/app.css')
  {{-- <link rel="stylesheet" href="{{ asset('build/assets/app-81ab19c4.css') }}"> <!-- CSS Build --> --}}
  <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/quill.snow.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dataTables.tailwindcss.min.css') }}">

  {{-- JS --}}
  {{-- <script src="{{ asset('build/assets/app-6bb05423.js') }}"></script> <!-- JS Build --> --}}
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script defer src="{{ asset('js/alpine.min.js') }}"></script>
  <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('js/dataTables.tailwindcss.min.js') }}"></script>
  <script src="{{ asset('js/select2.min.js') }}"></script>
  <script src="{{ asset('js/sweetalert2.js') }}"></script>
  <script src="{{ asset('js/html5-qrcode.min.js') }}"></script>
  <script src="{{ asset('js/quill.min.js') }}"></script>

  {{-- Font Awesome --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  {{-- Leaflet.js --}}
  <link rel="stylesheet" href="{{ asset('leaflet/leaflet.css') }}"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <script src="{{ asset('leaflet/leaflet.js') }}" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
</head>

<body class="font-lato">
  @yield('content')
  @include('sweetalert::alert')

  @yield('js')
</body>

</html>
