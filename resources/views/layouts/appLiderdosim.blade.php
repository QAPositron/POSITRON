<html lang="en">
    <head>
        <meta charset="utf-8">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- incluidos --}}
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        {{-- <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/> --}}
        <!-- DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
        
        <link rel="stylesheet" href="{{ asset('/css/styleSideBar.css') }}">
        {{-- /incluidos --}}

        <title>QAPOSITRON</title>
        {{-- incluidos --}}
        <style>
            .active{
                background-color: #EEEEEE;
                background-color: rgba(231, 231, 231, 0.3);
                /* font-weight: bold; */
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
            .ir-arriba {
                display:none;
                font-size:20px;
                cursor:pointer;
                position: fixed;
                bottom:20px;
                right:20px;
            }
            #mycontainer{
                margin-top: 80px !important;
                margin-left: 380px !important;
                margin-right:30px !important;
            } 
            #minibarra{
                background: linear-gradient(-90deg, #213b74, #188E80);
                position: fixed;
                top: 0px;
                width: 100%;
                height: 80px;
            }
            #altominibar{
                height: 80px;
            }
            .colorQA{
                color:#1A9980;
            }
            body{
                background-image: url('{{ asset('imagenes/fondo13.png')}}');
                background-repeat: no-repeat;
                background-position: top 80px left 350px;
            }
        </style>

            
        @livewireStyles
        {{-- /ncluidos --}}
    </head>
    <body>
        <div id="app">
            <div class="menu">
                <ion-icon name="menu-outline"></ion-icon>
                <ion-icon name="close-outline"></ion-icon>
            </div>
        
            <div class="barra-lateral">
                <div>
                    <div class="nombre-pagina">
                        <img src="{{asset('imagenes/LOGO_AMARILLO.png')}}"  id="cloud">
                    </div>
                </div>
        
                <nav class="navegacion">
                    <ul>
                        <li>
                            <a id="inbox" href="{{route('liderdosim.home')}}">
                                <ion-icon name="chevron-forward-outline"></ion-icon>
                                <span style="font-size: 20px;">Inicio</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <ion-icon name="chevron-forward-outline"></ion-icon>
                                <span style="font-size: 20px;">Empresas</span>
                            </a>
                            {{-- <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul> --}}
                            {{-- <a href="{{route('liderdosim.sedes')}}">
                                <ion-icon name="star-outline"></ion-icon>
                                <span>Empresa</span>
                            </a> --}}
                        </li>
                        <li>
                            <a class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <ion-icon name="chevron-forward-outline"></ion-icon>
                                <span style="font-size: 20px;">Sedes</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <ion-icon name="chevron-forward-outline"></ion-icon>
                                <span style="font-size: 20px;">Novedades</span>
                            </a>
                        </li>
                        
                    </ul>
                </nav>
        
                <div class="perfil">
                    <div class="linea"></div>
            
                    <div class="usuario">
                        <ion-icon name="person-circle-outline"></ion-icon>
                        <div class="info-usuario">
                            <div class="nombre-email">
                                <span class="nombre">{{  ucwords(mb_strtolower(Auth::user()->name)) }}</span>
                                <span class="email">{{strtolower(Auth::user()->email)}}</span>
                            </div>
                            <div>
                                <a id="navbarDropdown" class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                            </div>
                            
                        </div>
                    </div>
                </div>
        
            </div>
            <main>
                <div id="minibarra">
                    <div class="row justify-content-center align-items-center mx-5" id="altominibar">
                        <div class="col-md"></div>
                        <div class="col-md"></div>
                        <div class="col-md ml-2">
                            <h3 class="text-end mx-3 mt-2 text-light">{{$personasede[0]->razon_social_empresa}}</h3>
                        </div>
                    </div>
                </div>
                <div id="mycontainer">
                    @yield('contenido')
                </div>
            </main>
        </div>
    
        {{-- incluidos --}}
        @livewireScripts
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
        <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <!-- Option 1: Bootstrap Bundle with Popper -->
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
        <!-- DataTables JS -->
        <script type="text/javascript" src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
          
          {{-- /incluidos --}}
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <script type="text/javascript" src="{{ asset('/js/sidebar.js') }}"></script>
    </body>
</html>