@extends('layouts.plantillabase')
@section('contenido').


<h3 class="text-center ">{{$empresa->nombre_empresa}}</h3>
<div class="row">
    <div class="col"></div>
    <div class="col"></div>
    <div class="col"></div>
    <div class="col">
        <button type="button" class="btn colorQA" data-bs-toggle="modal" data-bs-target="#nueva_empresaModal" >CREAR CONTRATO </button>
        <div class="modal fade" id="nueva_empresaModal" tabindex="-1" aria-labelledby="nueva_empresaModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title w-100 text-center" id="nueva_empresaModalLabel">CREAR CONTRATO PARA LA EMPRESA:{{$empresa->nombre_empresa}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    @livewire('form-contrato-dosimetria', ['empresa' =>$empresa, 'sedes' =>$sedes, 'departamentos' =>$departamentos])
                   
                    
                </div>
            </div>
        </div>

    </div>
</div>
<BR></BR>
<div class="row">
    <div class="col"></div>
    <div class="col-9">
        <h4 class="text-center">LISTADO DE CONTRATOS</h4>
        <div class="table table-responsive p-4 ">
            <table class="table table-bordered">
                <thead class ="text-center">
                    <tr>
                        <th>No. CONTRATO</th>
                        <th style='width: 15.60%'>FECHA INICIO</th>
                        <th style='width: 15.60%'>FECHA FINALIZACIÓN</th>
                        <th>P. RECAMBIO</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dosimetriacontrato as $dosicont)
                        <tr>
                            <td><a class="link-dark" href="{{route('detallecontrato.create', $dosicont->id_contratodosimetria)}}">{{$dosicont->codigo_contrato}}</a></td>
                            <td>{{$dosicont->fecha_inicio}}</td>
                            <td>{{$dosicont->fecha_finalizacion}}</td>
                            <td>{{$dosicont->periodo_recambio}}</td>
                            <td>

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


<script type="text/javascript">
    

</script>



@endsection
