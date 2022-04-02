<div>
        <form action="{{route('contratosdosi.save')}}" method="POST" id="form_contrato_dosimetria" name="form_contrato_dosimetria">
            @csrf
            <div class="modal-body">
                <label class="text-center ms-4">INGRESE LA INFORMACIÓN SOLICITADA:</label>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md">
                            <div class="form-floating my-3">
                                {{$empresa->id_empresa}}
                                <input type="text" name="empresa_contrato" hidden id="empresa_contrato" value="{{$empresa->id_empresa}}">
                                <input wire:model="codigo" type="number" name="codigo_contrato" id="codigo_contrato" class="form-control  @error('codigo') is-invalid @enderror" autofocus >
                                <label for="floatingInputGrid">CODIGO:</label>
                                @error('codigo') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                                {{$codigo}}
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
                                {{$periodo_recambio}}
                            </div>
                        </div>
                    </div>
                    

                    <div class="row">
                        <div class="col-md">
                            <div class="form-floating my-3">
                                <input wire:model="fecha_inicio" type="date" name="fecha_inicio_contrato" id="fecha_inicio_contrato" class="form-control @error('fecha_inicio') is-invalid @enderror" onchange="fechafinalcontrato();" autofocus>
                                <label for="floatingInputGrid">FECHA DE INICIO:</label>
                                @error('fecha_inicio') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                                {{$fecha_inicio}}
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating my-3">
                                <input type="date" name="fecha_finalizacion_contrato" id="fecha_finalizacion_contrato" class="form-control " autofocus >
                                <label for="floatingInputGrid" >FECHA DE FINALIZACIÓN</label>
                                
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
                                        <select class="form-select" id="id_sede">
                                            <option value="">--SELECCIONE--</option>
                                            @foreach($sedes as $sed)
                                                <option value ="{{$sed->id_sede}}">{{$sed->nombre_sede}}</option>
                                            @endforeach
                                        </select>
                                        <?php
                                        $value = null;
                                        ?>
                                        <label for="floatingSelectGrid">SEDE:</label>
                                        
                                        
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
                                            <select class="form-select"  id="departamento_sede">
                                                <option value="">--SELECCIONE--</option>
                                                @foreach($departamentos as $depa)
                                                    <option value ="{{$depa->id_departamentosede}}">{{$depa->nombre_departamento}}</option>
                                                @endforeach
                                            </select>
                                            <label for="floatingSelectGrid">DEPARTAMENTO:</label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <label for="" class="text-center">No. DOSÍM. C. ENTERO</label>
                                        <input type="number" id="num_dosi_ce_contrato_sede" class="form-control" autofocus >
                                        
                                    </div>
                                    <div class="col-md">
                                        <label for="" class="text-center">No. DOSÍM. AMBIENTAL</label>
                                        <input type="number" id="num_dosi_ambiental_contrato_sede" class="form-control" autofocus >
                                        
                                    </div>
                                    <div class="col-md">
                                        <label for="" class="text-center">No. DOSÍM. CONTROL</label>
                                        <input type="number" id="num_dosi_caso_contrato_sede" class="form-control" autofocus >
                                        
                                    </div>
                                    <div class="col-md">
                                        <label for="" class="text-center">No. DOSÍM. EZCLIP</label>
                                        <input type="number"  id="num_dosi_ezclip_contrato_sede" class="form-control" autofocus >
                                        
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
                <button type="submit" class="btn colorQA"  data-bs-dismiss="modal">GUARDAR</button>
            </div>
        </form>
    
    <script>
        function fechafinalcontrato(){
            var fecha_inicio = new Date(document.getElementById('fecha_inicio_contrato').value);
            alert(fecha_inicio);
            var fecha_final_año = fecha_inicio.getFullYear()+1;
            var mm = fecha_inicio.getMonth()+1;
            var fecha_final_mes = (mm < 10 ? '0' : '')+mm;
            var dd = fecha_inicio.getDate();
            var fecha_final_dia = (dd < 10 ? '0' : '')+dd;
            var fecha_final = fecha_final_año+'-'+fecha_final_mes+'-'+fecha_final_dia;
            console.log(fecha_final);
            document.getElementById("fecha_finalizacion_contrato").value = fecha_final;
        } 

        let sedesNumber = 1;
        let depaNumber = 1;
        let agregar = document.getElementById('agregar');
        let contenido = document.getElementById('contenedor');

        let agregarDepto = document.getElementById('agregarDepto1');
        let contenidoDepto = null;


        /////////// clonar Sede /////////// 
        agregar.addEventListener('click', e =>{
            e.preventDefault();
            let clonado = document.querySelector('#clonar');
            let clon = clonado.cloneNode(true);


            contenido.appendChild(clon).setAttribute("id", `${sedesNumber}`);
            contenido.appendChild(clon).setAttribute("class", `${sedesNumber}`);
            document.getElementById(`${sedesNumber}`).removeAttribute("hidden");
            document.getElementById(`${sedesNumber}`).querySelector('#contenedorDepto0').setAttribute("id", `contenedorDeptoSede${sedesNumber}`);
            document.getElementById(`${sedesNumber}`).querySelector('#id_sede').setAttribute("id", `id_sede${sedesNumber}`);
            document.getElementById(`${sedesNumber}`).querySelector(`#id_sede${sedesNumber}`).setAttribute("name", `id_sede${sedesNumber}[]`);
            console.log(document.getElementById(`${sedesNumber}`).querySelector(`#contenedorDeptoSede${sedesNumber}`))
            contenidoDepto= document.getElementById(`contenedorDeptoSede${sedesNumber}`)
            sedesNumber ++;
        })
        /////////////clonar departamento////////////
        function addDepa() {

            let clonadoDepto = document.querySelector('#clonarDepto');
            let clonDepto = clonadoDepto.cloneNode(true);

            console.log(contenidoDepto);
            contenidoDepto.appendChild(clonDepto).setAttribute("id", `depa${depaNumber}`);
            document.getElementById(`depa${depaNumber}`).removeAttribute("hidden");

            document.getElementById(`depa${depaNumber}`).querySelector(`#departamento_sede`)
                .setAttribute("name", `departamentos_sede${sedesNumber-1}[]`);

            document.getElementById(`depa${depaNumber}`).querySelector(`#num_dosi_ce_contrato_sede`)
                .setAttribute("name", `dosimetro_cuerpoEntero_sede${sedesNumber-1}[]`);

            document.getElementById(`depa${depaNumber}`).querySelector(`#num_dosi_ambiental_contrato_sede`)
                .setAttribute("name", `dosimetro_ambiental_sede${sedesNumber-1}[]`);

            document.getElementById(`depa${depaNumber}`).querySelector(`#num_dosi_caso_contrato_sede`)
                .setAttribute("name", `dosimetro_caso_sede${sedesNumber-1}[]`);

            document.getElementById(`depa${depaNumber}`).querySelector(`#num_dosi_ezclip_contrato_sede`)
                .setAttribute("name", `dosimetro_ezclip_sede${sedesNumber-1}[]`);

            depaNumber++;
            ///////////////
        }

        
        function readySede() {
            $(document).ready(function () {
                $(`#id_sede${sedesNumber-1}`).change(function () {
                    //alert('hi')
                    let sede_id = $(this).val();

                    if ($.trim(sede_id) != '') {
                        $.get('contratodosidepa', {sede_id: sede_id}, function (depas) {
                            console.log('departamentos', depas)
                            $('#departamento_sede').empty();
                            $('#departamento_sede').append("<option value=''> --SELECCIONE UN DEPARTAMENTO-- </option>");
                            $.each(JSON.parse(depas), function (index, value) {
                                $('#departamento_sede').append("<option value='" + value.id_departamentosede + "'>" + value.nombre_departamento + "</option>")
                            })
                        });
                    }
                });
            });
        }
            
        
    

        function deleteElement() {
            if(sedesNumber == 1){
            }else {
                sedesNumber--;
                if(sedesNumber >0) {
                    parentNode = document.getElementsByClassName('contenedorMoreSedes');
                    parentNodeLength = parentNode.length;
                    document.getElementById(`${sedesNumber}`).remove();
                }
            }
        }
        function deleteDepa() {
            console.log("hola")
            if(depaNumber ==1 ) {

            }else {
                depaNumber--;
                if(depaNumber>0) {
                    document.getElementById(`depa${depaNumber}`).remove();

                    //  document.getElementById('clonarDepto').remove();
                }
            }
        }
    </script>
</div>

