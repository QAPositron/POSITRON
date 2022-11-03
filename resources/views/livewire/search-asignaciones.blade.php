<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="row">
        <div class="col-md "></div>
        <div class="col-md-9 ">
            <h2 class="text-center">REVISIÓN DE SALIDA GENERAL PARA DOSÍMETROS ASIGNADOS</h2>
        </div>
        <div class="col-md text-center"></div>
    </div>
    <br>
    <div class="row">
        <div class="col-md"></div>
        <div class="col-md-7">
            <div class="card text-dark bg-light">
                <div class="row">
                    <div class="col-md"></div>
                    <div class="col-md">
                        <div class="form-group">
                            <h5 class="pt-4 text-center">EMPRESA </h5>
                            <select class="form-select" wire:model="empresa" name="empresa_dosi" id="empresa_dosi" autofocus >
                                <option value="NULL">--SELECCIONE--</option>
                                @forEach($empresasDosi as $empresas)
                                    <option value ="{{$empresas->nombre_empresa}}">{{$empresas->nombre_empresa}}</option>
                                @endforeach
                            </select>
                            {{$empresa}}
                        </div>
                        
                    </div>
                    <div class="col-md"></div>
                </div>
                <div class="row">
                    
                    <div class="col-md m-3">
                        <h5 class="pt-4 text-center">CÓDIGO DE LA ETIQUETA </h5>
                        <br>
                        <input class="form-control" wire:model="search" type="number" name="codigo_etiqueta" id="codigo_etiqueta" >
                    </div>
                    <div class="col-md m-3">
                        <h5 class="pt-4 text-center">CÓDIGO DEL DOSÍMETRO </h5>
                        <br>
                        <input class="form-control" wire:model="dosimetro" type="number" name="codigo_dosimetro" id="codigo_dosimetro" >
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md"></div>
                    <div class="col-md">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="dosi_control" name="dosi_control">
                            <label class="form-check-label" for="defaultCheck1">    
                                DOSIMETRO DE CONTROL
                            </label>
                        </div>
                    </div>
                    <div class="col-md"></div>
                </div>
                <br>
            </div>
        </div>
        <div class="col-md text-center">
            @if( $empresa == '' || $empresa == 'NULL')
                <a type="button" class="btn btn-circle " onclick="return false"  style="background-color: #a0aec0" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-file-earmark-pdf pt-1" viewBox="0 0 16 16">
                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                        <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
                    </svg>
                </a>
            @else
                <a type="button" class="btn btn-circle colorQA"  href="{{route('certificadorevision.pdf', ['empresa'=>$empresa, 'deptodosi' => 0, 'mesnumber' => 0])}}" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-file-earmark-pdf pt-1" viewBox="0 0 16 16">
                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                        <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
                    </svg>
                </a>
            @endif
            <br>
            CERTIFICADO
        </div>
    </div>
    <br>
    
    <br>
    <div class="row">
        <div class="col-7 px-1">
           
            
            <h4 class="text-center">INFORMACIÓN DE TODAS LAS ASIGNACIONES</h4>
            <div class="table table-responsive p-2">
                <table class="table table-bordered asignaciones" id="tablaAsignaciones" style="font-size: 12px;">
                    <thead>
                        <tr class="table-active text-center">
                            <th class='align-middle py-4'>TRABAJADOR</th>
                            <th class='align-middle py-4' >DOSÍM.</th>
                            <th class='align-middle py-4' >HOLDER</th>
                            <th class='align-middle py-4' >UBICACIÓN</th>
                            <th class='align-middle py-4' >MES</th>
                            <th class='align-middle py-4' >CONTRATO</th>
                            <th class='align-middle py-4' >SEDE</th>
                            <th class='align-middle py-4' >ESP.</th>
                        </tr>
                    </thead>
                    <tbody id="asignaciones">
                        @if(count($trabajdosiasig) == 0 || $empresa == 'NULL')
                            <tr>
                                <td colspan ="8" class='align-middle text-center'>NO HAY REGISTROS</td>
                            </tr>
                        @else
                            @foreach($trabajdosiasig as $trab)
                                <tr id="{{$trab->id_trabajadordosimetro}}">
                                    <td class='align-middle' @if($trab->dosimetro_uso == 'FALSE') style="color:red;" @endif>{{$trab->primer_nombre_persona}} {{$trab->segundo_nombre_persona}} {{$trab->primer_apellido_persona}} {{$trab->segundo_apellido_persona}}</td>
                                    <td class='align-middle text-center' @if($trab->dosimetro_uso == 'FALSE') style="color:red;" @endif>{{$trab->codigo_dosimeter}}</td>
                                    <td class='align-middle text-center' @if($trab->dosimetro_uso == 'FALSE') style="color:red;" @endif>
                                        @if($trab->holder_id == '')
                                            N.A.
                                        @else
                                            {{$trab->codigo_holder}}
                                        @endif
                                    </td>
                                    <td class='align-middle text-center' @if($trab->dosimetro_uso == 'FALSE') style="color:red;" @endif>{{$trab->ubicacion}}</td>
                                    <td id="mes{{$trab->codigo_dosimeter}}" class='align-middle text-center' @if($trab->dosimetro_uso == 'FALSE') style="color:red;" @endif>
                                        
                                    </td>
                                    <td class='align-middle text-center' @if($trab->dosimetro_uso == 'FALSE') style="color:red;" @endif>{{$trab->codigo_contrato}}</td>
                                    <td class='align-middle text-center' @if($trab->dosimetro_uso == 'FALSE') style="color:red;" @endif>{{$trab->nombre_sede}}</td>
                                    <td class='align-middle text-center' @if($trab->dosimetro_uso == 'FALSE') style="color:red;" @endif>{{$trab->nombre_departamento}}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <br>
            <br>
            <h4 class="text-center">INFORMACIÓN DE TODAS LAS ASIGNACIONES DE DOSÍMETRO CONTROL</h4>
            <div class="table table-responsive p-4 m-1">
                <table class="table table-bordered asignacionesControl" style="font-size: 13px;">
                    <thead>
                        <tr class="table-active text-center">
                            <th class='align-middle py-4' style="width: 10%;">CONTROL</th>
                            <th class='align-middle py-4' >DOSÍMETRO</th>
                            <th class='align-middle py-4' >CONTRATO</th>
                            <th class='align-middle py-4' >MES</th>
                            <th class='align-middle py-4' >SEDE</th>
                            <th class='align-middle py-4' >ESPECIALIDAD</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($dosicontrol) == 0)
                            <tr>
                                <td colspan ="6" class='align-middle text-center'>NO HAY REGISTROS</td>
                            </tr>
                        @else
                            @foreach($dosicontrol as $dosicont)
                                <tr id="{{$dosicont->id_dosicontrolcontdosisedes}}">
                                    <td class='align-middle text-center' @if($dosicont->dosimetro_uso == 'FALSE') style="color:red;" @endif>CONTROL</td>
                                    <td class='align-middle text-center' @if($dosicont->dosimetro_uso == 'FALSE') style="color:red;" @endif>{{$dosicont->codigo_dosimeter}}</td>
                                    <td class='align-middle text-center' @if($dosicont->dosimetro_uso == 'FALSE') style="color:red;" @endif>{{$dosicont->codigo_contrato}}</td>
                                    <td id="mes{{$dosicont->codigo_dosimeter}}" class='align-middle text-center' @if($dosicont->dosimetro_uso == 'FALSE') style="color:red;" @endif>
                                    
                                    </td>
                                    <td class='align-middle text-center' @if($dosicont->dosimetro_uso == 'FALSE') style="color:red;" @endif>{{$dosicont->nombre_sede}}</td>
                                    <td class='align-middle text-center' @if($dosicont->dosimetro_uso == 'FALSE') style="color:red;" @endif>{{$dosicont->nombre_departamento}}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>    
            
                
        </div>

        <div class="col-5">
            
            <div class="row">
                <div class="col"></div>
                <div class="col-8">
                    <h4 class="text-center">ASIGNACIONES REVISADAS</h4> 
                </div>
                <div class="col">
                    <a type="button" class="btn btn-sm colorQA" wire:click="limpiar">
                        LIMPIAR
                    </a>
                </div>
            </div>
            <div class="table table-responsive pt-2">
                <table class="table table-bordered" style="font-size: 12px;">
                    <thead>
                        <tr class="table-active text-center ">
                            <th class='align-middle py-4' >TRABAJADOR</th>
                            <th class='align-middle py-4' >DOSÍMETRO</th>
                            <th class='align-middle py-4' >UBICACIÓN</th>
                            <th class='align-middle py-4' >MES</th>
                            <th class='align-middle py-4' >CONTRATO</th>
                            <th class='align-middle py-4' >SEDE</th>
                            <th class='align-middle py-4' >ESP.</th>
                            <th class='align-middle py-4' >ACC.</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_asignacionesok">
                        @foreach($temptrabajdosimrev as $temptrab)
                            <tr id="{{$temptrab->id_temptrabajdosimrev}}">
                                <td class='align-middle' @if($temptrab->dosimetro_uso == 'FALSE') style="color:red;" @endif>@if(!empty($temptrab->persona->primer_nombre_persona)){{$temptrab->persona->primer_nombre_persona}} {{$temptrab->persona->segundo_nombre_persona}} {{$temptrab->persona->primer_apellido_persona}} {{$temptrab->persona->segundo_apellido_persona}} @else CONTROL @endif</td>
                                <td class='align-middle text-center' @if($temptrab->dosimetro_uso == 'FALSE') style="color:red;" @endif>{{$temptrab->dosimetro->codigo_dosimeter}}</td>
                                <td class='align-middle text-center' @if($temptrab->dosimetro_uso == 'FALSE') style="color:red;" @endif>@if(!empty($temptrab->ubicacion)) {{$temptrab->ubicacion}} @else N.A. @endif</td>
                                <td class='align-middle text-center' @if($temptrab->dosimetro_uso == 'FALSE') style="color:red;" @endif>{{$temptrab->mes_asignacion}}</td>
                                <td class='align-middle text-center' @if($temptrab->dosimetro_uso == 'FALSE') style="color:red;" @endif>{{$temptrab->contratodosimetriasede->dosimetriacontrato->codigo_contrato}}</td>
                                <td class='align-middle text-center' @if($temptrab->dosimetro_uso == 'FALSE') style="color:red;" @endif>{{$temptrab->contratodosimetriasede->sede->nombre_sede}}</td>
                                <td class='align-middle text-center' @if($temptrab->dosimetro_uso == 'FALSE') style="color:red;" @endif>{{$temptrab->contratodosimetriasededepto->departamentosede->nombre_departamento}}</td>
                                <td class='align-middle text-center'>
                                    <button class="btn btn-sm btn-danger" @if(!empty($temptrab->persona->primer_nombre_persona)) onclick="eliminar({{$temptrab->trabajcontdosimetro_id }}, 0)" @else onclick="eliminar({{$temptrab->trabajcontdosimetro_id }}, 1)" @endif>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                          </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            
        </div>
        
    </div>
