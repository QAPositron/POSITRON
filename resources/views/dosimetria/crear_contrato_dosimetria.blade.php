@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')
    <a type="button" class="btn btn-circle colorQA ir-arriba">
        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-arrow-up mt-1" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
        </svg>
    </a>
    <div class="row">
        <div class="col"></div>
        <div class="col-12">
            <div class="card text-dark bg-light">
                <h2 class="text-center mt-3" id="nueva_empresaModalLabel">CREAR CONTRATO DE DOSIMETRÍA<br> PARA LA EMPRESA <br> {{$empresa->nombre_empresa}}</h2>
            
                <form class="m-4" action="{{route('contratosdosi.save')}}"  method="POST" id="form_contrato_dosi">
                    @csrf
                    
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-floating my-3" id="codigo_contrato">
                                    <input type="text" name="empresa_contrato" hidden id="empresa_contrato" value="{{$empresa->id_empresa}}">
                                    
                                    <input type="number" name="codigo_contrato" id="codigo_contrato_input" value="" class="form-control @error('codigo_contrato') is-invalid @enderror" readonly>
                                    <label for="floatingInputGrid">CODIGO:</label>
                                    @error('codigo_contrato')
                                        <small class="invalid-feedback">*{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating my-3" id="periodo_recambio_contrato">
                                    <select class="form-select @error('periodo_recambio_contrato') is-invalid @enderror" name="periodo_recambio_contrato" id="periodo_recambio_contrato_select"  autofocus>
                                        <option value="">--SELECCIONE--</option>
                                        <option value="MENS">MENSUAL</option>
                                        <option value="BIMS">BIMESTRAL</option>
                                        <option value="TRIMS">TRIMESTRAL</option>
                                    </select>
                                    <label for="floatingInputGrid">PERIODO DE RECAMBIO:</label>
                                    @error('periodo_recambio_contrato')
                                        <small class="invalid-feedback">*{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="form-floating my-3">
                                            <input type="number" name="numlecturas_año" id="numlecturas_año" min="1" class="form-control">
                                            <label for="inputPassword6"  class="col-form-label">LECTUAS AL AÑO</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <span id="maximoPeriodos" class="form-text"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <div class="form-floating my-3" id="fecha_inicio_contrato">
                                    <input type="date" name="fecha_inicio_contrato" id="fecha_inicio_contrato_input" class="form-control @error('fecha_inicio_contrato') is-invalid @enderror" onchange="fechafinalcontrato();" autofocus disabled>
                                    <label for="floatingInputGrid">FECHA DE INICIO:</label>
                                    @error('fecha_inicio_contrato')
                                        <small class="invalid-feedback">*{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating my-3" id="fecha_finalizacion_contrato">
                                    <input type="date" name="fecha_finalizacion_contrato" id="fecha_finalizacion_contrato_input" class="form-control" autofocus readonly>
                                    <label for="floatingInputGrid" >FECHA DE FINALIZACIÓN:</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating my-3">
                                    <select class="form-select @error('ocupacion_contrato') is-invalid @enderror" id="ocupacion_contrato" name="ocupacion_contrato" autofocus style="text-transform:uppercase">
                                        <option value="">----</option>
                                        <option value="AM">APLICACIONES MÉDICAS</option>
                                        <option value="AI">APLICACIONES INDUSTRIALES</option>
                                        <option value="O">OTRO</option>
                                    </select>
                                    <label for="floatingSelectGrid">OCUPACIÓN:</label>
                                    @error('ocupacion_contrato')
                                        <small class="invalid-feedback">*{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating my-3" id="estado_contrato">
                                    <select class="form-select @error('estado_contrato') is-invalid @enderror" name="estado_contrato" id="estado_contrato_select"  autofocus>
                                        <option value="">--SELECCIONE--</option>
                                        <option value="ACTIVO" selected>ACTIVO</option>
                                        <option value="INACTIVO">INACTIVO</option>
                                    </select>
                                    <label for="floatingInputGrid">ESTADO:</label>
                                    @error('estado_contrato')
                                        <small class="invalid-feedback">*{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
        
                    </div>
                    <div class="col-md">
                        <hr>
                        <div class="row">
                            <div class="col-md"></div>
                            <div class="col-md-7 text-center">
                                <label class="text-center">DOSÍMETROS DE CONTROL PARA TODO EL CONTRATO:</label> 
                                <button class="btn btn-sm colorQA"type="button" onclick="agregarDosim()" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="col-md"></div>
                        </div>
                        <br>
                        <div id="rowDosimetros"></div>
                        <br>
                        <label class="text-center ms-4">ASIGNE A ESTE CONTRATO A UNA O MÁS SEDES :</label>
        
                        <div class="row mt-2">
                            <div class="col-md text-center">
                                <button onclick="readySede()" class="btn btn-sm colorQA" id="agregar">AGREGAR SEDE </button>
                                <button type="button" class="btn btn-sm bg-danger" id="agregar" onclick="deleteElement()">ELIMINAR SEDE </button>
                            </div>
                        </div>
                        <br>
                        <div hidden class="container-fluid " id="clonar">
                            <div class="rounded  m-3 p-3 border bg-dark-subtle">
                                {{-- <div class="row">
                                    <div class="col-md"></div>
                                    <div class="col-md-7 text-center">
                                        <label class="text-center">DOSíMETROS DE CONTROL PARA LA SEDE:</label> 
                                        <button class="btn btn-sm colorQA"type="button" onclick="agregarDosimSede()">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="col-md"></div>
                                </div>
                                <br>
                                <div id="rowDosimSede"></div> --}}
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
                                        <button onclick="addDepa()" type="button" class="btn btn-sm colorQA" id="agregarDepto1">AGREGAR ESP.</button>
                                    </div>
                                    <div class="col-md mt-4">
                                        <button type="button" class="btn btn-sm bg-danger" id="agregar1" onclick="deleteDepa()">ELIMINAR ESP.</button>
                                    </div>
                                    <div class="col-md"></div>
                                    <div class="col-md"></div>
                                    <div class="col-md"></div>
                                    <div class="col-md"></div>
                                </div> 
                                <br>
                                <div hidden id="clonarDepto">
                                    <div class="row">
                                        <div class="col-md-4">
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
                                            <input type="number" id="num_dosi_torax_contrato_sede"  class="form-control text-center" min="1" autofocus >
                                        </div>
                                        <div class="col-md">
                                            <label for="" class="text-center">No. DOSÍMETROS CRISTALINO</label>
                                            <input type="number"  id="num_dosi_cristalino_contrato_sede"  class="form-control text-center" min="1" autofocus>
                                        </div>
                                        <div class="col-md">
                                            <label for="" class="text-center">No. DOSÍMETROS ANILLO</label>
                                            <input type="number"  id="num_dosi_dedo_contrato_sede" class="form-control text-center" min="1" autofocus>
                                        </div>
                                        {{-- <div class="col-md">
                                            <label for="" class="text-center">No. DOSÍM. MUÑECA</label>
                                            <input type="number"  id="num_dosi_muneca_contrato_sede"  class="form-control text-center" autofocus>
                                        </div> --}}
                                        <div class="col-md">
                                            <label for="" class="text-center">No. DOSÍMETROS AMBIENTAL</label>
                                            <input type="number" id="num_dosi_area_contrato_sede"  class="form-control text-center" min="1" autofocus >
                                        </div>
                                        <div class="col-md">
                                            <label for="" class="text-center">No. DOSÍMETROS CASO</label>
                                            <input type="number" id="num_dosi_caso_contrato_sede"  class="form-control text-center" min="1" autofocus >
                                        </div>
                                        
                                        <input type="number"  id="primer_mes_asignacion" name="primer_mes_asignacion" class="form-control text-center" value="1" hidden>
                                    </div>
                                    <br>
                                    <div id="rowDosim" hidden>
                                        <div class="row" >
                                            <div class="col-md"></div>
                                            <div class="col-md"></div>
                                            <div class="col-md-3"></div>
                                            <div class="col-md-2 text-center">
                                                <label for="" class="text-center">No. DOSÍM. CONTROL TRANSPORTE T.</label>  
                                                <input class="form-check-input" type="checkbox" value="TRUE"  id="num_dosi_control_torax_contrato_sede" name="num_dosi_control_torax_contrato_sede" min="1">
                                            </div>
                                            <div class="col-md-2 text-center">
                                                <label for="" class="text-center">No. DOSÍM. CONTROL TRANSPORTE CRIS.</label>
                                                <input class="form-check-input" type="checkbox" value="TRUE"  id="num_dosi_control_cristalino_contrato_sede" name="num_dosi_control_cristalino_contrato_sede" min="1">
                                            </div>
                                            <div class="col-md-2 text-center">
                                                <label for="" class="text-center">No. DOSÍM. CONTROL TRANSPORTE A.</label>
                                                <input class="form-check-input" type="checkbox" value="TRUE"  id="num_dosi_control_dedo_contrato_sede" name="num_dosi_control_dedo_contrato_sede" min="1">
                                            </div>
                                            <div class="col-md">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="" id="contenedorDepto0">
        
                                </div>
                            </div>
                        </div>
        
                        <div id="contenedor">
        
                        </div>
                        
                        
                        <div class="row">
                            <div class="col"></div>
                            <div class="col d-grid gap-2">
                                <button class="btn colorQA"  type="submit" id="boton-guardar" name="boton-guardar" >GUARDAR</button>
                            </div>
                            <div class="col d-grid gap-2">
                                <a href="{{route('contratosdosi.createlist', $empresa->id_empresa)}}" class="btn btn-danger " type="button" id="cancelar" name="cancelar" role="button">CANCELAR</a>
                            </div>
                            <div class="col"></div>
                        </div>
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
    
    function fechafinalcontrato(){
        var numLec = document.getElementById("numlecturas_año").value;
        var periodo = document.getElementById("periodo_recambio_contrato_select").value;
        var fecha_inicio = new Date(document.getElementById('fecha_inicio_contrato_input').value);
        console.log("****FECHA INICIO***")
        fecha_inicio.setMinutes(fecha_inicio.getMinutes() + fecha_inicio.getTimezoneOffset());
        console.log(fecha_inicio);
        if(periodo == 'MENS'){
            var ultimoDia = new Date(fecha_inicio.getFullYear(), fecha_inicio.getMonth() + 1, 1);
            console.log("ULTIMO DIA"+ ultimoDia);
            var sumaMeses = new Date(new Date(ultimoDia).setMonth(ultimoDia.getMonth()+(numLec-1)));
            console.log("FECHA DE LA SUMA DE MESES " +sumaMeses);
            var ultimoDiaMesF = new Date(new Date(sumaMeses).setDate(sumaMeses.getDate()-1));
            console.log("FECHA FINAL RESTANDO UN DIA "+ultimoDiaMesF);

            var fecha_final_año = ultimoDiaMesF.getFullYear();
            var mm = ultimoDiaMesF.getMonth()+1;
            var fecha_final_mes = (mm < 10 ? '0' : '')+mm;
            var dd = ultimoDiaMesF.getDate();
            var fecha_final_dia = (dd < 10 ? '0' : '')+dd;
            var fecha_final = fecha_final_año+'-'+fecha_final_mes+'-'+fecha_final_dia;
            console.log(fecha_final);
            document.getElementById("fecha_finalizacion_contrato_input").value = fecha_final;
            
        }else if(periodo == 'TRIMS'){
            var ultimoDia = new Date(fecha_inicio.getFullYear(), fecha_inicio.getMonth() + 3, 1);
            console.log("ULTIMO DIA"+ ultimoDia);
            var sumaMeses = new Date(new Date(ultimoDia).setMonth(ultimoDia.getMonth()+3*(numLec-1)));
            console.log("FECHA FINALIZADO"+sumaMeses);
            var ultimoDiaMesF = new Date(new Date(sumaMeses).setDate(sumaMeses.getDate()-1));
            console.log("FECHA FINAL RESTANDO UN DIA "+ultimoDiaMesF);

            var fecha_final_año = ultimoDiaMesF.getFullYear();
            var mm = ultimoDiaMesF.getMonth()+1;
            var fecha_final_mes = (mm < 10 ? '0' : '')+mm;
            var dd = ultimoDiaMesF.getDate();
            var fecha_final_dia = (dd < 10 ? '0' : '')+dd;
            var fecha_final = fecha_final_año+'-'+fecha_final_mes+'-'+fecha_final_dia;
            console.log(fecha_final);
            document.getElementById("fecha_finalizacion_contrato_input").value = fecha_final;
        }else if(periodo == 'BIMS'){
            var ultimoDia = new Date(fecha_inicio.getFullYear(), fecha_inicio.getMonth() + 2, 1);
            console.log("ULTIMO DIA"+ ultimoDia);
            var sumaMeses = new Date(new Date(ultimoDia).setMonth(ultimoDia.getMonth()+2*(numLec-1)));
            console.log("FECHA FINALIZADO"+sumaMeses);
            var ultimoDiaMesF = new Date(new Date(sumaMeses).setDate(sumaMeses.getDate()-1));
            console.log("FECHA FINAL RESTANDO UN DIA "+ultimoDiaMesF);

            var fecha_final_año = ultimoDiaMesF.getFullYear();
            var mm = ultimoDiaMesF.getMonth()+1;
            var fecha_final_mes = (mm < 10 ? '0' : '')+mm;
            var dd = ultimoDiaMesF.getDate();
            var fecha_final_dia = (dd < 10 ? '0' : '')+dd;
            var fecha_final = fecha_final_año+'-'+fecha_final_mes+'-'+fecha_final_dia;
            console.log(fecha_final);
            document.getElementById("fecha_finalizacion_contrato_input").value = fecha_final;
        }
        
    };
    
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
        /* document.getElementById(`${sedesNumber}`).querySelector('#rowDosimSede')
            .setAttribute("id", `rowDosimSede${sedesNumber}`); */
        console.log(document.getElementById(`${sedesNumber}`).querySelector(`#contenedorDeptoSede${sedesNumber}`))
        contenidoDepto= document.getElementById(`contenedorDeptoSede${sedesNumber}`)
        sedesNumber ++;
        depaNumber = 1;
    });
    console.log("**");
    console.log(sedesNumber);
    /////////////clonar departamento////////////
    function addDepa() {

        let clonadoDepto = document.querySelector('#clonarDepto');
        let clonDepto = clonadoDepto.cloneNode(true);

        console.log(contenidoDepto);
        contenidoDepto.appendChild(clonDepto).setAttribute("id", `depa${depaNumber}_sede${sedesNumber-1}`);
        document.getElementById(`depa${depaNumber}_sede${sedesNumber-1}`).removeAttribute("hidden");
        
        document.getElementById(`depa${depaNumber}_sede${sedesNumber-1}`).querySelector(`#departamento_sede`)
            .setAttribute("name", `departamentos_sede${sedesNumber-1}[]`);

        /* document.getElementById(`depa${depaNumber}`).querySelector(`#ocupacion_contrato_sede`)
            .setAttribute("name", `ocupacion_sede${sedesNumber-1}[]`); */
        document.getElementById(`depa${depaNumber}_sede${sedesNumber-1}`).querySelector('#rowDosim').setAttribute("id", `rowDosim_sede${sedesNumber-1}_depto${depaNumber}`);
        document.getElementById(`depa${depaNumber}_sede${sedesNumber-1}`).querySelector(`#num_dosi_control_torax_contrato_sede`)
                .setAttribute("name", `dosimetro_control_torax_sede${sedesNumber-1}_depa${depaNumber}`);
    
        document.getElementById(`depa${depaNumber}_sede${sedesNumber-1}`).querySelector(`#num_dosi_control_cristalino_contrato_sede`)
                .setAttribute("name", `dosimetro_control_cristalino_sede${sedesNumber-1}_depa${depaNumber}`);
    
        document.getElementById(`depa${depaNumber}_sede${sedesNumber-1}`).querySelector(`#num_dosi_control_dedo_contrato_sede`)
                .setAttribute("name", `dosimetro_control_dedo_sede${sedesNumber-1}_depa${depaNumber}`);

        var filaDosicontrol = document.getElementById('control');
        if(filaDosicontrol != null){
            console.log("EXISTE ROWDOSIM")
            console.log(filaDosicontrol);
        }else{
            console.log("es distinto a null")
            document.getElementById(`rowDosim_sede${sedesNumber-1}_depto${depaNumber}`).removeAttribute("hidden");
        }
        
        document.getElementById(`depa${depaNumber}_sede${sedesNumber-1}`).querySelector(`#num_dosi_torax_contrato_sede`)
            .setAttribute("name", `dosimetro_torax_sede${sedesNumber-1}[]`);

        document.getElementById(`depa${depaNumber}_sede${sedesNumber-1}`).querySelector(`#num_dosi_area_contrato_sede`)
            .setAttribute("name", `dosimetro_area_sede${sedesNumber-1}[]`);

        document.getElementById(`depa${depaNumber}_sede${sedesNumber-1}`).querySelector(`#num_dosi_caso_contrato_sede`)
            .setAttribute("name", `dosimetro_caso_sede${sedesNumber-1}[]`);
            
        document.getElementById(`depa${depaNumber}_sede${sedesNumber-1}`).querySelector(`#num_dosi_cristalino_contrato_sede`)
            .setAttribute("name", `dosimetro_cristalino_sede${sedesNumber-1}[]`);

        document.getElementById(`depa${depaNumber}_sede${sedesNumber-1}`).querySelector(`#num_dosi_dedo_contrato_sede`)
            .setAttribute("name", `dosimetro_dedo_sede${sedesNumber-1}[]`);
        depaNumber++;
        ///////////////
    }
    function agregarDosim(){
        var dosim = `<div class="row" id="control">
                            <input type="text" name="unicoControl_contrato" hidden id="unicoControl_contrato" value="TRUE">
                            <div class="col-md"></div>
                            <div class="col-md"></div>
                            <div class="col-md-2 text-center">
                                <label for="" class="text-center">No. DOSÍM. CONTROL TRANSPORTE T.</label>
                                <input class="form-check-input" type="checkbox" value="TRUE"  id="dosi_controlTrans_torax_contrato" name="dosi_controlTrans_torax_contrato" min="1">
                            </div>
                            <div class="col-md-2 text-center">
                                <label for="" class="text-center">No. DOSÍM. CONTROL TRANSPORTE CRIS.</label>
                                <input class="form-check-input" type="checkbox" value="TRUE"  id="dosi_controlTrans_cristalino_contrato" name="dosi_controlTrans_cristalino_contrato" min="1">
                            </div>
                            <div class="col-md-2 text-center">
                                <label for="" class="text-center">No. DOSÍM. CONTROL TRANSPORTE A.</label>
                                <input class="form-check-input" type="checkbox" value="TRUE"  id="dosi_controlTrans_dedo_contrato" name="dosi_controlTrans_dedo_contrato" min="1">
                            </div>
                            <div class="col-md"></div>
                            <div class="col-md">
                                <button class="btn btn-danger mt-2" type="button" onclick="eliminar()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                    </svg>
                                </button>
                            </div>
                        </div> `;
        $("#rowDosimetros").append(dosim);

        var arraySedes = [];
        for(var i = 0; i < 20; i++){
            var sedes = document.querySelectorAll('select[id="id_sede'+i+'"]');
            if(sedes.length != 0){
                arraySedes.push(sedes);
            }
        };
        var sedes = arraySedes.length;
        for(var i = 0; i < arraySedes.length; i++){
            var departamentoSede = document.querySelectorAll('select[name="departamentos_sede'+(i+1)+'[]"]');
            var deptos = departamentoSede.length;
            console.log("----depto"+deptos+" sede "+(i+1));
            for(var x = 0; x < deptos; x++){
                console.log("depto"+(x+1));
                document.getElementById("rowDosim_sede"+(i+1)+"_depto"+(x+1)).setAttribute("hidden", "true");
            }
        }
    }
    
    function eliminar(){
        var arraySedes = [];
        for(var i = 0; i < 20; i++){
            var sedes = document.querySelectorAll('select[id="id_sede'+i+'"]');
            if(sedes.length != 0){
                arraySedes.push(sedes);
            }
        };
        var sedes = arraySedes.length;
        for(var i = 0; i < arraySedes.length; i++){
            var departamentoSede = document.querySelectorAll('select[name="departamentos_sede'+(i+1)+'[]"]');
            var deptos = departamentoSede.length;
            console.log("----depto"+deptos+" sede "+(i+1));
            for(var x = 0; x < deptos; x++){
                console.log("depto"+(x+1));
                document.getElementById("rowDosim_sede"+(i+1)+"_depto"+(x+1)).removeAttribute("hidden");
            }
        }
        $("#control").remove();
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
                        $('#departamento_sede').append("<option value=''> --SELECCIONE-- </option>");
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
        console.log("hola");
        if(depaNumber ==1 ) {

        }else {
            depaNumber--;
            if(depaNumber>0) {
                document.getElementById(`depa${depaNumber}_sede${sedesNumber-1}`).remove();

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
        
        var num = parseInt('{{empty($codigocontratoant->codigo_contrato) ? 0 : $codigocontratoant->codigo_contrato}}')+1;
        var n = num.toString().padStart(5,'0');
        console.log("ESTE ES EL CODIGO" +n);
        
        document.getElementById("codigo_contrato_input").value = n;
        

        $('#periodo_recambio_contrato_select').on('change', function(){
            document.getElementById("numlecturas_año").value= '';
            document.getElementById("fecha_inicio_contrato_input").value= '';
            document.getElementById("fecha_finalizacion_contrato_input").value = '';
            var periodo = $(this).val();
            if(periodo == 'MENS'){
                document.getElementById('maximoPeriodos').innerHTML = 'Max. 12 lecturas al año';
            }else if(periodo == 'TRIMS'){
                document.getElementById('maximoPeriodos').innerHTML = 'Max. 4 lecturas al año';
            }else if(periodo == 'BIMS'){
                document.getElementById('maximoPeriodos').innerHTML = 'Max. 6 lecturas al año';
            }
        });
        
        $('#numlecturas_año').on('keyup', function(){
            var numLec = $(this).val();
            var periodo = document.getElementById("periodo_recambio_contrato_select").value;
            document.getElementById('fecha_inicio_contrato_input').disabled = false;
            document.getElementById("fecha_inicio_contrato_input").value= '';
            document.getElementById("fecha_finalizacion_contrato_input").value = '';
            if(periodo == 'MENS' && numLec > 12){
                return Swal.fire({
                                    title:"EXCEDE EL MÁXIMO DE LECTURAS AL AÑO",
                                    text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTA",
                                    icon: 'error'
                                });
            }else if(periodo == 'TRIMS' && numLec > 4){
                return Swal.fire({
                                    title:"EXCEDE EL MÁXIMO DE LECTURAS AL AÑO",
                                    text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTA",
                                    icon: 'error'
                                });
            }else if(periodo == 'BIMS' && numLec > 6){
                return Swal.fire({
                                    title:"EXCEDE EL MÁXIMO DE LECTURAS AL AÑO",
                                    text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTA",
                                    icon: 'error'
                                });
            }
            
        });
        
        $('.ir-arriba').click(function(){
            $('body, html').animate({
                scrollTop: '0px'
            }, 300);
        });

        $(window).scroll(function(){
            if( $(this).scrollTop() > 0 ){
                $('.ir-arriba').slideDown(300);
            } else {
                $('.ir-arriba').slideUp(300);
            }
        });
    })
    $(document).ready(function(){

        $('#form_contrato_dosi').submit(function(e){
            e.preventDefault();
            ///////////////////////VALIDACION PARA EL PERIODO OBLIGATORIO//////////
            var periodo= document.getElementById("periodo_recambio_contrato_select").value;
            console.log("ESTE ES EL PERIODO" + periodo);
            if(periodo == ''){
                return Swal.fire({
                                title:"FALTA SELECCIONAR EL PERIODO DE RECAMBIO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
            };
            ///////////////////////VALIDACION PARA LAS FECHAS OBLIGATORIAS//////////
            var fecha_inicio = document.getElementById("fecha_inicio_contrato_input").value;
            console.log("ESTAS SON LAS " + fecha_inicio);
            if(fecha_inicio == ''){
                return Swal.fire({
                                title:"FALTA SELECCIONAR LA FECHA DE INGRESO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
            };
            var fecha_finalizacion = document.getElementById("fecha_finalizacion_contrato_input").value;
            console.log("ESTAS SON LAS OBSERVACIONES" + fecha_finalizacion);
            if(fecha_finalizacion == ''){
                return Swal.fire({
                                title:"FALTA SELECCIONAR LA FECHA  DE FINALIZACIÓN",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
            };
            /////////////////////// VALIDACION PARA LA SEDE OBLIGATORIA///////////////////
            var arraySedes = [];
            for(var i = 0; i < 20; i++){
                var sedes = document.querySelectorAll('select[id="id_sede'+i+'"]');
                if(sedes.length != 0){
                    arraySedes.push(sedes);
                }
            };
            console.log("este es el array");
            console.log(arraySedes);
            console.log(arraySedes.length);

            if(arraySedes.length == '0'){
                return Swal.fire({
                            title:"FALTA AGREGAR O AÑADIR UNA SEDE",
                            text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                            icon: 'error'
                        });
            };
            for(var i = 0; i < arraySedes.length; i++){
                var sedes = document.querySelectorAll('select[name="id_sede'+(i+1)+'[]"]');
                console.log(sedes);
                for(var x = 0; x < sedes.length; x++) {
                    var values = sedes[x].value;
                    console.log("ESTOS SON LOS VALORES DE LA SEDES" +values);
                    if(values == ''){
                        return Swal.fire({
                                    title:"FALTA SELECCIONAR ALGUNA SEDE",
                                    text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                    icon: 'error'
                                });
                    }
                }
            }
            /////////////////////////// VALIDACION PARA LAS ESPECIALIDADES OBLIGATORIAS Y PARA LA CANTIDAD DE DOSIMETROS OBLIGATORIOS///////////////////
            for(var i = 0; i < arraySedes.length; i++){
                var departamentoSede = document.querySelectorAll('select[name="departamentos_sede'+(i+1)+'[]"]');
                console.log(departamentoSede);
                console.log("ESTAS SON LOS DEPARTAMENTOS"+ i + "ESTE ES EL TAMAÑO" +departamentoSede.length);
                if(departamentoSede.length >= 2){
                    for(var x = 0; x < departamentoSede.length; x++) {
                        var values = departamentoSede[x].value;
                        console.log("PARA EL VALIR MAYOR A UNO"+values);
                        if(values == ''){
                            return Swal.fire({
                                        title:"FALTA SELECCIONAR ALGUNA ESPECIALIDAD",
                                        text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                        icon: 'error'
                                    });
                        }
                    }
                }else{
                    var values = departamentoSede[0].value;
                    console.log("PARA EL VALIR MENOR A UNO"+values);
                    if(values == ''){
                        return Swal.fire({
                                    title:"FALTA SELECCIONAR ALGUNA ESPECIALIDAD",
                                    text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                    icon: 'error'
                                });
                    }
                };
                
                /* var dosimcontrolTorax = document.querySelectorAll('input[name="dosimetro_control_torax_sede'+(i+1)+'[]"]');
                var dosimcontrolCrist = document.querySelectorAll('input[name="dosimetro_control_cristalino_sede'+(i+1)+'[]"]');
                var dosimcontrolDedo = document.querySelectorAll('input[name="dosimetro_control_dedo_sede'+(i+1)+'[]"]');
                console.log("DOSIMETROS CONTROL C" + (i+1));
                console.log(dosimcontrolTorax);
                console.log(dosimcontrolCrist);
                console.log(dosimcontrolDedo);
                var arrayControlT = [];
                for(var i = 0; i < dosimcontrolTorax.length; i++){
                    if(dosimcontrolTorax[i].checked){
                        console.log("ESTA SELECCIONADO");
                        arrayControlT.push(dosimcontrolTorax[i].value);
                    }else{
                        console.log("NO ESTA SELECCIONADO");
                        dosimcontrolTorax[i].checked;
                        dosimcontrolTorax[i].value = 'FALSE';
                        arrayControlT.push(dosimcontrolTorax[i].value);
                        dosimcontrolTorax.splice(i, 0, 'FALSE');
                    }
                    console.log("DOSIMETROS CONTROL TORAX");
                    console.log(dosimcontrolTorax[i].value);
                }
                console.log("array CONTROL TORAX");
                console.log(arrayControlT); */
                /* months.splice(1, 0, 'Feb');= arrayControlT; */
                /* for(var x = 0; x < dosimcontrolTorax.length; x++) {
                    var values = dosimcontrolTorax[x].value;
                    console.log("values torax control" +values+x);
                } */
                /* var TamañodepartamentoSede = departamentoSede.length;
                console.log("***TAMAÑO DEPTARTAMENTO SEDE" +TamañodepartamentoSede);
                for(var i = 0; i < (TamañodepartamentoSede.length-1); i++){
                    if(dosimcontrolCrist[i].checked){
                        console.log("ESTA SELECCIONADO");
                    }else{
                        console.log("ESTA SELECCIONADO");

                    }
                } */

                /* var dosimetros_torax = document.querySelectorAll('input[name="dosimetro_torax_sede'+(i+1)+'[]"]');
                console.log(dosimetros_torax);
                console.log("ESTAS SON LOS DOSIMETROS TORAX DE LA SEDE"+ (i+1) + "ESTE ES EL TAMAÑO" +dosimetros_torax.length);
                var dosimetros_cristalino = document.querySelectorAll('input[name="dosimetro_cristalino_sede'+(i+1)+'[]"]');
                console.log(dosimetros_cristalino);
                console.log("ESTAS SON LOS DOSIMETROS CRISTALINO DE LA SEDE"+ (i+1) + "ESTE ES EL TAMAÑO" +dosimetros_cristalino.length);
                var dosimetros_dedo = document.querySelectorAll('input[name="dosimetro_dedo_sede'+(i+1)+'[]"]');
                console.log(dosimetros_dedo);
                console.log("ESTAS SON LOS DOSIMETROS DEDO DE LA SEDE"+ (i+1) + "ESTE ES EL TAMAÑO" +dosimetros_dedo.length);
               
                var dosimetros_control_torax = document.querySelectorAll('input[name="dosimetro_control_torax_sede'+(i+1)+'[]"]');
                console.log(dosimetros_control_torax);
                console.log("ESTAS SON LOS DOSIMETROS CONTROL TORAX DE LA SEDE"+ (i+1) + "ESTE ES EL TAMAÑO" +dosimetros_control_torax.length);
                var dosimetros_area = document.querySelectorAll('input[name="dosimetro_area_sede'+(i+1)+'[]"]');
                console.log(dosimetros_area);
                console.log("ESTAS SON LOS DOSIMETROS AREA DE LA SEDE"+ (i+1) + "ESTE ES EL TAMAÑO" +dosimetros_area.length);
                var dosimetros_caso = document.querySelectorAll('input[name="dosimetro_caso_sede'+(i+1)+'[]"]');
                console.log(dosimetros_caso);
                console.log("ESTAS SON LOS DOSIMETROS CASO DE LA SEDE"+ (i+1) + "ESTE ES EL TAMAÑO" +dosimetros_caso.length); */

            }
            ////////////////////////////////////////////////////////////////////////////////
            
            Swal.fire({
                text: "SEGURO QUE DESEA GUARDAR ESTE CONTRATO DE DOSIMETRÍA??",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1A9980',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI, SEGURO!'
                }).then((result) => {
                if (result.isConfirmed) {
                    var contrato = document.getElementById("codigo_contrato_input").value;
                    var host = window.location.host;
                    var path = "http://"+host+"/POSITRON/public/contratodosimetria/"+contrato+"/pdf";
                    
                    this.submit();
                    window.open(path, '_blank');
                }
            })
        })
    })
</script>
@endsection