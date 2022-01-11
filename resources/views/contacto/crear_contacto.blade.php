@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col"></div>
    <div class="col-6">
        <div class="card text-dark bg-light">
            <h2 class="text-center mt-3">CREAR CONTACTO</h2>
            <form class="m-4" action="{{route('contactos.save')}}" method="POST">

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
                </div>
                <br>
                <div class="row g-2">
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
                            <input type="text" class="form-control"  name="primer_nombre_contacto" id="primer_nombre_contacto" value="{{old('primer_nombre_contacto')}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">PRIMER NOMBRE:</label>
                            @error('primer_nombre_contacto')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control"  name="segundo_nombre_contacto" id="segundo_nombre_contacto" value="{{old('segundo_nombre_contacto')}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">SEGUNDO NOMBRE:</label>
                            @error('segundo_nombre_contacto')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control"  name="primer_apellido_contacto" id="primer_apellido_contacto" value="{{old('primer_apellido_contacto')}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">PRIMER APELLIDO:</label>
                            @error('primer_apellido_contacto')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control"  name="segundo_apellido_contacto" id="segundo_apellido_contacto" value="{{old('segundo_apellido_contacto')}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">SEGUNDO APELLIDO:</label>
                            @error('segundo_apellido_contacto')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select" name="tipoIden_contacto" id="tipoIden_contacto" value="{{old('tipoIden_contacto')}}" autofocus style="text-transform:uppercase">
                                <option value="">--SELECCIONE--</option>
                                <option value="CÉDULA DE EXTRANJERÍA">CÉDULA DE EXTRANJERÍA</option>
                                <option value="TARJETA DE EXTRANJERÍA">TARJETA DE EXTRANJERÍA</option>
                                <option value="DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO">DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO</option>
                                <option value="TARJETA DE IDENTIDAD">TARJETA DE IDENTIDAD</option>
                                <option value="CÉDULA DE CIUDADANIA">CÉDULA DE CIUDADANIA</option>
                                <option value="REGISTRO CIVIL">REGISTRO CIVIL</option>
                                <option value="PASAPORTE">PASAPORTE</option>
                            </select>
                            <label for="floatingInputGrid">TIPO DE IDENTIFICACIÓN:</label>
                            @error('tipoIden_contacto')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control"  name="cedula_contacto" id="cedula_contacto" value="{{old('cedula_contacto')}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">CEDULA:</label>
                            @error('cedula_contacto')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <select class="form-select" name="genero_contacto" id="genero_contacto" style="text-transform:uppercase;">
                                <option value="{{old('genero_contacto')}}">--SELECCIONE--</option>
                                <option value="femenino">FEMENINO</option>
                                <option value="masculino">MASCULINO</option>
                                <option value="otro">OTRO</option>
                            </select>
                            <label for="floatingInputGrid">GÉNERO:</label>
                            @error('genero_contacto')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="email" class="form-control" name="correo_contacto" id="correo_contacto" value="{{old('correo_contacto')}}" autofocus style="text-transform:uppercase;">
                            <label for="">CORREO:</label>
                            @error('correo_contacto')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="numeric" class="form-control"  name="telefono_contacto" id="telefono_contacto" value="{{old('telefono_trabajador')}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">TELÉFONO:</label>
                            @error('telefono_contacto')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                        <input type="text" class="form-control"  name="tipo_contacto" id="tipo_contacto" value="{{old('tipo_contacto')}}" autofocus style="text-transform:uppercase;">
                            <label for="">PERFIL LABORAL:</label>
                            @error('tipo_contacto')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <!---------BOTON------------->
                <div class="row">
                    <div class="col"></div>
                    <div class="col d-grid gap-2">
                        <input class="btn btn-primary" type="submit" id="boton-guardar" name="boton-guardar" value="GUARDAR">
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