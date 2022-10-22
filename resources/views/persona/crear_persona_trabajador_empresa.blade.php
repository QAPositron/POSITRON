@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col"></div>
    <div class="col-8">
        <div class="card text-dark bg-light ">
            <br>
            @if($id == 1)
                <h3 class="text-center mt-3">CREAR TRABAJADOR DOSIMETRIA PARA LA EMPRESA <br> <i>{{$empresa->nombre_empresa}}</i></h3>
            @elseif($id == 2)
                <h3 class="text-center mt-3">CREAR ESTUDIANTE DE A. VIRTUAL PARA LA EMPRESA <br> <i>{{$empresa->nombre_empresa}}</i></h3>
            @elseif($id== 3)
                <h3 class="text-center mt-3">CREAR CONTACTO PARA LA EMPRESA <br> <i>{{$empresa->nombre_empresa}}</i></h3>
            @endif
            <br>
            <form class="m-4" id="form_create_contacto" name="form_create_contacto" action="{{route('personasEmpresa.save')}}" method="POST">
                @csrf
                <div class="row g-2">
                    <div class="col-md-5">
                        <label for="">PERFIL LABORAL:</label>
                        <div class="form-floating">
<<<<<<< HEAD
                            <select class="form-select @error('perfil_personas') is-invalid @enderror" name="perfil_personas[]" id="perfil_personas" autofocus aria-label="Floating label select example"  multiple="true" >
                                @foreach($perfiles as $perf)
                                    <option value ="{{$perf->id_perfil}}" {{ in_array($perf->id_perfil, (array) old('perfil_personas', [])) ? "selected" : "" }}>{{$perf->nombre_perfil}}</option>
                                @endforeach 
                            </select>
                            @error('perfil_personas') <span class="invalid-feedback">*{{ $message }}</span> @enderror
=======
                            <select class="form-select" name="perfil_personas[]" id="perfil_personas" autofocus aria-label="Floating label select example"  multiple="true" >
                                @foreach($perfiles as $perf)
                                    <option value ="{{$perf->id_perfil}}">{{$perf->nombre_perfil}}</option>
                                @endforeach 
                                
                            </select>
                            @error('perfil_personas')
                                <small>*{{$message}}</small>
                            @enderror
>>>>>>> 09313f106824dd5ef754906ad37c05996286f3aa
                        </div>
                    </div>
                    <div class="col-md d-flex align-items-center ">
                        <button type="button" class="btn colorQA" data-bs-toggle="modal" data-bs-target="#nueva_perfilModal" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="col-md-6">
                        <label for="">ROL:</label>
                        <div class="form-floating">
<<<<<<< HEAD
                            <select class="form-select @error('rol_personas') is-invalid @enderror" name="rol_personas[]" id="rol_personas" autofocus aria-label="Floating label select example"  multiple="true" >
                                @foreach($roles as $rol)
                                    @if($id == 1 && ($rol->id_rol == 3 || $rol->id_rol == 4))
                                        <option value ="{{$rol->id_rol}}" {{ in_array($rol->id_rol, (array) old('rol_personas', [])) ? "selected" : "" }}>{{$rol->nombre_rol}}</option>
                                    
                                    @elseif($id == 2 && $rol->id_rol == 1)
                                        <option value ="{{$rol->id_rol}}" {{ in_array($rol->id_rol, (array) old('rol_personas', [])) ? "selected" : "" }}>{{$rol->nombre_rol}}</option> 
                                    @elseif($id == 3 && $rol->id_rol == 2)
                                        <option value ="{{$rol->id_rol}}" {{ in_array($rol->id_rol, (array) old('rol_personas', [])) ? "selected" : "" }}>{{$rol->nombre_rol}}</option>
                                    @endif
                                @endforeach 
                            </select>
                            @error('rol_personas') <span class="invalid-feedback">*{{ $message }}</span> @enderror
