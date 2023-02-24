@extends('layouts.app')
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
    <div class="col-7">
        <h2 class="text-center">NOVEDAD DE DOSIMETRÍA <br> NUEVO DOSÍMETRO</h2>
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
                        
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        <select class="form-select" name="contratos_empresadosi" id="contratos_empresadosi" value="" autofocus style="text-transform:uppercase">

                        </select>
                        <label for="floatingInputGrid">CONTRATOS:</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        <select class="form-select" name="sedes_empresadosi" id="sedes_empresadosi" value="" autofocus style="text-transform:uppercase">

                        </select>
                        <label for="floatingInputGrid">SEDES:</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        <select class="form-select" name="especialidades_empresadosi" id="especialidades_empresadosi" value="" autofocus style="text-transform:uppercase">

                        </select>
                        <label for="floatingInputGrid">ESPECIALIDADES:</label>
                    </div>
                </div>
            </div>
            <div class="row p-3">
                <div class="col-md"></div>
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
    <div class="col-md-12">
        <div class="card text-dark bg-light" id='Formulario1' style="display: none; position: relative;">
            <br>
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
            <div >

                <div class="table table-responsive text-center px-4">
                    <table  class="table table-bordered" id="tablaAsignacionDosimetrosmn">
                        <thead class="text-center">
                            <th style='width: 200px'>TRABAJADOR / ÁREA</th>
                            <th style='width: 100px'>UBICACIÓN</th>
                            <th style='width: 100px'>DOSÍMETRO</th>
                            <th style='width: 100px'>HOLDER</th>
                            <th style='width: 100px'>OCUPACIÓN</th>
                        </thead>
                        <tbody id="body_asignaciones">
                           
                            <tr>
                                <div class="table table-responsive text-center">
                                    <table class="table table-bordered" id="tabla_auxiliar">
                                        <tbody id="tr_control">
                                                
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table table-responsive text-center px-4">

                                    <form id="form_cambio_cantdosim" name="form_cambio_cantdosim" action="{{route('cambiocantdosim.save')}}" method="POST">
                                        @csrf
                                        <input type="number" hidden name="tipo_novedad" id="tipo_novedad" value="1">
                                        <input type="number" hidden name="mestrabj_asig" id="mestrabj_asig" value="">
                                        <input type="number" hidden name="id_contdosisededepto" id="id_contdosisededepto" value="">
                                        <input type="number" hidden name="id_contratodosimetriasede" id="id_contratodosimetriasede" value="">
                                        <input type="date" hidden name="primerDia_asigdosim" id="primerDia_asigdosim" value="">
                                        <input type="date" hidden name="ultimoDia_asigdosim" id="ultimoDia_asigdosim" value="">
                                        <input type="date" hidden name="fecha_dosim_enviado" id="fecha_dosim_enviado" value="">
                                        <input type="number" hidden name="dosi_control" id="dosi_control" value="">
                                        <input type="number" hidden name="dosi_torax" id="dosi_torax" value="">
                                        <input type="number" hidden name="dosi_area" id="dosi_area" value="">
                                        <input type="number" hidden name="dosi_caso" id="dosi_caso" value="">
                                        <input type="number" hidden name="dosi_cristalino" id="dosi_cristalino" value="">
                                        <input type="number" hidden name="dosi_muñeca" id="dosi_muñeca" value="">
                                        <input type="number" hidden name="dosi_dedo" id="dosi_dedo" value="">

                                        <table class="table table-bordered" id="tabla_adicional">
                                            <tbody id="tr_newAsignacion">

                                            </tbody>
                                        </table>
                                        <br>
                                        <div class="row">
                                            <div class="col"></div>
                                            <div class="col-10">
                                                <label for="floatingInputGrid"><b>NOTAS Y OBSERVACIONES:</b></label>
                                                <div class="card">
                                                    <div class="card-body" id="textCard1">
                                                      
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md text-start">
                                                <button class="btn btn-circle colorQA" onclick="Generarnotas1()" type="button" id="notas" name="notas" role="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5ZM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5Z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col"></div>
                                            <div class="col">
                                                <div class="d-grid gap-2 col-6 mx-auto">
                                                    <button id="assignBtn" class="btn colorQA" type="submit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                                                        </svg> <br> GUARDAR ASIGNACIÓN
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="d-grip gap-2 col-6 mx-auto">
                                                    <a href="" class="btn btn-danger " type="button" id="cancelar" name="cancelar" role="button">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                                                        </svg> 
                                                        <br> CANCELAR ASIGNACIÓN
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col"></div>
                                        </div>
                                    </form>
                                </div>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card text-dark bg-light" id='Formulario2' style="display: none; position: relative;">
            <br>
            <br>
            <div class="row">
                <div class="col-md-5">
                </div>
                <div class="col-2 d-grid gap-2">
                    <button class="btn colorQA" id="agregar2" name="agregar2" onclick="agregarFila()">NUEVO DOSÍMETRO</button>
                </div>
                <div class="col-md"></div>
            </div>
            <br>
            <div >
                <div class="table table-responsive text-center px-4">
                    <form id="form_cambio_cantdosim2" name="form_cambio_cantdosim2" action="{{route('cambiocantdosimesig.save')}}" method="POST">
                        @csrf
                        <input type="number" hidden name="tipo_novedad" id="tipo_novedad" value="1">
                        <input type="number" hidden name="mes_asig_siguiente" id="mes_asig_siguiente" value="">
                        <input type="number" hidden name="contdosisededepto" id="contdosisededepto" value="">
                        <input type="number" hidden name="contratodosimetriasede" id="contratodosimetriasede" value="">
                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating">
                                    <input type="date" class="form-control" name="primerDia_asigdosim2" id="primerDia_asigdosim2" onchange="fechaUltimoDia();" >
                                    <label for="floatingInputGrid">PRIMER DÍA</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                    <input type="date" class="form-control" name="ultimoDia_asigdosim2" id="ultimoDia_asigdosim2" >
                                    <label for="floatingInputGrid">ÚLTIMO DÍA:</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating">
                                    <input type="date" class="form-control" name="fecha_envio_dosim_asignado" id="fecha_envio_dosim_asignado" >
                                    <label for="floatingInputGrid">FECHA ENVIO</label>
                                    
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                    <input type="date" class="form-control" name="fecha_recibido_dosim_asignado" id="fecha_recibido_dosim_asignado" >
                                    <label for="floatingInputGrid">FECHA RECIBIDO</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                    <input type="date" class="form-control" name="fecha_devuelto_dosim_asignado" id="fecha_devuelto_dosim_asignado" >
                                    <label for="floatingInputGrid">FECHA DEVUELTO</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <table  class="table table-bordered" id="tablaAsignacionDosimetrosmn">
                            <thead class="text-center">
                                <th style='width: 200px'>TRABAJADOR / ÁREA</th>
                                <th style='width: 120px'>UBICACIÓN</th>
                                <th style='width: 100px'>DOSÍMETRO</th>
                                <th style='width: 100px'>HOLDER</th>
                                <th style='width: 100px'>OCUPACIÓN</th>
                            </thead>
                            <tbody id="body_asignaciones2">
                                
                                <table class="table" id="tabla_adicional2">
                                    <tbody id="tr_newAsignacion2">

                                    </tbody>
                                </table>
                            </tbody>
                        </table>
                            
                        
                        <div class="row">
                            <div class="col"></div>
                            <div class="col-10">
                                <label for="floatingInputGrid"><b>NOTAS Y OBSERVACIONES:</b></label>
                                <div class="card">
                                    <div class="card-body" id="textCard2">
                                      
                                    </div>
                                </div>
                            </div>
                            <div class="col-md text-start">
                                <button class="btn btn-circle colorQA" onclick="Generarnotas2()" type="button" id="notas" name="notas" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5ZM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5Z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col"></div>
                            <div class="col">
                                <div class="d-grid gap-2 col-6 mx-auto">
                                    <button id="assignBtn" class="btn colorQA" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                                        </svg> <br> GUARDAR ASIGNACIÓN
                                    </button>
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-grip gap-2 col-6 mx-auto">
                                    <a href="" class="btn btn-danger " type="button" id="cancelar" name="cancelar" role="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                                        </svg> 
                                        <br> CANCELAR ASIGNACIÓN
                                    </a>
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-grid gap-2 col-6 mx-auto">
                                    <button onclick="limpiar()"class="btn btn-primary"  type="button" id="limpiar_asig" name="limpiar_asig" role="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                        </svg> <br> LIMPIAR ASIGNACIONES
                                    </button>
                                </div>
                            </div>
                            <div class="col"></div>
                        </div>
                    </form>
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
                    $('#especialidades_empresadosi').empty();
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
        var selectDosimetros = document.createElement("select");
        @foreach($dosimetrosDisponibles as $dosimetros)
            option = document.createElement("option");
            option.value = '{{$dosimetros->id_dosimetro}}';
            option.text = '{{$dosimetros->codigo_dosimeter}}';
            selectDosimetros.appendChild(option);
        @endforeach

        var selectDosimetrosEzclip = document.createElement("select");
        @foreach($dosimetrosDisponiblesEzclip as $dosimetrosezclip)
            option = document.createElement("option");
            option.value = '{{$dosimetrosezclip->id_dosimetro}}';
            option.text = '{{$dosimetrosezclip->codigo_dosimeter}}';
            selectDosimetrosEzclip.appendChild(option);
        @endforeach

        var selectHolders = document.createElement("select");
        @foreach($holdersDisponibles as $holders)
            option = document.createElement("option");
            option.value = '{{$holders->id_holder}}';
            option.text = '{{$holders->codigo_holder}}';
            selectHolders.appendChild(option);
        @endforeach
        $('#especialidades_empresadosi').on('change', function(){
            var especialidad_id = $(this).val();
            $.get('mesactualcontdosisededepto', {especialidad_id: especialidad_id}, function(mesactual_trabjasig){
                console.log("ESTE ES EL MES ACTUAL**");
                console.log(mesactual_trabjasig);
                const vacio = mesactual_trabjasig.mes_asignacion;
                console.log("ESTE ES VACIO" +vacio);
                $('#mesacambiar').empty();
                $('#mesacambiar').append("<option value=''>--</option>");
                const meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
                
                if(vacio == '{}'){
                    console.log("ESTA EN VACIO**");
                    var r = new Date(new Date(myFechaInicial).setMonth(myFechaInicial.getMonth()+1));
                    var fechaesp = meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                    $('#mesacambiar').append("<option value='1'> 1 - "+ meses[myFechaInicial.getMonth()]+" DE "+myFechaInicial.getUTCFullYear()+"  </option>");
                }else{
                    console.log("NO ESTA EN VACIO**");
                    console.log(mesactual_trabjasig.mes_asignacion);
                    var value = mesactual_trabjasig.mes_asignacion;
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

                };
                $('#mesacambiar').on('change', function(){
                    var mes = $(this).val();
                    Formulario1.style.display= "none";
                    Formulario2.style.display= "none";
                    var dosi_control = 0;
                    var dosi_torax= 0;
                    var dosi_area = 0;
                    var dosi_caso = 0;
                    var dosi_cristalino = 0;
                    var dosi_muñeca = 0;
                    var dosi_dedo = 0;

                    console.log("ESTE ES EL MES SELECCIONADO" +mes);
                    console.log(mesactual_trabjasig.mes_asignacion);
                    var consultaMesactual = mesactual_trabjasig.mes_asignacion;
                    console.log("LA CONSULTA"+consultaMesactual);

                    if(mes == consultaMesactual){
                        Formulario1.style.display= "block";
                    }else if (mes > consultaMesactual){
                        Formulario2.style.display= "block";
                    }else{
                        Formulario2.style.display= "none";
                    }
                    var contdosisededepto_id = document.getElementById("especialidades_empresadosi").value;
                    var contratodosimetriasede_id  = document.getElementById("sedes_empresadosi").value;
                    $.get('dosiasginadoscontrolmesactual', {contdosisededepto_id: contdosisededepto_id, mes: consultaMesactual}, function(asignacionescontrolmesactual){
                        console.log("ASIGNACIONES CONTROL DEL MES ACTUAL");
                        console.log(asignacionescontrolmesactual);
                        $('#tr_control').html("");
                        if(mes > consultaMesactual){
                            //////////////// PARA CUANDO SELECCIONA EL MES SIGUIENTE AL ACTUAL DEL CONTRATO ///////////////////////
                            /* alert("CNTROL PARA EL MES SIGUEINTE AL ACTUAL"); */
                            for(var i=0; i<asignacionescontrolmesactual.length; i++){
                                if(asignacionescontrolmesactual[i].dosimetro_uso != 'FALSE'){
                                    var disacont = 'disabled';
                                    var id_dosimetro = asignacionescontrolmesactual[i].id_dosimetro;
                                    var codigo_dosimeter = asignacionescontrolmesactual[i].codigo_dosimeter;
                                    var id_ocupacion = asignacionescontrolmesactual[i].ocupacion;  
                                    var ocupacion = asignacionescontrolmesactual[i].ocupacion;
                                }else{
                                    var id_dosimetro = '';
                                    var codigo_dosimeter = '---';
                                    var id_ocupacion = '';
                                    var ocupacion = '---';
                                }
                                
                                var tr = `<tr id="`+asignacionescontrolmesactual[i].id_dosicontrolcontdosisedes+`control">
                                        <td colspan='2' style='width: 75px' class='align-middle'>CONTROL</td>
                                        <td style='width: 190px' class='align-middle'>
                                            
                                            <select class="form-select cambiar"  name="id_dosimetro_asigdosimControl[]" id="id_dosimetro_asigdosimControl" ${disacont} >
                                                <option value="`+id_dosimetro+`">`+codigo_dosimeter+`</option>
                                                ${selectDosimetros.innerHTML}
                                            </select>
                                        </td>
                                        <td style='width: 163px' class='align-middle text-center'>NA</td>
                                        <td style='width: 185px' class='align-middle text-center'>
                                           
                                            <select class="form-select cambiar" name="ocupacion_asigdosimControl[]" id="ocupacion_asigdosimControl" ${disacont} >
                                                <option value="`+id_ocupacion+`">`+ocupacion+`</option>
                                                <option value="T">T = TELETERAPIA</option>
                                                <option value="BQ">BQ = BRAQUITERAPIA</option>
                                                <option value="MN">MN = MEDICINA NUCLEAR</option>
                                                <option value="GI">GI = GAMMAGRAFÍA INDUSTRIAL</option>
                                                <option value="MF">MF = MEDIDORES FIJOS</option>
                                                <option value="IV">IV = INVESTIGACIÓN</option>
                                                <option value="DN">DN = DENSÍMETRO NUCLEAR</option>
                                                <option value="MM">MM = MEDIDORES MÓVILES</option>
                                                <option value="E">E = DOCENCIA</option>
                                                <option value="PR">PR = PERFILAJE Y REGISTRO</option>
                                                <option value="TR">TR = TRAZADORES</option>
                                                <option value="HD">HD = HEMODINAMIA</option>
                                                <option value="OD">OD = RAYOS X ODONTOLÓGICO</option>
                                                <option value="RX">RX = RADIODIAGNÓSTICO</option>
                                                <option value="FL">FL = FLUOROSCOPIA</option>
                                                <option value="AM">AM = APLICACIONES MÉDICAS</option>
                                                <option value="AI">AI = APLICACIONES INDUSTRIALES</option>
                                            </select>
                                        </td>
                                    </tr>`;
                                $("#body_asignaciones2").append(tr);
                            } 
                        }else{
                            //////////////// PARA CUANDO SELECCIONA EL MES ACTUAL DEL CONTRATO ///////////////////////
                            $('#body_asignaciones2').html("");
                            /* alert("CNTROL PARA EL MES ACTUAL"); */
                            for(var i=0; i<asignacionescontrolmesactual.length; i++){
                                
                                var tr = `<tr>
                                        <td colspan='2' class='align-middle'>CONTROL</td>
                                        <td class="text-center" style='width: 208px'class='align-middle'>`
                                            +asignacionescontrolmesactual[i].codigo_dosimeter+
                                        `</td>
                                        <td class="text-center align-middle" style='width: 208px' >NA</td>
                                        <td class="text-center align-middle" style='width: 208px' >`+asignacionescontrolmesactual[i].ocupacion+`</td>
                                            
                                    </tr>`;
                                $("#tr_control").append(tr);
                                
                                dosi_control += 1;
                                console.log("EL VALOR DEL DOSI CONTROL PARA EL MES ACTUAL");
                                console.log(dosi_control);
                            }; 
                            document.getElementById("dosi_control").value = dosi_control;
                        }
                    });
                    $.get('dosiasginadosmesactual', {contratodosimetriasede_id: contratodosimetriasede_id, contdosisededepto_id: contdosisededepto_id, mes: consultaMesactual}, function(asignacionesmesactual){
                        console.log("ASIGNACIONES DEL MES ACTUAL");
                        console.log(asignacionesmesactual);
                        $('#body_asignaciones').html("");
                        var sede = document.getElementById("sedes_empresadosi");
                        var id_sede = sede.options[sede.selectedIndex].text;
                        console.log("SEDE:" +id_sede);

                        var selectTrabajadores = document.createElement("select");
                        $.get('trabajadoresempresa', {id_sede: id_sede}, function(trabajadores){
                            console.log(trabajadores);
                            const vacio = JSON.stringify(trabajadores);
                            console.log("ESTOS SON LOS TRABAJADORES" + vacio);
                            for(var i = 0; i < trabajadores.length; i++){
                                option = document.createElement("option");
                                option.value = trabajadores[i].id_persona;
                                option.text = trabajadores[i].primer_nombre_persona+` `+trabajadores[i].primer_apellido_persona+` `+trabajadores[i].segundo_apellido_persona;
                                selectTrabajadores.appendChild(option);
                            }
                            console.log(selectTrabajadores.innerHTML);  
                                                
                            if(mes > consultaMesactual){
                                /* alert("ASIGNACIONES PARA EL MES SIGUIENTE AL ACTUAL"); */
                                for(var i=0; i<asignacionesmesactual.length; i++){
                                    if(asignacionesmesactual[i].dosimetro_uso != 'FALSE'){
                                        var dis = 'disabled';
                                        var id_dosimetro = asignacionesmesactual[i].id_dosimetro;
                                        var codigo_dosimeter = asignacionesmesactual[i].codigo_dosimeter;
                                        var id_holder = asignacionesmesactual[i].id_holder;
                                        var codigo_holder = asignacionesmesactual[i].codigo_holder;
                                        var id_ocupacion = asignacionesmesactual[i].ocupacion;
                                        var ocupacion = asignacionesmesactual[i].ocupacion;
                                        document.getElementById('agregar2').disabled = true;
                                    }else{
                                        document.getElementById('agregar2').disabled = false;
                                        var id_dosimetro = '';
                                        var codigo_dosimeter = '---';
                                        var id_holder = '';
                                        var codigo_holder = '---';
                                        var id_ocupacion = '';
                                        var ocupacion = '---';
                                    }
                                    var mestrabj_asig = document.getElementById("mesacambiar").value;
                                    var id_contdosisededepto = document.getElementById("especialidades_empresadosi").value; 
                                    var id_contratodosimetriasede =  document.getElementById("sedes_empresadosi").value; 
                                    document.getElementById("mes_asig_siguiente").value = mestrabj_asig;
                                    document.getElementById("contdosisededepto").value = id_contdosisededepto;
                                    document.getElementById("contratodosimetriasede").value = id_contratodosimetriasede;
                                    
                                    if(asignacionesmesactual[i].codigo_holder != null){

                                        var tr = `<tr id="`+asignacionesmesactual[i].id_trabajadordosimetro+`">
                                            <td class='align-middle'>
                                                <input type="text" name="id_trabj_asigdosim[]" id="id_trabj_asigdosim_mesdesp`+asignacionesmesactual[i].id_persona+`" class="form-control id_trabj_asigdosim" value="`+asignacionesmesactual[i].id_persona+`" hidden>
                                                <select class="form-select"  name="id_trabj_asigdosim[]" id="id_trabj_asigdosim`+asignacionesmesactual[i].id_persona+`" disabled>
                                                    <option value="`+asignacionesmesactual[i].id_persona+`">`+asignacionesmesactual[i].primer_nombre_persona+` `+asignacionesmesactual[i].primer_apellido_persona+` `+asignacionesmesactual[i].segundo_apellido_persona+` `+`</option>
                                                    ${selectTrabajadores.innerHTML}
                                                </select>
                                            </td>
                                            <td class='align-middle'><input type="text" name="ubicacion_asigdosim[]" id="ubicacion_asigdosim" class="form-control" value="`+asignacionesmesactual[i].ubicacion+`" readonly></td>
                                            <td class='align-middle'>
                                                <select class="form-select cambiar"  name="id_dosimetro_asigdosim[]" id="id_dosimetro_asigdosim" ${dis} >
                                                    <option value="`+id_dosimetro+`">`+codigo_dosimeter+`</option>
                                                    ${selectDosimetrosEzclip.innerHTML}
                                                </select>
                                            </td>
                                            <td class='align-middle'>
                                                <select class="form-select cambiar"  name="id_holder_asigdosim[]" id="id_holder_asigdosim" ${dis} >
                                                    <option value="`+id_holder+`">`+codigo_holder+`</option>
                                                    ${selectHolders.innerHTML}
                                                </select>
                                            </td>
                                            <td class='align-middle'>
                                                <select class="form-select cambiar"  name="id_ocupacion_asigdosim[]" id="id_ocupacion_asigdosim" ${dis} >
                                                    <option value="`+id_ocupacion+`">`+ocupacion+`</option>
                                                    <option value="T">T = TELETERAPIA</option>
                                                    <option value="BQ">BQ = BRAQUITERAPIA</option>
                                                    <option value="MN">MN = MEDICINA NUCLEAR</option>
                                                    <option value="GI">GI = GAMMAGRAFÍA INDUSTRIAL</option>
                                                    <option value="MF">MF = MEDIDORES FIJOS</option>
                                                    <option value="IV">IV = INVESTIGACIÓN</option>
                                                    <option value="DN">DN = DENSÍMETRO NUCLEAR</option>
                                                    <option value="MM">MM = MEDIDORES MÓVILES</option>
                                                    <option value="E">E = DOCENCIA</option>
                                                    <option value="PR">PR = PERFILAJE Y REGISTRO</option>
                                                    <option value="TR">TR = TRAZADORES</option>
                                                    <option value="HD">HD = HEMODINAMIA</option>
                                                    <option value="OD">OD = RAYOS X ODONTOLÓGICO</option>
                                                    <option value="RX">RX = RADIODIAGNÓSTICO</option>
                                                    <option value="FL">FL = FLUOROSCOPIA</option>
                                                    <option value="AM">AM = APLICACIONES MÉDICAS</option>
                                                    <option value="AI">AI = APLICACIONES INDUSTRIALES</option>
                                                </select>
                                            </td>
                                            
                                        </tr>`;
                                        $("#body_asignaciones2").append(tr);
                                    }else{
                                        var tr = `<tr id="`+asignacionesmesactual[i].id_trabajadordosimetro+`">
                                            <td class='align-middle'>
                                                <input type="text" name="id_trabj_asigdosim_null[]" id="id_trabj_asigdosim_null_mesdesp`+asignacionesmesactual[i].id_persona+`" class="form-control" value="`+asignacionesmesactual[i].id_persona+`" hidden>
                                                <select class="form-select"  name="id_trabj_asigdosim_null[]" id="id_trabj_asigdosim_null`+asignacionesmesactual[i].id_persona+`" disabled>
                                                    <option value="`+asignacionesmesactual[i].id_persona+`">`+asignacionesmesactual[i].primer_nombre_persona+` `+asignacionesmesactual[i].primer_apellido_persona+` `+asignacionesmesactual[i].segundo_apellido_persona+` `+`</option>
                                                    ${selectTrabajadores.innerHTML}
                                                </select>
                                            </td>
                                            <td class='align-middle text-center'><input type="text" name="ubicacion_asigdosim_null[]" id="ubicacion_asigdosim_null" class="form-control" value="`+asignacionesmesactual[i].ubicacion+`" readonly></td>
                                            <td class='align-middle text-center'>
                                                <select class="form-select cambiar"  name="id_dosimetro_asigdosim_null[]" id="id_dosimetro_asigdosim_null" ${dis}>
                                                    <option value="`+id_dosimetro+`">`+codigo_dosimeter+`</option>
                                                    ${selectDosimetros.innerHTML}
                                                </select>
                                            </td>
                                            <td class='align-middle text-center'> NA </td>
                                            <td class='align-middle text-center'>
                                                <select class="form-select cambiar"  name="id_ocupacion_asigdosim_null[]" id="id_ocupacion_asigdosim_null" ${dis}>
                                                    <option value="`+id_ocupacion+`">`+ocupacion+`</option>
                                                    <option value="T">T = TELETERAPIA</option>
                                                    <option value="BQ">BQ = BRAQUITERAPIA</option>
                                                    <option value="MN">MN = MEDICINA NUCLEAR</option>
                                                    <option value="GI">GI = GAMMAGRAFÍA INDUSTRIAL</option>
                                                    <option value="MF">MF = MEDIDORES FIJOS</option>
                                                    <option value="IV">IV = INVESTIGACIÓN</option>
                                                    <option value="DN">DN = DENSÍMETRO NUCLEAR</option>
                                                    <option value="MM">MM = MEDIDORES MÓVILES</option>
                                                    <option value="E">E = DOCENCIA</option>
                                                    <option value="PR">PR = PERFILAJE Y REGISTRO</option>
                                                    <option value="TR">TR = TRAZADORES</option>
                                                    <option value="HD">HD = HEMODINAMIA</option>
                                                    <option value="OD">OD = RAYOS X ODONTOLÓGICO</option>
                                                    <option value="RX">RX = RADIODIAGNÓSTICO</option>
                                                    <option value="FL">FL = FLUOROSCOPIA</option>
                                                    <option value="AM">AM = APLICACIONES MÉDICAS</option>
                                                    <option value="AI">AI = APLICACIONES INDUSTRIALES</option>
                                                </select>
                                            </td>
                                            
                                        </tr>`;
                                        $("#body_asignaciones2").append(tr);
                                        
                                    }
                                }
                            }else{
                                $('#body_asignaciones2').html("");
                                /* alert("ASIGNACIONES PARA EL MES ACTUAL"); */
                                for(var i=0; i<asignacionesmesactual.length; i++){
                                    var fechaEnviado = asignacionesmesactual[i].fecha_dosim_enviado;
                                    document.getElementById("fecha_dosim_enviado").value = fechaEnviado;
                                    var primerDiaUso = asignacionesmesactual[i].primer_dia_uso;
                                    document.getElementById("primerDia_asigdosim").value = primerDiaUso;
                                    var ultimoDiaUso = asignacionesmesactual[i].ultimo_dia_uso;
                                    document.getElementById("ultimoDia_asigdosim").value = ultimoDiaUso;

                                    if(asignacionesmesactual[i].codigo_holder != null){

                                        var tr = `<tr>
                                            <td class='align-middle'>`+asignacionesmesactual[i].primer_nombre_persona+` `+asignacionesmesactual[i].primer_apellido_persona+` `+asignacionesmesactual[i].segundo_apellido_persona+` `+`</td>
                                            <td class='align-middle text-center'>`+asignacionesmesactual[i].ubicacion+`</td>
                                            <td class='align-middle text-center'>`+asignacionesmesactual[i].codigo_dosimeter+`</td>
                                            <td class='align-middle text-center'>`+asignacionesmesactual[i].codigo_holder+`</td>
                                            <td class='align-middle text-center'>`+asignacionesmesactual[i].ocupacion+`</td>
                                            
                                        </tr>`;
                                        $("#body_asignaciones").append(tr);
                                    }else{
                                        var tr = `<tr>
                                            <td class='align-middle'>`+asignacionesmesactual[i].primer_nombre_persona+` `+asignacionesmesactual[i].primer_apellido_persona+` `+asignacionesmesactual[i].segundo_apellido_persona+` `+`</td>
                                            <td class='align-middle text-center'>`+asignacionesmesactual[i].ubicacion+`</td>
                                            <td class='align-middle text-center'>`+asignacionesmesactual[i].codigo_dosimeter+`</td>
                                            <td class='align-middle text-center'> NA </td>
                                            <td class='align-middle text-center'>`+asignacionesmesactual[i].ocupacion+`</td>
                                            
                                        </tr>`;
                                        $("#body_asignaciones").append(tr);
                                        
                                    }
                                    if(asignacionesmesactual[i].ubicacion == 'TORAX'){
                                        dosi_torax += 1;
                                    }else if(asignacionesmesactual[i].ubicacion == 'CRISTALINO'){
                                        dosi_cristalino += 1;
                                    }else if(asignacionesmesactual[i].ubicacion == 'MUÑECA'){
                                        dosi_muñeca += 1 ;
                                    }else if(asignacionesmesactual[i].ubicacion == 'ANILLO'){
                                        dosi_dedo += 1;
                                    }
                                    
                                    /* document.getElementById("dosi_control").value = dosi_control; */
                                    
                                    document.getElementById("dosi_torax").value = dosi_torax;
                                    document.getElementById("dosi_cristalino").value = dosi_cristalino;
                                    document.getElementById("dosi_muñeca").value = dosi_muñeca;
                                    document.getElementById("dosi_dedo").value = dosi_dedo;

                                }
                            }
                        });
                    });
                    
                });
            })
        });
    });
    function agregarFila(){
    
        var mes = document.getElementById("mesacambiar").value;
        
        /* alert("EL MES SELECCIONADO es"+mes); */
        var especialidad_id= document.getElementById("especialidades_empresadosi").value;

        $('#mesacambiar').on('change', function(){
            $('#tr_newAsignacion').html("");
            $('#botones').html("");
        })
        
        var selectTrabajadores = document.createElement("select");
        var selectDosimetros = document.createElement("select");
        var selectDosimetrosEzclip = document.createElement("select");
        var selectHolders = document.createElement("select");
        var id_empresa = document.getElementById("empresaDosimetria").value;
        var sede = document.getElementById("sedes_empresadosi");
        var id_sede = sede.options[sede.selectedIndex].text;
        
        console.log("SEDE:" +id_sede);
        $.get('trabajadoresempresa', {id_sede: id_sede}, function(trabajadores){
            console.log(trabajadores);
            const vacio = JSON.stringify(trabajadores);
            console.log("ESTOS SON LOS TRABAJADORES" + vacio);
            for(var i = 0; i < trabajadores.length; i++){
                option = document.createElement("option");
                option.value = trabajadores[i].id_persona;
                option.text = trabajadores[i].primer_nombre_persona+` `+trabajadores[i].primer_apellido_persona+` `+trabajadores[i].segundo_apellido_persona;
                selectTrabajadores.appendChild(option);
            }
            console.log(selectTrabajadores.innerHTML);

            @foreach($dosimetrosDisponibles as $dosimetros)
                option = document.createElement("option");
                option.value = '{{$dosimetros->id_dosimetro}}';
                option.text = '{{$dosimetros->codigo_dosimeter}}';
                selectDosimetros.appendChild(option);
            @endforeach
            console.log(selectDosimetros.innerHTML);

            
            @foreach($dosimetrosDisponiblesEzclip as $dosimetrosezclip)
                option = document.createElement("option");
                option.value = '{{$dosimetrosezclip->id_dosimetro}}';
                option.text = '{{$dosimetrosezclip->codigo_dosimeter}}';
                selectDosimetrosEzclip.appendChild(option);
            @endforeach

            @foreach($holdersDisponibles as $holders)
                option = document.createElement("option");
                option.value = '{{$holders->id_holder}}';
                option.text = '{{$holders->codigo_holder}}';
                selectHolders.appendChild(option);
            @endforeach
            console.log(selectHolders.innerHTML);

            $.get('mesactualcontdosisededepto', {especialidad_id: especialidad_id}, function(mesactual_trabjasig){
                /* console.log("CONSULTA MES ACTUAL" + JSON.stringify(mesactual_trabjasig)); */
                var consultaMesactual = mesactual_trabjasig.mes_asignacion;
                if(mes > consultaMesactual){

                    /* alert("si entro, el mes siguiente al actual"); */

                    var mestrabj_asig = document.getElementById("mesacambiar").value;
                    var id_contdosisededepto = document.getElementById("especialidades_empresadosi").value; 
                    var id_contratodosimetriasede =  document.getElementById("sedes_empresadosi").value; 
                    document.getElementById("mes_asig_siguiente").value = mestrabj_asig;
                    document.getElementById("contdosisededepto").value = id_contdosisededepto;
                    document.getElementById("contratodosimetriasede").value = id_contratodosimetriasede;
                    alert("SE TUVIERON Q GUARDAR"+document.getElementById("mesacambiar").value);


                    document.getElementById("tr_newAsignacion2")
                    .insertRow(-1).innerHTML += 
                        `<td style="width: 27.30%">
                            <select class="form-select " name="id_trabajador_asig[]"  id="id_trabajador_asig" style="text-transform:uppercase">
                                <option value="">----</option>
                                ${selectTrabajadores.innerHTML}
                            </select>
                        
                        </td>
                        <td style="width: 14.50%">
                            <select class="form-select"  name="id_ubicacion_asig[]" id="id_ubicacion_asig" style="text-transform:uppercase">
                                <option value="">----</option>
                                <option value="TORAX">TORAX</option>
                                <option value="CRISTALINO">CRISTALINO</option>
                                <option value="ANILLO">ANILLO</option>
                                <option value="MUÑECA">MUÑECA</option>
                                <option value="CONTROL">CONTROL</option>
                                <option value="AREA">ÁREA</option>
                                <option value="CASO">CASO</option>
                            </select>
                        </td> 
                        <td style="width: 15.0%">
                            <select class="form-select"  name="id_dosimetro_asig[]" id="id_dosimetro_asig" style="text-transform:uppercase">
                                <option value="">----</option>
                                ${selectDosimetrosEzclip.innerHTML}
                                ${selectDosimetros.innerHTML}
                            </select>
                            @error('id_dosimetro_asig') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </td>
                        <td style="width: 14.20%">
                            <select class="form-select "  name="id_holder_asig[]" id="id_holder_asig" style="text-transform:uppercase">
                                <option value="">----</option>
                                <option value="NA">N.A</option>
                                ${selectHolders.innerHTML}
                            </select>
                        </td>
                        <td style="width: 14.20%">
                            <select class="form-select @error('ocupacion_asig') is-invalid @enderror" name="ocupacion_asig[]" id="ocupacion_asig" style="text-transform:uppercase">
                                <option value="">----</option>
                                <option value="T"> TELETERAPIA</option>
                                <option value="BQ">BRAQUITERAPIA</option>
                                <option value="MN">MEDICINA NUCLEAR</option>
                                <option value="GI">GAMMAGRAFÍA INDUSTRIAL</option>
                                <option value="MF">MEDIDORES FIJOS</option>
                                <option value="IV">INVESTIGACIÓN</option>
                                <option value="DN">DENSÍMETRO NUCLEAR</option>
                                <option value="MM">MEDIDORES MÓVILES</option>
                                <option value="E"> DOCENCIA</option>
                                <option value="PR">PERFILAJE Y REGISTRO</option>
                                <option value="TR">TRAZADORES</option>
                                <option value="HD">HEMODINAMIA</option>
                                <option value="OD">RAYOS X ODONTOLÓGICO</option>
                                <option value="RX">RADIODIAGNÓSTICO</option>
                                <option value="FL">FLUOROSCOPIA</option>
                                <option value="AM">APLICACIONES MÉDICAS</option>
                                <option value="AI">APLICACIONES INDUSTRIALES</option>
                            </select>
                            @error('ocupacion_asig') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </td>   
                        <td class="text-center" style="width: 24.80%">
                            <button id="" class="btn btn-danger"  type="button" onclick="eliminarFilaform2(this)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </button>
                        </td>
                    `;
                }else{
                    /* alert("si entrO, es el MES actual"); */

                    var mestrabj_asig = document.getElementById("mesacambiar").value;
                    var id_contdosisededepto = document.getElementById("especialidades_empresadosi").value; 
                    var id_contratodosimetriasede =  document.getElementById("sedes_empresadosi").value; 
                    document.getElementById("mestrabj_asig").value = mestrabj_asig;
                    document.getElementById("id_contdosisededepto").value = id_contdosisededepto;
                    document.getElementById("id_contratodosimetriasede").value = id_contratodosimetriasede;

                    document.getElementById("tabla_adicional")
                    .insertRow(-1).innerHTML += 
                        `<td style="width: 32.30%">
                            <select class="form-select id_trabajador_asig" name="id_trabajador_asig[]"  id="id_trabajador_asig" style="text-transform:uppercase">
                                <option value="">----</option>
                                ${selectTrabajadores.innerHTML}
                            </select>
                        </td>
                        <td style="width: 14.50%">
                            <select class="form-select"  name="id_ubicacion_asig[]" id="id_ubicacion_asig" style="text-transform:uppercase">
                                <option value="">----</option>
                                <option value="TORAX">TORAX</option>
                                <option value="CRISTALINO">CRISTALINO</option>
                                <option value="ANILLO">ANILLO</option>
                                <option value="MUÑECA">MUÑECA</option>
                                <option value="CONTROL">CONTROL</option>
                                <option value="AREA">ÁREA</option>
                                <option value="CASO">CASO</option>
                            </select>
                        </td> 
                        <td style="width: 15.0%">
                            <select class="form-select"  name="id_dosimetro_asig[]" id="id_dosimetro_asig" style="text-transform:uppercase">
                                <option value="">----</option>
                                ${selectDosimetrosEzclip.innerHTML}
                                ${selectDosimetros.innerHTML}
                            </select>
                        </td>
                        <td style="width: 14.20%">
                            <select class="form-select"  name="id_holder_asig[]" id="id_holder_asig" style="text-transform:uppercase">
                                <option value="">----</option>
                                <option value="NA">N.A</option>
                                ${selectHolders.innerHTML}
                            </select>
                        </td>
                        <td style="width: 14.20%">
                            <select class="form-select" name="ocupacion_asig[]" id="ocupacion_asig" style="text-transform:uppercase">
                                <option value="">----</option>
                                <option value="T"> TELETERAPIA</option>
                                <option value="BQ">BRAQUITERAPIA</option>
                                <option value="MN">MEDICINA NUCLEAR</option>
                                <option value="GI">GAMMAGRAFÍA INDUSTRIAL</option>
                                <option value="MF">MEDIDORES FIJOS</option>
                                <option value="IV">INVESTIGACIÓN</option>
                                <option value="DN">DENSÍMETRO NUCLEAR</option>
                                <option value="MM">MEDIDORES MÓVILES</option>
                                <option value="E"> DOCENCIA</option>
                                <option value="PR">PERFILAJE Y REGISTRO</option>
                                <option value="TR">TRAZADORES</option>
                                <option value="HD">HEMODINAMIA</option>
                                <option value="OD">RAYOS X ODONTOLÓGICO</option>
                                <option value="RX">RADIODIAGNÓSTICO</option>
                                <option value="FL">FLUOROSCOPIA</option>
                                <option value="AM">APLICACIONES MÉDICAS</option>
                                <option value="AI">APLICACIONES INDUSTRIALES</option>
                            </select>
                        </td>   
                        <td class="text-center" style="width: 15.80%">
                            <button id="" class="btn btn-danger"  type="button" onclick="eliminarFila(this)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </button>
                        </td>
                    `;
                }
                    
                    
            
            })
        });

        $(".inputs").remove();
    }
    function eliminarFila(row){
        var d = row.parentNode.parentNode.rowIndex;
        document.getElementById('tabla_adicional').deleteRow(d);
        
        $(".inputs").remove();
    }
    function eliminarFilaform2(row){
        var e = row.parentNode.parentNode.rowIndex;
        document.getElementById('tabla_adicional2').deleteRow(e);
        
        $(".inputs").remove();
    }
    function Generarnotas1(){
        var trabajadores = document.querySelectorAll('select[name="id_trabajador_asig[]"]');
        /* console.log(trabajadores); */
        var ubicacion = document.querySelectorAll('select[name="id_ubicacion_asig[]"]');
        /* console.log("ESTAS SON LAS UBICACIONES");
        console.log(ubicacion); */
        var sede = document.getElementById("sedes_empresadosi");
        var id_sede = sede.options[sede.selectedIndex].text;
        $.get('trabajadoresempresa', {id_sede: id_sede}, function(trabjDisponibles){
            console.log(trabjDisponibles);
            for(var i = 0; i < trabajadores.length; i++) {
                var values = trabajadores[i].value;
                /* console.log(values); */
                for(var x = 0; x < ubicacion.length; x++) {
                    var valuesX = ubicacion[x].value;
                    /* console.log(values); */
                    if(i==x){
                        console.log("NUEVO DOSIMETRO PARA"+values+"CON UBICACION:"+valuesX);
                        trabjDisponibles.forEach(function(trabj){
                            console.log("ENTRO AL FOREACH CON VALUE"+values);
                            console.log("ITERACION DEL FOREACH"+trabj.id_persona);
                            if(values == trabj.id_persona){
                                console.log("NUEVO DOSIMETRO PARA"+trabj.primer_nombre_persona+` `+trabj.primer_apellido_persona+` `+trabj.segundo_apellido_persona+"CON UBICACION:"+valuesX);
                                let input = `<input type="text" name="inputnotas[]" id="inputnotas`+i+`" class="form-control inputs" value="NUEVO DOSIMETRO PARA `+trabj.primer_nombre_persona+` `+trabj.primer_apellido_persona+` `+trabj.segundo_apellido_persona+` CON UBICACION: `+valuesX+`" readonly>`;
                                $('#textCard1').append(input);
                            }
                        })
                    }
                };
            };
        })
    }
    function Generarnotas2(){
        var trabajadores = document.querySelectorAll('select[name="id_trabajador_asig[]"]');
        /* console.log(trabajadores); */
        var ubicacion = document.querySelectorAll('select[name="id_ubicacion_asig[]"]');
        /* console.log("ESTAS SON LAS UBICACIONES");
        console.log(ubicacion); */
        var sede = document.getElementById("sedes_empresadosi");
        var id_sede = sede.options[sede.selectedIndex].text;
        $.get('trabajadoresempresa', {id_sede: id_sede}, function(trabjDisponibles){
            console.log(trabjDisponibles);
            for(var i = 0; i < trabajadores.length; i++) {
                var values = trabajadores[i].value;
                /* console.log(values); */
                for(var x = 0; x < ubicacion.length; x++) {
                    var valuesX = ubicacion[x].value;
                    /* console.log(values); */
                    if(i==x){
                        console.log("NUEVO DOSIMETRO PARA"+values+"CON UBICACION:"+valuesX);
                        trabjDisponibles.forEach(function(trabj){
                            console.log("ENTRO AL FOREACH CON VALUE"+values);
                            console.log("ITERACION DEL FOREACH"+trabj.id_persona);
                            if(values == trabj.id_persona){
                                console.log("NUEVO DOSIMETRO PARA"+trabj.primer_nombre_persona+` `+trabj.primer_apellido_persona+` `+trabj.segundo_apellido_persona+"CON UBICACION:"+valuesX);
                                let input = `<input type="text" name="inputnotas[]" id="inputnotas`+i+`" class="form-control inputs" value="NUEVO DOSIMETRO PARA `+trabj.primer_nombre_persona+` `+trabj.primer_apellido_persona+` `+trabj.segundo_apellido_persona+` CON UBICACION: `+valuesX+`" readonly>`;
                                $('#textCard2').append(input);
                            }
                        })
                    }
                };
            };
        })
    }
    function limpiar(){
        var contdosisededepto_id = document.getElementById("especialidades_empresadosi").value;
        var mes = document.getElementById("mesacambiar").value;
        var contratodosimetriasede_id  = document.getElementById("sedes_empresadosi").value;
        
        alert("ESTE ES EL MES"+mes+"ESTE ES EL ID DEL DEPTO"+contdosisededepto_id+"ESTE ES EL ID DE LA SEDE"+contratodosimetriasede_id);
        $.get('limpiar', {contratodosimetriasede_id: contratodosimetriasede_id, contdosisededepto_id: contdosisededepto_id, mes: mes}, function(asignacioneslimpias){
            console.log(asignacioneslimpias);
            //se toman todos los elementos a los cuales se les va a cambiar la propiedad disbled, estos tienen la misma propiedad llamada 'cambiar'
            var cambiarElement = document.querySelectorAll('.cambiar');
            cambiarElement.forEach(function(element){
                
                element.disabled = false;
                element.options.item(0).text = "---";
                element.options.item(0).value = null;
            });
            var boton = document.getElementById('agregar2');
            boton.disabled = false;

        })
        
    }
    function fechaUltimoDia(){
        
        var fecha = new Date(document.getElementById("primerDia_asigdosim2").value);
        fecha.setDate(fecha.getDate()+30);
        console.log(fecha);
        var dia = fecha.getDate();
        var mes = fecha.getMonth()+1;
        var mm = (mes < 10 ? '0' : '')+mes;
        var año = fecha.getFullYear();
        document.getElementById("ultimoDia_asigdosim2").value = año+'-'+mm+'-'+dia;


    }
