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
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title w-100 text-center" id="nueva_empresaModalLabel">CREAR CONTRATO</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('contratosdosi.save')}}" method="POST">
                        @csrf
                        <div class="modal-body mx-5">
                            <label class="text-center ms-4">INGRESE LA INFORMACIÓN SOLICITADA:</label>
                            <div class="container-fluid">
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
                                    <div class="col-md"></div>
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
                                <div class="row">
                                    <div class="col-md">
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
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating my-3">
                                            <select class="form-select" name="empresa_contrato" id="empresa_contrato">
                                                <option value="{{$empresa->id_empresa}}">{{$empresa->nombre_empresa}}</option>
                                            </select>
                                            <label for="floatingInputGrid">EMPRESA:</label>
                                            @error('empresa_contrato')
                                                <small>*{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <hr>
                                <label class="text-center ms-4">ASIGNE ESTE CONTRATO A UNA SEDE:</label>
                                
                                <div class="row mt-2">
                                    <div class="col-md text-center">
                                        <button class="btn btn-sm colorQA" id="agregar">AGREGAR SEDE </button>
                                        <button type="button" class="btn btn-sm bg-danger" id="agregar" onclick="deleteElement()">ELIMINAR SEDE </button>
                                    </div>
                                </div>
                                <br>
                                <div class="container-fluid" id="clonar">
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="form-floating my-3">
                                                <select class="form-select" name="id_sede[]" id="id_sede">
                                                    <option value="">--SELECCIONE--</option>
                                                    @foreach($sedes as $sed)
                                                        <option value ="{{$sed->id_sede}}">{{$sed->nombre_sede}}</option>
                                                    @endforeach
                                                </select>
                                                <label for="floatingSelectGrid">SEDE:</label>
                                                @error('id_sede')
                                                    <small>*{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md">
                                            <label for="" class="text-center">No. DOSÍM. C. ENTERO</label>
                                            <input type="number" name="num_dosi_ce[]" id="num_dosi_ce_contrato_sede" class="form-control" autofocus >
                                            @error('num_dosi_ce_contrato_sede')
                                                <small>*{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md">
                                            <label for="" class="text-center">No. DOSÍM. AMBIENTAL</label>
                                            <input type="number" name="num_dosi_ambiental[]" id="num_dosi_ambiental_contrato_sede" class="form-control" autofocus >
                                            @error('num_dosi_ambiental_contrato_sede')
                                                <small>*{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md mt-4">
                                            <label for="" class="text-center">No. DOSÍM. CASO</label>
                                            <input type="number" name="num_dosi_caso[]" id="num_dosi_caso_contrato_sede" class="form-control" autofocus >
                                            @error('num_dosi_caso_contrato_sede')
                                                <small>*{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md mt-4">
                                            <label for="" class="text-center">No. DOSÍM. EZCLIP</label>
                                            <input type="number" name="num_dosi_ezclip[]" id="num_dosi_ezclip_contrato_sede" class="form-control" autofocus >
                                            @error('num_dosi_ezclip_contrato_sede')
                                                <small>*{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                   
                                </div>
                                <div id="contenedor">

                                </div>   
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">CANCELAR</button>
                            <button type="submit" class="btn colorQA"  data-bs-dismiss="modal">GUARDAR</button>
                        </div>
                    </form>
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
    let sedesNumber = 1;
    let agregar = document.getElementById('agregar');
    let contenido = document.getElementById('contenedor');
    
    agregar.addEventListener('click', e =>{
        e.preventDefault();
        let clonado = document.querySelector('#clonar');
        let clon = clonado.cloneNode(true);
        
        contenido.appendChild(clon).classList.remove('clonar');
        sedesNumber ++;
    })
    
    /* function deleteElement() {
        sedesNumber--;
        if(sedesNumber >=0) {
            parentNode = document.getElementsByClassName('contenedorMoreSedes');
            parentNodeLength = parentNode.length;
            document.getElementById('clonar').remove();
        }
    } */
    function deleteElement() {
        if (sedesNumber == 1){
        }else {
            sedesNumber--;
            if(sedesNumber >0) {
                parentNode = document.getElementsByClassName('contenedorMoreSedes');
                parentNodeLength = parentNode.length;
                document.getElementById('clonar').remove();
            }
        }
    }
    
</script>
@endsection