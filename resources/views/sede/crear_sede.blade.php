
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
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

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
        
        </style>
        
    </head>
    <body>
        <!-- ///////////////HEADER NAV/////////// -->
        @include('layouts.partials.header')
       
        <!-- //////////////////// CONTENIDO ///////////////// -->
        <div class="container mt-5 p-auto ">
            <div class="row">

                <div class="col"></div>
                <div class="col-8">
                    <div class="card text-dark bg-light">
                        <h2 class="text-center mt-3">CREAR SEDE</h2>

                        <form class="m-4" action="{{route('sedes.save')}}" method="POST">
                        
                            @csrf

                            <div class="row g-2">
                                <div class="col-md">
                                    <div class="form-floating text-wrap">
                                        <input type="text" class="form-control"   name="empresas_id" id="empresas_id" value="{{old('empresas_id', $empresa->nombre_empresa)}}" autofocus style="text-transform:uppercase;" disabled>
                                        <input type="text" class="form-control"   name="id_empresa" id="id_empresa" value="{{old('id_empresa', $empresa->id_empresa)}}" autofocus style="text-transform:uppercase;" hidden>
                                        <label for="floatingSelectGrid">EMPRESA:</label>
                                        @error('id_empresa')
                                            <small>*{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-floating text-wrap">
                                        <input type="text" class="form-control"  name="nombre_sede" id="nombre_sede"  autofocus style="text-transform:uppercase;">
                                        <label for="floatingInputGrid">NOMBRE DE LA SEDE:</label>
                                        @error('nombre_sede')
                                            <small>*{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row g-2">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="floatingInputGrid">DEPARTAMENTO:</label>
                                        <select class="form-control"  name="departamento_sede" id="departamento_sede" value="{{old('departamento_sede')}}" autofocus style="text-transform:uppercase">
                                            <option value="">--SELECCIONE--</option>
                                            @foreach($departamentoscol as $depacol)
                                                <option value="{{$depacol->id_departamentocol}}">{{$depacol->nombre_deptocol}}</option>
                                            @endforeach
                                        </select>
                                        @error('departamento_sede')
                                            <small>*{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="floatingInputGrid">MUNICIPIO:</label>
                                        <select class="form-control" name="municipio_sede" id="municipio_sede" value="{{old('municipio_sede')}}" autofocus style="text-transform:uppercase">

                                        </select>
                                        @error('municipio_sede')
                                            <small>*{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-floating text-wrap">
                                <input type="text" name="direccion_sede" id="direccion_sede" class="form-control"  autofocus style="text-transform:uppercase;">
                                <label for="">DIRECCIÓN:</label>
                            </div>
                            <br>
                            <label for="">AÑADA LOS DEPARTAMENTOS DE ESPECIALIDADES QUE CONTEGA ESTA SEDE</label>
                            <br>
                            <br>
                            <div class="row g-2">
                                
                                <div class="col-10">
                                    <label for="">ESPECIALIDADES:</label>
                                    <div class="form-floating">
                                        <select class="form-select" id="multiple_select_depsede" name="multiple_select_depsede[]" autofocus aria-label="Floating label select example" multiple="true">
                                            <option value="ONCO">ONCOLOGÍA</option>
                                            <option value="ODON">ODONTOLOGÍA</option>
                                            <option value="CIRU">CIRUJIA</option>
                                            <option value="UCI">UCI</option>
                                        </select>
                                    </div>    
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col"></div>
                                <div class="col d-grid gap-2">
                                    <input class="btn colorQA" type="submit" id="boton-guardar" name="boton-guardar" value="GUARDAR">
                                </div>
                                <div class="col d-grid gap-2">
                                    <a href="{{route('empresas.search')}}" class="btn btn-danger " type="button" id="cancelar" name="cancelar" role="button">CANCELAR</a>
                                </div>
                                <div class="col"></div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col"></div>    
            </div>
        </div>
        <!-- <script
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous">
        </script> -->
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
                $('#departamento_sede').on('change', function(){
                    var departamento_id = $(this).val();
                    /* alert(departamento_id); */
                    if($.trim(departamento_id) != ''){
                        $.get('sedesdeptomuni', {departamento_id: departamento_id}, function(municipios){
                            console.log(municipios);
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
    </body>
</html>