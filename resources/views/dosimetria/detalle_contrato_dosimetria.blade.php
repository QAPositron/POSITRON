@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')

<div class="row">
    <div class="col-md">
        <a type="button" class="btn btn-circle colorQA" href="{{route('contratosdosi.createlist', $dosimetriacontrato->empresa->id_empresa)}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left mt-1" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
        </a>
    </div>
    <div class="col-md-11">
        <h2 class="text-center ">DOSIMETRÍA DE<br> <i>{{$dosimetriacontrato->empresa->nombre_empresa}}</i> </h2>
    </div>
    <div class="col-md"></div>
</div>
<br>
<h4 class="text-center" id="id_contrato"></h4>
<br>
<div class="row">
    <div class="col-md"></div>
    <div class="col-md-9">
        <div class="table table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr class="table-active">
                        <th colspan="6" class="table-active text-center">INFORMACIÓN DEL CONTRATO</th>
                    </tr>
                    <tr>
                        <th  colspan='2'>FECHA DE INICIO:</th>
                        <td>{{$dosimetriacontrato->fecha_inicio}}</td>
                        <th  colspan='2'>FECHA FINALIZACIÓN:</th>
                        <td>{{$dosimetriacontrato->fecha_finalizacion}}</td>
                    </tr>
                    <tr>
                        <th  colspan='2'>ESTADO:</th>
                        <td>{{$dosimetriacontrato->estado_contrato}}</td>
                        <th  colspan='2'>PERIODO DE RECAMBIO:</th>
                        <td>{{$dosimetriacontrato->periodo_recambio}}</td>
                    </tr>
                    <tr>
                        <th  colspan='2'>OCUPACIÓN:</th>
                        <td>{{$dosimetriacontrato->ocupacion}}</td>
                        <th  colspan='2'>No. LECTUAS AL AÑO:</th>
                        <td>{{$dosimetriacontrato->numlecturas_año}}</td>
                    </tr>
                </tbody>
                @if($dosimecontrasedeptos[0]->controlTransT_unicoCont == 'TRUE' || $dosimecontrasedeptos[0]->controlTransC_unicoCont == 'TRUE' || $dosimecontrasedeptos[0]->controlTransA_unicoCont == 'TRUE')
                    <tfoot>
                        <tr class="text-center table-active">
                            <th colspan='6'>DOSÍMETROS DE CONTROL TRANSPORTE</th>
                        </tr>
                        <tr class="text-center table-active">
                            <th  colspan='2' class="align-middle">TÓRAX</th>
                            <th  colspan='2' class="align-middle">CRISTALINO</th>
                            <th  colspan='2' class="align-middle">ANILLO</th>
                        </tr>
                        <tr class="text-center">
                            <td  colspan='2' >{{$dosimecontrasedeptos[0]->controlTransT_unicoCont == 'TRUE' ? 1 : 0}}</td>
                            <td  colspan='2' >{{$dosimecontrasedeptos[0]->controlTransC_unicoCont == 'TRUE' ? 1 : 0}}</td>
                            <td  colspan='2' >{{$dosimecontrasedeptos[0]->controlTransA_unicoCont == 'TRUE' ? 1 : 0}}</td>   
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>
    <div class="col-md"></div>
</div>
{{-- <div class="row">
    <div class="col-md"></div>
    <div class="col-md text-center">
        <a href="{{route('contratosdosi.edit', ['empresadosi' => $dosimetriacontrato->empresa->id_empresa, 'contratodosi' => $dosimetriacontrato->id_contratodosimetria])}}" class="btn colorQA">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill mb-1" viewBox="0 0 16 16">
                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
            </svg> EDITAR
        </a>
    </div>
    <div class="col-md"></div>
</div>
<br> --}}

