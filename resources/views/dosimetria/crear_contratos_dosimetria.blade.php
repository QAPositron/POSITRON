@extends('layouts.plantillabase')
@section('contenido')
<h3 class="text-center ">{{$empresa->nombre_empresa}}</h3>
<div class="row">
    <div class="col"></div>
    <div class="col"></div>
    <div class="col"></div>
    <div class="col">
        <button type="button" class="btn colorQA" data-bs-toggle="modal" data-bs-target="#nueva_empresaModal" >CREAR CONTRATO</button>
        <div class="modal fade" id="nueva_empresaModal" tabindex="-1" aria-labelledby="nueva_empresaModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title w-100 text-center" id="nueva_empresaModalLabel">CREAR CONTRATO</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('contratosdosi.save')}}" method="POST">
                        @csrf
                        <div class="modal-body mx-5">
                            <div class="col-md">
                                <label class="text-center">INGRESE LA INFORMACIÓN SOLICITADA:</label>
                                <div class="form-floating my-3">
                                    <input type="number" name="codigo_contrato" id="codigo_contrato" class="form-control" autofocus >
                                    <label for="floatingInputGrid">CODIGO:</label>
                                    @error('codigo_contrato')
                                        <small>*{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-floating my-3">
                                    <input type="date" name="fecha_inicio_contrato" id="fecha_inicio_contrato" class="form-control"  autofocus > 
                                    <label for="floatingInputGrid">FECHA DE INICIO:</label>
                                    @error('fecha_inicio_contrato')
                                        <small>*{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-floating my-3">
                                    <input type="date" name="fecha_finalizacion_contrato" id="fecha_finalizacion_contrato" class="form-control"  autofocus > 
                                    <label for="floatingInputGrid">FECHA DE FINALIZACIÓN:</label>
                                    @error('fecha_finalizacion_contrato')
                                        <small>*{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-floating my-3">
                                    <select class="form-select" name="periodo_recambio_contrato" id="periodo_recambio_contrato"  autofocus>
                                        <option value="">--SELECCIONE--</option>
                                        <option value="SEMESTRAL">SEMESTRAL</option>
                                        <option value="BIMESTRAL">BIMESTRAL</option>
                                        <option value="TRIMESTRAL">TRIMESTRAL</option>
                                    </select>
                                    <label for="floatingInputGrid">PERIODO DE RECAMBIO:</label>
                                    @error('periodo_recambio_contrato')
                                        <small>*{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-floating my-3">
                                    <input type="date" name="fecha_contrato" id="fecha_contrato" class="form-control"  autofocus > 
                                    <label for="floatingInputGrid">FECHA FIRMADO:</label>
                                    @error('fecha_contrato')
                                        <small>*{{$message}}</small>
                                    @enderror
                                </div>
                                <!-- <div class="form-floating">
                                    <select class="form-select" name="id_sede" id="id_sede">
                                        <option value="">--SELECCIONE--</option>
                                        @foreach($sedes as $sed)
                                            <option value ="{{$sed->id_sede}}">{{$sed->nombre_sede}}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingSelectGrid">SEDE:</label>
                                    @error('id_sede')
                                        <small>*{{$message}}</small>
                                    @enderror
                                </div> -->
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">CANCELAR</button>
                            <button type="submit" class="btn colorQA"  data-bs-dismiss="modal" data-bs-target="#nueva_sedeModal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- <div class="modal fade" id="nueva_sedeModal" tabindex="-1" aria-labelledby="nueva_sedeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title w-100 text-center" id="nueva_sedeModalLabel">ASIGNAR SEDES</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('empresasdosi.save')}}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="col-md">
                                    <label class="text-center">AL SELECCIONAR UNA EMPRESA Y GUARDAR SE PODRAN CREAR CONTRATOS EN ELLA</label>
                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">CANCELAR</button>
                                <button type="submit" class="btn colorQA"  data-bs-dismiss="modal" >GUARDAR</button>
                            </div>
                        </form>
                    </div> 
                </div>
            </div> -->
    </div>
</div>
<BR></BR>
<div class="row">
    <div class="col"></div>
    <div class="col-12">
        <h4 class="text-center">LISTADO DE CONTRATOS</h4>
        <div class="table table-responsive p-4 ">
            <table class="table table-bordered">
                <thead class ="text-center">
                    <tr>
                        <th>No. CONTRATO</th>
                        <th style='width: 13.60%'>SEDES</th>
                        <th>FECHA CONTRATO</th>
                        <th>FECHA INICIO</th>
                        <th>FECHA FINALIZACIÓN</th>
                        <th>P. RECAMBIO</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
        </div>
    </div>
    <div class="col"></div>
</div>
@endsection()