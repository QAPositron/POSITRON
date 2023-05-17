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
                    {{-- <div class="col-md">
                        <div class="form-floating">
                            <input class="form-control @error('persona') is-invalid @enderror" type="text" value="{{old('persona')}}">
                            <label for="floatingInputGrid">DIRIGIDO A </label>
                            @error('persona') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div> --}}
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
                                <td colspan="8" class="text-end"><b>SERVICIO DE TRANSPORTE ENVIO POR PERIODO</b></td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="servtransporte_periodo" id="servtransporte_periodo" value="" class="form-control" >
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="servtransporte_ano" id="servtransporte_ano" value="" class="form-control" >
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="8" class="text-end"><b>VALOR TOTAL SIN DESCUENTO</b></td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="totalAñoSD_periodo" id="totalAñoSD_periodo" value="" class="form-control ">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="totalAñoSD_ano" id="totalAñoSD_ano" value="" class="form-control ">
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="8" class="text-end"><b>(-) DESCUENTO CORTESÍA</b></td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="descuento_cortesia_periodo" id="descuento_cortesia_periodo" value="" class="form-control">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="descuento_cortesia_ano" id="descuento_cortesia_ano" value="" class="form-control">
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="8" class="text-end"><b>(-) DESCUENTO PRONTO PAGO</b></td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="descuento_prontopago_periodo" id="descuento_prontopago_periodo" value="" class="form-control ">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="descuento_prontopago_ano" id="descuento_prontopago_ano" value="" class="form-control ">
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="8" class="text-end"><b>VALOR TOTAL DEL SERVICIO</b></td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="totalservicio_periodo" id="totalservicio_periodo" value="" class="form-control">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="totalservicio_ano" id="totalservicio_ano" value="" class="form-control">
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
            fecha_inicio.setMinutes(fecha_inicio.getMinutes() + fecha_inicio.getTimezoneOffset());
            
            console.log("FECHA INICIO"+fecha_inicio);
            
            var fecha_final_año = fecha_inicio.getFullYear();
            console.log(fecha_final_año);
            var mm = fecha_inicio.getMonth() + 1;
            var fecha_final_mes = (mm < 10 ? '0' : '')+mm;
            if(fecha_final_mes == 13){
                fecha_final_mes = '01' ;
            }
            console.log("MES "+fecha_final_mes);
            var dd = fecha_inicio.getDate();
            var fecha_final_dia = (dd < 10 ? '0' : '')+dd;
            console.log("DIA" + fecha_final_dia);
            var fecha_final = new Date(fecha_final_año+'-'+fecha_final_mes+'-'+fecha_final_dia);
            console.log("ESTA ES LA FECHA FINAL" + fecha_final);
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
            alert("cambio en el periodo");
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
                    var costoPerProd = '{{$prod->valor_unitario}}'*cant
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
            @foreach($productos as $prod)
                if('{{$prod->id_producto}}' == ref){
                    var costoPerProd ='{{$prod->valor_unitario}}'*cant;
                    document.getElementById('costoPeriodo_producto'+[i-1]).value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(costoPerProd);
                    var lecAnoProd = document.getElementById('lecaño_producto'+[i-1]).value;
                    var costAnoProd = costoPerProd*lecAnoProd;
                    document.getElementById('costoAno_producto'+[i-1]).value = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(costAnoProd);
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