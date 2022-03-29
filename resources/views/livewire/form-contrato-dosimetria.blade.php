<div>

    <form wire:submit.prevent="saveContrato" id="form_contrato_dosimetria" name="form_contrato_dosimetria">
        @csrf
        <div class="modal-body">
            <label class="text-center ms-4">INGRESE LA INFORMACIÓN SOLICITADA:</label>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md">
                        <div class="form-floating my-3">
                            <input wire:model="id_empresa" type="number" class="form-control" name="id_empresa_contrato"  id="id_empresa_contrato" hidden value="{{$empresa->id_empresa}}">
                            <input wire:model="codigo" type="number" name="codigo_contrato" id="codigo_contrato" class="form-control  @error('codigo') is-invalid @enderror" autofocus >
                            <label for="floatingInputGrid">CODIGO:</label>
                            @error('codigo') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating my-3">
                            <select wire:model="periodo_recambio" class="form-select @error('periodo_recambio') is-invalid @enderror" name="periodo_recambio_contrato" id="periodo_recambio_contrato"  autofocus>
                                <option value="">--SELECCIONE--</option>
                                <option value="MENS">MENSUAL</option>
                                <option value="SEMS">SEMESTRAL</option>
                                <option value="BIMS">BIMESTRAL</option>
                                <option value="TRIMS">TRIMESTRAL</option>
                            </select>
                            <label for="floatingInputGrid">PERIODO DE RECAMBIO:</label>
                            @error('periodo_recambio') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <div class="form-floating my-3">
                            <input wire:model="fecha_inicio" type="date" name="fecha_inicio_contrato" id="fecha_inicio_contrato" class="form-control @error('fecha_inicio') is-invalid @enderror" onchange="fechafinalcontrato();" autofocus>
                            <label for="floatingInputGrid">FECHA DE INICIO:</label>
                            @error('fecha_inicio') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating my-3">
                            <input wire:model="fecha_final" type="date" name="fecha_finalizacion_contrato" id="fecha_finalizacion_contrato" class="form-control " autofocus >
                            <label for="floatingInputGrid" >FECHA DE FINALIZACIÓN</label>
                           {{--  @error('fecha_final') <span class="invalid-feedback">*{{ $message }}</span> @enderror --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <hr>
                <label class="text-center ms-4">ASIGNE A ESTE CONTRATO UNA O MÁS SEDES:</label>

                <div class="row mt-2">
                    <div class="col-md text-center">
                        <button onclick="readySede()" class="btn btn-sm colorQA" id="agregar">AGREGAR SEDE </button>
                        <button type="button" class="btn btn-sm bg-danger" id="agregar" onclick="deleteElement()">ELIMINAR SEDE </button>
                    </div>
                </div>
                <br>
                <div hidden class="container-fluid" id="clonar">
                    <div class="rounded  m-3 p-3 border border-light active">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-floating my-3">
                                    <select wire:model="id_sedes" class="form-select @error('id_sedes') is-invalid @enderror" id="id_sede">
                                        <option value="">--SELECCIONE--</option>
                                        @foreach($sedes as $sed)
                                            <option value ="{{$sed->id_sede}}">{{$sed->nombre_sede}}</option>
                                        @endforeach
                                    </select>
                                    <?php
                                    $value = null;
                                    ?>
                                    <label for="floatingSelectGrid">SEDE:</label>
                                    @error('id_sedes') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md mt-4">
                                <button onclick="addDepa()" type="button" class="btn btn-sm colorQA" id="agregarDepto1">AGREGAR DTO.</button>
                            </div>
                            <div class="col-md mt-4">
                                <button type="button" class="btn btn-sm bg-danger" id="agregar1" onclick="deleteDepa()">ELIMINAR DTO.</button>
                            </div>
                            <div class="col-md"></div>
                            <div class="col-md"></div>
                            <div class="col-md"></div>
                            <div class="col-md"></div>
                        </div>
                        <div hidden id="clonarDepto">
                            <div class="row ">
                                <div class="col-md-3">
                                    <div class="form-floating mt-4">
                                        <select wire:model="id_departamentos" class="form-select @error('id_departamentos') is-invalid @enderror"  id="departamento_sede">
                                            <option value="">--SELECCIONE--</option>
                                            @foreach($departamentos as $depa)
                                                <option value ="{{$depa->id_departamentosede}}">{{$depa->nombre_departamento}}</option>
                                            @endforeach
                                        </select>
                                        <label for="floatingSelectGrid">DEPARTAMENTO:</label>
                                        @error('id_departamentos') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <label for="" class="text-center">No. DOSÍM. C. ENTERO</label>
                                    <input wire:model="dosim_cuerpo_entero" type="number" id="num_dosi_ce_contrato_sede" class="form-control @error('dosim_cuerpo_entero') is-invalid @enderror" autofocus >
                                    @error('dosim_cuerpo_entero') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md">
                                    <label for="" class="text-center">No. DOSÍM. AMBIENTAL</label>
                                    <input wire:model="dosim_ambiental" type="number" id="num_dosi_ambiental_contrato_sede" class="form-control @error('id_departamentos') is-invalid @enderror" autofocus >
                                    @error('dosim_ambiental') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md">
                                    <label for="" class="text-center">No. DOSÍM. CONTROL</label>
                                    <input type="number" id="num_dosi_caso_contrato_sede" class="form-control" autofocus >
                                    @error('num_dosi_caso_contrato_sede')
                                    <small>*{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md">
                                    <label for="" class="text-center">No. DOSÍM. EZCLIP</label>
                                    <input type="number"  id="num_dosi_ezclip_contrato_sede" class="form-control" autofocus >
                                    @error('num_dosi_ezclip_contrato_sede')
                                    <small>*{{$message}}</small>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="" id="contenedorDepto0">

                        </div>
                    </div>
                </div>

                <div id="contenedor">

                </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">CANCELAR</button>
            <button wire:click="save" type="submit" class="btn colorQA"  data-bs-dismiss="modal">GUARDAR</button>
        </div>
    </form>
</div>
