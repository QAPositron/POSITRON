@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col"></div>
    <div class="col-12">
        <div class="card text-dark bg-light">
            <h2 class="text-center mt-3">EDITAR COTIZACIÓN DE DOSIMETRÍA</h2>
            <br>
            <form class="m-4" action="{{route('cotizaciones.update', $cotizacion)}}" method="POST" id="form_edit_cotizacion">

                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md">
                        <div class="form-floating" id="numero_cotizacion">
                            <input type="number" name="numero_cotizacion" id="numero_cotizacion_input" value="" class="form-control " readonly>
                            <label for="floatingInputGrid">NÚMERO</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <div class="form-floating">
                                <input type="text" name="empresa" id="numeroempresa" value="{{$cotizacion->empresa->nombre_empresa}}" class="form-control " readonly>
                                <label for="floatingInputGrid">EMPRESA</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" name="sede" id="sede" value="{{$cotizacion->sede->nombre_sede}}" class="form-control " readonly>
                            <label for="floatingInputGrid">SEDE</label>
                        </div>
                    </div>
                    
                </div>
                <br>
                <div class="row">
                    <div class="col-md">
                        <div class="form-floating">
                            <input value="{{old('fecha_emision', $cotizacion->fecha_emision)}}" type="date" class="form-control @error('fecha_emision') is-invalid @enderror" name="fecha_emision" id="fecha_emision" onchange="fechaultimodia();" >
                            <label for="floatingInputGrid">FECHA EMISIÓN</label>
                            @error('fecha_emision')
                                <small class="invalid-feedback">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input value="{{old('fecha_vencimiento', $cotizacion->fecha_vencimiento)}}" type="date" class="form-control @error('fecha_vencimiento') is-invalid @enderror" name="fecha_vencimiento" id="fecha_vencimiento" {{-- onchange="fechaultimodia();" --}} >
                            <label for="floatingInputGrid">FECHA VENCIMIENTO</label>
                            @error('fecha_vencimiento')
                                <small class="invalid-feedback">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating">
                            <input type="text" name="periodoLec" id="periodoLec" value="@if($cotizacion->periodoLec == 'MENS') MENSUAL @elseif($cotizacion->periodoLec == 'TRIMS') TRIMESTRAL @elseif($cotizacion->periodoLec == 'BIMS') BIMESTRAL @endif" class="form-control " readonly>
                            <label for="floatingSelectGrid">PERIODO LECTURA</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="floatingSelectGrid">LECTURAS AL AÑO</label>
                                {{--  <input type="number" name="totalProductos" id="totalProductos" value="{{old('totalProductos', $cotizacion->lecturas_ano)}}" class="form-control" hidden> --}}
                                <input type="number" name="numlecturas_año" id="numlecturas_año" value="{{old('numlecturas_año', $cotizacion->lecturas_ano)}}" class="form-control" readonly>
                            </div>
                            <div class="col-md mt-4">
                                <label id="maxLectuasAño"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 text-end align-middle">
                        <label for="floatingInputGrid">(-) DESCUENTO POR PRONTO PAGO</label>
                    </div>
                    <div class="col-md-1 me-0">
                        <div class="form-group">
                            <input type="number" name="descuento_pronto_pago" id="descuento_pronto_pago" value="{{old('descuento_pronto_pago', $cotizacion->desc_prontopago)}}" class="form-control" style="width: 80px;" readonly>
                        </div>
                    </div>
                    <div class="col-md-1 text-start align-middle mt-2 ps-0">
                        <label  for="floatingInputGrid">%</label>
                    </div>
                    <div class="col-md-2 text-end align-middle">
                        <label for="floatingInputGrid">(-) DESCUENTO DE CORTESÍA</label>
                    </div>
                    <div class="col-md-1 me-0">
                        <div class="form-group">
                            <input type="number" name="descuento_cortesia" id="descuento_cortesia" value="{{old('descuento_cortesia', $cotizacion->desc_cortesia)}}" class="form-control" style="width: 80px;" readonly>
                        </div>
                    </div>
                    <div class="col-md-1 text-start align-middle mt-2 ps-0">
                        <label  for="floatingInputGrid">%</label>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="TRUE" id="obsq_servitransporteEnvio" name="obsq_servitransporteEnvio" @if($cotizacion->obsq_transEnvio == 'TRUE')checked @endif disabled>
                            <label class="form-check-label" for="defaultCheck1">
                                OBSEQUIO EN EL SERVICIO DE TRANSPORTE (ENVÍO)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="TRUE" id="obsq_servitransporteReco" name="obsq_servitransporteReco" @if($cotizacion->obsq_transRecole == 'TRUE')checked @endif disabled>
                            <label class="form-check-label" for="defaultCheck1">
                                OBSEQUIO EN EL SERVICIO DE TRANSPORTE (RECOLECCIÓN)
                            </label>
                        </div>
                    </div>
                </div>
                <br>
                <div class="table-responsive">
                    <table class="table active table-hover" id="productos">
                        <thead  class="text-center table-bordered align-middle">
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
                           @foreach($cotiproductos as $cotiprod)
                                <tr class="text-center align-middle">
                                    <td></td>
                                    <td>{{$cotiprod->producto->referencia}}</td>
                                    <td>{{$cotiprod->conceptoProd}}</td>
                                    <td>{{$cotiprod->cantidadProd}}</td>
                                    <td>{{$cotiprod->costoUndProd}}</td>
                                    <td>{{$cotiprod->ivaProd}}%</td>
                                    <td>{{$cotiprod->costoPeriodoProd}}</td>
                                    <td>{{$cotiprod->costoAñoProd}}</td>
                                </tr>
                           @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6" class="text-end"><b>VALOR TOTAL SIN DESCUENTO</b></td>
                                <td>
                                    <div class="form-group">
                                        {{-- <input type="number" name="totalAñoSDint_periodo" id="totalAñoSDint_periodo" value="" class="form-control " hidden> --}}
                                        <input type="number" name="totalAñoSD_periodo" id="totalAñoSD_periodo" value="{{$cotizacion->valorTotalSDPeriodo}}" class="form-control" readonly>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        {{-- <input type="number" name="totalAñoSDint_ano" id="totalAñoSDint_ano" value="" class="form-control " hidden> --}}
                                        <input type="number" name="totalAñoSD_ano" id="totalAñoSD_ano" value="{{$cotizacion->valorTotalSDAño}}" class="form-control "readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr id="desctoCortesia" hidden>
                                <td colspan="6" class="text-end"><b>(-) DESCUENTO CORTESÍA</b></td>
                                <td>
                                    <div class="form-group">
                                        {{-- <input type="number" name="descuento_cortesiaint_periodo" id="descuento_cortesiaint_periodo" value="" class="form-control " hidden --}}>
                                        <input type="number" name="descuento_cortesia_periodo" id="descuento_cortesia_periodo" value="{{$cotizacion->descCortesiaPeriodo}}" class="form-control" readonly>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        {{-- <input type="number" name="descuento_cortesiaint_ano" id="descuento_cortesiaint_ano" value="" class="form-control " hidden --}}>
                                        <input type="number" name="descuento_cortesia_ano" id="descuento_cortesia_ano" value="{{$cotizacion->descCortesiaAño}}" class="form-control" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr id="desctoProntoPago" hidden>
                                <td colspan="6" class="text-end"><b>(-) DESCUENTO PRONTO PAGO</b></td>
                                <td>
                                    <div class="form-group">
                                        {{-- <input type="number" name="descuento_prontopagoint_periodo" id="descuento_prontopagoint_periodo" value="" class="form-control " hidden> --}}
                                        <input type="number" name="descuento_prontopago_periodo" id="descuento_prontopago_periodo" value="{{$cotizacion->descProntopagoPeriodo}}" class="form-control " readonly>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        {{-- <input type="number" name="descuento_prontopagoint_ano" id="descuento_prontopagoint_ano" value="" class="form-control " hidden> --}}
                                        <input type="number" name="descuento_prontopago_ano" id="descuento_prontopago_ano" value="{{$cotizacion->descProntopagoAño}}" class="form-control " readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr id = "serviTransporteEnvio">
                                <td colspan="6" class="text-end"><b>SERVICIO DE TRANSPORTE (ENVÍO) <label id="periodos"></label></b></td>
                                <td>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-1">
                                                <label for="" class="mt-2"><b>$</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="number" name="servtransporte_periodo" id="servtransporte_periodo" value="{{$cotizacion->servTransEnvioPeriodo}}" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        {{-- <input type="number" name="servtransporteInt_ano" id="servtransporteInt_ano" value="" class="form-control" hidden> --}}
                                        <input type="number" name="servtransporte_ano" id="servtransporte_ano" value="{{$cotizacion->servTransEnvioAño}}" class="form-control" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr id = "serviTransporteReco">
                                <td colspan="6" class="text-end"><b>SERVICIO DE TRANSPORTE (RECOLECCIÓN) <label id="periodosReco"></label></b></td>
                                <td>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-1">
                                                <label for="" class="mt-2"><b>$</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="number" name="servtransporteReco_periodo" id="servtransporteReco_periodo" value="{{$cotizacion->servTransRecoPeriodo}}" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        {{-- <input type="number" name="servtransporteRecoInt_ano" id="servtransporteRecoInt_ano" value="" class="form-control" hidden> --}}
                                        <input type="number" name="servtransporteReco_ano" id="servtransporteReco_ano" value="{{$cotizacion->servTransRecoAño}}" class="form-control" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-end"><b>VALOR TOTAL DEL SERVICIO</b></td>
                                <td>
                                    <div class="form-group">
                                        {{-- <input type="number" name="totalservicioInt_periodo" id="totalservicioInt_periodo" value="" class="form-control" hidden> --}}
                                        <input type="text" name="totalservicio_periodo" id="totalservicio_periodo" value="{{$cotizacion->valorTotalPeriodo}}" class="form-control" readonly>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        {{-- <input type="number" name="totalservicioInt_ano" id="totalservicioInt_ano" value="" class="form-control" hidden> --}}
                                        <input type="text" name="totalservicio_ano" id="totalservicio_ano" value="{{$cotizacion->valorTotalAño}}" class="form-control" readonly>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <br>
                <div class="row mx-2">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for=""><b>PROMEDIO DOSÍMETRO:</b></label>
                            <br><br>
                            {{-- <input type="number" name="promedioDosiMesInt" id="promedioDosiMesInt" value="" class="form-control" hidden> --}}
                            <input type="number" name="promedioDosimMes" id="promedioDosimMes" value="{{$cotizacion->promedioDosimMes}}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for=""><b>FORMAS DE PAGO:</b></label>
                            <br>
                            <br>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="TRUE" id="fpago_anticipado" name="fpago_anticipado" @if($cotizacion->pago_anticipado == 'TRUE') checked @endif>
                                <label class="form-check-label" for="defaultCheck1">
                                    100% ANTICIPADO MENSUAL O ANUAL
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="TRUE" id="fpago_unmes" name="fpago_unmes" @if($cotizacion->pago_unmes == 'TRUE') checked @endif>
                                <label class="form-check-label" for="defaultCheck1">
                                    A 30 DIAS DE GENERAR FACTURA
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="floatingInputGrid" class="mt-1"><b>OBSERVACIONES</b></label>
                            </div>
                            <div class="col-md text-start">
                                <button onclick="agregarObs()" class="btn btn-sm colorQA" id="agregarobs" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div id="rowObs">
                            @foreach($cotiobservaciones as $cotiobs)
                                <div class="row g-2" id="{{$cotiobs->id_cotiobs}}">
                                    <div class="col-md">
                                        <textarea class="form-control" name="observaciones[]" id="observaciones" autofocus style="text-transform:uppercase;" rows="2">{{old('observaciones', $cotiobs->obs)}}</textarea>
                                    </div>
                                    <div class="col-md-1 text-center align-middle">
                                        <button class="btn btn-danger mt-2" type="button" onclick="Obseliminar({{$cotiobs->id_cotiobs}})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div><br>
                            @endforeach
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col"></div>
                    <div class="col d-grid gap-2">
                        <input class="btn colorQA" type="submit" id="boton-guardar" value="GUARDAR">
                    </div>
                    <div class="col d-grid gap-2">
                        <a href="{{route('cotizaciones.search')}}" class="btn btn-danger " type="button" id="cancelar"role="button">CANCELAR</a>
                    </div>
                    <div class="col"></div>
                </div>
            </form>
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
    function fechaultimodia(){
        var fecha = document.getElementById("fecha_emision").value;
        var fecha_inicio = new Date(fecha);
        var fechaIni = new Date(fecha_inicio.setMinutes(fecha_inicio.getMinutes() + fecha_inicio.getTimezoneOffset()));
        console.log("FECHA INICIO"+fechaIni);
        
        var fecha_final = fechaIni.setDate(fechaIni.getDate() + 30);
        var fechaFin = new Date(fecha_final);
        console.log("FECHA FINAL" +fechaFin);
        var fechaFiny = fechaFin.getFullYear();
        console.log(fechaFiny);
        var fechaFinm = fechaFin.getMonth()+1;
        var fechaFinmm = (fechaFinm < 10 ? '0' : '')+fechaFinm;
        console.log(fechaFinmm);
        var fechaFind = fechaFin.getDate();
        var fechaFindd = (fechaFind < 10 ? '0' : '')+fechaFind;
        console.log(fechaFindd);
        document.getElementById("fecha_vencimiento").value = fechaFiny+'-'+fechaFinmm+'-'+fechaFindd;;
        
    }
    
    $(document).ready(function() {
        
       
        ////////IMPRIMIR EL NUMERO DE COTIZACION ////////
        var num = parseInt('{{$cotizacion->codigo_cotizacion}}');
        var n = num.toString().padStart(5,'0');
        console.log("ESTE ES EL CODIGO" +n);
        
        document.getElementById("numero_cotizacion_input").value = n;
        ////////OBTENER EL NUMERO MAXIMO DE LECTURAS SEGUN EL PERIDO SELECCIONADO////////
        
        var periodo = '{{$cotizacion->periodoLec}}';
        if(periodo == 'MENS'){
            document.getElementById('maxLectuasAño').innerHTML = '/ 12';
        }else if(periodo == 'TRIMS'){
            document.getElementById('maxLectuasAño').innerHTML = '/ 4';
        }else if(periodo == 'BIMS'){
            document.getElementById('maxLectuasAño').innerHTML = '/ 6';
        }
        ///////////OBTENER EL NUMERO DE LECTURAS O DE PERIODOS PARA EL SERVICIO DE TRANSPORTE//////
        $('#numlecturas_año').change(function(){
            var lecturas = document.getElementById('numlecturas_año').value;
            if(lecturas != 0 || lecturas != ''){
                document.getElementById('periodos').innerHTML = 'POR '+lecturas+' PERIODOS';
                document.getElementById('periodosReco').innerHTML = 'POR '+lecturas+' PERIODOS';
            }
        })
        ////////////// DESHABILITAR CAMPOS DE OBSEQUIO PARA EL SERVICIO DE TRANSPORTE//////

        element = document.getElementById("serviTransporteEnvio");
        check = document.getElementById("obsq_servitransporteEnvio");
        if (check.checked) {
            console.log("CHECKED");
            $('#serviTransporteEnvio').prop('hidden', true);
        }else{
            console.log("NO CHECKED");
            $('#serviTransporteEnvio').prop('hidden', false);
        }
      
        
        element = document.getElementById("serviTransporteReco");
        check = document.getElementById("obsq_servitransporteReco");
        if (check.checked) {
            console.log("CHECKED");
            $('#serviTransporteReco').prop('hidden', true);
        }else{
            console.log("NO CHECKED");
            $('#serviTransporteReco').prop('hidden', false);
        }
    })
      
       /*  //////OBTENEMOS LA CASILLA Y EL DESCUENTO POR PRONTO PAGO///////
        $('#descuento_pronto_pago').change(function(){
            console.log("descuentopp");
            var desPP = document.getElementById('descuento_pronto_pago').value;
            if(desPP != '' || desPP != 0){
                $('#desctoProntoPago').prop('hidden', false); 
                /////////OBTENEMOS EL DESCUENTO PRONTO PAGO POR PERIODO//////
                console.log("DESCUENTO PP"+desPP);
                var sumcostoPer = document.getElementById('totalAñoSDint_periodo').value;
                var descPPcostPer  = sumcostoPer *(desPP/100);
                console.log("DESCUENTO PP COST PERIODO"+ descPPcostPer);
                document.getElementById('descuento_prontopagoint_periodo').value = descPPcostPer;
                document.getElementById('descuento_prontopago_periodo').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(descPPcostPer);
                /////////OBTENEMOS EL DESCUENTO PRONTO PAGO POR AÑO//////
                var sumcostoAño = document.getElementById('totalAñoSDint_ano').value;
                var descPPcostAño  = sumcostoAño *(desPP/100);
                console.log("DESCUENTO PP COST AÑO"+ descPPcostAño);
                document.getElementById('descuento_prontopagoint_ano').value = descPPcostAño;
                document.getElementById('descuento_prontopago_ano').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(descPPcostAño);

                updateValorTotalyPromedio();
                
            }else{
                $('#desctoProntoPago').prop('hidden', true); 
            }
        });
        //////OBTENEMOS LA CASILLA Y EL DESCUENTO POR CORTESIA///////
        $('#descuento_cortesia').change(function(){
            console.log("descuentoCort");
            var desCort = document.getElementById('descuento_cortesia').value;
            if(desCort != '' || desCort != 0){
                $('#desctoCortesia').prop('hidden', false);
                /////////OBTENEMOS EL DESCUENTO CORTESIA POR PERIODO//////
                console.log("DESCUENTO CORTESIA"+desCort);
                var sumcostoPer = document.getElementById('totalAñoSDint_periodo').value;
                var descCortcostPer = sumcostoPer *(desCort/100);
                console.log("DESCUENTO CORTESIA COSTO PERIODO"+ descCortcostPer);
                document.getElementById('descuento_cortesiaint_periodo').value = descCortcostPer;
                document.getElementById('descuento_cortesia_periodo').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(descCortcostPer);
                /////////OBTENEMOS EL DESCUENTO CORTESIA POR AÑO//////
                var sumcostoAño = document.getElementById('totalAñoSDint_ano').value;
                var descCortcostAño = sumcostoAño *(desCort/100);
                console.log("DESCUENTO CORTESIA COSTO AÑO"+ descCortcostAño);
                document.getElementById('descuento_cortesiaint_ano').value = descCortcostAño;
                document.getElementById('descuento_cortesia_ano').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(descCortcostAño);

                updateValorTotalyPromedio();
                
            }else{
                $('#desctoCortesia').prop('hidden', true); 
            }
        });
       
        $('#servtransporte_periodo').change(function(){
            var envio = document.getElementById('servtransporte_periodo').value;
            console.log("ENVIO"+envio);
            var lecturas = document.getElementById('numlecturas_año').value;
            document.getElementById('servtransporteInt_ano').value = envio*lecturas;
            document.getElementById('servtransporte_ano').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(envio*lecturas);

            updateValorTotalyPromedio();
        });
        $('#servtransporteReco_periodo').change(function(){
            
            var reco = document.getElementById('servtransporteReco_periodo').value;
            console.log("RECOLECCION"+reco);
            var lecturas = document.getElementById('numlecturas_año').value;
            document.getElementById('servtransporteRecoInt_ano').value = reco*lecturas;
            document.getElementById('servtransporteReco_ano').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(reco*lecturas); 
            
            updateValorTotalyPromedio();
        });
    });
    var inicio = 1; */

    /* function agregarProducto(){
        var lec = document.getElementById("numlecturas_año").value;
        var periodo = document.getElementById("periodolec_producto").value;
        if((lec != '' || lec != 0) && periodo != ''){

            var selectProductos = document.createElement("select");
            @foreach($productos as $prod)
                option = document.createElement("option");
                option.value = '{{$prod->id_producto}}';
                option.text = '{{$prod->referencia}}';
                selectProductos.appendChild(option);
            @endforeach
            document.getElementById("body_productos").insertRow(-1).innerHTML += 
            `<tr id="Prod`+inicio+`">
                <td class="align-middle"></td>
                <td class='align-middle'>
                    <select class="form-select" name="ref_producto" id="ref_producto"  autofocus>
                        <option value="">--</option>
                        ${selectProductos.innerHTML}
                    </select>
                </td>
                <td class='align-middle'>
                    <textarea class="form-control" name="concepto_producto" id="concepto_producto" autofocus style="text-transform:uppercase;"></textarea>
                </td>
                <td class='align-middle'>
                    <input type="number" name="cantidad_producto" id="cantidad_producto" value="" class="form-control">
                </td>
                <td class='align-middle'>
                    <input type="text" name="costoUnd_producto" id="costoUnd_producto" value="" class="form-control">
                </td>
                <td class='align-middle'>
                    <select class="form-select" name="iva_producto" id="iva_producto"  autofocus>
                        <option value="">--</option>
                        <option value="19">19%</option>
                        <option value="0" selected>0% (EXENTO)</option>
                        <option value="16">16%</option>
                        <option value="5">5%</option>
                    </select>
                </td>
                <td class='align-middle'>
                    <input type="number" name="costoPeriodoInt_producto" id="costoPeriodoInt_producto" value="" class="form-control" hidden>
                    <input type="text" name="costoPeriodo_producto" id="costoPeriodo_producto" value="" class="form-control" readonly>
                </td>
                <td class='align-middle'>
                    <input type="number" name="costoAnoInt_producto" id="costoAnoInt_producto" value="" class="form-control" hidden>
                    <input type="text" name="costoAno_producto" id="costoAno_producto" value="" class="form-control" readonly>
                </td>
                <td class='align-middle text-center'>
                    <button class="btn btn-outline-danger" id="" type="button" onclick="eliminar(this)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                        </svg>
                    </button>
                </td>
                
            </tr>`;
            ////////SE INSERTA EL NUMERO DEL ITEM PARA CADA PRODUCTO //////
            var i = 1;
            $('#productos > tbody  > tr').each(function(e) {
                $(this)[0].cells[0].outerHTML='<td class="align-middle"><b>'+ i +'</b></td>';
                i++;
            });
    
            
            ///////////SE ENUMERAN LOS CAMPOS DE CADA PRODUCTO /////
            var refProd = document.querySelectorAll('select[name="ref_producto"]');
            for(var x = 0; x < refProd.length; x++){
                refProd[x].setAttribute("name", "ref_producto"+[i-1]);
                refProd[x].setAttribute("id", "ref_producto"+[i-1]);
            }
            var concProd = document.querySelectorAll('textarea[name="concepto_producto"]');
            for(var x = 0; x < concProd.length; x++){
                concProd[x].setAttribute("name", "concepto_producto"+[i-1]);
                concProd[x].setAttribute("id", "concepto_producto"+[i-1]);
            }
            var cantProd = document.querySelectorAll('input[name="cantidad_producto"]');
            for(var x = 0; x < cantProd.length; x++){
                cantProd[x].setAttribute("name", "cantidad_producto"+[i-1]);
                cantProd[x].setAttribute("id", "cantidad_producto"+[i-1]);
            }
            var cosUndProd = document.querySelectorAll('input[name="costoUnd_producto"]');
            for(var x = 0; x < cosUndProd.length; x++){
                cosUndProd[x].setAttribute("name", "costoUnd_producto"+[i-1]);
                cosUndProd[x].setAttribute("id", "costoUnd_producto"+[i-1]);
            }
            var ivaProd = document.querySelectorAll('select[name="iva_producto"]');
            for(var x = 0; x < ivaProd.length; x++){
                ivaProd[x].setAttribute("name", "iva_producto"+[i-1]);
                ivaProd[x].setAttribute("id", "iva_producto"+[i-1]);
            }
            var cosPerProd = document.querySelectorAll('input[name="costoPeriodo_producto"]');
            for(var x = 0; x < cosPerProd.length; x++){
                cosPerProd[x].setAttribute("name", "costoPeriodo_producto"+[i-1]);
                cosPerProd[x].setAttribute("id", "costoPeriodo_producto"+[i-1]);
            }
            var cosPerProdint = document.querySelectorAll('input[name="costoPeriodoInt_producto"]');
            for(var x = 0; x < cosPerProdint.length; x++){
                cosPerProdint[x].setAttribute("name", "costoPeriodoInt_producto"+[i-1]);
                cosPerProdint[x].setAttribute("id", "costoPeriodoInt_producto"+[i-1]);
            }
            var cosAnoProd = document.querySelectorAll('input[name="costoAno_producto"]');
            for(var x = 0; x < cosAnoProd.length; x++){
                cosAnoProd[x].setAttribute("name", "costoAno_producto"+[i-1]);
                cosAnoProd[x].setAttribute("id", "costoAno_producto"+[i-1]);
            }
            var cosPerProdint = document.querySelectorAll('input[name="costoAnoInt_producto"]');
            for(var x = 0; x < cosPerProdint.length; x++){
                cosPerProdint[x].setAttribute("name", "costoAnoInt_producto"+[i-1]);
                cosPerProdint[x].setAttribute("id", "costoAnoInt_producto"+[i-1]);
            }
            console.log("ESTA ES LA i="+i);
            ////////// SE OBTIENE EL VALOR SELECCIONADO PARA EL AUTOCOMPLEADO /////
            $('#ref_producto'+[i-1]).change(function(){
                var ref = document.getElementById('ref_producto'+[i-1]).value;
                console.log("VALOR SELECCIONADO" +ref);
                @foreach($productos as $prod)
                    if('{{$prod->id_producto}}' == ref){
                        document.getElementById('concepto_producto'+[i-1]).value = '{{$prod->concepto}}';
                        document.getElementById('costoUnd_producto'+[i-1]).value = '{{$prod->valor_unitario}}';
                    }
                @endforeach
            });
           
            $('#cantidad_producto'+[i-1]).change(function(){
                var cant = document.getElementById('cantidad_producto'+[i-1]).value;
                var ref = document.getElementById('ref_producto'+[i-1]).value;
                var costoUnid = document.getElementById('costoUnd_producto'+[i-1]).value;
                var totalSDperi = document.getElementById('totalAñoSDint_periodo').value;
                var totalSDAno = document.getElementById('totalAñoSDint_ano').value;
                var arrayPeriodo = [];
                var arrayAño = [];
                
                /////GUARDA EL COSTO DEL PERIODO PARA CADA PRODUCTO/////
                var costoPerProd = parseInt(costoUnid)*parseInt(cant);
                document.getElementById('costoPeriodoInt_producto'+[i-1]).value = costoPerProd;
                document.getElementById('costoPeriodo_producto'+[i-1]).value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(costoPerProd);
                
                /////GUARDA EL COSTO DEL AÑO PARA CADA PRODUCTO/////
                var numlecAnoProd = document.getElementById('numlecturas_año').value;
                var costAnoProd = costoPerProd*numlecAnoProd;
                document.getElementById('costoAnoInt_producto'+[i-1]).value = costAnoProd;
                document.getElementById('costoAno_producto'+[i-1]).value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(costAnoProd);
                
                /////GUARDA EL VALOR TOTAL SD SUMANDO LOS PRODUCTOS POR PERIODO/////
                var x = 0;
                $('#productos > tbody  > tr').each(function(e) {
                    x++;
                });
                console.log("# DE PRODUCTOS "+x);
                for(var y = 1; y <= x; y++){
                    var costoPer = document.getElementById('costoPeriodoInt_producto'+y).value;
                    console.log("costoPeriodoInt_producto"+y);
                    console.log(costoPer);
                    if(costoPer != 0 ){
                        console.log("PARA EL PRODUCTO"+y);
                        arrayPeriodo.push(costoPer); 
                    } 
                };
                console.log(arrayPeriodo);
                let totalPeriodo=0;
                arrayPeriodo.forEach(function(a){totalPeriodo += parseInt(a);});
                console.log(totalPeriodo);
                document.getElementById('totalAñoSDint_periodo').value = totalPeriodo;
                document.getElementById('totalAñoSD_periodo').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(totalPeriodo);

                /////GUARDA EL VALOR TOTAL SD SUMANDO LOS PRODUCTOS POR AÑO/////
                for(var y = 1; y <= x; y++){
                    var costoAño = document.getElementById('costoAnoInt_producto'+y).value;
                    console.log("costoAñoInt_producto"+y);
                    console.log(costoAño);
                    if(costoAño != 0 ){
                        console.log("PARA EL PRODUCTO"+y);
                        arrayAño.push(costoAño); 
                    } 
                };
                console.log(arrayAño);
                let totalAño=0;
                arrayAño.forEach(function(a){totalAño += parseInt(a);});
                console.log(totalAño);
                document.getElementById('totalAñoSDint_ano').value = totalAño;
                document.getElementById('totalAñoSD_ano').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(totalAño);
                
                
                ///////OBTENEMOS EL DESCUENTO POR PRONTO PAGO POR PERIODO//////
                var desPP = document.getElementById('descuento_pronto_pago').value;
                if(desPP != '' || desPP != 0){
                    console.log("DESCUENTO PP"+desPP);
                    var descPPcostPer  = totalPeriodo *(desPP/100);
                    console.log("DESCUENTO PP COST PERIODO"+ descPPcostPer);
                    document.getElementById('descuento_prontopagoint_periodo').value = descPPcostPer;
                    document.getElementById('descuento_prontopago_periodo').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(descPPcostPer);
                    /////////OBTENEMOS EL DESCUENTO PRONTO PAGO POR AÑO//////
                    var descPPcostAño  = totalAño *(desPP/100);
                    console.log("DESCUENTO PP COST AÑO"+ descPPcostAño);
                    document.getElementById('descuento_prontopagoint_ano').value = descPPcostAño;
                    document.getElementById('descuento_prontopago_ano').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(descPPcostAño);
                }
                ///////OBTENEMOS EL DESCUENTO POR CORTESIA POR PERIODO//////
                var desCort = document.getElementById('descuento_cortesia').value;
                if(desCort != '' || desCort != 0){
                    console.log("DESCUENTO CORTESIA"+desCort);
                    var descCortcostPer = totalPeriodo *(desCort/100);
                    console.log("DESCUENTO CORTESIA COSTO AÑO"+ descCortcostPer);
                    document.getElementById('descuento_cortesiaint_periodo').value = descCortcostPer;
                    document.getElementById('descuento_cortesia_periodo').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(descCortcostPer);
                    /////////OBTENEMOS EL DESCUENTO CORTESIA POR AÑO//////
                    var descCortcostAño = totalAño *(desCort/100);
                    console.log("DESCUENTO CORTESIA COSTO AÑO"+ descCortcostAño);
                    document.getElementById('descuento_cortesiaint_ano').value = descCortcostAño;
                    document.getElementById('descuento_cortesia_ano').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(descCortcostAño);
                };
                updateValorTotalyPromedio();
                         
                
            });
            $('#costoUnd_producto'+[i-1]).change(function(){
                var cant = document.getElementById('cantidad_producto'+[i-1]).value;
                var ref = document.getElementById('ref_producto'+[i-1]).value;
                var costoUnid = document.getElementById('costoUnd_producto'+[i-1]).value;
                var totalSDperi = document.getElementById('totalAñoSDint_periodo').value;
                var totalSDAno = document.getElementById('totalAñoSDint_ano').value;
                var arrayPeriodo = [];
                var arrayAño = [];
                
                /////GUARDA EL COSTO DEL PERIODO PARA CADA PRODUCTO/////
                var costoPerProd = parseInt(costoUnid)*parseInt(cant);
                document.getElementById('costoPeriodoInt_producto'+[i-1]).value = costoPerProd;
                document.getElementById('costoPeriodo_producto'+[i-1]).value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(costoPerProd);
                
                /////GUARDA EL COSTO DEL AÑO PARA CADA PRODUCTO/////
                var numlecAnoProd = document.getElementById('numlecturas_año').value;
                var costAnoProd = costoPerProd*numlecAnoProd;
                document.getElementById('costoAnoInt_producto'+[i-1]).value = costAnoProd;
                document.getElementById('costoAno_producto'+[i-1]).value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(costAnoProd);
                
                /////GUARDA EL VALOR TOTAL SD SUMANDO LOS PRODUCTOS POR PERIODO/////
                var x = 0;
                $('#productos > tbody  > tr').each(function(e) {
                    x++;
                });
                console.log("# DE PRODUCTOS "+x);
                for(var y = 1; y <= x; y++){
                    var costoPer = document.getElementById('costoPeriodoInt_producto'+y).value;
                    console.log("costoPeriodoInt_producto"+y);
                    console.log(costoPer);
                    if(costoPer != 0 ){
                        console.log("PARA EL PRODUCTO"+y);
                        arrayPeriodo.push(costoPer); 
                    } 
                };
                console.log(arrayPeriodo);
                let totalPeriodo=0;
                arrayPeriodo.forEach(function(a){totalPeriodo += parseInt(a);});
                console.log(totalPeriodo);
                document.getElementById('totalAñoSDint_periodo').value = totalPeriodo;
                document.getElementById('totalAñoSD_periodo').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(totalPeriodo);

                /////GUARDA EL VALOR TOTAL SD SUMANDO LOS PRODUCTOS POR AÑO/////
                for(var y = 1; y <= x; y++){
                    var costoAño = document.getElementById('costoAnoInt_producto'+y).value;
                    console.log("costoAñoInt_producto"+y);
                    console.log(costoAño);
                    if(costoAño != 0 ){
                        console.log("PARA EL PRODUCTO"+y);
                        arrayAño.push(costoAño); 
                    } 
                };
                console.log(arrayAño);
                let totalAño=0;
                arrayAño.forEach(function(a){totalAño += parseInt(a);});
                console.log(totalAño);
                document.getElementById('totalAñoSDint_ano').value = totalAño;
                document.getElementById('totalAñoSD_ano').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(totalAño);
                
                
                ///////OBTENEMOS EL DESCUENTO POR PRONTO PAGO POR PERIODO//////
                var desPP = document.getElementById('descuento_pronto_pago').value;
                if(desPP != '' || desPP != 0){
                    console.log("DESCUENTO PP"+desPP);
                    var descPPcostPer  = totalPeriodo *(desPP/100);
                    console.log("DESCUENTO PP COST PERIODO"+ descPPcostPer);
                    document.getElementById('descuento_prontopagoint_periodo').value = descPPcostPer;
                    document.getElementById('descuento_prontopago_periodo').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(descPPcostPer);
                    /////////OBTENEMOS EL DESCUENTO PRONTO PAGO POR AÑO//////
                    var descPPcostAño  = totalAño *(desPP/100);
                    console.log("DESCUENTO PP COST AÑO"+ descPPcostAño);
                    document.getElementById('descuento_prontopagoint_ano').value = descPPcostAño;
                    document.getElementById('descuento_prontopago_ano').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(descPPcostAño);
                }
                ///////OBTENEMOS EL DESCUENTO POR CORTESIA POR PERIODO//////
                var desCort = document.getElementById('descuento_cortesia').value;
                if(desCort != '' || desCort != 0){
                    console.log("DESCUENTO CORTESIA"+desCort);
                    var descCortcostPer = totalPeriodo *(desCort/100);
                    console.log("DESCUENTO CORTESIA COSTO AÑO"+ descCortcostPer);
                    document.getElementById('descuento_cortesiaint_periodo').value = descCortcostPer;
                    document.getElementById('descuento_cortesia_periodo').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(descCortcostPer);
                    /////////OBTENEMOS EL DESCUENTO CORTESIA POR AÑO//////
                    var descCortcostAño = totalAño *(desCort/100);
                    console.log("DESCUENTO CORTESIA COSTO AÑO"+ descCortcostAño);
                    document.getElementById('descuento_cortesiaint_ano').value = descCortcostAño;
                    document.getElementById('descuento_cortesia_ano').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(descCortcostAño);
                };
                updateValorTotalyPromedio();
                         
                
            });
        }else{
            Swal.fire({
                title:"SELECCIONE EL PERIODO DE LECTURA E INGRESE EL NÚMERO DE LECTURAS AL AÑO PARA PODER AGREGAR UN PRODUCTO",
                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                icon: 'error'
            });
        }
        
    } */

    
    /* function eliminar(row){
        
        var d = row.parentNode.parentNode.rowIndex;
        console.log("ESTA ES LA d"+d);
         //////RESTAR AL VALOR TOTAL SD DEL PERIODO /////
        var valorTotalPer = document.getElementById('totalAñoSDint_periodo').value;
        var costoPer = document.getElementById('costoPeriodoInt_producto'+d).value;
        console.log("VALOR TOTAL DEL PERIODO "+valorTotalPer+ " COSTO DEL PERIODO"+costoPer);
        var restaPer = valorTotalPer - costoPer;
        console.log("RESTA EN EL VALOR TOTAL DEL PERIODO "+restaPer);
        document.getElementById('totalAñoSDint_periodo').value = restaPer;
        document.getElementById('totalAñoSD_periodo').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(restaPer);
        //////RESTAR AL VALOR TOTAL SD DEL AÑO /////
        var valorTotalAño = document.getElementById('totalAñoSDint_ano').value;
        var costoAño = document.getElementById('costoAnoInt_producto'+d).value;
        console.log("VALOR TOTAL DEL AÑO "+valorTotalAño+ " COSTO DEL AÑO PRODUCTO"+costoAño);
        var restaAño = valorTotalAño - costoAño;
        console.log("RESTA EN EL VALOR TOTAL DEl AÑO "+restaAño);
        document.getElementById('totalAñoSDint_ano').value = restaAño;
        document.getElementById('totalAñoSD_ano').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(restaAño);
        ///////ACTUALIZAMOS EL DESCUENTO POR PRONTO PAGO POR PERIODO//////
        var desPP = document.getElementById('descuento_pronto_pago').value;
        if(desPP != '' || desPP != 0){
            console.log("DESCUENTO PP"+desPP);
            var descPPcostPer  = restaPer *(desPP/100);
            console.log("DESCUENTO PP COST PERIODO"+ descPPcostPer);
            document.getElementById('descuento_prontopagoint_periodo').value = descPPcostPer;
            document.getElementById('descuento_prontopago_periodo').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(descPPcostPer);
            /////////ACTUALIZAMOS EL DESCUENTO PRONTO PAGO POR AÑO//////
            var descPPcostAño  = restaAño *(desPP/100);
            console.log("DESCUENTO PP COST AÑO"+ descPPcostAño);
            document.getElementById('descuento_prontopagoint_ano').value = descPPcostAño;
            document.getElementById('descuento_prontopago_ano').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(descPPcostAño);
        }
        ///////ACTUALIZAMOS EL DESCUENTO POR CORTESIA POR PERIODO//////
        var desCort = document.getElementById('descuento_cortesia').value;
        if(desCort != '' || desCort != 0){
            console.log("DESCUENTO CORTESIA"+desCort);
            var descCortcostPer = restaPer *(desCort/100);
            console.log("DESCUENTO CORTESIA COSTO AÑO"+ descCortcostPer);
            document.getElementById('descuento_cortesiaint_periodo').value = descCortcostPer;
            document.getElementById('descuento_cortesia_periodo').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(descCortcostPer);
            /////////ACTUALIZAMOS EL DESCUENTO CORTESIA POR AÑO//////
            var descCortcostAño = restaAño *(desCort/100);
            console.log("DESCUENTO CORTESIA COSTO AÑO"+ descCortcostAño);
            document.getElementById('descuento_cortesiaint_ano').value = descCortcostAño;
            document.getElementById('descuento_cortesia_ano').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(descCortcostAño);
        }
        updateValorTotalyPromedio();
        
        /////// SE ELIMINA LA FILA DE LA TABLA, ES DECIR EL PRODUCTO Y SE ACTUALIZA EL NUMERO DEL ITEM///////
        document.getElementById('productos').deleteRow(d);
        
        var i = 1;
        $('#productos > tbody  > tr').each(function(e) {
        $(this)[0].cells[0].outerHTML='<td class="align-middle"><b>'+ i +'</b></td>';
            i++;
        });
        

    }
    function updateValorTotalyPromedio(){
        //////OBTENEMOS EL VALOR TOTAL DEL SERVICIO INCLUIDO TRANSPORTE Y DESCUENTOS/////
        var valorTotalSDper = document.getElementById('totalAñoSDint_periodo').value != '' ? document.getElementById('totalAñoSDint_periodo').value : 0;
        var valorTotalSDaño = document.getElementById('totalAñoSDint_ano').value != '' ? document.getElementById('totalAñoSDint_ano').value : 0;
        var descPPper = document.getElementById('descuento_prontopagoint_periodo').value != '' ? document.getElementById('descuento_prontopagoint_periodo').value : 0;
        var descPPaño = document.getElementById('descuento_prontopagoint_ano').value != '' ? document.getElementById('descuento_prontopagoint_ano').value : 0;
        var descCortper = document.getElementById('descuento_cortesiaint_periodo').value != '' ? document.getElementById('descuento_cortesiaint_periodo').value : 0;
        var descCortaño = document.getElementById('descuento_cortesiaint_ano').value != '' ? document.getElementById('descuento_cortesiaint_ano').value : 0;
        var tranEnvioPer = document.getElementById('servtransporte_periodo').value != '' ? document.getElementById('servtransporte_periodo').value : 0;
        var tranEnvioAño = document.getElementById('servtransporteInt_ano').value != '' ? document.getElementById('servtransporteInt_ano').value : 0;
        var tranRecoPer = document.getElementById('servtransporteReco_periodo').value != '' ? document.getElementById('servtransporteReco_periodo').value : 0;
        var tranRecoAño = document.getElementById('servtransporteRecoInt_ano').value != '' ? document.getElementById('servtransporteRecoInt_ano').value : 0;

        var sumaValorTotalper = parseInt(valorTotalSDper) - (parseInt(descPPper) + parseInt(descCortper)) + parseInt(tranEnvioPer) + parseInt(tranRecoPer);
        console.log("VALOR SD PER ="+valorTotalSDper);
        console.log("DESCUENTO PP PER ="+descPPper);
        console.log("DESCUENTO CORTESIA PER ="+descCortper);
        console.log("TRANSPORTE ENVIO PER ="+tranEnvioPer);
        console.log("TRANSPORTE RECOLECCION PER ="+tranRecoPer);
        console.log("SUMA DEL VALOR TOTAL PER ="+sumaValorTotalper);
        document.getElementById('totalservicioInt_periodo').value = sumaValorTotalper;
        document.getElementById('totalservicio_periodo').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(sumaValorTotalper); 

        console.log("***********");
        var sumaValorTotalaño = parseInt(valorTotalSDaño) - (parseInt(descPPaño) + parseInt(descCortaño)) + parseInt(tranEnvioAño) + parseInt(tranRecoAño);
        console.log("VALOR SD AÑO ="+valorTotalSDaño);
        console.log("DESCUENTO PP AÑO ="+descPPaño);
        console.log("DESCUENTO CORTESIA AÑO ="+descCortaño);
        console.log("TRANSPORTE ENVIO AÑO ="+tranEnvioAño);
        console.log("TRANSPORTE RECOLECCION AÑO ="+tranRecoAño);
        console.log("SUMA DEL VALOR TOTAL AÑO="+sumaValorTotalaño);
        document.getElementById('totalservicioInt_ano').value = sumaValorTotalaño;
        document.getElementById('totalservicio_ano').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(sumaValorTotalaño);
        ///////// OBTENEMOS EL VALOR PROMEDIO POR DOSIMETRO MENSUAL PARA LA VENTA///////
        var x = 0;
        var arrayCant = [];
        $('#productos > tbody  > tr').each(function(e) {
            x++;
        });
        document.getElementById('totalProductos').value = x;
        console.log("# DE PRODUCTOS "+x);
        for(var y = 1; y <= x; y++){
            var cant = document.getElementById('cantidad_producto'+y).value;
            console.log("cantidad_producto"+y);
            console.log(cant);
            if(cant != 0 ){
                console.log("PARA EL PRODUCTO"+y);
                arrayCant.push(cant); 
            } 
        };
        console.log("ARRAY CANTIDAD DE DOSIMETROS POR PRODUCTO  = ")
        console.log(arrayCant);
        let totalcantidadDosi=0;
        arrayCant.forEach(function(a){totalcantidadDosi += parseInt(a);});
        console.log(totalcantidadDosi);
        console.log("SUMA DEL VALOR TOTAL PER ="+sumaValorTotalper);
        console.log("SUMA DEL VALOR TOTAL TRANSPORTE ="+ (parseInt(tranEnvioPer)+parseInt(tranRecoPer)));
        var promedioDosim = (sumaValorTotalper-(parseInt(tranEnvioPer)+parseInt(tranRecoPer)))/ totalcantidadDosi;
        console.log("PROMEDIO DOSIMETRO sin transporte= "+promedioDosim);
        var numLecturasAño = document.getElementById('numlecturas_año').value;
        var promedioDosimMes = promedioDosim / (12/parseInt(numLecturasAño));
        console.log("PROMEDIO DOSIMETRO POR MES = "+promedioDosimMes);
        
        document.getElementById('promedioDosiMesInt').value = promedioDosimMes;
        document.getElementById('promedioDosimMes').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(promedioDosimMes);
    } */
    function agregarObs(){
        var obs = `<div class="row g-2" id="obs">
                        <div class="col-md">
                            <textarea class="form-control" name="observaciones[]" id="observaciones" autofocus style="text-transform:uppercase;" rows="2"></textarea>
                        </div>
                        <div class="col-md-1 text-center align-middle">
                            <button class="btn btn-danger mt-2" type="button" onclick="eliminarObs(this)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                </svg>
                            </button>
                        </div>
                    </div><br>`;
        $("#rowObs").append(obs);
    }
    function eliminarObs(obs){
        $("#obs").remove();
    }
    function Obseliminar(id){
        $("#"+id).remove();
    }
    $(document).ready(function() {
        $('#form_edit_cotizacion').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "DESEA EDITAR ESTA COTIZACIÓN ??",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI, SEGURO!'
                }).then((result) => {
                if (result.isConfirmed) {
                    var cotizacion = '{{$cotizacion->codigo_cotizacion}}';
                    var host = window.location.host;
                    var path = "http://"+host+"/POSITRON/public/cotizaciones/"+cotizacion+"/pdf";
                    
                    this.submit();
                    window.open(path, '_blank');
                }
            })
        })
        
    })
</script>
@endsection