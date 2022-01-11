@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col"></div>
    <div class="col-6">
        <div class="card text-dark bg-light">
            <h2 class="text-center mt-3">CREAR TRABAJADOR</h2>
            <form class="m-4" action="{{route('trabajadores.save')}}" method="POST">

                @csrf

                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select" name="id_empresas" id="id_empresas" autofocus aria-label="Floating label select example">
                                <option value="{{$empresa->id_empresa}}">{{$empresa->nombre_empresa}}</option>
                            </select>
                            <label for="floatingSelectGrid">EMPRESA:</label>
                            @error('id_empresas')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                        <select class="form-select" name="id_sedes" id="id_sedes">
                            <option value="{{old('id_sedes')}}">--SELECCIONE--</option>
                            @foreach($sedes as $sed)
                                <option value ="{{ $sed->id_sede }}">{{$sed->nombre_sede}}</option>
                            @endforeach
                        </select>
                        <label for="floatingSelectGrid">SEDE:</label>
                        @error('id_sedes')
                            <small>*{{$message}}</small>
                        @enderror
                        </div>
                    </div>
                </div>
                <br>
                
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control"  name="primer_nombre_trabajador" id="primer_nombre_trabajador" value="{{old('primer_nombre_trabajador')}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">PRIMER NOMBRE:</label>
                            @error('primer_nombre_trabajador')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control"  name="segundo_nombre_trabajador" id="segundo_nombre_trabajador" value="{{old('segundo_nombre_trabajador')}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">SEGUNDO NOMBRE:</label>
                            @error('segundo_nombre_trabajador')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control"  name="primer_apellido_trabajador" id="primer_apellido_trabajador" value="{{old('primer_apellido_trabajador')}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">PRIMER APELLIDO:</label>
                            @error('primer_apellido_trabajador')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control"  name="segundo_apellido_trabajador" id="segundo_apellido_trabajador" value="{{old('segundo_apellido_trabajador')}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">SEGUNDO APELLIDO:</label>
                            @error('segundo_apellido_trabajador')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select" name="tipoIden_trabajador" id="tipoIden_trabajador" value="{{old('tipoIden_trabajador')}}" autofocus style="text-transform:uppercase">
                                <option value="">--SELECCIONE--</option>
                                <option value="CÉDULA DE CIUDADANIA">CÉDULA DE CIUDADANIA</option>
                                <option value="TARJETA DE IDENTIDAD">TARJETA DE IDENTIDAD</option>
                                <option value="REGISTRO CIVIL">REGISTRO CIVIL</option>
                                <option value="PASAPORTE">PASAPORTE</option>
                                <option value="CÉDULA DE EXTRANJERÍA">CÉDULA DE EXTRANJERÍA</option>
                                <option value="TARJETA DE EXTRANJERÍA">TARJETA DE EXTRANJERÍA</option>
                                <option value="DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO">DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO</option>
                            </select>
                            <label for="floatingInputGrid">TIPO DE IDENTIFICACIÓN:</label>
                            @error('tipoIden_trabajador')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" class="form-control"  name="cedula_trabajador" id="cedula_trabajador" value="{{old('cedula_trabajador')}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">CEDULA:</label>
                            @error('cedula_trabajador')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <select class="form-select" name="genero_trabajador" id="genero_trabajador" style="text-transform:uppercase;">
                                <option value="{{old('genero_trabajador')}}">--SELECCIONE--</option>
                                <option value="femenino">FEMENINO</option>
                                <option value="masculino">MASCULINO</option>
                                <option value="otro">OTRO</option>
                            </select>
                            <label for="floatingInputGrid">GÉNERO:</label>
                            @error('genero_trabajador')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="email" class="form-control" name="correo_trabajador" id="correo_trabajador" value="{{old('correo_trabajador')}}" autofocus style="text-transform:uppercase;">
                            <label for="">CORREO:</label>
                            @error('correo_trabajador')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="number" class="form-control"  name="telefono_trabajador" id="telefono_trabajador" value="{{old('telefono_trabajador')}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">TELÉFONO:</label>
                            @error('telefono_trabajador')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <select class="form-select" name="tipo_trabajador" id="tipo_trabajador" style="text-transform:uppercase;" autofocus aria-label="Floating label select example">
                                <option value="{{old('tipo_trabajador')}}">--SELECCIONE--</option>
                                <option value="TOE">TOE: TRABAJADOR OCUPACIONALMENTE EXPUESTO</option>
                                <option value="OPR">OPR: OFICIAL DE PROTECCIÓN RADIOLÓGICA</option>
                                <option value="CASO">CASO: TRABAJADOR CON DOSIMETRO TIPO CASO</option>
                            </select>
                            <label for="">PERFIL LABORAL:</label>
                            @error('telefono_trabajador')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <h6 class="text-center">ACTIVAR AL TRABAJADOR EN EL MODULO DE:</h6>
                <div class="row g-2">
                    <div class="col-md"></div>
                    <div class="col-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="ckeckAulaVirtual" name="ckeckAulaVirtual" >
                            <label class="custom-control-label" for="ckeckAulaVirtual">AULA VIRUTAL</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="checkDosimetria" name="checkDosimetria">
                            <label class="custom-control-label" for="checkDosimetria">DOSIMETRÍA</label>
                        </div>
                    </div>
                    <div class="col-md"></div>
                </div>
                <br>    
                <!---------BOTON------------->
                <div class="row">
                    <div class="col"></div>
                    <div class="col d-grid gap-2">
                        <input class="btn colorQA" type="submit" id="boton-guardar" name="boton-guardar" value="GUARDAR">
                    </div>
                    <div class="col"></div>
                </div>
            </form>
        </div>
    </div>
    <div class="col"></div>
</div>
<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous">
</script>
<script type="text/javascript">
    $(document).ready(function(){

        

        $('#id_empresas').on('change', function(){
            var empresa_id = $(this).val();
            alert(empresa_id);
            if($.trim(empresa_id) != ''){
                $.get('prueba2',{empresa_id : empresa_id}, function(sedes){
                    console.log(sedes);
                    $('#id_sedes').empty();
                    $('#id_sedes').append("<option value=''>--SELECCIONE UNA SEDE--</option>");
                    $.each(sedes, function(index, value){
                        $('#id_sedes').append("<option value='"+ index + "'>" + value + "</option>");
                    })
                });
            }

        });
    })
</script>
@endsection 
