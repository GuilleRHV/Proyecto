<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--CSS-->
    <link rel="stylesheet" href="{{asset('css/plantilla.css')}}">
    <link rel="stylesheet" href="{{asset('css/registerylogin.css')}}">
   
    <link rel="stylesheet" href="{{asset('css/animaciones.css')}}">
    <script src="{{asset('js/eventosshow.js')}}"></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BiblioGames') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">




    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Contenido de tu vista -->


    <!-- Scripts -->
    @yield('scripts')

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('js/sweetalert2.all.min.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('js/jquery-3.5.1.js')}}"></script>
    <script src="{{asset('js/indexgames.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="{{asset('js/prueba.js')}}"></script>
    
    <link 
  href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" 
  rel="stylesheet"  type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-h+LJg7tGq0XkNzI1ehLN9gx7gGWpZlLtrGxq60fRuVavcN5VZFe+wEz1SVjDpAS2+Vyiq+Qwzgmx4fOdmvG7QA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    
<style>
    body {
        background-image: url('{{ asset("imagenes/fondo.jpg") }}');
        /* Ajusta el tamaño y posición de la imagen de fondo según tus necesidades */
    
        background-position: center;
      
    }
</style>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary ">
            <div class="container">
                <a class="navbar-brand" href="{{  route('proyects.index') }}">
               
                <img src="{{ asset('imagenes/logohorizontal.png') }}" alt="Bibliogames" width="200px" height="60px" style="border-radius: 20px 20px 20px 20px ;" class="pulsate-fwd">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        
                       

                    </ul>




                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesion') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item">
                            @if(auth()->user()->imagen!=null)
                            <img src="{{asset(Auth::user()->imagen)}}" style="border-radius: 50% 50% 50% 50%;width: 50px; height: 50px"/>
                            @else
                            <img src="{{asset('imagenesperfil/userdefault2.jpg')}}" style="border-radius: 50% 50% 50% 50%;width: 50px; height: 50px"/>
                            @endif
                        </li>
                        <li class="nav-item dropdown">
                           
                            
                           
                            

                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" style="display:''; flex-flow: ''" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" >
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Cerrar sesion') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!--NAvbar vertical-->
        


        <main class="py-4">
            @yield('adminnavbar')
            @yield('content')
          
        </main>














        




















      
    </div>
<!--Footer-->
    <footer class="text-center text-lg-start bg-white " id="footer">


<section class="">

  <div class="container text-center text-md-start mt-5">
    <!-- Columna -->
    <div class="row mt-3">
 
      <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
        <!-- Contenido columna -->
        <h6 class="text-uppercase fw-bold mb-4">
         BiblioGames
        </h6>
       
      </div>
    

     
      <!-- Columna -->
      <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
        <!-- Links -->
        <h6 class="text-uppercase fw-bold mb-4">
          Más de nosotros
        </h6>
        <a href="https://github.com/guillerhv" class="me-4 link-secondary">
      <i class="fa fa-github fa-3x"></i>
    </a>
        
      </div>
     
      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
        <h6 class="text-uppercase fw-bold mb-4">Contactanos</h6>
        <p><i class="fa fa-home me-3 text-secondary"></i> Zaragoza, ES</p>
        
    
      </div>

    </div>

  </div>
</section>

<div class="text-center p-4" >
  © 2023 Copyright:
  <a class="text-reset fw-bold" href="#">Bibliogames</a>
</div>

</footer>
@yield('js')

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

