<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

  <!-- Libraries -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script defer src="https://unpkg.com/alpinejs@3.7.0/dist/cdn.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js"
          integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/css/front.css'])

  <!-- Styles -->
  @livewireStyles
</head>

<body>
  <main>
    
  <nav class="px-6 py-4">
      <div class="flex flex-col justify-between h-16 w-full lg:flex-row lg:items-center">
        <!-- Logo & Toggler Button here -->
        <div class="flex items-center justify-between">
          <!-- LOGO -->
          <a href="{{ route('front.index') }}">
            <img src="/logo/logo.svg" alt="logo"/>
          </a>
          <!-- RESPONSIVE NAVBAR BUTTON TOGGLER -->
          <div class="block lg:hidden">
            <button class="p-1 outline-none mobileMenuButton" id="navbarToggler" data-target="#navigation">
              <svg class="text-dark w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                   xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
              </svg>
            </button>
          </div>
        </div>

        <!-- Nav Menu -->
        <div class="hidden w-full lg:block" id="navigation">
          <div class="flex flex-col items-baseline gap-4 mt-6 lg:justify-between lg:flex-row lg:items-center lg:mt-0">
            <div class="flex flex-col w-full ml-auto lg:w-auto gap-4 lg:gap-[50px] lg:items-center lg:flex-row">
              <a href="{{ route('front.index') }}" class="nav-link-item">Home</a>
             @auth

                @if(auth()->user() == true)
                  <a href="#!" class="nav-link-item">My Order</a>
              <a href="#!" class="nav-link-item">Profile</a>
                

                @endif
                  

             @endauth
            </div>
            @auth
              <div class="flex flex-col w-full ml-auto lg:w-auto lg:gap-12 lg:items-center lg:flex-row">

              {{-- Admin Dashboard Link --}}
                @if(auth()->user()->roles === 'admin') 
                  <a href="{{ route('bookings.index') }}" class="nav-link-item hover:text-green-800">Dashboard</a>
                @endif

                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <a href="{{ route('logout') }}" class=" border p-2.5 rounded text-gray-600 text-sm font-semibold"
                     onclick="event.preventDefault();
                  this.closest('form').submit();">
                    Log Out
                  </a>
                </form>
                
              </div>
            @else
              <div class="flex flex-col w-full ml-auto lg:w-auto lg:gap-12 lg:items-center lg:flex-row">
                <a href="{{ route('login') }}" class=" border p-2.5 rounded text-gray-600 text-sm font-semibold">
                  Log In
                </a>
              </div>
            @endauth
          </div>
        </div>
      </div>
    </nav>

    {{ $slot }}
  </main>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({
      once: true,
      duration: 300,
      easing: 'ease-out'
    });
  </script>

  <script src="{{ url('js/script.js') }}"></script>

</body>

</html>