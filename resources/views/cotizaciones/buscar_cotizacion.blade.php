@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col">
        <a href="{{route('cotizaciones.create')}}" class="btn colorQA btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg> CREAR COTIZACIÓN
        </a>
    </div>
    <div class="col"></div>
</div>
<br>
<div class="row">
    <div class="col-md"></div>
    <div class="col-md-11">
        <h2 class="text-center">TODAS LAS COTIZACIONES</h2>
        <br>
        <table class="table table-responsive hover table-bordered" id="cotizaciones">
            <thead class="table-active align-middle">
                <th class="text-center">No. COTIZACIÓN</th>
                <th class="text-center" style='width: 13%'>EMPRESA</th>
                <th class="text-center" style='width: 10%'>SEDE</th>
                <th class="text-center" style='width: 10%'>FECHA EMISIÓN</th>
                <th class="text-center" style='width: 10%'>FECHA VENCIMI.</th>
                <th class="text-center">PERIODO LECTURA</th>
                <th class="text-center">No. LECTURAS</th>
                <th class="text-center" style='width: 12%'>VALOR TOTAL SD PERIODO</th>
                <th class="text-center" style='width: 12%'>VALOR TOTAL PERIODO</th>
                <th class="text-center" style='width: 22%'>ACCIONES</th>
            </thead>
            <tbody>
                @foreach($cotizaciones as $coti)
                    <tr>
                        <td class="align-middle text-center" id="{{$coti->id_cotizacion}}"></td>
                        <td class="align-middle text-center">{{$coti->empresa->nombre_empresa}}</td>
                        <td class="align-middle text-center">{{$coti->sede->nombre_sede}}</td>
                        <td class="align-middle text-center">{{$coti->fecha_emision}}</td>
                        <td class="align-middle text-center">{{$coti->fecha_vencimiento}}</td>
                        <td class="align-middle text-center">{{$coti->periodoLec}}</td>
                        <td class="align-middle text-center">{{$coti->lecturas_ano}}</td>
                        <td class="align-middle text-center">$ {{number_format($coti->valorTotalSDPeriodo, 2, ',', '.')}}</td>
                        <td class="align-middle text-center">  $ {{number_format($coti->valorTotalPeriodo, 2, ',', '.')}}</td>
                        <td>
                            <div class="row">
                                <div class="col-md p-0 text-center" >
                                    <a href="{{route('cotizaciones.edit', $coti->id_cotizacion)}}" class="btn colorQA">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                        </svg>
                                    </a>
                                </div>
                                <div class="col-md p-0 text-center">
                                    <form  name="eliminar_cotizacion" action="{{-- {{route('productos.destroy', $prod->id_producto)}} --}}" method="POST" class="mb-1 formeliminar_cotizacion">
                                        @method('DELETE')
                                        @csrf  
                                        <button class="btn btn-danger" {{-- onclick="Eliminar(evt);" --}} type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trash " viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md p-0 text-center">
                                    <a href="{{route('cotizacionDosimetria.pdf', $coti->codigo_cotizacion)}}" class="btn colorQA" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                            <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md"></div>
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
        'GUARDADA!',
        'SE HA GUARDADO CON ÉXITO.',
        'success'
        )
    </script>
@endif
<script type="text/javascript">
    $(document).ready(function(){
        @foreach($cotizaciones as $coti)
            var TDcoti = document.getElementById("{{$coti->id_cotizacion}}");
            var num = parseInt('{{$coti->codigo_cotizacion}}');
            var n = num.toString().padStart(5,'0');
            console.log("ESTE ES EL CODIGO" +n);
        
            TDcoti.innerHTML = "<a class='btn btn-outline-primary rounded-pill'>"+n+"</a>";
        @endforeach
    })
</script>
@endsection