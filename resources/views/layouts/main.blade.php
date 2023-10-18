<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">
  
  @vite(['resources/css/app.css','resources/js/app.js'])
  <script type="text/javascript" src="/js/index.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />

  <title>Manajemen Transportasi SCI</title>
  <link rel="icon" type="/img/logo3.png" href="/img/logo3.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  {{-- style for /post --}}
  <style>

    .font-family-montserrat {
        font-family: montserrat;
    }
  </style>
  {{-- js flowbite --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>  
</head>
<body>
    @include('partials.navbar')
    <div class="container mx-auto font-family-karla">
        @yield('container')
    </div>
</body>
</html>