=======
                            <select class="form-select" name="rol_personas[]" id="rol_personas" autofocus aria-label="Floating label select example"  multiple="true" >
                                @foreach($roles as $rol)
                                    @if($id == 1 && ($rol->id_rol == 3 || $rol->id_rol == 4))
                                        <option value ="{{$rol->id_rol}}">{{$rol->nombre_rol}}</option>
                                    
                                    @elseif($id == 2 && $rol->id_rol == 1)
                                        <option value ="{{$rol->id_rol}}">{{$rol->nombre_rol}}</option> 
                                    @elseif($id == 3 && $rol->id_rol == 2)
                                        <option value ="{{$rol->id_rol}}">{{$rol->nombre_rol}}</option>
                                    @endif
                                @endforeach 
                                
                            </select>
                            @error('rol_personas')
                                <small>*{{$message}}</small>
                            @enderror
>>>>>>> 09313f106824dd5ef754906ad37c05996286f3aa
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
                {{-- <input hidden type="number" name="id_perfiles[]" id="id_perfiles" value="">
                <input hidden type="number" name="id_roles[]" id="id_roles" value=""> --}}
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control @error('primer_nombre_persona') is-invalid @enderror"  name="primer_nombre_persona" id="primer_nombre_persona" value="{{old('primer_nombre_persona')}}" autofocus style="text-transform:uppercase;">
<<<<<<< HEAD
                            <label for="floatingInputGrid">* PRIMER NOMBRE:</label>
                            @error('primer_nombre_persona') <span class="invalid-feedback">*{{ $message }}</span> @enderror
=======
                            <label for="floatingInputGrid">PRIMER NOMBRE:</label>
                            @error('primer_nombre_persona')
                                <span class="invalid-feedback">*{{ $message }}</span>
                            @enderror