</div>
<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous">
</script>
<script type="text/javascript">

    $(document).ready( function () {
        $('#empresa_dosi').on('change', function(){
            var empresa = document.querySelector('#empresa_dosi').value;
            console.log(empresa);
            if(empresa == 'NULL'){
                $('#tablaAsignaciones').detach();
            }
        })
        // Creamos array con los meses del año
        var meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
        
        Livewire.on('mesesTrab', function(trabajdosiasig){ 
           
            trabajdosiasig.forEach(function (element){
                var fecha = new Date(element.fecha_inicio);
                var fechaHora = new Date(fecha.getFullYear(), fecha.getMonth(), fecha.getDate()+1, 0, 0, 0, 0);
                console.log("ESTA ES LA FECHA HORA" + fechaHora);
                
                for($i=0; $i<=11; $i++){
                    var r = new Date(new Date(fechaHora).setMonth(fechaHora.getMonth()+$i));
                    var fechaesp = meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                    if(element.mes_asignacion == ($i+1)){
                        console.log(r + fechaesp + "ESTA ES LA I"+($i+1)); 
                        console.log("ESTOS SON LOS MESES EN LAS ASIGNACIONES" +element.primer_nombre_persona +element.mes_asignacion);
                        document.getElementById('mes'+element.codigo_dosimeter).innerHTML = fechaesp;
                    } 
                } 
            });
            
            
        });
        Livewire.on('mesesCont', function(dosicontrol){
            dosicontrol.forEach(function (element){
                var fecha = new Date(element.fecha_inicio);
                var fechaHora = new Date(fecha.getFullYear(), fecha.getMonth(), fecha.getDate()+1, 0, 0, 0, 0);
                console.log("ESTA ES LA FECHA HORA CONTROL" + fechaHora);
                
                for($i=0; $i<=11; $i++){
                    var r = new Date(new Date(fechaHora).setMonth(fechaHora.getMonth()+$i));
                    var fechaesp = meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                    if(element.mes_asignacion == ($i+1)){
                        console.log(r + fechaesp + "ESTA ES LA I"+($i+1)); 
                        console.log("ESTOS SON LOS MESES EN LAS ASIGNACIONES" +element.mes_asignacion);
                        document.getElementById('mes'+element.codigo_dosimeter).innerHTML = fechaesp;
                    } 
                } 
            });
            
        });

        $('#dosi_control').on('change', function(){
            var codigoEtiq = document.querySelector('#codigo_etiqueta').value;
            const js = document.querySelector('#dosi_control').checked;
            console.log("ESTADO INICIAL"+js);
            console.log("codigo etiqueta con checkbox estado inicial"+codigoEtiq+js);
            
            if(js){
                consultarDosiControl();
            }else{
                consultarTrabDosi();
            }
        })
        function consultarTrabDosi(codigoEtiq){
            console.log("ENTRO A TRABAJADORES");
            var codigoDosi = document.getElementById('codigo_dosimetro').value; 
            
            if(codigoDosi != ''){
                $.get('dosimetro',{codigo_dosi : codigoDosi}, function(dosimetro){
                    console.log(dosimetro);
                    if(dosimetro.length != 0){
                        var check = 0;
                        console.log(check); 
                        console.log("ESTE ES EL CODIGO DOSIMETRO" + codigoDosi);
                        console.log("ESTE ES EL CODIGO ETIQUETA" + codigoEtiq);
                        var empresa = @this.empresa;
                        $.get('asignaciones',{empresa : empresa}, function(asignaciones){
                            console.log(asignaciones);
                            asignaciones.forEach(function (element){
                                if(codigoEtiq == codigoDosi && codigoDosi == element.codigo_dosimeter && check == 0){
                                    check = 1;
                                    Livewire.emit('MATCH', element.id_trabajadordosimetro);
                                    console.log("SI SE HIZO MATCH");
                                    Livewire.on('alert', function(message){
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'CORRECTO!!',
                                            text: message,
                                            showConfirmButton: false,
                                            timer: 4000
                                        });
                                    });
                                }
                            });
                            console.log("ESTE ES EL CHECK" +check);
    
                            if(check == 0){
                                console.log("NO SE HIZO MATCH");
                                Livewire.emit('NOMATCH');
                                Livewire.on('alert', function(message){
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'ERROR!!',
                                        text: message,
                                        showConfirmButton: false,
                                        timer: 4000
                                    });
                                })
                                
                                
                            }
                        });
  
                    }else{
                        
                        Livewire.emit('NOEXISTE');
                        console.log("NO EXISTE");
                        Livewire.on('alert', function(message){
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!!',
                                text: message,
                                showConfirmButton: false,
                                timer: 4000
                            });
                        })
                        
                    }
                });
                
            }
        };
        function consultarDosiControl(codigoEtiq){
            console.log("ENTRO A CONTROLES");
            var codigoDosi = document.getElementById('codigo_dosimetro').value; 
            console.log(codigoDosi);
            if(codigoDosi != ''){
                $.get('dosimetro',{codigo_dosi : codigoDosi}, function(dosimetro){
                    console.log(dosimetro);
                    if(dosimetro.length != 0){
                        var check = 0;
                        console.log(check);
                        console.log("ESTE ES EL CODIGO DOSIMETRO" + codigoDosi);
                        console.log("ESTE ES EL CODIGO ETIQUETA" + codigoEtiq);
                        var empresa = @this.empresa;
                        $.get('asignacionesControl',{empresa : empresa}, function(asignacionescontrol){
                            console.log(asignacionescontrol);
                            asignacionescontrol.forEach(function (element){
                                if(codigoEtiq == codigoDosi && codigoDosi == element.codigo_dosimeter && check == 0){
                                    check = 1;
                                    Livewire.emit('MATCHCONTROL', element.id_dosicontrolcontdosisedes);
                                    console.log("SI SE HIZO MATCH CONTROL");
                                    Livewire.on('alert', function(message){
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'CORRECTO!!',
                                            text: message,
                                            showConfirmButton: false,
                                            timer: 4000
                                        });
                                    });
                                }
                            });
                            console.log("ESTE ES EL CHECK" +check);
    
                            if(check == 0){
                                console.log("NO SE HIZO MATCH CONTROL");
                                Livewire.emit('NOMATCH');
                                Livewire.on('alert', function(message){
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'ERROR!!',
                                        text: message,
                                        showConfirmButton: false,
                                        timer: 4000
                                    });
                                })
                                
                                
                            }
                        })
                       
                    }else{
                        
                        Livewire.emit('NOEXISTE');
                        console.log("NO EXISTE");
                        Livewire.on('alert', function(message){
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!!',
                                text: message,
                                showConfirmButton: false,
                                timer: 4000
                            });
                        })
                        
                    }
                    
                });
            }
        };
        $('#codigo_etiqueta').on('change', function(){
            var codigoEtiq = document.querySelector('#codigo_etiqueta').value;
            const js = document.querySelector('#dosi_control').checked;
            console.log("ESTADO INICIAL"+js);
            console.log("codigo etiqueta con checkbox estado inicial"+codigoEtiq+js);
            console.log('CODIGO ETIQUETA' + codigoEtiq);
            document.getElementById("codigo_dosimetro").value = "";
            
            if(js){
                console.log("ESTTRO AL IF TRUE");
                consultarDosiControl(codigoEtiq);
            }else{
                consultarTrabDosi(codigoEtiq);
            }
            
            
            console.log("SALIO DEL CHANGE DE LA FUNCION CODIGO ETIQUETA");
           
        });
        $('#codigo_dosimetro').on('change', function(){
            var codigoEtiq = document.querySelector('#codigo_etiqueta').value;
            const js = document.querySelector('#dosi_control').checked;
            console.log("ESTADO INICIAL"+js);
            console.log("codigo dosimetro con checkbox estado inicial"+codigoEtiq+js);
            document.querySelector('#dosi_control').disabled= true;
            if(js){
                consultarDosiControl(codigoEtiq);
            }else{
                consultarTrabDosi(codigoEtiq);
            }
            /* consultarTrabDosi(codigoEtiq); */
            console.log("SALIO DEL CHANGE DE LA FUNCION CODIGO DOSIMETRO NORMAL");
            
        });

        
    })
    function eliminar(id, control) {
        console.log(id);
        console.log(control);
        Swal.fire({
            text: "SEGURO QUE DESEA ELIMINAR ESTA REVISION??",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, SEGURO!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('ELIMINAR', id, control);
                    Livewire.on('alert', function(message){
                        Swal.fire({
                            icon: 'success',
                            title: 'CORRECTO!!',
                            text: message,
                            showConfirmButton: false,
                            timer: 4000
                        });
                    })
                }
            })
        
    }

</script>