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
                            <input value="" type="date" class="form-control @error('fecha_vencimiento') is-invalid @enderror" name="fecha_vencimiento" id="fecha_vencimiento" onchange="fechaultimodia();" >
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
                              <th scope="col" style="width: 25%;">CONCEPTO</th>
                              <th scope="col">PERIODO LECTURA</th>
                              <th scope="col" style="width: 8%;">LECTURAS AL AÑO</th>
                              <th scope="col">CANTIDAD</th>
                              <th scope="col">COSTO UNI.</th>
                              <th scope="col">IVA</th>
                              <th scope="col">COSTO PERIODO</th>
                              <th scope="col">COSTO AÑO</th>
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
                {{-- <div id="contenedor">
                    <div class="row mt-2 align-items-center">
                        <div class="col-md-1" style="width: 5px;">
                            <b>1</b>
                            <input type="number" hidden value="1">
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <select class="form-select @error('ref_producto') is-invalid @enderror" name="ref_producto1" id="ref_producto"  autofocus>
                                    <option value="">--SELECCIONE--</option>
                                    @foreach($productos as $prod)
                                        <option value="{{$prod->id_producto}}" @if (old('ref_producto') == $prod->id_producto) {{ 'selected' }} @endif>{{$prod->referencia}}</option>
                                    @endforeach
                                </select>
                                <label for="floatingInputGrid">REF. PRODUCTO</label>
                                @error('ref_producto') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <textarea class="form-control @error('descripcion') is-invalid @enderror" name="descripcion1" id="descripcion" autofocus style="text-transform:uppercase;"></textarea>
                                <label for="floatingTextarea">DESCRIPCIÓN</label>
                                @error('descripcion') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                              </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <select class="form-select @error('periodo_producto') is-invalid @enderror" name="periodo_producto1" id="periodo_producto"  autofocus>
                                    <option value="">--</option>
                                    <option value="MENS">MENS</option>
                                    <option value="TRIMS">TRIMS</option>
                                </select>
                                <label for="floatingInputGrid">PERIODO</label>
                                @error('periodo_producto') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md" style="width: 150px;">
                            <div class="form-floating">
                                <input type="number" name="cantidad_producto1" id="cantidad_producto" value="" class="form-control @error('cantidad_producto') is-invalid @enderror">
                                <label for="floatingInputGrid">CANTIDAD</label>
                                @error('cantidad_producto')<small class="invalid-feedback">*{{$message}}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-2" style="width: 150px;">
                            <div class="form-floating">
                                <input type="number" name="precio_producto1" id="precio_producto" value="" class="form-control @error('precio_producto') is-invalid @enderror" readonly>
                                <label for="floatingInputGrid">PRECIO UND.</label>
                                @error('precio_producto')<small class="invalid-feedback">*{{$message}}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md" style="width: 150px;">
                            <div class="form-floating">
                                <input type="number" name="lecturasaño_producto1" id="lecturasaño_producto" value="" class="form-control @error('lecturasaño_producto') is-invalid @enderror" readonly>
                                <label for="floatingInputGrid">LECTURAS AL AÑO</label>
                                @error('lecturasaño_producto')<small class="invalid-feedback">*{{$message}}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-floating">
                                <select class="form-select @error('iva_producto') is-invalid @enderror" name="iva_producto1" id="iva_producto"  autofocus>
                                    <option value="">--</option>
                                    <option value="19">19%</option>
                                   
                                </select>
                                <label for="floatingInputGrid">IVA:</label>
                                @error('iva_producto')<small class="invalid-feedback">*{{$message}}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md" style="width: 150px;">
                            <div class="form-floating">
                                <input type="number" name="total_producto1" id="total_producto" value="" class="form-control @error('total_producto') is-invalid @enderror" readonly>
                                <label for="floatingInputGrid">TOTAL</label>
                                @error('total_producto')<small class="invalid-feedback">*{{$message}}</small>@enderror
                            </div>
                        </div>
                         <div class="col-md-1 text-center" style="width: 80px;">
                            <button class="btn btn-outline-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div> --}}
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
            <td class='align-middle'>
                <input type="number" name="lecaño_producto" id="lecaño_producto" value="" class="form-control" readonly>
            </td>
            <td class='align-middle'>
                <input type="number" name="cantidad_producto" id="cantidad_producto" value="" class="form-control">
            </td>
            <td class='align-middle'>
                <input type="number" name="costoUnd_producto" id="costoUnd_producto" value="" class="form-control" readonly>
            </td>
            <td class='align-middle'>
                <select class="form-select" name="iva_producto" id="iva_producto"  autofocus>
                    <option value="">--</option>
                    <option value="19">19%</option>
                </select>
            </td>
            <td class='align-middle'>
                <input type="number" name="costoPeriodo_producto" id="costoPeriodo_producto" value="" class="form-control" readonly>
            </td>
            <td class='align-middle'>
                <input type="number" name="costoAno_producto" id="costoAno_producto" value="" class="form-control" readonly>
            </td>
            <td class='align-middle text-center'>
                <button class="btn btn-outline-danger" id="" type="button" onclick="eliminar(this)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                    </svg>
                </button>
            </td>
            
        </tr>`;
        
        var i = 1;
        $('#productos > tbody  > tr').each(function(e) {
        $(this)[0].cells[0].outerHTML='<td class="align-middle"><b>'+ i +'</b></td>';
            i++;
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