@extends('layouts.plantillabase')
@section('contenido')
    
    <div class="row">
        <div class="col"></div>
        <div class="col-11">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="infoEmpresas" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#empresa" role="tab" aria-controls="empresa" aria-selected="true">EMPRESA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="#sede" role="tab" aria-controls="sede" aria-selected="false">SEDES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#trabajador" role="tab" aria-controls="trabajador" aria-selected="false">TRABAJADORES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contacto" role="tab" aria-controls="contacto" aria-selected="false">CONTACTOS</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <!-- //////////////////// PESTAÑA DE EMPRESA //////////////// -->
                    <div class="tab-content mt-3">
                        <div class="tab-pane active" id="empresa" role="tabpanel">  
                            <h4 class="card-title text-center pt-3">{{$empresa->nombre_empresa}}</h4>
                            
                            <div class="table table-responsive p-4 ">
                                <table class="table table-bordered">
                                    <tbody >
                                        <tr>
                                            <th colspan="4" class="table-active text-center">EMPRESA</th>
                                        </tr>
                                        <tr>
                                            <th class="m-auto"style='width: 12.55%'>TIPO IDENTIFICACIÓN:</th>
                                            <td style='width: 18.55%'>{{$empresa->tipo_identificacion_empresa}}</td>
                                            <th style='width: 12.55%'>NÚMERO IDENTIFICACIÓN:</th>
                                            <td style='width: 20.55%'>{{$empresa->num_iden_empresa}} {{$empresa->DV}}</td>
                                        </tr>
                                        <tr>
                                            <th style='width: 12.55%'>ACTIVIDAD ECONÓMICA:</th>
                                            <td>{{$empresa->actividad_economica_empresa}}</td>
                                            <th style='width: 12.55%'>TIPO:</th>
                                            <td>{{$empresa->tipo_empresa}}</td>
                                        </tr>
                                        <tr>
                                            <th style='width: 12.55%'>RESPONSABILIDAD IVA:</th>
                                            <td>{{$empresa->respo_iva_empresa}}</td>
                                            <th style='width: 12.55%'>RESPONSABILIDAD FISCAL:</th>
                                            <td>{{$empresa->respo_fiscal_empresa}}</td>
                                        </tr>
                                        <tr>
                                            <th style='width: 12.55%'>TELÉFONO:</th>
                                            <td>{{$empresa->telefono_empresa}}</td>
                                            <th style='width: 12.55%'>CORREO ELECTRÓNICO:</th>
                                            <td>{{$empresa->email_empresa }}</td>
                                        </tr>
                                        <tr>
                                            <th style='width: 12.55%'>DIREECCIÓN:</th>
                                            <td>{{$empresa->direccion_empresa}}</td>
                                            <th style='width: 12.55%'>PAÍS:</th>
                                            <td>{{$empresa->pais_empresa}}</td>
                                        </tr>
                                        <tr>
                                            <th style='width: 12.55%'>MUNICIPIO:</th>
                                            <td>{{$empresa->municipios->nombre_municol}}</td>
                                            <th style='width: 12.55%'>DEPARTAMENTO:</th>
                                            <td>{{$empresa->municipios->coldepartamento->nombre_deptocol}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="table-active text-center">
                                                <div class="row">
                                                    <div class="col"></div>
                                                    <div class="col">
                                                        <a href="{{route('empresas.edit', $empresa->id_empresa)}}" class="btn colorQA btn-sm">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pen-fill mb-1" viewBox="0 0 16 16">
                                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                                            </svg> EDITAR
                                                        </a>
                                                    </div>
                                                    <div class="col">
                                                        <form id="form_eliminar_empresa" action="{{route('empresas.destroy', $empresa)}}" method="POST">
                                                            @csrf  
                                                            @method('delete')
                                                            <button class="btn btn-danger btn-sm" onclick="Eliminar(evt);" type="submit">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                                </svg>ELIMINAR
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="col"></div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>         
                        </div>
                        <!-- //////////////////// PESTAÑA DE SEDES //////////////// -->
                        <div class="tab-pane" id="sede" role="tabpanel" aria-labelledby="sede-tab">  
                            <div class="row">
                                <div class="col">
                                    <a href="{{route('sedes.create', $empresa->id_empresa)}}" class="btn colorQA btn-sm m-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus " viewBox="0 0 16 16">
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                        </svg> CREAR SEDE
                                    </a>
                                </div>
                                <div class="col"></div>
                            </div>
                            <h4 class="card-title text-center">SEDES SUBSCRITAS A LA EMPRESA: {{$empresa->nombre_empresa}}</h4>
                            
                            <div class="table table-responsive p-4 ">
                                <table class="table table-bordered">
                                    <thead class ="text-center">
                                        <tr>
                                            <th style='width: 12.60%'>SEDE</th>
                                            <th style='width: 15.55%'>MUNICIPIO</th>
                                            <th style='width: 9.55%'>DIRECCIÓN</th>
                                            <th style='width: 10.55%'>DEPARTAMENTOS</th>
                                            <th style='width: 9.55%'>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sede as $sed)
                                            <tr>
                                                <td>{{$sed->nombre_sede}}</td>
                                                <td>{{$sed->municipios->nombre_municol}} / {{$sed->municipios->coldepartamento->abreviatura_deptocol}}</td>
                                                <td>{{$sed->direccion_sede}}</td>
                                                <td class="text-center">
                                                    @php
                                                        $chek = 'inicial';
                                                    @endphp
                                                    @foreach($departamentos as $dep)
                                                        @php
                                                            if($dep->sede_id != $chek && $dep->sede_id == $sed->id_sede){
                                                                echo "{$dep->nombre_departamento}";
                                                                echo "<br>"; 
                                                                $check = strval($dep->sede_id);
                                                            }else{
                                                                echo " ";
                                                            }
                                                        @endphp
                                                    @endforeach 
                                                </td>
                                                <td class="text-center">
                                                    <div class="row">
                                                        <div class="col">
                                                            <a href="{{route('sedes.edit', $sed->id_sede)}}" class="btn colorQA btn-sm">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pen-fill mb-1" viewBox="0 0 16 16">
                                                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                        <div class="col">
                                                            <form id="form_eliminar_sede" name="form_eliminar_sede" action="{{route('sedes.destroy', $sed)}}" method="POST">
                                                                @csrf  
                                                                @method('delete')
                                                                <button class="btn btn-danger btn-sm" onclick="Eliminar(evt);" type="submit">
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
                        <!-- //////////////////// PESTAÑA DE TRABAJADORES //////////////// -->
                        <div class="tab-pane" id="trabajador" role="tabpanel" aria-labelledby="trabajador-tab">
                            <div class="row">
                                <div class="col">
                                    <a href="{{route('trabajadores.create', $empresa->id_empresa)}}" class="btn colorQA btn-sm m-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                        </svg> CREAR TRABAJADOR
                                    </a>
                                </div>
                                <div class="col"></div>
                            </div>
                            <h4 class="card-title text-center">TRABAJADORES SUBSCRITOS A LA EMPRESA: {{$empresa->nombre_empresa}}</h4>
                            <br></br>
                            @php
                                $check = 'inicial';
                            @endphp 
                            @foreach($trabajador as $trab)
                                @php
                                    if($trab->nombre_sede != $check ){
                                        echo "<table class='table table-hover table-bordered px-4'>";
                                            echo "<h4 class='card-title text-center'>{$trab->nombre_sede}</h4>";  
                                            $check = strval($trab->nombre_sede);
                                            echo "<thead class='table-active text-center'>";    
                                                echo "<th style='width: 20.60%'>TRABAJADOR</th>";
                                                echo "<th style='width: 11.60%'>TIPO IDEN.</th>";
                                                echo "<th>No. IDEN.</th>";    
                                                echo "<th>GÉNERO</th>";
                                                echo "<th>EMAIL</th>";
                                                echo "<th>TELEFONO</th>";
                                                echo "<th style='width: 6.60%'>PERFIL LABORAL</th>";
                                                echo "<th style='width: 6.60%'>ACTIVO EN</th>";
                                                echo "<th style='width: 12.60%'>ACCIONES</th>";
                                            echo "</thead>";
                                    }
                                @endphp
                                    
                                <tr>
                                    <td>{{$trab->primer_nombre_trabajador}} {{$trab->segundo_nombre_trabajador}} {{$trab->primer_apellido_trabajador}} {{$trab->segundo_apellido_trabajador}}</td>
                                    <td>{{$trab->tipo_iden_trabajador}}</td>
                                    <td>{{$trab->cedula_trabajador}}</td>
                                    <td>{{$trab->genero_trabajador}}</td>
                                    <td>{{$trab->email_trabajador}}</td>
                                    <td>{{$trab->telefono_trabajador}}</td>
                                    <td>{{$trab->tipo_trabajador}}</td>
                                    <td>@if($trab->aula_virtual == "ON")
                                        A.VIRUTAL 
                                        @endif
                                        @if($trab->dosimetria == "ON")
                                        DOSIMETRÍA
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col">
                                                <a href="{{route('trabajadores.edit', $trab->id_trabajador)}}" class="btn colorQA">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="col">
                                                <form id="form_eliminar_trabajador" name="form_eliminar_trabajador" action="{{route('trabajadores.destroy', $trab)}}" method="POST">
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
                            </table>
                           
                        </div>
                        <!-- //////////////////// PESTAÑA DE CONTACTOS //////////////// -->
                        <div class="tab-pane" id="contacto" role="tabpanel" aria-labelledby="contacto-tab">
                            <div class="row">
                                <div class="col">
                                    <a href="{{route('contactos.create', $empresa->id_empresa)}}" class="btn colorQA btn-sm m-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                        </svg> CREAR CONTACTO
                                    </a>
                                </div>
                                <div class="col"></div>
                            </div>
                            <h4 class="card-title text-center">CONTACTOS SUBSCRITOS A LA EMPRESA: {{$empresa->nombre_empresa}}</h4>
                            @php
                                $check2 = 'inicial';
                            @endphp 
                            @foreach($contacto as $cont)
                                @php
                                    if($cont->nombre_sede != $check2 ){
                                        echo "<table class='table table-hover table-bordered px-4'>";
                                            echo "<h4 class='card-title text-center pt-3'>{$cont->nombre_sede}</h4>";
                                            $check2 = strval($cont->nombre_sede);
                                            echo "<thead class='table-active text-center'>";    
                                                echo "<th style='width: 20.60%'>CONTACTO</th>";
                                                echo "<th style='width: 10.60%'>TIPO IDEN.</th>";
                                                echo "<th >N. IDEN</th>";    
                                                echo "<th>GÉNERO</th>";
                                                echo "<th style='width: 15.60%'>EMAIL</th>";
                                                echo "<th style='width: 9.60%'>TELEFONO</th>";
                                                echo "<th>PERFIL LABORAL</th>";
                                                echo "<th style='width: 11.10%'>ACCIONES</th>";
                                            echo "</thead>";
                                    }
                                @endphp
                                <tr>
                                    <td>{{$cont->primer_nombre_contacto}} {{$cont->segundo_nombre_contacto}} {{$cont->primer_apellido_contacto}} {{$cont->segundo_apellido_contacto}}</td>
                                    <td>{{$cont->tipo_iden_contacto}}</td>
                                    <td>{{$cont->cedula_contacto}}</td>
                                    <td>{{$cont->genero_contacto}}</td>
                                    <td>{{$cont->correo_contacto}}</td>
                                    <td>{{$cont->telefono_contacto}}</td>
                                    <td>
                                        {{$cont->profesion_contacto}}
                                        <br> 
                                        @if($cont->lider_ava == 'TRUE')
                                            <B>(LIDER A. VIRTUAL)</B>
                                            <br>
                                        @endif
                                        @if($cont->lider_dosimetria == 'TRUE')
                                            <B>(LIDER DOSIMETRÍA)</B>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col">
                                                <a href="{{route('contactos.edit', $cont->id_contacto)}}" class="btn colorQA">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="col">
                                                <form id="form_eliminar_contacto" name="form_eliminar_contacto" action="{{route('contactos.destroy', $cont)}}" method="POST">
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
                            </div>
                            @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>
<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous">
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script type="text/javascript">
    $(document).ready(function(){

        $('#infoEmpresas a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })

        $('#form_eliminar_empresa').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "SEGURO QUE DESEA ELIMINAR ESTA EMPRESA??",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI!'
                }).then((result) => {
                if (result.isConfirmed) {
                   /*  Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    ) */
                    this.submit();
                }
            })
        })
        $('#form_eliminar_sede').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "SEGURO QUE DESEA ELIMINAR ESTA SEDE??",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI!'
                }).then((result) => {
                if (result.isConfirmed) {
                   /*  Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    ) */
                    this.submit();
                }
            })
        })
        
        $('#form_eliminar_trabajador').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "SEGURO QUE DESEA ELIMINAR ESTE TRABAJADOR??",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI!'
                }).then((result) => {
                if (result.isConfirmed) {
                   /*  Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    ) */
                    this.submit();
                }
            })
        })
        $('#form_eliminar_contacto').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "SEGURO QUE DESEA ELIMINAR ESTE CONTACTO??",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI!'
                }).then((result) => {
                if (result.isConfirmed) {
                   /*  Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    ) */
                    this.submit();
                }
            })
        })
    })
</script>
@endsection()