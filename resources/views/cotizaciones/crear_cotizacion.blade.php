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
                </div>
                <br>
                <div class="row">
                    <div class="col-md">
                        <label for="floatingInputGrid"></label>
                    </div>
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
                    <div class="col-md"></div>
                </div>
                <br>
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
                              <th scope="col" style="width: 20%;">CONCEPTO</th>
                              <th scope="col" style="width: 10%;">PERIODO LECTURA</th>
                              <th scope="col" style="width: 5%;">LECTURAS AL AÑO</th>
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
                                <td colspan="8" class="text-end"><b>VALOR TOTAL SIN DESCUENTO</b></td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="totalAñoSDvar_periodo" id="totalAñoSDvar_periodo" value="" class="form-control " hidden>
                                        <input type="number" name="totalAñoSDint_periodo" id="totalAñoSDint_periodo" value="" class="form-control " hidden>
                                        <input type="text" name="totalAñoSD_periodo" id="totalAñoSD_periodo" value="" class="form-control" readonly>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="totalAñoSDvar_ano" id="totalAñoSDvar_ano" value="" class="form-control " hidden>
                                        <input type="number" name="totalAñoSDint_ano" id="totalAñoSDint_ano" value="" class="form-control " hidden>
                                        <input type="text" name="totalAñoSD_ano" id="totalAñoSD_ano" value="" class="form-control "readonly>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr id="desctoCortesia" hidden>
                                <td colspan="8" class="text-end"><b>(-) DESCUENTO CORTESÍA</b></td>
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
                                <td colspan="8" class="text-end"><b>(-) DESCUENTO PRONTO PAGO</b></td>
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
                            <tr>
                                <td colspan="8" class="text-end"><b>SERVICIO DE TRANSPORTE (ENVÍO) <label id="periodos"></label></b></td>
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
                            <tr>
                                <td colspan="8" class="text-end"><b>SERVICIO DE TRANSPORTE (RECOLECCIÓN) <label id="periodos"></label></b></td>
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
                                <td colspan="8" class="text-end"><b>VALOR TOTAL DEL SERVICIO</b></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="totalservicio_periodo" id="totalservicio_periodo" value="" class="form-control" readonly>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="totalservicio_ano" id="totalservicio_ano" value="" class="form-control" readonly>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <br>
                <div class="row">
                    <div class="col-md">
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="">PROMEDIO DOSÍMETRO SIN DESCUENTO</label>
                                    <input type="number" name="promds_SD" id="promds_SD" value="" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="">PROMEDIO DOSÍMETRO CON DESCUENTO</label>
                                    <input type="number" name="promds_CD" id="promds_CD" value="" class="form-control" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <label for="floatingInputGrid">OBSERVACIONES</label>
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

        var num = parseInt('{{empty($codigocotiant->codigo_contrato) ? 0 : $codigocotiant->codigo_contrato}}')+1;
        var n = num.toString().padStart(5,'0');
        console.log("ESTE ES EL CODIGO" +n);
        
        document.getElementById("numero_cotizacion_input").value = n;

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
            }else{
                $('#desctoProntoPago').prop('hidden', true); 
            }
        });
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
            }else{
                $('#desctoCortesia').prop('hidden', true); 
            }
        });
       
        $('#servtransporte_periodo').change(function(){
            console.log("CAMBIO");
            let array = [];
            for(var i = 1; i < 20 ; i++){
                var lec = document.querySelectorAll('#periodolec_producto'+(i));
                console.log("ESTO SON LAS LEC");
                if(lec[0] != undefined){
                    array.push(lec[0].value);
                    console.log(array);
                }
            }
            var trans = document.getElementById('servtransporte_periodo').value;
            if(array.includes('MENS')){
                document.getElementById('periodos').innerHTML = 'POR 12 PERIODOS' ;
                document.getElementById('servtransporteInt_ano').value = trans*12;
                document.getElementById('servtransporte_ano').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(trans*12);
            }else{
                document.getElementById('periodos').innerHTML = 'POR 4 PERIODOS' ;
                document.getElementById('servtransporteInt_ano').value = trans*4;
                document.getElementById('servtransporte_ano').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(trans*4); 
            }

            var costoTransPerProd = document.getElementById('servtransporte_periodo').value;
            var costoTransAnoProd = document.getElementById('servtransporteInt_ano').value;
            //////OBTENEMOS EL VALOR TOTAL SIN DESCUENTO CON EL VALOR DEL TRANSPORTE//////
            var totalSDper = document.getElementById('totalAñoSDint_periodo').value;///VARIABLE QUE GUARDA EL TOTAL DEL PERIODO
            var totalSDpervar = document.getElementById('totalAñoSDvar_periodo').value;///variable quie guarda la suma del transporte y el valor total ES LA Q NECESITAMOS
            console.log("VALOR TOTAL DEL PERIODO SD"+totalSDper);
            var sumTranvalorSDper = parseInt(totalSDper)+parseInt(costoTransPerProd);
            console.log("SUMA TRANSPORTE Y VALOR PERIODO SD"+sumTranvalorSDper);
            document.getElementById('totalAñoSD_periodo').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(sumTranvalorSDper);
            document.getElementById('totalAñoSDvar_periodo').value = sumTranvalorSDper;

            var totalSDaño = document.getElementById('totalAñoSDint_ano').value;///VARIABLE QUE GUARDA EL TOTAL DEL PERIODO
            var totalSDañovar = document.getElementById('totalAñoSDvar_ano').value;///variable quie guarda la suma del transporte y el valor total ES LA Q NECESITAMOS
            console.log("VALOR TOTAL DEL AÑO SD"+totalSDaño);
            var sumTranvalorSDaño = parseInt(totalSDaño)+parseInt(costoTransAnoProd);
            console.log("SUMA TRANSPORTE Y VALOR AÑO SD"+sumTranvalorSDaño);
            document.getElementById('totalAñoSD_ano').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(sumTranvalorSDaño);
            document.getElementById('totalAñoSDvar_ano').value = sumTranvalorSDaño;

            /////////OBTENEMOS EL DESCUENTO CORTESIA POR PERIODO Y POR AÑO//////
            /* var descCortesia = document.getElementById('descuento_cortesia').value;
            console.log("DESCUENTO CORTESIA"+descCortesia);
            if(descCortesia != ''){
                var descCORTcostPerProd  = sumTranvalorSDper *(descCortesia/100);
                console.log("DESCUENTO CORTESIA COST PERIODO"+ descCORTcostPerProd);
                document.getElementById('descuento_cortesia_periodo').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(descCORTcostPerProd);
                var descCORTcostAnoProd  = sumTranvalorSDaño *(descCortesia/100);
                console.log("DESCUENTO CORTESIA COSTO AÑO"+ descCORTcostAnoProd);
                document.getElementById('descuento_cortesia_ano').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(descCORTcostAnoProd);
            }  */

           ///////OBTENEMOS EL DESCUENTO POR PRONTO PAGO POR PERIODO Y POR AÑO//////
           /* var descProntoPago = document.getElementById('descuento_pronto_pago').value;
            console.log("DESCUENTO PP"+descProntoPago);
            if(descProntoPago != ''){
                var descPPcostPerProd  = sumTranvalorSDper *(descProntoPago/100);
                console.log("DESCUENTO PP COST PERIODO"+ descPPcostPerProd);
                document.getElementById('descuento_prontopago_periodo').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(descPPcostPerProd);
                var descPPcostAnoProd  = sumTranvalorSDaño *(descProntoPago/100);
                console.log("DESCUENTO PP COSTO AÑO"+ descPPcostPerProd);
                document.getElementById('descuento_prontopago_ano').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(descPPcostAnoProd);
            } */
            
        });
        
        


    });
    var inicio = 1;
    function agregarProducto(){
        /* alert("ESTA ES LA i "+i); */
        
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
                <select class="form-select" name="periodolec_producto" id="periodolec_producto"  autofocus>
                    <option value="">--</option>
                    <option value="MENS">MENS</option>
                    <option value="TRIMS">TRIMS</option>
                </select>
            </td>
            <td class='align-middle text-center'>
                <input type="number" name="lecaño_producto" id="lecaño_producto" value="" class="form-control text-center" readonly>
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
                    <option value="0">0% (EXENTO)</option>
                    <option value="16">16%</option>
                    <option value="5">5%</option>
                </select>
            </td>
            <td class='align-middle'>
                <input type="number" name="costoPeriodoInt_producto" id="costoPeriodoInt_producto" value="" class="form-control" hidden>
                <input type="text" name="costoPeriodo_producto" id="costoPeriodo_producto" value="" class="form-control" readonly>
            </td>
            <td class='align-middle'>
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
        var pLecProd = document.querySelectorAll('select[name="periodolec_producto"]');
        for(var x = 0; x < pLecProd.length; x++){
            pLecProd[x].setAttribute("name", "periodolec_producto"+[i-1]);
            pLecProd[x].setAttribute("id", "periodolec_producto"+[i-1]);
        }
        var lecAnoProd = document.querySelectorAll('input[name="lecaño_producto"]');
        for(var x = 0; x < lecAnoProd.length; x++){
            lecAnoProd[x].setAttribute("name", "lecaño_producto"+[i-1]);
            lecAnoProd[x].setAttribute("id", "lecaño_producto"+[i-1]);
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
        var cosAnoProd = document.querySelectorAll('input[name="costoAno_producto"]');
        for(var x = 0; x < cosAnoProd.length; x++){
            cosAnoProd[x].setAttribute("name", "costoAno_producto"+[i-1]);
            cosAnoProd[x].setAttribute("id", "costoAno_producto"+[i-1]);
        }
        console.log("ESTA ES LA i="+i);
        ////////// SE OBTIENE EL VALOR SELECCIONADO PARA EL AUTOCOMPLEADO /////
        /* let selectValue = $('#ref_producto'+[i-1]).val();
        console.log("VALOR SELECCIONADO" +selectValue); */
        $('#ref_producto'+[i-1]).change(function(){
            var ref = document.getElementById('ref_producto'+[i-1]).value;
            console.log("VALOR SELECCIONADO" +ref);
            @foreach($productos as $prod)
                if('{{$prod->id_producto}}' == ref){
                    document.getElementById('concepto_producto'+[i-1]).value = '{{$prod->concepto}}';
                    document.getElementById('costoUnd_producto'+[i-1]).value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format('{{$prod->valor_unitario}}');
                }
            @endforeach
	    });
        $('#periodolec_producto'+[i-1]).change(function(){
            /* alert("cambio en el periodo"); */
            var lec = document.getElementById('periodolec_producto'+[i-1]).value;
            if(lec == 'MENS'){
                document.getElementById('lecaño_producto'+[i-1]).value = '12';
            }else if('TRIMS'){
                document.getElementById('lecaño_producto'+[i-1]).value = '4';
            }
            var cant = document.getElementById('cantidad_producto'+[i-1]).value;
            console.log("cantidad"+cant);
            var ref = document.getElementById('ref_producto'+[i-1]).value;
            @foreach($productos as $prod)
                if('{{$prod->id_producto}}' == ref){    
                    var costoPerProd = '{{$prod->valor_unitario}}'*cant;
                    document.getElementById('costoPeriodo_producto'+[i-1]).value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(costoPerProd);
                    var lecAnoProd = document.getElementById('lecaño_producto'+[i-1]).value;
                    var costAnoProd = costoPerProd*lecAnoProd;
                    document.getElementById('costoAno_producto'+[i-1]).value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(costAnoProd);
                }
            @endforeach   
        
        });
        
        $('#cantidad_producto'+[i-1]).change(function(){
            var cant = document.getElementById('cantidad_producto'+[i-1]).value;
            var ref = document.getElementById('ref_producto'+[i-1]).value;
            var totalSDperi = document.getElementById('totalAñoSDint_periodo').value;
            var totalSDAno = document.getElementById('totalAñoSDint_ano').value;
            /* console.log("TOTAL PERIODO"+totalSDperi); */
            @foreach($productos as $prod)
                if('{{$prod->id_producto}}' == ref){
                    var costoPerProd ='{{$prod->valor_unitario}}'*cant;
                    document.getElementById('costoPeriodo_producto'+[i-1]).value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(costoPerProd);
                    if(totalSDperi != ''){var sumcostoPerProd = parseInt(totalSDperi)+costoPerProd;}else{var sumcostoPerProd = totalSDperi+costoPerProd;}
                    console.log("COSTO PRODUCTO ANTERIOR" + totalSDperi + "COSTO PRODUCTO ACTUAL" +costoPerProd);
                    console.log("SUMA VALOR TOTAL PERIODO SD" +sumcostoPerProd);
                    document.getElementById('totalAñoSDint_periodo').value = sumcostoPerProd;
                    document.getElementById('totalAñoSD_periodo').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(sumcostoPerProd);

                    var lecAnoProd = document.getElementById('lecaño_producto'+[i-1]).value;
                    var costAnoProd = costoPerProd*lecAnoProd;
                    document.getElementById('costoAno_producto'+[i-1]).value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(costAnoProd);
                    if(totalSDAno != ''){var sumcostoAnoProd = parseInt(totalSDAno)+costAnoProd;}else{var sumcostoAnoProd = totalSDAno+costAnoProd;}
                    console.log("COSTO PRODUCTO ANTERIOR AÑO" + totalSDAno + "COSTO PRODUCTO ACTUAL AÑO" +costAnoProd);
                    console.log("SUMA VALOR TOTAL AÑO SD" +sumcostoAnoProd);
                    document.getElementById('totalAñoSDint_ano').value = sumcostoAnoProd;
                    document.getElementById('totalAñoSD_ano').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(sumcostoAnoProd);
                    
                    ///////OBTENEMOS EL DESCUENTO POR PRONTO PAGO POR PERIODO//////
                    var desPP = document.getElementById('descuento_pronto_pago').value;
                    if(desPP != '' || desPP != 0){
                        console.log("DESCUENTO PP"+desPP);
                        var descPPcostPer  = sumcostoPerProd *(desPP/100);
                        console.log("DESCUENTO PP COST PERIODO"+ descPPcostPer);
                        document.getElementById('descuento_prontopagoint_periodo').value = descPPcostPer;
                        document.getElementById('descuento_prontopago_periodo').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(descPPcostPer);
                        /////////OBTENEMOS EL DESCUENTO PRONTO PAGO POR AÑO//////
                        var descPPcostAño  = sumcostoAnoProd *(desPP/100);
                        console.log("DESCUENTO PP COST AÑO"+ descPPcostAño);
                        document.getElementById('descuento_prontopagoint_ano').value = descPPcostAño;
                        document.getElementById('descuento_prontopago_ano').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(descPPcostAño);
                    }
                    ///////OBTENEMOS EL DESCUENTO POR CORTESIA POR PERIODO//////
                    var desCort = document.getElementById('descuento_cortesia').value;
                    if(desCort != '' || desCort != 0){
                        console.log("DESCUENTO CORTESIA"+desCort);
                        var descCortcostPer = sumcostoPerProd *(desCort/100);
                        console.log("DESCUENTO CORTESIA COSTO AÑO"+ descCortcostPer);
                        document.getElementById('descuento_cortesiaint_periodo').value = descCortcostPer;
                        document.getElementById('descuento_cortesia_periodo').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(descCortcostPer);
                        /////////OBTENEMOS EL DESCUENTO CORTESIA POR AÑO//////
                       var descCortcostAño = sumcostoAnoProd *(desCort/100);
                       console.log("DESCUENTO CORTESIA COSTO AÑO"+ descCortcostAño);
                       document.getElementById('descuento_cortesiaint_ano').value = descCortcostAño;
                       document.getElementById('descuento_cortesia_ano').value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(descCortcostAño);
                    }


                   
                }
            @endforeach
        });
        
    }
    
    function eliminar(row){
        var d = row.parentNode.parentNode.rowIndex;
        document.getElementById('productos').deleteRow(d);
        
        var i = 1;
        $('#productos > tbody  > tr').each(function(e) {
        $(this)[0].cells[0].outerHTML='<td class="align-middle"><b>'+ i +'</b></td>';
            i++;
        });
    }
</script>
@endsection