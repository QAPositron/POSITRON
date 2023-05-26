@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col-md ">
        <a type="button" class="btn btn-circle colorQA" href="{{route('detallesedecont.create', $contdosisededepto->id_contdosisededepto)}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left mt-1" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
        </a>
    </div>
    <div class="col-md-11">
        <h2 class="text-center">REVISIÓN DE SALIDA PARA DOSÍMETROS ASIGNADOS</h2>
        <h3 class="text-center"><i>{{$contdosisededepto->contratodosimetriasede->sede->empresa->nombre_empresa}} - SEDE: {{$contdosisededepto->contratodosimetriasede->sede->nombre_sede}}</i></h3>
        <h3 class="text-center">ESPECIALIDAD: <i> {{$contdosisededepto->departamentosede->departamento->nombre_departamento}}</i></h3>
        <h3 class="text-center">
            @if($mesnumber == 1)
                PERÍODO 1 (@php
                    $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                    echo $meses[date("m", strtotime($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio))]." DE ".date("Y", strtotime($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio)) ;
                @endphp)
            @else
                PERÍODO {{$mesnumber}} ( <span id="mes{{$mesnumber}}"></span> )
            @endif
        </h3>
    </div>
    <div class="col-md "></div>
</div>
<br>
<br>

<div class="row">
    <div class="col-md"></div>
    <div class="col-md-5">
        <div class="card text-dark bg-light">
            <div class="row">
                <div class="col-md m-3">
                    <h6 class="pt-4 text-center">CÓDIGO DE LA ETIQUETA </h6>
                    <br>
                    <input class="form-control" type="text" name="codigo_etiqueta" id="codigo_etiqueta" placeholder="-DIGITE UN CODIGO-" autofocus >
                </div>
                <div class="col-md m-3">
                    <h6 class="pt-4 text-center">CÓDIGO DEL DOSÍMETRO </h6>
                    <br>
                    <input class="form-control" type="text" name="codigo_dosimetro" id="codigo_dosimetro" placeholder="-DIGITE UN CODIGO-" autofocus >
                </div>
            </div>
            
            <div class="row">
                <div class="col-md"></div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="dosi_control" name="dosi_control" checked>
                        <label class="form-check-label" for="defaultCheck1">    
                            DOSIMETRO DE CONTROL
                        </label>
                    </div>
                </div>
                <div class="col-md"></div>
            </div>
            <div class="row">
                <div class="col-md"></div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="dosi_ambiental" name="dosi_ambiental">
                        <label class="form-check-label" for="defaultCheck1">    
                            DOSIMETRO AMBIENTAL
                        </label>
                    </div>
                </div>
                <div class="col-md"></div>
            </div>
            <br>
        </div>
    </div>
    <div class="col-md text-center">
        
        <a type="button" class="btn btn-circle colorQA" {{-- href="{{route('Reporterevisionsalida.pdf', ['empresa'=> 0, 'deptodosi' =>$contdosisededepto->id_contdosisededepto , 'mesnumber' => $mesnumber])}}" --}} onclick="alertCertificado('{{0}}', '{{$contdosisededepto->id_contdosisededepto}}', '{{$mesnumber}}', {{$dosicontrolasig}}, {{$trabjasignados}});" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-file-earmark-pdf pt-1" viewBox="0 0 16 16">
                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
            </svg>
        </a>
        <br>
        CERTIFICADO
    </div>
