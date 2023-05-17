@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col-md"></div>
    <div class="col-md-14">

        <div class="card text-dark bg-light">
            <h2 class="text-center mt-3" id="nueva_empresaModalLabel">EDITAR CONTRATO DE DOSIMETRÍA <br> PARA LA EMPRESA: <i>{{$contrato->empresa->nombre_empresa}}</i> </h2>
            <div class="row">
                <div class="col"></div>
                <div class="col-11 ">
                    <div class="card w-150">
        
                        <form class="m-4" action="{{route('contratosdosi.update', $contrato)}}"  method="POST" id="form_contrato_dosi">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-floating my-3" id="codigo_contrato">
                                        <input type="text" name="empresa_contrato" hidden id="empresa_contrato" value="{{$contrato->empresa->id_empresa}}">
                                        <input type="number" name="codigo_contrato" id="codigo_contrato_input" class="form-control @error('codigo_contrato') is-invalid @enderror"  value="" autofocus readonly>
                                        <label for="floatingInputGrid">CODIGO:</label>
                                        @error('codigo_contrato')
                                            <small class="invalid-feedback">*{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-floating my-3" id="periodo_recambio_contrato">
                                        <select class="form-select @error('periodo_recambio_contrato') is-invalid @enderror" name="periodo_recambio_contrato" id="periodo_recambio_contrato_select"  autofocus>
                                            <option value="{{$contrato->periodo_recambio}}">--{{$contrato->periodo_recambio}}--</option>
                                            <option value="MENS">MENSUAL</option>
                                            {{-- <option value="SEMS">SEMESTRAL</option> --}}
                                            {{-- <option value="BIMS">BIMESTRAL</option> --}}
                                            <option value="TRIMS">TRIMESTRAL</option>
                                        </select>
                                        <label for="floatingInputGrid">PERIODO DE RECAMBIO:</label>
                                        @error('periodo_recambio_contrato')
                                            <small class="invalid-feedback">*{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-floating my-3" id="fecha_inicio_contrato">
                                        <input type="date" name="fecha_inicio_contrato" id="fecha_inicio_contrato_input" class="form-control @error('fecha_inicio_contrato') is-invalid @enderror" {{-- onchange="fechafinalcontrato();" --}} value="{{$contrato->fecha_inicio}}" autofocus>
                                        <label for="floatingInputGrid">FECHA DE INICIO:</label>
                                        @error('fecha_inicio_contrato')
                                            <small class="invalid-feedback">*{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-floating my-3" id="fecha_finalizacion_contrato">
                                        <input type="date" name="fecha_finalizacion_contrato" id="fecha_finalizacion_contrato_input" class="form-control @error('fecha_finalizacion_contrato') is-invalid @enderror" value="{{$contrato->fecha_finalizacion}}" autofocus >
                                        <label for="floatingInputGrid" >FECHA DE FINALIZACIÓN</label>
                                        @error('fecha_finalizacion_contrato')
                                            <small class="invalid-feedback">*{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-floating my-3" id="estado_contrato">
                                        <select class="form-select @error('estado_contrato') is-invalid @enderror" name="estado_contrato" id="estado_contrato_select"  autofocus>
                                            <option value="{{$contrato->estado_contrato}}">--{{$contrato->estado_contrato}}--</option>
                                            <option value="ACTIVO">ACTIVO</option>
                                            <option value="INACTIVO">INACTIVO</option>
                                        </select>
                                        <label for="floatingInputGrid">ESTADO:</label>
                                        @error('estado_contrato')
                                            <small class="invalid-feedback">*{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                           

                            
                            <hr>
                            <label class="text-center ms-4">ASIGNE A ESTE CONTRATO UNA O MÁS SEDES:</label>
        
                            <div class="row mt-2">
                                <div class="col-md text-center">
                                    <button onclick="readySede()" class="btn btn-sm colorQA" id="agregar">AGREGAR SEDE </button>
                                    <button type="button" class="btn btn-sm bg-danger" id="agregar" onclick="deleteElement()">ELIMINAR SEDE </button>
                                </div>
                            </div>
                            <br>
                            <div hidden class="container-fluid" id="clonar">
                                <div class="rounded  m-3 p-3 border border-light active">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-floating my-3">
                                                <select class="form-select @error('id_sede') is-invalid @enderror" id="id_sede">
                                                    <option value="">--SELECCIONE--</option>
                                                    @foreach($sedes as $sed)
                                                        <option value ="{{$sed->id_sede}}">{{$sed->nombre_sede}}</option>
                                                    @endforeach
                                                </select>
                                                <?php
                                                $value = null;
                                                ?>
                                                <label for="floatingSelectGrid">SEDE:</label>
                                                @error('id_sede')
                                                    <small class="invalid-feedback">*{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md mt-4">
                                            <button onclick="addDepa()" type="button" class="btn btn-sm colorQA" id="agregarDepto1">AGREGAR DTO.</button>
                                        </div>
                                        <div class="col-md mt-4">
                                            <button type="button" class="btn btn-sm bg-danger" id="agregar1" onclick="deleteDepa()">ELIMINAR DTO.</button>
                                        </div>
                                        <div class="col-md"></div>
                                        <div class="col-md"></div>
                                        <div class="col-md"></div>
                                        <div class="col-md"></div>
                                    </div>
                                    <div hidden id="clonarDepto">
                                        <div class="row ">
                                            <div class="col-md-3">
                                                <div class="form-floating mt-4">
                                                    <select class="form-select"  id="departamento_sede">
                                                        <option value="">--SELECCIONE--</option>
                                                        @foreach($departamentos as $depa)
                                                            <option value ="{{$depa->id_departamentosede}}">{{$depa->nombre_departamento}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="floatingSelectGrid">ESPECIALIDAD:</label>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <label for="" class="text-center">No. DOSÍMETROS TÓRAX</label>
                                                <input type="number" id="num_dosi_torax_contrato_sede" class="form-control text-center" autofocus>
                                            </div>
                                            <div class="col-md">
                                                <label for="" class="text-center">No. DOSÍMETROS CRISTALINO</label>
                                                <input type="number"  id="num_dosi_cristalino_contrato_sede"  class="form-control text-center" autofocus>
                                            </div>
                                            <div class="col-md">
                                                <label for="" class="text-center">No. DOSÍMETROS ANILLO</label>
                                                <input type="number"  id="num_dosi_dedo_contrato_sede" class="form-control text-center" autofocus>
                                            </div>
                                            <div class="col-md">
                                                <label for="" class="text-center">No. DOSÍMETROS AMBIENTAL</label>
                                                <input type="number" id="num_dosi_area_contrato_sede" class="form-control text-center" autofocus>
                                            </div>
                                            <div class="col-md">
                                                <label for="" class="text-center">No. DOSÍMETROS CASO</label>
                                                <input type="number" id="num_dosi_caso_contrato_sede"  class="form-control text-center" autofocus >
                                            </div>
                                            
                                            {{-- <div class="col-md">
                                                <label for="" class="text-center">No. DOSÍM. MUÑECA</label>
                                                <input type="number"  id="num_dosi_muneca_contrato_sede"  class="form-control text-center" autofocus>
                                            </div> --}}
                                            {{-- <input type="number"  id="primer_mes_asignacion" name="primer_mes_asignacion" class="form-control text-center" value="1" hidden> --}}
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md"></div>
                                            <div class="col-md-2  text-center">
                                                <label for="" class="text-center">PERIODO ACTUAL</label>
                                                <input type="number" id="periodo_actual_contrato_sede"  class="form-control text-center" autofocus >
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-floating">
                                                    <select class="form-select" id="ocupacion_contrato_sede" autofocus style="text-transform:uppercase">
                                                        <option value="">----</option>
                                                        <option value="AM">APLICACIONES MÉDICAS</option>
                                                        <option value="AI">APLICACIONES INDUSTRIALES</option>
                                                        <option value="O">OTRO</option>
                                                    </select>
                                                    <label for="floatingSelectGrid">OCUPACIÓN:</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 text-center">
                                                <label for="" class="text-center">No. DOSÍM. CONTROL TÓRAX</label>
                                                <input class="form-check-input" type="checkbox" value="TRUE"  id="num_dosi_control_torax_contrato_sede" name="num_dosi_control_torax_contrato_sede">
                                            </div>
                                            <div class="col-md-2 text-center">
                                                <label for="" class="text-center">No. DOSÍM. CONTROL CRISTAL.</label>
                                                <input class="form-check-input" type="checkbox" value="TRUE"  id="num_dosi_control_cristalino_contrato_sede" name="num_dosi_control_cristalino_contrato_sede">
                                            </div>
                                            <div class="col-md-2 text-center">
                                                <label for="" class="text-center">No. DOSÍM. CONTROL ANILLO</label>
                                                <input class="form-check-input" type="checkbox" value="TRUE"  id="num_dosi_control_dedo_contrato_sede" name="num_dosi_control_dedo_contrato_sede">
                                            </div>
                                            <div class="col-md"></div>
                                        </div>
                                        <br>
                                    </div>
            
                                    <div class="" id="contenedorDepto0">
            
                                    </div>
                                </div>
                            </div>
            
                            <div id="contenedor">
            
                            </div>
                            <br>
                            <hr>
                            <div class="row">
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col d-grid gap-2">
                                    <button class="btn colorQA"  type="submit" id="boton-guardar" name="boton-guardar" >GUARDAR</button>
                                </div>
                                <div class="col d-grid gap-2">
                                    <a href="{{route('contratosdosi.createlist', $empresa)}}" class="btn btn-danger " type="button" id="cancelar" name="cancelar" role="button">CANCELAR</a>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                
                </div>
                <div class="col"></div>
            </div>
            <br>

            <h5 class="text-center">EDITAR LAS SEDES O NÚMERO DE DOSÍMETROS SUBSCRITOS A ESTE CONTRATO:</h5>
            <div class="row ">
                <div class="col-md m-4">
                    <table class="table table-responsive hover table-bordered">
                        <thead class="table-active text-center">
                            <tr>
                                <th rowspan="2" class='align-middle' style='width: 180px' >SEDE</th>
                                <th rowspan="2" class='align-middle' style='width: 150px' >ESP.</th>
                                <th rowspan="2" class='align-middle' style='width: 150px' >OCUP.</th>
                                <th colspan="5" class="align-middle text-center" style='width: 13.80%'>DOSÍMETROS</th>
                                <th colspan="3" class="align-middle text-center" style='width: 9.80%'>CONTROLES</th>
                                <th rowspan="2" class='align-middle' style='width: 8%'>ACCIONES</th>
                            </tr>
                            <tr>
                                <th class="align-middle text-center" style='width: 5%'>TOR.</th>
                                <th class="align-middle text-center" style='width: 5%'>CRIS.</th>
                                <th class="align-middle text-center" style='width: 5%'>ANI.</th>
                                {{-- <th class="align-middle text-center">MUÑ.</th> --}}
                                <th class="align-middle text-center" style='width: 5%'>AMB.</th>
                                <th class="align-middle text-center" style='width: 5%'>CASO</th>
                                <th class="align-middle text-center" style='width: 5%'>TOR.</th>
                                <th class="align-middle text-center" style='width: 5%'>CRIS.</th>
                                <th class="align-middle text-center" style='width: 5%'>ANI.</th>  
                            </tr>
                            
                            
                        </thead>
                        {{-- @livewire('form-update-contdosisedepto', ['contrato'=>$contrato, 'sedes'=>$sedes, 'sedesdeptos' => $sedesdeptos]) --}}
                        <tbody>
                            @foreach($sedesdeptos as $sedepto)
                                <form action="{{route('contratosdosisededepto.update',  ['contratodosisede' => $sedepto->id_contratodosimetriasede, 'contratodosisededepto'=>$sedepto->id_contdosisededepto])}}"  method="POST" id="form_contrato_dosi_sedesdepto" class="form_contrato_dosi_sedesdepto">
                                    @csrf
                                    @method('put')
                                    <tr>
                                        <td class='align-middle'>
                                            <div class="form-floating my-3">
                                                <input type="text" name="empresa_contrato" hidden id="empresa_contrato" value="{{$contrato->empresa->id_empresa}}">
                                                <input type="text" name="mesactual_contrato" hidden id="mesactual_contrato" value="{{$sedepto->mes_actual}}">
                                                <input type="text" name="contdosisededepto" hidden id="contdosisededepto" value="{{$sedepto->id_contdosisededepto}}">
                                                <input type="text" name="id_contrato" hidden id="id_contrato" value="{{$contrato->id_contratodosimetria}}">
                                                <select class="form-select id_sede" id="id_sede" name="id_sede">
                                                    <option value={{$sedepto->id_sede}}>--{{$sedepto->nombre_sede}}--</option>
                                                    @foreach($sedes as $sed)
                                                        @if($sedepto->id_sede != $sed->id_sede)
                                                            <option value ="{{$sed->id_sede}}">{{$sed->nombre_sede}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <label for="floatingSelectGrid">SEDE:</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-floating my-3 align-middle">
                                                <select class="form-select departamento_sede"  id="departamento_sede" name="departamento_sede">
                                                    <option value="{{$sedepto->id_departamentosede}}">--{{$sedepto->nombre_departamento}}--</option>
                                                    
                                                </select>
                                                <label for="floatingSelectGrid">ESPECLIALIDAD:</label>
                                            </div> 
                                        </td>
                                        <td>
                                            <div class="form-floating my-3 align-middle">
                                                <select class="form-select" id="ocupacion_contrato_sede" name="ocupacion_contrato_sede" autofocus style="text-transform:uppercase">
                                                    <option value="{{$sedepto->ocupacion}}">--{{$sedepto->ocupacion}}--</option>
                                                    <option value="AM">AM - APLICACIONES MÉDICAS</option>
                                                    <option value="AI">AI - APLICACIONES INDUSTRIALES</option>
                                                    <option value="O">O - OTRO</option>
                                                </select>
                                                <label for="floatingSelectGrid">OCUPACIÓN:</label>
                                            </div>
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="col-md">
                                                <input type="number" id="num_dosi_torax_contrato_sede"  name="num_dosi_torax_contrato_sede" class="form-control text-center" value="{{$sedepto->dosi_torax}}" autofocus >
                                            </div>
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="col-md">
                                                <input type="number"  id="num_dosi_cristalino_contrato_sede" name="num_dosi_cristalino_contrato_sede" class="form-control text-center" value="{{$sedepto->dosi_cristalino}}" autofocus >
                                            </div>
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="col-md">
                                                <input type="number"  id="num_dosi_dedo_contrato_sede" name="num_dosi_dedo_contrato_sede" class="form-control text-center" value="{{$sedepto->dosi_dedo}}" autofocus >
                                            </div>
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="col-md">
                                                <input type="number" id="num_dosi_area_contrato_sede" name="num_dosi_area_contrato_sede" class="form-control text-center" value="{{$sedepto->dosi_area}}" autofocus >
                                            </div>
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="col-md">
                                                <input type="number"  id="num_dosi_caso_contrato_sede" name="num_dosi_caso_contrato_sede" class="form-control text-center" value="{{$sedepto->dosi_caso}}" autofocus >
                                            </div>
                                        </td>
                                        
                                        {{-- <td class="text-center align-middle">
                                            <div class="col-md">
                                                <input type="number"  id="num_dosi_muneca_contrato_sede" name="num_dosi_muneca_contrato_sede" class="form-control text-center" value="{{$sedepto->dosi_muñeca}}" autofocus >
                                            </div>
                                        </td> --}}
                                        <td class="text-center align-middle">
                                            <div class="col-md">
                                                <input type="number" id="num_dosi_controlTorax_contrato_sede" name="num_dosi_controlTorax_contrato_sede" class="form-control text-center" value="{{$sedepto->dosi_control_torax}}" autofocus >
                                            </div>
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="col-md">
                                                <input type="number" id="num_dosi_controlCristalino_contrato_sede" name="num_dosi_controlCristalino_contrato_sede" class="form-control text-center" value="{{$sedepto->dosi_control_cristalino}}" autofocus >
                                            </div>
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="col-md">
                                                <input type="number" id="num_dosi_controlDedo_contrato_sede" name="num_dosi_controlDedo_contrato_sede" class="form-control text-center" value="{{$sedepto->dosi_control_dedo}}" autofocus >
                                            </div>
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="row">
                                                <div class="col">
                                                    <button class="btn colorQA"  type="submit" id="boton-guardar" name="boton-guardar" >
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                                                        </svg> GUARDAR
                                                    </button>
                                                </div>
                                                
                                            </div>
                                        </td>
                                    </tr>
                                </form>
                                        
                            @endforeach
                        </tbody>
                        
                    </table>
                </div>
            </div>
                    
                
            
        </div>
        <br>
    </div>
    <div class="col-md"></div>
</div>
<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous">
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('actualizar')== 'ok')
    <script>
        Swal.fire(
        'ACTUALIZADO!',
        'SE HA ACTUALIZADO CON ÉXITO.',
        'success'
        )
    </script>
@endif
<script type="text/javascript">
    function fechafinalcontrato(){
        var fecha_inicio = new Date(document.getElementById('fecha_inicio_contrato_input').value);
        alert(fecha_inicio);
        var fecha_final_año = fecha_inicio.getFullYear()+1;
        var mm = fecha_inicio.getMonth()+1;
        var fecha_final_mes = (mm < 10 ? '0' : '')+mm;
        var dd = fecha_inicio.getDate();
        var fecha_final_dia = (dd < 10 ? '0' : '')+dd;
        var fecha_final = fecha_final_año+'-'+fecha_final_mes+'-'+fecha_final_dia;
        console.log(fecha_final);
        document.getElementById("fecha_finalizacion_contrato_input").value = fecha_final;
    };
    $(document).ready(function(){
        $('.id_sede').on('change', function(){
            var sede_id = $(this).val();
            alert(sede_id);
            if($.trim(sede_id) != ''){
                $.get('contratodosidepa', {sede_id : sede_id}, function(depas){
                    console.log(depas);
                    
                    $.each(JSON.parse(depas), function (index, value) {
                        $('.departamento_sede').append("<option value='" + value.id_departamentosede + "'>" + value.nombre_departamento + "</option>")
                    })
                });
            }
        })
    })
/* __________JAVASCRIPT PARA AGREGAR SEDE___________ */

    let sedesNumber = 1;
    let depaNumber = 1;
    let agregar = document.getElementById('agregar');
    let contenido = document.getElementById('contenedor');

    let agregarDepto = document.getElementById('agregarDepto1');
    let contenidoDepto = null;


    /////////// clonar Sede /////////// 
    agregar.addEventListener('click', e =>{
        e.preventDefault();
        let clonado = document.querySelector('#clonar');
        let clon = clonado.cloneNode(true);


        contenido.appendChild(clon).setAttribute("id", `${sedesNumber}`);
        contenido.appendChild(clon).setAttribute("class", `${sedesNumber}`);
        document.getElementById(`${sedesNumber}`).removeAttribute("hidden");
        document.getElementById(`${sedesNumber}`).querySelector('#contenedorDepto0')
            .setAttribute("id", `contenedorDeptoSede${sedesNumber}`);
        document.getElementById(`${sedesNumber}`).querySelector('#id_sede')
            .setAttribute("id", `id_sede${sedesNumber}`);
        document.getElementById(`${sedesNumber}`).querySelector(`#id_sede${sedesNumber}`)
            .setAttribute("name", `id_sede${sedesNumber}[]`);
        console.log(document.getElementById(`${sedesNumber}`).querySelector(`#contenedorDeptoSede${sedesNumber}`))
        contenidoDepto= document.getElementById(`contenedorDeptoSede${sedesNumber}`)
        sedesNumber ++;
    })

    /////////////clonar departamento////////////
    function addDepa() {

        let clonadoDepto = document.querySelector('#clonarDepto');
        let clonDepto = clonadoDepto.cloneNode(true);

        console.log(contenidoDepto);
        contenidoDepto.appendChild(clonDepto).setAttribute("id", `depa${depaNumber}`);
        document.getElementById(`depa${depaNumber}`).removeAttribute("hidden");

        document.getElementById(`depa${depaNumber}`).querySelector(`#departamento_sede`)
            .setAttribute("name", `departamentos_sede${sedesNumber-1}[]`);

        document.getElementById(`depa${depaNumber}`).querySelector(`#ocupacion_contrato_sede`)
            .setAttribute("name", `ocupacion_sede${sedesNumber-1}[]`);

        document.getElementById(`depa${depaNumber}`).querySelector(`#num_dosi_control_torax_contrato_sede`)
            .setAttribute("name", `dosimetro_control_torax_sede${sedesNumber-1}[]`);

        document.getElementById(`depa${depaNumber}`).querySelector(`#num_dosi_control_cristalino_contrato_sede`)
            .setAttribute("name", `dosimetro_control_cristalino_sede${sedesNumber-1}[]`);

        document.getElementById(`depa${depaNumber}`).querySelector(`#num_dosi_control_dedo_contrato_sede`)
            .setAttribute("name", `dosimetro_control_dedo_sede${sedesNumber-1}[]`);

        document.getElementById(`depa${depaNumber}`).querySelector(`#num_dosi_torax_contrato_sede`)
            .setAttribute("name", `dosimetro_torax_sede${sedesNumber-1}[]`);

        document.getElementById(`depa${depaNumber}`).querySelector(`#num_dosi_area_contrato_sede`)
            .setAttribute("name", `dosimetro_area_sede${sedesNumber-1}[]`);

        document.getElementById(`depa${depaNumber}`).querySelector(`#num_dosi_caso_contrato_sede`)
            .setAttribute("name", `dosimetro_caso_sede${sedesNumber-1}[]`);

        document.getElementById(`depa${depaNumber}`).querySelector(`#num_dosi_dedo_contrato_sede`)
            .setAttribute("name", `dosimetro_dedo_sede${sedesNumber-1}[]`);

        document.getElementById(`depa${depaNumber}`).querySelector(`#num_dosi_cristalino_contrato_sede`)
            .setAttribute("name", `dosimetro_cristalino_sede${sedesNumber-1}[]`);

        document.getElementById(`depa${depaNumber}`).querySelector(`#periodo_actual_contrato_sede`)
        .setAttribute("name", `periodo_actual_sede${sedesNumber-1}[]`);
        /* document.getElementById(`depa${depaNumber}`).querySelector(`#num_dosi_ezclip_contrato_sede`)
            .setAttribute("name", `dosimetro_ezclip_sede${sedesNumber-1}[]`); */

        /* document.getElementById(`depa${depaNumber}`).querySelector(`#num_dosi_muneca_contrato_sede`)
            .setAttribute("name", `dosimetro_muneca_sede${sedesNumber-1}[]`); */

        depaNumber++;
        ///////////////
        
    }

    function readySede() {
        $(document).ready(function () {
            $(`#id_sede${sedesNumber-1}`).change(function () {
                //alert('hi')
                let sede_id = $(this).val();

                if ($.trim(sede_id) != '') {
                    $.get('contratodosidepa', {sede_id: sede_id}, function (depas) {
                        console.log('departamentos', depas)
                        $('#departamento_sede').empty();
                        $('#departamento_sede').append("<option value=''> --SELECCIONE UNA ESPECIALIDAD-- </option>");
                        $.each(JSON.parse(depas), function (index, value) {
                            $('#departamento_sede').append("<option value='" + value.id_departamentosede + "'>" + value.nombre_departamento + "</option>")
                        })
                    });
                }
            });
        });
    }

    function deleteElement() {
        if (sedesNumber == 1){
        }else {
            sedesNumber--;
            if(sedesNumber >0) {
                parentNode = document.getElementsByClassName('contenedorMoreSedes');
                parentNodeLength = parentNode.length;
                document.getElementById(`${sedesNumber}`).remove();
            }
        }
    }
    function deleteDepa() {
        console.log("hola")
        if(depaNumber ==1 ) {

        }else {
            depaNumber--;
            if(depaNumber>0) {
                document.getElementById(`depa${depaNumber}`).remove();

                //  document.getElementById('clonarDepto').remove();
            }
        }
    }
    $(document).ready(function(){
        $('#id_sede').on('change', function(){
            var sede_id = $(this).val();
            alert(sede_id);
            if($.trim(sede_id) != ''){
                $.get('contratodosidepa', {sede_id : sede_id}, function(depas){
                    console.log(depas);
                });
            }
        });

        var num = parseInt('{{empty($contrato->codigo_contrato) ? 0 : $contrato->codigo_contrato}}');
        var n = num.toString().padStart(5,'0');
        console.log("ESTE ES EL CODIGO" +n);
        
        document.getElementById("codigo_contrato_input").value = n;
    });


/* ___________________________ */
    $(document).ready(function(){

        $('#form_contrato_dosi').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "SEGURO QUE DESEA ACTUALIZAR LA INFORMACIÓN DE ESTE CONTRATO DE DOSIMETRÍA??",
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
        });

        $('.form_contrato_dosi_sedesdepto').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "SEGURO QUE DESEA ACTUALIZAR LAS SEDES, ESPECIALIDADES O LAS CANTIDADES DE DOSÍMETROS EN ESTE CONTRATO??",
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