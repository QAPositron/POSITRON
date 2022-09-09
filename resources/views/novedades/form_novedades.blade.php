@extends('layouts.plantillabase')
@section('contenido')

<div class="row pt-5">
    <div class="col-md">
        <div class="card text-dark bg-light">
            <h3 class="p-4">FORMULARIOS DE NOVEDADES</h3>
            <form id="form_tipo_novedad" class="m-4" >
                <div class="row">
                    <label for="exampleFormControlInput1" class="form-label ">TIPOS DE NOVEDADES: </label>
                    <div class="col-md">
                        <select class="form-select" name="tipo_novedad" id="tipoNovedad">
                            <option value="">---</option>
                            <option value="1">CAMBIO DE LA CANTIDAD DE DOSÍMETROS</option>
                            {{-- <option value="2">CAMBIO DE TRABAJADOR</option> --}}
                            <option value="3">CAMBIO EN LA INFORMACIÓN DEL CONTRATO</option>
                        </select>
                    </div>
                    <div class="col-md">
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id='tipoNovedad1' class="row pt-2" style="visibility: hidden">
    <div class="col-md">
        <div class="card text-dark bg-light">
            
            <div class="row p-4">
                <div class="col-md">
                    <div class="form-floating">
                        <select class="form-select" name="empresaDosimetria" id="empresaDosimetria" value="" autofocus style="text-transform:uppercase;">
                            <option value="">--SELECCIONE--</option>
                            @foreach($empresasDosi as $empdosi)
                                <option value="{{$empdosi->id_contratodosimetria_emp}}">{{$empdosi->nombre_empresa}}</option>
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
            <br>
            <div class="row px-4">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="date" class="form-control" name="fechainicio_contratodosi" id="fechainicio_contratodosi" autofocus style="text-transform:uppercase" readonly>
                        <label for="floatingInput">FECHA DE INICIO</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        <input type="date" class="form-control" name="fechafin_contratodosi" id="fechafin_contratodosi" autofocus style="text-transform:uppercase" readonly>
                        <label for="floatingInput">FECHA DE FINALIZACIÓN</label>
                    </div>
                </div>
            </div>
            <br>
            <label class="px-4">HISTORIAL DE CAMBIOS:</label>
            <div class="row px-4">
                <div class="col-md"></div>
                <div class="col-md">
                    <div class="table table-responsive p-4">
                        <table class="table table-bordered">
                            <thead class ="text-center">
                                <tr>
                                    <th>MESES</th>
                                    <th>DOSIM. TÓRAX</th>
                                    <th>DOSIM. CRISTALINO</th>
                                    <th>DOSIM. ANILLO</th>
                                    <th>DOSIM. MUÑECA</th>
                                    <th>DOSIM. CONTROL</th>
                                    <th>DOSIM. ÁREA</th>
                                    <th>DOSIM. CASO</th>
                                </tr>
                            </thead>
                            <tbody id="tabla_meses">
                                <tr>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md"></div>
            </div>
            
            <label class="px-4">SELECCIONE SI DESEA ADICIONAR UN DOSÍMETRO AL MES ACTUAL O AL SIGUIENTE Y GUARDAR SUS ASIGNACIONES:</label>
            <br>
            <br>
            <div class="row">
                <div class="col-md">

                </div>
                <div class="col-md-1">
                    <label for="" class="text-center align-middle">MES A CAMBIAR</label>
                </div>
                <div class="col d-grid gap-2">
                    <select class="form-select" name="mesacambiar" id="mesacambiar">
                               
                    </select>
                </div>
                <div class="col d-grid gap-2">
                    <button class="btn colorQA" id="agregar" name="agregar" onclick="agregarFila()">NUEVO DOSÍMETRO</button>
                </div>
                <div class="col-md">

                </div>
            </div>
            <br>
            <br>
            <div class="row px-2">
                <div class="col-md">
                    
                    <div id='tipoFormulario1' style="display: none; position: relative;">
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
                                                    <div class="col-6">
                                                        <label for="floatingInputGrid"><b>NOTAS Y OBSERVACIONES:</b></label>
                                                        <textarea class="form-control" name="nota_cambio_dosimetros" id="nota_cambio_dosimetros" rows="3" autofocus style="text-transform:uppercase"></textarea>
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
                    {{-- <div id='fechas' style="display: none; position: relative;">
                        
                    </div>  --}}
                    <div id='tipoFormulario2' style="display: none; position: relative;">
                        <div class="table table-responsive text-center px-4">
                            <form id="form_cambio_cantdosim2" name="form_cambio_cantdosim2" action="{{route('cambiocantdosimesig.save')}}" method="POST">
                                @csrf
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
                                            <label for="floatingInputGrid">ULTIMO DÍA:</label>
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
                                        <th style='width: 110px'>ACCIONES</th>
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
                                    <div class="col-6">

                                        <label for="floatingInputGrid"><b>NOTAS Y OBSERVACIONES:</b></label>
                                        <textarea class="form-control" name="nota_cambio_dosimetros" id="nota_cambio_dosimetros" rows="3" autofocus style="text-transform:uppercase"></textarea>

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
                                    <div class="col">
                                        <div class="d-grid gap-2 col-6 mx-auto">
                                            <button {{-- onclick="limpiar()" --}} class="btn btn-primary"  type="button" id="limpiar_asig" name="limpiar_asig" role="button">
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
                <br>
                <br>
                <br>  
            </div>
            
        </div>
        <br>
        <br>
    </div>
