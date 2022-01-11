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
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="nombre_empresa" id="nombre_empresa" value="{{old('nombre_empresa', $empresa->nombre_empresa)}}" autofocus style="text-transform:uppercase">
                            <label for="floatingInput">NOMBRE</label>
                            @error('nombre_empresa')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating" >
                            <select class="form-select" name="tipo_empresa" id="tipo_empresa" value="{{old('tipo_empresa', $empresa->tipo_empresa)}}" autofocus style="text-transform:uppercase  ">
                                <option value="{{$empresa->tipo_empresa}}">{{$empresa->tipo_empresa}}</option>
                                <option value="persona natural">PERSONA NATURAL</option>
                                <option value="persona juridica">PERSONA JURIDICA</option>
                            </select>
                            <label for="floatingInputGrid">TIPO:</label>
                            @error('tipo_empresa')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select" name="tipoIden_empresa" id="tipoIden_empresa" autofocus  style="text-transform:uppercase;">
                                <option value="{{$empresa->tipo_identificacion_empresa}}">{{old('tipoIden_empresa', $empresa->tipo_identificacion_empresa)}}</option>
                                <option value="nit">NIT</option>
                                <option value="CÉDULA DE EXTRANJERÍA">CÉDULA DE EXTRANJERÍA</option>
                                <option value="TARJETA DE EXTRANJERÍA">TARJETA DE EXTRANJERÍA</option>
                                <option value="DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO">DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO</option>
                                <option value="TARJETA DE IDENTIDAD">TARJETA DE IDENTIDAD</option>
                                <option value="CÉDULA DE CIUDADANIA">CÉDULA DE CIUDADANIA</option>
                                <option value="REGISTRO CIVIL">REGISTRO CIVIL</option>
                                <option value="PASAPORTE">PASAPORTE</option>
                            </select>
                            <label for="floatingInputGrid">TIPO DE IDENTIFICACIÓN:</label>
                            @error('tipoIden_empresa')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <!------------------ CAMPO QUE CAMBIA DINAMICAMENTE----->
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="numeric" name="numero_ident" id="numero_ident" class="form-control" value="{{old('numero_ident', $empresa->num_iden_empresa)}}"  autofocus> 
                            <label for="floatingInputGrid" id="numero_identificacion">{{$empresa->tipo_identificacion_empresa}}</label>
                            @error('numero_ident')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-floating" >
                            <input type="numeric" name="nitdv_empresa" id="nitdv_empresa" class="form-control" value="{{old('nitdv_empresa', $empresa->DV)}}" autofocus style="visibility: hidden"> 
                            <label for="floatingInputGrid" name="label_nit_dv_empresa" id="label_nit_dv_empresa" style="visibility: hidden">DV:</label>
                            @error('nitdv_empresa')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <!------------------------------------------>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating" >
                            <input type="numeric" name="actividad_empresa" id="actividad_empresa" class="form-control" value="{{old('actividad_empresa', $empresa->actividad_economica_empresa)}}"  autofocus >
                            <label for="floatingInputGrid">ACTIVIDAD ECONÓMICA PRINCIPAL:</label>
                            @error('actividad_empresa')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select" name="respoIva_empresa" id="respoIva_empresa" autofocus style="text-transform:uppercase;">
                                <option value="{{$empresa->respo_iva_empresa}}">{{old('respoIva_empresa', $empresa->respo_iva_empresa)}}</option>
                                <option value="NO RESPONSABLE DE IVA">NO RESPONSABLE DE IVA</option>
                                <option value="RESPONSABLE DE IVA">RESONSABLE DE IVA</option>
                            </select>
                            <label for="floatingInputGrid">RESPONSABILIDAD IVA:</label>
                            @error('respoIva_empresa')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating" >
                            <select class="form-select" name="respoFiscal_empresa" id="respoFiscal_empresa"  autofocus style="text-transform:uppercase;">
                                <option value="{{$empresa->respo_fiscal_empresa}}">{{old('respoFiscal_empresa', $empresa->respo_fiscal_empresa)}}</option>
                                <option value="NO RESPONSABLE (R-99-PN)">NO RESPONSABLE (R-99-PN)</option>
                                <option value="REGIMEN SIMPLE DE TRIBUTACIÓN (O-47)">REGIMEN SIMPLE DE TRIBUTACIÓN (O-47)</option>
                                <option value="GRAN CONTRIBUYENTE (O-13)">GRAN CONTRIBUYENTE (O-13)</option>
                                <option value="AUTORRETENEDOR (O-15)">AUTORRETENEDOR (O-15)</option>
                                <option value="AGENTE DE RETENCIÓN IVA(O-23)">AGENTE DE RETENCIÓN IVA(O-23)</option>
                            </select>
                            <label for="floatingInputGrid">RESPONSABILIDAD FISCAL:</label>
                            @error('respoFiscal_empresa')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="numeric" name="telefono_empresa" id="telefono_empresa" class="form-control" value="{{old('telefono_empresa', $empresa->telefono_empresa)}}" autofocus >
                            <label for="floatingInputGrid">TELÉFONO:</label>
                            @error('telefono_empresa')
                                <small>*{{$message}}</small>
                            @enderror
                        </div> 
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="email" name="correo_empresa" id="correo_empresa" class="form-control" value="{{old('correo_empresa', $empresa->email_empresa)}}" autofocus style="text-transform:uppercase;"> 
                            <label for="floatingInputGrid">CORREO ELECTRONICO:</label>
                            @error('correo_empresa')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" name="direccion_empresa" id="direccion_empresa" class="form-control" value="{{old('direccion_empresa', $empresa->direccion_empresa)}}" autofocus style="text-transform:uppercase;"> 
                            <label for="floatingInputGrid">DIRECCIÓN:</label>
                            @error('direccion_empresa')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="numeric" name="pais_empresa" id="pais_empresa" class="form-control" value="{{old('pais_empresa', $empresa->pais_empresa)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">PAÍS:</label>
                            @error('pais_empresa')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" name="ciudad_empresa" id="ciudad_empresa" class="form-control" value="{{old('ciudad_empresa', $empresa->ciudad_empresa)}}" autofocus style="text-transform:uppercase;"> 
                            <label for="floatingInputGrid">CIUDAD:</label>
                            @error('ciudad_empresa')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" name="departamento_empresa" id="departamento_empresa" class="form-control" value="{{old('departamento_empresa', $empresa->departamento_empresa)}}" autofocus style="text-transform:uppercase;"> 
                            <label for="floatingInputGrid">DEPARTAMENTO:</label>
                            @error('departamento_empresa')
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
$(document).ready(function(){
    $('#form_edit_empresa').submit(function(e){
        e.preventDefault();
        Swal.fire({
            text: 'SEGURO QUE DESEA ACTUALIZAR LA INFORMACIÓN DE ESTA EMPRESA?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'ACTUALIZADA!',
                'SE HA ACTUALIZADO UNA EMPRESA.',
                'success'
                )
                this.submit(); 
            }
        })
    })
})
</script> 

@endsection()