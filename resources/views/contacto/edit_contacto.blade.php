@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col"></div>
    <div class="col-6">
        <div class="card text-dark bg-light">
            <h2 class="text-center mt-3">EDITAR CONTACTO</h2>
            
            <form class="m-4" id='form_edit_contacto' name='form_edit_contacto' action="{{route('contactos.update', $contacto)}}" method="POST">

            @csrf
            
            @method('put')

                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control"  name="id_empresas" id="id_empresas"  value="{{old('id_empresas', $contacto->sede->empresa->nombre_empresa)}}" autofocus style="text-transform:uppercase;" disabled>
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
                            <option value="{{old('id_sedes', $contacto->sede->nombre_sede)}}">{{$contacto->sede->nombre_sede}}</option>
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
                            <input type="text" class="form-control"  name="primer_nombre_contacto" id="primer_nombre_contacto"  value="{{old('primer_nombre_contacto', $contacto->contacto->primer_nombre_contacto)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">PRIMER NOMBRE:</label>
                            @error('primer_nombre_contacto')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control"  name="segundo_nombre_contacto" id="segundo_nombre_contacto" value="{{old('segundo_nombre_contacto', $contacto->contacto->segundo_nombre_contacto)}}" autofocus style="text-transform:uppercase;">
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
                            <input type="text" class="form-control"  name="primer_apellido_contacto" id="primer_apellido_contacto" value="{{old('primer_apellido_contacto',  $contacto->contacto->primer_apellido_contacto)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">PRIMER APELLIDO:</label>
                            @error('primer_apellido_contacto')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control"  name="segundo_apellido_contacto" id="segundo_apellido_contacto" value="{{old('segundo_apellido_contacto', $contacto->contacto->segundo_apellido_contacto)}}" autofocus style="text-transform:uppercase;">
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
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control"  name="cedula_contacto" id="cedula_contacto" value="{{old('cedula_contacto', $contacto->contacto->cedula_contacto)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">CEDULA:</label>
                            @error('cedula_contacto')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <select class="form-select" name="genero_contacto" id="genero_contacto" style="text-transform:uppercase;">
                                <option value="{{old('genero_contacto', $contacto->contacto->genero_contacto)}}">{{$contacto->contacto->genero_contacto}}</option>
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
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="email" class="form-control" name="correo_contacto" id="correo_contacto" value="{{old('correo_contacto', $contacto->contacto->correo_contacto)}}" autofocus style="text-transform:uppercase;">
                            <label for="">CORREO:</label>
                            @error('correo_contacto')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="numeric" class="form-control"  name="telefono_contacto" id="telefono_contacto" value="{{old('telefono_contacto', $contacto->contacto->telefono_contacto)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">TELÉFONO:</label>
                            @error('telefono_contacto')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                        <input type="text" class="form-control"  name="tipo_contacto" id="tipo_contacto" value="{{old('tipo_contacto', $contacto->contacto->profesion_contacto)}}" autofocus style="text-transform:uppercase;">
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
                        <button class="btn colorQA" type="submit" id="boton-guardar" name="boton-guardar">ACTUALIZAR </button>
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
<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous">
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>   
       
<script type="text/javascript">
$(document).ready(function(){
    $('#form_edit_contacto').submit(function(e){
        e.preventDefault();
        Swal.fire({
            text: 'SEGURO QUE DESEA ACTUALIZAR LA INFORMACION DE ESTE CONTACTO',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'ACTUALIZADO!',
                'SE HA ACTUALIZADO EL CONTACTO.',
                'success'
                )
                this.submit(); 
            }
        })
    })
})
</script>
@endsection()