</div>
<br>
<br>
<div class="row">
    
    <div class="col-md-8">
        <div class="row">
            <div class="col-md">
                <div class="table table-responsive p-4">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr class="table-active text-center ">
                                <th class='align-middle py-4' style='width: 40%'>TRABAJADOR / ÁREA</th>
                                <th class='align-middle py-4' >No. IDEN.</th>
                                <th class='align-middle py-4' >DOSÍMETRO</th>
                                <th class='align-middle py-4' >HOLDER</th>
                                <th class='align-middle py-4' >OCUPACIÓN</th>
                                <th class='align-middle py-4' >UBICACIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($dosicontrolasig->isEmpty())
                                @foreach($areadosiasig as $areasig)
                                    <tr id='A{{$areasig->id_dosiareacontdosisedes}}'>
                                        <td class='align-middle py-3'>{{$areasig->areadepartamentosede->nombre_area}}</td>
                                        <td class='align-middle py-3 text-center'>N.A. </td>
                                        <td class='align-middle py-3 text-center'>{{$areasig->dosimetro->codigo_dosimeter}}</td>
                                        <td class='align-middle py-3 text-center'> N.A.
                                            {{-- @if($areasig->holder_id == '')
                                                N.A.
                                            @else
                                                {{$areasig->holder->codigo_holder}}
                                            @endif --}}
                                        </td>
                                        <td class='align-middle  py-3 text-center'>{{$contdosisededepto->ocupacion}}</td>
                                        <td class='align-middle py-3 text-center'>AMBIENTAL</td>
                                    </tr>
                                @endforeach
                                @foreach($trabjasignados as $trabasig)
                                    <tr id='{{$trabasig->id_trabajadordosimetro}}'>
                                        <td class='align-middle py-3'>@if(!empty($trabasig->persona->primer_nombre_persona)){{$trabasig->persona->primer_nombre_persona}} {{$trabasig->persona->segundo_nombre_persona}} {{$trabasig->persona->primer_apellido_persona}} {{$trabasig->persona->segundo_apellido_persona}}@endif </td>
                                        <td class='align-middle py-3 text-center'>@if(!empty($trabasig->persona->cedula_persona)) {{$trabasig->persona->cedula_persona}}@endif </td>
                                        <td class='align-middle py-3 text-center'>{{$trabasig->dosimetro->codigo_dosimeter}}</td>
                                        <td class='align-middle py-3 text-center'>
                                            @if($trabasig->holder_id == '')
                                                N.A.
                                            @else
                                                {{$trabasig->holder->codigo_holder}}
                                            @endif
                                        </td>
                                        <td class='align-middle  py-3 text-center'>{{$contdosisededepto->ocupacion}}</td>
                                        <td class='align-middle py-3 text-center'>{{$trabasig->ubicacion}}</td>
                                    </tr>
                                @endforeach
                            @else
                                @foreach($dosicontrolasig as $dosicontasig)
                                    <tr id="C{{$dosicontasig->id_dosicontrolcontdosisedes}}">
                                        <td class='align-middle py-3'>CONTROL {{$dosicontasig->ubicacion}}</td>
                                        <td class='align-middle py-3 text-center'>N.A.</td>
                                        <td class='align-middle py-3 text-center'>{{$dosicontasig->dosimetro->codigo_dosimeter}}</td>
                                        <td class='align-middle py-3 text-center'>
                                            @if($dosicontasig->holder_id == '')
                                                N.A.
                                            @else
                                                {{$dosicontasig->holder->codigo_holder}}
                                            @endif
                                        </td>
                                        <td class='align-middle py-3 text-center'>{{$contdosisededepto->ocupacion}}</td>
                                        <td class='align-middle py-3 text-center'>{{$dosicontasig->ubicacion}}</td>
                                        
                                    </tr>
                                @endforeach
                                @foreach($areadosiasig as $areasig)
                                    <tr id='A{{$areasig->id_dosiareacontdosisedes}}'>
                                        <td class='align-middle py-3'>{{$areasig->areadepartamentosede->nombre_area}}</td>
                                        <td class='align-middle py-3 text-center'>N.A. </td>
                                        <td class='align-middle py-3 text-center'>{{$areasig->dosimetro->codigo_dosimeter}}</td>
                                        <td class='align-middle py-3 text-center'> N.A.
                                            {{-- @if($areasig->holder_id == '')
                                                N.A.
                                            @else
                                                {{$areasig->holder->codigo_holder}}
                                            @endif --}}
                                        </td>
                                        <td class='align-middle  py-3 text-center'>{{$contdosisededepto->ocupacion}}</td>
                                        <td class='align-middle py-3 text-center'>AMBIENTAL</td>
                                    </tr>
                                @endforeach
                                @foreach($trabjasignados as $trabasig)
                                    <tr id='{{$trabasig->id_trabajadordosimetro}}'>
                                        <td class='align-middle py-3'>@if(!empty($trabasig->persona->primer_nombre_persona)){{$trabasig->persona->primer_nombre_persona}} {{$trabasig->persona->segundo_nombre_persona}} {{$trabasig->persona->primer_apellido_persona}} {{$trabasig->persona->segundo_apellido_persona}}@endif </td>
                                        <td class='align-middle py-3  text-center'>@if(!empty($trabasig->persona->cedula_persona)) {{$trabasig->persona->cedula_persona}}@endif </td>
                                        <td class='align-middle py-3  text-center'>{{$trabasig->dosimetro->codigo_dosimeter}}</td>
                                        <td class='align-middle py-3  text-center'>
                                            @if($trabasig->holder_id == '')
                                                N.A.
                                            @else
                                                {{$trabasig->holder->codigo_holder}}
                                            @endif
                                        </td>
                                        <td class='align-middle py-3  text-center'>{{$contdosisededepto->ocupacion}}</td>
                                        <td class='align-middle py-3  text-center'>{{$trabasig->ubicacion}}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <br>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <br>
        <div class="card border-secondary text-bg-light mb-3">
            <div class="card-header text-center">
                <h4 class="card-title ">INFORMACIÓN DEL DOSÍMETRO</h4>
            </div>
            <div class="card-body ">
                <div class="table table-responsive p-4">
                    <table class="table table-sm ">
                        <tbody>
                            <tr>
                                <td class="align-middle"><h6 class="text-end m-0">No. DOSÍMETRO :</h6></td>
                                <td class="align-middle"><label id="codigo_dosi"></label></td>
                            </tr>
                            <tr>
                                <td class="align-middle"><h6 class="text-end m-0">TIPO :</h6></td>
                                <td class="align-middle"><label id="tipo_dosi"></label></td>
                            </tr>
                            <tr>
                                <td class="align-middle"><h6 class="text-end m-0">TECNOLOGIA :</h6></td>
                                <td class="align-middle"><label id="tecnologia_dosi"></label></td>
                            </tr>
                            <tr>
                                <td class="align-middle"><h6 class="text-end m-0">ESTADO :</h6></td>
                                <td class="align-middle"><label id="estado_dosi"></label></td>
                            </tr>
                            <tr>
                                <td class="align-middle"><h6 class="text-end m-0">USO ACTUAL :</h6></td>
                                <td class="align-middle"><label id="uso_dosi"></label></td>
                        </tbody>
                    </table>
                </div>
               
            </div>
            
            <br>
        </div>
    </div>
    
