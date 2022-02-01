@extends('layouts.plantillabase')
@section('contenido')

<div class="row">
    <div class="col"></div>
    <div class="col-7">
        <div class="card text-dark bg-light">
            <h3 class="text-center mt-3">NUEVO CONTRATO DE DOSIMETRÍA</h3>
            <h3 class="text-center">PARA LA EMPRESA: {{$empresa->nombre_empresa}}</h3>
            <form class="m-4" action="{{route('contratosdosi.save')}}" method="POST">
                
                @csrf
                <input type="text" name="empresa_contrato" id="empresa_contrato" hidden value="{{$empresa->id_empresa}}">
                <div class="row">
                    <div class="col-md">
                        <div class="form-floating my-3">
                            <input type="number" name="codigo_contrato" id="codigo_contrato" class="form-control" autofocus >
                            <label for="floatingInputGrid">CODIGO:</label>
                            @error('codigo_contrato')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating my-3">
                            <select class="form-select" name="periodo_recambio_contrato" id="periodo_recambio_contrato"  autofocus>
                                <option value="">--SELECCIONE--</option>
                                <option value="MEN">MENSUAL</option>
                                <option value="SEM">SEMESTRAL</option>
                                <option value="BIM">BIMESTRAL</option>
                                <option value="TRIM">TRIMESTRAL</option>
                            </select>
                            <label for="floatingInputGrid">PERIODO DE RECAMBIO:</label>
                            @error('periodo_recambio_contrato')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <div class="form-floating my-3">
                            <input type="date" name="fecha_inicio_contrato" id="fecha_inicio_contrato" class="form-control"  autofocus > 
                            <label for="floatingInputGrid">FECHA DE INICIO:</label>
                            @error('fecha_inicio_contrato')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating my-3">
                            <input type="date" name="fecha_finalizacion_contrato" id="fecha_finalizacion_contrato" class="form-control"  autofocus > 
                            <label for="floatingInputGrid">FECHA DE FINALIZACIÓN:</label>
                            @error('fecha_finalizacion_contrato')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md"></div>
                    <div class="col-md-8">
                        <h6 class="text-center">OPRIMA EL BOTÓN "SIGUIENTE" PARA ASIGNAR UNA O MÁS SEDES DE ESTA EMPRESA AL CONTRATO</h6>
                    </div>
                    <div class="col-md"></div>
                </div>
                <br>
                <div class="card-footer text-end bg-transparent ">
                    <br>
                    <button type="button" class="btn btn-danger" >CANCELAR</button>
                    <button type="submit" class="btn colorQA">SIGUIENTE</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col"></div>
</div>

<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous">
</script>

@endsection