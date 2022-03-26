<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <!-- <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/> -->

    


    <title>CREATE</title>
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
      tr:hover{
        background-color: rgba(26, 153, 128, 0.1);
      }
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
     
      </style>
    
    
    @livewireStyles
  </head>
  <body>
    <!-- ///////////////HEADER NAV/////////// -->
    @include('layouts.partials.header')


    <!-- //////////////////// CONTENIDO ///////////////// -->
    <div class="container mt-5 p-auto ">
        @yield('contenido')
    </div>
    @livewireScripts
    

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    
    


    
    
  </body>
</html>