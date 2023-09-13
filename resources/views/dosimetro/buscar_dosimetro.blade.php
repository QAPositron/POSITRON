@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')

    
    <div class="row">
        <div class="col"></div>
        <div class="col-10">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="infoDosimetros" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#dosimetro" role="tab" aria-controls="dosimetro" aria-selected="true">DOSÍMETROS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="#holder" role="tab" aria-controls="holder" aria-selected="false">HOLDERS</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body ">
                    <!-- //////////////////// PESTAÑA DE DOSIMETROS //////////////// -->
                    <div class="tab-content mt-3">
                        <div class="tab-pane active" id="dosimetro" role="tabpanel">
                            <div class="row">
                                <div class="col">
                                    <a href="{{route('dosimetros.create')}}" class="btn colorQA btn-sm m-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                        </svg> CREAR DOSÍMETRO
                                    </a>
                                </div>
                                <div class="col"></div>
                            </div>
                            <h4 class="card-title text-center ">TODOS LOS DOSÍMETROS</h4>
                            <div class="m-5">
                                <table class="table table-responsive table-hover table-bordered p-4 dosimetros">
                                    <thead class="table-active text-center">
                                        <th class="align-middle" scope='col' style='width: 18.60%'>CODIGO</th>
                                        <th class="align-middle" scope='col'>TIPO</th>
                                        <th class="align-middle" scope='col' style='width: 10.60%'>TECNOLOGIA</th>
                                        <th class="align-middle" scope='col' style='width: 13.90%'>F. ING. AL SERV.</th>
                                        <th class="align-middle" scope='col' style='width: 11.60%'>ESTADO</th>
                                        <th class="align-middle" scope='col' style='width: 12.60%'>USO ACTUAL</th>
                                        <th class="align-middle" scope='col' style='width: 15.90%'>ACCIONES</th>
                                    </thead>
                                    <tbody>
                                        {{-- ////////DOSIMETROS //////// --}}
                                        @foreach($dosimetros as $dosi)
                                            <tr>
                                                <td class="align-middle">
                                                    {{$dosi->codigo_dosimeter}}
                                                </td>
                                                <td class="align-middle text-center">{{$dosi->tipo_dosimetro}}</td>
                                                <td class="align-middle text-center">{{$dosi->tecnologia_dosimetro}}</td>
                                                <td class="align-middle text-center">{{$dosi->fecha_ingreso_servicio}}</td>
                                                <td class="align-middle text-center">{{$dosi->estado_dosimetro}}</td>
                                                <td class="align-middle text-center">{{$dosi->uso_dosimetro}}</td>
                                                <td class="align-middle text-center">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <a href="{{route('dosimetros.edit', $dosi->id_dosimetro)}}" class="btn colorQA">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill mb-1" viewBox="0 0 16 16">
                                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                        <div class="col">
                                                            <form id="form_eliminar_dosimetro" class="form_eliminar_dosimetro" name="form_eliminar_dosimetro" action="{{route('dosimetros.destroy', $dosi->id_dosimetro)}}" method="POST">
                                                                @csrf  
                                                                @method('delete')
                                                                <button class="btn btn-danger mt-3" onclick="Eliminar(evt);" type="submit">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
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

                        <div class="tab-pane" id="holder" role="tabpanel" aria-labelledby="holder-tab">
                            
                            <div class="row">
                                <div class="col">
                                    <a href="{{route('holders.create')}}" class="btn colorQA btn-sm m-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                        </svg> CREAR HOLDER 
                                    </a>
                                </div>
                                <div class="col"></div>
                            </div>
                            <h4 class="card-title text-center">TODOS LOS HOLDERS</h4>
                            <div class="row">

                                <div class="col-md"></div>
                                <div class="col-md-8 text-center">
                                    <div class="m-5">
                                        <table class="table table-responsive table-hover table-bordered p-4 holders">
                                            <thead class="table-active text-center">
                                                <th class="align-middle" scope='col'>CODIGO</th>
                                                <th class="align-middle" scope='col'>TIPO</th>
                                                <th class="align-middle" scope='col' >ESTADO</th>
                                                <th class="align-middle" scope='col' >ACCIONES</th>
                                            </thead>
                                            @foreach($holderControl as $holcont)
                                                <tr>
                                                    <td class="align-middle">
                                                        {{$holcont->codigo_holder}}
                                                    </td>
                                                    <td class="text-center align-middle">{{$holcont->tipo_holder}}</td>
                                                    <td class="text-center align-middle">{{$holcont->estado_holder}}</td>
                                                    <td class="text-center align-middle">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <a href="{{route('holders.edit', $holcont->id_holder)}}" class="btn colorQA">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill mb-1" viewBox="0 0 16 16">
                                                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                            <div class="col">
                                                                <form id="form_eliminar_holder" name="form_eliminar_holder" action="{{route('holders.destroy', $holcont->id_holder)}}" method="POST">
                                                                    @csrf  
                                                                    @method('delete')
                                                                    <button class="btn btn-danger mt-3" onclick="Eliminar(evt);" type="submit">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
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
                                            @foreach($holderTrabj as $holTrabj)
                                                <tr>
                                                    <td class="align-middle">
                                                        {{$holTrabj->codigo_holder}}
                                                    </td>
                                                    <td class="text-center align-middle">{{$holTrabj->tipo_holder}}</td>
                                                    <td class="text-center align-middle">{{$holTrabj->estado_holder}}</td>
                                                    <td class="text-center align-middle">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <a href="{{route('holders.edit', $holTrabj->id_holder)}}" class="btn colorQA">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill mb-1" viewBox="0 0 16 16">
                                                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                            <div class="col">
                                                                <form id="form_eliminar_holder" name="form_eliminar_holder" action="{{route('holders.destroy', $holTrabj->id_holder)}}" method="POST">
                                                                    @csrf  
                                                                    @method('delete')
                                                                    <button class="btn btn-danger mt-3" onclick="Eliminar(evt);" type="submit">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
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
                                            @foreach($holder as $hol)
                                                <tr>
                                                    <td class="align-middle">
                                                        @if($hol->contdosisededepto_id != NULL && $hol->mes_asignacion != NULL) 
                                                            {{$hol->codigo_holder}}
                                                        @else 
                                                            {{$hol->codigo_holder}}
                                                        @endif
                                                    </td>
                                                    <td class="text-center align-middle">{{$hol->tipo_holder}}</td>
                                                    <td class="text-center align-middle">{{$hol->estado_holder}}</td>
                                                    <td class="text-center align-middle">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <a href="{{route('holders.edit', $hol->id_holder)}}" class="btn colorQA">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill mb-1" viewBox="0 0 16 16">
                                                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                            <div class="col">
                                                                <form id="form_eliminar_holder" name="form_eliminar_holder" action="{{route('holders.destroy', $hol->id_holder)}}" method="POST">
                                                                    @csrf  
                                                                    @method('delete')
                                                                    <button class="btn btn-danger mt-3" onclick="Eliminar(evt);" type="submit">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
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
                                <div class="col-md"></div>
                            </div>
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
@if(session('guardar')== 'ok')
    <script>
        Swal.fire(
        'GUARDADO!',
        'SE HA GUARDADO CON ÉXITO.',
        'success'
        )
    </script>
@endif
@if(session('actualizar')== 'ok')
    <script>
        Swal.fire(
        'ACTUALIZADO!',
        'SE HA ACRUALIZADO CON ÉXITO.',
        'success'
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

<script type="text/javascript">
    $(document).ready(function(){

        $('#infoDosimetros a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })

        $('.form_eliminar_dosimetro').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "SEGURO QUE DESEA ELIMINAR ESTE DOSÍMETRO??",
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
        })
    })
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#form_eliminar_holder').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "SEGURO QUE DESEA ELIMINAR ESTE HOLDER??",
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

        
        $('.dosimetros').DataTable({
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
        $('.holders').DataTable({
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
    })
</script>

@endsection()