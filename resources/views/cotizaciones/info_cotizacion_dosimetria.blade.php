@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col-md">
        <a type="button" class="btn btn-circle colorQA" href="{{route('cotizaciones.search')}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left mt-1" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
        </a>
    </div>
    <div class="col-md-11">
        <h2 class="text-center" id="id_cotizacion"></h2>
    </div>
    <div class="col-md"></div>
</div>
<br>
<div class="row">
    <div class="col-md"></div>
    <div class="col-md-9">
        <div class="table table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th colspan="4" class="table-active text-center">INFORMACIÓN DE LA COTIZACIÓN</th>
                    </tr>
                    <tr>
                        <th>FECHA DE EMISION:</th>
                        <td>{{$coti->fecha_emision}}</td>
                        <th>FECHA DE VENCIMIENTO:</th>
                        <td>{{$coti->fecha_vencimiento}}</td>
                    </tr>
                    <tr>
                        <th>EMPRESA:</th>
                        <td>{{$coti->empresa->nombre_empresa}}</td>
                        <th>SEDE:</th>
                        <td>{{$coti->sede->nombre_sede}}</td>
                    </tr>
                    <tr>
                        <th>PERIODO DE LECTURA:</th>
                        <td>{{$coti->periodoLec}}</td>
                        <th>LECTUAS AL AÑO:</th>
                        <td>{{$coti->lecturas_ano}}</td>
                    </tr>
                    <tr>
                        <th>DESCUENTO PRONTO PAGO:</th>
                        <td>@if($coti->desc_prontopago != NULL){{$coti->desc_prontopago}}% @endif</td>
                        <th>DESCUENTO CORTESIA:</th>
                        <td>@if($coti->desc_cortesia != NULL) {{$coti->desc_cortesia}}% @endif </td>
                    </tr>
                    <tr>
                        <th>PROMEDIO DOSÍMETRO:</th>
                        <td>$
                            @php
                                echo number_format($coti->promedioDosimMes, 0, ',', '.');
                            @endphp</td>
                        <th>FORMA DE PAGO:</th>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md"></div>
