@extends('layouts.appLiderdosim')
@section('contenido')
<h1 class="text-left text-primary-emphasis">LISTADO DE TRABAJADORES</h1>
<br>
<h4>Seleccione del listado el trabajador para obtener el informe de dosimetría particular según el periodo que seleccione:</h4>
<br>
<div class="row">
    <div class="col-md"></div>
    <div class="col-md">
        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" onchange="periodosTrabajador();" id="personSelect">
            <option selected>SELECCIONE</option>
            @foreach ($trabajadoresUnic as $trabajador)
                <option value="{{$trabajador->id_persona}}">{{$trabajador->primer_nombre_persona}} {{$trabajador->segundo_nombre_persona}} {{$trabajador->primer_apellido_persona}} {{$trabajador->segundo_apellido_persona}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md"></div>
</div>
<br>
<ul id="listaperiodos">

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
        $("#empresacheck").append("<label id='empresaselet'>"+'{{$contratodosimetria->empresa->razon_social_empresa}}'+"</label>");
        const meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
        var fini = new Date('{{$contratodosimetria->fecha_inicio}}');
        fini.setMinutes(fini.getMinutes() + fini.getTimezoneOffset());
        console.log(fini);
        var inicio = fini.getDate()+' '+meses[fini.getMonth()] + ' DE ' + fini.getUTCFullYear();
        console.log("****FECHA INICIO***");
        console.log(inicio);
        var ffin = new Date('{{$contratodosimetria->fecha_finalizacion}}');
        ffin.setMinutes(ffin.getMinutes() + ffin.getTimezoneOffset());
        var fin = ffin.getDate()+' '+meses[ffin.getMonth()] + ' DE ' + ffin.getUTCFullYear();
        console.log("****FECHA FINALIZACION***");
        console.log(fin);
        $("#contratocheck").append("<label id='contratoselet'>"+inicio+"<br> AL "+fin+"</label>");
        $.get('detalletrabajador/sedes', {contrato: '{{$contratodosimetria->id_contratodosimetria}}'}, function(sedecontdosi){
            console.log("contratodosimetriasede");
            console.log(sedecontdosi);
            $("#sedes").append("<ul class='dropdown-menu' id='lisedes'></ul>");
            $('#lisedes').empty();
            $.each(sedecontdosi, function(index, value){
                $('#lisedes').append("<li><a class='dropdown-item' id='"+ index + "' onclick='listadoEspecialidades("+index+",\""+value+"\");'>" + value + "</a></li>");
            })
        });
        
       
    })
    function listadoEspecialidades(id, sedecontdosi){
        console.log(sedecontdosi);
        $("#butttonsedes").prop('disabled', true);
        $("#sedescheck").append("<label id='sedeselet'>"+sedecontdosi+"</label>");
        $.get('detalletrabajador/especialidades', {sedecontdosi: id}, function(especialidades){
            console.log("especialidades");
            console.log(especialidades);
            $("#especialidades").append("<ul class='dropdown-menu' id='liespecialidades'></ul>");
            $('#liespecialidades').empty();
            $.each(especialidades, function(index, value){
                $('#liespecialidades').append("<li><a class='dropdown-item' id='"+ index + "' onclick='optionEsp("+index+",\""+value+"\","+0+", "+0+");'>" + value + "</a></li>");
                $.get('detalletrabajador/especialidadesnovedad', {espnov: index}, function(especialidadesnovedad){
                    console.log("especialidades novedad");
                    console.log(especialidadesnovedad);
                    $.each(especialidadesnovedad, function(inde, valor){
                        $('#liespecialidades').append("<li><a class='dropdown-item' id='"+ valor.id_novcontdosisededepto + "' onclick='optionEsp("+valor.id_novcontdosisededepto+",\""+value+"\","+1+","+valor.mes_asignacion+");'>NOVEDAD-"+value+"-P"+valor.mes_asignacion+"</a></li>");
                    })
                })
            }) 
        });
    }
    function optionEsp(id, especialidad, item, mes){
        console.log("especialidad="+especialidad);
        console.log("idcontdosisededeptoonov="+id);
        console.log("item="+item);
        console.log("mes="+mes)
        $("#butttonespecialidades").prop('disabled', true);
        if(item == 0){
            $("#espcheck").append("<label id='sedeselet'>"+especialidad+"</label>");
        }else{
            $("#espcheck").append("<label id='sedeselet'>NOVEDAD-"+especialidad+"-P"+mes+"</label>");
        }
        
        var host = window.location.host;
        var array = JSON.parse('{!!$personasede!!}');
        console.log(array);
        console.log("persona");
        console.log(array[0].id_persona);
        if(item == 0){
            var path = "http://"+host+"/POSITRON/public/dosimetria/"+array[0].id_persona+"/"+id+"/detalledepto";
        }else{
            var path = "http://"+host+"/POSITRON/public/dosimetria/"+array[0].id_persona+"/"+id+"/detallesubesp";
        }
        window.open(path, '_self');
    }
    function periodosTrabajador(){
        var persona = document.getElementById("personSelect").value;
        var idpersona = parseInt(persona);
        console.log("trabajadores");
        var arrayTrabaj = JSON.parse('{!!$trabajadores!!}');
        console.log(arrayTrabaj);
        var periodos = arrayTrabaj.filter(person => person.id_persona == persona);
        console.log(periodos)
        var numLec = '{{$contratodosimetria->numlecturas_año}}';
        const meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
        $.each(periodos, function(index, value){
            var fini = new Date(value.primer_dia_uso);
            fini.setMinutes(fini.getMinutes() + fini.getTimezoneOffset());
            console.log(fini);
            var inicio = fini.getDate()+' '+meses[fini.getMonth()] + ' DE ' + fini.getUTCFullYear();
            console.log("****FECHA INICIO***");
            console.log(inicio);
            var ffin = new Date(value.ultimo_dia_uso);
            ffin.setMinutes(ffin.getMinutes() + ffin.getTimezoneOffset());
            var fin = ffin.getDate()+' '+meses[ffin.getMonth()] + ' DE ' + ffin.getUTCFullYear();
            console.log("****FECHA FINALIZACION***");
            console.log(fin);
            console.log(value.Hp10_dif_dosicont);
            console.log(value.Hp3_dif_dosicont);
            var contrato =  JSON.parse('{!!$contratodosimetria!!}');
            console.log("fecha inicio periodo");
            console.log(value.primer_dia_uso);
            if(value.Hp10_dif_dosicont == null && value.Hp3_dif_dosicont == null){
                console.log("son null");
                $("#listaperiodos").append("<li class='text-secondary'><a disabled class='text-body-tertiary link-opacity-50-hover');'>"+inicio+" - "+fin+"</a></li>");
            }else{
                console.log("no son null");
                $("#listaperiodos").append("<li class='text-primary-emphasis'><a href='' class='link-opacity-50-hover' onclick='reporteDosimetria("+idpersona+",\""+value.primer_dia_uso+"\","+contrato.id_contratodosimetria+");'>"+inicio+" - "+fin+"</a></li>");
            }

        }) 
    }
    function reporteDosimetria(id, finiperiodo, contrato){
        var host = window.location.host;
        var path = "http://"+host+"/POSITRON/public/repodosimetriaParticular/"+id+"/"+finiperiodo+"/"+contrato+"/pdf";
        window.open(path, '_blank');
    }
    
    
</script>
@endsection