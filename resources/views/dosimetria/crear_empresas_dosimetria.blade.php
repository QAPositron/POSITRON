@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido') 
    <div class="row">
        <div class="col-md"></div>
        <div class="col-md-11">
            <h2 class="text-center">EMPRESAS CON DOSIMETRÍA</h2>
        </div>
        <div class="col-md"></div>
    </div>
    <div class="row">
        <div class="col-md"></div>
        <div class="col-md"></div>
        <div class="col-md-2 text-center">
            <button type="button" class="btn colorQA mt-1" data-bs-toggle="modal" data-bs-target="#nueva_empresaModal" >NUEVA EMPRESA</button>
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
        <div class="col-md-1 text-center">
            <button type="button" class="btn colorQA" data-bs-toggle="modal" data-bs-target="#estadisticasDosim"style="border-radius: 25px;  width: 50px; height: 50px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-graph-up mt-1" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm14.817 3.113a.5.5 0 0 1 .07.704l-4.5 5.5a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61 4.15-5.073a.5.5 0 0 1 .704-.07Z"/>
                </svg>
            </button>
            <div class="modal fade" id="estadisticasDosim" tabindex="-1" aria-labelledby="estadisticasDosimLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title w-100 text-center" id="nueva_empresaModalLabel">ESTADÍSTICAS DE LOS DOSÍMETROS</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col"></div>
                                <div class="col-md-10">
                                    <div class="card">
                                        <div class="card-header">
                                            <ul class="nav nav-tabs card-header-tabs" id="infoDosimetros" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="#general" role="tab" aria-controls="general" aria-selected="true">GENERAL</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link"  href="#empresas" role="tab" aria-controls="empresas" aria-selected="false">EMPRESAS</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content mt-3">
                                                <!-- //////////////////// PESTAÑA DE GENERAL//////////////// -->
                                                <div class="tab-pane active" id="general" role="tabpanel">
                                                    <div class="table table-responsive p-4 ">
                                                        <table class="table table-bordered">
                                                            <thead class="table-secondary">
                                                                <tr>
                                                                    <th colspan="4" class="align-middle text-center">DOSÍMETROS</th>
                                                                </tr>
                                                                <tr>
                                                                    <th class="align-middle text-center">EN USO</th>
                                                                    <th class="align-middle text-center">EN LECTURA</th>
                                                                    <th class="align-middle text-center">STOCK</th>
                                                                    <th class="align-middle text-center">TOTAL</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="align-middle text-center">{{$dosimetrosUsados}}</td>
                                                                    <td class="align-middle text-center">{{$dosimetrosEnLectura}}</td>
                                                                    <td class="align-middle text-center">{{$dosimestrosLibres}}</td>
                                                                    <td class="align-middle text-center">{{$dosimetrosUsados + $dosimetrosEnLectura + $dosimestrosLibres}}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- //////////////////// PESTAÑA DE EMPRESA //////////////// -->
                                                <div class="tab-pane" id="empresas" role="tabpanel" aria-labelledby="sede-tab">
                                                    <div class="table table-responsive p-4 ">
                                                        <table class="table table-bordered">
                                                            <thead class="table-secondary">
                                                                <tr>
                                                                    <th colspan="4" class="align-middle text-center">DOSÍMETROS DE EMPRESAS</th>
                                                                </tr>
                                                                <tr>
                                                                    <th class="align-middle text-center">EMPRESA</th>
                                                                    <th class="align-middle text-center">EN USO</th>
                                                                    <th class="align-middle text-center">EN LECTURA</th>
                                                                    <th class="align-middle text-center">TOTAL</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($empresaDosi as $empdosi)
                                                                    <tr>
                                                                        <td>
                                                                            {{$empdosi->nombre_empresa}}
                                                                        </td>
                                                                        <td>
                                                                            @php
                                                                                $dosimUso = 0;
                                                                                foreach($empresasDosimTrabjUSO as $empTrabjuso){
                                                                                    if($empTrabjuso->id_empresa == $empdosi->empresa_id){
                                                                                        $dosimUso += 1;
                                                                                    } 
                                                                                }
                                                                                foreach($empresasDosimDosicontUSO as $empContruso){
                                                                                    if($empContruso->id_empresa == $empdosi->empresa_id){
                                                                                        $dosimUso += 1;
                                                                                    }
                                                                                }
                                                                                foreach($empresasDosimDosiareaUSO as $empAreauso){
                                                                                    if($empAreauso->id_empresa == $empdosi->empresa_id){
                                                                                        $dosimUso += 1;
                                                                                    }
                                                                                }
                                                                            @endphp
                                                                            {{$dosimUso}}
                                                                        </td>
                                                                        <td>
                                                                            @php
                                                                                $dosimLectura = 0;
                                                                                foreach($empresasDosimTrabjLECTURA as $empTrabjlect){
                                                                                    if($empTrabjlect->id_empresa == $empdosi->empresa_id){
                                                                                        $dosimLectura += 1;
                                                                                    }
                                                                                }
                                                                                foreach($empresasDosimDosicontLECTURA as $empContlect){
                                                                                    if($empContlect->id_empresa == $empdosi->empresa_id){
                                                                                        $dosimLectura += 1;
                                                                                    }
                                                                                }
                                                                                foreach($empresasDosimDosiareaLECTURA as $empArealect){
                                                                                    if($empArealect->id_empresa == $empdosi->empresa_id){
                                                                                        $dosimLectura += 1;
                                                                                    }
                                                                                }
                                                                            @endphp
                                                                            {{$dosimLectura}}
                                                                        </td>
                                                                        <td>
                                                                            {{$dosimUso + $dosimLectura}}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col"></div>
                            </div>
                        </div>

                        {{-- @livewire('form-crear-empresa-dosimetria', ['empresas' => $empresas]) --}}

                    </div> 
                </div>
            </div>
        </div>
    </div>
    
    <br>
    <div class="row">               
        <div class="col"></div>
        <div class="col-12">
            <div class="table table-responsive p-4 ">
                <table class="table table-bordered empresasdosi">
                    <thead class="table-secondary">
                        <tr>
                            <th rowspan="2" class="align-middle text-center">EMPRESA</th>
                            <th rowspan="2"class="align-middle text-center">CONTRATOS ACT.</th>
                            <th colspan="5" class="align-middle text-center" style='width: 13.80%'>DOSÍMETROS</th>
                            <th colspan="3" class="align-middle text-center" style='width: 9.80%'>CONTROLES</th>
                            <th rowspan="2" class="align-middle text-center" style='width: 1.60%'>TOTAL</th>
                        </tr>
                        <tr>
                            <th class="align-middle text-center">TOR.</th>
                            <th class="align-middle text-center">CRIS.</th>
                            <th class="align-middle text-center">ANI.</th>
                            {{-- <th class="align-middle text-center">MUÑ.</th> --}}
                            <th class="align-middle text-center">AMB.</th>
                            <th class="align-middle text-center">CASO</th>
                            <th class="align-middle text-center">TOR.</th>
                            <th class="align-middle text-center">CRIS.</th>
                            <th class="align-middle text-center">ANI.</th>
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
                                {{-- <td class="align-middle text-center">{{$empdosi->numtotal_dosi_muñeca}}</td> --}}
                                <td class="align-middle text-center">{{$empdosi->numtotal_dosi_ambiental}}</td>
                                <td class="align-middle text-center">{{$empdosi->numtotal_dosi_caso}}</td>
                                <td class="align-middle text-center">{{$empdosi->numtotal_dosi_control_torax}}</td>
                                <td class="align-middle text-center">{{$empdosi->numtotal_dosi_control_cristalino}}</td>
                                <td class="align-middle text-center">{{$empdosi->numtotal_dosi_control_dedo}}</td>
                                <td class="align-middle text-center table-light" style='width: 1.60%'>{{$empdosi->numtotal_dosi_torax + $empdosi->numtotal_dosi_cristalino + $empdosi->numtotal_dosi_dedo + $empdosi->numtotal_dosi_caso + $empdosi->numtotal_dosi_ambiental + $empdosi->numtotal_dosi_control_torax + $empdosi->numtotal_dosi_control_cristalino + $empdosi->numtotal_dosi_control_dedo}}</td>
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
           
            TDcontrato.innerHTML = "<a class='btn btn-outline-primary rounded-pill' href='{{route('detallecontrato.create', "$dosicont->id_contratodosimetria")}}'>"+n+"</a>";
            
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
        

        $('#infoDosimetros a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    })
</script>


@endsection()