</div>
<div id='tipoNovedad2' class="row pt-2" style="visibility: hidden; position: relative; bottom:660px;">
    <div class="col-md">
        <div class="card text-dark bg-light">
            <div class="row">
                <div class="col-md"></div>
                <div class="col-md">
                    <h4>NOVEDAD 2</h4>
                </div>
                <div class="col-md"></div>
            </div>
        </div>
    </div>        
</div>
<script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous">
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#form_tipo_novedad').change(function(){
            var option = document.getElementById("tipoNovedad").value;
            var tipoNovedad1 = document.getElementById("tipoNovedad1");
            var tipoNovedad2 = document.getElementById("tipoNovedad2");
            if(option == 1){
                tipoNovedad1.style.visibility= "visible";
            }else{
                tipoNovedad1.style.visibility= "hidden";
            }
            if(option == 2){
                tipoNovedad2.style.visibility = "visible";
            }else{
                tipoNovedad2.style.visibility= "hidden";
            }

        })



        $('#empresaDosimetria').on('change', function(){
            var empresa_id = $(this).val();
            if($.trim(empresa_id) != ''){
                $.get('contratoDosi', {empresa_id: empresa_id}, function(contratos){
                    console.log(contratos);
                    $('#contratos_empresadosi').empty();
                    $('#contratos_empresadosi').append("<option value=''>--SELECCIONE UN CONTRATO--</option>");
                    $.each(contratos, function(index, value){
                        $('#contratos_empresadosi').append("<option value='"+ index + "'>" + value + "</option>");
                    })
                });
            }
        })

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
            }
        })

        $('#sedes_empresadosi').on('change', function(){
            var sede_id = $(this).val();
            if($.trim(sede_id) != ''){
                $.get('especialidadescontDosi', {sede_id: sede_id}, function(especialidades){
                    console.log(especialidades);
                    $('#especialidades_empresadosi').empty();
                    $('#especialidades_empresadosi').append("<option value=''>--SELECCIONE UNA ESPECIALIDAD DEL CONTRATO--</option>");
                    $.each(especialidades, function(index, value){
                        $('#especialidades_empresadosi').append("<option value='"+ index + "'>" + value + "</option>");
                    })
                });
            }
        })
