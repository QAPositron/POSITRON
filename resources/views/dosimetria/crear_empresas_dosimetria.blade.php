@extends('layouts.plantillabase')
@section('contenido') 
    <div class="row">
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col">
            <button type="button" class="btn colorQA" data-bs-toggle="modal" data-bs-target="#nueva_empresaModal" >NUEVA EMPRESA</button>
            <div class="modal fade" id="nueva_empresaModal" tabindex="-1" aria-labelledby="nueva_empresaModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title w-100 text-center" id="nueva_empresaModalLabel">NUEVA EMPRESA</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        @livewire('form-crear-empresa-dosimetria', ['empresas' => $empresas])
                    </div> 
                </div>
            </div>
        </div>
    </div>
    
    <br>
    <h2 class="text-center">EMPRESAS CON DOSIMETRÍA</h2>
    <div class="row">               
        <div class="col"></div>
        <div class="col-11">
            <div class="table table-responsive p-4 ">
                <table class="table table-bordered empresasdosi">
                    <thead class ="table-active text-center">
                        <tr>
                            <th >EMPRESA</th>
                            <th style='width: 15.60%'>TIPO. IDEN</th>
                            <th style='width: 14.80%'>No. IDEN</th>
                            <th style='width: 10.60%'>DOSIM. TORAX</th>
                            <th style='width: 10.60%'>DOSIM. CRISTALINO</th>
                            <th style='width: 10.60%'>DOSIM. ANILLO</th>
                            <th style='width: 10.60%'>DOSIM. MUÑECA</th>
                            <th style='width: 9.60%'>DOSIM. CONTROL</th>
                            <th style='width: 9.60%'>DOSIM. ÁREA</th>
                            <th style='width: 9.60%'>DOSIM. CASO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($empresaDosi as $empdosi)
                            <tr>
                                <td class="align-middle"><a class="link-dark" href="{{route('contratosdosi.createlist', $empdosi->empresa_id)}}">{{$empdosi->nombre_empresa}}</a></td>
                                <td class="align-middle">{{$empdosi->empresa->tipo_identificacion_empresa}}</td>
                                <td class="align-middle">{{$empdosi->num_iden_empresa}} {{$empdosi->empresa->DV}}</td>
                                <td class="align-middle">{{$empdosi->numtotal_dosi_torax}}</td>
                                <td class="align-middle">{{$empdosi->numtotal_dosi_cristalino}}</td>
                                <td class="align-middle">{{$empdosi->numtotal_dosi_dedo}}</td>
                                <td class="align-middle">{{$empdosi->numtotal_dosi_muñeca}}</td>
                                <td class="align-middle">{{$empdosi->numtotal_dosi_control}}</td>
                                <td class="align-middle">{{$empdosi->numtotal_dosi_ambiental}}</td>
                                <td class="align-middle">{{$empdosi->numtotal_dosi_caso}}</td>
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
    $(document).ready( function ()  {
        $('.empresasdosi').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "NO HAY REGISTROS",
                "info": "MOSTRANDO REGISTROS DEL  _START_ AL _END_ DE UN TOTAL DE  _TOTAL_ REGISTROS",
                "infoEmpty": "MOSTRANDO 0 to 0 DE 0 REGISTROS",
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


@endsection()