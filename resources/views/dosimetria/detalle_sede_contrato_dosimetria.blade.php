@extends('layouts.plantillabase')
@section('contenido')

        <h3 class="text-center ">{{$dosisedecontra->sede->empresa->nombre_empresa}} - SEDE: {{$dosisedecontra->sede->nombre_sede}}</h3>
        <br>
        <h4 class="text-center ">CONTRATO No. {{$dosisedecontra->dosimetriacontrato->codigo_contrato}}</h4>

    <br>
    <h6 class="text-center ">TOTAL DE DOSÍMETROS:       CUERPO E.:#        AMBIENTAL: #       EZCLIP:# </h6>

    <div class="row">
        <div class="col"></div>
        <div class="col-8">
            <div class="table table-responsive p-4">
                <table class="table table-bordered ">
                    <thead class="table-active">
                        <tr>
                            <th style='width: 18.90%' >MESES</th>
                            <th class=" text-center"style='width: 18.90%' >TRABAJADORES ASIGNADOS</th>
                            <th class=" text-center"style='width: 18.90%' >DOSÍMETROS DISPONIBLES</th>
                            <th class=" text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>

                        @for($i=0; $i<12; $i++)


                            <tr>
                                <th>MES {{$i+1}} <br>
                                @if($i==0)
                                    <span>{{date("d-m-Y",strtotime($dosisedecontra->dosimetriacontrato->fecha_inicio))}}</span>
                                    @else
                                        <span>{{date("d-m-Y",strtotime($dosisedecontra->dosimetriacontrato->fecha_inicio."+ ".(30*$i)." days" ))}}</span>
                                    @endif



                                </th>
                                <td>
                                    @php
                                        $lenghtData = 0;
                                        foreach($trabjasigcontra as $trab){
                                            $lenghtData += 1 ;
                                        }
                                        echo "$lenghtData";
                                    @endphp
                                </td>
                                <td>
                                    @php
                                        $lenghtData = 0;
                                        $suma = $dosisedecontra->dosi_cuerpo_entero + $dosisedecontra->dosi_control + $dosisedecontra->dosi_ambiental + $dosisedecontra->dosi_ezclip;
                                        foreach($trabjasigcontra as $trab){
                                            //esto esta bien PERO, recuerda que los dosimetros de control falta sumarlos, esos no se asignan al trabajador sino a la sede
                                            $lenghtData += 1 ;
                                        }
                                        $resul = $suma - $lenghtData;
                                        echo "$resul";
                                    @endphp
                                </td>
                                <td>

                                    <div class="row ">
                                        <div class="col-md">
                                            <a href="{{route('asignadosicontrato.create', $dosisedecontra->id_contratodosimetriasede)}}" class="btn colorQA btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z"/>
                                                </svg> ASIGNAR
                                            </a>
                                        </div>
                                        <div class="col-md">
                                            <a href="" class="btn colorQA btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                                </svg> LECTURA
                                            </a>
                                        </div>
                                        <div class="col-md">
                                            <a href="" class="btn colorQA btn-sm">
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
