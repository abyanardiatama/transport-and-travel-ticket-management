<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  {{-- Prevent cache on browser --}}
  {{-- <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"> --}}
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">
  
  {{-- JS Flowbite --}}
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
  @vite(['resources/css/app.css','resources/js/app.js'])
  <title>Manajemen Transportasi SCI</title>
  <link rel="icon" type="/logo-nobg.png" href="/logo-nobg.png">
  
  {{-- // Font Montserrat --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
  
</head>
<body class="bg-gray-50 dark:bg-gray-900  font-poppins">
    @include('dashboard.layouts.sidebar')
    <div>
        <div id="main-content" class="h-full max-w-full relative overflow-y-auto lg:ml-64">
            <main>
                @yield('container')
            </main>
       </div>

    </div>
</body>
</html>