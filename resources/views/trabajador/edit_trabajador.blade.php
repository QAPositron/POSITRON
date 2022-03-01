@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col"></div>
    <div class="col-6">
        <div class="card text-dark bg-light">
            <h2 class="text-center mt-3">EDITAR TRABAJADOR</h2>
            
            <form class="m-4" id='form_edit_trabajador' name='form_edit_trabajador' action="{{route('trabajadores.update', $trabajador)}}" method="POST">

            @csrf
            
            @method('put')

                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select" name="id_empresas" id="id_empresas">
                                <option value="{{old('id_empresas', $trabajador->sede->empresa->id_empresa)}}">{{$trabajador->sede->empresa->nombre_empresa}}</option>
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
                        <option value="{{old('id_sedes', $trabajador->sede->nombre_sede)}}">{{$trabajador->sede->nombre_sede}}</option>
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
                            <input type="text" class="form-control"  name="primer_nombre_trabajador" id="primer_nombre_trabajador"  value="{{old('primer_nombre_trabajador', $trabajador->trabajador->primer_nombre_trabajador)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">PRIMER NOMBRE:</label>
                            @error('primer_nombre_trabajador')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control"  name="segundo_nombre_trabajador" id="segundo_nombre_trabajador" value="{{old('segundo_nombre_trabajador', $trabajador->trabajador->segundo_nombre_trabajador)}}" autofocus style="text-transform:uppercase;">
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
                            <input type="text" class="form-control"  name="primer_apellido_trabajador" id="primer_apellido_trabajador" value="{{old('primer_apellido_trabajador',  $trabajador->trabajador->primer_apellido_trabajador)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">PRIMER APELLIDO:</label>
                            @error('primer_apellido_trabajador')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control"  name="segundo_apellido_trabajador" id="segundo_apellido_trabajador" value="{{old('segundo_apellido_trabajador', $trabajador->trabajador->segundo_apellido_trabajador)}}" autofocus style="text-transform:uppercase;">
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
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control"  name="cedula_trabajador" id="cedula_trabajador" value="{{old('cedula_trabajador', $trabajador->trabajador->cedula_trabajador)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">CEDULA:</label>
                            @error('cedula_trabajador')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <select class="form-select" name="genero_trabajador" id="genero_trabajador" style="text-transform:uppercase;">
                                <option value="{{old('genero_trabajador', $trabajador->trabajador->genero_trabajador)}}">{{$trabajador->trabajador->genero_trabajador}}</option>
                                <option value="F">FEMENINO</option>
                                <option value="M">MASCULINO</option>
                                <option value="O">OTRO</option>
                            </select>
                            <label for="floatingInputGrid">GÉNERO:</label>
                            @error('genero_trabajador')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="email" class="form-control" name="correo_trabajador" id="correo_trabajador" value="{{old('correo_trabajador', $trabajador->trabajador->email_trabajador)}}" autofocus style="text-transform:uppercase;">
                            <label for="">CORREO:</label>
                            @error('correo_trabajador')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="numeric" class="form-control"  name="telefono_trabajador" id="telefono_trabajador" value="{{old('telefono_trabajador', $trabajador->trabajador->telefono_trabajador)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">TELÉFONO:</label>
                            @error('telefono_trabajador')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <select class="form-select" name="tipo_trabajador" id="tipo_trabajador" style="text-transform:uppercase;" autofocus aria-label="Floating label select example">
                                <option value="{{old('tipo_trabajador', $trabajador->trabajador->tipo_trabajador)}}">{{$trabajador->trabajador->tipo_trabajador}}</option>
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
               {{--  <br>
                <h6 class="text-center">ACTIVAR AL TRABAJADOR EN EL MODULO DE:</h6>
                <div class="row g-2">
                    <div class="col-md"></div>
                    <div class="col-3">
                        <div class='custom-control custom-checkbox'>
                            @php
                                if($trabajador->aula_virtual == "true"){
                                    echo "<input type='checkbox' class='custom-control-input' id='ckeckAulaVirtual' name='ckeckAulaVirtual' checked>";
                                }
                            @endphp
                            <label class='custom-control-label' for='ckeckAulaVirtual'>AULA VIRUTAL</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            @if($trabajador->dosimetria == 'ON')
                                echo "<input type="checkbox" class="custom-control-input" id="checkDosimetria" name="checkDosimetria" checked>":
                            @endif
                            <label class="custom-control-label" for="checkDosimetria">DOSIMETRÍA</label>
                            @error('checkDosimetria')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md"></div>
                </div> --}}
                <br>
                <!---------BOTON------------->
                <div class="row">
                    <div class="col"></div>
                    <div class="col d-grid gap-2">
                        <button class="btn colorQA" type="submit" id="boton-guardar" name="boton-guardar">ACTUALIZAR </button>
                    </div>
                    <div class="col d-grid gap-2">
                    <a href="{{route('empresas.search')}}" class="btn btn-danger" type="button" id="cancelar" name="cancelar" role="button">CANCELAR</a>
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>   
       
<script type="text/javascript">
$(document).ready(function(){
    $('#form_edit_trabajador').submit(function(e){
        e.preventDefault();
        Swal.fire({
            text: 'SEGURO QUE DESEA ACTUALIZAR LA INFORMACIÓN DE ESTE TRABAJADOR?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'ACTUALIZADO!',
                'SE HA ACTUALIZADO EL TRABAJADOR.',
                'success'
                )
                this.submit(); 
            }
        })
    })
})
</script> 
@endsection()