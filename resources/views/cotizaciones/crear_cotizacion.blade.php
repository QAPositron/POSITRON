@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col"></div>
    <div class="col-12">
        <div class="card text-dark bg-light">
            <h2 class="text-center mt-3">CREAR COTIZACIÓN DE DOSIMETRÍA</h2>
            <br>
            <form class="m-4" action="{{route('cotizaciones.save')}}" method="POST" id="form_cotizacion">

                @csrf
                <div class="row">
                    <div class="col-md">
                        <div class="form-floating my-3" id="numero_cotizacion">
                            <input type="number" name="numero_cotizacion" id="numero_cotizacion_input" value="" class="form-control @error('numero_cotizacion') is-invalid @enderror" readonly>
                            <label for="floatingInputGrid">NÚMERO</label>
                            @error('numero_cotizacion')
                                <small class="invalid-feedback">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md mt-3">
                        <div class="form-group">
                            <label for="floatingInputGrid">EMPRESA</label>
                            <select class="form-control @error('empresa') is-invalid @enderror"  name="empresa" id="empresa" value="{{old('empresa')}}" autofocus style="text-transform:uppercase">
                                <option value="">--SELECCIONE--</option>
                                @foreach($empresas as $emp)
                                    <option value ="{{$emp->id_empresa}}" @if (old('empresa') == $emp->id_empresa) {{ 'selected' }} @endif>{{$emp->nombre_empresa}}</option>
                                @endforeach
                            </select>
                            @error('empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md mt-3" id="div_sede">
                        <div class="spinner_sede text-center" id="spinner_sede">

                        </div>
                        <div class="form-group" id="sede_empresa" name="sede_empresa">
                            <label for="floatingInputGrid">SEDE</label>
                            <select class="form-control @error('sede') is-invalid @enderror" name="sede" id="sede" value="{{old('sede')}}" autofocus style="text-transform:uppercase">
                                <option value="">--SELECCIONE--</option>
                            </select>
                            @error('sede') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                    
                </div>
                <br>
                <div class="row">
                    <div class="col-md">
                        <div class="form-floating">
                            <input value="" type="date" class="form-control @error('fecha_emision') is-invalid @enderror" name="fecha_emision" id="fecha_emision" onchange="fechaultimodia();" >
                            <label for="floatingInputGrid">FECHA EMISIÓN</label>
                            @error('fecha_emision')
                                <small class="invalid-feedback">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input value="" type="date" class="form-control @error('fecha_vencimiento') is-invalid @enderror" name="fecha_vencimiento" id="fecha_vencimiento" {{-- onchange="fechaultimodia();" --}} >
                            <label for="floatingInputGrid">FECHA VENCIMIENTO</label>
                            @error('fecha_vencimiento')
                                <small class="invalid-feedback">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select" name="periodolec_producto" id="periodolec_producto" autofocus>
                                <option value="">--</option>
                                <option value="MENS">MENSUAL</option>
                                <option value="BIMS">BIMESTRAL</option>
                                <option value="TRIMS">TRIMESTRAL</option>
                            </select>
                            <label for="floatingSelectGrid">PERIODO LECTURA:</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <label>LECTURAS AL AÑO:</label>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="number" name="totalProductos" id="totalProductos" value="" class="form-control" hidden>
                                <input type="number" name="numlecturas_año" id="numlecturas_año" value="" class="form-control">
                            </div>
                            <div class="col-md mt-2">
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
                        <div class="form-group ">
                            <input type="number" name="descuento_pronto_pago" id="descuento_pronto_pago" value="" class="form-control  @error('descuento_pronto_pago') is-invalid @enderror" style="width: 80px;">
                            @error('descuento_pronto_pago')<small class="invalid-feedback">*{{$message}}</small>@enderror
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
                            <input type="number" name="descuento_cortesia" id="descuento_cortesia" value="" class="form-control @error('descuento_cortesia') is-invalid @enderror" style="width: 80px;">
                            @error('descuento_cortesia')<small class="invalid-feedback">*{{$message}}</small>@enderror
                        </div>
                    </div>
                    <div class="col-md-1 text-start align-middle mt-2 ps-0">
                        <label  for="floatingInputGrid">%</label>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="TRUE" id="obsq_servitransporteEnvio" name="obsq_servitransporteEnvio" {{-- onchange="showContentEnvio();" --}}>
                            <label class="form-check-label" for="defaultCheck1">
                                OBSEQUIO EN EL SERVICIO DE TRANSPORTE (ENVÍO)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="TRUE" id="obsq_servitransporteReco" name="obsq_servitransporteReco" {{-- onchange="showContentReco();" --}}>
                            <label class="form-check-label" for="defaultCheck1">
                                OBSEQUIO EN EL SERVICIO DE TRANSPORTE (RECOLECCIÓN)
                            </label>
                        </div>
                    </div>
                </div>
                <br>
                <label class="text-center ms-4">ASIGNE A ESTA COTIZACIÓN UNO O MAS PRODUCTOS:</label>
                   
                <div class="row mt-2">
                    
                    <div class="col-md text-center">
                        
                        <button onclick="agregarProducto()" class="btn btn-sm colorQA" id="agregar" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus mb-1" viewBox="0 0 16 16">
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>AÑADIR PRODUCTO
                        </button>
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
                              <th></th>
                            </tr>
                        </thead>
                        <tbody id="body_productos">
                           
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6" class="text-end"><b>VALOR TOTAL SIN DESCUENTO</b></td>
                                <td>
                                    <div class="form-group">
                                        {{-- <input type="number" name="totalAñoSDvar_periodo" id="totalAñoSDvar_periodo" value="" class="form-control " hidden> --}}
                                        <input type="number" name="totalAñoSDint_periodo" id="totalAñoSDint_periodo" value="" class="form-control " hidden>
                                        <input type="text" name="totalAñoSD_periodo" id="totalAñoSD_periodo" value="" class="form-control" readonly>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        {{-- <input type="number" name="totalAñoSDvar_ano" id="totalAñoSDvar_ano" value="" class="form-control " hidden> --}}
                                        <input type="number" name="totalAñoSDint_ano" id="totalAñoSDint_ano" value="" class="form-control " hidden>
                                        <input type="text" name="totalAñoSD_ano" id="totalAñoSD_ano" value="" class="form-control "readonly>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr id="desctoCortesia" hidden>
                                <td colspan="6" class="text-end"><b>(-) DESCUENTO CORTESÍA</b></td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="descuento_cortesiaint_periodo" id="descuento_cortesiaint_periodo" value="" class="form-control " hidden>
                                        <input type="text" name="descuento_cortesia_periodo" id="descuento_cortesia_periodo" value="" class="form-control" readonly>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="descuento_cortesiaint_ano" id="descuento_cortesiaint_ano" value="" class="form-control " hidden>
                                        <input type="text" name="descuento_cortesia_ano" id="descuento_cortesia_ano" value="" class="form-control" readonly>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr id="desctoProntoPago" hidden>
                                <td colspan="6" class="text-end"><b>(-) DESCUENTO PRONTO PAGO</b></td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="descuento_prontopagoint_periodo" id="descuento_prontopagoint_periodo" value="" class="form-control " hidden>
                                        <input type="text" name="descuento_prontopago_periodo" id="descuento_prontopago_periodo" value="" class="form-control " readonly>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="descuento_prontopagoint_ano" id="descuento_prontopagoint_ano" value="" class="form-control " hidden>
                                        <input type="text" name="descuento_prontopago_ano" id="descuento_prontopago_ano" value="" class="form-control " readonly>
                                    </div>
                                </td>
                                <td></td>
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
                                                <input type="number" name="servtransporte_periodo" id="servtransporte_periodo" value="" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="servtransporteInt_ano" id="servtransporteInt_ano" value="" class="form-control" hidden>
                                        <input type="text" name="servtransporte_ano" id="servtransporte_ano" value="" class="form-control" readonly>
                                    </div>
                                </td>
                                <td></td>
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
                                                <input type="number" name="servtransporteReco_periodo" id="servtransporteReco_periodo" value="" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="servtransporteRecoInt_ano" id="servtransporteRecoInt_ano" value="" class="form-control" hidden>
                                        <input type="text" name="servtransporteReco_ano" id="servtransporteReco_ano" value="" class="form-control" readonly>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-end"><b>VALOR TOTAL DEL SERVICIO</b></td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="totalservicioInt_periodo" id="totalservicioInt_periodo" value="" class="form-control" hidden>
                                        <input type="text" name="totalservicio_periodo" id="totalservicio_periodo" value="" class="form-control" readonly>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="totalservicioInt_ano" id="totalservicioInt_ano" value="" class="form-control" hidden>
                                        <input type="text" name="totalservicio_ano" id="totalservicio_ano" value="" class="form-control" readonly>
                                    </div>
                                </td>
                                <td></td>
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
                            <input type="number" name="promedioDosiMesInt" id="promedioDosiMesInt" value="" class="form-control" hidden>
                            <input type="text" name="promedioDosimMes" id="promedioDosimMes" value="" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for=""><b>FORMAS DE PAGO:</b></label>
                            <br>
                            <br>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="TRUE" id="fpago_anticipado" name="fpago_anticipado">
                                <label class="form-check-label" for="defaultCheck1">
                                    100% ANTICIPADO MENSUAL O ANUAL
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="TRUE" id="fpago_unmes" name="fpago_unmes">
                                <label class="form-check-label" for="defaultCheck1">
                                    A 30 DIAS DE GENERAR FACTURA
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <label for="floatingInputGrid"><b>OBSERVACIONES</b></label>
                        <textarea class="form-control" name="observaciones" id="observaciones" autofocus style="text-transform:uppercase;" rows="5"></textarea>
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
        $('#empresa').select2();
        $('#sede').select2();
        $('#empresa').on('change', function(){
            $('#sede_empresa').fadeOut();
            $('#spinner_sede').html('<div class="spinner-border text-secondary" id="spinner" role="status"></div>');
            var empresa_id = $(this).val();
        
            var padre = document.getElementById("spinner_sede");
            var hijo = document.getElementById("spinner");
            /* alert(departamento_id); */
            if($.trim(empresa_id) != ''){
                $.get('selectsedes', {empresa_id: empresa_id}, function(sedes){
                    console.log(sedes);
                    var remove = padre.removeChild(hijo);
                    $('#sede_empresa').fadeIn();
                    $('#sede').empty();
                    $('#sede').append("<option value=''>--SELECCIONE--</option>");
                    $.each(sedes, function(index, value){
                        $('#sede').append("<option value='"+ index + "'>" + value + "</option>");
                    })
                });
            }
        });
        ////////IMPRIMIR EL NUMERO DE COTIZACION ////////
        var num = parseInt('{{empty($codigocotiant->codigo_cotizacion) ? 0 : $codigocotiant->codigo_cotizacion}}')+1;
        var n = num.toString().padStart(5,'0');
        console.log("ESTE ES EL CODIGO" +n);
        
        document.getElementById("numero_cotizacion_input").value = n;
        ////////OBTENER EL NUMERO MAXIMO DE LECTURAS SEGUN EL PERIDO SELECCIONADO////////
        $('#periodolec_producto').change(function(){
            var periodo = document.getElementById('periodolec_producto').value;
            if(periodo == 'MENS'){
                document.getElementById('maxLectuasAño').innerHTML = '/ 12';
            }else if(periodo == 'TRIMS'){
                document.getElementById('maxLectuasAño').innerHTML = '/ 4';
            }else if(periodo == 'BIMS'){
                document.getElementById('maxLectuasAño').innerHTML = '/ 6';
            }
        });
        ///////////OBTENER EL NUMERO DE LECTURAS O DE PERIODOS PARA EL SERVICIO DE TRANSPORTE//////
        $('#numlecturas_año').change(function(){
            var lecturas = document.getElementById('numlecturas_año').value;
            if(lecturas != 0 || lecturas != ''){
                document.getElementById('periodos').innerHTML = 'POR '+lecturas+' PERIODOS';
                document.getElementById('periodosReco').innerHTML = 'POR '+lecturas+' PERIODOS';
            }
        })
        ////////////// DESHABILITAR CAMPOS DE OBSEQUIO PARA EL SERVICIO DE TRANSPORTE//////
        $('#obsq_servitransporteEnvio').change(function(){
            element = document.getElementById("serviTransporteEnvio");
            check = document.getElementById("obsq_servitransporteEnvio");
            if (check.checked) {
                console.log("CHECKED");
                $('#serviTransporteEnvio').prop('hidden', true);
            }else{
                console.log("NO CHECKED");
                $('#serviTransporteEnvio').prop('hidden', false);
            }
        });
        $('#obsq_servitransporteReco').change(function(){
            element = document.getElementById("serviTransporteReco");
            check = document.getElementById("obsq_servitransporteReco");
            if (check.checked) {
                console.log("CHECKED");
                $('#serviTransporteReco').prop('hidden', true);
            }else{
                console.log("NO CHECKED");
                $('#serviTransporteReco').prop('hidden', false);
            }
        });
        //////OBTENEMOS LA CASILLA Y EL DESCUENTO POR PRONTO PAGO///////
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
    var inicio = 1;

    function agregarProducto(){
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
        }else{
            Swal.fire({
                title:"SELECCIONE EL PERIODO DE LECTURA E INGRESE EL NÚMERO DE LECTURAS AL AÑO PARA PODER AGREGAR UN PRODUCTO",
                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                icon: 'error'
            });
        }
        
    }

    
    function eliminar(row){
        
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
    }
    $(document).ready(function() {
        
        $('#form_cotizacion').submit(function(e){
            e.preventDefault();
            ///////////////////////VALIDACION PARA LA EMPRESA Y SEDE /////////////////
            var empresa = document.getElementById("empresa").value;
            if(empresa == ''){
                return Swal.fire({
                            title:"FALTA SELECCIONAR LA EMPRESA",
                            text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                            icon: 'error'
                        });
                    
            };
            var sede = document.getElementById("sede_empresa").value;
            if(sede == ''){
                return Swal.fire({
                            title:"FALTA SELECCIONAR LA SEDE SUBSCRITA A DICHA EMPRESA",
                            text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                            icon: 'error'
                        });
            };
            ///////////////////////VALIDACION PARA LAS FECHAS/////////////////
            var fecha_emision = document.getElementById("fecha_emision").value;
            if(fecha_emision == ''){
                return Swal.fire({
                            title:"FALTA SELECCIONAR LA FECHA DE EMISIÓN",
                            text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                            icon: 'error'
                        });
            };
            var fecha_vencimiento = document.getElementById("fecha_vencimiento").value;
            if(fecha_vencimiento == ''){
                return Swal.fire({
                            title:"FALTA SELECCIONAR LA FECHA DE VENCIMIENTO",
                            text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                            icon: 'error'
                        });
                    
            };
            ///////////////////////VALIDACION PARA EL PERIODO Y NUMERO DE LECTURAS/////////////////
            var periodo = document.querySelectorAll('select[name="periodolec_producto"]');
            for(var i = 0; i < periodo.length; i++){
                var values = periodo[i].value;
                if(values == ''){
                    return Swal.fire({
                        title:"SELECCIONE EL PERIODO DE LECTURA",
                        text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                        icon: 'error'
                    });
                }
            }
            var lec = document.getElementById('numlecturas_año').value;
            if( lec == ''){
                return Swal.fire({
                        title:" INGRESE EL NÚMERO DE LECTURAS AL AÑO PARA PODER AGREGAR UN PRODUCTO",
                        text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                        icon: 'error'
                    });
            };
            ///////////////////////VALIDACION PARA EL PROMEDIO DEL DOSIMETRO MES/////////////////
            var promedio = document.querySelectorAll('input[id="promedioDosiMesInt"]');
            for(var i = 0; i < promedio.length; i++){
                var values = promedio[i].value;
                if(values == ''){
                    return Swal.fire({
                                title:"NO HAY NINGUN PROMEDIO, AÑADA UN PRODUCTO !!",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                }
            }
            
            /* ///////////////////////VALIDACION PARA LAS FORMAS DE PAGO/////////////////
            var fpago_anticipado = document.getElementById('fpago_anticipado');
            var fp_unmes = document.getElementById("fpago_un'mes");
            if(!fpago_anticipado.checked && !fp_unmes.checked){
                return Swal.fire({
                        title:"SELECCIONE ALGUNA FORMA DE PAGO",
                        text: "SELECCIONE LA INFORMACIÓN DESEADA",
                        icon: 'error'
                    });
            } */
            
            

            Swal.fire({
                text: "DESEA GUARDAR ESTA COTIZACIÓN ??",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI, SEGURO!'
                }).then((result) => {
                if (result.isConfirmed) {
                    var cotizacion = document.getElementById("numero_cotizacion_input").value;
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