</script>
@if(session('guardar')== 'ok')
    <script>
        Swal.fire(
        'GUARDADO!',
        'SE HA GUARDADO CON ÉXITO.',
        'success'
        )
    </script>
@endif
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#form_cambio_cantdosim').submit(function(e, mes){
            e.preventDefault();
            var trabajadores = document.querySelectorAll('select[name="id_trabajador_asig[]"]');
            console.log("ESTAS SON LOS TRABAJADORES");
            console.log(trabajadores);
            for(var i = 0; i < trabajadores.length; i++) {
                var values = trabajadores[i].value;
                if(values == ''){
                    /* return alert("FALTA SELECCIONAR ALGUN TRABAJADOR"); */
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGÚN TRABAJADOR",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
                }
                
            };

            var ubicacion = document.querySelectorAll('select[name="id_ubicacion_asig[]"]');
            console.log("ESTAS SON LAS UBICACIONES");
            console.log(ubicacion);
            for(var i = 0; i < ubicacion.length; i++) {
                var values = ubicacion[i].value;
                if(values == ''){
                    /* alert("FALTA SELECCIONAR ALGUNA UBICACIÓN"); */
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGUNA UBICACIÓN",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                }
            };
            
            var dosimetros = document.querySelectorAll('select[name="id_dosimetro_asig[]"]');
            console.log("ESTOS SON LOS DOSIMETROS");
            console.log(dosimetros); 
            
            for(var i = 0; i < dosimetros.length; i++) {
                var values = dosimetros[i].value;
                
                for(var x = 0; x < dosimetros.length; x++){
                    var valuesX = dosimetros[x].value;
                    if(values == valuesX && i != x){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS SELECCIONADOS SE ENCUENTRAN REPETIDOS",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
            };

           
            var holder = document.querySelectorAll('select[name="id_holder_asig[]"]');
            console.log("ESTAS SON LOS HOLDERS");
            console.log(holder); 
            for(var i = 0; i < holder.length; i++) {
                var values = holder[i].value;
                
                for(var x = 0; x < holder.length; x++){
                    var valuesX = holder[x].value;
                    if(values == valuesX && i != x){
                        return Swal.fire({
                                title:"ALGUNOS HOLDERS SELECCIONADOS SE ENCUENTRAN REPETIDOS",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
            };
           

            /* var ocupaciones = document.querySelectorAll('select[name="ocupacion_asig[]"]');
            console.log("ESTAS SON LAS OCUPACIONES");
            console.log(ocupaciones);  
            for(var i = 0; i < ocupaciones.length; i++) {
                var values = ocupaciones[i].value;
                if(values == ''){
                    alert("FALTA SELECCIONAR ALGUN HOLDER");
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGUNA OCUPACIÓN",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                }
            }; */
            /*if(trabajadores.length == 0 && ubicacion.length == 0 && dosimetros.length == 0 && holder.length == 0 && ocupaciones.length == 0){ */
            if(trabajadores.length == 0 && ubicacion.length == 0){
                /* alert("OPRIMA EL BOTON DE NUEVO DOSIMETRO O INGRESE LA INFORMACION SOLICITADA"); */
                return Swal.fire({
                                title:"OPRIMA EL BOTÓN DE NUEVO DOSÍMETRO",
                                text: "INGRESE LA INFORMACIÓN SOLICITADA",
                                icon: 'error'
                            });
            };
             ///////////////////////VALIDACION PARA LAS OBSERVACIONES OBLIGATORIAS//////////
            var observaciones = document.querySelectorAll('input[name="inputnotas[]"]');
            console.log("ESTAS SON LAS OBSERVACIONES");
            console.log(observaciones);
            if(observaciones.length == 0){
                return Swal.fire({
                                title:"FALTA OPRIMIR EL BOTÓN PARA GENERAR LAS OBSERVACIONES DE LAS NOVEDADES ",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
            };
            

            Swal.fire({
                text: "DESEA GUARDAR ESTA ASIGNACIÓN PARA EL MES ACTUAL??",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI, SEGURO!'
                }).then((result) => {
                if (result.isConfirmed) {
                    var contdosisededepto_id = document.getElementById("especialidades_empresadosi").value;
                    var mes = document.getElementById("mesacambiar").value;
                    var host = window.location.host;
                    var path = "http://"+host+"/POSITRON/public/novedades/"+contdosisededepto_id+"/"+mes+"/reportePDFcambiodosim";
                    
                    window.open(path, '_blank');
                    this.submit();

                }
            })
        });

        $('#form_cambio_cantdosim2').submit(function(e, mes){
            e.preventDefault();
            ////////VALIDACIONES PARA LAS FECHAS  DE INICIO Y FIN DEL PERIODO/////////////////
            var primerdiaFecha = document.getElementById("primerDia_asigdosim2").value;
            if(primerdiaFecha == ''){
                return Swal.fire({
                                title:"FALTA SELECCIONAR LA FECHA DEL PRIMER DÍA PARA EL PERIODO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
            }
            var ultimodiaFecha = document.getElementById("ultimoDia_asigdosim2").value;
            if(ultimodiaFecha == ''){
                return Swal.fire({
                                title:"FALTA SELECCIONAR LA FECHA DEL ÚLTIMO DÍA PARA EL PERIODO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
            }
            ////////////////////////////////////////////////////////////
            
            ///////////////////////////////////////////////////////////////////////////
            //////VALIDACIONES PARA LOS NUEVOS DOSIMETROS QUE DESEE AÑADIR//////////////
            var trabajadores = document.querySelectorAll('select[name="id_trabajador_asig[]"]');
            console.log("ESTAS SON LOS TRABAJADORES");
            console.log(trabajadores);
            for(var i = 0; i < trabajadores.length; i++) {
                var values = trabajadores[i].value;
                if(values == ''){
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGÚN TRABAJADOR",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
                }
                
            };

            var ubicacion = document.querySelectorAll('select[name="id_ubicacion_asig[]"]');
            console.log("ESTAS SON LAS UBICACIONES");
            console.log(ubicacion);
            for(var i = 0; i < ubicacion.length; i++) {
                var values = ubicacion[i].value;
                if(values == ''){
                    /* alert("FALTA SELECCIONAR ALGUNA UBICACIÓN"); */
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGUNA UBICACIÓN",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                }
            };
            
            if(trabajadores.length == 0 && ubicacion.length == 0 ){
                /* alert("OPRIMA EL BOTON DE NUEVO DOSIMETRO O INGRESE LA INFORMACION SOLICITADA"); */
                return Swal.fire({
                                title:"OPRIMA EL BOTÓN DE NUEVO DOSÍMETRO",
                                text: "INGRESE LA INFORMACIÓN SOLICITADA",
                                icon: 'error'
                            });
            };
            ///////////////////////VALIDACION PARA LAS OBSERVACIONES OBLIGATORIAS//////////
            var observaciones = document.querySelectorAll('input[name="inputnotas[]"]');
            console.log("ESTAS SON LAS OBSERVACIONES" + observaciones);
            if(observaciones.length == 0){
                return Swal.fire({
                                title:"FALTA OPRIMIR EL BOTÓN PARA GENERAR LAS OBSERVACIONES DE LAS NOVEDADES ",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
            };
            ////////////////////////////////////////////////////////////////////////////////
            Swal.fire({
                text: "DESEA GUARDAR ESTA ASIGNACIÓN??",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI, SEGURO!'
                }).then((result) => {
                if (result.isConfirmed) {
                    /* var contdosisededepto_id = document.getElementById("especialidades_empresadosi").value;
                    var mes = document.getElementById("mesacambiar").value;
                    var host = window.location.host;
                    var path = "http://"+host+"/POSITRON/public/novedades/"+contdosisededepto_id+"/"+mes+"/reportePDFcambiodosim";
                    
                    window.open(path, '_blank'); */
                    this.submit();
                }
            })
        });

        $('#limpiar_asig').click(function(e){
            e.preventDefault();
            Swal.fire({
                text: 'SEGURO QUE DESEA LIMPIAR LA INFORMACIÓN DE LAS ASIGNACIONES DEL MES ANTERIOR?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33    ',
                confirmButtonText: 'SI, SEGURO!'
            }).then((result) => {
                if (result.isConfirmed) {
                    limpiar();
                    
                }
            })
        })
    })
</script>
@endsection()