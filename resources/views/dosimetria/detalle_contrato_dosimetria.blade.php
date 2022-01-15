@extends('layouts.plantillabase')
@section('contenido')

<h3 class="text-center ">{{$dosimetriacontrato->empresa->nombre_empresa}}</h3>
<br>
<h4 class="text-center ">CONTRATO No. {{$dosimetriacontrato->codigo_contrato}}</h4>
<br>
<h6 class="text-center ">TOTAL DE DOSÍMETROS:       CUERPO E.:#        AMBIENTAL: #       EZCLIP:# </h6>

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
<h4 class="text-center ">SEDES SUBSCRITAS A ESTE CONTRATO</h4>
<div class="row">
    <div class="col"></div>
    <div class="col-9">
        <div class="table table-responsive p-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="table-active text-center" style='width: 30.90%'>SEDES</th>
                        <th class="table-active text-center">DOSÍMETROS C. ENTERO</th>
                        <th class="table-active text-center">DOSÍMETROS AMBIENTAL</th>
                        <th class="table-active text-center">DOSÍMETROS EZCLIP</th>
                        <th class="table-active text-center" style='width: 13.90%'>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dosimecontra as $dosicont)
                        <tr>
                            <td><a class="link-dark" href="{{route('detallesedecont.create', $dosicont->id_contratodosimetriasede)}}">{{$dosicont->nombre_sede}}</a></td>
                            <td class="text-center">{{$dosicont->dosi_cuerpo_entero}}</td>
                            <td class="text-center">{{$dosicont->dosi_ambiental}}</td>
                            <td class="text-center">{{$dosicont->dosi_ezclip}}</td>
                            <td >
                            <div class="row">
                                <div class="col">
                                    <a href="" class="btn colorQA">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                        </svg>
                                    </a>
                                </div>
                                <div class="col">
                                    <form id="form_eliminar_empresa" name="form_eliminar_empresa" action="" method="POST">
                                        @csrf  
                                        @method('delete')
                                        <button class="btn btn-danger" onclick="Eliminar(evt);" type="submit">
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
<!-- <div class="row">
    <div class="col"></div>
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="detalleContrato" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#info" role="tab" aria-controls="info" aria-selected="true">INFORMACIÓN</a>
                    </li>
                    @foreach($dosimecontra as $dosicont)
                        <li class="nav-item">
                            <a class="nav-link" href="#{{$dosicont->nombre_sede}}" role="tab" aria-controls="{{$dosicont->nombre_sede}}" aria-selected="false">{{$dosicont->nombre_sede}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content mt-3">
                    <div class="tab-pane active" id="info" role="tabpanel">
                        <br>
                        <h5 class="card-title text-center">INFORMACIÓN DEL CONTRATO</h5>
                        <br>
                        <div class="table table-responsive p-4 ">
                            <table class="table table-bordered">
                                <tbody>
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
                    
                    @foreach($dosimecontra as $dosicont)
                        <div class="tab-pane" id="{{$dosicont->nombre_sede}}" role="tabpanel" aria-labelledby="{{$dosicont->nombre_sede}}-tab">
                            <div class="table table-responsive p-4 ">
                                <table class="table table-bordered">
                                    <thead class ="text-center">
                                        <tr>
                                            <th style='width: 15.60%'>MESES</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <th>MES 1</th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>MES 2</th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>MES 3</th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>MES 4</th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>MES 5</th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>MES 6</th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>MES 7</th>
                                            <td></td>
                                        </tr><tr>
                                            <th>MES 8</th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>MES 9</th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>MES 10</th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>MES 11</th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>MES 12</th>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                   
                </div>    
            </div>
        </div>
    </div>
    <div class="col"></div>
</div> -->


<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous">
</script>

<script type="text/javascript">
    $(document).ready(function(){

        $('#detalleContrato a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    })
</script> 
@endsection