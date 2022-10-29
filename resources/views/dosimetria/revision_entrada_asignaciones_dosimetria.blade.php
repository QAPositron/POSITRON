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
    <div class="col-md-8 ">
        <h2 class="text-center">REVISIÓN DE ENTRADA PARA DOSÍMETROS ASIGNADOS</h2>
        <h3 class="text-center"><i>{{$contdosisededepto->contratodosimetriasede->sede->empresa->nombre_empresa}} - SEDE: {{$contdosisededepto->contratodosimetriasede->sede->nombre_sede}}</i></h3>
        <h3 class="text-center">    
            @if($mesnumber == 1)
                MES 1 (@php
                    $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                    echo $meses[date("m", strtotime($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio))]." DE ".date("Y", strtotime($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio)) ;
                @endphp),  ESPECIALIDAD: {{$contdosisededepto->departamentosede->departamento->nombre_departamento}}  </h3>
            @else
                MES {{$mesnumber}} ( <span id="mes{{$mesnumber}}"></span> ),  ESPECIALIDAD:{{$contdosisededepto->departamentosede->departamento->nombre_departamento}}  
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
                    <input class="form-control" type="number" name="codigo_etiqueta" id="codigo_etiqueta" placeholder="-DIGITE UN CODIGO-" autofocus >
                </div>
                <div class="col-md m-3">
                    <h6 class="pt-4 text-center">CÓDIGO DEL DOSÍMETRO </h6>
                    <br>
                    <input class="form-control" type="number" name="codigo_dosimetro" id="codigo_dosimetro" placeholder="-DIGITE UN CODIGO-" autofocus >
                </div>
            </div>
            
            <div class="row">
                <div class="col-md"></div>
                <div class="col-md-6 ">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="dosi_control" name="dosi_control" checked>
                        <label class="form-check-label" for="defaultCheck1">    
                            DOSIMETRO DE CONTROL
                        </label>
                    </div>
                </div>
                <div class="col-md"></div>
            </div>
            <br>
        </div>
    </div>
    <div class="col-md"></div>
</div>
<br>
<br>
<div class="row">
    
    <div class="col-md-7">
        <div class="row">
            <div class="col-md">
                <div class="table table-responsive p-4">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr class="table-active text-center ">
                                <th class='align-middle py-4' style='width: 40%'>TRABAJADOR</th>
                                <th class='align-middle py-4' >No. IDEN.</th>
                                <th class='align-middle py-4' >DOSÍMETRO</th>
                                <th class='align-middle py-4' >HOLDER</th>
                                <th class='align-middle py-4' >OCUPACIÓN</th>
                                <th class='align-middle py-4' >UBICACIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($dosicontrolasig->isEmpty())
                                @foreach($trabjasignados as $trabasig)
                                    <tr id='{{$trabasig->id_trabajadordosimetro}}' class="text-center" >
                                        <td class='align-middle py-3'>@if(!empty($trabasig->persona->primer_nombre_persona)){{$trabasig->persona->primer_nombre_persona}} {{$trabasig->persona->segundo_nombre_persona}} {{$trabasig->persona->primer_apellido_persona}} {{$trabasig->persona->segundo_apellido_persona}}@endif </td>
                                        <td class='align-middle py-3'>@if(!empty($trabasig->persona->cedula_persona)) {{$trabasig->persona->cedula_persona}}@endif </td>
                                        <td class='align-middle py-3'>{{$trabasig->dosimetro->codigo_dosimeter}}</td>
                                        <td class='align-middle py-3'>
                                            @if($trabasig->holder_id == '')
                                                N.A.
                                            @else
                                                {{$trabasig->holder->codigo_holder}}
                                            @endif
                                        </td>
                                        <td class='align-middle  py-3'>{{$trabasig->ocupacion}}</td>
                                        <td class='align-middle py-3'>{{$trabasig->ubicacion}}</td>
                                    </tr>
                                @endforeach
                            @else
                                @foreach($dosicontrolasig as $dosicontasig)
                                    <tr id="C{{$dosicontasig->id_dosicontrolcontdosisedes}}">
                                        <td class='align-middle py-3'>CONTROL</td>
                                        <td class='align-middle py-3'>N.A.</td>
                                        <td class='align-middle py-3'>{{$dosicontasig->dosimetro->codigo_dosimeter}}</td>
                                        <td class='align-middle py-3'>N.A.</td>
                                        <td class='align-middle py-3'>{{$dosicontasig->ocupacion}}</td>
                                        <td class='align-middle py-3'>CONTROL</td>
                                        
                                    </tr>
                                @endforeach
                                @foreach($trabjasignados as $trabasig)
                                    <tr id='{{$trabasig->id_trabajadordosimetro}}'>
                                        <td class='align-middle py-3'>@if(!empty($trabasig->persona->primer_nombre_persona)){{$trabasig->persona->primer_nombre_persona}} {{$trabasig->persona->segundo_nombre_persona}} {{$trabasig->persona->primer_apellido_persona}} {{$trabasig->persona->segundo_apellido_persona}}@endif </td>
                                        <td class='align-middle py-3'>@if(!empty($trabasig->persona->cedula_persona)) {{$trabasig->persona->cedula_persona}}@endif </td>
                                        <td class='align-middle py-3'>{{$trabasig->dosimetro->codigo_dosimeter}}</td>
                                        <td class='align-middle py-3'>
                                            @if($trabasig->holder_id == '')
                                                N.A.
                                            @else
                                                {{$trabasig->holder->codigo_holder}}
                                            @endif
                                        </td>
                                        <td class='align-middle py-3'>{{$trabasig->ocupacion}}</td>
                                        <td class='align-middle py-3'>{{$trabasig->ubicacion}}</td>
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
    <div class="col-md-5">
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
            console.log();
            var fechaesp = meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
             console.log(r + fechaesp + "ESTA ES LA I"+($i+1)); 
            if("{{$mesnumber}}" == ($i+1) && "{{$mesnumber}}" != 1){
                
                document.getElementById('mes{{$mesnumber}}').innerHTML = fechaesp;
            }
        }
            
    })

