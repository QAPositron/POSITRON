@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col-md">
        <div class="col-md">
            <a type="button" class="btn btn-circle colorQA" href="{{route('novedadesdosimetria.search')}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left mt-1" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
            </a>
        </div> 
    </div>
    <div class="col-md">
        <h2 class="text-center">CREAR NUEVA NOVEDAD DE DOSIMETRÍA</h2>
    </div>
    <div class="col md"></div>
</div>
<br>
<div class="row">
    <div class="col md"></div>
    <div class="col-md-10">
        <div class="card text-dark bg-light">
            <br>
            <label class="px-4">SELECCIONE LA INFORMACIÓN DEL CONTRATO DE DOSIMETRÍA: </label>
            <div class="row p-4">
                <div class="col-md">
                    <div class="form-floating">
                        <select class="form-select" name="empresaDosimetria" id="empresaDosimetria" value="" autofocus style="text-transform:uppercase;">
                            <option value="">--SELECCIONE--</option>
                            @foreach($empresasDosi as $empdosi)
                                <option value="{{$empdosi->empresa_id}}">{{$empdosi->nombre_empresa}}</option>
                            @endforeach
                        </select>
                        <label for="floatingInputGrid">EMPRESA:</label>
                        @error('empresaDosimetria')
                            <small>*{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        <select class="form-select" name="contratos_empresadosi" id="contratos_empresadosi" value="" autofocus style="text-transform:uppercase">

                        </select>
                        <label for="floatingInputGrid">CONTRATOS:</label>
                        @error('contratos_empresadosi')
                            <small>*{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        <select class="form-select" name="sedes_empresadosi" id="sedes_empresadosi" value="" autofocus style="text-transform:uppercase">

                        </select>
                        <label for="floatingInputGrid">SEDES:</label>
                        @error('sedes_empresadosi')
                            <small>*{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        <select class="form-select" name="especialidades_empresadosi" id="especialidades_empresadosi" value="" autofocus style="text-transform:uppercase">

                        </select>
                        <label for="floatingInputGrid">ESPECIALIDADES:</label>
                        @error('especialidades_empresadosi')
                            <small>*{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row p-3">
                <div class="col-md"></div>
                <div class="col-md-5">
                    <div class="form-floating">
                        <select class="form-select" name="novedadesDosimetria" id="novedadesDosimetria" autofocus style="text-transform:uppercase">
                            <option value="">--SELECCIONE--</option>
                            <option value="1">NUEVO DOSÍMETRO</option>
                            <option value="2">RETIRO DE DOSÍMETRO</option>
                            <option value="3">CAMBIO DE TRABAJADOR</option>
                        </select>
                        <label for="floatingInputGrid">NOVEDAD:</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <select class="form-select" name="mesacambiar" id="mesacambiar" value="" autofocus style="text-transform:uppercase">
                            <option value="">--SELECCIONE--</option>
                        </select>
                        <label for="floatingInputGrid">MES A MODIFICAR:</label>
                    </div>
                </div>
                <div class="col-md"></div>
            </div>
        </div>
    </div>
    <div class="col-md"></div>
</div>
<br>
<div class="row">
    <div class="col-md"></div>
    <div class="col-md-10">
        <div class="card text-dark bg-light">
            <br>
            <br>
            <div id='tipoFormulario1' style="display: none; position: relative;">
                <h3 class="text-center">NOVEDAD: NUEVO DOSÍMETRO</h3>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        {{-- <label class="px-4 ">OPRIMA EL BOTÓN PARA AÑADIR UN NUEVO DOSÍMETRO: </label> --}}
                    </div>
                    <div class="col-2 d-grid gap-2">
                        <button class="btn colorQA" id="agregar" name="agregar" onclick="agregarFila()">NUEVO DOSÍMETRO</button>
                    </div>
                    <div class="col-md"></div>
                </div>
                <br>
                <div class="table table-responsive text-center px-4">
                    <table  class="table table-bordered" id="tablaAsignacionDosimetrosmn">
                        <thead class="text-center">
                            <th style='width: 200px'>TRABAJADOR / ÁREA</th>
                            <th style='width: 100px'>UBICACIÓN</th>
                            <th style='width: 100px'>DOSÍMETRO</th>
                            <th style='width: 100px'>HOLDER</th>
                            <th style='width: 100px'>OCUPACIÓN</th>
                            {{-- <th style='width: 110px'>ACCIONES</th> --}}
                        </thead>
                    </table>
                    
                </div>
            </div>
        
            <div id='tipoFormulario2' style="display: none; position: relative;">
                <h3 class="text-center">NOVEDAD: RETIRO DE DOSÍMETRO</h3>
                <br>
                
                <div class="table table-responsive text-center px-4">
                    <table  class="table table-bordered" id="tablaAsignacionDosimetrosmn">
                        <thead class="text-center">
                            <th style='width: 200px'>TRABAJADOR / ÁREA</th>
                            <th style='width: 100px'>UBICACIÓN</th>
                            <th style='width: 100px'>DOSÍMETRO</th>
                            <th style='width: 100px'>HOLDER</th>
                            <th style='width: 100px'>OCUPACIÓN</th>
                            <th style='width: 110px'>ACCIONES</th>
                        </thead>
                    </table>
                    
                </div>
            </div>
        
            <div id='tipoFormulario3' style="display: none; position: relative;">
                <h3 class="text-center">NOVEDAD: CAMBIO DE TRABAJADOR</h3>
                <br>
                <div class="table table-responsive text-center px-4">
                    <table  class="table table-bordered" id="tablaAsignacionDosimetrosmn">
                        <thead class="text-center">
                            <th style='width: 200px'>TRABAJADOR / ÁREA</th>
                            <th style='width: 100px'>UBICACIÓN</th>
                            <th style='width: 100px'>DOSÍMETRO</th>
                            <th style='width: 100px'>HOLDER</th>
                            <th style='width: 100px'>OCUPACIÓN</th>
                            <th style='width: 110px'>ACCIONES</th>
                        </thead>
                    </table>
                    
                </div>
            
            </div>
        </div>
    </div>
    <div class="col-md"></div>
</div>

<script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous">
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $(document).ready(function(){

        $('#empresaDosimetria').on('change', function(){
            var empresa_id = $(this).val();
            console.log(empresa_id);
            if($.trim(empresa_id) != ''){
                $.get('contratosDosim', {empresa_id: empresa_id}, function(contratos){
                    console.log("ESTOS SON LOS CONTRATOS");
                    console.log(contratos);
                    $('#contratos_empresadosi').empty();
                    $('#contratos_empresadosi').append("<option value=''>--SELECCIONE UN CONTRATO--</option>");
                    $.each(contratos, function(index, value){
                        console.log("id_contratodosimetria" +value.id_contratodosimetria);
                        var num = parseInt(value.codigo_contrato);
                        var n = num.toString().padStart(5,'0');
                        console.log("ESTE ES EL CODIGO" +n);
                        $('#contratos_empresadosi').append("<option value='"+ value.id_contratodosimetria + "'>" + n + "</option>");
                    })
                });
            }
        });
        var myFechaInicial;
        $('#contratos_empresadosi').on('change', function(){
            var contrato_id = $(this).val();
            var check = 0;
            if($.trim(contrato_id) != ''){
                $.get('sedescontDosi', {contrato_id: contrato_id}, function(sedes){
                    console.log(sedes);
                    $('#sedes_empresadosi').empty();
                    $('#sedes_empresadosi').append("<option value=''>--SELECCIONE UNA SEDE DEL CONTRATO--</option>");
                    $.each(sedes, function(index, value){
                        if(check != value){
                            $('#sedes_empresadosi').append("<option value='"+ index + "'>" + value + "</option>");
                            check = value; 
                        }
                    })
                });
                $.get('contdosisededepto', {contrato_id: contrato_id}, function(contratodosi){
                    console.log(contratodosi);
                    console.log("INFORMACION DEL CONTRATO"+contratodosi[0].id_contratodosimetria);
                    var fechainicio = contratodosi[0].fecha_inicio;
                    var fechafinal = contratodosi[0].fecha_finalizacion;
                    console.log(fechainicio);
                    myFechaInicial = new Date(fechainicio);
                    myFechaInicial.setMinutes(myFechaInicial.getMinutes() + myFechaInicial.getTimezoneOffset());
                    console.log("ESTA ES LA FECHA INICIAL" +myFechaInicial);
                    /* document.getElementById("fechainicio_contratodosi").value = fechainicio;
                    document.getElementById("fechafin_contratodosi").value = fechafinal; */
                    
                });
            }
        });
        $('#sedes_empresadosi').on('change', function(){
            var sede_id = $(this).val();
            if($.trim(sede_id) != ''){
                $.get('especialidadescontDosi', {sede_id: sede_id}, function(especialidades){
                    console.log("ESTAS SON LAS ESPECIALIDADES");
                    console.log(especialidades);
                    $('#especialidades_empresadosi').empty();
                    $('#especialidades_empresadosi').append("<option value=''>--SELECCIONE UNA ESPECIALIDAD DEL CONTRATO--</option>");
                    $.each(especialidades, function(index, value){
                        $('#especialidades_empresadosi').append("<option value='"+ index + "'>" + value + "</option>");
                    })
                });
            }
        });
        $('#especialidades_empresadosi').on('change', function(){
            var especialidad_id = $(this).val();
            $.get('mesactualcontdosisededepto', {especialidad_id: especialidad_id}, function(mesactual_trabjasig){
                console.log("ESTE ES EL MES ACTUAL**")
                console.log(mesactual_trabjasig);
                const vacio = JSON.stringify(mesactual_trabjasig);
                console.log("ESTE ES VACIO" +vacio);
                $('#mesacambiar').empty();
                $('#mesacambiar').append("<option value=''>--</option>");
                const meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
                
                if(vacio == '{}'){
                        console.log("ESTA EN VACIO**");
                    var r = new Date(new Date(myFechaInicial).setMonth(myFechaInicial.getMonth()+1));
                    var fechaesp = meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                    $('#mesacambiar').append("<option value='1'> 1 -  </option>");
                }else{
                    console.log("NO ESTA EN VACIO**");
                    $.each(mesactual_trabjasig, function(index, value){
                        console.log(value);
                        var r = new Date(new Date(myFechaInicial).setMonth(myFechaInicial.getMonth()+value-1));
                        console.log("ESTE ES EL MES ACTUAL"+r);  
                        var r2 = new Date(new Date(myFechaInicial).setMonth(myFechaInicial.getMonth()+value));    
                        console.log("ESTE ES EL MES SIGUEINTE AL ACTUAL"+r2);
                        var fechaesp = meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                        var fechaesp2 = meses[r2.getMonth()] + ' DE ' + r.getUTCFullYear();

                        var siguientemes = value+1;
                        console.log("MES SIGUIENTE" + siguientemes);
                        $('#mesacambiar').append("<option value='"+ value + "'>ACTUAL: " + value + " ("+ fechaesp + ")" + "</option>");
                        $('#mesacambiar').append("<option value='"+ siguientemes + "'>SIGUIENTE: " + siguientemes + " ("+ fechaesp2 + ")" + "</option>"); 
                    })
                }
            })
        });
        $('#novedadesDosimetria').on('change', function(){
            var novedad = document.getElementById("novedadesDosimetria").value;
            console.log("ESTA ES LA NOVEDAD" +novedad);
            var tipoNovedad1 = document.getElementById("tipoFormulario1");
            var tipoNovedad2 = document.getElementById("tipoFormulario2");
            var tipoNovedad3 = document.getElementById("tipoFormulario3");

            if(novedad == 1){
                console.log("ENTRAMOS A LA NOVEDAD 1");
                tipoNovedad1.style.display = "block";
            }else{
                tipoNovedad1.style.display= "none";
            }
            if(novedad == 2){
                console.log("ENTRAMOS A LA NOVEDAD 2");

                tipoNovedad2.style.display = "block";
            }else{
                tipoNovedad2.style.display= "none";
            }
            if(novedad == 3){
                console.log("ENTRAMOS A LA NOVEDAD 3");

                tipoNovedad3.style.display = "block";
            }else{
                tipoNovedad3.style.display= "none";
            }
        });
    })
</script>
@endsection()