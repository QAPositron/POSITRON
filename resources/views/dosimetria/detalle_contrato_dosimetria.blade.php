@extends('layouts.plantillabase')
@section('contenido')

<h3 class="text-center ">{{$dosimetriacontrato->empresa->nombre_empresa}}</h3>
<br>
<h4 class="text-center ">CONTRATO No. {{$dosimetriacontrato->codigo_contrato}}</h4>
<br>
{{-- <h6 class="text-center ">TOTAL DE DOSÍMETROS:       CUERPO E.:        AMBIENTAL: #       EZCLIP:# </h6> --}}

<div class="row">
    <div class="col"></div>
    <div class="col-6">
        <div class="table table-responsive p-4">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th colspan="4" class="table-active text-center">INFORMACIÓN DEL CONTRATO</th>
                    </tr>
                    <tr>
                        <th>FECHA DE INICIO:</th>
                        <td>{{$dosimetriacontrato->fecha_inicio}}</td>
                        <th>FECHA FINALIZACIÓN:</th>
                        <td>{{$dosimetriacontrato->fecha_finalizacion}}</td>
                    </tr>
                    <tr>
                        <th>DURACIÓN:</th>
                        <td>12 MESES</td>
                        <th>PERIODO DE RECAMBIO:</th>
                        <td>{{$dosimetriacontrato->periodo_recambio}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col"></div>
</div>
<div class="row">
    <div class="col-md"></div>
    <div class="col-md text-center">
        <a href="{{route('contratosdosi.edit', ['empresadosi' => $dosimetriacontrato->empresa->id_empresa, 'contratodosi' => $dosimetriacontrato->id_contratodosimetria])}}" class="btn colorQA">
            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-pen-fill mb-1" viewBox="0 0 16 16">
            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
            </svg> EDITAR
        </a>
    </div>
    <div class="col-md"></div>
</div>
<br>
<h4 class="text-center">SEDES SUBSCRITAS A ESTE CONTRATO</h4>
<br>
<div class="row">
    <div class="col"></div>
    <div class="col-8">
        @php
            $check = 'inicial';
        @endphp 
        
        @foreach($dosimecontrasedeptos as $dosicontsedep)
            @php
                if($dosicontsedep->nombre_sede != $check ){
                    echo "<table class='table  table-bordered'>";
                        echo "<h4 class='text-center'>{$dosicontsedep->nombre_sede}</h4>";  
                        $check = strval($dosicontsedep->nombre_sede);
                        echo "<thead class='table-active text-center'>";    
                            echo "<th>DEPARTAMENTOS</th>";
                            echo "<th>No. DOSÍM. C. ENTERO</th>";
                            echo "<th>No. DOSÍM. CONTROL</th>";    
                            echo "<th>No. DOSÍM. AMBIENTAL</th>";
                            echo "<th>No. DOSÍM. EZCLIP</th>";
                            echo "<th>ACCIONES</th>";
                        echo "</thead>";
                }
            @endphp
            <tr>
                <td class="text-center"> <a class="link-dark" href="{{route('detallesedecont.create', $dosicontsedep->id_contdosisededepto)}}">{{$dosicontsedep->nombre_departamento}}</a></td>
                <td class="text-center">{{$dosicontsedep->dosi_cuerpo_entero}}</td>
                <td class="text-center">{{$dosicontsedep->dosi_control}}</td>
                <td class="text-center">{{$dosicontsedep->dosi_ambiental}}</td>
                <td class="text-center">{{$dosicontsedep->dosi_ezclip}}</td>
                <td class="text-center">
                    <div class="row">
                        <div class="col">
                            <form class="eliminar_contdosisedepto" id="eliminar_contdosisedepto" name="eliminar_contdosisedepto" action="{{route('contratosdosisededepto.destroy', ['detcont'=>$dosicontsedep->id_contratodosimetria, 'contratodosisede'=>$dosicontsedep->contratodosimetriasede_id, 'contratodosisededepto'=>$dosicontsedep->id_contdosisededepto])}}" method="POST">
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
        
        </table>
    </div>
    <div class="col"></div>
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