</script>
<script type="text/javascript">
    
    $(document).ready(function(){
        
        @foreach($trabjasignados as $trabj)
            if('{{$trabj->revision_entrada}}' == 'TRUE'){
                let tr = document.getElementById('{{$trabj->id_trabajadordosimetro}}'); 
                tr.style.boxShadow = "0px 0px 7px 1px rgb(26, 153, 128)";  
            }
        @endforeach
        @foreach($dosicontrolasig as $dosicont)
            if('{{$dosicont->revision_entrada}}' == 'TRUE'){
                let tr = document.getElementById('{{$dosicont->id_dosicontrolcontdosisedes}}'); 
                tr.style.boxShadow = "0px 0px 7px 1px rgb(26, 153, 128)";  
            }
        @endforeach

        $('#dosi_control').on('change', function(){
            var codigoEtiq = document.querySelector('#codigo_etiqueta').value;
            const js = document.querySelector('#dosi_control').checked;
            console.log("ESTADO INICIAL"+js);
            console.log("codigo etiqueta con checkbox estado inicial"+codigoEtiq+js);
            
            if(js){

                consultarDosiControl();
            }else{
                consultarTrabDosi();
            }
        })
        
        function consultarDosiControl(){
            
            var codigoDosi = document.getElementById('codigo_dosimetro').value; 
            console.log(codigoDosi);
            if(codigoDosi != ''){
                $.get('dosimetro',{codigo_dosi : codigoDosi}, function(dosimetro){
                    console.log(dosimetro);
                    if(dosimetro.length != 0){
                        var check = 0;
                        var codigoEtiq = document.getElementById("codigo_etiqueta").value;
                        console.log(check);
                        @foreach($dosicontrolasig as $dosicont)
                            if(codigoEtiq == codigoDosi && codigoDosi == '{{$dosicont->dosimetro->codigo_dosimeter}}' && dosimetro[0].estado_dosimetro == 'EN USO'){
                                console.log("SI SE HIZO MATCH CONTROL");
                                check = 1;
                                Swal.fire({
                                    icon: 'success',
                                    title: 'CORRECTO!!',
                                    text: 'SI SE ENCUENTRA RELACIONADO ESTE DOSÍMETRO DE CONTROL Y ADEMAS COINCIDE LA UBICACIÓN Y ESTADO',
                                    showConfirmButton: false,
                                    timer: 6000
                                })
    
                                document.getElementById("codigo_dosimetro").value = "";
                                document.getElementById("codigo_etiqueta").value = "";
                                document.querySelector('#dosi_control').disabled= false;
                                $.get('dosimetroControlEntrada', {id_dosicontrolcontdosisedes: '{{$dosicont->id_dosicontrolcontdosisedes}}'}, function(dosicontrol){
                                    console.log("SE HIZO EL CHECK CONTROL"+dosicontrol);
                                    let tr = document.getElementById('{{$dosicont->id_dosicontrolcontdosisedes}}'); 
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
                                text: 'NO SE ENCUENTRA RELACIONADO ESTE DOSÍMETRO DE CONTROL',
                                showConfirmButton: false,
                                timer: 6000
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
                            timer: 6000
                        })
                        document.getElementById("codigo_dosimetro").value = "";
                        document.getElementById("codigo_etiqueta").value = "";
                        document.querySelector('#dosi_control').disabled= false;
                        console.log("NO EXISTE ESTE DOSIMETRO");
                    }
                })
            }
        }

        function consultarTrabDosi(){
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
                                    text: 'SI SE ENCUENTRA RELACIONADO ESTE DOSÍMETRO Y ADEMAS COINCIDE LA UBICACIÓN',
                                    showConfirmButton: false,
                                    timer: 4000
                                })
                                document.getElementById("codigo_dosimetro").value = "";
                                document.getElementById("codigo_etiqueta").value = "";
                                document.querySelector('#dosi_control').disabled= false;
                                $.get('trabajadordosimetroEntrada', {id_trabajadordosimetro: '{{$trabj->id_trabajadordosimetro}}'}, function(trabajadordosi){
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
                                text: 'NO SE ENCUENTRA RELACIONADO ESTE DOSÍMETRO',
                                showConfirmButton: false,
                                timer: 3000
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
                            timer: 3000
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

        $('#codigo_dosimetro').on('change', function(){
            var codigoEtiq = document.querySelector('#codigo_etiqueta').value;
            const js = document.querySelector('#dosi_control').checked;
            console.log("ESTADO INICIAL"+js);
            console.log("codigo etiqueta con checkbox estado inicial"+codigoEtiq+js);
            document.querySelector('#dosi_control').disabled= true;
            if(js){
                consultarDosiControl();
            }else{
                consultarTrabDosi();
            }
        });
        $('#codigo_etiqueta').on('change', function(){
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
        });
        
        
        
    })
</script>
@endsection