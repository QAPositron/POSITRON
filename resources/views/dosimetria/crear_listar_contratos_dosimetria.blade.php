@extends('layouts.plantillabase')
@section('contenido')


<h2 class="text-center "> DOSIMETRÍA DE <i>{{$empresa->nombre_empresa}}</i> </h2>
<div class="row">
    <div class="col"></div>
    <div class="col"></div>
    <div class="col"></div>
    <div class="col">
        <a href="{{route('contratosdosi.create', $empresa->id_empresa)}}" class="btn colorQA ">CREAR CONTRATO</a>
        

    </div>
</div>
<BR></BR>
<div class="row">
    <div class="col"></div>
    <div class="col-9">
        <h3 class="text-center">LISTADO DE CONTRATOS</h3>
        <div class="table table-responsive p-4 ">
            <table class="table table-bordered">
                <thead class ="text-center">
                    <tr>
                        <th>No. CONTRATO</th>
                        <th style='width: 15.60%'>FECHA INICIO</th>
                        <th style='width: 15.60%'>FECHA FINALIZACIÓN</th>
                        <th style='width: 15.60%'>P. RECAMBIO</th>
                        <th style='width: 15.60%'>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dosimetriacontrato as $dosicont)
                        <tr>
                            <td><a class="link-dark" href="{{route('detallecontrato.create', $dosicont->id_contratodosimetria)}}">{{$dosicont->codigo_contrato}}</a></td>
                            <td>{{$dosicont->fecha_inicio}}</td>
                            <td>{{$dosicont->fecha_finalizacion}}</td>
                            <td>{{$dosicont->periodo_recambio}}</td>
                            <td  class="text-center">
                                <div class="row">
                                    <div class="col">
                                        <a href="{{route('contratosdosi.edit', ['empresadosi' => $empresa->id_empresa, 'contratodosi' => $dosicont->id_contratodosimetria])}}" class="btn colorQA">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <form class="eliminar_contratodosi" id="eliminar_contratodosi" name="eliminar_contratodosi" action="{{route('contratosdosi.destroy',  ['empresadosi' => $empresa->id_empresa, 'contratodosi' => $dosicont->id_contratodosimetria])}}" method="POST">
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
    })
   

</script>



@endsection
