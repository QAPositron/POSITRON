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
                                    <th>DOSIM. CONTROL</th>
                                    <th>DOSIM. TÓRAX</th>
                                    <th>DOSIM. ÁREA</th>
                                    <th>DOSIM. CASO</th>
                                    <th>DOSIM. CRISTALINO</th>
                                    <th>DOSIM. MUÑECA</th>
                                    <th>DOSIM. DEDO</th>
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
                                    <th style='width: 110px'>ACCIONES</th>
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

                                                <table class="table table-bordered" id="tabla_adicional">
                                                    <tbody id="tr_newAsignacion">

                                                    </tbody>
                                                </table>
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

                    <div id='tipoFormulario2' style="display: none; position: relative;">
                        <div class="table table-responsive text-center px-4">
                            <form id="form_cambio_cantdosim2" name="form_cambio_cantdosim2" action="{{route('cambiocantdosimesig.save')}}" method="POST">
                                @csrf
                                <input type="number" hidden name="mes_asig_siguiente" id="mes_asig_siguiente" value="">
                                <input type="number" hidden name="contdosisededepto" id="contdosisededepto" value="">
                                <input type="number" hidden name="contratodosimetriasede" id="contratodosimetriasede" value="">
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
                                        
                                        <table class="table " id="tabla_adicional2">
                                            <tbody id="tr_newAsignacion2">

                                            </tbody>
                                        </table>
                                    </tbody>
                                </table>
                                    
                                
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

        $('#contratos_empresadosi').on('change', function(){
            var contrato_id = $(this).val();
            if($.trim(contrato_id) != ''){
                $.get('contdosisededepto', {contrato_id: contrato_id}, function(contratodosi){
                    console.log(contratodosi);
                    console.log(contratodosi[0].id_contratodosimetria);
                    var fechainicio = contratodosi[0].fecha_inicio;
                    var fechafinal = contratodosi[0].fecha_finalizacion;
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
                $.get('mesactualcontdosisededepto', {especialidad_id: especialidad_id}, function(mesactual_trabjasig){
                    console.log(mesactual_trabjasig);
                    const vacio = JSON.stringify(mesactual_trabjasig);
                    $('#mesacambiar').empty();
                    $('#mesacambiar').append("<option value=''>--</option>");
                    if(vacio == '{}'){
                        $('#mesacambiar').append("<option value='1'> 1 </option>");
                    }else{
                        $.each(mesactual_trabjasig, function(index, value){
                            var siguientemes = value+1;
                            $('#mesacambiar').append("<option value='"+ value + "'>" + value + "</option>");
                            $('#mesacambiar').append("<option value='"+ siguientemes + "'>" + siguientemes + "</option>"); 
                        })
                    }

                    $('#mesacambiar').on('change', function(){
                        var mes = $(this).val();
                        
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
                                        var tr = `<tr>
                                                <td colspan='2' style='width: 75px' class='align-middle'>CONTROL</td>
                                                <td style='width: 190px' class='align-middle'>
                                                    <select class="form-select"  name="id_dosimetro_asigdosimControl[]" id="id_dosimetro_asigdosimControl" ${disacont} >
                                                        <option value="`+asignacionescontrolmesactual[i].id_dosimetro+`">`+codigo_dosimeter+`</option>
                                                        ${selectDosimetros.innerHTML}
                                                    </select>
                                                </td>
                                                <td style='width: 163px' class='align-middle'>NA</td>
                                                <td style='width: 185px' class='align-middle'>
                                                    <select class="form-select" name="ocupacion_asigdosimControl[]" id="ocupacion_asigdosimControl" ${disacont} >
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
                                                    <button id="changeArea" class="btn btn-danger"  type="button">
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
                                                <td colspan='2' style='width: 75px' class='align-middle'>CONTROL</td>
                                                <td style='width: 190px' class='align-middle'>`
                                                    +asignacionescontrolmesactual[i].codigo_dosimeter+
                                                `</td>
                                                <td style='width: 163px' class='align-middle'>NA</td>
                                                <td style='width: 185px' class='align-middle'>`+asignacionescontrolmesactual[i].ocupacion+`</td>
                                                <td style='width: 183px' class='align-middle'>
                                                    <button id="" class="btn btn-danger"  type="button">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tr>`;
                                        $("#tr_control").append(tr);
                                    } 
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
                                        if(asignacionesmesactual[i].codigo_holder != null){

                                            var tr = `<tr>
                                                <td class='align-middle'>
                                                    <input type="text" name="id_trabj_asigdosim[]" id="id_trabj_asigdosim" class="form-control" value="`+asignacionesmesactual[i].id_trabajador+`" hidden>
                                                    <select class="form-select"  name="id_trabj_asigdosim[]" id="id_trabj_asigdosim" disabled>
                                                        <option value="`+asignacionesmesactual[i].id_trabajador+`">`+asignacionesmesactual[i].id_trabajador+` `+asignacionesmesactual[i].primer_nombre_trabajador+` `+asignacionesmesactual[i].primer_apellido_trabajador+` `+asignacionesmesactual[i].segundo_apellido_trabajador+` `+`</option>
                                                    </select>
                                                </td>
                                                <td class='align-middle'><input type="text" name="ubicacion_asigdosim[]" id="ubicacion_asigdosim" class="form-control" value="`+asignacionesmesactual[i].ubicacion+`" readonly></td>
                                                <td class='align-middle'>
                                                    <select class="form-select"  name="id_dosimetro_asigdosim[]" id="id_dosimetro_asigdosim" ${dis} >
                                                        <option value="`+asignacionesmesactual[i].id_dosimetro+`">`+codigo_dosimeter+`</option>
                                                        ${selectDosimetrosEzclip.innerHTML}
                                                    </select>
                                                </td>
                                                <td class='align-middle'>
                                                    <select class="form-select"  name="id_holder_asigdosim[]" id="id_holder_asigdosim" ${dis} >
                                                        <option value="`+asignacionesmesactual[i].id_holder+`">`+codigo_holder+`</option>
                                                        ${selectHolders.innerHTML}
                                                    </select>
                                                </td>
                                                <td class='align-middle'>
                                                    <select class="form-select"  name="id_ocupacion_asigdosim[]" id="id_ocupacion_asigdosim" ${dis} >
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
                                                            <button id="" class="btn btn-danger"  type="button">
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
                                            var tr = `<tr>
                                                <td class='align-middle'>
                                                    <input type="text" name="id_trabj_asigdosim_null[]" id="id_trabj_asigdosim_null" class="form-control" value="`+asignacionesmesactual[i].id_trabajador+`" hidden>
                                                    <select class="form-select"  name="id_trabj_asigdosim_null[]" id="id_trabj_asigdosim_null" disabled>
                                                        <option value="`+asignacionesmesactual[i].id_trabajador+`">`+asignacionesmesactual[i].primer_nombre_trabajador+` `+asignacionesmesactual[i].primer_apellido_trabajador+` `+asignacionesmesactual[i].segundo_apellido_trabajador+` `+`</option>
                                                    </select>
                                                </td>
                                                <td class='align-middle'><input type="text" name="ubicacion_asigdosim_null[]" id="ubicacion_asigdosim_null" class="form-control" value="`+asignacionesmesactual[i].ubicacion+`" readonly></td>
                                                <td class='align-middle'>
                                                    <select class="form-select"  name="id_dosimetro_asigdosim_null[]" id="id_dosimetro_asigdosim_null" ${dis}>
                                                        <option value="`+asignacionesmesactual[i].id_dosimetro+`">`+codigo_dosimeter+`</option>
                                                        ${selectDosimetros.innerHTML}
                                                    </select>
                                                </td>
                                                <td class='align-middle'> NA </td>
                                                <td class='align-middle'>
                                                    <select class="form-select"  name="id_ocupacion_asigdosim_null[]" id="id_ocupacion_asigdosim_null" ${dis}>
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
                                                            <button id="" class="btn btn-danger"  type="button">
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
                                        if(asignacionesmesactual[i].codigo_holder != null){
                                            var tr = `<tr>
                                                <td class='align-middle'>`+asignacionesmesactual[i].primer_nombre_trabajador+` `+asignacionesmesactual[i].primer_apellido_trabajador+` `+asignacionesmesactual[i].segundo_apellido_trabajador+` `+`</td>
                                                <td class='align-middle'>`+asignacionesmesactual[i].ubicacion+`</td>
                                                <td class='align-middle'>`+asignacionesmesactual[i].codigo_dosimeter+`</td>
                                                <td class='align-middle'>`+asignacionesmesactual[i].codigo_holder+`</td>
                                                <td class='align-middle'>`+asignacionesmesactual[i].ocupacion+`</td>
                                                <td class='align-middle'>
                                                    <button id="" class="btn btn-danger"  type="button">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tr>`;
                                            $("#body_asignaciones").append(tr);
                                        }else{
                                            var tr = `<tr>
                                                <td class='align-middle'>`+asignacionesmesactual[i].primer_nombre_trabajador+` `+asignacionesmesactual[i].primer_apellido_trabajador+` `+asignacionesmesactual[i].segundo_apellido_trabajador+` `+`</td>
                                                <td class='align-middle'>`+asignacionesmesactual[i].ubicacion+`</td>
                                                <td class='align-middle'>`+asignacionesmesactual[i].codigo_dosimeter+`</td>
                                                <td class='align-middle'> NA </td>
                                                <td class='align-middle'>`+asignacionesmesactual[i].ocupacion+`</td>
                                                <td class='align-middle'>
                                                    <button id="" class="btn btn-danger"  type="button">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tr>`;
                                            $("#body_asignaciones").append(tr);
                                            
                                        }
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
                option.value = trabajadores[i].id_trabajador;
                option.text = trabajadores[i].primer_nombre_trabajador+` `+trabajadores[i].primer_apellido_trabajador+` `+trabajadores[i].segundo_apellido_trabajador;
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
                                    <option value="CONTROL">CONTROL</option>
                                    <option value="TORAX">TORAX</option>
                                    <option value="AREA">ÁREA</option>
                                    <option value="CASO">CASO</option>
                                    <option value="CRISTALINO">CRISTALINO</option>
                                    <option value="MUÑECA">MUÑECA</option>
                                    <option value="DEDO">DEDO</option>
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
                                    <option value="CONTROL">CONTROL</option>
                                    <option value="TORAX">TORAX</option>
                                    <option value="AREA">ÁREA</option>
                                    <option value="CASO">CASO</option>
                                    <option value="CRISTALINO">CRISTALINO</option>
                                    <option value="MUÑECA">MUÑECA</option>
                                    <option value="DEDO">DEDO</option>
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
            for(var i=0; i<asignacioneslimpias.length; i++){


                $("#id_dosimetro_asigdosim").prop('disabled', false);
                $("#id_holder_asigdosim").prop('disabled', false);
                $("#id_ocupacion_asigdosim").prop('disabled', false); 
                if(asignacioneslimpias[i].ubicacion == 'TORAX'){

                    $("#id_dosimetro_asigdosimnull").prop('disabled', false);
                    $("#id_ocupacion_asigdosimnull").prop('disabled', false);
                }
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