>>>>>>> 09313f106824dd5ef754906ad37c05996286f3aa
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control @error('segundo_nombre_persona') is-invalid @enderror"  name="segundo_nombre_persona" id="segundo_nombre_persona" value="{{old('segundo_nombre_persona')}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">SEGUNDO NOMBRE:</label>
<<<<<<< HEAD
                            @error('segundo_nombre_persona') <span class="invalid-feedback">*{{ $message }}</span> @enderror
=======
                            @error('segundo_nombre_persona')
                                <span class="invalid-feedback">*{{ $message }}</span>
                            @enderror
>>>>>>> 09313f106824dd5ef754906ad37c05996286f3aa
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control @error('primer_apellido_persona') is-invalid @enderror"  name="primer_apellido_persona" id="primer_apellido_persona" value="{{old('primer_apellido_persona')}}" autofocus style="text-transform:uppercase;">
<<<<<<< HEAD
                            <label for="floatingInputGrid">* PRIMER APELLIDO:</label>
                            @error('primer_apellido_persona') <span class="invalid-feedback">*{{ $message }}</span> @enderror
=======
                            <label for="floatingInputGrid">PRIMER APELLIDO:</label>
                            @error('primer_apellido_persona')
                                <span class="invalid-feedback">*{{ $message }}</span>
                            @enderror
>>>>>>> 09313f106824dd5ef754906ad37c05996286f3aa
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control @error('segundo_apellido_persona') is-invalid @enderror"  name="segundo_apellido_persona" id="segundo_apellido_persona" value="{{old('segundo_apellido_persona')}}" autofocus style="text-transform:uppercase;">
<<<<<<< HEAD
                            <label for="floatingInputGrid">* SEGUNDO APELLIDO:</label>
                            @error('segundo_apellido_persona') <span class="invalid-feedback">*{{ $message }}</span> @enderror
=======
                            <label for="floatingInputGrid">SEGUNDO APELLIDO:</label>
                            @error('segundo_apellido_persona')
                                <span class="invalid-feedback">*{{ $message }}</span>
                            @enderror
>>>>>>> 09313f106824dd5ef754906ad37c05996286f3aa
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
<<<<<<< HEAD
                            <select class="form-select @error('tipoIden_persona') is-invalid @enderror" name="tipoIden_persona" id="tipoIden_persona"  autofocus style="text-transform:uppercase">
                                <option value="">--SELECCIONE--</option>
                                <option value="CÉDULA DE CIUDADANIA" @if (old('tipoIden_persona') == "CÉDULA DE CIUDADANIA") {{ 'selected' }} @endif>CÉDULA DE CIUDADANIA</option>
                                <option value="TARJETA DE IDENTIDAD" @if (old('tipoIden_persona') == "TARJETA DE IDENTIDAD") {{ 'selected' }} @endif>TARJETA DE IDENTIDAD</option>
                                <option value="REGISTRO CIVIL" @if (old('tipoIden_persona') == "REGISTRO CIVIL") {{ 'selected' }} @endif>REGISTRO CIVIL</option>
                                <option value="TARJETA DE EXTRANJERÍA" @if (old('tipoIden_persona') == "TARJETA DE EXTRANJERÍA") {{ 'selected' }} @endif>TARJETA DE EXTRANJERÍA</option>
                                <option value="DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO" @if (old('tipoIden_persona') == "DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO") {{ 'selected' }} @endif>DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO</option>
                                <option value="CÉDULA DE EXTRANJERÍA" @if (old('tipoIden_persona') == "CÉDULA DE EXTRANJERÍA") {{ 'selected' }} @endif>CÉDULA DE EXTRANJERÍA</option>
                                <option value="PASAPORTE"  @if (old('tipoIden_persona') == "PASAPORTE") {{ 'selected' }} @endif>PASAPORTE</option>
                            </select>
                            <label for="floatingInputGrid">* TIPO DE IDENTIFICACIÓN:</label>
                            @error('tipoIden_persona') <span class="invalid-feedback">*{{ $message }}</span> @enderror
=======
                            <select class="form-select @error('tipoIden_persona') is-invalid @enderror" name="tipoIden_persona" id="tipoIden_persona" value="{{old('tipoIden_persona')}}" autofocus style="text-transform:uppercase">
                                <option value="">--SELECCIONE--</option>
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
>>>>>>> 09313f106824dd5ef754906ad37c05996286f3aa
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control @error('cedula_persona') is-invalid @enderror"  name="cedula_persona" id="cedula_persona" value="{{old('cedula_persona')}}" autofocus style="text-transform:uppercase;">
<<<<<<< HEAD
                            <label for="floatingInputGrid">* N° DE IDENTIFICACIÓN:</label>
                            @error('cedula_persona') <span class="invalid-feedback">*{{ $message }}</span> @enderror
=======
                            <label for="floatingInputGrid">N° DE IDENTIFICACIÓN:</label>
                            @error('cedula_persona')
                                <span class="invalid-feedback">*{{ $message }}</span>
                            @enderror
>>>>>>> 09313f106824dd5ef754906ad37c05996286f3aa
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating ">
                            <select class="form-select @error('genero_persona') is-invalid @enderror" name="genero_persona" id="genero_persona" style="text-transform:uppercase;">
                                <option value="{{old('genero_persona')}}">--SELECCIONE--</option>
<<<<<<< HEAD
                                <option value="femenino" @if (old('genero_persona') == "femenino") {{ 'selected' }} @endif>FEMENINO</option>
                                <option value="masculino" @if (old('genero_persona') == "masculino") {{ 'selected' }} @endif>MASCULINO</option>
                                <option value="otro">OTRO</option>
                            </select>
                            <label for="floatingInputGrid">* GÉNERO:</label>
                            @error('genero_persona') <span class="invalid-feedback">*{{ $message }}</span> @enderror
=======
                                <option value="femenino">FEMENINO</option>
                                <option value="masculino">MASCULINO</option>
                                <option value="otro">OTRO</option>
                            </select>
                            <label for="floatingInputGrid">GÉNERO:</label>
                            @error('genero_persona')
                                <span class="invalid-feedback">*{{ $message }}</span>
                            @enderror
>>>>>>> 09313f106824dd5ef754906ad37c05996286f3aa
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="email" class="form-control @error('correo_persona') is-invalid @enderror" name="correo_persona" id="correo_persona" value="{{old('correo_persona')}}" autofocus style="text-transform:uppercase;">
<<<<<<< HEAD
                            <label for="">* CORREO:</label>
                            @error('correo_persona') <span class="invalid-feedback">*{{ $message }}</span> @enderror
=======
                            <label for="">CORREO:</label>
                            @error('correo_persona')
                                <span class="invalid-feedback">*{{ $message }}</span>
                            @enderror
>>>>>>> 09313f106824dd5ef754906ad37c05996286f3aa
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="number" class="form-control @error('telefono_persona') is-invalid @enderror"  name="telefono_persona" id="telefono_persona" value="{{old('telefono_persona')}}" autofocus style="text-transform:uppercase;">
<<<<<<< HEAD
                            <label for="floatingInputGrid">* TELÉFONO:</label>
                            @error('telefono_persona') <span class="invalid-feedback">*{{ $message }}</span> @enderror
=======
                            <label for="floatingInputGrid">TELÉFONO:</label>
                            @error('telefono_persona')
                                <span class="invalid-feedback">*{{ $message }}</span>
                            @enderror
>>>>>>> 09313f106824dd5ef754906ad37c05996286f3aa
                        </div>
                    </div>
                    <div class="col-md"></div>
                </div>
                <BR>
                <label for="">SELECCIONE SI DESEA RELACIONAR ESTE CONTACTO A UNA EMPRESA Y SUS SEDES</label>
                <br>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="empresa_persona" id="empresa_persona" value="{{$empresa->nombre_empresa}}" readonly>
<<<<<<< HEAD
                            <input type="number" class="form-control @error('id_empresa') is-invalid @enderror" name="id_empresa" id="id_empresa" value="{{$empresa->id_empresa}}"  hidden>
                            <label for="floatingSelectGrid">EMPRESA:</label>
                            @error('id_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
=======
                            <input type="number" class="form-control" name="id_empresa" id="id_empresa" value="{{$empresa->id_empresa}}"  hidden>
                            <label for="floatingSelectGrid">EMPRESA:</label>
                            
>>>>>>> 09313f106824dd5ef754906ad37c05996286f3aa
                        </div>
                    </div>
                    <div class="col-md">
                        
                        <label for="floatingSelectGrid">SEDE:</label>
                        
                        <div class="form-floating" id="sede_empresa" name="sede_empresa">
                            <select class="form-select" id="id_sedes" name="id_sedes[]" autofocus aria-label="Floating label select example"  multiple="true">
                                <option value="">--SELECCIONE--</option>
                                @foreach($sedes as $sede)
                                    <option value ="{{ $sede->id_sede }}">{{$sede->nombre_sede}}</option>
                                @endforeach 
                            </select>
                            
                        </div>
                    </div>
                </div>
                <br>
                <BR>
                <label for="">A CONTINUACIÓN, SELECCIONE SI ESTE CONTACTO ES EL LÍDER O ENCARGADO DE LOS SERVICIOS:</label>
                
                <div class="row g-2">
                    <div class="col-md"></div>
                    <div class="col-md text-center">
                        <br>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="TRUE" id="lider_contcal" name="lider_contcal">
                            <label class="form-check-label" for="defaultCheck1">
                                CONTROLES DE CALIDAD
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input " type="checkbox" value="TRUE" id="lider_ava" name="lider_ava">
                            <label class="form-check-label" for="defaultCheck1">
                                AULA VIRTUAL
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="TRUE" id="lider_dosimetria" name="lider_dosimetria">
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
                        <input class="btn colorQA" type="submit" id="boton-guardar" name="boton-guardar" value="GUARDAR">
                    </div>
                    <div class="col d-grid gap-2">
                        <a href="{{route('empresas.info', $empresa->id_empresa)}}" class="btn btn-danger " type="button" id="cancelar" name="cancelar" role="button">CANCELAR</a>
                    </div>
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
    $(document).ready(function(){
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
    });
    $(document).ready(function(){
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
    });
    
</script>

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
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#form_create_contacto').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "DESEA GUARDAR ESTA PERSONA??",
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