@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')
<div class="row"> 
    <div class="col"></div>
    <div class="col-10">
        <div class="card text-dark bg-light">
            <h2 class="text-center mt-3">EDITAR EMPRESA</h2>
             
            <form class="m-4"  id="form_edit_empresa" name="form_edit_empresa" action="{{route('empresas.update', $empresa)}}" method="POST">
                
                @csrf

                @method('put')

                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('razonsocial_empresa') is-invalid @enderror" name="razonsocial_empresa" id="razonsocial_empresa" value="{{old('razonsocial_empresa', $empresa->razon_social_empresa)}}" autofocus style="text-transform:uppercase">
                            <label for="floatingInput">*RAZÓN SOCIAL</label>
                            @error('razonsocial_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('nombre_empresa') is-invalid @enderror" name="nombre_empresa" id="nombre_empresa" value="{{old('nombre_empresa', $empresa->nombre_empresa)}}" autofocus style="text-transform:uppercase">
                            <label for="floatingInput">NOMBRE</label>
                            @error('nombre_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating" >
                            <select class="form-select @error('tipo_empresa') is-invalid @enderror" name="tipo_empresa" id="tipo_empresa" value="{{old('tipo_empresa', $empresa->tipo_empresa)}}" autofocus style="text-transform:uppercase  ">
                                <option value="{{$empresa->tipo_empresa}}">{{$empresa->tipo_empresa}}</option>
                                <option value="persona natural" @if (old('tipo_empresa') == "persona natural") {{ 'selected' }} @endif>PERSONA NATURAL</option>
                                <option value="persona juridica" @if (old('tipo_empresa') == "persona juridica") {{ 'selected' }} @endif>PERSONA JURIDICA</option>
                            </select>
                            <label for="floatingInputGrid">TIPO:</label>
                            @error('tipo_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select @error('tipoIden_empresa') is-invalid @enderror" name="tipoIden_empresa" id="tipoIden_empresa" autofocus  style="text-transform:uppercase;">
                                <option value="{{$empresa->tipo_identificacion_empresa}}">{{old('tipoIden_empresa', $empresa->tipo_identificacion_empresa)}}</option>
                                <option value="nit"  @if (old('tipoIden_empresa') == "nit") {{ 'selected' }} @endif>NIT</option>
                                <option value="CÉDULA DE EXTRANJERÍA"  @if (old('tipoIden_empresa') == "CÉDULA DE EXTRANJERÍA") {{ 'selected' }} @endif>CÉDULA DE EXTRANJERÍA</option>
                                <option value="TARJETA DE EXTRANJERÍA"  @if (old('tipoIden_empresa') == "TARJETA DE EXTRANJERÍA") {{ 'selected' }} @endif>TARJETA DE EXTRANJERÍA</option>
                                <option value="DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO"  @if (old('tipoIden_empresa') == "DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO") {{ 'selected' }} @endif>DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO</option>
                                <option value="TARJETA DE IDENTIDAD"  @if (old('tipoIden_empresa') == "TARJETA DE IDENTIDAD") {{ 'selected' }} @endif>TARJETA DE IDENTIDAD</option>
                                <option value="CÉDULA DE CIUDADANIA"  @if (old('tipoIden_empresa') == "CÉDULA DE CIUDADANIA") {{ 'selected' }} @endif>CÉDULA DE CIUDADANIA</option>
                                <option value="REGISTRO CIVIL"  @if (old('tipoIden_empresa') == "REGISTRO CIVIL") {{ 'selected' }} @endif>REGISTRO CIVIL</option>
                                <option value="PASAPORTE"  @if (old('tipoIden_empresa') == "PASAPORTE") {{ 'selected' }} @endif>PASAPORTE</option>
                            </select>
                            <label for="floatingInputGrid">TIPO DE IDENTIFICACIÓN:</label>
                            @error('tipoIden_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <!------------------ CAMPO QUE CAMBIA DINAMICAMENTE----->
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="numeric" name="numero_ident" id="numero_ident" class="form-control @error('numero_ident') is-invalid @enderror" value="{{old('numero_ident', $empresa->num_iden_empresa)}}"  autofocus> 
                            <label for="floatingInputGrid" id="numero_identificacion">{{$empresa->tipo_identificacion_empresa}}</label>
                            @error('numero_ident') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-floating" >
                            <input type="numeric" name="nitdv_empresa" id="nitdv_empresa" class="form-control @error('nitdv_empresa') is-invalid @enderror" value="{{old('nitdv_empresa', $empresa->DV)}}" autofocus style="visibility: hidden"> 
                            <label for="floatingInputGrid" name="label_nit_dv_empresa" id="label_nit_dv_empresa" style="visibility: hidden">DV:</label>
                            @error('nitdv_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <!------------------------------------------>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating" >
                            <input type="numeric" name="actividad_empresa" id="actividad_empresa" class="form-control @error('actividad_empresa') is-invalid @enderror" value="{{old('actividad_empresa', $empresa->actividad_economica_empresa)}}"  autofocus >
                            <label for="floatingInputGrid">ACTIVIDAD ECONÓMICA PRINCIPAL:</label>
                            @error('actividad_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select @error('respoIva_empresa') is-invalid @enderror" name="respoIva_empresa" id="respoIva_empresa" autofocus style="text-transform:uppercase;">
                                <option value="{{$empresa->respo_iva_empresa}}">{{old('respoIva_empresa', $empresa->respo_iva_empresa)}}</option>
                                <option value="NO RESPONSABLE DE IVA" @if (old('respoIva_empresa') == "NO RESPONSABLE DE IVA") {{ 'selected' }} @endif>NO RESPONSABLE DE IVA</option>
                                <option value="RESPONSABLE DE IVA" @if (old('respoIva_empresa') == "RESPONSABLE DE IVA") {{ 'selected' }} @endif>RESONSABLE DE IVA</option>
                            </select>
                            <label for="floatingInputGrid">RESPONSABILIDAD IVA:</label>
                            @error('respoIva_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating" >
                            <select class="form-select @error('respoFiscal_empresa') is-invalid @enderror" name="respoFiscal_empresa" id="respoFiscal_empresa"  autofocus style="text-transform:uppercase;">
                                <option value="{{$empresa->respo_fiscal_empresa}}">{{old('respoFiscal_empresa', $empresa->respo_fiscal_empresa)}}</option>
                                <option value="NO RESPONSABLE (R-99-PN)" @if (old('respoFiscal_empresa') == "NO RESPONSABLE (R-99-PN)") {{ 'selected' }} @endif>NO RESPONSABLE (R-99-PN)</option>
                                <option value="REGIMEN SIMPLE DE TRIBUTACIÓN (O-47)" @if (old('respoFiscal_empresa') == "REGIMEN SIMPLE DE TRIBUTACIÓN (O-47)") {{ 'selected' }} @endif>REGIMEN SIMPLE DE TRIBUTACIÓN (O-47)</option>
                                <option value="GRAN CONTRIBUYENTE (O-13)"  @if (old('respoFiscal_empresa') == "GRAN CONTRIBUYENTE (O-13)") {{ 'selected' }} @endif>GRAN CONTRIBUYENTE (O-13)</option>
                                <option value="AUTORRETENEDOR (O-15)" @if (old('respoFiscal_empresa') == "AUTORRETENEDOR (O-15)") {{ 'selected' }} @endif>AUTORRETENEDOR (O-15)</option>
                                <option value="AGENTE DE RETENCIÓN IVA(O-23)"  @if (old('respoFiscal_empresa') == "AGENTE DE RETENCIÓN IVA(O-23)") {{ 'selected' }} @endif>AGENTE DE RETENCIÓN IVA(O-23)</option>
                            </select>
                            <label for="floatingInputGrid">RESPONSABILIDAD FISCAL:</label>
                            @error('respoFiscal_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="numeric" name="telefono_empresa" id="telefono_empresa" class="form-control  @error('telefono_empresa') is-invalid @enderror" value="{{old('telefono_empresa', $empresa->telefono_empresa)}}" autofocus >
                            <label for="floatingInputGrid">TELÉFONO:</label>
                            @error('telefono_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div> 
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="email" name="correo_empresa" id="correo_empresa" class="form-control @error('correo_empresa') is-invalid @enderror" value="{{old('correo_empresa', $empresa->email_empresa)}}" autofocus style="text-transform:uppercase;"> 
                            <label for="floatingInputGrid">CORREO ELECTRONICO:</label>
                            @error('correo_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" name="direccion_empresa" id="direccion_empresa" class="form-control @error('direccion_empresa') is-invalid @enderror" value="{{old('direccion_empresa', $empresa->direccion_empresa)}}" autofocus style="text-transform:uppercase;"> 
                            <label for="floatingInputGrid">DIRECCIÓN:</label>
                            @error('direccion_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="numeric" name="pais_empresa" id="pais_empresa" class="form-control" value="{{old('pais_empresa', $empresa->pais_empresa)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">PAÍS:</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <label for="floatingInputGrid">DEPARTAMENTO:</label>
                            <select class="form-control @error('departamento_empresa') is-invalid @enderror"  name="departamento_empresa" id="departamento_empresa" value="{{old('departamento_empresa')}}" autofocus style="text-transform:uppercase">
                                <option value="{{$empresa->municipios->coldepartamento->id_departamentocol}}">--{{$empresa->municipios->coldepartamento->nombre_deptocol}}--</option>
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

                        <div class="form-group" id="municipio_empresa" name="municipio_empresa">
                            <label for="floatingInputGrid">MUNICIPIO:</label>
                            <select class="form-control @error('ciudad_empresa') is-invalid @enderror" name="ciudad_empresa" id="ciudad_empresa" value="{{old('ciudad_empresa')}}" autofocus style="text-transform:uppercase">
                                <option value="{{$empresa->municipios->id_municipiocol}}">--{{$empresa->municipios->nombre_municol}}--</option>
                            </select>
                            @error('ciudad_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col md">
                        <div class="form-floating">
                            <input type="text" name="nombreRepr_empresa" id="nombreRepr_empresa" class="form-control @error('nombreRepr_empresa') is-invalid @enderror" value="{{old('nombreRepr_empresa', $empresa->nombre_representantelegal)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">* NOMBRE(s) Y APELLIDO(s) REPR. LEGAL</label>
                            @error('nombreRepr_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select @error('tipoIden_repreLegal') is-invalid @enderror" name="tipoIden_repreLegal" id="tipoIden_repreLegal" value="{{old('tipoIden_repreLegal')}}" autofocus style="text-transform:uppercase">
                                <option value="{{$empresa->tipo_iden_representantelegal}}">--{{old('tipoIden_repreLegal', $empresa->tipo_iden_representantelegal)}}--</option>
                                <option value="CÉDULA DE CIUDADANIA" @if (old('tipoIden_repreLegal') == "CÉDULA DE CIUDADANIA") {{ 'selected' }} @endif>CÉDULA DE CIUDADANIA</option>
                                <option value="TARJETA DE IDENTIDAD" @if (old('tipoIden_repreLegal') == "TARJETA DE IDENTIDAD") {{ 'selected' }} @endif>TARJETA DE IDENTIDAD</option>
                                <option value="REGISTRO CIVIL" @if (old('tipoIden_repreLegal') == "REGISTRO CIVIL") {{ 'selected' }} @endif>REGISTRO CIVIL</option>
                                <option value="TARJETA DE EXTRANJERÍA" @if (old('tipoIden_repreLegal') == "TARJETA DE EXTRANJERÍA") {{ 'selected' }} @endif>TARJETA DE EXTRANJERÍA</option>
                                <option value="DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO" @if (old('tipoIden_repreLegal') == "DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO") {{ 'selected' }} @endif>DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO</option>
                                <option value="CÉDULA DE EXTRANJERÍA" @if (old('tipoIden_repreLegal') == "CÉDULA DE EXTRANJERÍA") {{ 'selected' }} @endif>CÉDULA DE EXTRANJERÍA</option>
                                <option value="PASAPORTE"  @if (old('tipoIden_repreLegal') == "PASAPORTE") {{ 'selected' }} @endif>PASAPORTE</option>
                            </select>
                            <label for="floatingInputGrid">* TIPO DE IDENTIFICACIÓN REPR. LEGAL:</label>
                            @error('tipoIden_repreLegal') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                            
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="number" name="cedula_Repr_empresa" id="cedula_Repr_empresa" class="form-control @error('cedula_Repr_empresa') is-invalid @enderror" value="{{old('cedula_Repr_empresa', $empresa->cedula_representantelegal)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">* N° DE IDENTIFICACIÓN REPR. LEGAL</label>
                            @error('cedula_Repr_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <br>
                 <!---------BOTON------------->
                <div class="row">
                    <div class="col"></div>
                    <div class="col d-grid gap-2">
                        <button class="btn colorQA " type="submit" id="boton-guardar" name="boton-guardar">ACTUALIZAR</button>
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
<script type="text/javascript"> 
        
    var tipo = document.getElementById("tipoIden_empresa");
    var selected = tipo.options[tipo.selectedIndex].text;
    
    var inputText = document.getElementById("nitdv_empresa");
    var labelInput= document.getElementById("label_nit_dv_empresa"); 
    if(selected=="NIT"){
        inputText.style.visibility="visible";
        labelInput.style.visibility="visible";
    }else{
        inputText.style.visibility="hidden";
        
        labelInput.style.visibility="hidden";
    }
    
</script>
<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous">
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>   

<script type="text/javascript">
    $(document).ready(function() {
        $('#departamento_empresa').select2();
        $('#ciudad_empresa').select2();
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#departamento_empresa').on('change', function(){
            $('#municipio_empresa').fadeOut();
            $('#spinner_municipio').html('<div class="spinner-border text-secondary" id="spinner" role="status"></div>');
            var departamento_id = $(this).val();
            /* alert(departamento_id); */
            var padre = document.getElementById("spinner_municipio");
            var hijo = document.getElementById("spinner");
            if($.trim(departamento_id) != ''){
                $.get('empresasdeptomuni', {departamento_id: departamento_id}, function(municipios){
                    console.log(municipios);
                    var remove = padre.removeChild(hijo);
                    $('#municipio_empresa').fadeIn();
                    $('#ciudad_empresa').empty();
                    $('#ciudad_empresa').append("<option value='{{$empresa->municipios->id_municipiocol}}'>--{{$empresa->municipios->nombre_municol}}--</option>");
                    $.each(municipios, function(index, value){
                        $('#ciudad_empresa').append("<option value='"+ index + "'>" + value + "</option>");
                    })
                });
            }
        });
    });
</script>

<script type="text/javascript">
$(document).ready(function(){
    $('#form_edit_empresa').submit(function(e){
        e.preventDefault();
        Swal.fire({
            text: 'SEGURO QUE DESEA ACTUALIZAR LA INFORMACIÓN DE ESTA EMPRESA?',
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

@endsection()