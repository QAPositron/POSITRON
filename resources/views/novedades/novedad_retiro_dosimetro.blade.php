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
        <h2 class="text-center">NOVEDAD DE DOSIMETRÍA <br> <b><i>RETIRO DE DOSÍMETRO</i></b></h2>
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
                        <input type="number" hidden name="contratodosimetriasede" id="contratodosimetriasede" value="">
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
                <div class="col-md-6">
                    <div class="form-floating">
                        <select class="form-select" name="mesacambiar" id="mesacambiar" value="" autofocus style="text-transform:uppercase">
                            <option value="">--SELECCIONE--</option>
                        </select>
                        <label for="floatingInputGrid">PERÍODO A MODIFICAR:</label>
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
            <h3 class="text-center" id="trabjPeriodo"></h3>
            <h4 class="text-center" id="codigoNov"></h4>
            <div>

                <div class="table table-responsive text-center px-4">
                    <table  class="table table-bordered" id="tablaAsignacionDosimetrosmn">
                        <thead class="text-center">
                            <th style='width: 200px'>TRABAJADOR / ÁREA</th>
                            <th style='width: 100px'>UBICACIÓN</th>
                            <th style='width: 100px'>DOSÍMETRO</th>
                            <th style='width: 100px'>HOLDER</th>
                            <th style='width: 100px'>OCUPACIÓN</th>
                            <th style='width: 100px'>ACCIONES</th>

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
                                        
                                        <input type="number" hidden name="mestrabj_asig" id="mestrabj_asig" value="">
                                        <input type="number" hidden name="id_contdosisededepto" id="id_contdosisededepto" value="">
                                        <input type="number" hidden name="id_contratodosimetriasede" id="id_contratodosimetriasede" value="">
                                        <input type="date" hidden name="primerDia_asigdosim" id="primerDia_asigdosim" value="">
                                        <input type="date" hidden name="ultimoDia_asigdosim" id="ultimoDia_asigdosim" value="">
                                        <input type="date" hidden name="fecha_dosim_enviado" id="fecha_dosim_enviado" value="">
                                        <input type="number" hidden name="dosi_control_torax" id="dosi_control_torax" value="">
                                        <input type="number" hidden name="dosi_control_cristalino" id="dosi_control_cristalino" value="">
                                        <input type="number" hidden name="dosi_control_dedo" id="dosi_control_dedo" value="">
                                        <input type="number" hidden name="dosi_torax" id="dosi_torax" value="">
                                        <input type="number" hidden name="dosi_area" id="dosi_area" value="">
                                        <input type="number" hidden name="dosi_caso" id="dosi_caso" value="">
                                        <input type="number" hidden name="dosi_cristalino" id="dosi_cristalino" value="">
                                        <input type="number" hidden name="dosi_dedo" id="dosi_dedo" value="">
                                        <input type="text" hidden name="controlTransT_unicoCont" id="controlTransT_unicoCont" value="">
                                        <input type="text" hidden name="controlTransC_unicoCont" id="controlTransC_unicoCont" value="">
                                        <input type="text" hidden name="controlTransA_unicoCont" id="controlTransA_unicoCont" value="">
                                        <input type="number" hidden name="id_departamentosede" id="id_departamentosede" value="">

                                        <table class="table table-bordered" id="tabla_adicional">
                                            <tbody id="tr_newAsignacion">

                                            </tbody>
                                        </table>
                                        <br>
                                        <div class="row">
                                            <div class="col"></div>
                                            <div class="col-6">
                                                <label for="floatingInputGrid"><b>NOTAS Y OBSERVACIONES:</b></label>
                                                <textarea class="form-control" name="nota_cambio_dosimetros1" id="nota_cambio_dosimetros1" rows="3" autofocus style="text-transform:uppercase"></textarea>
                                            </div>
                                            <div class="col"></div>
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
            <h3 class="text-center" id="trabjPeriodo2"></h3>
            <div >
                <div class="table table-responsive text-center px-4">
                    <form id="form_cambio_cantdosim2" name="form_cambio_cantdosim2" action="{{route('cambiocantdosimesig.save')}}" method="POST">
                        @csrf
                        <input type="number" hidden name="tipo_novedad" id="tipo_novedad" value="2">
                        <input type="number" hidden name="mes_asig_siguiente" id="mes_asig_siguiente" value="">
                        <input type="number" hidden name="contdosisededepto" id="contdosisededepto" value="">
                        <input type="number" hidden name="contratodosimetriasede" id="contratodosimetriasede" value="">
                        <input type="number" hidden name="id_contratodosimetria" id="id_contratodosimetria" value="">
                        <input type="text" hidden name="controlTransT_unicoCont2" id="controlTransT_unicoCont2" value="">
                        <input type="text" hidden name="controlTransC_unicoCont2" id="controlTransC_unicoCont2" value="">
                        <input type="text" hidden name="controlTransA_unicoCont2" id="controlTransA_unicoCont2" value="">
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
                            <div class="col-md">
                                <div class="form-floating">
                                    <input type="date" class="form-control" name="fecha_envio_dosim_asignado" id="fecha_envio_dosim_asignado" >
                                    <label for="floatingInputGrid">FECHA ENVIO</label>
                                    
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
                                <th style='width: 100px'>ACCIONES</th>

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
                            <div class="col-md text-start">
                                <button class="btn btn-circle btn-danger" onclick="eliminarNotas()" type="button" id="eliminarnotas" name="eliminarnotas" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
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
                    console.log("sedes = ")
                    console.log(sedes);
                    $('#sedes_empresadosi').empty();
                    $('#especialidades_empresadosi').empty();
                    $('#sedes_empresadosi').append("<option value=''>--SELECCIONE UNA SEDE DEL CONTRATO--</option>");
                    for(var i = 0; i < sedes.length; i++){
                        $('#sedes_empresadosi').append("<option value='"+ sedes[i].id_sede + "'>" + sedes[i].nombre_sede + "</option>");
                        document.getElementById("contratodosimetriasede").value = sedes[i].id_contratodosimetriasede;
                    }
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
                var contratodosimetriasede = document.getElementById("contratodosimetriasede").value;
                console.log("ID_CONTRATODOSIMETRIASEDE" +contratodosimetriasede);
                $.get('especialidadescontDosi', {contratodosimetriasede_id: contratodosimetriasede}, function(especialidades){
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
            var contratodosimetriasede = document.getElementById("contratodosimetriasede").value;
            console.log("contdosisededepto= "+especialidad_id+" contratodosimetriasede= "+contratodosimetriasede);
            $.get('mesactualcontdosisededepto', {especialidad_id: especialidad_id, contratodosimetriasede: contratodosimetriasede}, function(mesactual_trabjasig){
                console.log("ESTE ES EL MES ACTUAL**");
                console.log(mesactual_trabjasig);
                document.getElementById('id_departamentosede').value = mesactual_trabjasig[0].departamentosede_id;
                const mesAct = mesactual_trabjasig[0].mes_actual;
                console.log("ESTE ES mesAct" +mesAct);
                $('#mesacambiar').empty();
                $('#mesacambiar').append("<option value=''>--</option>");
                const meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
                var numLec = mesactual_trabjasig[0].numlecturas_año;
                if(mesAct == '1'){
                    console.log("ESTA EN MES 1**");
                    if(mesactual_trabjasig[0].periodo_recambio == 'MENS'){
                        console.log("ENTRO AL PERIODO MENS");
                        var ultimoDiaPM = new Date(myFechaInicial.getFullYear(), myFechaInicial.getMonth() + 1, 1);
                        console.log("ULTIMO DIA PRIMER MES:"+ ultimoDiaPM);
                        
                        var r2final = new Date(new Date(ultimoDiaPM).setDate(ultimoDiaPM.getDate()-1));
                        console.log("r2 " +r2final);
                        var fechaesp1 = myFechaInicial.getDate()+' '+meses[myFechaInicial.getMonth()] + ' DE ' + myFechaInicial.getUTCFullYear();
                        console.log(fechaesp1);

                        var fechaesp2 = (r2final.getDate()) +' '+ meses[r2final.getMonth()] + ' DE ' + r2final.getUTCFullYear(); 
                        console.log(fechaesp2);
                        $('#mesacambiar').append("<option value='1'> 1 - "+fechaesp1+' - '+fechaesp2+"  </option>");
                        document.getElementById('trabjPeriodo').innerHTML = "ASIGNACIÓN DE DOSÍMETROS Y<br>TRABAJADORES ASIGNADOS AL PERÍODO 1 <br> ( "+fechaesp1+' - '+fechaesp2+' )';
                        /* document.getElementById('trabjPeriodo2').innerHTML = "ASIGNACIÓN DE DOSÍMETROS Y<br>TRABAJADORES ASIGNADOS AL PERÍODO 1 <br> ( "+fechaesp1+' - '+fechaesp2+' )'; */
                        var diaP = myFechaInicial.getDate();
                        var mesP = myFechaInicial.getMonth()+1;
                        var añoP = myFechaInicial.getFullYear();
                        var ddP = (diaP < 10 ? '0' : '')+diaP;
                        var mmP = (mesP < 10 ? '0' : '')+mesP;
                        var fechaP = añoP+'-'+mmP+'-'+ddP;
                        /* document.getElementById("primerDia2_asigdosim").value = fechaP; */
                        document.getElementById("primerDia_asigdosim").value = fechaP;
                        var diaF = r2final.getDate();
                        var mesF = r2final.getMonth()+1;
                        var añoF = r2final.getFullYear();
                        var ddF = (diaF < 10 ? '0' : '')+diaF;
                        var mmF = (mesF < 10 ? '0' : '')+mesF;
                        /* document.getElementById("ultimoDia_asigdosim2").value = añoF+'-'+mmF+'-'+ddF; */
                        document.getElementById("ultimoDia_asigdosim").value = añoF+'-'+mmF+'-'+ddF;
                    }else if(mesactual_trabjasig[0].periodo_recambio == 'TRIMS'){
                        console.log("ENTRO AL PERIODO TRIMS");
                        var ultimoDiaPM = new Date(myFechaInicial.getFullYear(), myFechaInicial.getMonth() + 3, 1);
                        console.log("ULTIMO DIA PRIMER MES:"+ ultimoDiaPM);
                        
                        var r2final = new Date(new Date(ultimoDiaPM).setDate(ultimoDiaPM.getDate()-1));
                        console.log("r2 " +r2final);
                        var fechaesp1 = myFechaInicial.getDate()+' '+meses[myFechaInicial.getMonth()] + ' DE ' + myFechaInicial.getUTCFullYear();
                        console.log(fechaesp1);

                        var fechaesp2 = (r2final.getDate()) +' '+ meses[r2final.getMonth()] + ' DE ' + r2final.getUTCFullYear(); 
                        console.log(fechaesp2);
                        $('#mesacambiar').append("<option value='1'> 1 - "+fechaesp1+' - '+fechaesp2+"  </option>");
                        document.getElementById('trabjPeriodo').innerHTML = "ASIGNACIÓN DE DOSÍMETROS Y<br>TRABAJADORES ASIGNADOS AL PERÍODO 1 <br> ( "+fechaesp1+' - '+fechaesp2+' )';
                        /* document.getElementById('trabjPeriodo2').innerHTML = "ASIGNACIÓN DE DOSÍMETROS Y<br>TRABAJADORES ASIGNADOS AL PERÍODO 1 <br> ( "+fechaesp1+' - '+fechaesp2+' )'; */
                        var diaP = myFechaInicial.getDate();
                        var mesP = myFechaInicial.getMonth()+1;
                        var añoP = myFechaInicial.getFullYear();
                        var ddP = (diaP < 10 ? '0' : '')+diaP;
                        var mmP = (mesP < 10 ? '0' : '')+mesP;
                        var fechaP = añoP+'-'+mmP+'-'+ddP;
                        /* document.getElementById("primerDia2_asigdosim").value = fechaP; */
                        document.getElementById("primerDia_asigdosim").value = fechaP;
                        var diaF = r2final.getDate();
                        var mesF = r2final.getMonth()+1;
                        var añoF = r2final.getFullYear();
                        var ddF = (diaF < 10 ? '0' : '')+diaF;
                        var mmF = (mesF < 10 ? '0' : '')+mesF;
                        /* document.getElementById("ultimoDia_asigdosim2").value = añoF+'-'+mmF+'-'+ddF; */
                        document.getElementById("ultimoDia_asigdosim").value = añoF+'-'+mmF+'-'+ddF;
                    }else if(mesactual_trabjasig[0].periodo_recambio == 'BIMS'){
                        console.log("ENTRO AL PERIODO BIMS");
                        var ultimoDiaPM = new Date(myFechaInicial.getFullYear(), myFechaInicial.getMonth() + 2, 1);
                        console.log("ULTIMO DIA PRIMER MES:"+ ultimoDiaPM);
                        
                        var r2final = new Date(new Date(ultimoDiaPM).setDate(ultimoDiaPM.getDate()-1));
                        console.log("r2 " +r2final);
                        var fechaesp1 = myFechaInicial.getDate()+' '+meses[myFechaInicial.getMonth()] + ' DE ' + myFechaInicial.getUTCFullYear();
                        console.log(fechaesp1);

                        var fechaesp2 = (r2final.getDate()) +' '+ meses[r2final.getMonth()] + ' DE ' + r2final.getUTCFullYear(); 
                        console.log(fechaesp2);
                        $('#mesacambiar').append("<option value='1'> 1 - "+fechaesp1+' - '+fechaesp2+"  </option>");
                        document.getElementById('trabjPeriodo').innerHTML = "ASIGNACIÓN DE DOSÍMETROS Y<br>TRABAJADORES ASIGNADOS AL PERÍODO 1 <br> ( "+fechaesp1+' - '+fechaesp2+' )';
                        /* document.getElementById('trabjPeriodo2').innerHTML = "ASIGNACIÓN DE DOSÍMETROS Y<br>TRABAJADORES ASIGNADOS AL PERÍODO 1 <br> ( "+fechaesp1+' - '+fechaesp2+' )'; */
                        var diaP = myFechaInicial.getDate();
                        var mesP = myFechaInicial.getMonth()+1;
                        var añoP = myFechaInicial.getFullYear();
                        var ddP = (diaP < 10 ? '0' : '')+diaP;
                        var mmP = (mesP < 10 ? '0' : '')+mesP;
                        var fechaP = añoP+'-'+mmP+'-'+ddP;
                        /* document.getElementById("primerDia2_asigdosim").value = fechaP; */
                        document.getElementById("primerDia_asigdosim").value = fechaP;
                        var diaF = r2final.getDate();
                        var mesF = r2final.getMonth()+1;
                        var añoF = r2final.getFullYear();
                        var ddF = (diaF < 10 ? '0' : '')+diaF;
                        var mmF = (mesF < 10 ? '0' : '')+mesF;
                       /*  document.getElementById("ultimoDia_asigdosim2").value = añoF+'-'+mmF+'-'+ddF; */
                        document.getElementById("ultimoDia_asigdosim").value = añoF+'-'+mmF+'-'+ddF;
                    } 
                }else{
                    console.log("ESTA ES EL MES > 1***");
                    console.log(mesactual_trabjasig[0].mes_actual);
                    var value = mesactual_trabjasig[0].mes_actual;
                    var siguientemes = value+1;
                    console.log("MES SIGUIENTE= " + siguientemes);
                    
                    if(mesactual_trabjasig[0].periodo_recambio == 'MENS'){
                        var xx = 1; 
                        var ultimoDiaPM = new Date(myFechaInicial.getFullYear(), myFechaInicial.getMonth() + 1, 1);
                        console.log("ULTIMO DIA PRIMER MES "+ ultimoDiaPM);
                        for(var i=0; i<=(numLec-2); i++){
                            console.log("esta es la i="+i);
                            var r = new Date(new Date(ultimoDiaPM).setMonth(ultimoDiaPM.getMonth()+i));
                            console.log("r1" +r);
                            var r2 = new Date(new Date(r).setMonth(r.getMonth()+1));
                            var fechaesp = meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                            var r2final = new Date(new Date(r2).setDate(r.getDate()-1));
                            console.log("r2 " +r2final);
                            var fechaesp1 = r.getDate()+' '+meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                            console.log(fechaesp1);
                            var fechaesp2 = (r2final.getDate()) +' '+ meses[r2final.getMonth()] + ' DE ' + r2final.getUTCFullYear(); 
                            console.log(fechaesp2);
                            xx++;
                            
                            console.log("periodo XX"+xx);
                            /* console.log("ESTA ES LA X="+x); */
                            if(value == xx){
                                console.log("MES ACTUAL IGUAL A XX");
                                document.getElementById('trabjPeriodo').innerHTML = "ASIGNACIÓN DE DOSÍMETROS Y<br>TRABAJADORES ASIGNADOS AL PERÍODO "+value+"<br> ( "+fechaesp1+' - '+fechaesp2+' )';
                                $('#mesacambiar').append("<option value='"+ value + "'>ACTUAL: " + value + " ("+ fechaesp1+' - '+fechaesp2 + ")" + "</option>");
                                var diaP = r.getDate();
                                var mesP = r.getMonth()+1;
                                var añoP = r.getFullYear();
                                var ddP = (diaP < 10 ? '0' : '')+diaP;
                                var mmP = (mesP < 10 ? '0' : '')+mesP;
                                var fechaP = añoP+'-'+mmP+'-'+ddP;
                                document.getElementById("primerDia_asigdosim").value = fechaP;
                                var diaF = r2final.getDate();
                                var mesF = r2final.getMonth()+1;
                                var añoF = r2final.getFullYear();
                                var ddF = (diaF < 10 ? '0' : '')+diaF;
                                var mmF = (mesF < 10 ? '0' : '')+mesF;
                                console.log("FECHA FINAL="+añoF+'-'+mmF+'-'+ddF);
                                document.getElementById("ultimoDia_asigdosim").value = añoF+'-'+mmF+'-'+ddF;
                            }else if(siguientemes == xx){
                                console.log("MES SIGUIENTE IGUAL A XX");
                                $('#mesacambiar').append("<option value='"+ siguientemes + "'>SIGUIENTE: " + siguientemes + " ("+ fechaesp1+' - '+fechaesp2 + ")" + "</option>");
                                document.getElementById('trabjPeriodo2').innerHTML = "RETIRO DE DOSÍMETROS <br>ASIGNADOS AL PERÍODO "+siguientemes+"<br> ( "+fechaesp1+' - '+fechaesp2+' )';
                                var diaP = r.getDate();
                                var mesP = r.getMonth()+1;
                                var añoP = r.getFullYear();
                                var ddP = (diaP < 10 ? '0' : '')+diaP;
                                var mmP = (mesP < 10 ? '0' : '')+mesP;
                                var fechaP = añoP+'-'+mmP+'-'+ddP;
                                console.log("fecha MENS"+fechaP);
                                document.getElementById("primerDia_asigdosim2").value = fechaP;
                                var diaF = r2final.getDate();
                                var mesF = r2final.getMonth()+1;
                                var añoF = r2final.getFullYear();
                                var ddF = (diaF < 10 ? '0' : '')+diaF;
                                var mmF = (mesF < 10 ? '0' : '')+mesF;
                                console.log("FECHA FINAL MENS="+añoF+'-'+mmF+'-'+ddF);
                                document.getElementById("ultimoDia_asigdosim2").value = añoF+'-'+mmF+'-'+ddF;
                                break;
                            }
                        }
                    }else if(mesactual_trabjasig[0].periodo_recambio == 'TRIMS'){
                        var ultimoDiaPM = new Date(myFechaInicial.getFullYear(), myFechaInicial.getMonth() + 3, 1);
                        console.log("ULTIMO DIA PRIMER MES:"+ ultimoDiaPM);
                        var xx = 1;
                        for(var i=0; i<=(numLec+1); i= i+3){
                            console.log("ESTA ES LA I = "+i);
                            var r = new Date(new Date(ultimoDiaPM).setMonth(ultimoDiaPM.getMonth()+i));
                            console.log("r1" +r);
                            var r2 = new Date(new Date(r).setMonth(r.getMonth()+3));
                            var r2final = new Date(new Date(r2).setDate(r.getDate()-1));
                            console.log("r2 " +r2final);
                            var fechaesp1 = r.getDate()+' '+meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                            console.log(fechaesp1);

                            var fechaesp2 = (r2final.getDate()) +' '+ meses[r2final.getMonth()] + ' DE ' + r2final.getUTCFullYear(); 
                            console.log(fechaesp2);
                            xx++;
                            console.log("XX"+xx);
                        
                            if(value == xx){
                                document.getElementById('trabjPeriodo').innerHTML = "ASIGNACIÓN DE DOSÍMETROS Y<br>TRABAJADORES ASIGNADOS AL PERÍODO "+value+"<br> ( "+fechaesp1+' - '+fechaesp2+' )';
                                /* document.getElementById('trabjPeriodo2').innerHTML = "ASIGNACIÓN DE DOSÍMETROS Y<br>TRABAJADORES ASIGNADOS AL PERÍODO "+value+"<br> ( "+fechaesp1+' - '+fechaesp2+' )'; */
                                $('#mesacambiar').append("<option value='"+ value + "'>ACTUAL: " + value + " ("+ fechaesp1+' - '+fechaesp2 + ")" + "</option>");
                                var diaP = r.getDate();
                                var mesP = r.getMonth()+1;
                                var añoP = r.getFullYear();
                                var ddP = (diaP < 10 ? '0' : '')+diaP;
                                var mmP = (mesP < 10 ? '0' : '')+mesP;
                                var fechaP = añoP+'-'+mmP+'-'+ddP;
                                document.getElementById("primerDia_asigdosim").value = fechaP;
                                var diaF = r2final.getDate();
                                var mesF = r2final.getMonth()+1;
                                var añoF = r2final.getFullYear();
                                var ddF = (diaF < 10 ? '0' : '')+diaF;
                                var mmF = (mesF < 10 ? '0' : '')+mesF;
                                document.getElementById("ultimoDia_asigdosim").value = añoF+'-'+mmF+'-'+ddF;
                            }else if(siguientemes == xx){
                                $('#mesacambiar').append("<option value='"+ siguientemes + "'>SIGUIENTE: " + siguientemes + " ("+ fechaesp1+' - '+fechaesp2 + ")" + "</option>");
                                document.getElementById('trabjPeriodo2').innerHTML = "RETIRO DE DOSÍMETROS <br>ASIGNADOS AL PERÍODO "+siguientemes+"<br> ( "+fechaesp1+' - '+fechaesp2+' )';
                                var diaP = r.getDate();
                                var mesP = r.getMonth()+1;
                                var añoP = r.getFullYear();
                                var ddP = (diaP < 10 ? '0' : '')+diaP;
                                var mmP = (mesP < 10 ? '0' : '')+mesP;
                                var fechaP = añoP+'-'+mmP+'-'+ddP;
                                document.getElementById("primerDia_asigdosim2").value = fechaP;
                                var diaF = r2final.getDate();
                                var mesF = r2final.getMonth()+1;
                                var añoF = r2final.getFullYear();
                                var ddF = (diaF < 10 ? '0' : '')+diaF;
                                var mmF = (mesF < 10 ? '0' : '')+mesF;
                                document.getElementById("ultimoDia_asigdosim2").value = añoF+'-'+mmF+'-'+ddF;
                                break;
                            }
                        }
                    }else if(mesactual_trabjasig[0].periodo_recambio == 'BIMS'){
                        var ultimoDiaPM = new Date(myFechaInicial.getFullYear(), myFechaInicial.getMonth() + 2, 1);
                        console.log("ULTIMO DIA PRIMER MES:"+ ultimoDiaPM);
                        var xx = 1;
                        for(var i=0; i<=(numLec+1); i= i+2){
                            console.log("ESTA ES LA I = "+i);
                            var r = new Date(new Date(ultimoDiaPM).setMonth(ultimoDiaPM.getMonth()+i));
                            console.log("r1" +r);
                            var r2 = new Date(new Date(r).setMonth(r.getMonth()+2));
                            var r2final = new Date(new Date(r2).setDate(r.getDate()-1));
                            console.log("r2 " +r2final);
                            var fechaesp1 = r.getDate()+' '+meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                            console.log(fechaesp1);

                            var fechaesp2 = (r2final.getDate()) +' '+ meses[r2final.getMonth()] + ' DE ' + r2final.getUTCFullYear(); 
                            console.log(fechaesp2);
                            xx++;
                            console.log("periodo XX"+xx);
                            if(value == xx){
                                console.log("MES ACTUAL IGUAL A XX");
                                document.getElementById('trabjPeriodo').innerHTML = "ASIGNACIÓN DE DOSÍMETROS Y<br>TRABAJADORES ASIGNADOS AL PERÍODO "+value+"<br> ( "+fechaesp1+' - '+fechaesp2+' )';
                                /* document.getElementById('trabjPeriodo2').innerHTML = "ASIGNACIÓN DE DOSÍMETROS Y<br>TRABAJADORES ASIGNADOS AL PERÍODO "+value+"<br> ( "+fechaesp1+' - '+fechaesp2+' )'; */
                                $('#mesacambiar').append("<option value='"+ value + "'>ACTUAL: " + value + " ("+ fechaesp1+' - '+fechaesp2 + ")" + "</option>");
                                var diaP = r.getDate();
                                var mesP = r.getMonth()+1;
                                var añoP = r.getFullYear();
                                var ddP = (diaP < 10 ? '0' : '')+diaP;
                                var mmP = (mesP < 10 ? '0' : '')+mesP;
                                var fechaP = añoP+'-'+mmP+'-'+ddP;
                                console.log("fechaFinalBIMS"+fechaP);
                                document.getElementById("primerDia_asigdosim").value = fechaP;
                                var diaF = r2final.getDate();
                                var mesF = r2final.getMonth()+1;
                                var añoF = r2final.getFullYear();
                                var ddF = (diaF < 10 ? '0' : '')+diaF;
                                var mmF = (mesF < 10 ? '0' : '')+mesF;
                                document.getElementById("ultimoDia_asigdosim").value = añoF+'-'+mmF+'-'+ddF;
                            }else if(siguientemes == xx){
                                console.log("MES SIGUIENTE IGUAL A XX");
                                $('#mesacambiar').append("<option value='"+ siguientemes + "'>SIGUIENTE: " + siguientemes + " ("+ fechaesp1+' - '+fechaesp2 + ")" + "</option>");
                                document.getElementById('trabjPeriodo2').innerHTML = "RETIRO DE DOSÍMETROS <br>ASIGNADOS AL PERÍODO "+siguientemes+"<br> ( "+fechaesp1+' - '+fechaesp2+' )';
                                var diaP = r.getDate();
                                var mesP = r.getMonth()+1;
                                var añoP = r.getFullYear();
                                var ddP = (diaP < 10 ? '0' : '')+diaP;
                                var mmP = (mesP < 10 ? '0' : '')+mesP;
                                var fechaP = añoP+'-'+mmP+'-'+ddP;
                                document.getElementById("primerDia_asigdosim2").value = fechaP;
                                var diaF = r2final.getDate();
                                var mesF = r2final.getMonth()+1;
                                var añoF = r2final.getFullYear();
                                var ddF = (diaF < 10 ? '0' : '')+diaF;
                                var mmF = (mesF < 10 ? '0' : '')+mesF;
                                document.getElementById("ultimoDia_asigdosim2").value = añoF+'-'+mmF+'-'+ddF;
                                break;
                            }
                        }
                    }

                };
                $('#mesacambiar').on('change', function(){
                    var mes = $(this).val();
                    Formulario1.style.display= "none";
                    Formulario2.style.display= "none";
                    var dosi_control_torax = 0;
                    var dosi_control_cristalino = 0;
                    var dosi_control_dedo = 0;
                    var dosi_torax= 0;
                    var dosi_area = 0;
                    var dosi_caso = 0;
                    var dosi_cristalino = 0;
                    var dosi_muñeca = 0;
                    var dosi_dedo = 0;

                    console.log("ESTE ES EL MES SELECCIONADO" +mes);
                    console.log(mesactual_trabjasig[0].mes_actual);
                    var consultaMesactual = mesactual_trabjasig[0].mes_actual;
                    console.log("LA CONSULTA"+consultaMesactual);

                    /* if(mes == consultaMesactual){
                        Formulario1.style.display= "block";
                    }else */ 
                    if (mes > consultaMesactual){
                        Formulario2.style.display= "block";
                    }else{
                        Formulario2.style.display= "none";
                    }
                    var contdosisededepto_id = document.getElementById("especialidades_empresadosi").value;
                    console.log("**contdosisededepto_id " +contdosisededepto_id);
                    console.log("**mes actual "+consultaMesactual);
                    var contratodosimetriasede_id  = document.getElementById("contratodosimetriasede").value;
                    var contratodosimetria = document.getElementById("contratos_empresadosi").value;

                    $.get('dosiasginadoscontrolmesactual', {contdosisededepto_id: contdosisededepto_id, mes: consultaMesactual, contratodosimetria_id: contratodosimetria}, function(asignacionescontrolmesactual){
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
                                    var ubicacion = asignacionescontrolmesactual[i].ubicacion;

                                    if(asignacionescontrolmesactual[i].codigo_holder == null){
                                        var id_holder = 'NA';
                                        var codigo_holder = 'NA';
                                    }else{
                                        var id_holder = asignacionescontrolmesactual[i].id_holder;
                                        var codigo_holder = asignacionescontrolmesactual[i].codigo_holder;
                                    }
                                }else{
                                    var id_dosimetro = '';
                                    var id_holder = '';
                                    var codigo_dosimeter = '---';
                                    var codigo_holder = '---';
                                    var ubicacion = asignacionescontrolmesactual[i].ubicacion;
                                }
                                if(asignacionescontrolmesactual[i].controlTransT_unicoCont == 'TRUE'){
                                    document.getElementById("controlTransT_unicoCont2").value = "TRUE";
                                }
                                if(asignacionescontrolmesactual[i].controlTransC_unicoCont == 'TRUE'){
                                    document.getElementById("controlTransC_unicoCont2").value = "TRUE";
                                }
                                if(asignacionescontrolmesactual[i].controlTransA_unicoCont == 'TRUE'){
                                    document.getElementById("controlTransA_unicoCont2").value = "TRUE";
                                }
                                var contratodosimetria = document.getElementById("contratos_empresadosi").value;
                                document.getElementById("id_contratodosimetria").value = contratodosimetria;
                                console.log("//CODIGO DEL DOSIMETRO MES SIGUIENTE" +codigo_dosimeter);
                                var tr = `<tr id="`+asignacionescontrolmesactual[i].id_dosicontrolcontdosisedes+`control">
                                        <td style='width: 75px' class='align-middle text-center'>CONTROL TRANS.</td>
                                        <td style='width: 75px' class='align-middle'>
                                            <input type="text" name="ubicacion_asigdosimControl[]" id="ubicacion_asigdosimControl" class="form-control text-center" value="`+ubicacion+`" readonly>
                                        </td>
                                        <td style='width: 190px' class='align-middle'>
                                            
                                            <select class="form-select cambiar text-center"  name="id_dosimetro_asigdosimControl[]" id="id_dosimetro_asigdosimControl" ${disacont} >
                                                <option value="`+id_dosimetro+`">`+codigo_dosimeter+`</option>
                                                ${selectDosimetros.innerHTML}
                                                ${selectDosimetrosEzclip.innerHTML}
                                            </select>
                                        </td>
                                        <td style='width: 163px' class='align-middle text-center'>
                                            <select class="form-select cambiar text-center"  name="id_holder_asigdosimControl[]" id="id_holder_asigdosimControl" ${disacont} >
                                                <option value="`+id_holder+`">`+codigo_holder+`</option>
                                                <option value="NA">N.A.</option>
                                                ${selectHolders.innerHTML}
                                            </select>
                                        </td>
                                       
                                        <td style='width: 100px' class='align-middle text-center'>
                                            <button  class="btn btn-danger cambiarBoton"  type="button" onclick="eliminarControl(`+asignacionescontrolmesactual[i].id_dosicontrolcontdosisedes+`, '`+asignacionescontrolmesactual[i].ubicacion+`',);" ${disacont}>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                </svg>
                                            </button>
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
                                        <td colspan='2' class='align-middle text-center'>CONTROL</td>
                                        <td style='width: 208px'class='align-middle text-center'>`
                                            +asignacionescontrolmesactual[i].codigo_dosimeter+
                                        `</td>
                                        <td style='width: 208px' class='align-middle text-center'>NA</td>
                                        <td style='width: 208px' class='align-middle text-center'>`+asignacionescontrolmesactual[i].ocupacion+`</td>
                                            
                                    </tr>`;
                                $("#tr_control").append(tr);
                                
                                /* dosi_control += 1; */
                                console.log("EL VALOR DEL DOSI CONTROL PARA EL MES ACTUAL");
                                /* console.log(dosi_control); */
                            }; 
                            /* document.getElementById("dosi_control").value = dosi_control; */
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
                                        if(asignacionesmesactual[i].id_holder == null){
                                            var id_holder = 'NA';
                                            var codigo_holder = 'NA';
                                        }else{
                                            var id_holder = asignacionesmesactual[i].id_holder;
                                            var codigo_holder = asignacionesmesactual[i].codigo_holder;
                                        }
                                    }else{
                                        var id_dosimetro = '';
                                        var codigo_dosimeter = '---';
                                        var id_holder = '';
                                        var codigo_holder = '---';
                                    }
                                    var mestrabj_asig = document.getElementById("mesacambiar").value;
                                    var id_contdosisededepto = document.getElementById("especialidades_empresadosi").value; 
                                    var id_contratodosimetriasede =  document.getElementById("contratodosimetriasede").value; 
                                    document.getElementById("mes_asig_siguiente").value = mestrabj_asig;
                                    document.getElementById("contdosisededepto").value = id_contdosisededepto;
                                    document.getElementById("contratodosimetriasede").value = id_contratodosimetriasede;
                                    
                                    var tr = `<tr id="`+asignacionesmesactual[i].id_trabajadordosimetro+`">
                                        <td class='align-middle text-center'>
                                            <input type="text" name="id_trabj_asigdosim[]" id="id_trabj_asigdosim_mesdesp`+asignacionesmesactual[i].id_persona+`" class="form-control id_trabj_asigdosim" value="`+asignacionesmesactual[i].id_persona+`" hidden>
                                            <select class="form-select"  name="id_trabj_asigdosim[]" id="id_trabj_asigdosim`+asignacionesmesactual[i].id_persona+`" disabled>
                                                <option value="`+asignacionesmesactual[i].id_persona+`">`+asignacionesmesactual[i].primer_nombre_persona+` `+asignacionesmesactual[i].primer_apellido_persona+` `+asignacionesmesactual[i].segundo_apellido_persona+` `+`</option>
                                                ${selectTrabajadores.innerHTML}
                                            </select>
                                        </td>
                                        <td class='align-middle text-center'><input type="text" name="ubicacion_asigdosim[]" id="ubicacion_asigdosim" class="form-control text-center" value="`+asignacionesmesactual[i].ubicacion+`" readonly></td>
                                        <td class='align-middle text-center'>
                                            <select class="form-select cambiar text-center"  name="id_dosimetro_asigdosim[]" id="id_dosimetro_asigdosim" ${dis} >
                                                <option value="`+id_dosimetro+`">`+codigo_dosimeter+`</option>
                                                ${selectDosimetros.innerHTML}
                                                ${selectDosimetrosEzclip.innerHTML}
                                            </select>
                                        </td>
                                        <td class='align-middle text-center'>
                                            <select class="form-select cambiar text-center"  name="id_holder_asigdosim[]" id="id_holder_asigdosim" ${dis} >
                                                <option value="`+id_holder+`">`+codigo_holder+`</option>
                                                ${selectHolders.innerHTML}
                                            </select>
                                        </td>
                                        <td style='width: 100px' class='align-middle text-center'>
                                            <button class="btn btn-danger cambiarBoton"  type="button"  onclick="eliminar(`+asignacionesmesactual[i].id_trabajadordosimetro+`, '`+asignacionesmesactual[i].ubicacion+`', '`+asignacionesmesactual[i].primer_nombre_persona+' '+asignacionesmesactual[i].primer_apellido_persona+' '+asignacionesmesactual[i].segundo_apellido_persona+`');" ${dis}>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>`;
                                    $("#body_asignaciones2").append(tr);
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
                                            <td class='align-middle'>`+asignacionesmesactual[i].ubicacion+`</td>
                                            <td class='align-middle'>`+asignacionesmesactual[i].codigo_dosimeter+`</td>
                                            <td class='align-middle'>`+asignacionesmesactual[i].codigo_holder+`</td>
                                            <td class='align-middle'>`+asignacionesmesactual[i].ocupacion+`</td>
                                            
                                        </tr>`;
                                        $("#body_asignaciones").append(tr);
                                    }else{
                                        var tr = `<tr>
                                            <td class='align-middle'>`+asignacionesmesactual[i].primer_nombre_persona+` `+asignacionesmesactual[i].primer_apellido_persona+` `+asignacionesmesactual[i].segundo_apellido_persona+` `+`</td>
                                            <td class='align-middle'>`+asignacionesmesactual[i].ubicacion+`</td>
                                            <td class='align-middle'>`+asignacionesmesactual[i].codigo_dosimeter+`</td>
                                            <td class='align-middle'> NA </td>
                                            <td class='align-middle'>`+asignacionesmesactual[i].ocupacion+`</td>
                                            
                                        </tr>`;
                                        $("#body_asignaciones").append(tr);
                                        
                                    }
                                   /*  if(asignacionesmesactual[i].ubicacion == 'TORAX'){
                                        dosi_torax += 1;
                                    }else if(asignacionesmesactual[i].ubicacion == 'CRISTALINO'){
                                        dosi_cristalino += 1;
                                    }else if(asignacionesmesactual[i].ubicacion == 'MUÑECA'){
                                        dosi_muñeca += 1 ;
                                    }else if(asignacionesmesactual[i].ubicacion == 'ANILLO'){
                                        dosi_dedo += 1;
                                    } */
                                    
                                    /* document.getElementById("dosi_control").value = dosi_control; */
                                    
                                    /* document.getElementById("dosi_torax").value = dosi_torax;
                                    document.getElementById("dosi_cristalino").value = dosi_cristalino;
                                    document.getElementById("dosi_muñeca").value = dosi_muñeca;
                                    document.getElementById("dosi_dedo").value = dosi_dedo; */

                                }
                            }
                        });
                    });
                    $.get('dosiareasginadosmesactual', {contratodosimetriasede_id: contratodosimetriasede_id, contdosisededepto_id: contdosisededepto_id, mes: consultaMesactual}, function(asignacionesareamesactual){
                        console.log("ASIGNACIONES AREA DEL MES ACTUAL");
                        console.log(asignacionesareamesactual);
                        $('#body_asignaciones').html("");
                        var contdosisededepto_id= document.getElementById("especialidades_empresadosi").value;
                        var sede = document.getElementById("sedes_empresadosi");
                        var sede_id = sede.value;
                        var selectAreas = document.createElement("select");
                        $.get('areasespecialidadesempresa', {contdosisededepto_id: contdosisededepto_id, id_sede: sede_id}, function(areasespecialidad){
                            console.log("ESTAS SON LAS AREAS DEL DEPARTAMENTO"+contdosisededepto_id+" Y LA SEDE "+sede_id);
                            console.log(areasespecialidad);
                            for(var i = 0; i < areasespecialidad.length; i++){
                                option = document.createElement("option");
                                option.value = areasespecialidad[i].id_areadepartamentosede;
                                option.text = areasespecialidad[i].nombre_area;
                                selectAreas.appendChild(option);
                            }
                            console.log(selectAreas.innerHTML);
                        });
                        if(mes > consultaMesactual){
                            /* alert("ASIGNACIONES PARA EL MES SIGUIENTE AL ACTUAL"); */
                            for(var i=0; i<asignacionesareamesactual.length; i++){
                                if(asignacionesareamesactual[i].dosimetro_uso != 'FALSE'){
                                    var dis = 'disabled';
                                    var id_dosimetro = asignacionesareamesactual[i].id_dosimetro;
                                    var codigo_dosimeter = asignacionesareamesactual[i].codigo_dosimeter;
                                    var id_holder = asignacionesareamesactual[i].id_holder;
                                    var codigo_holder = asignacionesareamesactual[i].codigo_holder;
                                    
                                }else{
                                   
                                    var id_dosimetro = '';
                                    var codigo_dosimeter = '---';
                                    var id_holder = '';
                                    var codigo_holder = '---';
                                }
                                var tr = `<tr id="`+asignacionesareamesactual[i].id_dosiareacontdosisedes+`area">
                                    <td class='align-middle'>
                                        <input type="text" name="id_area_asigdosim[]" id="id_area_asigdosim`+asignacionesareamesactual[i].id_areadepartamentosede+`" class="form-control" value="`+asignacionesareamesactual[i].id_areadepartamentosede+`" hidden>
                                        <select class="form-select"  name="id_area_asigdosim[]" id="id_area_asigdosim`+asignacionesareamesactual[i].id_areadepartamentosede+`" disabled>
                                            <option value="`+asignacionesareamesactual[i].id_areadepartamentosede+`">`+asignacionesareamesactual[i].nombre_area+`</option>
                                            ${selectAreas.innerHTML}
                                        </select>
                                    </td>
                                    <td class='align-middle text-center'><input type="text" class="form-control text-center" value="ÁREA" readonly></td>
                                    <td class='align-middle text-center'>
                                        <select class="form-select text-center cambiar"  name="id_dosimetro_area_asigdosim[]" id="id_dosimetro_area_asigdosim" ${dis}>
                                            <option value="`+id_dosimetro+`">`+codigo_dosimeter+`</option>
                                            ${selectDosimetros.innerHTML}
                                        </select>
                                    </td>
                                    <td class='align-middle text-center'> N.A. </td>
                                    <td style='width: 100px' class='align-middle text-center'>
                                        <button class="btn btn-danger cambiarBoton"  type="button"  onclick="eliminarArea(`+asignacionesareamesactual[i].id_dosiareacontdosisedes+`, '`+asignacionesareamesactual[i].nombre_area+`');" ${dis}>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>`;

                                $("#body_asignaciones2").append(tr);

                            }
                        }else{
                             /* alert("ASIGNACIONES PARA EL MES ACTUAL"); */
                            for(var i=0; i<asignacionesareamesactual.length; i++){
                                /* var fechaEnviado = asignacionesareamesactual[i].fecha_dosim_enviado;
                                document.getElementById("fecha_dosim_enviado").value = fechaEnviado;
                                var primerDiaUso = asignacionesareamesactual[i].primer_dia_uso;
                                document.getElementById("primerDia_asigdosim").value = primerDiaUso;
                                var ultimoDiaUso = asignacionesareamesactual[i].ultimo_dia_uso;
                                document.getElementById("ultimoDia_asigdosim").value = ultimoDiaUso; */
                                
                                var tr = `<tr>
                                    <td class='align-middle' style='width: 250px'>`+asignacionesareamesactual[i].nombre_area+`</td>
                                    <td class='align-middle text-center'>ÁREA</td>
                                    <td class='align-middle text-center'>`+asignacionesareamesactual[i].codigo_dosimeter+`</td>
                                    <td class='align-middle text-center'> N.A.</td>
                                    <td></td>
                                </tr>`;
                                $("#body_asignaciones").append(tr);

                                /*dosi_area += 1; */
                                console.log("EL VALOR DEL DOSI AREA PARA EL MES ACTUAL");
                                /* console.log(dosi_area); */
                            }
                            /* document.getElementById("dosi_area").value = dosi_area; */
                        }
                    })
                })
            });
        });
    })
    function limpiar(){
        var contdosisededepto_id = document.getElementById("especialidades_empresadosi").value;
        var mes = document.getElementById("mesacambiar").value;
        var contratodosimetriasede_id  = document.getElementById("contratodosimetriasede").value;
        var contratodosimetria_id = document.getElementById("contratos_empresadosi").value;
        alert("ESTE ES EL MES"+mes+"ESTE ES EL ID DEL DEPTO"+contdosisededepto_id+"ESTE ES EL ID DE LA SEDE"+contratodosimetriasede_id);
        
        Swal.fire({
            text: 'SEGURO QUE DESEA LIMPIAR LA INFORMACIÓN DE LAS ASIGNACIONES DEL PERÍODO ANTERIOR?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33    ',
            confirmButtonText: 'SI, SEGURO!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.get('limpiar', {contratodosimetriasede_id: contratodosimetriasede_id, contdosisededepto_id: contdosisededepto_id, mes: mes, contratodosimetria_id: contratodosimetria_id}, function(asignacioneslimpias){
                    console.log("LIMPIEZA DE DOSIMETROS CONTROL");
                    console.log(asignacioneslimpias);
                    //se toman todos los elementos a los cuales se les va a cambiar la propiedad disbled, estos tienen la misma propiedad llamada 'cambiar'
                    var cambiarElement = document.querySelectorAll('.cambiar');
                    cambiarElement.forEach(function(element){
                        element.disabled = false;
                        element.options.item(0).text = "---";
                        element.options.item(0).value = null;
                    });
                    var cambiarBoton = document.querySelectorAll('.cambiarBoton');
                    cambiarBoton.forEach(function(element){
                        element.disabled = false;
                    });
                })
            }
        })
    }
    var dosiRetirado = [];
    var dosiAreaRetirado = [];
    var dosiControlRetirado = [];
    
    function eliminarArea(idarea, area){
        console.log('SE SELECCIONO ESTA ASIGNACION'+idarea +area);
        
        Swal.fire({
            title: 'DESEA ELIMINAR ESTA ASIGNACIÓN CORRESPONDIENTE AL DOSÍMETRO AMBIENTAL ' +area+ ' ??',
           /*  text: "EL CAMPO A CAMBIAR SE HABILITARÁ, SELECCIONE EL TRABAJADOR NUEVO", */
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1A9980',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, SEGURO!'
        }).then((result) => {
            if (result.isConfirmed) {
                alert('SE SELECCIONO ESTA ASIGNACION'+idarea +area);
                const element = document.getElementById(idarea+'area');
                dosiAreaRetirado.push({idarea,area});
                console.log(dosiAreaRetirado);
                element.remove();
                
            }
        })
    }
    function eliminar(dosi, ubicacion, nombre){
        
        Swal.fire({
            title: 'DESEA ELIMINAR ESTA ASIGNACIÓN CORRESPONDIENTE AL DOSÍMETRO ' +ubicacion+ ' ??',
            /* text: "EL CAMPO A CAMBIAR SE HABILITARÁ, SELECCIONE EL TRABAJADOR NUEVO", */
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1A9980',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, SEGURO!'
        }).then((result) => {
            if (result.isConfirmed) {
                alert('SE SELECCIONO ESTA ASIGNACION'+ dosi + nombre);
                const element = document.getElementById(dosi);
                dosiRetirado.push({nombre,ubicacion});
                console.log(dosiRetirado);

                element.remove();
                
            }
        })
    }
    function eliminarControl(control, ubicacion){
        
        Swal.fire({
            title: 'DESEA ELIMINAR ESTA ASIGNACIÓN CORRESPONDIENTE AL DOSÍMETRO CONTROL ' +ubicacion+ ' ??',
            /* text: "EL CAMPO A CAMBIAR SE HABILITARÁ, SELECCIONE EL TRABAJADOR NUEVO", */
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1A9980',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, SEGURO!'
        }).then((result) => {
            if (result.isConfirmed) {
                alert('SE SELECCIONO ESTA ASIGNACION CONTROL'+control);
                const element = document.getElementById(control+'control');
                dosiControlRetirado.push({control,ubicacion});
                console.log(dosiControlRetirado);
                element.remove();
            }
        })
    }
    function Generarnotas2(){
        
        console.log('---------------------*****');
        console.log(dosiRetirado);
        console.log(dosiControlRetirado);
        console.log(dosiAreaRetirado);
        console.log('---------------------*****');
        for(var x = 0; x < dosiRetirado.length; x++){
            
            console.log("RETIRO DEL DOSÍMETRO CON UBICACION: "+dosiRetirado[x].ubicacion+" PARA EL TRABAJADOR: "+dosiRetirado[x].nombre);
            let input = `<input type="text" name="inputnotas[]" id="inputnotas`+x+`" class="form-control inputs" value="RETIRO DEL DOSÍMETRO CON UBICACIÓN `+dosiRetirado[x].ubicacion+` PARA EL TRABAJADOR: `+dosiRetirado[x].nombre+`" readonly>`;
            $('#textCard2').append(input);
        }
        for(var x = 0; x < dosiControlRetirado.length; x++){
            console.log("RETIRO DEL DOSÍMETRO: CONTROL "+dosiControlRetirado[x].ubicacion);
            let input = `<input type="text" name="inputnotasControl[]" id="inputnotasControl`+x+`" class="form-control inputs" value="RETIRO DEL DOSÍMETRO CONTROL TRANSPORTE `+dosiControlRetirado[x].ubicacion+`" readonly>`;
            $('#textCard2').append(input);
        }
        for(var x = 0; x < dosiAreaRetirado.length; x++){
            console.log("RETIRO DEL DOSÍMETRO AMBIENTAL DEL ÁREA: "+dosiAreaRetirado[x].area);
            let input = `<input type="text" name="inputnotasAreas[]" id="inputnotasAreas`+x+`" class="form-control inputs" value="RETIRO DEL DOSÍMETRO AMBIENTAL PARA EL ÁREA '`+dosiAreaRetirado[x].area+`'" readonly>`;
            $('#textCard2').append(input);
        }
    }
    function eliminarNotas(){
        for(var x = 0; x < dosiRetirado.length; x++){
            var inputnota = document.getElementById('inputnotas'+x);
            inputnota.remove();
        }
        for(var x = 0; x < dosiControlRetirado.length; x++){
            var inputnotasControl = document.getElementById('inputnotasControl'+x);
            inputnotasControl.remove();
        }
        for(var x = 0; x < dosiAreaRetirado.length; x++){
            var inputnotasAreas = document.getElementById('inputnotasAreas'+x);
            inputnotasAreas.remove();
        }
        
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
            /* var trabajadoresNull = document.querySelectorAll('select[name="id_trabj_asigdosim_null[]"]');
            var trabajadores = document.querySelectorAll('select[name="id_trabj_asigdosim[]"]');

            console.log("ESTAS SON LOS TRABAJADORES");
            console.log(trabajadores);
            console.log(trabajadoresNull);
            if(trabajadoresNull.length == 0 && trabajadores.length == 0){
                return Swal.fire({
                                    title:"NO PUEDE RETIRAR TODOS LOS DOSIMETROS, AL MENOS DEBE TENER UN DOSIMETRO DE TIPO TORAX O EZCLIP",
                                    text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                    icon: 'error'
                                }).then(function() {
                                    var host = window.location.host;
                                    window.location = "http://"+host+"/POSITRON/public/novedades/retiroDosimetro";
                                });
            } */
            /* for(var i = 0; i < trabajadoresNull.length; i++){
                var valuesNull = trabajadoresNull[i].value;
                for(var x = 0; x < trabajadores.length; x++) {
                    var values = trabajadores[x].value;
                    if(values == '' && valuesNull == ''){
                        return Swal.fire({
                                    title:"NO PUEDE RETIRAR TODOS LOS DOSIMETROS, AL MENOS DEBE TENER UN DOSIMETRO DE TIPO TORAX O EZCLIP",
                                    text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                    icon: 'error'
                                });
                        
                    }
                    
                };
            } */
            

           /*  var ubicacion = document.querySelectorAll('select[name="id_ubicacion_asig[]"]');
            console.log("ESTAS SON LAS UBICACIONES");
            console.log(ubicacion);
            for(var i = 0; i < ubicacion.length; i++) {
                var values = ubicacion[i].value;
                if(values == ''){
                   
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGUNA UBICACIÓN",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                }
            }; */
            
            
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

        
    })
</script>
@endsection()