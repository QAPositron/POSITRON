@extends('layouts.plantillabase')
@section('contenido')

    <h3 class="text-center ">{{$dosisededeptocontra->contratodosimetriasede->sede->empresa->nombre_empresa}} - SEDE: {{$dosisededeptocontra->contratodosimetriasede->sede->nombre_sede}}</h3>
    <br>
    <h4 class="text-center ">CONTRATO No. {{$dosisededeptocontra->contratodosimetriasede->dosimetriacontrato->codigo_contrato}}</h4>


    <br>
    <h6 class="text-center ">TOTAL DE DOSÍMETROS:       CUERPO E.: # {{$dosisededeptocontra->dosi_cuerpo_entero}}        CONTROL: # {{$dosisededeptocontra->dosi_control}}        AMBIENTAL: # {{$dosisededeptocontra->dosi_ambiental}}       EZCLIP: # {{$dosisededeptocontra->dosi_ezclip}} </h6>
    

    <div class="row">
        <div class="col"></div>
        <div class="col-8">
            <div class="table table-responsive p-4">
                <table class="table table-bordered ">
                    <thead class="table-active">
                        <tr >
                            <th colspan="4" class=" text-center">DEPARTAMENTO: {{$dosisededeptocontra->departamentosede->nombre_departamento}}</th>
                        </tr>
                        <tr>
                            <th style='width: 20.90%' >MESES</th>
                            <th class=" text-center"style='width: 18.90%' >TRABAJADORES ASIGNADOS</th>
                            <th class=" text-center"style='width: 18.90%' >DOSÍMETROS DISPONIBLES</th>
                            <th class=" text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>

                        @for($i=0; $i< 12; $i++)


                            <tr>

                                <th>
                                    <a class="link-dark" href="{{route('asignadosicontrato.info', [ 'asigdosicont' => $dosisededeptocontra->id_contdosisededepto , 'mesnumber' => $i+1 ])}}">MES {{$i+1}} </a><br>
                                    @if($i==0)
                                        <span>{{date("d-m-Y",strtotime($dosisededeptocontra->contratodosimetriasede->dosimetriacontrato->fecha_inicio))}}</span>
                                        @else
                                            <span>{{date("d-m-Y",strtotime($dosisededeptocontra->contratodosimetriasede->dosimetriacontrato->fecha_inicio."+ ".(30*$i)." days" ))}}</span>
                                    @endif
                                </th>
                                <td>
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
                                <td>
                                    @php
                                        $lenghtData = 0;
                                        $suma = $dosisededeptocontra->dosi_cuerpo_entero + $dosisededeptocontra->dosi_control + $dosisededeptocontra->dosi_ambiental + $dosisededeptocontra->dosi_ezclip;
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
                                <td>
                                    <div class="row">
                                        <div class="col-md text-center">
                                            @if($mesTotal[$i]>0)
                                            <a onclick="return false" style="background-color: #a0aec0" class="btn btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z"/>
                                                </svg> ASIGNAR
                                            </a>
                                            @else
                                                <a href="{{route('asignadosicontrato.create', [ 'asigdosicont' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1 ] )}}" class="btn colorQA btn-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z"/>
                                                    </svg> ASIGNAR
                                                </a>
                                            @endif
                                        </div>
                                        <div class="col-md text-center">
                                            <a href="{{route('repodosimetria.pdf', $dosisededeptocontra->id_contdosisededepto)}}" class="btn colorQA btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-file-earmark-check" viewBox="0 0 16 16">
                                                <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                                                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                                </svg> INFORMES
                                            </a>
                                        </div>
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
    @endsection
