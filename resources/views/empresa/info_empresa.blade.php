@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')

{{---------------- TOCO CAMBIARLE EL NOMBRE A "DEPARTAMENTOS" POR "ESPECIALIDADES 
que son las distintas especialidades que tiene la empresa como odontologia, oncologia, etc," ------------}}
    <a type="button" class="btn btn-circle colorQA ir-arriba">
        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-arrow-up mt-1" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
        </svg>
    </a>
    <div class="row">
        <div class="col"></div>
        <div class="col-12">
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
                            <a class="nav-link" href="#trabajador" role="tab" aria-controls="trabajador" aria-selected="false">TRABAJADORES DOSIMETRÍA </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#estudiante" role="tab" aria-controls="estudiante" aria-selected="false">ESTUDIANTES A. VIRTUAL </a>
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
                            <h3 class="card-title text-center pt-3"><i>{{$empresa->razon_social_empresa}}</i></h3>
                            
                            <div class="table table-responsive p-4 ">
                                <table class="table table-bordered">
                                    <tbody >
                                        <tr>
                                            <th colspan="4" class="table-active text-center align-middle">{{$empresa->nombre_empresa}}</th>
                                        </tr>
                                        <tr>
                                            <th class="m-auto align-middle" style='width: 12.55%'>TIPO IDENTIFICACIÓN:</th>
                                            <td class="align-middle" style='width: 18.55%'>{{$empresa->tipo_identificacion_empresa}}</td>
                                            <th class="align-middle" style='width: 12.55%'>NÚMERO IDENTIFICACIÓN:</th>
                                            <td class="align-middle" style='width: 14.55%'>{{$empresa->num_iden_empresa}} {{$empresa->DV}}</td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle" style='width: 12.55%'>ACTIVIDAD ECONÓMICA:</th>
                                            <td class="align-middle">{{$empresa->actividad_economica_empresa}}</td>
                                            <th class="align-middle" style='width: 12.55%'>TIPO:</th>
                                            <td class="align-middle">{{$empresa->tipo_empresa}}</td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle" style='width: 12.55%'>RESPONSABILIDAD IVA:</th>
                                            <td class="align-middle">{{$empresa->respo_iva_empresa}}</td>
                                            <th class="align-middle" style='width: 12.55%'>RESPONSABILIDAD FISCAL:</th>
                                            <td class="align-middle">{{$empresa->respo_fiscal_empresa}}</td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle" style='width: 12.55%'>TELÉFONO:</th>
                                            <td class="align-middle">{{$empresa->telefono_empresa}}</td>
                                            <th class="align-middle" style='width: 12.55%'>CORREO ELECTRÓNICO:</th>
                                            <td class="align-middle">{{$empresa->email_empresa }}</td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle" style='width: 12.55%'>DIREECCIÓN:</th>
                                            <td class="align-middle">{{$empresa->direccion_empresa}}</td>
                                            <th class="align-middle" style='width: 12.55%'>PAÍS:</th>
                                            <td class="align-middle">{{$empresa->pais_empresa}}</td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle" style='width: 12.55%'>MUNICIPIO:</th>
                                            <td class="align-middle">{{$empresa->municipios->nombre_municol}}</td>
                                            <th class="align-middle" style='width: 12.55%'>DEPARTAMENTO:</th>
                                            <td class="align-middle">{{$empresa->municipios->coldepartamento->nombre_deptocol}}</td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle" style='width: 12.55%'>REPRESENTANTE LEGAL:</th>
                                            <td class="align-middle">{{$empresa->nombre_representantelegal}}</td>
                                            <th class="align-middle" style='width: 12.55%'>TIPO IDEN. REPR.LEGAL:</th>
                                            <td class="align-middle">{{$empresa->tipo_iden_representantelegal}}</td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle" style='width: 12.55%'>NÚMERO IDEN. REPR. LEGAL:</th>
                                            <td class="align-middle">{{$empresa->cedula_representantelegal}}</td>
                                            <th class="align-middle" style='width: 12.55%'></th>
                                            <td class="align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="table-active text-center align-middle">
                                                <div class="row align-items-center">
                                                    <div class="col"></div>
                                                    <div class="col">
                                                        <a href="{{route('empresas.edit', $empresa->id_empresa)}}" class="btn colorQA btn-sm">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill mb-1" viewBox="0 0 16 16">
                                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                            </svg> EDITAR
                                                        </a>
                                                    </div>
                                                    <div class="col">
                                                        <form id="form_eliminar_empresa" action="{{route('empresas.destroy', $empresa)}}" method="POST" class="mb-1">
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
                            <div class="row">
                                <div class="col"></div>
                                <div class="col-9">
                                    <h3 class="card-title text-center">SEDES SUBSCRITAS A LA EMPRESA: <br> <i>{{$empresa->nombre_empresa}}</i> </h3>
                                        <br>
                                        @php
                                            $check = 'inicial';
                                        @endphp
                                        @foreach($sede as $sed)
                                            @php
                                                if($sed->nombre_sede != $check){
                                                    echo "<table class='table table-bordered x-4'>";
                                                        echo "<h4 class='card-title text-center' id='sede_id' name='sede_id'>{$sed->nombre_sede}</h4>";  
                                                        $check = strval($sed->nombre_sede);
                                                        echo "<thead class='table-active text-center'>";
                                                            echo  "<tr>";
                                                                echo "<th rowspan='2' class='align-middle'>MUNICIPIO</th>";
                                                                echo "<th rowspan='2' class='align-middle'>DIRECCIÓN</th>";
                                                                echo "<th colspan='3' class='align-middle'>ESPECIALIDADES</th>";
                                                                echo "<th rowspan='2' class='align-middle' style='width: 14.60%'>ACCIONES</th>";
                                                            echo "</tr>";
                                                            echo "<tr>";
                                                                echo "<th class='align-middle' style='font-size:13px; width: 10.50%;'>NOMBRE</th>";
                                                                echo "<th class='align-middle' style='font-size:13px;'>ELIMINAR <br> ESP.</th>";
                                                                echo "<th class='align-middle' style='font-size:13px;'>CREAR <br> ÁREA</th>";
                                                            echo "</tr>";
                                                        echo "</thead>";
                                                }
                                            @endphp
                                            <tr>
                                                <td class="text-center align-middle">{{$sed->municipios->nombre_municol}} / {{$sed->municipios->coldepartamento->abreviatura_deptocol}}</td>  
                                                <td class="text-center align-middle">{{$sed->direccion_sede}}</td>
                                                <td colspan="3" class="text-center align-middle">
                                                    @foreach($departamentos as $dep) 
                                                        @php
                                                            $chek = 'inicial';
                                                        @endphp
                                                        <?php
                                                            if($dep->sede_id != $chek && $dep->sede_id == $sed->id_sede){
                                                        ?>
                                                                <div class='row'>
                                                                    <div class='col-md p-1'>
                                                                        {{$dep->nombre_departamento}}
                                                                    </div>
                                                                    <div class='col-md p-1'>
                                                                        <form id="eliminar_depto" name="eliminar_depto" class="eliminar_depto" action="{{route('sedesdepto.destroydepa', ['empresa'=>$empresa->id_empresa, 'depto' =>$dep->id_departamentosede])}}" method="POST">
                                                                            @csrf  
                                                                            @method('delete')
                                                                            
                                                                            <button class="btn btn-danger btn-sm" type="submit">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-x-lg mb-1" viewBox="0 0 16 16">
                                                                                    <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                                                                                    <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                                                                                </svg>
                                                                            </button>
                                                                        </form>
                                                                        
                                                                        <?php
                                                                            $check = strval($dep->sede_id);
                                                                        ?>
                                                                    </div>
                                                                    <div class="col-md p-1">
                                                                        <button class="btn colorQA btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#nuevaAreaModal" onclick="capturar('{{$sed->nombre_sede}}', '{{$dep->id_departamentosede}}' , '{{$dep->nombre_departamento}}')">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-plus-lg mb-1" viewBox="0 0 16 16">
                                                                                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                                                                            </svg>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                        <?php        
                                                            }else{
                                                                echo " ";
                                                            }
                                                        ?>    
                                                    @endforeach
                                                </td>
                                                <td class="text-center align-middle">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <a href="{{route('sedes.edit', $sed->id_sede)}}" class="btn btn-sm colorQA">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pencil-fill mb-1" viewBox="0 0 16 16">
                                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                        <div class="col">
                                                            <form id="form_eliminar_sede" name="form_eliminar_sede" class="form_eliminar_sede mb-1" action="{{route('sedes.destroy', $sed)}}" method="POST">
                                                                @csrf  
                                                                @method('delete')
                                                                <button class="btn btn-sm btn-danger" type="submit">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" class="px-5">
                                                   
                                                    @php
                                                        $anterior = 'inicio';
                                                        $checke = '0';
                                                    @endphp
                                                    @foreach($areadeptos as $areas)
                                                        @if($areas->nombre_sede == $sed->nombre_sede)
                                                            <?php
                                                                if($areas->id_departamentosede != $anterior){

                                                                    echo "<table class='table table-bordered'>";
                                                                        echo "<thead class='table-secondary text-center'>";
                                                                            echo "<tr>";
                                                                                echo "<th colspan='3'>ESPECIALIDAD: {$areas->nombre_departamento}</th>";
                                                                                $anterior = $areas->id_departamentosede;
                                                                            echo"</tr>";
                                                                            echo "<tr>";
                                                                                echo "<th style='width: 24.60%'>ÁREA</th>";
                                                                                echo "<th>DESCRIPCION</th>";
                                                                                echo "<th style='width: 16.60%'>ACCIONES</th>";
                                                                            echo "</tr>";
                                                                        echo "</thead>";
                                                                        echo "<tbody>";
                                                                            $area = 'inicio';
                                                                            foreach ($areadeptos as $key => $areadep) {
                                                                                if($areadep->departamentosede_id == $anterior && $areadep->id_areadepartamentosede != $area){
                                                                                    $id_area = 'vacio';
                                                                            ?>    
                                                                                    <tr>
                                                                                        <td>{{$areadep->nombre_area}}</td>
                                                                                        <td>{{$areadep->descripcion}}</td>
                                                                                        <td class="text-center">
                                                                                            <div class="row">
                                                                                                <div class="col">

                                                                                                    <button class="btn colorQA btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#editAreaModal" onclick="capturarEdit('{{$sed->nombre_sede}}', '{{$areadep->id_areadepartamentosede}}', '{{$areadep->departamentosede_id}}' , '{{$areadep->nombre_departamento}}' , '{{$areadep->nombre_area}}' , '{{$areadep->descripcion}}')">
                                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill mb-1" viewBox="0 0 16 16">
                                                                                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                                                                        </svg>
                                                                                                    </button>
                                                                                                    <div class="modal fade" id="editAreaModal" tabindex="-1" aria-labelledby="editAreaModalLabel" aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-dialog-centered">
                                                                                                            <div class="modal-content">
                                                                                                                <div class="modal-header">
                                                                                                                    <h5 class="modal-title w-100 text-center"  name="editAreaModalLabel" id="editAreaModalLabel">EDITAR ÁREA</h5>
                                                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                                                </div>

                                                                                                                <form  id="form_edit_areadepartamento" name="form_edit_areadepartamento" class="form_edit_areadepartamento" action="{{route('areadepto.update', $areadep)}}" method="POST">
                                                                                                                    @csrf
                                                                                                                    @method('put')
                                                                                                                    <div class="modal-body">
                                                                                                                        <div class="row">
                                                                                                                            <div class="col-md">
                                                                                                                                <label class="text-center" for="">INGRESE LA INFORMACIÓN SOLICITADA:</label>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <br>
                                                                                                                        <div class="row">
                                                                                                                            <div class="col-md">
                                                                                                                                <div class="form-floating">
                                                                                                                                    
                                                                                                                                    <input type="text" name="nombre_empresa_deptoarea_edit" id="nombre_empresa_deptoarea_edit" value="{{$empresa->nombre_empresa}}" class="form-control" disabled>
                                                                                                                                    <label for="">EMPRESA:</label>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                            <div class="col-md">
                                                                                                                                <div class="form-floating">
                                                                                                                                    
                                                                                                                                    <input type="text" name="nombre_sede_deptoarea_edit" id="nombre_sede_deptoarea_edit" class="form-control" disabled>
                                                                                                                                    <label for="">SEDE:</label>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <br>
                                                                                                                        <div class="row">
                                                                                                                            <div class="col-md">
                                                                                                                                <div class="form-floating">
                                                                                                                                    <input type="number" name="id_deptoarea_edit" id="id_deptoarea_edit" hidden>
                                                                                                                                    <input type="text" name="nombre_deptoarea_edit" id="nombre_deptoarea_edit" class="form-control" disabled>
                                                                                                                                    <label for="">DEPARTAMENTO:</label>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                            <div class="col-md">
                                                                                                                                <div class="form-floating">
                                                                                                                                    <input type="number" name="id_areadepartamentosede" id="id_areadepartamentosede" hidden>
                                                                                                                                    <input type="text" name="nombre_area_edit" id="nombre_area_edit"  class="form-control"  style="text-transform:uppercase">
                                                                                                                                    <label for="">NOMBRE DEL ÁREA:</label>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <br>
                                                                                                                        <div class="row">
                                                                                                                            <div class="col-md">
                                                                                                                                <label for="">DESCRIPCIÓN DEL ÁREA:</label>
                                                                                                                                <textarea class="form-control" id="descripcion_area_edit" name="descripcion_area_edit" style="text-transform:uppercase"></textarea>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="modal-footer">
                                                                                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">CANCELAR</button>
                                                                                                                        <button type="submit" class="btn colorQA"  data-bs-dismiss="modal" >GUARDAR</button>
                                                                                                                    </div>
                                                                                                                </form>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col">
                                                                                                    <form id="form_eliminar_areadepto" name="form_eliminar_areadepto" class="form_eliminar_areadepto" action="{{route('areadepto.destroy', $areadep)}}" method="POST">
                                                                                                        @csrf  
                                                                                                        @method('delete')
                                                                                                        <button class="btn btn-sm btn-danger" type="submit">
                                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                                                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                                                                            </svg>
                                                                                                        </button>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                    @php
                                                                                        $checke = '1';
                                                                                    @endphp
                                                                            <?php
                                                                                }else{
                                                                                    echo " ";
                                                                                }
                                                                            }
                                                                            
                                                                        echo "</tbody>";
                                                                    echo "</table>";
                                                                }else{
                                                                    echo " ";
                                                                }
                                                            ?>
                                                        @else
                                                            @php
                                                                if($checke=='0'){
                                                                    echo "NO HAY ÁREAS EN ESTA SEDE !!"; 
                                                                    $checke = '1';
                                                                }
                                                            @endphp
                                                        @endif
                                                    
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="nuevaAreaModal" tabindex="-1" aria-labelledby="nuevaAreaModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title w-100 text-center"  name="nuevaAreaModalLabel" id="nuevaAreaModalLabel">CREAR ÁREA</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form  id="form_create_areadepartamento" name="form_create_areadepartamento" class="form_create_areadepartamento" action="{{route('areadepto.save')}}" method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md">
                                                                        <label class="text-center" for="">INGRESE LA INFORMACIÓN SOLICITADA:</label>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-md">
                                                                        <div class="form-floating">
                                                                            <input type="number" name="id_empresa_deptoarea"  id="id_empresa_deptoarea" value="{{$empresa->id_empresa}}" hidden>
                                                                            <input type="text" name="nombre_empresa_deptoarea" id="nombre_empresa_deptoarea" value="{{$empresa->nombre_empresa}}" class="form-control" disabled>
                                                                            <label for="">EMPRESA:</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md">
                                                                        <div class="form-floating">
                                                                            <input type="text" name="nombre_sede_deptoarea" id="nombre_sede_deptoarea" class="form-control" disabled>
                                                                            <label for="">SEDE:</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-md">
                                                                        <div class="form-floating">
                                                                            <input type="number" name="id_departamentosede" id="id_departamentosede" hidden>
                                                                            <input type="text" name="nombre_departamentosede" id="nombre_departamentosede"  class="form-control" disabled>
                                                                            <label for="">DEPARTAMENTO:</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md">
                                                                        <div class="form-floating">
                                                                            <input type="text" name="nombre_area" id="nombre_area"  class="form-control" style="text-transform:uppercase">
                                                                            <label for="">NOMBRE DEL ÁREA:</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-md">
                                                                        <label for="">DESCRIPCIÓN DEL ÁREA:</label>
                                                                        <textarea class="form-control" id="descripcion_area" name="descripcion_area" style="text-transform:uppercase"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">CANCELAR</button>
                                                                <button type="submit" class="btn colorQA"  data-bs-dismiss="modal" >GUARDAR</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach 
                                            </table>
                                </div>
                                <div class="col"></div> 
                            </div>
                        </div>
                        <!-- //////////////////// PESTAÑA DE TRABAJADORES //////////////// el ID para crear estos trabajadores de dosimetria es 1 -->
                        <div class="tab-pane" id="trabajador" role="tabpanel" aria-labelledby="trabajador-tab">
                            <div class="row">
                                <div class="col">
                                    <a href="{{route('personasEmpresa.create', ['empresa'=>$empresa->id_empresa, 'trabestucont'=>1])}}" class="btn colorQA btn-sm m-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                        </svg> CREAR TRABAJADOR
                                    </a>
                                </div>
                                <div class="col"></div>
                            </div>
                            <h3 class="card-title text-center">TRABAJADORES DE DOSIMETRÍA SUBSCRITOS A LA EMPRESA: <br> <i>{{$empresa->nombre_empresa}}</i></h3>
                            <br>
                            @php
                                $check = 'inicial';
                                $cheq = 'inicial';
                            @endphp 
                            <div class="row">
                                <div class="col"></div>
                                <div class="col-12">
                                    @foreach($trabajadorDosim as $trabDosim)
                                        @php
                                            if($trabDosim->nombre_sede != $check){
                                                echo "<table class='table table-hover table-bordered trabajadores' style='width:100%'>";
                                                    echo "<h4 class='card-title text-center'>{$trabDosim->nombre_sede}</h4>";  
                                                    $check = strval($trabDosim->nombre_sede);
                                                    echo "<thead class='table-active text-center'>";    
                                                        echo "<th class='align-middle text-center'>TRABAJADOR</th>";
                                                        echo "<th class='align-middle text-center'>TIPO IDEN.</th>";
                                                        echo "<th class='align-middle text-center' >No. IDEN.</th>";
                                                        echo "<th class='align-middle text-center' style='width: 30px'>GÉNERO</th>";
                                                        echo "<th class='align-middle text-center' style='width: 150px'>EMAIL</th>";
                                                        echo "<th class='align-middle text-center'>TELEFONO</th>";
                                                        echo "<th class='align-middle text-center'>PERFIL LABORAL</th>";
                                                        echo "<th class='align-middle text-center'>ROL</th>";
                                                        echo "<th class='align-middle text-center'>ESTADO</th>";
                                                        echo "<th class='align-middle' style='width: 90px'>ACCIONES</th>";
                                                    echo "</thead>";
                                            }
                                        @endphp
                                        {{-- @if($trabDosim->cedula_persona != $cheq) --}}
                                        <tr>
                                            <td class="align-middle">{{$trabDosim->primer_nombre_persona}} {{$trabDosim->segundo_nombre_persona}} {{$trabDosim->primer_apellido_persona}} {{$trabDosim->segundo_apellido_persona}}{{--<a href="#ModalPersona" data-bs-toggle="modal"  style="text-decoration: none;" class="text-primary" --}}</td>
                                            {{--<div class="modal fade" id="ModalPersona" tabindex="-1" role="dialog" aria-labelledby="personaModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" >
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title w-100 text-center" id="personModalLabel">TRABAJADOR DOSIMETRÍA</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                             <table class='table table-hover table-bordered'>
                                                                <thead class='table-active text-center'>
                                                                    <th class='align-middle text-center'>TRABAJADOR</th>
                                                                    <th class='align-middle text-center' >No. IDEN.</th>
                                                                    <th class='align-middle text-center'>TIPO IDEN.</th>
                                                                    <th class='align-middle text-center' style='width: 150px'>EMAIL</th>
                                                                    <th class='align-middle text-center' style='width: 30px'>GÉNERO</th>
                                                                    <th class='align-middle text-center'>TELEFONO</th>
                                                                    <th class='align-middle text-center'>PERFIL LABORAL</th>
                                                                    <th class='align-middle text-center'>ROL</th>
                                                                    <th class='align-middle text-center'>ESTADO</th>
                                                                </thead>
                                                            </table> 
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>--}}
                                            <td class="align-middle text-center">{{$trabDosim->tipo_iden_persona == 'CÉDULA DE CIUDADANIA' ? 'CC.' : $trabDosim->tipo_iden_persona}}</td>
                                            <td class="align-middle text-center">{{$trabDosim->cedula_persona}}</td>
                                            @php 
                                                $cheq = $trabDosim->cedula_persona;
                                            @endphp    
                                            <td class="align-middle text-center">{{$trabDosim->genero_persona == 'FEMENINO' ? 'F' : 'M'}}</td>
                                            <td class="align-middle" style="word-break:break-all;">{{$trabDosim->correo_persona}}</td>
                                            <td class="align-middle text-center">{{$trabDosim->telefono_persona}}</td>
                                            <td class="align-middle text-center">
                                                @foreach($personasperfiles as $personperf)
                                                    @if($trabDosim->id_persona == $personperf->persona_id)
                                                        {{$personperf->perfiles->nombre_perfil}} <br>
                                                    @endif
                                                @endforeach
                                                @if($trabDosim->lider_ava == 'TRUE')
                                                    <B>(LIDER A. VIRTUAL)</B>
                                                    <br>
                                                @endif
                                                @if($trabDosim->lider_dosimetria == 'TRUE')
                                                    <B>(LIDER DOSIMETRÍA)</B>
                                                @endif
                                                @if($trabDosim->lider_controlescalidad == 'TRUE')
                                                    <B>(LIDER C. CALIDAD)</B>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                @foreach($personasroles as $personrol)
                                                    @if($trabDosim->id_persona == $personrol->persona_id)
                                                        {{$personrol->roles->name}} <br>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="align-middle text-center">{{$trabDosim->estado_persona}}</td>
                                            <td class="text-center align-middle">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <a href="{{route('personas.edit', ['persona'=>$trabDosim->id_persona, 'trabestucont'=> 1, 'empresa'=>$empresa->id_empresa])}}" class="btn colorQA">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pencil-fill mb-1" viewBox="0 0 16 16">
                                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div class="col">
                                                        <form class="form_eliminar_persona mb-1" id="form_eliminar_persona" name="form_eliminar_persona" action=" {{route('personas.destroy', $trabDosim->id_persona)}}" method="POST">
                                                            @csrf  
                                                            @method('delete')
                                                            <button class="btn btn-danger"  type="submit">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        {{-- @endif --}}
                                    @endforeach
                                    </table>
                                </div>
                                <div class="col"></div>
                            </div>
                        </div>
                        <!-- //////////////////// PESTAÑA DE ESTUDIANTE A. VIRTUAL //////////////// el ID para crear estos estudiantes de a.vitual es 2 -->
                        <div class="tab-pane" id="estudiante" role="tabpanel" aria-labelledby="estudiante-tab">
                            <div class="row">
                                <div class="col">
                                    <a href="{{route('personasEmpresa.create', ['empresa'=>$empresa->id_empresa, 'trabestucont'=>2])}}" class="btn colorQA btn-sm m-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                        </svg> CREAR ESTUDIANTE
                                    </a>
                                </div>
                                <div class="col"></div>
                            </div>
                            <h3 class="card-title text-center">ESTUDIANTES DE AULA VIRTUAL SUBSCRITOS A LA EMPRESA: <br> <i>{{$empresa->nombre_empresa}}</i></h3>
                            <br>
                            @php
                                $check = 'inicial';
                            @endphp 
                            <div class="row">
                                <div class="col"></div>
                                <div class="col-12">
                                    @foreach($estudianteAva as $estuAva)
                                        @php
                                            if($estuAva->nombre_sede != $check){
                                                echo "<table class='table table-hover table-bordered estudiantes' style='width:100%'>";
                                                    echo "<h4 class='card-title text-center'>{$estuAva->nombre_sede}</h4>";  
                                                    $check = strval($estuAva->nombre_sede);
                                                    echo "<thead class='table-active text-center'>";    
                                                        echo "<th class='align-middle text-center'>TRABAJADOR</th>";
                                                        echo "<th class='align-middle text-center'>TIPO IDEN.</th>";
                                                        echo "<th class='align-middle text-center'>No. IDEN.</th>";    
                                                        echo "<th class='align-middle text-center'>GÉNERO</th>";
                                                        echo "<th class='align-middle text-center'>EMAIL</th>";
                                                        echo "<th class='align-middle text-center'>TELEFONO</th>";
                                                        echo "<th class='align-middle text-center'>PERFIL LABORAL</th>";
                                                        echo "<th class='align-middle text-center'>ROL</th>";
                                                    
                                                        echo "<th class='align-middle text-center' style='width: 14.60%'>ACCIONES</th>";
                                                    echo "</thead>";
                                            }
                                        @endphp
                                        <tr>
                                            <td class="align-middle">{{$estuAva->primer_nombre_persona}} {{$estuAva->segundo_nombre_persona}} {{$estuAva->primer_apellido_persona}} {{$estuAva->segundo_apellido_persona}}</td>
                                            <td class="align-middle">{{$estuAva->tipo_iden_persona}}</td>
                                            <td class="align-middle">{{$estuAva->cedula_persona}}</td>
                                            <td class="align-middle text-center">{{$estuAva->genero_persona == 'FEMENINO' ? 'F' : 'M'}}</td>
                                            <td class="align-middle" style="word-break:break-all;">{{$estuAva->correo_persona}}</td>
                                            <td class="align-middle">{{$estuAva->telefono_persona}}</td>
                                            <td class="align-middle text-center">
                                                @foreach($personasperfiles as $personperf)
                                                    @if($estuAva->id_persona == $personperf->persona_id)
                                                        {{$personperf->perfiles->nombre_perfil}} <br>
                                                    @endif
                                                @endforeach
                                                @if($estuAva->lider_ava == 'TRUE')
                                                    <B>(LIDER A. VIRTUAL)</B>
                                                    <br>
                                                @endif
                                                @if($estuAva->lider_dosimetria == 'TRUE')
                                                    <B>(LIDER DOSIMETRÍA)</B>
                                                @endif
                                                @if($estuAva->lider_controlescalidad == 'TRUE')
                                                    <B>(LIDER C. CALIDAD)</B>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                @foreach($personasroles as $personrol)
                                                    @if($estuAva->id_persona == $personrol->persona_id)
                                                        {{$personrol->roles->name}} <br>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-center align-middle">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <a href="{{route('personas.edit', ['persona'=>$estuAva->id_persona, 'trabestucont'=> 2, 'empresa'=>$empresa->id_empresa])}}" class="btn colorQA">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pencil-fill mb-1" viewBox="0 0 16 16">
                                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div class="col">
                                                        <form class="form_eliminar_persona mb-1" id="form_eliminar_persona" name="form_eliminar_persona" action="{{--  {{route('personas.destroy', $trabDosim->id_persona)}} --}}" method="POST" class="mb-1">
                                                            @csrf  
                                                            @method('delete')
                                                            <button class="btn btn-danger"  type="submit">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
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
                                <div class="col"></div>
                            </div>
                        </div>
                        <!-- //////////////////// PESTAÑA DE CONTACTOS //////////////// -->
                        <div class="tab-pane" id="contacto" role="tabpanel" aria-labelledby="contacto-tab">
                            <div class="row">
                                <div class="col">
                                    <a href="{{route('personasEmpresa.create', ['empresa'=>$empresa->id_empresa, 'trabestucont'=>3])}}" class="btn colorQA btn-sm m-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                        </svg> CREAR CONTACTO
                                    </a>
                                </div>
                                <div class="col"></div>
                            </div>
                            <h3 class="card-title text-center">CONTACTOS SUBSCRITOS A LA EMPRESA: <br> <i>{{$empresa->nombre_empresa}}</i> </h3>
                            <br>
                            @php
                                $check2 = 'inicial';
                            @endphp 
                            <div class="row">
                                <div class="col"></div>
                                <div class="col-12">
                                    @foreach($contacto as $cont)
                                        @php
                                            if($cont->nombre_sede != $check2 ){
                                                echo "<table class='table table-hover table-bordered contactos' style='width:100%'>";
                                                    echo "<h4 class='card-title text-center pt-3'>{$cont->nombre_sede}</h4>";
                                                    $check2 = strval($cont->nombre_sede);
                                                    echo "<thead class='table-active text-center'>";    
                                                        echo "<th class='align-middle text-center'>CONTACTO</th>";
                                                        echo "<th class='align-middle text-center'>TIPO IDEN.</th>";
                                                        echo "<th class='align-middle text-center'>No. IDEN</th>";    
                                                        echo "<th class='align-middle text-center'>GÉNERO</th>";
                                                        echo "<th class='align-middle text-center'>EMAIL</th>";
                                                        echo "<th class='align-middle text-center'>TELEFONO</th>";
                                                        echo "<th class='align-middle text-center'>PERFIL LABORAL</th>";
                                                        echo "<th class='align-middle text-center'>ROL</th>";
                                                        echo "<th class='align-middle text-center'>ACCIONES</th>";
                                                    echo "</thead>";
                                            }
                                        @endphp
                                        <tr>
                                            <td class="align-middle">{{$cont->primer_nombre_persona}} {{$cont->segundo_nombre_persona}} {{$cont->primer_apellido_persona}} {{$cont->segundo_apellido_persona}}</td>
                                            <td class="align-middle">{{$cont->tipo_iden_persona}}</td>
                                            <td class="align-middle text-center">{{$cont->cedula_persona}}</td>
                                            <td class="align-middle text-center">{{$cont->genero_persona == 'FEMENINO' ? 'F' : 'M'}}</td>
                                            <td class="align-middle" style="word-break:break-all;">{{$cont->correo_persona}}</td>
                                            <td class="align-middle text-center">{{$cont->telefono_persona}}</td>
                                            <td class="align-middle text-center">
                                                @foreach($personasperfiles as $personperf)
                                                    @if($cont->id_persona == $personperf->persona_id)
                                                        {{$personperf->perfiles->nombre_perfil}} <br>
                                                    @endif
                                                @endforeach
                                                @if($cont->lider_ava == 'TRUE')
                                                    <B>(LIDER A. VIRTUAL)</B>
                                                    <br>
                                                @endif
                                                @if($cont->lider_dosimetria == 'TRUE')
                                                    <B>(LIDER DOSIMETRÍA)</B>
                                                @endif
                                                @if($cont->lider_controlescalidad == 'TRUE')
                                                    <B>(LIDER C. CALIDAD)</B>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                @foreach($personasroles as $personrol)
                                                    @if($cont->id_persona == $personrol->persona_id)
                                                        {{$personrol->roles->name}} <br>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-center align-middle">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <a href="{{route('personas.edit', ['persona'=>$cont->id_persona, 'trabestucont'=> 3, 'empresa'=>$empresa->id_empresa])}}" class="btn colorQA">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pencil-fill mb-1" viewBox="0 0 16 16">
                                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div class="col">
                                                        <form id="form_eliminar_contacto" name="form_eliminar_contacto" action="{{route('personas.destroy', $cont)}}" method="POST" class="mb-1">
                                                            @csrf  
                                                            @method('delete')
                                                            <button class="btn btn-danger" onclick="Eliminar(evt);" type="submit">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
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
                                <div class="col"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>
    <br>
<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous">
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('guardar')== 'ok')
    <script>
        Swal.fire(
        'GUARDADA!',
        'SE HA GUARDADO CON ÉXITO.',
        'success'
        )
    </script>
@endif
@if(session('error')== 'ok')
    <script>
        Swal.fire(
        'ERROR!',
        'NO SE HA PODIDO GUARDAR el ROL, PORQUE YA EXISTE LÍDER DE DOSIMETRÍA PARA ESA SEDE!!',
        'error'
        )
    </script>
@endif
@if(session('actualizar')== 'ok')
    <script>
        Swal.fire(
        'ACTUALIZADA!',
        'SE HA ACTUALIZADO CON ÉXITO.',
        'success'
        /* confirmButtonColor: '#1A9980', */
        )
    </script>
@endif
@if(session('eliminar')== 'ok')
    <script>
        Swal.fire(
        'ELIMINADO!',
        'SE HA ELIMINADO CON ÉXITO.',
        'success'
        )
    </script>
@endif
@if(session('eliminada')== 'ok')
    <script>
        Swal.fire(
        'AREA ELIMINADA!',
        'SE HA ELIMINADO CON ÉXITO.',
        'success'
        )
    </script>
@endif
@if(session('guardada')== 'ok')
    <script>
        Swal.fire(
        'ÁREA GUARDADA!',
        'SE HA GUARDADO CON ÉXITO.',
        'success'
        )
    </script>
@endif
@if(session('actualizada')== 'ok')
    <script>
        Swal.fire(
        'ÁREA ACTUALIZADA!',
        'SE HA ACTUALIZADO CON ÉXITO.',
        'success'
        /* confirmButtonColor: '#1A9980', */
        )
    </script>
@endif
<script type="text/javascript">
    $(document).ready(function(){

        $('#infoEmpresas a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        });

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
                   
                    this.submit();
                }
            })
        });
        
        $('.eliminar_depto').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: 'SEGURO QUE DESEA ELIMINAR ESTA ESPECIALIDAD O DEPARTAMENTO DE LA SEDE?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1A9980',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI, SEGURO!'
            }).then((result) => {
                if (result.isConfirmed) {
                   
                    this.submit(); 
                }
            })
        });
    
        $('#form_eliminar_sede').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "SEGURO QUE DESEA ELIMINAR ESTA SEDE??",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI, SEGURO!'
                }).then((result) => {
                if (result.isConfirmed) {
                   
                    this.submit();
                }
            })
        });
        
        $('.form_eliminar_persona').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "SEGURO QUE DESEA ELIMINAR ESTA PERSONA??",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI!'
                }).then((result) => {
                if (result.isConfirmed) {
                   
                    this.submit();
                }
            })
        });
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
        });
        $('.form_eliminar_areadepto').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "SEGURO QUE DESEA ELIMINAR ESTA ÁREA??",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI!'
                }).then((result) => {
                if (result.isConfirmed) {
                   
                    this.submit();
                }
            })
        });
        $('.form_create_areadepartamento').submit(function(e){
            e.preventDefault(); 
            Swal.fire({
                text: "SEGURO QUE DESEA GUARDAR ESTA ÁREA??",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI!'
                }).then((result) => {
                if (result.isConfirmed) {
                   
                    this.submit();
                }
            })
        });
        $('.form_edit_areadepartamento').submit(function(e){
            e.preventDefault(); 
            Swal.fire({
                text: "SEGURO QUE DESEA ACTUALIZAR LA INFORMACIÓN DE ESTA ÁREA??",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI!'
                }).then((result) => {
                if (result.isConfirmed) {
                   
                    this.submit();
                }
            })
        });
        $('.trabajadores').DataTable({
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
        $('.estudiantes').DataTable({
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
        $('.contactos').DataTable({
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
        $('.ir-arriba').click(function(){
            $('body, html').animate({
                scrollTop: '0px'
            }, 300);
        });

        $(window).scroll(function(){
            if( $(this).scrollTop() > 0 ){
                $('.ir-arriba').slideDown(300);
            } else {
                $('.ir-arriba').slideUp(300);
            }
        });
    })
    
</script>
<script type="text/javascript">
    function capturar(d, e, f)
        {
            let nombre_sede = d;
            let id_depto = e; 
            let nombre_depto = f;
            /* alert (nombre_sede); */
            document.getElementById("nombre_sede_deptoarea").value = nombre_sede;
            document.getElementById("id_departamentosede").value = id_depto;
            document.getElementById("nombre_departamentosede").value= nombre_depto;
            /* console.log(value) */
        }
</script>
<script type="text/javascript">
    function capturarEdit(c, d, e, f, g, h)
        {
            let nombre_sede = c;
            let id_area = d;
            let id_depto = e; 
            let nombre_depto = f;
            let nombre_area = g;
            let descrip_area = h;
            /* alert (id_sede); */
            document.getElementById("nombre_sede_deptoarea_edit").value = nombre_sede;
            document.getElementById("id_deptoarea_edit").value = id_depto;
            document.getElementById("nombre_deptoarea_edit").value= nombre_depto;
            document.getElementById("id_areadepartamentosede").value = id_area;
            document.getElementById("nombre_area_edit").value = nombre_area;
            document.getElementById("descripcion_area_edit").value = descrip_area;
            
        }
</script>
@endsection()