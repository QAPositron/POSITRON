@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')
    <div class="row">
        <div class="col">
            <button type="button" class="btn colorQA" id="botonEspecialidad" data-bs-toggle="modal" data-bs-target="#nuevo_deptoModal" disabled>
                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="currentColor" class="bi bi-plus-lg mb-1" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                </svg> CREAR ESPECIALIDAD
            </button>
        </div>
        <div class="col-10">
            <div class="card text-dark bg-light"> 
                <h2 class="text-center mt-3">CREAR EMPRESA</h2>
                
                <form class="m-4"  id="form_create_empresa" name="form_create_empresa" action="{{route('empresas.save')}}" method="POST">
                    
                    @csrf

                    <div class="row g-2">
                        <label class="text-secondary">' * ' campo obligatorio</label>
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('razonsocial_empresa') is-invalid @enderror" name="razonsocial_empresa" id="razonsocial_empresa" value="{{old('razonsocial_empresa')}}" autofocus style="text-transform:uppercase">
                                <label for="floatingInput">*RAZÓN SOCIAL</label>
                                @error('razonsocial_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('nombre_empresa') is-invalid @enderror" name="nombre_empresa" id="nombre_empresa" value="{{old('nombre_empresa')}}" autofocus style="text-transform:uppercase">
                                <label for="floatingInput">*ACRÓNIMO</label>
                                @error('nombre_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating" >
                                <select class="form-select @error('tipo_empresa') is-invalid @enderror" name="tipo_empresa" id="tipo_empresa" value="{{old('tipo_empresa')}}" autofocus style="text-transform:uppercase">
                                    <option value="">--SELECCIONE--</option>
                                    <option value="persona natural" @if (old('tipo_empresa') == "persona natural") {{ 'selected' }} @endif>PERSONA NATURAL</option>
                                    <option value="persona juridica" @if (old('tipo_empresa') == "persona juridica") {{ 'selected' }} @endif>PERSONA JURIDICA</option>
                                </select>
                                <label for="floatingInputGrid">*TIPO:</label>
                                @error('tipo_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <br> 
                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <select class="form-select @error('tipoIden_empresa') is-invalid @enderror" name="tipoIden_empresa" id="tipoIden_empresa" value="{{old('tipoIden_empresa')}}" autofocus onchange="ShowSelected();" style="text-transform:uppercase">
                                    <option value="">--SELECCIONE--</option>
                                    <option value="NIT" @if (old('tipoIden_empresa') == "NIT") {{ 'selected' }} @endif>NIT</option>
                                    <option value="CÉDULA DE CIUDADANIA" @if (old('tipoIden_empresa') == "CÉDULA DE CIUDADANIA") {{ 'selected' }} @endif>CÉDULA DE CIUDADANIA</option>
                                    <option value="TARJETA DE IDENTIDAD" @if (old('tipoIden_empresa') == "TARJETA DE IDENTIDAD") {{ 'selected' }} @endif>TARJETA DE IDENTIDAD</option>
                                    <option value="REGISTRO CIVIL" @if (old('tipoIden_empresa') == "REGISTRO CIVIL") {{ 'selected' }} @endif>REGISTRO CIVIL</option>
                                    <option value="PASAPORTE" @if (old('tipoIden_empresa') == "PASAPORTE") {{ 'selected' }} @endif>PASAPORTE</option>
                                    <option value="CÉDULA DE EXTRANJERÍA" @if (old('tipoIden_empresa') == "CÉDULA DE EXTRANJERÍA") {{ 'selected' }} @endif>CÉDULA DE EXTRANJERÍA</option>
                                    <option value="TARJETA DE EXTRANJERÍA" @if (old('tipoIden_empresa') == "TARJETA DE EXTRANJERÍA") {{ 'selected' }} @endif>TARJETA DE EXTRANJERÍA</option>
                                    <option value="DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO" @if (old('tipoIden_empresa') == "DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO") {{ 'selected' }} @endif>DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO</option>
                                </select>
                                <label for="floatingInputGrid">*TIPO DE IDENTIFICACIÓN:</label>
                                @error('tipoIden_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <!------------------ CAMPO QUE CAMBIA DINAMICAMENTE----->
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="number" name="numero_ident" id="numero_ident" class="form-control @error('numero_ident') is-invalid @enderror" value="{{old('numero_ident')}}" autofocus > 
                                <label for="floatingInputGrid" id="numero_identificacion">{{old('tipoIden_empresa')}}</label>
                                @error('numero_ident') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-floating" >
                                <input type="number" name="nitdv_empresa" id="nitdv_empresa" class="form-control @error('nitdv_empresa') is-invalid @enderror" value="{{old('nitdv_empresa')}}" autofocus @if(old('tipoIden_empresa') == 'NIT') style="visibility:visible" @else style="visibility: hidden" @endif style="visibility: hidden"> 
                                <label for="floatingInputGrid" name="label_nit_dv_empresa" id="label_nit_dv_empresa"autofocus @if(old('tipoIden_empresa') == 'NIT') style="visibility:visible" @else style="visibility: hidden" @endif style="visibility: hidden">*DV:</label>
                                @error('nitdv_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <!------------------------------------------>
                    </div>
                    <br>
                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating" >
                                <input type="number" name="actividad_empresa" id="actividad_empresa" class="form-control @error('actividad_empresa') is-invalid @enderror" value="{{old('actividad_empresa')}}" autofocus >
                                <label for="floatingInputGrid">*ACTIVIDAD ECONÓMICA PRINCIPAL:</label>
                                @error('actividad_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <select class="form-select @error('respoIva_empresa') is-invalid @enderror" name="respoIva_empresa" id="respoIva_empresa" value="{{old('respoIva_empresa')}}" autofocus style="text-transform:uppercase;">
                                    <option value="">--SELECCIONE--</option>
                                    <option value="NO RESPONSABLE DE IVA" @if (old('respoIva_empresa') == "NO RESPONSABLE DE IVA") {{ 'selected' }} @endif>NO RESPONSABLE DE IVA</option>
                                    <option value="RESPONSABLE DE IVA" @if (old('respoIva_empresa') == "RESPONSABLE DE IVA") {{ 'selected' }} @endif>RESONSABLE DE IVA</option>
                                </select>
                                <label for="floatingInputGrid">*RESPONSABILIDAD IVA:</label>
                                @error('respoIva_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating" >
                                <select class="form-select @error('respoFiscal_empresa') is-invalid @enderror" name="respoFiscal_empresa" id="respoFiscal_empresa" value="{{old('respoFiscal_empresa')}}" autofocus style="text-transform:uppercase;">
                                    <option value="">--SELECCIONE--</option>
                                    <option value="NO RESPONSABLE (R-99-PN)" @if (old('respoFiscal_empresa') == "NO RESPONSABLE (R-99-PN)") {{ 'selected' }} @endif>NO RESPONSABLE (R-99-PN)</option>
                                    <option value="REGIMEN SIMPLE DE TRIBUTACIÓN (O-47)" @if (old('respoFiscal_empresa') == "REGIMEN SIMPLE DE TRIBUTACIÓN (O-47)") {{ 'selected' }} @endif>REGIMEN SIMPLE DE TRIBUTACIÓN (O-47)</option>
                                    <option value="GRAN CONTRIBUYENTE (O-13)" @if (old('respoFiscal_empresa') == "GRAN CONTRIBUYENTE (O-13)") {{ 'selected' }} @endif>GRAN CONTRIBUYENTE (O-13)</option>
                                    <option value="AUTORRETENEDOR (O-15)" @if (old('respoFiscal_empresa') == "AUTORRETENEDOR (O-15)") {{ 'selected' }} @endif>AUTORRETENEDOR (O-15)</option>
                                    <option value="AGENTE DE RETENCIÓN IVA(O-23)" @if (old('respoFiscal_empresa') == "AGENTE DE RETENCIÓN IVA(O-23)") {{ 'selected' }} @endif>AGENTE DE RETENCIÓN IVA(O-23)</option>
                                </select>
                                <label for="floatingInputGrid">*RESPONSABILIDAD FISCAL:</label>
                                @error('respoFiscal_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="number" name="telefono_empresa" id="telefono_empresa" class="form-control @error('telefono_empresa') is-invalid @enderror" value="{{old('telefono_empresa')}}" autofocus>
                                <label for="floatingInputGrid">*TELÉFONO:</label>
                                @error('telefono_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                            </div> 
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="email" name="correo_empresa" id="correo_empresa" class="form-control @error('correo_empresa') is-invalid @enderror" value="{{old('correo_empresa')}}" autofocus style="text-transform:uppercase;"> 
                                <label for="floatingInputGrid">*CORREO ELECTRONICO:</label>
                                @error('correo_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" name="direccion_empresa" id="direccion_empresa" class="form-control @error('direccion_empresa') is-invalid @enderror" value="{{old('direccion_empresa')}}" autofocus style="text-transform:uppercase;"> 
                                <label for="floatingInputGrid">*DIRECCIÓN:</label>
                                @error('direccion_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="numeric" name="pais_empresa" id="pais_empresa" class="form-control" value="COLOMBIA" readonly autofocus style="text-transform:uppercase;">
                                <label for="floatingInputGrid">PAÍS:</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label for="floatingInputGrid">*DEPARTAMENTO:</label>
                                <select class="form-control @error('departamento_empresa') is-invalid @enderror"  name="departamento_empresa" id="departamento_empresa" value="{{old('departamento_empresa')}}" autofocus style="text-transform:uppercase">
                                    <option value="">--SELECCIONE--</option>
                                    @foreach($departamentoscol as $depacol)
                                        <option value="{{$depacol->id_departamentocol}}" @if (old('departamento_empresa') == $depacol->id_departamentocol) {{ 'selected' }} @endif>{{$depacol->nombre_deptocol}}</option>
                                    @endforeach
                                </select>
                                @error('departamento_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md" id="div_municipio">
                            <div class="spinner_municipio text-center" id="spinner_municipio">

                            </div>
                            
                            <div class="form-group" id="municipio_empresa" name="municipio_empresa" >
                                <label for="floatingInputGrid">*MUNICIPIO:</label>
                                <select class="form-control @error('ciudad_empresa') is-invalid @enderror" name="ciudad_empresa" id="ciudad_empresa" value="{{old('ciudad_empresa')}}" autofocus style="text-transform:uppercase">

                                </select>
                                @error('ciudad_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row g-2">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" name="nombreRepr_empresa" id="nombreRepr_empresa" class="form-control @error('nombreRepr_empresa') is-invalid @enderror" value="{{old('nombreRepr_empresa')}}" autofocus style="text-transform:uppercase;">
                                <label for="floatingInputGrid">NOMBRE(s) Y APELLIDO(s) REPR.</label>
                                @error('nombreRepr_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <select class="form-select @error('tipoIden_repreLegal') is-invalid @enderror" name="tipoIden_repreLegal" id="tipoIden_repreLegal" value="{{old('tipoIden_repreLegal')}}" autofocus style="text-transform:uppercase">
                                    <option value="">--SELECCIONE--</option>
                                    <option value="CÉDULA DE CIUDADANIA" @if (old('tipoIden_repreLegal') == "CÉDULA DE CIUDADANIA") {{ 'selected' }} @endif>CÉDULA DE CIUDADANIA</option>
                                    <option value="TARJETA DE IDENTIDAD" @if (old('tipoIden_repreLegal') == "TARJETA DE IDENTIDAD") {{ 'selected' }} @endif>TARJETA DE IDENTIDAD</option>
                                    <option value="REGISTRO CIVIL" @if (old('tipoIden_repreLegal') == "REGISTRO CIVIL") {{ 'selected' }} @endif>REGISTRO CIVIL</option>
                                    <option value="TARJETA DE EXTRANJERÍA" @if (old('tipoIden_repreLegal') == "TARJETA DE EXTRANJERÍA") {{ 'selected' }} @endif>TARJETA DE EXTRANJERÍA</option>
                                    <option value="DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO" @if (old('tipoIden_repreLegal') == "DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO") {{ 'selected' }} @endif>DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO</option>
                                    <option value="CÉDULA DE EXTRANJERÍA" @if (old('tipoIden_repreLegal') == "CÉDULA DE EXTRANJERÍA") {{ 'selected' }} @endif>CÉDULA DE EXTRANJERÍA</option>
                                    <option value="PASAPORTE"  @if (old('tipoIden_repreLegal') == "PASAPORTE") {{ 'selected' }} @endif>PASAPORTE</option>
                                </select>
                                <label for="floatingInputGrid">TIPO DE IDEN. REPR.</label>
                                @error('tipoIden_repreLegal') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                                
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="number" name="cedula_Repr_empresa" id="cedula_Repr_empresa" class="form-control @error('cedula_Repr_empresa') is-invalid @enderror" value="{{old('cedula_Repr_empresa')}}" autofocus style="text-transform:uppercase;">
                                <label for="floatingInputGrid">N° DE IDEN. REPR.</label>
                                @error('cedula_Repr_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <input type="number" name="telefono_Repr_empresa" id="telefono_Repr_empresa" class="form-control @error('telefono_Repr_empresa') is-invalid @enderror" value="{{old('telefono_Repr_empresa')}}" autofocus style="text-transform:uppercase;">
                                <label for="floatingInputGrid">TELÉFONO REPR.</label>
                                @error('telefono_Repr_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="col-md">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="TRUE" id="checkSede">
                                <label class="form-check-label" for="flexCheckDefault">
                                SEDE PRINCIPAL (MISMA INFORMACIÓN)
                                </label>
                            </div>
                        </div>
                    </div>
                    <label for="">AÑADA LOS DEPARTAMENTOS DE ESPECIALIDADES QUE CONTEGA ESTA SEDE</label>
                    <br>
                    <br>
                    <div class="row g-2">
                        <div class="col-10">
                            <label for="">*ESPECIALIDADES:</label>
                            <div class="form-floating">
                                <select class="form-select @error('especialidades') is-invalid @enderror" id="especialidades" name="especialidades[]" autofocus aria-label="Floating label select example" multiple="true" disabled>
                                    @foreach($especialidades as $dep)
                                        <option value="{{$dep->id_departamento}}" {{ in_array($dep->id_departamento, (array) old('especialidades', [])) ? "selected" : "" }}>{{$dep->nombre_departamento}}</option>
                                    @endforeach
                                </select>
                                @error('especialidades') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                            </div>    
                        </div>
                        
                    </div>
                    <br>
                    <!---------BOTON------------->
                    <div class="row">
                        <div class="col"></div>
                        <div class="col d-grid gap-2">
                            <button class="btn colorQA"  type="submit" id="boton-guardar" name="boton-guardar" >GUARDAR</button>
                        </div>
                        <div class="col d-grid gap-2">
                            <a href="{{route('empresas.search')}}" class="btn btn-danger " type="button" id="cancelar" name="cancelar" role="button">CANCELAR</a>
                        </div>
                        <div class="col"></div>
                    </div>
                </form>
            </div>
            <br>
        </div>
        <div class="col"></div>
    </div>
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
    $(document).ready(function() {
        $('#departamento_empresa').select2();
        $('#ciudad_empresa').select2();
        $('#especialidades').select2({
            placeholder:"SELECCIONE LAS ESPECIALIDADES",
            tags: true,
            tokenSeparators: ['/',',',',',','," "]
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        var olddepto = '{{old('departamento_empresa')}}';
        var oldciudad = '{{old('ciudad_empresa')}}';

        console.log("ESTE ES LA CIUDAD"+oldciudad);
        console.log("ESTE ES EL DEPTO"+olddepto);

        if('{{old('ciudad_empresa')}}' == ''){
            console.log("si esta vacio");
            console.log('{{old('ciudad_empresa')}}');
        }else{
            console.log("no esta vacio");
            console.log('{{old('ciudad_empresa')}}');
            @foreach($municipioscol as $muni)
                if('{{$muni->id_municipiocol}}' == oldciudad){
                    console.log('{{$muni->nombre_municol}}');
                    $('#ciudad_empresa').append("<option value='{{$muni->id_municipiocol}}'>" +'--{{$muni->nombre_municol}}--' + "</option>");
                }
            @endforeach
            @foreach($municipioscol as $muni)
                $('#ciudad_empresa').append("<option value='{{$muni->id_municipiocol}}'>" +'{{$muni->nombre_municol}}' + "</option>");
            @endforeach
        }

        $('#departamento_empresa').on('change', function(){
            $('#municipio_empresa').fadeOut();
            $('#spinner_municipio').html('<div class="spinner-border text-secondary" id="spinner" role="status"></div>');
            var departamento_id = $(this).val();
            
            var padre = document.getElementById("spinner_municipio");
            var hijo = document.getElementById("spinner");
            /* alert(departamento_id); */
            if($.trim(departamento_id) != ''){
                $.get('empresasdeptomuni', {departamento_id: departamento_id}, function(municipios){
                    console.log(municipios);
                    var remove = padre.removeChild(hijo);
                    
                    $('#municipio_empresa').fadeIn();
                    $('#ciudad_empresa').empty();
                    $('#ciudad_empresa').append("<option value=''>--SELECCIONE UN MUNICIPIO--</option>");
                    $.each(municipios, function(index, value){
                        $('#ciudad_empresa').append("<option value='"+ index + "'>" + value + "</option>");
                    })
                });
            }
        });
        $('#checkSede').on('change', function(){
            
            if (document.getElementById('checkSede').checked){
                console.log('checkbox1 esta seleccionado');
                document.getElementById('especialidades').disabled = false;
                document.getElementById('botonEspecialidad').disabled = false;
                
            }else{
                document.getElementById('especialidades').disabled = true;
                document.getElementById('botonEspecialidad').disabled = true;
            }
        })
    });
</script>



<script type="text/javascript"> 
    function ShowSelected(){
        var option = document.getElementById("tipoIden_empresa").value;
        var tipo = document.getElementById("tipoIden_empresa");
        var selected = tipo.options[tipo.selectedIndex].text;
        document.getElementById("numero_identificacion").innerHTML = selected;
        var inputText = document.getElementById("nitdv_empresa");
        var labelInput= document.getElementById("label_nit_dv_empresa"); 
        if(selected=="NIT"){
            inputText.style.visibility="visible";
            labelInput.style.visibility="visible";
        }else{
            inputText.style.visibility="hidden";
            labelInput.style.visibility="hidden";
        }
    }
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#form_create_empresa').submit(function(e){
            e.preventDefault();
            var especialidades = document.querySelectorAll('select[name="especialidades[]"]');
            console.log("ESTAS SON LAS ESPECIALIDADES");
            console.log(especialidades);
            for(var i = 0; i < especialidades.length; i++) {
                var values = especialidades[i].value;
                console.log(values);
                if(values != ''){
                    Swal.fire({
                        text: "DESEA GUARDAR ESTA EMPRESA CON LA INFORMACIÓN DE LA SEDE PRINCIPAL??",
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
                }else{
                    Swal.fire({
                        text: "DESEA GUARDAR ESTA EMPRESA??",
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
                }
                
            };
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