var myFechaInicial;
        $('#contratos_empresadosi').on('change', function(){
            var contrato_id = $(this).val();
            if($.trim(contrato_id) != ''){
                $.get('contdosisededepto', {contrato_id: contrato_id}, function(contratodosi){
                    console.log(contratodosi);
                    console.log("INFORMACION DEL CONTRATO"+contratodosi[0].id_contratodosimetria);
                    var fechainicio = contratodosi[0].fecha_inicio;
                    var fechafinal = contratodosi[0].fecha_finalizacion;
                    console.log(fechainicio);
                    myFechaInicial = new Date(fechainicio);
                    console.log(myFechaInicial);
                    document.getElementById("fechainicio_contratodosi").value = fechainicio;
                    document.getElementById("fechafin_contratodosi").value = fechafinal;
                    
                });
            }
        })

        

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
            if($.trim(especialidad_id) != ''){
                $.get('meseschangecontratoDosi', {especialidad_id: especialidad_id}, function(todoslos_meses){
                    console.log("ESTOS SON TODOS LOS MESES");
                    console.log(todoslos_meses);
                    for(var i=0; i<todoslos_meses.length; i++){
                        if(todoslos_meses[i].dosi_control == null && todoslos_meses[i].dosi_torax == null && todoslos_meses[i].dosi_cristalino == null && todoslos_meses[i].dosi_muñeca == null && todoslos_meses[i].dosi_dedo == null){

                        }else{
                            var tr = `<tr>
                                    <td class='align-middle text-center'>`+todoslos_meses[i].mes_asignacion+`</td>
                                    <td class='align-middle text-center'>`+todoslos_meses[i].dosi_torax+`</td>
                                    <td class='align-middle text-center'>`+todoslos_meses[i].dosi_cristalino+`</td>
                                    <td class='align-middle text-center'>`+todoslos_meses[i].dosi_dedo+`</td>
                                    <td class='align-middle text-center'>`+todoslos_meses[i].dosi_muñeca+`</td>
                                    <td class='align-middle text-center'>`+todoslos_meses[i].dosi_control+`</td>
                                    <td class='align-middle text-center'></td>
                                    <td class='align-middle text-center'></td>
                                </tr>`;
                            $("#tabla_meses").append(tr);
                        }
                    }
                })
                $.get('mesactualcontdosisededepto', {especialidad_id: especialidad_id}, function(mesactual_trabjasig){
                    console.log(mesactual_trabjasig);
                    const vacio = JSON.stringify(mesactual_trabjasig);
                    $('#mesacambiar').empty();
                    $('#mesacambiar').append("<option value=''>--</option>");
                    const meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
                     
                    if(vacio == '{}'){
                        
                        var r = new Date(new Date(myFechaInicial).setMonth(myFechaInicial.getMonth()+1));
                        var fechaesp = meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                        $('#mesacambiar').append("<option value='1'> 1 -  </option>");
                    }else{
                        
                        $.each(mesactual_trabjasig, function(index, value){
                            var r = new Date(new Date(myFechaInicial).setMonth(myFechaInicial.getMonth()+value));  
                            var r2 = new Date(new Date(myFechaInicial).setMonth(myFechaInicial.getMonth()+value+1));    
                            var fechaesp = meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                            var fechaesp2 = meses[r2.getMonth()] + ' DE ' + r.getUTCFullYear();

                            var siguientemes = value+1;
                            $('#mesacambiar').append("<option value='"+ value + "'>" + value + " ("+ fechaesp + ")" + "</option>");
                            $('#mesacambiar').append("<option value='"+ siguientemes + "'>" + siguientemes + " ("+ fechaesp2 + ")" + "</option>"); 
                        })
                    }

                    $('#mesacambiar').on('change', function(){
                        var mes = $(this).val();

                        var dosi_control = 0;
                        var dosi_torax= 0;
                        var dosi_area = 0;
                        var dosi_caso = 0;
                        var dosi_cristalino = 0;
                        var dosi_muñeca = 0;
                        var dosi_dedo = 0;
                        
                        alert("MES SELECCIONADO" +mes);
                        $.each(mesactual_trabjasig, function(index, value){
                            console.log("LA CONSULTA"+value);
                            tipoFormulario2.style.display= "none";
                            tipoFormulario1.style.display= "none";
                            if(mes == value){
                                tipoFormulario1.style.display= "block";
                            }else if (mes > value){
                                tipoFormulario2.style.display= "block";
                            }else{
                                tipoFormulario2.style.display= "none";
                            }
                            
                            //////////////// PARA CUANDO SELECCIONA EL MES ACTUAL DEL CONTRATO ///////////////////////
                            
                            var contdosisededepto_id = document.getElementById("especialidades_empresadosi").value;
                            var contratodosimetriasede_id  = document.getElementById("sedes_empresadosi").value;
                            /* alert("ID CONTRATODOSIMETRIA SEDE"+contratodosimetriasede_id);
                            alert("MES SELECCIONADO"+value); */

                            $.get('dosiasginadoscontrolmesactual', {contdosisededepto_id: contdosisededepto_id, mes: value}, function(asignacionescontrolmesactual){
                                console.log(asignacionescontrolmesactual);
                                 $('#tr_control').html("");
                                
                                if(mes > value){
                                    /* alert("CNTROL PARA EL MES SIGUEINTE AL ACTUAL"); */
                                    for(var i=0; i<asignacionescontrolmesactual.length; i++){
                                        if(asignacionescontrolmesactual[i].dosimetro_uso != 'FALSE'){
                                            var disacont = 'disabled';
                                            var codigo_dosimeter = asignacionescontrolmesactual[i].codigo_dosimeter;
                                            var ocupacion = asignacionescontrolmesactual[i].ocupacion;
                                        }else{
                                            var codigo_dosimeter = '---';
                                            var ocupacion = '---';
                                        }
                                        
                                        var tr = `<tr id="`+asignacionescontrolmesactual[i].id_dosicontrolcontdosisedes+`">
                                                <td colspan='2' style='width: 75px' class='align-middle'>CONTROL</td>
                                                <td style='width: 190px' class='align-middle'>
                                                    <select class="form-select cambiar"  name="id_dosimetro_asigdosimControl[]" id="id_dosimetro_asigdosimControl" ${disacont} >
                                                        <option value="`+asignacionescontrolmesactual[i].id_dosimetro+`">`+codigo_dosimeter+`</option>
                                                        ${selectDosimetros.innerHTML}
                                                    </select>
                                                </td>
                                                <td style='width: 163px' class='align-middle'>NA</td>
                                                <td style='width: 185px' class='align-middle'>
                                                    <select class="form-select cambiar" name="ocupacion_asigdosimControl[]" id="ocupacion_asigdosimControl" ${disacont} >
                                                        <option value="`+asignacionescontrolmesactual[i].ocupacion+`">`+ocupacion+`</option>
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
                                                <td style='width: 183px' class='align-middle'>
                                                    <button id="changeArea" class="btn btn-danger"  type="button" onclick="eliminarControl(`+asignacionescontrolmesactual[i].id_dosicontrolcontdosisedes+`);">
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
                                    /* alert("CNTROL PARA EL MES ACTUAL"); */
                                    for(var i=0; i<asignacionescontrolmesactual.length; i++){
                                        
                                        var tr = `<tr>
                                                <td colspan='2' class='align-middle'>CONTROL</td>
                                                <td style='width: 208px'class='align-middle'>`
                                                    +asignacionescontrolmesactual[i].codigo_dosimeter+
                                                `</td>
                                                <td style='width: 208px' class='align-middle'>NA</td>
                                                <td style='width: 208px' class='align-middle'>`+asignacionescontrolmesactual[i].ocupacion+`</td>
                                                    
                                            </tr>`;
                                        $("#tr_control").append(tr);
                                        
                                        dosi_control += 1;
                                        console.log("EL VALOR DEL DOSI CONTROL PARA EL MES ACTUAL");
                                        console.log(dosi_control);
                                    } 
                                    document.getElementById("dosi_control").value = dosi_control;
                                }
                                        
                            });
                            $.get('dosiasginadosmesactual', {contratodosimetriasede_id: contratodosimetriasede_id, contdosisededepto_id: contdosisededepto_id, mes: value}, function(asignacionesmesactual){
                                console.log(asignacionesmesactual);
                                $('#body_asignaciones').html("");
                                
                                if(mes > value){
                                    /* alert("ASIGNACIONES PARA EL MES SIGUIENTE AL ACTUAL"); */
                                    for(var i=0; i<asignacionesmesactual.length; i++){
                                        var id_dosimetro = asignacionesmesactual[i].id_dosimetro;
                                        if(asignacionesmesactual[i].dosimetro_uso != 'FALSE'){
                                            var dis = 'disabled';
                                            var codigo_dosimeter = asignacionesmesactual[i].codigo_dosimeter;
                                            var codigo_holder = asignacionesmesactual[i].codigo_holder;
                                            var ocupacion = asignacionesmesactual[i].ocupacion;
                                        }else{
                                            var codigo_dosimeter = '---';
                                            var codigo_holder = '---';
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
                                                    <input type="text" name="id_trabj_asigdosim[]" id="id_trabj_asigdosim" class="form-control" value="`+asignacionesmesactual[i].id_persona+`" hidden>
                                                    <select class="form-select"  name="id_trabj_asigdosim[]" id="id_trabj_asigdosim" disabled>
                                                        <option value="`+asignacionesmesactual[i].id_persona+`">`+asignacionesmesactual[i].primer_nombre_persona+` `+asignacionesmesactual[i].primer_apellido_persona+` `+asignacionesmesactual[i].segundo_apellido_persona+` `+`</option>
                                                    </select>
                                                </td>
                                                <td class='align-middle'><input type="text" name="ubicacion_asigdosim[]" id="ubicacion_asigdosim" class="form-control" value="`+asignacionesmesactual[i].ubicacion+`" readonly></td>
                                                <td class='align-middle'>
                                                    <select class="form-select cambiar"  name="id_dosimetro_asigdosim[]" id="id_dosimetro_asigdosim" ${dis} >
                                                        <option value="`+asignacionesmesactual[i].id_dosimetro+`">`+codigo_dosimeter+`</option>
                                                        ${selectDosimetrosEzclip.innerHTML}
                                                    </select>
                                                </td>
                                                <td class='align-middle'>
                                                    <select class="form-select cambiar"  name="id_holder_asigdosim[]" id="id_holder_asigdosim" ${dis} >
                                                        <option value="`+asignacionesmesactual[i].id_holder+`">`+codigo_holder+`</option>
                                                        ${selectHolders.innerHTML}
                                                    </select>
                                                </td>
                                                <td class='align-middle'>
                                                    <select class="form-select cambiar"  name="id_ocupacion_asigdosim[]" id="id_ocupacion_asigdosim" ${dis} >
                                                        <option value="`+asignacionesmesactual[i].ocupacion+`">`+ocupacion+`</option>
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
                                                <td class='align-middle'>
                                                    <div class='row px-1'>
                                                        <div class='col'>
                                                            <button id="" class="btn btn-danger"  type="button"  onclick="eliminarEzclip(`+asignacionesmesactual[i].id_trabajadordosimetro+`, '`+asignacionesmesactual[i].ubicacion+`');">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>`;
                                            $("#body_asignaciones2").append(tr);
                                        }else{
                                            var tr = `<tr id="`+asignacionesmesactual[i].id_trabajadordosimetro+`">
                                                <td class='align-middle'>
                                                    <input type="text" name="id_trabj_asigdosim_null[]" id="id_trabj_asigdosim_null" class="form-control" value="`+asignacionesmesactual[i].id_persona+`" hidden>
                                                    <select class="form-select"  name="id_trabj_asigdosim_null[]" id="id_trabj_asigdosim_null" disabled>
                                                        <option value="`+asignacionesmesactual[i].id_persona+`">`+asignacionesmesactual[i].primer_nombre_persona+` `+asignacionesmesactual[i].primer_apellido_persona+` `+asignacionesmesactual[i].segundo_apellido_persona+` `+`</option>
                                                    </select>
                                                </td>
                                                <td class='align-middle'><input type="text" name="ubicacion_asigdosim_null[]" id="ubicacion_asigdosim_null" class="form-control" value="`+asignacionesmesactual[i].ubicacion+`" readonly></td>
                                                <td class='align-middle'>
                                                    <select class="form-select cambiar"  name="id_dosimetro_asigdosim_null[]" id="id_dosimetro_asigdosim_null" ${dis}>
                                                        <option value="`+asignacionesmesactual[i].id_dosimetro+`">`+codigo_dosimeter+`</option>
                                                        ${selectDosimetros.innerHTML}
                                                    </select>
                                                </td>
                                                <td class='align-middle'> NA </td>
                                                <td class='align-middle'>
                                                    <select class="form-select cambiar"  name="id_ocupacion_asigdosim_null[]" id="id_ocupacion_asigdosim_null" ${dis}>
                                                        <option value="`+asignacionesmesactual[i].ocupacion+`">`+ocupacion+`</option>
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
                                                <td class='align-middle'>
                                                    <div class='row px-1'>
                                                       
                                                        <div class='col'>    
                                                            <button id="" class="btn btn-danger"  type="button" onclick="eliminarTorax(`+asignacionesmesactual[i].id_trabajadordosimetro+`, '`+asignacionesmesactual[i].ubicacion+`');">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
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
                                        if(asignacionesmesactual[i].ubicacion == 'TORAX'){
                                            dosi_torax += 1;
                                        }else if(asignacionesmesactual[i].ubicacion == 'CRISTALINO'){
                                            dosi_cristalino += 1;
                                        }else if(asignacionesmesactual[i].ubicacion == 'MUÑECA'){
                                            dosi_muñeca += 1 ;
                                        }else if(asignacionesmesactual[i].ubicacion == 'DEDO'){
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
                            
                        })

                    });
                });
            }
        })

        
    });
    
    
    function agregarFila(){
    
        var mes = document.getElementById("mesacambiar").value;
        
        alert("EL MES SELECCIONADO es"+mes);
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

       
        $.get('trabajadoresempresa', {id_empresa: id_empresa}, function(trabajadores){
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
            
                $.each(mesactual_trabjasig, function(index, value){
                    if(mes > value){

                        alert("si entro, el mes siguiente al actual");

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
                                <select class="form-select" name="id_trabajador_asig[]"  id="id_trabajador_asig" style="text-transform:uppercase">
                                    <option value="">----</option>
                                    ${selectTrabajadores.innerHTML}
                                </select>
                            </td>
                            <td style="width: 14.50%">
                                <select class="form-select"  name="id_ubicacion_asig[]" id="id_ubicacion_asig" style="text-transform:uppercase">
                                    <option value="">----</option>
                                    <option value="TORAX">TORAX</option>
                                    <option value="CRISTALINO">CRISTALINO</option>
                                    <option value="DEDO">ANILLO</option>
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
                            <td style="width: 24.80%">
                                <button id="" class="btn btn-danger"  type="button" onclick="eliminarFilaform2(this)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </button>
                            </td>
                        `;
                    }else{
                        alert("si entrO, es el MES actual");

                        var mestrabj_asig = document.getElementById("mesacambiar").value;
                        var id_contdosisededepto = document.getElementById("especialidades_empresadosi").value; 
                        var id_contratodosimetriasede =  document.getElementById("sedes_empresadosi").value; 
                        document.getElementById("mestrabj_asig").value = mestrabj_asig;
                        document.getElementById("id_contdosisededepto").value = id_contdosisededepto;
                        document.getElementById("id_contratodosimetriasede").value = id_contratodosimetriasede;

                        document.getElementById("tabla_adicional")
                        .insertRow(-1).innerHTML += 
                            `<td style="width: 27.30%">
                                <select class="form-select" name="id_trabajador_asig[]"  id="id_trabajador_asig" style="text-transform:uppercase">
                                    <option value="">----</option>
                                    ${selectTrabajadores.innerHTML}
                                </select>
                            </td>
                            <td style="width: 14.50%">
                                <select class="form-select"  name="id_ubicacion_asig[]" id="id_ubicacion_asig" style="text-transform:uppercase">
                                    <option value="">----</option>
                                    <option value="TORAX">TORAX</option>
                                    <option value="CRISTALINO">CRISTALINO</option>
                                    <option value="DEDO">ANILLO</option>
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
                            <td style="width: 24.80%">
                                <button id="" class="btn btn-danger"  type="button" onclick="eliminarFila(this)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </button>
                            </td>
                        `;
                    }
                    
                    
                })
            })
        });
    }

    function eliminarFila(row){
        var d = row.parentNode.parentNode.rowIndex;
        document.getElementById('tabla_adicional').deleteRow(d);
    }
    function eliminarFilaform2(row){
        var e = row.parentNode.parentNode.rowIndex;
        document.getElementById('tabla_adicional2').deleteRow(e);
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
    function eliminarEzclip(ezclip, ubicacion){
        
        Swal.fire({
            title: 'DESEA ELIMINAR ESTA ASIGNACIÓN CORRESPONDIENTE AL DOSÍMETRO ' +ubicacion+ ' ??',
           /*  text: "EL CAMPO A CAMBIAR SE HABILITARÁ, SELECCIONE EL TRABAJADOR NUEVO", */
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1A9980',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, SEGURO!'
        }).then((result) => {
            if (result.isConfirmed) {
                alert('SE SELECCIONO ESTA ASIGNACION'+ezclip);
                const element = document.getElementById(ezclip);
                element.remove();
                
            }
        })
    }
    function eliminarTorax(torax, ubicacion){
        
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
                alert('SE SELECCIONO ESTA ASIGNACION'+torax);
                const element = document.getElementById(torax);
                element.remove();
                
            }
        })
    }
    function eliminarControl(control){
        
        Swal.fire({
            title: 'DESEA ELIMINAR ESTA ASIGNACIÓN CORRESPONDIENTE AL DOSÍMETRO CONTROL ??',
            /* text: "EL CAMPO A CAMBIAR SE HABILITARÁ, SELECCIONE EL TRABAJADOR NUEVO", */
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1A9980',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, SEGURO!'
        }).then((result) => {
            if (result.isConfirmed) {
                alert('SE SELECCIONO ESTA ASIGNACION'+control);
                const element = document.getElementById(control);
                element.remove();
                
            }
        })
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
<script type="text/javascript">
    $(document).ready(function(){
        $('#form_cambio_cantdosim').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "DESEA GUARDAR ESTA ASIGNACIÓN??",
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
<script type="text/javascript">
    $(document).ready(function(){
        $('#form_cambio_cantdosim2').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "DESEA GUARDAR ESTA ASIGNACIÓN??",
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

<script type="text/javascript">
    $(document).ready(function(){

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