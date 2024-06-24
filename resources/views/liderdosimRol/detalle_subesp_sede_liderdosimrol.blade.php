@extends('layouts.appLiderdosim')
@section('contenido')

<h1 class="text-left text-primary-emphasis">PERÍODOS</h1>
<br>
<ul>
    @for($i=1; $i<=$novcontdosisededepto->contratodosimetriasededepto->contratodosimetriasede->dosimetriacontrato->numlecturas_año; $i++)
        @if($i == $novcontdosisededepto->mes_asignacion && $novcontdosisededepto->contratodosimetriasededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'MENS')
            <li class="text-primary-emphasis">
                <a href="{{route('repodosimetria.pdf', ['deptodosi' => $novcontdosisededepto->id_novcontdosisededepto, 'mesnumber' => $novcontdosisededepto->mes_asignacion, 'item' => 1] )}}" target="_blank" class="link-opacity-75-hover" data-toggle="tooltip" data-placement="top" title="Abre una pagina con el informe de Dosimetría correspondiente a ese período">
                    @php
                        $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                        $inicio = date($novcontdosisededepto->contratodosimetriasededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio);
                        $fin_parcial = date("t-m-Y",strtotime($inicio));
                        echo date("j", strtotime($inicio))." ".$meses[date("m", strtotime($inicio))]." DE ".date("Y", strtotime($inicio)). " - ".date("t", strtotime($fin_parcial))." ".$meses[date("m", strtotime($fin_parcial))]." DE ".date("Y", strtotime($fin_parcial));
                    @endphp
                </a>
            </li>
        @elseif($i == $novcontdosisededepto->mes_asignacion && $novcontdosisededepto->contratodosimetriasededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'TRIMS')
            <li class="text-primary-emphasis">
                <a href="{{route('repodosimetria.pdf', ['deptodosi' => $novcontdosisededepto->id_novcontdosisededepto, 'mesnumber' => $novcontdosisededepto->mes_asignacion, 'item' => 1] )}}" target="_blank" class="link-opacity-75-hover" data-toggle="tooltip" data-placement="top" title="Abre una pagina con el informe de Dosimetría correspondiente a ese período">
                    @php
                        $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                        $inicio = date($novcontdosisededepto->contratodosimetriasededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio);
                        $fin_parcial1 = date("t-m-Y",strtotime($inicio));
                        $fecha_parcial2= date("t-m-Y",strtotime($fin_parcial1."+ 2 month"));
                        echo date("j", strtotime($inicio))." ".$meses[date("m", strtotime($inicio))]." DE ".date("Y", strtotime($inicio)). " - ".date("j", strtotime($fecha_parcial2))." ".$meses[date("m", strtotime($fecha_parcial2))]." DE ".date("Y", strtotime($fecha_parcial2));
                    @endphp
                </a>
            </li>
        @elseif($i == $novcontdosisededepto->mes_asignacion && $novcontdosisededepto->contratodosimetriasededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'BIMS')
            <li class="text-primary-emphasis" id="liperiodos">
                <a href="{{route('repodosimetria.pdf', ['deptodosi' => $novcontdosisededepto->id_novcontdosisededepto, 'mesnumber' => $novcontdosisededepto->mes_asignacion, 'item' => 1] )}}" target="_blank" class="link-opacity-75-hover" data-toggle="tooltip" data-placement="bottom" title="Abre una pagina con el informe de Dosimetría correspondiente a ese período">
                    @php
                        $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                        $inicio = date($novcontdosisededepto->contratodosimetriasededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio);
                        $fecha_parcial = date("t-m-Y",strtotime($inicio."+ 1 month"));
                        echo date("j", strtotime($inicio))." ".$meses[date("m", strtotime($inicio))]." DE ".date("Y", strtotime($inicio)). " - ".date("j", strtotime($fecha_parcial))." ".$meses[date("m", strtotime($fecha_parcial))]." DE ".date("Y", strtotime($fecha_parcial));
                    @endphp
                </a>
            </li>
        @endif
    @endfor
    
</ul>
<script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous">
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">

    $(document).ready(function(){
        ////para el tooltip bootstrap////
         $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        })
        const meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
        
        /////para incluir los items en la barra de navegacion anteriormente seleccionados////
        document.getElementById('nombre').innerHTML = '{{$novcontdosisededepto->contratodosimetriasededepto->contratodosimetriasede->sede->empresa->razon_social_empresa}}';
        document.getElementById('empresacheck').innerHTML = "<label id='empresaselet'>"+'{{$novcontdosisededepto->contratodosimetriasededepto->contratodosimetriasede->sede->empresa->razon_social_empresa}}'+"</label>";
        var num = parseInt('{{$novcontdosisededepto->contratodosimetriasededepto->contratodosimetriasede->dosimetriacontrato->codigo_contrato}}');
        var fini = new Date('{{$novcontdosisededepto->contratodosimetriasededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio}}');
        fini.setMinutes(fini.getMinutes() + fini.getTimezoneOffset());
        console.log(fini);
        var inicio = fini.getDate()+' '+meses[fini.getMonth()] + ' DE ' + fini.getUTCFullYear();
        console.log("****FECHA INICIO***");
        console.log(inicio);
        var ffin = new Date('{{$novcontdosisededepto->contratodosimetriasededepto->contratodosimetriasede->dosimetriacontrato->fecha_finalizacion}}');
        ffin.setMinutes(ffin.getMinutes() + ffin.getTimezoneOffset());
        var fin = ffin.getDate()+' '+meses[ffin.getMonth()] + ' DE ' + ffin.getUTCFullYear();
        console.log("****FECHA FINALIZACION***");
        console.log(fin);
        document.getElementById('contratocheck').innerHTML = "<label id='contratoselet'>"+inicio+"<br> AL "+fin+"</label>";
        document.getElementById('sedescheck').innerHTML = "<label id='sedeselet'>"+'{{$novcontdosisededepto->contratodosimetriasededepto->contratodosimetriasede->sede->nombre_sede}}'+"</label>";
        document.getElementById('espcheck').innerHTML = "<label id='sedeselet'>"+'{{$novcontdosisededepto->contratodosimetriasededepto->departamentosede->departamento->nombre_departamento}}'+"</label>";
        document.getElementById('espcheck').innerHTML = "<label id='sedeselet'>NOVEDAD-"+'{{$novcontdosisededepto->contratodosimetriasededepto->departamentosede->departamento->nombre_departamento}}'+"-"+'{{$novcontdosisededepto->mes_asignacion}}'+"</label>";
       
        
    })
</script>
@endsection