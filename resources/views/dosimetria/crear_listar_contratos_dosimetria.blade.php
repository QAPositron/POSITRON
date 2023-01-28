@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')

<div class="row">
    <div class="col-md">
        <a type="button" class="btn btn-circle colorQA" href="{{route('empresasdosi.create')}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left mt-1" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
        </a>
    </div> 
    <div class="col-md-5">
        <h2 class="text-center "> CONTRATOS DE DOSIMETRÍA PARA <br> <i>{{$empresa->nombre_empresa}}</i> </h2> 
    </div>
    <div class="col-md"></div>
</div>
<div class="row">
    <div class="col"></div>
    <div class="col"></div>
    <div class="col"></div>
    <div class="col">
        <a href="{{route('contratosdosi.create', $empresa->id_empresa)}}" class="btn colorQA ">CREAR CONTRATO</a>
        

    </div>
</div>
<br>
<div class="row">
    <div class="col"></div>
    <div class="col-7">
        {{-- <h3 class="text-center">LISTADO DE CONTRATOS</h3> --}}
        <div class="table table-responsive p-4 ">
            <table class="table table-bordered contratosdosi">
                <thead class ="table-active text-center">
                    <tr>
                        <th>No. CONTRATO</th>
                        <th style='width: 15.60%'>FECHA INICIO</th>
                        <th style='width: 15.60%'>FECHA FINALIZACIÓN</th>
                        <th style='width: 20.60%'>P. RECAMBIO</th>
                        <th style='width: 45.60%'>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dosimetriacontrato as $dosicont)
                        <tr>
                            <td class="align-middle" id='{{$dosicont->id_contratodosimetria}}'></td>
                            <td class="align-middle">{{$dosicont->fecha_inicio}}</td>
                            <td class="align-middle">{{$dosicont->fecha_finalizacion}}</td>
                            <td class="align-middle text-center">{{$dosicont->periodo_recambio}}</td>
                            <td class="text-center">
                                <div class="row">
                                    <div class="col">
                                        <a href="{{-- {{route('contratosdosi.edit', ['empresadosi' => $empresa->id_empresa, 'contratodosi' => $dosicont->id_contratodosimetria])}} --}}" class="btn colorQA">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pencil-fill mb-1" viewBox="0 0 16 16">
                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <form class="eliminar_contratodosi" id="eliminar_contratodosi" name="eliminar_contratodosi" action="{{-- {{route('contratosdosi.destroy',  ['empresadosi' => $empresa->id_empresa, 'contratodosi' => $dosicont->id_contratodosimetria])}} --}}" method="POST">
                                            @csrf  
                                            @method('delete')
                                            <button class="btn btn-danger" type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash mb-1" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col">
                                        <a href="{{route('contratodosimetria.pdf', $dosicont->codigo_contrato)}}" class="btn colorQA" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-text mb-1" viewBox="0 0 16 16">
                                                <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z"/>
                                                <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
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
@if(session('actualizar')== 'ok')
    <script>
        Swal.fire(
        'ACTUALIZADO!',
        'SE HA ACTUALIZADO CON ÉXITO.',
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
    function fechafinalcontrato(){
        var fecha_inicio = new Date(document.getElementById('fecha_inicio_contrato_input').value);
        alert(fecha_inicio);
        var fecha_final_año = fecha_inicio.getFullYear()+1;
        var mm = fecha_inicio.getMonth()+1;
        var fecha_final_mes = (mm < 10 ? '0' : '')+mm;
        var dd = fecha_inicio.getDate();
        var fecha_final_dia = (dd < 10 ? '0' : '')+dd;
        var fecha_final = fecha_final_año+'-'+fecha_final_mes+'-'+fecha_final_dia;
        console.log(fecha_final);
        document.getElementById("fecha_finalizacion_contrato_input").value = fecha_final;
    };
    $(document).ready(function(){
        @foreach($dosimetriacontrato as $dosicont)
            var TDcontrato = document.getElementById("{{$dosicont->id_contratodosimetria}}");
            var num = parseInt('{{$dosicont->codigo_contrato}}');
            var n = num.toString().padStart(5,'0');
            console.log("ESTE ES EL CODIGO" +n);
           
            TDcontrato.innerHTML = "<a class='btn btn-outline-primary rounded-pill' href='{{route('detallecontrato.create', "+$dosicont->id_contratodosimetria+")}}'>"+n+"</a>";
            
        @endforeach

        $('.eliminar_contratodosi').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "SEGURO QUE DESEA ELIMINAR ESTE CONTRATO DE DOSIMETRÍA??",
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
        
        $('.contratosdosi').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "NO HAY REGISTROS",
                "info": "MOSTRANDO REGISTROS DEL  _START_ AL _END_ DE UN TOTAL DE  _TOTAL_ REGISTROS",
                "infoEmpty": "MOSTRANDO 0 DE 0 REGISTROS",
                "infoFiltered": "(FILTRADO DE UN TOTAL DE _MAX_ REGISTROS)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "MOSTRAR _MENU_ REGISTROS",
                "loadingRecords": "CARGANDO...",
                "processing": "PROCESANDO...",
                "search": "BUSCAR:",
                "zeroRecords": "NO SE ENCONTRARON RESULTADOS",
                "paginate": {
                    "first": "PRIMERO",
                    "last": "ÚLTIMO",
                    "next": "SIGUIENTE",
                    "previous": "ANTERIOR"
                }   
            },
        });
    
    })
   

</script>



@endsection
