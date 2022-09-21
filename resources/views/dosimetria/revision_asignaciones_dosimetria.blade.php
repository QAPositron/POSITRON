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
        <h2 class="text-center">REVISIÓN DE DOSÍMETROS</h2>
        <h3 class="text-center"><i>{{$contdosisededepto->contratodosimetriasede->sede->empresa->nombre_empresa}} - SEDE: {{$contdosisededepto->contratodosimetriasede->sede->nombre_sede}}</i> <br>
            @if($mesnumber == 1)
                MES 1 (@php
                    $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                    echo $meses[date("m", strtotime($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio))]." DE ".date("Y", strtotime($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio)) ;
                @endphp),  ESPECIALIDAD: {{$contdosisededepto->departamentosede->nombre_departamento}}  </h3>
            @else
                MES {{$mesnumber}} ( <span id="mes{{$mesnumber}}"></span> ),  ESPECIALIDAD: {{$contdosisededepto->departamentosede->nombre_departamento}}  </h3>
            @endif

    </div>
    <div class="col-md "></div>
</div>
<br>
<br>
<div class="row ">
    <div class="col-md"></div>
    <div class="col-md-5">
        <div class="row">
            <div class="col"></div>
            <div class="col-md-9">
                <div class="card text-dark bg-light" style="max-width: 25rem;">
                    <h3 class="pt-4 text-center">CÓDIGO DE LA  ETIQUETA </h3>
                    <br>
                    <div class="row">
                        <div class="col-md"></div>
                        <div class="col-md-8">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="dosi_control" name="dosi_control">
                                <label class="form-check-label" for="defaultCheck1">
                                    DOSIMETRO DE CONTROL
                                </label>
                            </div>
                            <br>
                            <input class="form-control" type="number" name="codigo_etiqueta" id="codigo_etiqueta" placeholder="-DIGITE UN CODIGO-" autofocus style="text-transform:uppercase;">
                        </div>
                        <div class="col-md"></div>
                    </div>
                    <br>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="row">
            <div class="col"></div>
            <div class="col-md-9">
                <div class="card text-dark bg-light" style="max-width: 25rem;">
                    <h3 class="pt-4 text-center">CÓDIGO DEL DOSÍMETRO </h3>
                    <br>
                    <div class="row">
                        <div class="col-md"></div>
                        <div class="col-md-8">
                            <input class="form-control" type="number" name="codigo_dosimetro" id="codigo_dosimetro" placeholder="-DIGITE UN CODIGO-" autofocus style="text-transform:uppercase;">
                        </div>
                        <div class="col-md"></div>
                    </div>
                    <br>
                </div>
            </div>
            <div class="col"></div>
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
                                    <tr id="{{$dosicontasig->id_dosicontrolcontdosisedes}}">
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
            if('{{$trabj->revision}}' == 'TRUE'){
                let tr = document.getElementById('{{$trabj->id_trabajadordosimetro}}'); 
                tr.style.boxShadow = "0px 0px 20px 5px rgb(109, 250, 100)";
            }
        @endforeach
        if ($('#dia1').prop('checked') ) {
            console.log("Checkbox seleccionado");
        }else{
            console.log("Checkbox no seleccionado");
        }
        /*if( document.getElementById('dosi_control').checked){
            alert('seleccionado');
             $('#codigo_etiqueta').on('change', function(){
                var codigo = $(this).val();
                console.log(codigo);
                ///////////// CON DOSIMETRO DE CONTROL///////////
                var check = 0;
                @foreach($dosicontrolasig as $dosicontasig)
                    if(codigo == '{{$dosicontasig->id_dosicontrolcontdosisedes}}' ){
                        check = 1;
                        console.log("si existe ese codigo DE DOSIMETRO CONTROL");
                        Swal.fire({
                        icon: 'success',
                        title: 'CORRECTO!!',
                        text: 'SI EXISTE EL REGISTRO DE DOSÍMETRO CONTROL EN ESTE MES DEL CONTRATO',
                        showConfirmButton: false,
                        timer: 3000
                        })
                        document.getElementById("codigo_etiqueta").value = "";
                    }
                @endforeach
                if(check == 0){
                    console.log("no existe ese codigo");
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!!',
                        text: 'NO EXISTE ESTE REGISTRO DE DOSÍMETRO CONTROL PARA ESTE MES DEL CONTRATO',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    document.getElementById("codigo_etiqueta").value = "";
                }
            }) 
        }else{
            alert('no esta seleccionado');
            /*$('#codigo_etiqueta').on('change', function(){
                var codigo = $(this).val();
                console.log(codigo);
             ///////////// SIN DOSIMETRO DE CONTROL///////////
                var check = 0;
                
                @foreach($trabjasignados as $trabj)
                    if(codigo == '{{$trabj->id_trabajadordosimetro}}' ){
                        check = 1;
                        console.log("si existe ese codigo");
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'CORRECTO!!',
                            text: 'SI EXISTE EL REGISTRO EN ESTE MES DEL CONTRATO',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        document.getElementById("codigo_etiqueta").value = "";
                    }
                @endforeach
                if(check == 0){
                    console.log("no existe ese codigo");
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!!',
                        text: 'NO EXISTE ESTE REGISTRO PARA ESTE MES DEL CONTRATO',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    document.getElementById("codigo_etiqueta").value = "";
                }
            }) */
        
        
        $('#codigo_dosimetro').on('change', function(){
            var codigo_dosi = $(this).val();
            console.log(codigo_dosi);
            if(codigo_dosi != ''){

                $.get('dosimetro',{codigo_dosi : codigo_dosi}, function(dosimetro){
                    console.log(dosimetro);
                    $('#codigo_dosi').html("");
                    $('#tipo_dosi').html("");
                    $('#tecnologia_dosi').html("");
                    $('#estado_dosi').html("");
                    $('#uso_dosi').html("");
                    if(dosimetro.length != 0 ){
                        document.getElementById("codigo_dosi").innerHTML = dosimetro[0].codigo_dosimeter;
                        document.getElementById("tipo_dosi").innerHTML = dosimetro[0].tipo_dosimetro;
                        document.getElementById("tecnologia_dosi").innerHTML = dosimetro[0].tecnologia_dosimetro;
                        document.getElementById("estado_dosi").innerHTML = dosimetro[0].estado_dosimetro;
                        document.getElementById("uso_dosi").innerHTML = dosimetro[0].uso_dosimetro;
                        var cheq = 0;
                        @foreach($trabjasignados as $trabj)
                            if(dosimetro[0].codigo_dosimeter =='{{$trabj->dosimetro->codigo_dosimeter}}' && dosimetro[0].uso_dosimetro == '{{$trabj->ubicacion}}' && dosimetro[0].estado_dosimetro == 'EN USO'){
                                let tr = document.getElementById('{{$trabj->id_trabajadordosimetro}}'); 
                                tr.style.boxShadow = "0px 0px 20px 5px rgb(109, 250, 100)";
                                cheq = 1;
                                /* alert('SI EXISTE EL DOSIMETRO'); */
                                Swal.fire({
                                    icon: 'success',
                                    title: 'CORRECTO!!',
                                    text: 'SI SE ENCUENTRA RELACIONADO ESTE DOSÍMETRO Y ADEMAS COINCIDE SU UBICACIÓN',
                                    showConfirmButton: false,
                                    timer: 4000
                                })
                                document.getElementById("codigo_dosimetro").value = "";
                                $.get('trabajadordosimetro', {id_trabajadordosimetro: '{{$trabj->id_trabajadordosimetro}}'}, function(trabajadordosi){
                                    console.log("SE HIZO EL CHECK"+trabajadordosi);
                                })
                            }
                        @endforeach
                        if(cheq == 0){
                            /* alert('NO ESTA RELACIONADO'); */
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR!!',
                                text: 'NO SE ENCUENTRA RELACIONADO ESTE DOSÍMETRO',
                                showConfirmButton: false,
                                timer: 3000
                            })
                            document.getElementById("codigo_dosimetro").value = "";
                        }
                        console.log(cheq);
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!!',
                            text: 'NO EXISTE NINGUN DOSÍMETRO CON ESE CODIGO',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        document.getElementById("codigo_dosimetro").value = "";
                    }
                })
            }

        })
        
    })
</script>
@endsection