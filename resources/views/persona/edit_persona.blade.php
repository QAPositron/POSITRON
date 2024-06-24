@extends('layouts.app')
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
                                <div class="col-md "></div>
                                <div class="col-md-9">
                                    <div class="form-floating text-wrap">
                                        <input type="text" class="form-control"  name="id_perfil" id="id_perfil"  value="{{$personperf->perfiles->nombre_perfil}}" autofocus style="text-transform:uppercase;" disabled>
                                        <label for="floatingInputDisabled">PERFIL LABORAL:</label>
                                    </div>
                                </div>
                                @can('superadmin.home')     
                                    <div class="col-md d-flex">
                                        <form class="form_eliminar_personaperfil" id="form_eliminar_personaperfil" name="form_eliminar_personaperfil" action="{{route('personaperfil.destroy', $personperf->id_personaperfil)}}" method="POST">
                                            @csrf  
                                            @method('delete')
                                            <button class="btn btn-danger btn-lg mt-2"  type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @endcan
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
                        @foreach($personasrol as $personrol)
                            @if ($personrol->role_id != 3)
                                <div class="row">
                                    <div class="col-md"></div>
                                    <div class="col-md-9">
                                        <div class="form-floating">
                                            <input type="text" class="form-control"  name="id_rol" id="id_rol"  value="{{$personrol->roles->name}}" autofocus style="text-transform:uppercase;" disabled>
                                            <label for="floatingSelectGrid">ROL:</label>
                                        </div>
                                    </div>
                                    @can('personarol.destroy')
                                        <div class="col-md d-flex">
                                            <form class="form_eliminar_personarol" id="form_eliminar_personarol" name="form_eliminar_personarol" action="{{route('personarol.destroy', ["personarol"=> $personrol->id_personarol, "sede"=>0])}}" method="POST">
                                                @csrf  
                                                @method('delete')
                                                <button class="btn btn-danger btn-lg mt-2"  type="submit" data-bs-toggle="popover" data-bs-content="SE ELIMINARÁ EL USUARIO PARA INGRESAR A LA PALTAFORMA DE DOSÍMETRIA">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    @endcan
                                    <div class="col-md"></div>
                                </div>
                                <br>
                            @else
                                @foreach ($personasede as $personsed)

                                    @if($personsed->lider_dosimetria != NULL)
                                        <div class="row">
                                            <div class="col-md"></div>
                                            <div class="col-md-9">
                                                <div class="form-floating ">
                                                    <input type="text" class="form-control"  name="id_rol" id="id_rol"  value="L. DOSIMETRÍA -({{$personsed->sede->nombre_sede}}){{$personsed->sede->empresa->nombre_empresa}}"  autofocus style="text-transform:uppercase;" disabled>
                                                    <label for="floatingSelectGrid">ROL:</label>
                                                </div>
                                            </div>
                                            <div class="col-md d-flex">
                                                <form class="form_eliminar_personarol" id="form_eliminar_personarol" name="form_eliminar_personarol" action="{{route('personarol.destroy', ["personarol"=> $personrol->id_personarol, "sede"=>$personsed->sede_id])}}" method="POST">
                                                    @csrf  
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-lg mt-2"  type="submit" data-bs-toggle="popover" data-bs-content="SE ELIMINARÁ EL USUARIO PARA INGRESAR A LA PALTAFORMA DE DOSÍMETRIA">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-md"></div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                            
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
                                @can('personasede.destroy')    
                                    <div class="col-md d-flex ">
                                        <form class="form_eliminar_personasede" id="form_eliminar_personasede" name="form_eliminar_personasede" action="{{route('personasede.destroy', $personsede->id_personasede)}}" method="POST">
                                            @csrf  
                                            @method('delete')
                                            <button class="btn btn-danger btn-lg mt-2"  type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @endcan
                            </div>
                            <br>
                        @endforeach
                    </div>
                @endif
            </div>
            <form class="m-4" id='form_edit_persona' name='form_edit_persona' action="{{route('personas.update', $persona)}}" method="POST">
                @csrf
                @method('put') 
                <label for="">SELECCIONE SI DESEA AÑADIR OTRO PERFIL LABORAL:</label>
                <br>
                <br>
                <div class="row g-2">
                    <label class="text-secondary">' * ' campo obligatorio</label>
                    <input type="text" class="form-control" name="id" id="id" value="{{$id}}" hidden>
                    <div class="col-md"></div>
                    <div class="col-md">
                        <label for="">PERFIL LABORAL:</label>
                        <div class="form-floating">
                            <select class="form-select  @error('perfil_personas') is-invalid @enderror" name="perfil_personas[]" id="perfil_personas" autofocus aria-label="Floating label select example"  multiple="true" >
                                @foreach($perfiles as $perf)
                                    <option value ="{{$perf->id_perfil}}" {{ in_array($perf->id_perfil, (array) old('perfil_personas', [])) ? "selected" : "" }}>{{$perf->nombre_perfil}}</option>
                                @endforeach 
                            </select>
                            @error('perfil_personas') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn colorQA btn-sm mt-3" data-bs-toggle="modal" data-bs-target="#nueva_perfilModal" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="col-md"></div>
                    {{-- /////////////// AHORA LOS ROLES SON FIJOS Y SON CREADOS Y RELACIONADOS CON SPATIE DE LARAVEL(LIDER DE DOSIMETRIA, ADMIN Y SUPERADMIN) LOS DEMAS ROLES SE RELACIONAN NORMAL CON PERSONAS-ROLES//////////////////// --}}
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control @error('primer_nombre_persona') is-invalid @enderror"  name="primer_nombre_persona" id="primer_nombre_persona"  value="{{old('primer_nombre_persona', $persona->primer_nombre_persona)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">* PRIMER NOMBRE:</label>
                            @error('primer_nombre_persona') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control @error('segundo_nombre_persona') is-invalid @enderror"  name="segundo_nombre_persona" id="segundo_nombre_persona" value="{{old('segundo_nombre_persona', $persona->segundo_nombre_persona)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">SEGUNDO NOMBRE:</label>
                            @error('segundo_nombre_persona') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control @error('primer_apellido_persona') is-invalid @enderror"  name="primer_apellido_persona" id="primer_apellido_persona" value="{{old('primer_apellido_persona',  $persona->primer_apellido_persona)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">* PRIMER APELLIDO:</label>
                            @error('primer_apellido_persona') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control @error('segundo_apellido_persona') is-invalid @enderror"  name="segundo_apellido_persona" id="segundo_apellido_persona" value="{{old('segundo_apellido_persona', $persona->segundo_apellido_persona)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">SEGUNDO APELLIDO:</label>
                            @error('segundo_apellido_persona') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select @error('tipoIden_persona') is-invalid @enderror" name="tipoIden_persona" id="tipoIden_persona" autofocus style="text-transform:uppercase">
                                <option value="{{old('tipoIden_persona', $persona->tipo_iden_persona)}}">--{{$persona->tipo_iden_persona}}--</option>
                                <option value="CÉDULA DE CIUDADANIA" @if (old('tipoIden_persona') == "CÉDULA DE CIUDADANIA") {{ 'selected' }} @endif>CÉDULA DE CIUDADANIA</option>
                                <option value="TARJETA DE IDENTIDAD" @if (old('tipoIden_persona') == "TARJETA DE IDENTIDAD") {{ 'selected' }} @endif>TARJETA DE IDENTIDAD</option>
                                <option value="REGISTRO CIVIL" @if (old('tipoIden_persona') == "REGISTRO CIVIL") {{ 'selected' }} @endif>REGISTRO CIVIL</option>
                                <option value="TARJETA DE EXTRANJERÍA" @if (old('tipoIden_persona') == "TARJETA DE EXTRANJERÍA") {{ 'selected' }} @endif>TARJETA DE EXTRANJERÍA</option>
                                <option value="DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO" @if (old('tipoIden_persona') == "DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO") {{ 'selected' }} @endif>DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO</option>
                                <option value="CÉDULA DE EXTRANJERÍA" @if (old('tipoIden_persona') == "CÉDULA DE EXTRANJERÍA") {{ 'selected' }} @endif>CÉDULA DE EXTRANJERÍA</option>
                                <option value="PASAPORTE"  @if (old('tipoIden_persona') == "PASAPORTE") {{ 'selected' }} @endif>PASAPORTE</option>
                            </select>
                            <label for="floatingInputGrid">TIPO DE IDENTIFICACIÓN:</label>
                            @error('tipoIden_persona') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control @error('cedula_persona') is-invalid @enderror"  name="cedula_persona" id="cedula_persona" value="{{old('cedula_persona', $persona->cedula_persona)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">* N° DE IDENTIFICACIÓN:</label>
                            @error('cedula_persona') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <select class="form-select @error('genero_persona') is-invalid @enderror" name="genero_persona" id="genero_persona" style="text-transform:uppercase;">
                                <option value="{{old('genero_persona', $persona->genero_persona)}}">--{{$persona->genero_persona}}--</option>
                                <option value="femenino" @if (old('genero_persona') == "femenino") {{ 'selected' }} @endif>FEMENINO</option>
                                <option value="masculino" @if (old('genero_persona') == "masculino") {{ 'selected' }} @endif>MASCULINO</option>
                                <option value="otro" @if (old('genero_persona') == "otro") {{ 'selected' }} @endif>OTRO</option>
                            </select>
                            <label for="floatingInputGrid">* GÉNERO:</label>
                            @error('genero_persona') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="email" class="form-control @error('correo_persona') is-invalid @enderror" name="correo_persona" id="correo_persona" value="{{old('correo_persona', $persona->correo_persona)}}" autofocus style="text-transform:uppercase;">
                            <label for="">CORREO:</label>
                            @error('correo_persona') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="numeric" class="form-control @error('telefono_persona') is-invalid @enderror"  name="telefono_persona" id="telefono_persona" value="{{old('telefono_persona', $persona->telefono_persona)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">TELÉFONO:</label>
                            @error('telefono_persona') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating" >
                            <select class="form-select @error('estado_persona') is-invalid @enderror" name="estado_persona" id="estado_persona_select"  autofocus>
                                <option value="{{old('estado_persona',$persona->estado_persona)}}">--{{$persona->estado_persona}}--</option>
                                <option value="ACTIVO" @if (old('estado_persona') == "ACTIVO") {{ 'selected' }} @endif>ACTIVO</option>
                                <option value="INACTIVO" @if (old('estado_persona') == "INACTIVO") {{ 'selected' }} @endif>INACTIVO</option>
                            </select>
                            <label for="floatingInputGrid">ESTADO:</label>
                            @error('estado_persona')<span class="invalid-feedback">*{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <br>
                <label for="">SELECCIONE LOS ROLES QUE ASUMIRÁ ESTA PERSONA:</label>
                <div class="row g-2">
                    <div class="col-md"></div>
                    <div class="col-md">
                        <br>
                        {{-- @php $checkrol = 0; @endphp
                        @php $checkpersonrol = 0; @endphp --}}

                        @foreach($roles as $rol)
                            <div class="form-check">
                                @if ($personasrol->contains('role_id', $rol->id))
                                    <input class="form-check-input" type="checkbox" value="{{$rol->id}}" id="{{$rol->name}}" name="roles[]" @if(is_array(old('roles')) && in_array($rol->id, old('roles'))) checked @endif checked>
                                    <label class="form-check-label" for="defaultCheck1">
                                        {{$rol->name}}
                                    </label>
                                @else
                                    <input class="form-check-input" type="checkbox" value="{{$rol->id}}" id="{{$rol->name}}" name="roles[]" @if(is_array(old('roles')) && in_array($rol->id, old('roles'))) checked @endif>
                                    <label class="form-check-label" for="defaultCheck1">
                                        {{$rol->name}}
                                    </label>
                                @endif
                            </div> 
                        @endforeach
                    </div>
                    <div class="col-md"></div>
                </div>
                <br> 
                <label for="">A CONTINUACIÓN, SELECCIONE UNA EMPRESA Y SUS SEDES PARA RELACIONAR A ESTA PERSONA:</label>
                <br>
                <br>
                @if($id == 0)
                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <select  class="form-select @error('id_empresa') is-invalid @enderror" name="id_empresas" id="id_empresas">
                                    <option value="">--SELECCIONE--</option>
                                    @foreach($empresas as $emp)
                                        <option value ="{{ $emp->id_empresa }}" @if (old('id_empresas') == $emp->id_empresa) {{ 'selected' }} @endif>{{$emp->nombre_empresa}}</option>
                                    @endforeach 
                                </select>
                                <label for="floatingSelectGrid">EMPRESA:</label>
                                @error('id_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-1 d-flex align-items-center">
                            <button type="button" class="btn colorQA"  id="agregar" name="agregar">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                                </svg>
                            </button>
                        </div>
                        <div class="col-md">
                            <label for="floatingSelectGrid">SEDE:</label>
                            <div class="spinner_sede text-center" id="spinner_sede">
    
                            </div>
                            <div class="form-floating" id="sede_empresa" name="sede_empresa">
                                <select class="form-select" id="id_sedes" name="id_sedes[]" autofocus aria-label="Floating label select example"  multiple="true">
                                    
                                </select>
                                @error('sede_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <div id="otraEmpresa">
    
                    </div>
                @else
                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="empresa_persona" id="empresa_persona" value="{{$empresa->nombre_empresa}}" readonly>
                                <input type="number" class="form-control @error('id_empresa') is-invalid @enderror" name="id_empresa" id="id_empresa" value="{{$empresa->id_empresa}}"  hidden>
                                <label for="floatingSelectGrid">* EMPRESA:</label>
                                @error('id_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md">
                            <label for="floatingSelectGrid">* SEDE:</label>
                            <div class="form-floating" id="sede_empresa" name="sede_empresa">
                                <select class="form-select @error('id_sedes') is-invalid @enderror" id="id_sedes" name="id_sedes[]" autofocus aria-label="Floating label select example"  multiple="true" {{-- onchange="changeSede();" --}}>
                                    <option value="">--SELECCIONE--</option>
                                    @foreach($sedes as $sede)

                                        <option value ="{{ $sede->id_sede }}" {{ in_array($sede->id_sede, (array) old('id_sedes', [])) ? "selected" : "" }}>{{$sede->nombre_sede}}</option>
                                    @endforeach 
                                </select>
                                @error('id_sedes') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                            </div>
                        </div> 
                    </div>
                @endif
                <br>
                <div id="liderdosimsedesExist" hidden>
                    <label for=""><b>SELECCIONE PARA QUE SEDES YA RELACIONADAS ESTA PERSONA SERÁ LIDER DE DOSIMETRÍA:</b></label>
                    <br>
                    <br>
                </div>
                <div id="liderdosimsedes" hidden>
                    <label for=""><b>SELECCIONE PARA QUE SEDES ESTA PERSONA SERÁ LIDER DE DOSIMETRÍA:</b></label>
                    <br>
                    <br>
                </div>

                <br>
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
    $(function () {
        $('[data-toggle="popover"]').popover()
    })
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
                $.get('selectsedes',{empresa_id : empresa_id}, function(sedes){
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
        var i = 1;
        $("#agregar").click(function(){

            $("#otraEmpresa").append(
                '<div class="row g-2" id="row'+i+'">'
                    +'<div class="col-md">'
                        +'<div class="form-floating">'
                            +'<select class="form-select" name="id_empresas_add[]" id="id_empresas'+i+'">'
                                +'<option value="">--SELECCIONE--</option>'
                                +'@foreach($empresas as $emp)'
                                    +'<option value ="{{ $emp->id_empresa }}">{{$emp->nombre_empresa}}</option>'
                                +'@endforeach'
                            +'</select>'
                            +'<label for="floatingSelectGrid">EMPRESA:</label>'
                            
                        +'</div>'
                    +'</div>'
                    +'<div class="col-md-1 d-flex align-items-center">'    
                        +'<button id="remove'+i+'" class="btn btn-danger"  type="button">'
                            +'<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">'
                                +'<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>'
                            +'</svg>'
                        +'</button>'
                    +'</div>'
                    +'<div class="col-md">'
                        +'<label for="floatingSelectGrid">SEDE:</label>'
                        +'<div class="spinner_sede text-center" id="spinner_sede'+i+'"></div>'
                        +'<div class="form-floating" id="sede_empresa'+i+'" name="sede_empresa">'
                            +'<select class="form-select" id="id_sedes'+i+'" name="id_sedes_add[]" autofocus aria-label="Floating label select example"  multiple="true">'
                                
                            +'</select>'
                        +'</div>'
                    +'</div>'
                    
                +'</div>'
                +'<br>'
            );
            
            $('#id_empresas'+i).on('change', function(){
                
                $('#sede_empresa'+(i-1)).fadeOut();
                $('#spinner_sede'+(i-1)).html('<div class="spinner-border text-secondary" id="spinner'+(i-1)+'" role="status"></div>');
                var empresa_id = $(this).val();
                var padre = document.getElementById("spinner_sede"+(i-1));
                var hijo = document.getElementById("spinner"+(i-1));
                if($.trim(empresa_id) != ''){
                    $.get('selectsedes',{empresa_id : empresa_id}, function(sedes){
                        console.log(sedes);
                        var remove = padre.removeChild(hijo);
                        $('#sede_empresa'+(i-1)).fadeIn();
                        $('#id_sedes'+(i-1)).empty();
                        $('#id_sedes'+(i-1)).append("<option value=''>--SELECCIONE UNA SEDE--</option>");
                        $.each(sedes, function(index, value){
                            $('#id_sedes'+(i-1)).append("<option value='"+ index + "'>" + value + "</option>");
                        })
                    });
                }
                
            });
            $('#remove'+i).click(function(){
                $('#row'+(i-1)).remove();
                
            })
            $('#id_sedes'+i).select2({
                placeholder:"SELECCIONE LAS SEDES",
                tags: true,
                tokenSeparators: ['/',',',',',','," "]
            });
            if('{{$id}}' == 0){
                /////// se verifica si ya existe lider de dosimetria en las sedes seleccionadas para que sea unico por sede//////
                let $sedesadd = $('#id_sedes'+i);
                console.log($sedesadd);
                let selectedsadd = [];
                $('#id_sedes'+i).change(function(){
                    console.log("HUBO CAMBIO");
                    $sedesadd.children(':selected').each((idx, el) => {
                        selectedsadd.push(el.value);
                    });
                    console.log(selectedsadd);
                    var liderdosim = document.getElementById("LIDER DE DOSIMETRIA").checked;
                    console.log("EXISTE LIDERDOSIMSELECT=");
                    console.log(liderdosim);
                    selectedsadd.forEach(element => {
                        $.get('personsedes',{sede_id : element}, function(personsedes){
                            console.log(personsedes);
                            personsedes.forEach(element => {
                                if(element.lider_dosimetria == 'TRUE' && liderdosim == true){
                                    console.log("TIENE LIDER DOSIMETRIA la sede="+element.sede_id);
                                    return Swal.fire({
                                        title:"LA SEDE '"+element.nombre_sede+"' YA TIENE UN LIDER DE DOSIMETRIA",
                                        text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                        icon: 'error'
                                    });
                                }
                            })
                        })
                    })
                });
            }
            
            
            i++;
        });
        /////// se verifica si ya existe lider de dosimetria en las sedes seleccionadas para que sea unico por sede//////
        let $sedes = $('#id_sedes');
        let selecteds = [];
        // Buscamos los option seleccionados
        $('#id_sedes').change(function(){
            console.log("HUBO CAMBIO");
            $sedes.children(':selected').each((idx, el) => {
                selecteds.push(el.value);
            });
            console.log(selecteds);
            var liderdosim = document.getElementById("LIDER DE DOSIMETRIA").checked;
            selecteds.forEach(element => {
                $.get('personsedes',{sede_id : element}, function(personsedes){
                    console.log(personsedes);
                    personsedes.forEach(element => {
                        if(element.lider_dosimetria == 'TRUE' && liderdosim == true){
                            console.log("TIENE LIDER DOSIMETRIA la sede="+element.sede_id);
                            return Swal.fire({
                                title:"LA SEDE '"+element.nombre_sede+"' YA TIENE UN LIDER DE DOSIMETRIA",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                        }
                    })
                })
            })
        });

        var liderdosim = document.getElementById("LIDER DE DOSIMETRIA");
        liderdosim.addEventListener('change', function(){
            var checked= liderdosim.checked;
            var personasede = JSON.parse('{!!$personasede!!}');
            console.log(personasede);
            if(checked == true && personasede != undefined){
                console.log("entro al if");
               document.getElementById('liderdosimsedesExist').removeAttribute("hidden");
                
                $.each(personasede, function(index, value){
                    console.log("PERSONSEDE");
                    console.log(value.sede_id);
                    $('#liderdosimsedesExist').append(
                        '<div class="row">'
                            +'<div class="col-md"></div>'
                            +'<div class="col-md">'
                                +'<div class="form-check">'
                                    +'<input class="form-check-input" type="checkbox" value="'+value.sede_id+'" name="liderdosimsedesExist[]" id="liderdosimsedesExist'+value.sede_id+'">'
                                    +'<label class="form-check-label" for="defaultCheck1">'
                                        +value.sede.empresa.nombre_empresa+' - SEDE: '+value.sede.nombre_sede
                                    +'</label>'
                                +'</div>'
                            +'</div>'
                            +'<div class="col-md"></div>'
                        +'</div>'
                    );
                })
            }
        })
       
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
            var superAdmin = document.getElementById("SUPER-ADMINISTRADOR").checked;
            var admin = document.getElementById("ADMINISTRADOR").checked;
            var liderdosim = document.getElementById("LIDER DE DOSIMETRIA").checked;
            var toe = document.getElementById("TOE").checked;
            var opr = document.getElementById("OPR").checked;
            var estudiante = document.getElementById("ESTUDIANTE").checked;
            var contacto = document.getElementById("CONTACTO").checked;
            var publico = document.getElementById("PUBLICO").checked;

            if(superAdmin == false && admin == false && liderdosim == false && toe == false && opr == false && estudiante == false && contacto == false && publico == false){
                console.log("entro al if");
                return Swal.fire({
                                title:"FALTA SELECCIONAR AL MENOS UN ROL PARA LA PERSONA",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
            }
            var liderdosimsed = document.querySelectorAll('input[name="liderdosimsedes[]"]');
            console.log(liderdosimsed);
            var arrayidsedes = $('#id_sedes option:selected').toArray();
            console.log(arrayidsedes);
            console.log("cantidad"+arrayidsedes.length);
            var idsedesadd =  document.querySelectorAll('select[name="id_sedes_add[]"');
            console.log("SEDES ADD");
            console.log(idsedesadd);
            var arrayidsedesadd = [];
            for(let i = 0; i < idsedesadd.length; i++) {
                for (let x = 0; x < idsedesadd[i].selectedOptions.length; x++) {
                    const element = idsedesadd[i].selectedOptions[x];
                    arrayidsedesadd.push({'id':element.value, 'name':element.text});
                }
            }
            console.log("ARRAY SEDES ADD");
            console.log(arrayidsedesadd);
            if(liderdosim == true && (arrayidsedes.length >= 1 && arrayidsedesadd.length >= 1) && liderdosimsed.length == 0){
                console.log("es mayor a 1");
                document.getElementById('liderdosimsedes').removeAttribute("hidden");
                
                arrayidsedes.forEach(element => {
                    console.log(element.value);
                    $("#liderdosimsedes").append(
                        '<div class="row">'
                            +'<div class="col-md"></div>'
                            +'<div class="col-md">'
                                +'<div class="form-check">'
                                    +'<input class="form-check-input" type="checkbox" value="'+element.value+'" name="liderdosimsedes[]" id="liderdosimsedes'+element.value+'">'
                                    +'<label class="form-check-label" for="defaultCheck1">'
                                        +element.text
                                    +'</label>'
                                +'</div>'
                            +'</div>'
                            +'<div class="col-md"></div>'
                        +'</div>'
                    );
                });
                arrayidsedesadd.forEach(element => {
                    console.log(element.value);
                    $("#liderdosimsedes").append(
                        '<div class="row">'
                            +'<div class="col-md"></div>'
                            +'<div class="col-md">'
                                +'<div class="form-check">'
                                    +'<input class="form-check-input" type="checkbox" value="'+element.id+'" name="liderdosimsedes[]" id="liderdosimsedes'+element.value+'">'
                                    +'<label class="form-check-label" for="defaultCheck1">'
                                        +element.name
                                    +'</label>'
                                +'</div>'
                            +'</div>'
                            +'<div class="col-md"></div>'
                        +'</div>'
                    );
                });
                return Swal.fire(
                    'VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA',
                    'SELECCIONE LAS SEDES PARA RELACIONAR AL LÍDER DE DOSIMETRÍA, DE LO CONTRARIO SOLO SERÁ UNA PERSONA RELACIONADA A DICHA SEDE CON ROLES DISTINTOS A LIDER DE DOSIMETRÍA!',
                    'question'
                )
            }else if(liderdosim == true && arrayidsedes.length > 1 && liderdosimsed.length == 0){
                console.log("es mayor a 1");
                document.getElementById('liderdosimsedes').removeAttribute("hidden");
                
                arrayidsedes.forEach(element => {
                    console.log(element.value);
                    $("#liderdosimsedes").append(
                        '<div class="row">'
                            +'<div class="col-md"></div>'
                            +'<div class="col-md">'
                                +'<div class="form-check">'
                                    +'<input class="form-check-input" type="checkbox" value="'+element.value+'" name="liderdosimsedes[]" id="liderdosimsedes'+element.value+'">'
                                    +'<label class="form-check-label" for="defaultCheck1">'
                                        +element.text
                                    +'</label>'
                                +'</div>'
                            +'</div>'
                            +'<div class="col-md"></div>'
                        +'</div>'
                    );
                });
                return Swal.fire(
                    'VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA',
                    'SELECCIONE LAS SEDES PARA RELACIONAR AL LÍDER DE DOSIMETRÍA, DE LO CONTRARIO SOLO SERÁ UNA PERSONA RELACIONADA A DICHA SEDE CON ROLES DISTINTOS A LIDER DE DOSIMETRÍA!',
                    'question'
                )
            }
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
        });
    });
</script>
@endsection()