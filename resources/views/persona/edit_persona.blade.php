@extends('layouts.plantillabase')
@section('contenido')

<div class="row">
    <div class="col"></div>
    <div class="col-8">
        <div class="card text-dark bg-light">
            @if($id ==  0)
                <h2 class="text-center mt-3">EDITAR PERSONA</h2>
            @elseif($id == 1)
                <h3 class="text-center mt-3">EDITAR TRABAJADOR DOSIMETRIA PARA LA EMPRESA <br> <i>{{$empresa->nombre_empresa}}</i></h3>
            @elseif($id == 2)
                <h3 class="text-center mt-3">EDITAR ESTUDIANTE DE A. VIRTUAL PARA LA EMPRESA <br> <i>{{$empresa->nombre_empresa}}</i></h3>
            @elseif($id== 3)
                <h3 class="text-center mt-3">EDITAR CONTACTO PARA LA EMPRESA <br> <i>{{$empresa->nombre_empresa}}</i></h3>
            @endif
            <br>

            <br>
            <br>
            <div class="row mx-3">
                <label for="" >LA SIGUIENTES SON LOS PERFILES LABORALES O ROLES QUE PERTENECEN A ESTA PERSONA:</label>
                <br>
                <br>
                <div class="col-md">
                    @if(count($personasperfil)== 0)
                        <b><label for="">NO HAY PERFILES RELACIONADOS </label></b>
                    @else
                        @forEach($personasperfil as $personperf)
                            <div class="row">
                                <div class="col-md"></div>
                                <div class="col-md-8">
                                    <div class="form-floating text-wrap">
                                        <input type="text" class="form-control"  name="id_perfil" id="id_perfil"  value="{{$personperf->perfiles->nombre_perfil}}" autofocus style="text-transform:uppercase;" disabled>
                                        <label for="floatingSelectGrid">PERFIL LABORAL:</label>
                                        @error('id_perfil')
                                            <small>*{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md d-flex align-items-center">
                                    <form class="form_eliminar_personaperfil" id="form_eliminar_personaperfil" name="form_eliminar_personaperfil" action="{{route('personaperfil.destroy', $personperf->id_personaperfil)}}" method="POST">
                                        @csrf  
                                        @method('delete')
                                        <button class="btn btn-danger"  type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md"></div>
                            </div>
                            <br>
                        @endforeach
                    @endif
                </div>
                <div class="col-md">
                    @if(count($personasrol)== 0)
                        <b><label for="">NO HAY ROLES RELACIONADOS </label></b>
                    @else
                        @forEach($personasrol as $personrol)
                            <div class="row">
                                <div class="col-md"></div>
                                <div class="col-md-8">
                                    <div class="form-floating text-wrap">
                                        <input type="text" class="form-control"  name="id_rol" id="id_rol"  value="{{$personrol->roles->nombre_rol}}" autofocus style="text-transform:uppercase;" disabled>
                                        <label for="floatingSelectGrid">ROL:</label>
                                        @error('id_rol')
                                            <small>*{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md d-flex align-items-center">
                                    <form class="form_eliminar_personarol" id="form_eliminar_personarol" name="form_eliminar_personarol" action="{{route('personarol.destroy', $personrol->id_personarol)}}" method="POST">
                                        @csrf  
                                        @method('delete')
                                        <button class="btn btn-danger"  type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md"></div>
                            </div>
                            <br>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="row mx-3">
                @if(count($personasede)== 0)
                    <b><label for="">NO HAY EMPRESAS Y SEDES RELACIONADAS</label></b>
                @else
                    <div class="col-md">
                        <label for="">LA SIGUIENTES SON LAS EMPRESAS Y SEDES RELACIONADAS:</label>
                        <br>
                        <br>
                        @foreach($personasede as $personsede)
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-floating text-wrap">
                                        <input type="text" class="form-control"  name="empresasedes" id="empresasedes"  value="{{$personsede->sede->empresa->nombre_empresa}} - {{$personsede->sede->nombre_sede}}" autofocus style="text-transform:uppercase;" disabled>
                                        <label for="floatingSelectGrid">EMPRESA - SEDE:</label>
                                        
                                    </div>
                                </div>
                                <div class="col-md d-flex align-items-center">
                                    
                                    <form class="form_eliminar_personasede" id="form_eliminar_personasede" name="form_eliminar_personasede" action="{{route('personasede.destroy', $personsede->id_personasede)}}" method="POST">
                                        @csrf  
                                        @method('delete')
                                        <button class="btn btn-danger"  type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                            </svg>
                                        </button>
                                    </form>
                                    
                                </div>
                            </div>
                            <br>
                        @endforeach
                    </div>
                    
                @endif
            </div>
            
            <form class="m-4" id='form_edit_persona' name='form_edit_persona' action="{{route('personas.update', $persona)}}" method="POST">
                @csrf
                @method('put') 

                <label for="">SELECCIONE SI DESEA AÑADIR OTRO PERFIL LABORAL O ROL PARA ESTA PERSONA:</label>
                <br>
                <br>
                <div class="row g-2">
                    <div class="col-md-5">
                        <label for="">PERFIL LABORAL:</label>
                        <div class="form-floating">
                            <select class="form-select" name="perfil_personas[]" id="perfil_personas" autofocus aria-label="Floating label select example"  multiple="true" >
                                @foreach($perfiles as $perf)
                                    <option value ="{{$perf->id_perfil}}">{{$perf->nombre_perfil}}</option>
                                @endforeach 
                               
                            </select>
                            
                        </div>
                    </div>
                    <div class="col-md d-flex align-items-center">
                        <button type="button" class="btn colorQA" data-bs-toggle="modal" data-bs-target="#nueva_perfilModal" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="col-md-6">
                        <label for="">ROL:</label>
                        <div class="form-floating">
                            <select class="form-select" name="rol_personas[]" id="rol_personas" autofocus aria-label="Floating label select example"  multiple="true">
                                @foreach($roles as $rol)
                                    <option value ="{{$rol->id_rol}}">{{$rol->nombre_rol}}</option>
                                @endforeach 
                                
                            </select>
                            
                        </div>
                    </div>
                    {{-- /////////TEMPORALMENTE DESHABILITADO POR INDECISION////////////// AHORA SOLO HAY 4 ROLES FIJOS////// --}}
                    {{-- <div class="col-md d-flex align-items-center">
                        <button type="button" class="btn colorQA" data-bs-toggle="modal" data-bs-target="#nueva_rolModal" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                            </svg>
                        </button>
                    </div> --}}
                    {{-- ///////////////////////////////////////////////////////////////////// --}}
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control @error('primer_nombre_persona') is-invalid @enderror"  name="primer_nombre_persona" id="primer_nombre_persona"  value="{{old('primer_nombre_persona', $persona->primer_nombre_persona)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">PRIMER NOMBRE:</label>
                            @error('primer_nombre_persona')
                                <span class="invalid-feedback">*{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control @error('segundo_nombre_persona') is-invalid @enderror"  name="segundo_nombre_persona" id="segundo_nombre_persona" value="{{old('segundo_nombre_persona', $persona->segundo_nombre_persona)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">SEGUNDO NOMBRE:</label>
                            @error('segundo_nombre_persona')
                                <span class="invalid-feedback">*{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control @error('primer_apellido_persona') is-invalid @enderror"  name="primer_apellido_persona" id="primer_apellido_persona" value="{{old('primer_apellido_persona',  $persona->primer_apellido_persona)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">PRIMER APELLIDO:</label>
                            @error('primer_apellido_persona')
                                <span class="invalid-feedback">*{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control @error('segundo_apellido_persona') is-invalid @enderror"  name="segundo_apellido_persona" id="segundo_apellido_persona" value="{{old('segundo_apellido_persona', $persona->segundo_apellido_persona)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">SEGUNDO APELLIDO:</label>
                            @error('segundo_apellido_persona')
                                <span class="invalid-feedback">*{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select @error('tipoIden_persona') is-invalid @enderror" name="tipoIden_persona" id="tipoIden_persona" autofocus style="text-transform:uppercase">
                                <option value="{{old('tipoIden_persona', $persona->tipo_iden_persona)}}">--{{$persona->tipo_iden_persona}}--</option>
                                <option value="CÉDULA DE CIUDADANIA">CÉDULA DE CIUDADANIA</option>
                                <option value="TARJETA DE IDENTIDAD">TARJETA DE IDENTIDAD</option>
                                <option value="REGISTRO CIVIL">REGISTRO CIVIL</option>
                                <option value="TARJETA DE EXTRANJERÍA">TARJETA DE EXTRANJERÍA</option>
                                <option value="DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO">DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO</option>
                                <option value="CÉDULA DE EXTRANJERÍA">CÉDULA DE EXTRANJERÍA</option>
                                <option value="PASAPORTE">PASAPORTE</option>
                            </select>
                            <label for="floatingInputGrid">TIPO DE IDENTIFICACIÓN:</label>
                            @error('tipoIden_persona')
                                <span class="invalid-feedback">*{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control @error('cedula_persona') is-invalid @enderror"  name="cedula_persona" id="cedula_persona" value="{{old('cedula_persona', $persona->cedula_persona)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">N° DE IDENTIFICACIÓN:</label>
                            @error('cedula_persona')
                                <span class="invalid-feedback">*{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <select class="form-select @error('genero_persona') is-invalid @enderror" name="genero_persona" id="genero_persona" style="text-transform:uppercase;">
                                <option value="{{old('genero_persona', $persona->genero_persona)}}">--{{$persona->genero_persona}}--</option>
                                <option value="femenino">FEMENINO</option>
                                <option value="masculino">MASCULINO</option>
                                <option value="otro">OTRO</option>
                            </select>
                            <label for="floatingInputGrid">GÉNERO:</label>
                            @error('genero_persona')
                                <span class="invalid-feedback">*{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="email" class="form-control @error('correo_persona') is-invalid @enderror" name="correo_persona" id="correo_persona" value="{{old('correo_persona', $persona->correo_persona)}}" autofocus style="text-transform:uppercase;">
                            <label for="">CORREO:</label>
                            @error('correo_persona')
                                <span class="invalid-feedback">*{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="numeric" class="form-control @error('telefono_persona') is-invalid @enderror"  name="telefono_persona" id="telefono_persona" value="{{old('telefono_persona', $persona->telefono_persona)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">TELÉFONO:</label>
                            @error('telefono_persona')
                                <span class="invalid-feedback">*{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md"></div>
                </div>
                <br>
                <div class="row g-2">
                    <label for="">SELECCIONE SI DESEA RELACIONAR ESTE CONTACTO A UNA EMPRESA Y SUS SEDES:</label>
                    <br>
                    <br>
                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <select  class="form-select" name="id_empresas" id="id_empresas">
                                    <option value="">--SELECCIONE--</option>
                                    @foreach($empresas as $emp)
                                        <option value ="{{ $emp->id_empresa }}">{{$emp->nombre_empresa}}</option>
                                    @endforeach
                                </select>
                                <label for="floatingSelectGrid">EMPRESA:</label>
                                
                            </div>
                        </div>
                        <div class="col-md" >
                            <label for="floatingSelectGrid">SEDE:</label>
                            <div class="spinner_sede text-center" id="spinner_sede">
    
                            </div>
                            <div class="form-floating" id="sede_empresa" name="sede_empresa">
                                <select class="form-select" id="id_sedes" name="id_sedes[]" autofocus aria-label="Floating label select example"  multiple="true">
                                    
                                </select>
                                
                            </div>
                        </div>
                        
                    </div>
                
                    <br>
                </div>
                {{-- @if(count($personasede)== 0) --}}
                    
                    
                
                <br>
                        
                
                <br>
                <label for="">A CONTINUACIÓN, MODIFIQUE SI ESTE CONTACTO ES EL LÍDER O ENCARGADO DE LOS SERVICIOS O SI NO HAY CAMBIOS NO SELECCIONE:</label>
                <div class="row g-2">
                    <div class="col-md"></div>
                    <div class="col-md text-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="TRUE" id="lider_contcal" name="lider_contcal" @if($persona->lider_controlescalidad == 'TRUE') checked @endif>
                            <label class="form-check-label" for="defaultCheck1">
                                CONTROLES DE CALIDAD
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input " type="checkbox" value="TRUE" id="lider_ava" name="lider_ava" @if($persona->lider_ava == 'TRUE') checked @endif>
                            <label class="form-check-label" for="defaultCheck1">
                                AULA VIRTUAL
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="TRUE" id="lider_dosimetria" name="lider_dosimetria" @if($persona->lider_dosimetria == 'TRUE') checked @endif>
                            <label class="form-check-label" for="defaultCheck1">
                                DOSIMETRÍA
                            </label>
                        </div>
                    </div>
                    <div class="col-md"></div>
                </div>
                <br>
                <!---------BOTON------------->
                <div class="row">
                    <div class="col"></div>
                    <div class="col d-grid gap-2">
                        <button class="btn colorQA" type="submit" id="boton-guardar" name="boton-guardar">ACTUALIZAR </button>
                    </div>
                    @if(!empty($empresa))
                        <div class="col d-grid gap-2">
                            <a href="{{route('empresas.info', $empresa->id_empresa)}}" class="btn btn-danger " type="button" id="cancelar" name="cancelar" role="button">CANCELAR</a>
                        </div>
                    @else
                        <div class="col d-grid gap-2">
                            <a href="{{route('personas.search')}}" class="btn btn-danger " type="button" id="cancelar" name="cancelar" role="button">CANCELAR</a>
                        </div>
                    @endif
                    <div class="col"></div>
                </div>
            </form>
            
        </div>
        <br>
    </div>
    <div class="col"></div>
</div>

<div class="modal fade" id="nueva_perfilModal" tabindex="-1" aria-labelledby="nueva_perfilModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="nueva_perfilModalLabel">NUEVO PERFIL LABORAL</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @livewire('form-personas-perfiles')
        </div> 
    </div>
</div>
{{-- //////////////// MODAL DESHABILITADO YA LOS ROLES SON FIJOS ////////////////////////// --}}
{{-- <div class="modal fade" id="nueva_rolModal" tabindex="-1" aria-labelledby="nueva_rolModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="nueva_rolModalLabel">NUEVO ROL</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @livewire('form-personas-roles')    
        </div> 
    </div>
</div> --}}
<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous">
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('eliminar')== 'ok')
    <script>
        Swal.fire(
        'PERFIL ELIMINADO!',
        'SE HA ELIMINADO CON ÉXITO.',
        'success'
        )
    </script>
@endif
@if(session('eliminar_personasede')== 'ok')
    <script>
        Swal.fire(
        'SEDE ELIMINADA!',
        'SE HA ELIMINADO CON ÉXITO.',
        'success'
        )
    </script>
@endif

@if(session('eliminado')== 'ok')
    <script>
        Swal.fire(
        'ROL ELIMINADO!',
        'SE HA ELIMINADO CON ÉXITO.',
        'success'
        )
    </script>
@endif
@if(session('guardar')== 'ok')
    <script>
        Swal.fire(
        'GUARDADO!',
        'SE HA GUARDADO CON ÉXITO.',
        'success'
        )
    </script>
@endif
@if(session('actualizar')== 'ok')
    <script>
        Swal.fire(
        'ACTUALIZADO!',
        'SE HA ACTUALIZADO ESTA PERSONA.',
        'success'
        )
    </script>
@endif
<script type="text/javascript">
    $(document).ready(() => {

        $('#rol_personas').select2({
            placeholder:"SELECCIONE LOS ROLES",
            tags: true,
            tokenSeparators: ['/',',',',',','," "]
        });
        
        $('#perfil_personas').select2({
            placeholder:"SELECCIONE LOS PERFILES LABORALES",
            tags: true,
            tokenSeparators: ['/',',',',',','," "]
        });
        $('#id_sedes').select2({
            placeholder:"SELECCIONE LAS SEDES",
            tags: true,
            tokenSeparators: ['/',',',',',','," "]
        });
    });


    $(document).ready(function(){
        $('#id_empresas').on('change', function(){
            $('#sede_empresa').fadeOut();
            $('#spinner_sede').html('<div class="spinner-border text-secondary" id="spinner" role="status"></div>');
            var empresa_id = $(this).val();
            var padre = document.getElementById("spinner_sede");
            var hijo = document.getElementById("spinner");
            if($.trim(empresa_id) != ''){
                $.get('selectsed',{empresa_id : empresa_id}, function(sedes){
                    console.log(sedes);
                    var remove = padre.removeChild(hijo);
                    $('#sede_empresa').fadeIn();
                    $('#id_sedes').empty();
                    $('#id_sedes').append("<option value=''>--SELECCIONE UNA SEDE--</option>");
                    $.each(sedes, function(index, value){
                        $('#id_sedes').append("<option value='"+ index + "'>" + value + "</option>");
                    })
                });
            }

        });
        $('.form_eliminar_personaperfil').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "SEGURO QUE DESEA ELIMINAR ESTE PERFIL??",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI!'
                }).then((result) => {
                if (result.isConfirmed) {
                   
                    this.submit();
                }
            })
        })
        $('.form_eliminar_personarol').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "SEGURO QUE DESEA ELIMINAR ESTE ROL??",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI!'
                }).then((result) => {
                if (result.isConfirmed) {
                   
                    this.submit();
                }
            })
        })
        $('.form_eliminar_personasede').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "SEGURO QUE DESEA ELIMINAR ESTE SEDE RELACIONADA??",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI!'
                }).then((result) => {
                if (result.isConfirmed) {
                   
                    this.submit();
                }
            })
        })
        $('#form_crear_perfil').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "DESEA GUARDAR ESTE PERFIL LABORAL??",
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
        $('#form_crear_rol').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "DESEA GUARDAR ESTE ROL??",
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
        $('#form_edit_persona').submit(function(e){
        e.preventDefault();
        Swal.fire({
            text: 'SEGURO QUE DESEA ACTUALIZAR LA INFORMACION DE ESTA PERSONA',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI!'
        }).then((result) => {
            if (result.isConfirmed) {
                
                this.submit(); 
            }
        })
    })
    });
</script>
@endsection()