<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">

      <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
      {{-- incluidos --}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/> --}}
      <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/POSITRON/public/DataTables/datatables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.4/css/fixedHeader.bootstrap.css">
      {{-- /incluidos --}}

    <title>QAPOSITRON</title>
      {{-- incluidos --}}
    <style>
      .active{
        background-color: #EEEEEE;
        background-color: rgba(231, 231, 231, 0.3);
        /* font-weight: bold; */
      }
      .colorQA{
        background-color: #1A9980;
        color: white;
      }
      .bg-danger{
        color: white;
      }
      /* tr:hover{
        background-color: rgba(26, 153, 128, 0.1);
      } */
      input[type=number]::-webkit-inner-spin-button,
      input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
      }
      input[type=number] { -moz-appearance:textfield; }

      .select2-selection__placeholder {
        color: #4BD196;
      }
      
      .dropdown-menu  a:hover{
        background-color: rgba(26, 153, 128, 0.3);
        color:black;
      }
      .form-control:focus {
        border-color: white;
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(26, 153, 128, 1);
      }
      .form-select:focus{
        border-color: white;
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(26, 153, 128, 1);
      }
      .form-check-input:focus{
        border-color: white;
        /* background-attachment: #1A9980; */
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(26, 153, 128, 1);
      }
      .form-check-input:checked{
        background: #1A9980;
        border-color: white;
      }
      
      .form-input-error{
        margin-bottom: 0;
        display: none;

      }
      .dosisnaranja{
        border-color: orange;
        box-shadow: inset 0 1px 1px rgba(194, 20, 34, 0.075), 0 0 8px rgb(224, 69, 8);
      }
      .dosisroja{
        border-color: red;
        box-shadow: inset 0 1px 1px rgba(194, 20, 34, 0.075), 0 0 8px rgb(245, 6, 6);
      }
      .trdosisroja{
        color: red;
      }
      .trcorrect{
        /* background-color: #1A9980;
        color: orange; */
        box-shadow: inset 0 1px 1px rgba(194, 20, 34, 0.075), 0 0 8px rgb(245, 6, 6);
                        
      }
      .form-input-error-activo{
        display: block;
        color: red;
        font-size: 12px;
      }
      .form-error-message{
        display: none;
      }
      .form-error-message-activo{
        display: block;
      }
      .btn-disable{
        cursor: not-allowed;
        pointer-events: none;
        color: #c0c0c0;
        background-color: #ffffff;
      }
      .btn-circle{
        width: 50px;
        height: 50px;
        padding: 6px 0px;
        border-radius: 25px;
        text-align: center;
        font-size: 12px;
        line-height: 1.42857;
      }
      .dataTables_wrapper   .dataTables_filter{
          float: right
      }
    
      .dataTables_wrapper  .dataTables_length{
          float: left
      }
      .td{
        word-break:break-all;
      }
    </style>
        
    @livewireStyles
      {{-- /ncluidos --}}
  </head>
  <body>
    <div id="app">
      <nav class="navbar navbar-expand-md navbar-dark colorQA shadow-sm">
        <div class="container">
          <a class="navbar-brand" href="{{ url('/') }}">
              <img src="{{asset('imagenes/logo_positron.png')}}" width="170px">
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
                        <a class="nav-link" href="{{ route('login') }}">{{ __('LOGIN') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('REGISTRO') }}</a>
                    </li>
                @endif
              @else
                <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      {{  mb_strtoupper(Auth::user()->name) }}
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
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

      <main >
        @yield('content')
      </main>
    </div>

      {{-- incluidos --}}
      @livewireScripts
      
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script type="text/javascript">
          Livewire.on('alert', function(message){
              Swal.fire(
              '',
              message,
              'success'
              )
          })
      </script>

      <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- DataTables JS -->
    <script type="text/javascript" src= "<?php $_SERVER['DOCUMENT_ROOT'] ?>/POSITRON/public/DataTables/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.js"></script>
      
      {{-- /incluidos --}}

  </body>
</html>
