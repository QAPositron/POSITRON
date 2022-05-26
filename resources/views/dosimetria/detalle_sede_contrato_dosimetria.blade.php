@extends('layouts.plantillabase')
@section('contenido')


    <div class="row">
        <div class="col-md">
            <a type="button" class="btn btn-circle colorQA" href="{{route('detallecontrato.create', $dosisededeptocontra->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left mt-1" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
            </a>
        </div>
        <div class="col-md">
            <h2 class="text-center">DOSIMETRÍA DE <br>  <i>{{$dosisededeptocontra->contratodosimetriasede->sede->empresa->nombre_empresa}} - SEDE: {{$dosisededeptocontra->contratodosimetriasede->sede->nombre_sede}}</i> </h2>
        </div>
        <div class="col-md"></div>
    </div>
    <br>
    <h4 class="text-center align-middle">CONTRATO No. {{$dosisededeptocontra->contratodosimetriasede->dosimetriacontrato->codigo_contrato}}</h4>

    <br>
    <h6 class="text-center"> <b>TOTAL DE DOSÍMETROS:</b> CONTROL: # {{$dosisededeptocontra->dosi_control}} -- TÓRAX: # {{$dosisededeptocontra->dosi_torax}}   --  ÁREA: # {{$dosisededeptocontra->dosi_area}}   --  CASO: # {{$dosisededeptocontra->dosi_caso}} -- CRISTALINO: # {{$dosisededeptocontra->dosi_cristalino}} --  MUÑECA: # {{$dosisededeptocontra->dosi_muñeca}} -- DEDO: # {{$dosisededeptocontra->dosi_dedo}}</h6>

    <div class="row">
        <div class="col"></div>
        <div class="col-8">
            <div class="table table-responsive p-4">
                <table class="table table-bordered ">
                    <thead class="table-active">
                        <tr >
                            <th colspan="4" class=" text-center">ESPECIALIDAD: {{$dosisededeptocontra->departamentosede->nombre_departamento}}</th>
                        </tr>
                        <tr>
                            <th class="text-center align-middle" style='width: 20.90%' >MESES</th>
                            <th class="text-center align-middle" style='width: 18.90%' >TRABAJADORES ASIGNADOS</th>
                            <th class="text-center align-middle" style='width: 18.90%' >DOSÍMETROS DISPONIBLES</th>
                            <th class="text-center align-middle">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>

                        @for($i=0; $i< 12; $i++)
                            <tr>
                                <th class="align-middle">
                                    <a class="link-dark" href="{{route('asignadosicontrato.info', [ 'asigdosicont' => $dosisededeptocontra->id_contdosisededepto , 'mesnumber' => $i+1 ])}}">MES {{$i+1}} </a><br>
                                    @if($i==0)
                                        <span>{{date("d-m-Y",strtotime($dosisededeptocontra->contratodosimetriasede->dosimetriacontrato->fecha_inicio))}}</span>
                                    @else
                                        <span>{{date("d-m-Y",strtotime($dosisededeptocontra->contratodosimetriasede->dosimetriacontrato->fecha_inicio."+ ".(30*$i)." days" ))}}</span>
                                    @endif
                                </th>
                                <td class="text-center align-middle">
                                    @php
                                        $lenghtData = 0;
                                        foreach($trabjasigcontra as $trab){
                                            if ($trab->mes_asignacion == ($i+1)) {
                                            $lenghtData += 1 ;
                                           }
                                        }
                                        echo "$lenghtData";
                                    @endphp
                                </td>
                                <td class="text-center align-middle">
                                    @php
                                        $lenghtData = 0;
                                        $suma = $dosisededeptocontra->dosi_torax + $dosisededeptocontra->dosi_control + $dosisededeptocontra->dosi_area + $dosisededeptocontra->dosi_caso + $dosisededeptocontra->dosi_cristalino + $dosisededeptocontra->dosi_muñeca + $dosisededeptocontra->dosi_dedo;
                                        foreach($trabjasigcontra as $trab){
                                            //esto esta bien PERO, recuerda que los dosimetros de control falta sumarlos, esos no se asignan al trabajador sino a la sede
                                            if ($trab->mes_asignacion == ($i+1)) {
                                            $lenghtData += 1 ;
                                            }
                                        }
                                        $resul = $suma - $lenghtData;
                                        echo "$resul";
                                    @endphp
                                </td>
                                <td class="align-middle">
                                    <div class="row">
                                        @if($mesTotal[$i]>0)
                                            @if(  $i == '0' )
                                                <div class="col-md text-center">

                                                    <a onclick="return false"  style="background-color: #a0aec0" href="{{route('asignadosicontratom1.create', ['asigdosicont' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1 ])}}" class="btn  btn-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z"/>
                                                        </svg> ASIGNAR M1
                                                    </a>
                                                </div> 
                                                <div class="col-md text-center">
                                                    <a class="btn colorQA btn-sm boton-alert" href="{{route('repodosimetria.pdf', ['deptodosi' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1] )}}" target="_blank">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-file-earmark-check" viewBox="0 0 16 16">
                                                            <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                                                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                                        </svg> INFORMES
                                                    </a>
                                                </div> 
                                            @else
                                                <div class="col-md text-center">
                                                    <a onclick="return false" style="background-color: #a0aec0"  href="{{route('asignadosicontratomn.create', ['asigdosicont' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1 ])}}" class="btn btn-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z"/>
                                                        </svg> ASIGNAR MN
                                                    </a>
                                                </div>
                                                <div class="col-md text-center">
                                                    <a class="btn colorQA btn-sm boton-alert" {{-- onclick="return false"  style="background-color: #a0aec0"--}} href="{{route('repodosimetria.pdf', ['deptodosi' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1] )}}" target="_blank">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-file-earmark-check" viewBox="0 0 16 16">
                                                            <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                                                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                                        </svg> INFORMES
                                                    </a>
                                                </div>
                                            @endif
                                        @else
                                            @if(  $i == '0' )
                                                <div class="col-md text-center">
                                                    <a  href="{{route('asignadosicontratom1.create', ['asigdosicont' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1 ])}}" class="btn btn-danger btn-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z"/>
                                                        </svg> ASIGNAR M1
                                                    </a>
                                                </div> 
                                                <div class="col-md text-center">
                                                    <a class="btn btn-sm boton-alert" onclick="return false"  style="background-color: #a0aec0" href="{{route('repodosimetria.pdf', ['deptodosi' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1] )}}" target="_blank">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-file-earmark-check" viewBox="0 0 16 16">
                                                            <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                                                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                                        </svg> INFORMES
                                                    </a>
                                                </div> 
                                            @else
                                                <div class="col-md text-center">
                                                    <a  href="{{route('asignadosicontratomn.create', ['asigdosicont' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1 ])}}" class="btn btn-warning btn-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z"/>
                                                        </svg> ASIGNAR MN
                                                    </a>
                                                </div>
                                                <div class="col-md text-center">
                                                    <a class="btn btn-sm boton-alert"  onclick="return false"  style="background-color: #a0aec0" href="{{route('repodosimetria.pdf', ['deptodosi' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1] )}}" target="_blank">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-file-earmark-check" viewBox="0 0 16 16">
                                                            <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                                                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                                        </svg> INFORMES
                                                    </a>
                                                </div>
                                            @endif
                                        @endif
                                        
                                    </div>
                                </td>
                            </tr>
                        @endfor


                    </tbody>
                </table>
            </div>
        </div>
        <div class="col"></div>
    </div>
<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous">
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('fallo')=='ok')
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'REVISE SI TIENE EL CONTACTO DE DOSIMETRÍA !!!',
        })
    </script>
@endif



@endsection
