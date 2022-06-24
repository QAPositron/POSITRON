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
                            <option value="2">CAMBIO DE TRABAJADOR</option>
                            <option value="3">CAMBIO EN LA INFORMACIÓN DEL CONTRATO</option>
                        </select>
                    </div>
                    <div class="col-md">
                        {{-- <button class="btn colorQA" type="button" id="button" name="submit" >BUSCAR</button> --}}
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
            {{-- <label class="px-4">INGRESE LAS NUEVAS CANTIDADES DE LOS DOSÍMETROS:</label> --}}
            <label class="px-4">SELECCIONE SI DESEA ADICIONAR UN DOSÍMETRO AL MES ACTUAL O AL SIGUIENTE:</label>
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
            <div class="row px-4">
                <div class="col-md">
                    <div class="card text-dark p-2">
                        <div class="table table-responsive text-center">
                            <table  class="table table-bordered" id="tablaAsignacionDosimetrosmn">
                                <thead class="text-center">
                                    <th style='width: 28.20%' >TRABAJADOR / ÁREA</th>
                                    <th style='width: 16.40%'>UBICACIÓN</th>
                                    <th style='width: 16.40%'>DOSÍMETRO</th>
                                    <th style='width: 16.40%'>HOLDER</th>
                                    <th style='width: 16.40%'>OCUPACIÓN</th>
                                    <th style='width: 16.60%'>ACCIONES</th>
                                </thead>
                                <tbody id="body_asignaciones">
                                    <tr>
                                        <div class="table table-responsive text-center">
                                            <table class="table table-bordered" id="tabla_auxiliar">
                                                <tbody id="tr_control">

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="table table-responsive text-center">
                                            <form id="form_cambio_cantdosim" name="form_cambio_cantdosim" action="{{route('cambiocantdosim.save')}}" method="POST">
                                                @csrf
                                                <table class="table table-bordered" id="tabla_adicional">
                                                    <tbody id="tr_newAsignacion">

                                                    </tbody>
                                                </table>
                                        </div>
                                    </tr>
                                    <div id = "botones"></div>
                                    </form>
                                </tbody>
                                
                            </table>
                            
                        </div> 
                        <br>
                        <br> 
                    </div>
                </div>
            </div>
            
            <br>
        </div>
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

            alert(option);
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
            alert(contrato_id);
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
            alert(sede_id);
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
            alert(contrato_id);
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
        
        $('#especialidades_empresadosi').on('change', function(){
            var especialidad_id = $(this).val();
            alert(especialidad_id);
            if($.trim(especialidad_id) != ''){
                $.get('mesactualcontdosisededepto', {especialidad_id: especialidad_id}, function(mesactual_trabjasig){
                    console.log("ESTE ES EL MES ACTUAL" . mesactual_trabjasig);
                    const vacio = JSON.stringify(mesactual_trabjasig);
                    
                    
                    $('#mesacambiar').empty();
                    $('#mesacambiar').append("<option value=''>--</option>");

                    if(vacio == '{}'){
                        alert("ES EL PRIMER MES");
                        /* var id_contdosisededepto = document.getElementById("especialidades_empresadosi").value;
                        document.getElementById("contdosisededepto_id").value = id_contdosisededepto; */
                        $('#mesacambiar').append("<option value='1'> 1 </option>");
                    }else{
                        alert("NO ES EL PRIMER MES ");
                       /*  var id_contdosisededepto = document.getElementById("especialidades_empresadosi").value;
                        document.getElementById("contdosisededepto_id").value = id_contdosisededepto; */
                        $.each(mesactual_trabjasig, function(index, value){
                            var siguientemes = value+1;
                            $('#mesacambiar').append("<option value='"+ value + "'>" + value + "</option>");
                            $('#mesacambiar').append("<option value='"+ siguientemes + "'>" + siguientemes + "</option>"); 
                        })
                    }

                    

                });
            }
        })
        $('#mesacambiar').on('change', function(){
            var mes = $(this).val();
            alert(mes);
            var contdosisededepto_id = document.getElementById("especialidades_empresadosi").value;
            alert(contdosisededepto_id);
            $.get('dosiasginadoscontrolmesactual', {contdosisededepto_id: contdosisededepto_id, mes: mes}, function(asignacionescontrolmesactual){
                console.log(asignacionescontrolmesactual);
                $('#tr_control').html("");
                for(var i=0; i<asignacionescontrolmesactual.length; i++){
                    var tr = `<tr>
                        <td colspan='2' style='width: 40px' class='align-middle'>CONTROL</td>
                        <td style='width: 198px' class='align-middle'>`+asignacionescontrolmesactual[i].codigo_dosimeter+`</td>
                        <td style='width: 198px' class='align-middle'>NA</td>
                        <td style='width: 198px' class='align-middle'>`+asignacionescontrolmesactual[i].ocupacion+`</td>
                        <td style='width: 95px' class='align-middle'><button id="changeArea" class="btn btn-danger"  type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                    <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </button></td>
                        </tr>`;
                    $("#tr_control").append(tr);
                } 
            });
            $.get('dosiasginadosmesactual', {contdosisededepto_id: contdosisededepto_id, mes: mes}, function(asignacionesmesactual){
                console.log(asignacionesmesactual);
                $('#body_asignaciones').html("");
                for(var i=0; i<asignacionesmesactual.length; i++){
                    var tr = `<tr>
                        <td class='align-middle'>`+asignacionesmesactual[i].primer_nombre_trabajador+` `+asignacionesmesactual[i].primer_apellido_trabajador+` `+asignacionesmesactual[i].segundo_apellido_trabajador+` `+`</td>
                        <td class='align-middle'>`+asignacionesmesactual[i].ubicacion+`</td>
                        <td class='align-middle'>`+asignacionesmesactual[i].codigo_dosimeter+`</td>
                        <td class='align-middle'>`+asignacionesmesactual[i].codigo_holder+`</td>
                        <td class='align-middle'>`+asignacionesmesactual[i].ocupacion+`</td>
                        <td class='align-middle'><button id="changeArea" class="btn btn-danger"  type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                    <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </button></td>
                    </tr>`;
                    $("#body_asignaciones").append(tr);
                }
            });
        });

    });
    /* var selectTrabajadores = document.createElement("select");
    var id_empresa = document.getElementById("empresaDosimetria").value;
    alert(id_empresa);
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
        alert("SE AGREGARON LOS TRABAJADORES");
        console.log(selectTrabajadores);
        
    }); */

    

       
    
    function agregarFila(){
        if($('#botones').find("#assignBtn").length){
        }else{
            alert('No existe');

            $('#botones').append(`<div class="row">
                    <div class="col"></div>
                    <div class="col">
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button id="assignBtn" class="btn colorQA"  onclick="guardar(event)" type="submit">
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
            </div>`);
        }
        
        var selectTrabajadores = document.createElement("select");
       
        var selectDosimetros = document.createElement("select");
        
        var selectHolders = document.createElement("select");
        
        var id_empresa = document.getElementById("empresaDosimetria").value;
        alert(id_empresa);
       
        
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

            @foreach($holdersDisponibles as $holders)
                option = document.createElement("option");
                option.value = '{{$holders->id_holder}}';
                option.text = '{{$holders->codigo_holder}}';
                selectHolders.appendChild(option);
            @endforeach
            console.log(selectHolders.innerHTML);
            
            document.getElementById("tabla_adicional")
            .insertRow(-1).innerHTML += 
                `<td style="width: 27.50%">
                    <select class="form-select" name="id_trabajador_asig" style="text-transform:uppercase">
                        <option value="">----</option>
                        ${selectTrabajadores.innerHTML}
                    </select>
                </td>
                <td style="width: 16.20%">
                    <select class="form-select"  name="id_ubicacion_asig" id="id_ubicacion_asig" style="text-transform:uppercase">
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
                <td style="width: 16.20%">
                    <select class="form-select"  name="id_dosimetro_asig" id="id_dosimetro_asig" style="text-transform:uppercase">
                        <option value="">----</option>
                        ${selectDosimetros.innerHTML}
                    </select>
                </td>
                <td style="width: 16.20%">
                    <select class="form-select"  name="id_holder_asig" id="id_holder_asig" style="text-transform:uppercase">
                        <option value="">----</option>
                        ${selectHolders.innerHTML}
                    </select>
                </td>
                <td style="width: 16.20%">
                    <select class="form-select" name="ocupacion_asig" id="ocupacion_asig" style="text-transform:uppercase">
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
                <td style="width: 17.50%">
                    <button id="" class="btn btn-danger"  type="button" onclick="eliminarFila(this)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </button>
                </td>
            `;
        });
    }
    


    function eliminarFila(row){
        var d = row.parentNode.parentNode.rowIndex;
        document.getElementById('tabla_adicional').deleteRow(d);
    }

    function guardar(event){
        event.preventDefault();
        var res = $("form#form_cambio_cantdosim").serializeArray();
        /* console.log(res); */
        var mesatrabj_asig = document.getElementById("mesacambiar").value;
        var id_contdosisededepto = document.getElementById("especialidades_empresadosi").value; 
        var id_contratodosimetriasede =  document.getElementById("sedes_empresadosi").value; 
        res.push({"mes": mesatrabj_asig });
        res.push({"id_contdosisededepto" : id_contdosisededepto});
        res.push({"id_contratodosimetriasede" : id_contratodosimetriasede});
        
        $.get('novedades', {request: res}, function(data){
            console.log(data);
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
@endsection()