</div>
<br>
<h4 class="text-center">PRODUCTOS ASIGNADOS A ESTA COTIZACIÓN</h4>
<br>
<div class="row">
    <div class="col-md"></div>
    <div class="col-md-10">
        <div class="table-responsive">
            <table class="table active table-bordered table-hover" id="productos">
                <thead  class="table-active text-center table-bordered align-middle">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col" style="width: 10%;">REF. PRODUCTO</th>
                      <th scope="col" style="width: 30%;">CONCEPTO</th>
                      <th scope="col">CANT.</th>
                      <th scope="col" style="width: 12%;">COSTO UNI.</th>
                      <th scope="col" style="width: 9%;">IVA</th>
                      <th scope="col" style="width: 14%;">COSTO PERIODO</th>
                      <th scope="col" style="width: 14%;">COSTO AÑO</th>
                    </tr>
                </thead>
                <tbody id="body_productos">
                    @php
                        $i = 1;
                    @endphp
                    @foreach($cotiproductos as $cotiprod)
                        <tr class="text-center align-middle">
                            <td>{{$i}}</td>
                            <td>{{$cotiprod->producto->referencia}}</td>
                            <td>{{$cotiprod->conceptoProd}}</td>
                            <td>{{$cotiprod->cantidadProd}}</td>
                            <td>$
                                @php
                                    echo number_format($cotiprod->costoUndProd, 0, ',', '.');
                                @endphp
                            </td>
                            <td>{{$cotiprod->ivaProd}}%</td>
                            <td>$
                                @php
                                    echo number_format($cotiprod->costoPeriodoProd, 0, ',', '.');
                                @endphp
                            </td>
                            <td>$
                                @php
                                    echo number_format($cotiprod->costoAñoProd, 0, ',', '.');
                                @endphp
                            </td>
                        </tr>
                        @php
                            $i ++;
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="text-center align-middle">
                        <td colspan="6" class="text-end"><b>VALOR TOTAL SIN DESCUENTO</b></td>
                        <td>$
                            @php
                                echo number_format($coti->valorTotalSDPeriodo, 0, ',', '.');
                            @endphp
                        </td>
                        <td>$
                            @php
                                echo number_format($coti->valorTotalSDAño, 0, ',', '.');
                            @endphp
                        </td>
                    </tr>
                    @if($coti->desc_cortesia != NULL || $coti->desc_cortesia != 0)
                        <tr class="text-center align-middle">
                            <td colspan="6" class="text-end"><b>(-) DESCUENTO CORTESÍA</b></td>
                            <td>$
                                @php
                                    echo number_format($coti->descCortesiaPeriodo, 0, ',', '.');
                                @endphp
                            </td>
                            <td>$
                                @php
                                    echo number_format($coti->descCortesiaAño, 0, ',', '.');
                                @endphp
                            </td>
                        </tr>
                    @endif
                    @if($coti->desc_prontopago != NULL || $coti->desc_prontopago != 0 )
                        <tr class="text-center align-middle">
                            <td colspan="6" class="text-end"><b>(-) DESCUENTO PRONTO PAGO</b></td>
                            <td>$
                                @php
                                    echo number_format($coti->descProntopagoPeriodo, 0, ',', '.');
                                @endphp
                            </td>
                            <td>$
                                @php
                                    echo number_format($coti->descProntopagoAño, 0, ',', '.');
                                @endphp
                            </td>
                        </tr>
                    @endif
                    @if($coti->servTransEnvioPeriodo != NULL || $coti->servTransEnvioPeriodo != 0)
                        <tr class="text-center align-middle">
                            <td colspan="6" class="text-end"><b>SERVICIO DE TRANSPORTE (ENVÍO) <label id="periodos"></label></b></td>
                            <td>$
                                @php
                                    echo number_format($coti->servTransEnvioPeriodo, 0, ',', '.');
                                @endphp
                            </td>
                            <td>$
                                @php
                                    echo number_format($coti->servTransEnvioAño, 0, ',', '.');
                                @endphp
                            </td>
                        </tr>
                    @elseif($coti->obsq_transEnvio == 'TRUE')
                        <tr class="text-center align-middle">
                            <td colspan="6" class="text-end"><b>SERVICIO DE TRANSPORTE (ENVÍO) <label id="periodos"></label></b></td>
                            <td colspan="2"><b>OBSEQUIO</b></td>
                        </tr>
                    @endif
                    @if($coti->servTransRecoPeriodo != NULL || $coti->servTransRecoPeriodo != 0)
                        <tr class="text-center align-middle">
                            <td colspan="6" class="text-end"><b>SERVICIO DE TRANSPORTE (RECOLECCIÓN) <label id="periodosReco"></label></b></td>
                            <td>$
                                @php
                                    echo number_format($coti->servTransRecoPeriodo, 0, ',', '.');
                                @endphp
                            </td>
                            <td>$
                                @php
                                    echo number_format($coti->servTransRecoAño, 0, ',', '.');
                                @endphp
                            </td>
                        </tr>
                    @elseif($coti->obsq_transRecole == 'TRUE')
                        <tr class="text-center align-middle">
                            <td colspan="6" class="text-end"><b>SERVICIO DE TRANSPORTE (RECOLECCIÓN) <label id="periodosReco"></label></b></td>
                            <td colspan="2"><b>OBSEQUIO</b>
                        </tr>
                    @endif
                    <tr class="text-center align-middle">
                        <td colspan="6" class="text-end"><b>VALOR TOTAL DEL SERVICIO</b></td>
                        <td>$
                            @php
                                echo number_format($coti->valorTotalPeriodo, 0, ',', '.');
                            @endphp
                        </td>
                        <td>$
                            @php
                                echo number_format($coti->valorTotalAño, 0, ',', '.');
                            @endphp
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="col-md"></div>
</div>
<br>
<div class="row">
    <div class="col-md"></div>
    <div class="col-md-9 active">
        <h4>OBSERVACIONES:</h4>
        <ul>
            @foreach($cotiobservaciones as $cotiobs)
                <li>{{$cotiobs->obs}}</li>
            @endforeach
        </ul>
    </div>
    <div class="col-md"></div>
</div>
<br>
<div class="row align-items-center">
    <div class="col-md"></div>
    <div class="col-md d-grid gap-2">
        <a href="{{route('cotizaciones.edit', $coti->id_cotizacion)}}" class="btn colorQA mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill mb-1" viewBox="0 0 16 16">
                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
            </svg>  EDITAR
        </a>
    </div>
    @can('superadmin.home')
        <div class="col-md">
            <form id="form_eliminar_cotizacion" action="{{route('cotizaciones.destroy', $coti->id_cotizacion)}}" method="POST" class=" d-grid gap-2">
                @csrf  
                @method('delete')
                <button class="btn btn-danger" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash mb-1" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                    </svg> ELIMINAR
                </button>
            </form>
        </div>
    @endcan
    <div class="col-md"></div>
</div>
<br>
<br>
<script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous">
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    
    $(document).ready(function(){

        var TDcontrato = document.getElementById("id_cotizacion");
        var num = parseInt('{{$coti->codigo_cotizacion}}');
        var n = num.toString().padStart(5,'0');
        console.log("ESTE ES EL CODIGO" +n);
           
        TDcontrato.innerHTML = "COTIZACIÓN No. "+n;

        $('#form_eliminar_cotizacion').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "SEGURO QUE DESEA ELIMINAR ESTA COTIZACIÓN??",
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
@endsection