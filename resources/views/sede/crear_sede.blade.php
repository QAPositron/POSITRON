
{{-- <!doctype html>
<html lang="en">
    
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{csrf_token() }}">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        
        @livewireScripts

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
        
    </head>
    <body>
        <!-- ///////////////HEADER NAV/////////// -->
        @include('layouts.partials.header')
        --}}
@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')    
        <!-- //////////////////// CONTENIDO ///////////////// -->
        {{-- <div class="container mt-5 p-auto "> --}}
            <div class="row">

                <div class="col"></div>
                <div class="col-8">
                    <div class="card text-dark bg-light">
                        <h2 class="text-center mt-3">CREAR SEDE</h2>

                        <form class="m-4" id="form_create_sede" name="form_create_sede" action="{{route('sedes.save')}}" method="POST">
                        
                            @csrf
                            <label for="">AÑADA LOS DEPARTAMENTOS DE ESPECIALIDADES QUE CONTEGA ESTA SEDE</label>
                            <br>
                            <br>
                            <div class="row g-2">
                                <div class="col-10">
                                    <label for="">ESPECIALIDADES:</label>
                                    <div class="form-floating">
                                        <select class="form-select @error('multiple_select_depsede') is-invalid @enderror" id="multiple_select_depsede" name="multiple_select_depsede[]" autofocus aria-label="Floating label select example" multiple="true">
                                            @foreach($especialidades as $dep)
                                                <option value="{{$dep->id_departamento}}" {{ in_array($dep->id_departamento, (array) old('multiple_select_depsede', [])) ? "selected" : "" }}>{{$dep->nombre_departamento}}</option>
                                            @endforeach
                                        </select>
                                        @error('multiple_select_depsede') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                                    </div>    
                                </div>
                                <div class="col-md mt-4">
                                    <div class="col-md d-flex align-items-center ">
                                        <button type="button" class="btn colorQA" data-bs-toggle="modal" data-bs-target="#nuevo_deptoModal" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row g-2">
                                <div class="col-md">
                                    <div class="form-floating text-wrap">
                                        <input type="text" class="form-control"   name="empresas_id" id="empresas_id" value="{{old('empresas_id', $empresa->nombre_empresa)}}" autofocus style="text-transform:uppercase;" disabled>
                                        <input type="text" class="form-control @error('id_empresa') is-invalid @enderror"   name="id_empresa" id="id_empresa" value="{{old('id_empresa', $empresa->id_empresa)}}" autofocus style="text-transform:uppercase;" hidden>
                                        <label for="floatingSelectGrid">EMPRESA:</label>
                                        @error('id_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-floating text-wrap">
                                        <input type="text" class="form-control @error('nombre_sede') is-invalid @enderror"  name="nombre_sede" id="nombre_sede" value="{{old('nombre_sede')}}" autofocus style="text-transform:uppercase;">
                                        <label for="floatingInputGrid">NOMBRE DE LA SEDE:</label>
                                        @error('nombre_sede') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row g-2">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="floatingInputGrid">DEPARTAMENTO:</label>
                                        <select class="form-control @error('departamento_sede') is-invalid @enderror"  name="departamento_sede" id="departamento_sede" value="{{old('departamento_sede')}}" autofocus style="text-transform:uppercase">
                                            <option value="">--SELECCIONE--</option>
                                            @foreach($departamentoscol as $depacol)
                                                <option value="{{$depacol->id_departamentocol}}" @if (old('departamento_sede') == $depacol->id_departamentocol) {{ 'selected' }} @endif>{{$depacol->nombre_deptocol}}</option>
                                            @endforeach
                                        </select>
                                        @error('departamento_sede') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md" id="div_municipio">
                                    <div class="spinner_municipio text-center" id="spinner_municipio">

                                    </div>

                                    <div class="form-group" id="municipio_empresa" name="municipio_empresa">
                                        <label for="floatingInputGrid">MUNICIPIO:</label>
                                        <select class="form-control @error('municipio_sede') is-invalid @enderror" name="municipio_sede" id="municipio_sede" value="{{old('municipio_sede')}}" autofocus style="text-transform:uppercase">

                                        </select>
                                        @error('municipio_sede') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-floating text-wrap">
                                <input type="text" name="direccion_sede" id="direccion_sede" class="form-control @error('direccion_sede') is-invalid @enderror" value="{{old('direccion_sede')}}"  autofocus style="text-transform:uppercase;">
                                <label for="">DIRECCIÓN:</label>
                                @error('direccion_sede') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                            </div>
                            <br>
                            
                            <div class="row">
                                <div class="col"></div>
                                <div class="col d-grid gap-2">
                                    <input class="btn colorQA" type="submit" id="boton-guardar" name="boton-guardar" value="GUARDAR">
                                </div>
                                <div class="col d-grid gap-2">
                                    <a href="{{route('empresas.info', $empresa->id_empresa)}}" class="btn btn-danger " type="button" id="cancelar" name="cancelar" role="button">CANCELAR</a>
                                </div>
                                <div class="col"></div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col"></div>    
            </div>
        {{-- </div> --}}
        <div class="modal fade" id="nuevo_deptoModal" tabindex="-1" aria-labelledby="nuevo_deptoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title w-100 text-center" id="nuevo_deptoModalLabel">NUEVA ESPECIALIDAD</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    @livewire('form-departamento')
                    
                </div> 
            </div>
        </div>
        <script
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous">
        </script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if(session('guardar')== 'ok')
            <script>
                Swal.fire(
                'GUARDADO!',
                'SE HA GUARDADO CON ÉXITO.',
                'success'
                )
            </script>
        @endif
        <script type="text/javascript">
            $(document).ready(() => {

                $('#multiple_select_depsede').select2({
                    placeholder:"SELECCIONE LAS ESPECIALIDADES",
                    tags: true,
                    tokenSeparators: ['/',',',',',','," "]
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#departamento_sede').select2();
                $('#municipio_sede').select2();
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                var olddepto = '{{old('departamento_sede')}}';
                var oldciudad = '{{old('municipio_sede')}}';
                if('{{old('municipio_sede')}}' == ''){
                    console.log("si esta vacio");
                    console.log('{{old('municipio_sede')}}');
                }else{
                    console.log("no esta vacio");
                    console.log('{{old('municipio_sede')}}');
                    @foreach($municipioscol as $muni)
                        if('{{$muni->id_municipiocol}}' == oldciudad){
                            console.log('{{$muni->nombre_municol}}');
                            $('#municipio_sede').append("<option value='{{$muni->id_municipiocol}}'>" +'--{{$muni->nombre_municol}}--' + "</option>");
                        }
                    @endforeach
                    @foreach($municipioscol as $muni)
                        $('#municipio_sede').append("<option value='{{$muni->id_municipiocol}}'>" +'{{$muni->nombre_municol}}' + "</option>");
                    @endforeach
                }
                $('#departamento_sede').on('change', function(){
                    $('#municipio_empresa').fadeOut();
                    $('#spinner_municipio').html('<div class="spinner-border text-secondary" id="spinner" role="status"></div>');
                    var departamento_id = $(this).val();

                    var padre = document.getElementById("spinner_municipio");
                    var hijo = document.getElementById("spinner");
                    /* alert(departamento_id); */
                    if($.trim(departamento_id) != ''){
                        $.get('sedesdeptomuni', {departamento_id: departamento_id}, function(municipios){
                            console.log(municipios);
                            var remove = padre.removeChild(hijo);
                            $('#municipio_empresa').fadeIn();
                            $('#municipio_sede').empty();
                            $('#municipio_sede').append("<option value=''>--SELECCIONE UNA SEDE--</option>");
                            $.each(municipios, function(index, value){
                                $('#municipio_sede').append("<option value='"+ index + "'>" + value + "</option>");
                            })
                        });
                    }
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#form_create_sede').submit(function(e){
                    e.preventDefault();
                    Swal.fire({
                        text: "DESEA GUARDAR ESTA SEDE??",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'SI, SEGURO!'
                        }).then((result) => {
                        if (result.isConfirmed) {
                           
                            this.submit();
                        }
                    })
                });
                $('#form_crear_depto').submit(function(e){
                    e.preventDefault();
                    Swal.fire({
                        text: "DESEA GUARDAR ESTA ESPECIALIDAD??",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'SI, SEGURO!'
                        }).then((result) => {
                        if (result.isConfirmed) {
                           
                            this.submit();
                        }
                    })
                })
            })
        </script>
@endsection
    {{-- </body>
</html> --}}