</div>


<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous">
</script>

<script type="text/javascript">
    $(document).ready(function(){
        // Creamos array con los meses del año
        const meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
        let fecha = new Date("{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio}}, 00:00:00" );
        for($i=0; $i<=12; $i++){
            var r = new Date(new Date(fecha).setMonth(fecha.getMonth()+$i));
            
            var fechaesp = meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
             /* console.log(r + fechaesp + "ESTA ES LA I"+($i+1));  */
            if("{{$mesnumber}}" == ($i+1) && "{{$mesnumber}}" != 1){
                
                document.getElementById('mes{{$mesnumber}}').innerHTML = fechaesp;
            }
        }
            
    })

</script>
<script type="text/javascript">
    
    $(document).ready(function(){
        @foreach($areadosiasig as $areasig)
            if('{{$areasig->revision_salida}}' == 'TRUE'){
                let tr = document.getElementById('A{{$areasig->id_dosiareacontdosisedes}}'); 
                tr.style.boxShadow = "0px 0px 7px 1px rgb(26, 153, 128)";  
            }
        @endforeach
        @foreach($trabjasignados as $trabj)
            if('{{$trabj->revision_salida}}' == 'TRUE'){
                let tr = document.getElementById('{{$trabj->id_trabajadordosimetro}}'); 
                tr.style.boxShadow = "0px 0px 7px 1px rgb(26, 153, 128)";  
            }
        @endforeach
        @foreach($dosicontrolasig as $dosicont)
            if('{{$dosicont->revision_salida}}' == 'TRUE'){
                let tr = document.getElementById('C{{$dosicont->id_dosicontrolcontdosisedes}}'); 
                tr.style.boxShadow = "0px 0px 7px 1px rgb(26, 153, 128)";  
            }
        @endforeach
        
       

        $('#dosi_control').on('change', function(){
            console.log("ENTRO AL DOSI CONTROL CHANGE");
            var codigoEtiq = document.querySelector('#codigo_etiqueta').value;
            const js = document.querySelector('#dosi_control').checked;
            console.log("ESTADO INICIAL"+js);
            console.log("codigo etiqueta con checkbox estado inicial"+codigoEtiq+js);
            
            if(js){
                document.getElementById("dosi_ambiental").disabled = true;
                consultarDosiControl();
            }else{
                document.getElementById("dosi_ambiental").disabled = false;
                consultarTrabDosi();
            }
        });
        $('#dosi_ambiental').on('change', function(){
            console.log("ENTRO AL DOSI  AMBIENTAL CHANGE");
            var codigoEtiq = document.querySelector('#codigo_etiqueta').value;
            const js = document.querySelector('#dosi_ambiental').checked;
            console.log("ESTADO INICIAL"+js);
            console.log("codigo etiqueta con checkbox estado inicial"+codigoEtiq+js);
            
            if(js){
                document.getElementById("dosi_control").disabled = true;
                consultarAreaDosi();
            }else{
                document.getElementById("dosi_control").disabled = false;
                consultarTrabDosi();
            }
        });
        
        function consultarDosiControl(){
            console.log("****CONSULTA DOSIMETRO CONTROL****");
            var codigoDosi = document.getElementById('codigo_dosimetro').value; 
            console.log(codigoDosi);
            if(codigoDosi != ''){
                $.get('dosimetro',{codigo_dosi : codigoDosi}, function(dosimetro){
                    console.log(dosimetro);
                    if(dosimetro.length != 0){
                        var check = 0;
                        var codigoEtiq = document.getElementById("codigo_etiqueta").value;
                        console.log(check);
                        console.log("codigo etiqueta "+codigoEtiq);
                        @foreach($dosicontrolasig as $dosicont)
                            if(codigoEtiq == codigoDosi && codigoDosi == '{{$dosicont->dosimetro->codigo_dosimeter}}'/*  && dosimetro[0].estado_dosimetro == 'EN USO' */){
                                console.log("SI SE HIZO MATCH CONTROL");
                                check = 1;
                                Swal.fire({
                                    icon: 'success',
                                    title: 'CORRECTO!!',
                                    text: 'SI HAY COINCIDENCIA ENTRE LA ETIQUETA Y EL DOSíMETRO DE CONTROL',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
    
                                document.getElementById("codigo_dosimetro").value = "";
                                document.getElementById("codigo_etiqueta").value = "";
                                document.querySelector('#dosi_control').disabled= false;
                                $.get('dosimetroControl', {id_dosicontrolcontdosisedes: '{{$dosicont->id_dosicontrolcontdosisedes}}'}, function(dosicontrol){
                                    console.log("SE HIZO EL CHECK CONTROL"+dosicontrol);
                                    let tr = document.getElementById('C{{$dosicont->id_dosicontrolcontdosisedes}}'); 
                                    tr.style.boxShadow = "0px 0px 7px 1px rgb(26, 153, 128)";  
                                })
                            }
                        @endforeach  
                        console.log(check);
                        if(check == 0){
                            console.log("NO SE HIZO MATCH CONTROL");
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR!!',
                                text: 'NO HAY COINCIDENCIA ENTRE LA ETIQUETA Y EL DOSÍMETRO DE CONTROL',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            document.getElementById("codigo_dosimetro").value = "";
                            document.getElementById("codigo_etiqueta").value = "";
                            document.querySelector('#dosi_control').disabled= false;
                        }
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!!',
                            text: 'NO EXISTE NINGUN DOSÍMETRO CON ESE CODIGO',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        document.getElementById("codigo_dosimetro").value = "";
                        document.getElementById("codigo_etiqueta").value = "";
                        document.querySelector('#dosi_control').disabled= false;
                        console.log("NO EXISTE ESTE DOSIMETRO");
                    }
                    document.getElementById("codigo_dosi").innerHTML = dosimetro[0].codigo_dosimeter;
                    document.getElementById("tipo_dosi").innerHTML =  dosimetro[0].tipo_dosimetro;
                    document.getElementById("tecnologia_dosi").innerHTML = dosimetro[0].tecnologia_dosimetro;
                    document.getElementById("estado_dosi").innerHTML = dosimetro[0].estado_dosimetro;
                    document.getElementById("uso_dosi").innerHTML = dosimetro[0].uso_dosimetro;
                })
            }
        }

        function consultarTrabDosi(){
            console.log("/////CONSULTA DOSIMETRO TRABAJADOR/////");

            var codigoDosi = document.getElementById('codigo_dosimetro').value; 
            console.log("DOSIMETRO" + codigoDosi);
            if(codigoDosi != ''){
                $.get('dosimetro',{codigo_dosi : codigoDosi}, function(dosimetro){
                    console.log(dosimetro);
                    if(dosimetro.length != 0){
                        var check = 0;
                        var codigoEtiq = document.getElementById("codigo_etiqueta").value;
                        console.log("ETIQUETA" +codigoEtiq)
                        console.log(check);
                        @foreach($trabjasignados as $trabj)
                            if(codigoEtiq == codigoDosi && codigoDosi == '{{$trabj->dosimetro->codigo_dosimeter}}' && dosimetro[0].uso_dosimetro == '{{$trabj->ubicacion}}'){
                                console.log("SI SE HIZO MATCH");
                                check = 1;
                                Swal.fire({
                                    icon: 'success',
                                    title: 'CORRECTO!!',
                                    text: 'SI HAY COINCIDENCIA ENTRE LA ETIQUETA Y EL DOSÍMETRO',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                document.getElementById("codigo_dosimetro").value = "";
                                document.getElementById("codigo_etiqueta").value = "";
                                document.querySelector('#dosi_control').disabled= false;
                                $.get('trabajadordosimetro', {id_trabajadordosimetro: '{{$trabj->id_trabajadordosimetro}}'}, function(trabajadordosi){
                                    console.log("SE HIZO EL CHECK"+trabajadordosi);
                                    let tr = document.getElementById('{{$trabj->id_trabajadordosimetro}}'); 
                                    tr.style.boxShadow = "0px 0px 7px 1px rgb(26, 153, 128)";  
                                })
                            }
                        @endforeach  
                        console.log(check);
                        if(check == 0){
                            console.log("NO SE HIZO MATCH");
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR!!',
                                text: 'NO HAY COINCIDENCIA ENTRE LA ETIQUETA Y EL DOSÍMETRO',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            document.getElementById("codigo_dosimetro").value = "";
                            document.getElementById("codigo_etiqueta").value = "";
                            document.querySelector('#dosi_control').disabled= false;
                        }
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!!',
                            text: 'NO EXISTE NINGUN DOSÍMETRO CON ESE CODIGO',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        document.getElementById("codigo_dosimetro").value = "";
                        document.getElementById("codigo_etiqueta").value = "";
                        document.querySelector('#dosi_control').disabled= false;
                        console.log("NO EXISTE");
                    }
                    document.getElementById("codigo_dosi").innerHTML = dosimetro[0].codigo_dosimeter;
                    document.getElementById("tipo_dosi").innerHTML =  dosimetro[0].tipo_dosimetro;
                    document.getElementById("tecnologia_dosi").innerHTML = dosimetro[0].tecnologia_dosimetro;
                    document.getElementById("estado_dosi").innerHTML = dosimetro[0].estado_dosimetro;
                    document.getElementById("uso_dosi").innerHTML = dosimetro[0].uso_dosimetro;
                    
                })
            }
        }

        function consultarAreaDosi(){
            console.log("/////CONSULTA DOSIMETRO AMBIENTAL/////");

            var codigoDosi = document.getElementById('codigo_dosimetro').value; 
            console.log("DOSIMETRO" + codigoDosi);
            if(codigoDosi != ''){
                $.get('dosimetro',{codigo_dosi : codigoDosi}, function(dosimetro){
                    console.log(dosimetro);
                    if(dosimetro.length != 0){
                        var check = 0;
                        var codigoEtiq = document.getElementById("codigo_etiqueta").value;
                        console.log("ETIQUETA" +codigoEtiq)
                        console.log(check);
                        @foreach($areadosiasig as $area)
                            if(codigoEtiq == codigoDosi && codigoDosi == '{{$area->dosimetro->codigo_dosimeter}}' && dosimetro[0].uso_dosimetro == 'AMBIENTAL'){
                                console.log("SI SE HIZO MATCH");
                                check = 1;
                                Swal.fire({
                                    icon: 'success',
                                    title: 'CORRECTO!!',
                                    text: 'SI HAY COINCIDENCIA ENTRE LA ETIQUETA Y EL DOSÍMETRO',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                document.getElementById("codigo_dosimetro").value = "";
                                document.getElementById("codigo_etiqueta").value = "";
                                /* document.querySelector('#dosi_control').disabled= false; */
                                $.get('dosimetroAmbiental', {id_dosiareacontdosisedes: '{{$area->id_dosiareacontdosisedes}}'}, function(ambientaldosi){
                                    console.log("SE HIZO EL CHECK"+ambientaldosi);
                                    let tr = document.getElementById('A{{$area->id_dosiareacontdosisedes}}'); 
                                    tr.style.boxShadow = "0px 0px 7px 1px rgb(26, 153, 128)";  
                                })
                            }
                        @endforeach  
                        console.log(check);
                        if(check == 0){
                            console.log("NO SE HIZO MATCH");
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR!!',
                                text: 'NO HAY COINCIDENCIA ENTRE LA ETIQUETA Y EL DOSÍMETRO',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            document.getElementById("codigo_dosimetro").value = "";
                            document.getElementById("codigo_etiqueta").value = "";
                            /* document.querySelector('#dosi_control').disabled= false; */
                        }
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!!',
                            text: 'NO EXISTE NINGUN DOSÍMETRO CON ESE CODIGO',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        document.getElementById("codigo_dosimetro").value = "";
                        document.getElementById("codigo_etiqueta").value = "";
                        /* document.querySelector('#dosi_control').disabled= false; */
                        console.log("NO EXISTE");
                    }
                    document.getElementById("codigo_dosi").innerHTML = dosimetro[0].codigo_dosimeter;
                    document.getElementById("tipo_dosi").innerHTML =  dosimetro[0].tipo_dosimetro;
                    document.getElementById("tecnologia_dosi").innerHTML = dosimetro[0].tecnologia_dosimetro;
                    document.getElementById("estado_dosi").innerHTML = dosimetro[0].estado_dosimetro;
                    document.getElementById("uso_dosi").innerHTML = dosimetro[0].uso_dosimetro;
                    
                })
            }
        }

        $('#codigo_dosimetro').on('change', function(){
            console.log("ENTRO AL CODIGO DOSIMETRO CHANGE");

            var codigoEtiq = document.querySelector('#codigo_etiqueta').value;
            const jscontrol = document.querySelector('#dosi_control').checked;
            const jsambiental = document.querySelector('#dosi_ambiental').checked;
            console.log("ESTADO INICIAL CONTROL"+jscontrol);
            console.log("ESTADO INICIAL AMBIENTAL"+jsambiental);
            console.log("codigo etiqueta con checkbox estado inicial control"+codigoEtiq+jscontrol);
            console.log("codigo etiqueta con checkbox estado inicial ambiental"+codigoEtiq+jsambiental);
            /* document.querySelector('#dosi_control').disabled= true; */
            if(jscontrol){
                consultarDosiControl();
            }else if(jsambiental){
                consultarAreaDosi();
            }else{
                consultarTrabDosi();
            }
        });
        /* $('#codigo_etiqueta').on('change', function(){
            console.log("ENTRO AL CODIGO ETIQUETA CHANGE");

            var codigoEtiq = document.querySelector('#codigo_etiqueta').value;
            const js = document.querySelector('#dosi_control').checked;
            console.log("ESTADO INICIAL"+js);
            console.log("codigo etiqueta con checkbox estado inicial"+codigoEtiq+js);
            document.getElementById("codigo_dosimetro").value = "";
            
            if(js){
                console.log("ESTTRO AL IF TRUE");
                consultarDosiControl();
            }else{
                consultarTrabDosi();
            }
        }); */
        
        
    })
    function alertCertificado(empresa, id, mes){
        console.log("SE SELECCIONO EL BOTON" +empresa+id+mes);
        var dosi = 0;
        var trab = 0;
        var area = 0;
        $.get('asignacionesTrab',{id : id, mes: mes}, function(asignacionesTrab){
            console.log("ASIGNACIONES");
            console.log(asignacionesTrab);
            asignacionesTrab.forEach(trabj => {
                if(trabj.revision_salida == null){
                    console.log("hay trabj");
                    trab ++;
                }
            });
            console.log("trab="+trab);
            if(trab != 0){
                Swal.fire({
                    title: "ALGUNOS DOSÍMETROS NO HAN SIDO REVISADOS !!!",
                    text:"DESEA GENERAR EL REPORTE DE SALIDA??",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#1A9980',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'SI, SEGURO!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var host = window.location.host;
                        var path = "http://"+host+"/POSITRON/public/reporteRevisionSalida/"+empresa+"/"+id+"/"+mes+"/pdf";
                        window.open(path, '_blank');
                    }
                })
            }else{
                $.get('asignacionesCont', {id : id, mes: mes}, function(asignacionesCont){
                    console.log("ASIGNACIONES CONTROL");
                    console.log(asignacionesCont);
                    asignacionesCont.forEach(dosicont => {
                        if(dosicont.revision_salida == null){
                            console.log("hay dosi");
                            dosi ++;
                        }
                    });
                    console.log("dosi="+dosi);
                    console.log("trab="+trab);
                    if(dosi != 0){
                        Swal.fire({
                            title: "ALGUNOS DOSÍMETROS DE CONTROL NO HAN SIDO REVISADOS !!!",
                            text:"DESEA GENERAR EL REPORTE DE SALIDA??",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#1A9980',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'SI, SEGURO!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                var host = window.location.host;
                                var path = "http://"+host+"/POSITRON/public/reporteRevisionSalida/"+empresa+"/"+id+"/"+mes+"/pdf";
                                window.open(path, '_blank');
                            }
                        })
                    }else{
                        $.get('asignacionesArea', {id : id, mes: mes}, function(asignacionesarea){
                            console.log("ASIGNACIONES AREA");
                            console.log(asignacionesarea);
                            asignacionesarea.forEach(dosiarea => {
                                if(dosiarea.revision_salida == null){
                                    console.log("hay dosi area");
                                    area ++;
                                }
                            });
                            console.log("dosi="+dosi);
                            console.log("trab="+trab);
                            console.log("area="+trab);
                            if(area != 0){
                                Swal.fire({
                                    title: "ALGUNOS DOSÍMETROS AMBIENTAL NO HAN SIDO REVISADOS !!!",
                                    text:"DESEA GENERAR EL REPORTE DE SALIDA??",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#1A9980',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'SI, SEGURO!'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        var host = window.location.host;
                                        var path = "http://"+host+"/POSITRON/public/reporteRevisionSalida/"+empresa+"/"+id+"/"+mes+"/pdf";
                                        window.open(path, '_blank');
                                    }
                                })
                            }else{
                                $.get('trabjencargado', {id : id}, function(trabjencargado){
                                    console.log(trabjencargado)
                                    if(trabjencargado.length != 0){
                                        var host = window.location.host;
                                        var path = "http://"+host+"/POSITRON/public/reporteRevisionSalida/"+empresa+"/"+id+"/"+mes+"/pdf";
                                        window.open(path, '_blank');
                                    }else{
                                        Swal.fire({
                                            title: "NO HAY UN LIDER O PERSONA ENCARGADA DE LA DOSIMETRÍA PARA ESTA SEDE!!!",
                                            text:"DESEA GENERAR EL REPORTE DE SALIDA??",
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#1A9980',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'SI, SEGURO!'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                var host = window.location.host;
                                                var path = "http://"+host+"/POSITRON/public/reporteRevisionSalida/"+empresa+"/"+id+"/"+mes+"/pdf";
                                                window.open(path, '_blank');
                                            }
                                        })
                                    } 
                                });
                            }
                        });
                    }
                });
            }
            
        });
        
    }
</script>
@endsection