<h4 class="text-center">SEDES SUBSCRITAS A ESTE CONTRATO</h4>
<br>
<div class="row">
    <div class="col-md"></div>
    <div class="col-md-11">
        @php
            $check = 'inicial';
        @endphp 
         
        @foreach($dosimecontrasedeptos as $dosicontsedep)
            @php
                if($dosicontsedep->nombre_sede != $check ){
                    echo "<table class='table  table-bordered'>";
                        echo "<h4 class='text-center'>{$dosicontsedep->nombre_sede}</h4>";  
                        $check = strval($dosicontsedep->nombre_sede);
                        echo "<thead class='table-active text-center border border-light' style='border-width: 5px;'>";  
                            echo "<tr>";
                                echo "<th rowspan='2' class='align-middle' style='width: 15.50%'>ESPECIALIDAD / SUB-ESPECIALIDAD</th>";
                                echo "<th rowspan='2' class='align-middle' style='width: 5.90%'>PERÍODO ACTUAL</th>";
                                echo "<th colspan='5' class='align-middle' >DOSÍMETROS</th>";
                                echo "<th colspan='3' class='align-middle' >CONTROLES</th>";
                                echo "<th rowspan='2' class='align-middle' style='width: 8.50%'>TOTAL DOSÍMETROS</th>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<th class='align-middle' style='width: 8.90%'>TÓRAX</th>";
                                echo "<th class='align-middle' style='width: 8.90%'>CRISTALINO</th>";
                                echo "<th class='align-middle' style='width: 8.90%'>ANILLO</th>";
                                echo "<th class='align-middle' style='width: 8.90%'>AMBIENTAL</th>";
                                echo "<th class='align-middle' style='width: 8.90%'>CASO</th>";
                                /* echo "<th class='align-middle' style='width: 10.90%'>MUÑECA</th>"; */
                                echo "<th class='align-middle' style='width: 8.90%'>TÓRAX</th>";    
                                echo "<th class='align-middle' style='width: 8.90%'>CRISTALINO</th>";
                                echo "<th class='align-middle' style='width: 8.90%'>ANILLO</th>";
                                /* echo "<th class='align-middle'>ACCIONES</th>"; */
                            echo "</tr>";
                        echo "</thead>";
                }
            @endphp
            <tr>
                <td class="text-center align-middle"> <a class="btn btn-outline-primary rounded-pill" href="{{route('detallesedecont.create', $dosicontsedep->id_contdosisededepto)}}">{{$dosicontsedep->nombre_departamento}}</a></td>
                <td class="text-center align-middle">{{$dosicontsedep->mes_actual}}</td>
                <td class="text-center align-middle">{{$dosicontsedep->dosi_torax}}</td>
                <td class="text-center align-middle">{{$dosicontsedep->dosi_cristalino}}</td>
                <td class="text-center align-middle">{{$dosicontsedep->dosi_dedo}}</td> 
                <td class="text-center align-middle">{{$dosicontsedep->dosi_area}}</td>
                <td class="text-center align-middle">{{$dosicontsedep->dosi_caso}}</td>
                {{-- <td class="text-center align-middle">{{$dosicontsedep->dosi_muñeca}}</td> --}}
                @if($dosicontsedep->controlTransT_unicoCont != 'TRUE' && $dosicontsedep->controlTransC_unicoCont != 'TRUE' && $dosicontsedep->controlTransA_unicoCont != 'TRUE')
                    <td class="text-center align-middle">{{$dosicontsedep->dosi_control_torax}}</td>
                    <td class="text-center align-middle">{{$dosicontsedep->dosi_control_cristalino}}</td>
                    <td class="text-center align-middle">{{$dosicontsedep->dosi_control_dedo}}</td>
                    <td class="text-center align-middle">{{$dosicontsedep->dosi_torax + $dosicontsedep->dosi_cristalino + $dosicontsedep->dosi_dedo + $dosicontsedep->dosi_area + $dosicontsedep->dosi_caso + $dosicontsedep->dosi_control_torax + $dosicontsedep->dosi_control_cristalino + $dosicontsedep->dosi_control_dedo}}</td>
                @elseif(count($dosimeNovcontrasedeptos) != 0)
                    <td class="text-center align-middle"></td>
                    <td class="text-center align-middle"></td>
                    <td class="text-center align-middle"></td>
                    <td class="text-center align-middle">{{$dosicontsedep->dosi_torax + $dosicontsedep->dosi_cristalino + $dosicontsedep->dosi_dedo + $dosicontsedep->dosi_area + $dosicontsedep->dosi_caso + $dosicontsedep->dosi_control_torax + $dosicontsedep->dosi_control_cristalino + $dosicontsedep->dosi_control_dedo}}</td>
                @else
                    <td class="text-center align-middle"></td>
                    <td class="text-center align-middle"></td>
                    <td class="text-center align-middle"></td>
                    <td class="text-center align-middle">{{$dosicontsedep->dosi_torax + $dosicontsedep->dosi_cristalino + $dosicontsedep->dosi_dedo + $dosicontsedep->dosi_area + $dosicontsedep->dosi_caso}}</td>
                @endif
                {{-- <td class="text-center align-middle">
                    <div class="row">
                        <div class="col">
                            <form class="eliminar_contdosisedepto" id="eliminar_contdosisedepto" name="eliminar_contdosisedepto" action=" {{route('contratosdosisededepto.destroy', ['detcont'=>$dosicontsedep->id_contratodosimetria, 'contratodosisede'=>$dosicontsedep->contratodosimetriasede_id, 'contratodosisededepto'=>$dosicontsedep->id_contdosisededepto])}}" method="POST">
                                @csrf  
                                @method('delete')
                                <button class="btn btn-danger" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </td> --}}
            </tr>
            @foreach($dosimeNovcontrasedeptos as $dosiNovcontsedep)
                @if($dosiNovcontsedep->contdosisededepto_id == $dosicontsedep->id_contdosisededepto)
                    <tr>
                        <td class="text-center align-middle"  id='{{$dosiNovcontsedep->id_novcontdosisededepto}}'></td>
                        <td class="text-center align-middle">{{$dosiNovcontsedep->mes_asignacion}}</td>
                        <td class="text-center align-middle">{{$dosiNovcontsedep->dosi_torax}}</td>
                        <td class="text-center align-middle">{{$dosiNovcontsedep->dosi_cristalino}}</td>
                        <td class="text-center align-middle">{{$dosiNovcontsedep->dosi_dedo}}</td> 
                        <td class="text-center align-middle">{{$dosiNovcontsedep->dosi_area}}</td>
                        <td class="text-center align-middle">{{$dosiNovcontsedep->dosi_caso}}</td>
                        <td class="text-center align-middle">{{$dosiNovcontsedep->dosi_control_torax}}</td>
                        <td class="text-center align-middle">{{$dosiNovcontsedep->dosi_control_cristalino}}</td>
                        <td class="text-center align-middle">{{$dosiNovcontsedep->dosi_control_dedo}}</td>
                        <td class="text-center align-middle">{{$dosiNovcontsedep->dosi_torax + $dosiNovcontsedep->dosi_cristalino + $dosiNovcontsedep->dosi_dedo + $dosiNovcontsedep->dosi_area + $dosiNovcontsedep->dosi_caso + $dosiNovcontsedep->dosi_control_torax + $dosiNovcontsedep->dosi_control_cristalino + $dosiNovcontsedep->dosi_control_dedo}}</td>
                        
                        {{-- <td class="text-center align-middle">
                            <div class="row">
                                <div class="col">
                                    <form class="eliminar_contdosisedepto" id="eliminar_contdosisedepto" name="eliminar_contdosisedepto" action=" {{route('contratosdosisededepto.destroy', ['detcont'=>$dosicontsedep->id_contratodosimetria, 'contratodosisede'=>$dosicontsedep->contratodosimetriasede_id, 'contratodosisededepto'=>$dosicontsedep->id_contdosisededepto])}}" method="POST">
                                        @csrf  
                                        @method('delete')
                                        <button class="btn btn-danger" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td> --}}
                    </tr>
                @endif
            @endforeach
        @endforeach
        
        </table>
    </div>
    <div class="col-md"></div>
