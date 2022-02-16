@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col"></div>
    <div class="col-10">
        <div class="card text-dark bg-light">
            <h2 class="text-center mt-3">CREAR EMPRESA</h2>
            
            <form class="m-4"  action="{{route('empresas.save')}}" method="POST">
                
                @csrf

                <div class="row g-2">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="nombre_empresa" id="nombre_empresa" value="{{old('nombre_empresa')}}" autofocus style="text-transform:uppercase">
                            <label for="floatingInput">NOMBRE</label>
                            @error('nombre_empresa')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating" >
                            <select class="form-select" name="tipo_empresa" id="tipo_empresa" value="{{old('tipo_empresa')}}" autofocus style="text-transform:uppercase">
                                <option value="">--SELECCIONE--</option>
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
                            <select class="form-select" name="tipoIden_empresa" id="tipoIden_empresa" value="{{old('tipoIden_empresa')}}" autofocus onchange="ShowSelected();" style="text-transform:uppercase">
                                <option value="">--SELECCIONE--</option>
                                <option value="NIT">NIT</option>
                                <option value="CÉDULA DE CIUDADANIA">CÉDULA DE CIUDADANIA</option>
                                <option value="TARJETA DE IDENTIDAD">TARJETA DE IDENTIDAD</option>
                                <option value="REGISTRO CIVIL">REGISTRO CIVIL</option>
                                <option value="PASAPORTE">PASAPORTE</option>
                                <option value="CÉDULA DE EXTRANJERÍA">CÉDULA DE EXTRANJERÍA</option>
                                <option value="TARJETA DE EXTRANJERÍA">TARJETA DE EXTRANJERÍA</option>
                                <option value="DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO">DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO</option>
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
                            <input type="number" name="numero_ident" id="numero_ident" class="form-control" value="{{old('numero_ident')}}" autofocus > 
                            <label for="floatingInputGrid" id="numero_identificacion"></label>
                            @error('numero_ident')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-floating" >
                            <input type="number" name="nitdv_empresa" id="nitdv_empresa" class="form-control" value="{{old('nitdv_empresa')}}" autofocus style="visibility: hidden"> 
                            <label for="floatingInputGrid" name="label_nit_dv_empresa" id="label_nit_dv_empresa" style="visibility: hidden">DV:</label>
                            
                        </div>
                    </div>
                    <!------------------------------------------>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating" >
                            <input type="number" name="actividad_empresa" id="actividad_empresa" class="form-control" value="{{old('actividad_empresa')}}" autofocus >
                            <label for="floatingInputGrid">ACTIVIDAD ECONÓMICA PRINCIPAL:</label>
                            @error('actividad_empresa')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select" name="respoIva_empresa" id="respoIva_empresa" value="{{old('respoIva_empresa')}}" autofocus style="text-transform:uppercase;">
                                <option value="">--SELECCIONE--</option>
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
                            <select class="form-select" name="respoFiscal_empresa" id="respoFiscal_empresa" value="{{old('respoFiscal_empresa')}}" autofocus style="text-transform:uppercase;">
                                <option value="">--SELECCIONE--</option>
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
                            <input type="number" name="telefono_empresa" id="telefono_empresa" class="form-control" value="{{old('telefono_empresa')}}" autofocus>
                            <label for="floatingInputGrid">TELÉFONO:</label>
                            @error('telefono_empresa')
                                <small>*{{$message}}</small>
                            @enderror
                        </div> 
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="email" name="correo_empresa" id="correo_empresa" class="form-control" value="{{old('correo_empresa')}}" autofocus style="text-transform:uppercase;"> 
                            <label for="floatingInputGrid">CORREO ELECTRONICO:</label>
                            @error('correo_empresa')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" name="direccion_empresa" id="direccion_empresa" class="form-control" value="{{old('direccion_empresa')}}" autofocus style="text-transform:uppercase;"> 
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
                            <input type="numeric" name="pais_empresa" id="pais_empresa" class="form-control" value="COLOMBIA" readonly autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">PAÍS:</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <label for="floatingInputGrid">DEPARTAMENTO:</label>
                            <select class="form-control"  name="departamento_empresa" id="departamento_empresa" value="{{old('departamento_empresa')}}" autofocus style="text-transform:uppercase">
                                <option value="">--SELECCIONE--</option>
                                @foreach($departamentoscol as $depacol)
                                    <option value="{{$depacol->id_departamentocol}}">{{$depacol->nombre_deptocol}}</option>
                                @endforeach
                            </select>
                            @error('departamento_empresa')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <label for="floatingInputGrid">MUNICIPIO:</label>
                            <select class="form-control" name="ciudad_empresa" id="ciudad_empresa" value="{{old('ciudad_empresa')}}" autofocus style="text-transform:uppercase">

                            </select>
                            <!-- <input type="text" name="ciudad_empresa" id="ciudad_empresa" class="form-control" value="{{old('ciudad_empresa')}}" autofocus style="text-transform:uppercase;">  -->
                            @error('ciudad_empresa')
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
                        <button class="btn btn-primary " onclick="Obtener(e);"  type="submit" id="boton-guardar" name="boton-guardar" >GUARDAR</button>
                    </div>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#departamento_empresa').select2();
        $('#ciudad_empresa').select2();
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#departamento_empresa').on('change', function(){
            var departamento_id = $(this).val();
            alert(departamento_id);
            if($.trim(departamento_id) != ''){
                $.get('empresasdeptomuni', {departamento_id: departamento_id}, function(municipios){
                    console.log(municipios);
                    $('#ciudad_empresa').empty();
                    $('#ciudad_empresa').append("<option value=''>--SELECCIONE UNA SEDE--</option>");
                    $.each(municipios, function(index, value){
                        $('#ciudad_empresa').append("<option value='"+ index + "'>" + value + "</option>");
                    })
                });
            }
        });
    });
</script>

<script type="text/javascript"> 
    function ShowSelected(){
        var option =document.getElementById("tipoIden_empresa").value;
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

@endsection 



