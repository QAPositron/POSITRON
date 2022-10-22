<div>
    {{-- Be like water. --}}
    <div class="row">
        <div class="col"></div>
        <div class="col">
            <div class="card text-dark bg-light" style="max-width: 25rem;">
                <h3 class="pt-4 text-center">BUSCAR</h3>
                <form class="m-4"action="">
                    <label for="exampleFormControlInput1" class="form-label">PALABRA CLAVE: </label>
                    <div class="row">
                        <div class="col-8">
                            <input class="form-control" type="text" name="busqueda" id="busqueda" placeholder="--BUSCAR--" autofocus style="text-transform:uppercase;">
                        </div>
                        <div class="col">
                            <input class="btn colorQA " type="submit" id="submit" name="submit" value="BUSCAR">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col"></div>
    </div>
        
    <div class="row pt-5" id ="salida">
        <h3 class="text-center">TODAS LAS PERSONAS</h3>
        <br>
        <br>
        <table class="table table-hover table-bordered">
            <thead class='table-active text-center'>
                
                <th class="align-middle" scope='col'  style='width: 18.60%'>PERSONA</th>
                <th class="align-middle" scope='col'>TIPO IDEN</th>
                <th class="align-middle" scope='col'>N. IDEN CONTACTO</th>
                <th class="align-middle" scope='col'>GÉNERO</th>
                <th class="align-middle" scope='col'>EMAIL</th>
                <th class="align-middle" scope='col'>TELEFONO</th>
                <th class="align-middle" scope='col' style='width: 13.60%'>EMPRESA - SEDE RELACIONADAS</th>
                <th class="align-middle" scope='col' style='width: 10.60%'>PERFIL LABORAL</th>
                <th class="align-middle" scope='col'>ROLES</th>
                <th class="align-middle" scope='col' style='width: 9.60%'>ACCIONES</th>
            </thead>
            @foreach($persona as $person)
                <tr>
                    
                    <td class="align-middle text-center">{{$person->primer_nombre_persona}} {{$person->segundo_nombre_persona}} {{$person->primer_apellido_persona}} {{$person->segundo_apellido_persona}}</td>
                    <td class="align-middle text-center">{{$person->tipo_iden_persona}}</td>
                    <td class="text-center align-middle">{{$person->cedula_persona}}</td>
                    <td class="align-middle text-center">{{$person->genero_persona == 'FEMENINO' ? 'FEM' : 'MASC'}}</td>
                    <td class="align-middle text-center">{{$person->correo_persona}}</td>
                    <td class="align-middle text-center">{{$person->telefono_persona}}</td>
                    <td class="align-middle text-center">
                        @foreach($personasedes as $personsede)
                            @if($person->id_persona == $personsede->persona_id)
                                {{$personsede->sede->empresa->nombre_empresa}} - {{$personsede->sede->nombre_sede}} <br>
                            @endif
                        @endforeach
                    </td>
                    <td class="align-middle text-center">
                        @foreach($personasperfiles as $personperf)
                            @if($person->id_persona == $personperf->persona_id)
                                {{$personperf->perfiles->nombre_perfil}}
                            @endif
                        @endforeach
                    </td>
                    <td class="align-middle text-center">
                        @foreach($personasroles as $personrol)
                            @if($person->id_persona == $personrol->persona_id)
                                {{$personrol->roles->nombre_rol}}
                            @endif
                        @endforeach
                    </td>
                    <td  class="align-middle text-center">
                        <div class="row">
                            <div class="col">
                                <a href="{{route('personas.edit', $person->id_persona)}}" class="btn btn-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill mb-1" viewBox="0 0 16 16">
                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                    </svg>
                                </a>
                            </div>
                            <div class="col">
                                <form class="form_eliminar_persona" id="form_eliminar_persona" name="form_eliminar_persona" action=" {{route('personas.destroy', $person->id_persona)}}" method="POST">
                                    @csrf  
                                    @method('delete')
                                    <button class="btn btn-danger"  type="submit">
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
</div>
