@extends('layouts.app')
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
        <div class="col">
            <a class="btn colorQA" style="border-radius: 25px;  width: 50px; height: 50px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-graph-up mt-1" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm14.817 3.113a.5.5 0 0 1 .07.704l-4.5 5.5a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61 4.15-5.073a.5.5 0 0 1 .704-.07Z"/>
                </svg>
            </a>
        </div>
    </div>
    
    <br>
    <h2 class="text-center">EMPRESAS CON DOSIMETRÍA</h2>
    <div class="row">               
        <div class="col"></div>
        <div class="col-12">
            <div class="table table-responsive p-4 ">
                <table class="table table-bordered empresasdosi">
                    <thead class="table-light">
                        <tr>
                            <th rowspan="2" class="align-middle text-center">EMPRESA</th>
                            <th rowspan="2"class="align-middle text-center">CONTRATOS ACT.</th>
                            <th colspan="6" class="align-middle text-center" style='width: 13.80%'>DOSÍMETROS</th>
                            <th colspan="3" class="align-middle text-center" style='width: 9.80%'>CONTROLES</th>
                            <th rowspan="2" class="align-middle text-center" style='width: 1.60%'>TOTAL</th>
                        </tr>
                        <tr>
                            <th class="align-middle text-center">TOR.</th>
                            <th class="align-middle text-center">CRIS.</th>
                            <th class="align-middle text-center">ANI.</th>
                            <th class="align-middle text-center">MUÑ.</th>
                            <th class="align-middle text-center" style='width: 9.60%'>AMB.</th>
                            <th class="align-middle text-center" style='width: 9.60%'>CASO</th>
                            <th class="align-middle text-center" style='width: 9.60%'>TOR.</th>
                            <th class="align-middle text-center" style='width: 9.60%'>CRIS.</th>
                            <th class="align-middle text-center" style='width: 9.60%'>ANI.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($empresaDosi as $empdosi)
                            <tr>
                                <td class="align-middle text-center"><a class="btn btn-outline-primary rounded-pill" href="{{route('contratosdosi.createlist', $empdosi->empresa_id)}}">{{strlen($empdosi->empresa->nombre_empresa) > 29 ? mb_substr($empdosi->empresa->nombre_empresa, 0, 29, "UTF-8")."..." : $empdosi->empresa->nombre_empresa}}</a></td>
                                <td class="align-middle text-center">
                                    @foreach($dosimetriacontrato as $dosicont)
                                        @if($empdosi->empresa_id == $dosicont->empresa_id)
                                            <div class="row">
                                                <div class="col" id='{{$dosicont->id_contratodosimetria}}'></div>
                                                <div class="col mt-2">{{$dosicont->periodo_recambio}}</div>
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                                {{-- <td class="align-middle text-center">{{$empdosi->empresa->tipo_identificacion_empresa}}</td>
                                <td class="align-middle text-center">{{$empdosi->num_iden_empresa}} {{$empdosi->empresa->DV}}</td> --}}
                                <td class="align-middle text-center">{{$empdosi->numtotal_dosi_torax}}</td>
                                <td class="align-middle text-center">{{$empdosi->numtotal_dosi_cristalino}}</td>
                                <td class="align-middle text-center">{{$empdosi->numtotal_dosi_dedo}}</td>
                                <td class="align-middle text-center">{{$empdosi->numtotal_dosi_muñeca}}</td>
                                <td class="align-middle text-center">{{$empdosi->numtotal_dosi_ambiental}}</td>
                                <td class="align-middle text-center">{{$empdosi->numtotal_dosi_caso}}</td>
                                <td class="align-middle text-center">{{$empdosi->numtotal_dosi_control_torax}}</td>
                                <td class="align-middle text-center">{{$empdosi->numtotal_dosi_control_cristalino}}</td>
                                <td class="align-middle text-center">{{$empdosi->numtotal_dosi_control_dedo}}</td>
                                <td class="align-middle text-center" style='width: 1.60%'>{{$empdosi->numtotal_dosi_torax + $empdosi->numtotal_dosi_ambiental}}</td>
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
        @foreach($dosimetriacontrato as $dosicont)
            var TDcontrato = document.getElementById("{{$dosicont->id_contratodosimetria}}");
            var num = parseInt('{{$dosicont->codigo_contrato}}');
            var n = num.toString().padStart(5,'0');
            console.log("ESTE ES EL CODIGO" +n);
           
            TDcontrato.innerHTML = "<a class='btn btn-outline-primary rounded-pill' href='{{route('detallecontrato.create', "+$dosicont->id_contratodosimetria+")}}'>"+n+"</a>";
            
        @endforeach
        $('.empresasdosi').DataTable({
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


@endsection()