</div>



<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous">
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('crear')== 'ok')
    <script>
        Swal.fire(
        'GUARDADO!',
        'SE HA CREADO CON ÉXITO.',
        'success'
        )
    </script>
@endif
@if(session('eliminar')== 'ok')
    <script>
        Swal.fire(
        'ELIMINADO!',
        'SE HA ELIMINADO CON ÉXITO.',
        'success'
        )
    </script>
@endif

<script type="text/javascript">
    
    $(document).ready(function(){

        var TDcontrato = document.getElementById("id_contrato");
        var num = parseInt('{{$dosimetriacontrato->codigo_contrato}}');
        var n = num.toString().padStart(5,'0');
        console.log("ESTE ES EL CODIGO" +n);
           
        TDcontrato.innerHTML = "CONTRATO No. "+n;

        @foreach($dosimeNovcontrasedeptos as $dosiNovcontsedep)
            var TDsubEsp = document.getElementById("{{$dosiNovcontsedep->id_novcontdosisededepto}}");
            var num = parseInt('{{$dosiNovcontsedep->id_novcontdosisededepto}}');
            var n = num.toString().padStart(5,'0');
            console.log("ESTE ES EL CODIGO" +n);
            var esp = "{{$dosiNovcontsedep->nombre_departamento}}".substring(0, 4);
            if("{{$dosiNovcontsedep->estado_nov}}" == 'ACTIVO'){
                TDsubEsp.innerHTML = "<a class='btn btn-outline-primary rounded-pill' href='{{route('detallesedecontsubEsp.create', "$dosiNovcontsedep->id_novcontdosisededepto")}}'>NOV-"+esp+"-"+n+"</a>";
            }else{
                TDsubEsp.innerHTML = "<a class='btn btn-outline-secondary rounded-pill' href='{{route('detallesedecontsubEsp.create', "$dosiNovcontsedep->id_novcontdosisededepto")}}'>NOV-"+esp+"-"+n+"</a>";
            }
            
        @endforeach
        
        $('.eliminar_contdosisedepto').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "SEGURO QUE DESEA ELIMINAR ESTA SEDE Y DEPARTAMENTO ASOCIADOS A ESTE CONTRATO DE DOSIMETRÍA??",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1A9980',
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