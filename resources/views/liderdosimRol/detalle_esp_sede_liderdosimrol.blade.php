@extends('layouts.appLiderdosim')
@section('contenido')

<h1 class="text-left text-primary-emphasis">PERÍODOS</h1>
<br>
<ul>
    
    @for($i=1; $i<=$contdosisededepto->contratodosimetriasede->dosimetriacontrato->numlecturas_año; $i++)
        @if($i == 1 && $contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'MENS')
            <li class="text-primary-emphasis">
                <a href="{{route('repodosimetria.pdf', ['deptodosi' => $contdosisededepto->id_contdosisededepto, 'mesnumber' => $i, 'item' => 0] )}}" target="_blank" class="link-opacity-75-hover" data-toggle="tooltip" data-placement="top" title="Abre una pagina con el informe de Dosimetría correspondiente a ese período">
                    @php
                        $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                        $inicio = date($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio);
                        $fin_parcial = date("t-m-Y",strtotime($inicio));
                        echo date("j", strtotime($inicio))." ".$meses[date("m", strtotime($inicio))]." DE ".date("Y", strtotime($inicio)). " - ".date("t", strtotime($fin_parcial))." ".$meses[date("m", strtotime($fin_parcial))]." DE ".date("Y", strtotime($fin_parcial));
                    @endphp
                </a>
            </li>
        @elseif($i == 1 && $contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'TRIMS')
            <li class="text-primary-emphasis" >
                <a href="{{route('repodosimetria.pdf', ['deptodosi' => $contdosisededepto->id_contdosisededepto, 'mesnumber' => $i, 'item' => 0] )}}" target="_blank" class="link-opacity-75-hover" data-toggle="tooltip" data-placement="top" title="Abre una pagina con el informe de Dosimetría correspondiente a ese período">
                    @php
                        $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                        $inicio = date($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio);
                        $fin_parcial1 = date("t-m-Y",strtotime($inicio));
                        $fecha_parcial2= date("t-m-Y",strtotime($fin_parcial1."+ 2 month"));
                        echo date("j", strtotime($inicio))." ".$meses[date("m", strtotime($inicio))]." DE ".date("Y", strtotime($inicio)). " - ".date("j", strtotime($fecha_parcial2))." ".$meses[date("m", strtotime($fecha_parcial2))]." DE ".date("Y", strtotime($fecha_parcial2));
                    @endphp
                </a>
            </li>
        @elseif($i == 1 && $contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'BIMS')
            <li class="text-primary-emphasis" id="liperiodos">
                <a href="{{route('repodosimetria.pdf', ['deptodosi' => $contdosisededepto->id_contdosisededepto, 'mesnumber' => $i, 'item' => 0] )}}" target="_blank" class="link-opacity-75-hover" data-toggle="tooltip" data-placement="bottom" title="Abre una pagina con el informe de Dosimetría correspondiente a ese período">
                    @php
                        $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                        $inicio = date($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio);
                        $fecha_parcial = date("t-m-Y",strtotime($inicio."+ 1 month"));
                        echo date("j", strtotime($inicio))." ".$meses[date("m", strtotime($inicio))]." DE ".date("Y", strtotime($inicio)). " - ".date("j", strtotime($fecha_parcial))." ".$meses[date("m", strtotime($fecha_parcial))]." DE ".date("Y", strtotime($fecha_parcial));
                    @endphp
                </a>
            </li>
        @else
            <li class="text-primary-emphasis" id="liperiodos">
                <a href="{{route('repodosimetria.pdf', ['deptodosi' => $contdosisededepto->id_contdosisededepto, 'mesnumber' => $i, 'item' => 0] )}}" target="_blank" class="link-opacity-75-hover" data-toggle="tooltip" data-placement="bottom" title="Abre una pagina con el informe de Dosimetría correspondiente a ese periodo" id="mes{{$i}}">
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
        document.getElementById('nombre').innerHTML = '{{$contdosisededepto->contratodosimetriasede->sede->empresa->razon_social_empresa}}';
        document.getElementById('empresacheck').innerHTML = "<label id='empresaselet'>"+'{{$contdosisededepto->contratodosimetriasede->sede->empresa->razon_social_empresa}}'+"</label>";
        var num = parseInt('{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->codigo_contrato}}');
        var fini = new Date('{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio}}');
        fini.setMinutes(fini.getMinutes() + fini.getTimezoneOffset());
        console.log(fini);
        var inicio = fini.getDate()+' '+meses[fini.getMonth()] + ' DE ' + fini.getUTCFullYear();
        console.log("****FECHA INICIO***");
        console.log(inicio);
        var ffin = new Date('{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_finalizacion}}');
        ffin.setMinutes(ffin.getMinutes() + ffin.getTimezoneOffset());
        var fin = ffin.getDate()+' '+meses[ffin.getMonth()] + ' DE ' + ffin.getUTCFullYear();
        console.log("****FECHA FINALIZACION***");
        console.log(fin);
        document.getElementById('contratocheck').innerHTML = "<label id='contratoselet'>"+inicio+"<br> AL "+fin+"</label>";
        document.getElementById('sedescheck').innerHTML = "<label id='sedeselet'>"+'{{$contdosisededepto->contratodosimetriasede->sede->nombre_sede}}'+"</label>";
        document.getElementById('espcheck').innerHTML = "<label id='sedeselet'>"+'{{$contdosisededepto->departamentosede->departamento->nombre_departamento}}'+"</label>";

        ////////para crear las fechas de los periodos///
        let fecha = new Date("{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio}}, 00:00:00");
        console.log(fecha);
        var numLec = '{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->numlecturas_año}}';
        if('{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio}}' == 'MENS'){
            var xx = 1; 
            for(var i=0; i<=(numLec-2); i++){
                var ultimoDiaPM = new Date(fecha.getFullYear(), fecha.getMonth() + 1, 1);
                console.log("ULTIMO DIA PRIMER MES:"+ ultimoDiaPM);
                /* console.log("esta es la i="+i); */
                var r = new Date(new Date(ultimoDiaPM).setMonth(ultimoDiaPM.getMonth()+i));
                /* console.log("r1" +r); */
                var r2 = new Date(new Date(r).setMonth(r.getMonth()+1));
                var fechaesp = meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                var r2final = new Date(new Date(r2).setDate(r.getDate()-1));
                /* console.log("r2 " +r2final); */
                var fechaesp1 = r.getDate()+' '+meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                /* console.log(fechaesp1); */
                var fechaesp2 = (r2final.getDate()) +' '+ meses[r2final.getMonth()] + ' DE ' + r2final.getUTCFullYear(); 
                /* console.log(fechaesp2); */
                xx++;
                console.log("XX"+xx);
                document.getElementById('mes'+xx).innerHTML = fechaesp1+' - '+fechaesp2;
            }
        }else if('{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio}}' == 'TRIMS'){
            var xx = 1;
            for(var i=0; i<=(numLec+1); i= i+3){
                var ultimoDiaPM = new Date(fecha.getFullYear(), fecha.getMonth() + 3, 1);
                console.log("ULTIMO DIA PRIMER MES:"+ ultimoDiaPM);
                console.log("ESTA ES LA I = "+i);
                var r = new Date(new Date(ultimoDiaPM).setMonth(ultimoDiaPM.getMonth()+i));
                console.log("r1" +r);
                var r2 = new Date(new Date(r).setMonth(r.getMonth()+3));
                var r2final = new Date(new Date(r2).setDate(r.getDate()-1));
                console.log("r2 " +r2final);
                var fechaesp1 = r.getDate()+' '+meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                console.log(fechaesp1);

                var fechaesp2 = (r2final.getDate()) +' '+ meses[r2final.getMonth()] + ' DE ' + r2final.getUTCFullYear(); 
                console.log(fechaesp2);
                xx++;
                console.log("XX"+xx);
                document.getElementById('mes'+xx).innerHTML = fechaesp1+' - '+fechaesp2;
                
            }
        }else if('{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio}}' == 'BIMS'){
            var xx = 1;
            for(var i=1; i<=(numLec+1); i= i+2){
                var ultimoDiaPM = new Date(fecha.getFullYear(), fecha.getMonth() + 2, 1);
                console.log("ULTIMO DIA PRIMER MES:"+ ultimoDiaPM);
                console.log("ESTA ES LA I = "+i);
                var r = new Date(new Date(ultimoDiaPM).setMonth(ultimoDiaPM.getMonth()+i));
                console.log("r1" +r);
                var r2 = new Date(new Date(r).setMonth(r.getMonth()+2));
                var r2final = new Date(new Date(r2).setDate(r.getDate()-1));
                console.log("r2 " +r2final);
                var fechaesp1 = r.getDate()+' '+meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                console.log(fechaesp1);

                var fechaesp2 = (r2final.getDate()) +' '+ meses[r2final.getMonth()] + ' DE ' + r2final.getUTCFullYear(); 
                console.log(fechaesp2);
                xx++;
                console.log("XX"+xx);
                
                document.getElementById('mes'+xx).innerHTML = fechaesp1+' - '+fechaesp2;
                
            }
        }
        
    })
</script>
@endsection