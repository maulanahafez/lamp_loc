<!DOCTYPE html>
<html data-theme="winter" lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Streetlamp Locator</title>
  @vite('resources/css/app.css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="font-lato bg-cover bg-center"
  style="background-image: url('{{ asset('img/streetlight-landscape.jpg') }}')">
  @yield('content')

  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/alpine.min.js') }}"></script>

  @yield('js')
</body>

</html>
