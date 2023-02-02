@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col"></div>
    <div class="col-8">
        <div class="card text-dark bg-light ">
            <h2 class="text-center mt-3">CREAR PERSONA</h2>
            <br>
            <form class="m-4" id="form_create_contacto" name="form_create_contacto" action="{{route('personas.save')}}" method="POST">
                @csrf
                <div class="row g-2">
                    <div class="col-md-5">
                        <label for="">PERFIL LABORAL:</label>
                        <div class="form-floating">
                            <select class="form-select @error('perfil_personas') is-invalid @enderror" name="perfil_personas[]" id="perfil_personas" autofocus aria-label="Floating label select example"  multiple="true" >
                                @foreach($perfiles as $perf)
                                    <option value ="{{$perf->id_perfil}}" {{ in_array($perf->id_perfil, (array) old('perfil_personas', [])) ? "selected" : "" }}>{{$perf->nombre_perfil}}</option>
                                @endforeach  
                               
                            </select>
                            @error('perfil_personas') <span class="invalid-feedback">*{{ $message }}</span> @enderror
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
                            <select class="form-select @error('rol_personas') is-invalid @enderror" name="rol_personas[]" id="rol_personas" autofocus aria-label="Floating label select example"  multiple="true" >
                                @foreach($roles as $rol)
                                    <option value ="{{$rol->id_rol}}" {{ in_array($rol->id_rol, (array) old('rol_personas', [])) ? "selected" : "" }}>{{$rol->nombre_rol}}</option>
                                @endforeach 
                                
                            </select>
                            @error('rol_personas') <span class="invalid-feedback">*{{ $message }}</span> @enderror
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
                            <label for="floatingInputGrid">* PRIMER NOMBRE:</label>
                            @error('primer_nombre_persona') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control @error('segundo_nombre_persona') is-invalid @enderror"  name="segundo_nombre_persona" id="segundo_nombre_persona" value="{{old('segundo_nombre_persona')}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">SEGUNDO NOMBRE:</label>
                            @error('segundo_nombre_persona') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control @error('primer_apellido_persona') is-invalid @enderror"  name="primer_apellido_persona" id="primer_apellido_persona" value="{{old('primer_apellido_persona')}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">* PRIMER APELLIDO:</label>
                            @error('primer_apellido_persona') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control @error('segundo_apellido_persona') is-invalid @enderror"  name="segundo_apellido_persona" id="segundo_apellido_persona" value="{{old('segundo_apellido_persona')}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">* SEGUNDO APELLIDO:</label>
                            @error('segundo_apellido_persona') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select @error('tipoIden_persona') is-invalid @enderror" name="tipoIden_persona" id="tipoIden_persona" value="{{old('tipoIden_persona')}}" autofocus style="text-transform:uppercase">
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
                            
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control @error('cedula_persona') is-invalid @enderror"  name="cedula_persona" id="cedula_persona" value="{{old('cedula_persona')}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">* N° DE IDENTIFICACIÓN:</label>
                            @error('cedula_persona') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating ">
                            <select class="form-select @error('genero_persona') is-invalid @enderror" name="genero_persona" id="genero_persona" style="text-transform:uppercase;">
                                <option value="{{old('genero_persona')}}">--SELECCIONE--</option>
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
                            <input type="email" class="form-control @error('correo_persona') is-invalid @enderror" name="correo_persona" id="correo_persona" value="{{old('correo_persona')}}" autofocus style="text-transform:uppercase;">
                            <label for="">* CORREO:</label>
                            @error('correo_persona') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="number" class="form-control @error('telefono_persona') is-invalid @enderror"  name="telefono_persona" id="telefono_persona" value="{{old('telefono_persona')}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">* TELÉFONO:</label>
                            @error('telefono_persona') <span class="invalid-feedback">*{{ $message }}</span> @enderror
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
                <BR>
                <label for="">A CONTINUACIÓN, SELECCIONE SI ESTE CONTACTO ES EL LÍDER O ENCARGADO DE LOS SERVICIOS:</label>
                
                <div class="row g-2">
                    <div class="col-md"></div>
                    <div class="col-md text-center">
                        <br>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="TRUE" id="lider_contcal" name="lider_contcal" disabled @if(old('lider_contcal') == 'TRUE') checked="checked" @endif>
                            <label class="form-check-label" for="defaultCheck1">
                                CONTROLES DE CALIDAD
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input " type="checkbox" value="TRUE" id="lider_ava" name="lider_ava" disabled @if(old('lider_ava') == 'TRUE') checked="checked" @endif>
                            <label class="form-check-label" for="defaultCheck1">
                                AULA VIRTUAL
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="TRUE" id="lider_dosimetria" name="lider_dosimetria" disabled @if(old('lider_dosimetria') == 'TRUE') checked="checked" @endif>
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
                        <a href="{{route('personas.search')}}" class="btn btn-danger " type="button" id="cancelar" name="cancelar" role="button">CANCELAR</a>
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
        $('#lider_dosimetria').on('change', function(){
            var values="2,";
            var lider = document.getElementById("lider_dosimetria").value;
            if(lider == 'TRUE'){
                
                $.each(values.split(","), function(i,e){
                    $("#rol_personas option[value='" + e + "']").prop("selected", true);
                });
            }
        })        
        $('#id_empresas').on('change', function(){

            $('#sede_empresa').fadeOut();
            $('#spinner_sede').html('<div class="spinner-border text-secondary" id="spinner" role="status"></div>');
            var empresa_id = $(this).val();
            console.log("estado de la empresa" + empresa_id)
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
            }else{
                var remove = padre.removeChild(hijo);
                $('#sede_empresa').fadeIn();
                
            }
            
            $("#lider_contcal").removeAttr('disabled');
            $("#lider_ava").removeAttr('disabled');
            $("#lider_dosimetria").removeAttr('disabled');
        });
    });
   
    $(document).ready(function(){
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
            i++;
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