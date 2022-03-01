@extends('layouts.plantillabase')
@section('contenido')

    
    <div class="row">
        <div class="col"></div>
        <div class="col-11">
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
                                <table class="table table-responsive table-hover table-bordered p-4">
                                    <thead class="table-active text-center">
                                        <th scope='col'  style='width: 18.60%'>CODIGO</th>
                                        <th scope='col'>TIPO</th>
                                        <th scope='col'>TECNOLOGIA</th>
                                        <th scope='col' style='width: 13.90%'>F. ING. AL SERV.</th>
                                        <th scope='col'>ESTADO</th>
                                        <th scope='col' style='width: 11.90%'>ACCIONES</th>
                                    </thead>
                                    @foreach($dosimetro as $dosi)
                                        <tr>
                                            <td>{{$dosi->codigo_dosimeter}}</td>
                                            <td>{{$dosi->tipo_dosimetro}}</td>
                                            <td>{{$dosi->tecnologia_dosimetro}}</td>
                                            <td>{{$dosi->fecha_ingreso_servicio}}</td>
                                            <td>{{$dosi->estado_dosimetro}}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                        <a href="{{route('dosimetros.edit', $dosi->id_dosimetro)}}" class="btn colorQA">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div class="col">
                                                        <form id="form_eliminar_dosimetro" name="form_eliminar_dosimetro" action="{{route('dosimetros.destroy', $dosi)}}" method="POST">
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
                                <BR></BR>
                                <div class="d-flex justify-content-center">
                                    {{$dosimetro->links()}}
                                </div>
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
                            <div class="m-5">
                                <table class="table table-responsive table-hover table-bordered p-4">
                                    <thead class="table-active text-center">
                                        <th scope='col'  style='width: 18.60%'>CODIGO</th>
                                        <th scope='col'>TIPO</th>
                                        <th scope='col'>ESTADO</th>
                                        <th scope='col' style='width: 11.90%'>ACCIONES</th>
                                    </thead>
                                    @foreach($holder as $hol)
                                        <tr>
                                            <td>{{$hol->codigo_holder}}</td>
                                            <td>{{$hol->tipo_holder}}</td>
                                            <td>{{$hol->estado_holder}}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                        <a href="{{route('holders.edit', $hol->id_holder)}}" class="btn colorQA">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div class="col">
                                                        <form id="form_eliminar_holder" name="form_eliminar_holder" action="{{route('holders.destroy', $hol)}}" method="POST">
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
                                <BR></BR>
                                <div class="d-flex justify-content-center">
                                    {{$holder->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>




{{-- <script type="text/javascript">
    function Eliminar(evt) {
        evt.preventDefault();
    }
</script>     --}} 
<script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous">
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        $('#form_eliminar_dosimetro').submit(function(e){
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
        })
    })
</script>

@endsection()