<style>
    @page {
        margin: 0cm 0cm;
    } 
    body{
       /*  background: orange; */
        font-family: "Calibri, sans-serif";
        font-size: 12px;
        margin-top: 1cm;
        margin-left: 2cm;
        margin-right: 2cm;
        margin-bottom: 0.5cm;
    }
    header{
        position: fixed;
        top: 1cm;
        left: 2cm;
        right: 2cm;
        height: 75px;
        /* background: blue; */
    }
    footer{
        position: fixed;
        bottom: 0.5cm; 
        left: 2cm; 
        right: 2cm;
        height: 1.8cm;
        /* margin-top: 100px; */
        text-align:center;
        color:#1A9980;
        /* background: aqua; */
        font-size: 11px;
    }
    footer p {
        margin: 0px;
        padding-top: 0px;
        padding-bottom: 0px;
        opacity:0.5;
       /*  background: yellow; */
    }
    main{
        position: relative;
        top: 75px;
        left: 0cm;
        right: 0cm;
        margin-bottom:3cm;
        padding-bottom: 50px;
        text-align:justify;
        /* background: yellow; */
    }
    main p {
        margin: 0px;
        padding-top: 2px;
        padding-bottom:2px;
        line-height: 130%;
    }
    /* td, th{
        border:0.1px solid black;
    } */
    .indices{
        position: fixed;
        display:block;
        left: 2cm; 
        right: 2cm;
        text-align:justify;
        bottom: 4.5cm; 
        /* background: green; */
    }
    .indices p{
        padding-top: 0px;
        padding-bottom:0px;
        line-height: 1.2;
    }
</style>
<body>
    <header>
        <img src="{{asset('imagenes/1VerdeSF.png')}}" width="160" style="position:relative; right:20px; bottom: 10px; opacity:0.5;">
        <img src="{{asset('imagenes/1SERVICIOS_QA.png')}}" width="300" style="position:relative; left:190px; top:15px; opacity:0.5;">
    </header>
    <footer>
        <p>________________________________________________________________________________________________________</p>
        <p>Servicio de dosimetría personal mediante tecnología de BeOSL. Lic. QAP-001 2023 de Min. Minas y Energía.</p>
        <p>Servicios en protección radiológica y controles de calidad - Res. 09472 de 2020 de Sec. Salud Santander</p>
        <p >E-mail: qapositron@gmail.com</p>
        <p>www.qapositron.com</p>
    </footer>
    <main>
        @php
            $n = $cotizacion;
            $titulo = str_pad($n, 5, "0", STR_PAD_LEFT); 
        @endphp
        <p style="position: absolute; left:405px;"><b>Número de cotización:</b></p> <p style="text-align:right; color:#1A9980;"><b>QA-OSL-1{{$titulo}}</b></p> 
        @foreach($coti as $cotiza)
            <p style="position: absolute; left:429px;"><b>Fecha de emisión:</b></p> <p style="text-align:right;">
            @php
                $meses = ["01"=>'enero', "02"=>'febrero', "03"=>'marzo', "04"=>'abril', "05"=>'mayo', "06"=>'junio', "07"=>'julio', "08"=>'agosto', "09"=>'septiembre', "10"=>'octubre', "11"=>'noviembre', "12"=>'diciembre'];
            @endphp
            {{date("d", strtotime($cotiza->fecha_emision))}} {{$meses[date("m", strtotime($cotiza->fecha_emision))]}} {{date("Y", strtotime($cotiza->fecha_emision))}}</p>
            <p>Señores</p>
            <p><b>{{$cotiza->empresa->nombre_empresa}}</b></p>
            <p>@if($cotiza->empresa->tipo_identificacion_empresa == 'NIT') 
                    NIT: {{$cotiza->empresa->num_iden_empresa}}-{{$cotiza->empresa->DV}} 
                @elseif($cotiza->empresa->tipo_identificacion_empresa == 'CÉDULA DE CIUDADANIA')
                    CC: {{$cotiza->empresa->num_iden_empresa}} 
                @endif
            </p>
            <p>SEDE: {{ucwords(mb_strtolower($cotiza->sede->nombre_sede, 'UTF-8'))}}, {{ucwords(mb_strtolower($cotiza->sede->direccion_sede, 'UTF-8'))}}, {{ucwords(mb_strtolower($cotiza->sede->municipios->nombre_municol, 'UTF-8'))}}</p>
            <p>Dirección: {{ucwords(mb_strtolower($cotiza->empresa->direccion_empresa, 'UTF-8'))}}</p>
            <p>{{ucwords(mb_strtolower($cotiza->empresa->municipios->nombre_municol, 'UTF-8'))}} - {{ucwords(mb_strtolower($cotiza->empresa->municipios->coldepartamento->nombre_deptocol, 'UTF-8'))}}</p>
            <br>
            <p>Cordial saludo,</p>
            <br>
            <p>Reciban cordial saludo, en nombre de todo el equipo de QA POSITRON, tenemos el gusto de presentar nuestros servicios orientados en la protección radiológica.</p>
            <br>
            <p>Para la prestación del servicio de dosimetría, nuestra empresa ofrece la tecnología OSL (Luminiscencia Estimulada Ópticamente), protocolo diseñado para superar las deficiencias y limitaciones de la dosimetría de película y la dosimetría TLD (Termoluminiscencia). <b>Licencia QAP-001 de 2023 Min. Minas.</b></p>
        
            <br>
            <table style="text-align:center; border-collapse: collapse; width: 100%; border:solid 0.1px #000;" cellpadding="10">
                <thead style="background-color: #1A9980; color:white; font-size: 10px;" >
                    <tr>
                        <td style="border:0.1px solid black; width:5%;">ITEM</td>
                        <td style="border:0.1px solid black; width:10%;">CANT. USUARIOS</td>
                        <td style="border:0.1px solid black; width:50%;">CONCEPTO</td>
                        <td style="border:0.1px solid black; width:10%;">PERIODO LECTURA</td>
                        <td colspan="2" style="border:0.1px solid black; width: 15%;">COSTO UNITARIO</td>
                        <td style="border:0.1px solid black; width: 10%;">SUBTOTAL PERIODO</td>
                    </tr>
                </thead>
                <tbody cellpadding="4">
                    @php
                        $i = 1;
                    @endphp
                    @foreach($productos as $prod)
                        <tr>
                            <td style="border:0.1px solid black; padding:5px; font-size: 10px;">{{$i}}</td>
                            <td style="border:0.1px solid black; padding:5px; font-size: 10px;">{{$prod->cantidadProd}}</td>
                            <td align="left" style="border:0.1px solid black; padding:5px; font-size: 9px;">{{ucfirst(mb_strtolower($prod->conceptoProd, 'UTF-8'))}}</td>
                            <td style="border:0.1px solid black; padding:5px; font-size: 9px;">
                                @if($cotiza->periodoLec == 'MENS')
                                    Mensual
                                @elseif($cotiza->periodoLec == 'TRIMS')  
                                    Trimestral
                                @elseif($cotiza->periodoLec == 'BIMS')  
                                    Bimestral  
                                @endif
                            </td>
                            <td colspan="2" style="border:0.1px solid black; padding:5px; font-size: 10px;">${{number_format($prod->costoUndProd, 0, ',', '.')}}</td>
                            <td align="right" style="border:0.1px solid black; padding:5px; font-size: 10px;">${{number_format($prod->costoPeriodoProd, 0, ',', '.')}}</td>
                        </tr>
                        @php
                            $i ++;
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    @if($cotiza->desc_cortesia != 0 || $cotiza->desc_cortesia != NULL)
                        <tr>
                            <td  align="right" colspan="5" style="border:0.1px solid black; padding:5px; font-size: 10px; background-color: #EEEDEC;"><b>(-) Descuento de cortesía periodo</b></td>
                            <td style=" border:0.1px solid black; padding:5px; font-size: 10px; background-color: #EEEDEC;"><b>{{$cotiza->desc_cortesia}}%</b></td>
                            <td  align="right" style="border:0.1px solid black; padding:5px; font-size: 10px;"><b>${{number_format($cotiza->descCortesiaPeriodo, 0, ',', '.')}}</b></td>
                        </tr>
                    @endif
                    @if($cotiza->servTransEnvioPeriodo != 0 || $cotiza->servTransEnvioPeriodo != NULL)
                        <tr>
                            <td  align="right" colspan="6" style="border:0.1px solid black; padding:5px; font-size: 10px; background-color: #EEEDEC;">(+) Servicio de transporte por periodo (envío)</td>
                            <td align="right" style="border:0.1px solid black; padding:5px; font-size: 10px;">${{number_format($cotiza->servTransEnvioPeriodo, 0, ',', '.')}}</td>
                        </tr>
                    @elseif($cotiza->obsq_transEnvio == 'TRUE')
                        <tr>
                            <td  align="right" colspan="6" style="border:0.1px solid black; padding:5px; font-size: 10px; background-color: #EEEDEC;">(+) Servicio de transporte por periodo (envío)</td>
                            <td align="right" style="border:0.1px solid black; padding:5px; font-size: 10px;"><b>Obsequio</b></td>
                        </tr>
                    @endif
                    @if($cotiza->servTransRecoPeriodo != 0 || $cotiza->servTransRecoPeriodo != NULL)
                        <tr>
                            <td  align="right" colspan="6" style="border:0.1px solid black; padding:5px; font-size: 10px; background-color: #EEEDEC;">(+) Servicio de transporte por periodo (recolección)</td>
                            <td align="right" style="border:0.1px solid black; padding:5px; font-size: 10px;">${{number_format($cotiza->servTransRecoPeriodo, 0, ',', '.')}}</td>
                        </tr>
                    @elseif($cotiza->obsq_transRecole == 'TRUE')
                        <tr>
                            <td  align="right" colspan="6" style="border:0.1px solid black; padding:5px; font-size: 10px; background-color: #EEEDEC;">(+) Servicio de transporte por periodo (recolección)</td>
                            <td align="right" style="border:0.1px solid black; padding:5px; font-size: 10px;"><b>Obsequio</b></td>
                        </tr>
                    @endif
                    <tr>
                        <td align="right" colspan="6" style="border:0.1px solid black; padding:5px; font-size: 10px; background-color: #EEEDEC;"><b>VALOR TOTAL POR PERIODO<sup>1</sup></b></td>
                        <td align="right" style="border:0.1px solid black; padding:5px; font-size: 10px;"> 
                            @php
                                $totalPer = $cotiza->valorTotalPeriodo + $cotiza->descProntopagoPeriodo
                            @endphp
                            <b>${{number_format($totalPer, 0, ',', '.')}}</b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7" style="border:0.1px solid white; border-bottom:0.1px solid black;"></td>
                    </tr>
                    <tr>
                        <td  align="right" colspan="5" style="border:0.1px solid black; padding:5px; font-size: 10px; background-color: #EEEDEC;"><b>Valor total del servicio (año) incluido transporte</b></td>
                        <td style="border:0.1px solid black; padding:5px; font-size: 10px; background-color: #EEEDEC;"><b>{{$cotiza->lecturas_ano}}</b></td>
                        <td  align="right" style="border:0.1px solid black; padding:5px; font-size: 10px;">
                            @php
                                $totalAñoSDP = $cotiza->valorTotalSDAño - $cotiza->descCortesiaAño + $cotiza->servTransEnvioAño + $cotiza->servTransRecoAño;
                            @endphp
                            <b>${{number_format($totalAñoSDP, 0, ',', '.')}}</b></td>
                    </tr>
                    @if($cotiza->desc_prontopago != 0 || $cotiza->desc_prontopago != NULL)
                        <tr>
                            <td  align="right" colspan="5" style="border:0.1px solid black; padding:5px; font-size: 10px; background-color: #EEEDEC;"><b>(-) Descuento por pago anticipado del año</b></td>
                            <td style="border:0.1px solid black; padding:5px; font-size: 10px; background-color: #EEEDEC;"><b>{{$cotiza->desc_prontopago}}%</b></td>
                            <td  align="right" style="border:0.1px solid black; padding:5px; font-size: 10px;"><b>${{number_format($cotiza->descProntopagoAño, 0, ',', '.')}}</b></td>
                        </tr>
                    @endif
                    <tr>
                        <td  align="right" colspan="6" style="border:0.1px solid black; padding:5px; font-size: 10px; background-color: #EEEDEC;">
                            @if($cotiza->desc_prontopago != 0 || $cotiza->desc_prontopago != NULL)
                                <b>VALOR TOTAL DEL SERVICIO (AÑO) INCLUIDO TRANSPORTE CON DESCUENTO POR PRONTO PAGO<sup>2</sup></b>
                            @else
                                <b>VALOR TOTAL DEL SERVICIO (AÑO) INCLUIDO TRANSPORTE<sup>2</sup></b>
                            @endif
                        </td>
                        <td align="right" style="border:0.1px solid black; padding:5px; font-size: 10px;"> <b>${{number_format($cotiza->valorTotalAño, 0, ',', '.')}}</b></td>
                    </tr>
                </tfoot>
            </table>
            <br>
            <p><b>OBSERVACIONES:</b></p>
            <p>{{ucfirst(mb_strtolower($cotiza->obs, 'UTF-8'))}}</p>
            <br>
            @if(($cotiza->servTransEnvioPeriodo == 0 || $cotiza->servTransEnvioPeriodo == NULL) && ($cotiza->servTransRecoPeriodo == 0 || $cotiza->servTransRecoPeriodo == NULL))
                <p><b>NOTAS DE TRANSPORTE:</b></p>
                <ul>
                    <li>En el costo no se incluye el envío de los dosímetros desde el laboratorio de QA POSITRON a sus instalaciones, este costo es responsabilidad de la institución contratante.</li>
                    <li>En el costo no se incluye el envío de los dosímetros a las instalaciones de QA POSITRON, este costo es responsabilidad de la institución contratante.</li>
                </ul>
            @elseif(($cotiza->servTransEnvioPeriodo == 0 || $cotiza->servTransEnvioPeriodo == NULL) && ($cotiza->servTransRecoPeriodo != 0 || $cotiza->servTransRecoPeriodo != NULL))
                <p><b>NOTAS DE TRANSPORTE:</b></p>
                <ul>
                    <li>En el costo no se incluye el envío de los dosímetros desde el laboratorio de QA POSITRON a sus instalaciones, este costo es responsabilidad de la institución contratante.</li>
                </ul>
            @elseif(($cotiza->servTransEnvioPeriodo != 0 || $cotiza->servTransEnvioPeriodo != NULL) && ($cotiza->servTransRecoPeriodo == 0 || $cotiza->servTransRecoPeriodo == NULL))
                <p><b>NOTAS DE TRANSPORTE:</b></p>
                <ul>
                    <li>En el costo no se incluye el envío de los dosímetros a las instalaciones de QA POSITRON, este costo es responsabilidad de la institución contratante.</li>
                </ul>
            @endif
        @endforeach
        <p style="text-align:center;"><b>TERMINOS Y CONDICIONES OFERTA</b></p>
        <br>
        <p><b>VALIDEZ DE LA OFERTA: </b>30 Días</p>
        <p><b>FORMA DE PAGO: </b>facturación realizada por QA POSITRON, con pago máximo 30 días después la fecha de radicación según la forma de pago aceptada (periódico o anual).</p>
        <p><b>ENVÍO DE LECTURAS: </b>las lecturas serán enviadas dentro de los 15 días hábiles después de haber recibido los dosímetros dentro del tiempo establecido.</p>
        <p><b>INFORMACION BANCARIA: </b>Bancolombia, cuenta de ahorros No. 090-000004-48, al realizar el pago enviar soporte de este al correo: <b style="color:#1A9980;">contabilidad.qapositron@gmail.com</b></p>
        <p><b>PERDIDA DE DOSíMETRO: </b>El dosímetro se envía en calidad de <b>comodato</b>, por ende, en caso de pérdida o no retorno después de 60 días el usuario deberá cancelar $180.000 por dosímetro de torso, cristalino o dosímetro de anillo.</p>
        <ul>
            <li>Si el dosímetro es devuelto entre los 30 y 90 días, se cobrará un costo administrativo de $ 50.000. (solo si está dentro de este rango).</li>
        </ul>
        <p><b>ENVIOS: </b></p>
        <ul>
            <li>Los dosímetros son enviados por QA POSITRON, cinco (05) días antes de inicio de cada periodo.</li>
            <li>Los dosímetros deben ser devueltos Máximo 5 cinco (05) hábiles después de fecha de inicio de periodo.</li>
        </ul>
        <p><b>VALORES AGREGADOS</b></p>
        <ul>
            <li>Tecnología de última generación en temas de dosimetría personal, tecnología OSL, es una tecnología que permite ser releídos los dosímetros en caso de inconsistencias en la lectura inicia.</li>
            <li>Entrega en la lectura en un máximo de Quince Días Hábiles después de la recepción de los dosímetros por parte de los usuarios.</li>
            <li>Tiempos de entrega de dosímetros para nuevos usuarios de 48 horas a nivel nacional.</li>
            <li>Laboratorio de producción de Dosímetros y lecturas propio, lo que nos hace minimizar tiempos de entrega.</li>
            <li>Charlas de sensibilización sobre uso y manejo de dosimetría personal por videoconferencia.</li>
            <li>Acompañamiento para los parámetros de seguimiento y control en caso de accidentes radiológicos.</li>
            <li>Cobertura a Nivel Nacional.</li>
            <li>Amplio portafolio de servicios en protección radiológica, para la asesoría en el licenciamiento de equipos emisores de radiaciones ionizantes, con atención personalizada por medio de un asesor designado por QA POSITRON.</li>
        </ul>
    
        <p>Quedando atentos a su respuesta.</p>
        <br>
        <p>Cordialmente:</p>
        <div style="position: absolute; width:50%; height: 150px; page-break-inside: avoid;">
            <img src="{{asset('imagenes/FIRMADEDIEGOFINAL.png')}}" width="170" height="70">
            <p style="position:relative;"><b>DIEGO F. APONTE CASTEÑEDA</b></p><br>
            <p style="position:relative; bottom: 17px;">Director Ejecutivo </p><br>
            <p style="position:relative; bottom: 35px; ">CEL : (+57) 301 449 5401</p><br>
            <p style="position:relative; bottom: 55px; ">e-mail: dosimetría.qapositron@gmail.com </p>
        </div>

        {{-- //////SIGUIENTE PAGINA/////// --}}
        <p style="text-align:center; page-break-before: always;"><b>TERMINOS Y CONDICIONES PARA EL SERVICIO DE DOSIMETRIA</b></p>
        <br>
        <p style="font-size: 11px;"><b>REQUISITO INICIAL: </b>el servicio de dosimetría de QA POSITRON, se ofrece mediante contratación o por orden de servicio. Diligenciar el formato de solicitud de servicio con la información completa.</p>
        <br>
        <p style="font-size: 11px;"><b>DESPACHOS: </b>los usuarios del servicio de dosimetría recibirán los "dosímetros" siempre y cuando se encuentren al día en los pagos o bien sea generando la orden de compra, de acuerdo a las condiciones previamente pactadas. Los despachos se harán vía empresa certificada de envíos nacionales.</p>
        <br>
        <p style="font-size: 11px;"><b>TRANSPORTE: </b>QA POSITRON se encarga de enviar los dosímetros a su domicilio por medio de empresa de envíos; este servicio no es personalizado es decir entregan al destinatario, pero no condicionado a que lo reciba la persona responsable.</p>
        <br>
        <p style="font-size: 11px;"><b>GUÍA DE RETORNO: </b>esta guía se envía vía al correo electrónico, esta tiene diligenciado los datos para realizar la devolución de los dosímetros a nuestro laboratorio. En el momento de tener los dosímetros completos solicitaran la recogida del sobre a la empresa transportadora de su preferencia y realizan el pago del costo del envío. (QA POSITRON, solo se hace responsable con la guía enviada por nosotros, si es extraviada el envío será por cuenta del cliente.</p>
        <br>
        <p style="font-size: 11px;"><b>FECHAS DE ENTREGA: </b>los dosímetros serán entregados al responsable del servicio el cual es la persona de contacto para todos los trámites logísticos y operativos del servicio a prestar.</p>
        <br>
        <p style="font-size: 11px;"><b>PERIODOS DE TRÁMITES:</b></p>
        <table style="top:220px; text-align:center; border-collapse: collapse; width: 100%; font-size: 11px;" border="1">
            <thead style="background-color: #1A9980; color:white;">
                <tr>
                    <th>TIPO DOSIMETRÍA</th>
                    <th>PERIODO</th>
                    <th>FECHA DE INICIO</th>
                    <th>MAX CAMBIOS / ADICIONES</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>DOSIMETRO CUERPO ENTERO OSL</td>
                    <td>MENSUAL</td>
                    <td>01 DE CADA MES</td>
                    <td>DIA 16 CADA MES</td>
                </tr>
                <tr>
                    <td>DOSIMETRO CUERPO ENTERO OSL</td>
                    <td>TRIMESTRAL</td>
                    <td>01 DE CADA MES</td>
                    <td>DIA 16 CADA MES</td>
                </tr>
                <tr>
                    <td>DOSIMETRO ANILLO OSL</td>
                    <td>MENSUAL</td>
                    <td>01 DE CADA MES</td>
                    <td>DIA 16 CADA MES</td>
                </tr>
                <tr>
                    <td>DOSIMETROS CRSITALINO OSL</td>
                    <td>MENSUAL</td>
                    <td>01 DE CADA MES</td>
                    <td>DIA 16 CADA MES</td>
                </tr>
            </tbody>
        </table>
        <br>
        <p style="font-size: 11px;"><b>NOTA:</b></p>
        <ol>
            <li style="font-size: 11px;">Los dosímetros son enviados cinco (05) días antes de inicio de cada periodo.</li>
            <li style="font-size: 11px;">Los dosímetros deben ser devueltos como Máximo cinco (05) días calendario después de fecha de inicio de periodo.</li>
            <li style="font-size: 11px;">Para que el dosímetro sea leído en los tiempos estimados debe entregar dentro de las fechas establecidas.</li>
        </ol>
        <br>
        <p style="font-size: 11px;"><b>RETORNO: </b>La devolución de los dosímetros al laboratorio de QA POSITRON, será responsabilidad del cliente. Este debe ser a más tardar el quinto día calendario siguiente después de recibir los dispositivos a usar en el siguiente periodo. Los dosímetros no devueltos dentro del tiempo establecido no se podrá generar reporte para el periodo el cual fue asignado, dentro de los tiempos habituales, además uno o varios dosímetros que no sean retornados dentro de los siguientes 30 días terminado el periodo de uso para el cual hayan sido asignados se le dará el trámite de <b>"pérdida del dosímetro"</b>.</p>
        <br>
        <p style="font-size: 11px;"><b>ENVIO DE LECTURAS: </b>las lecturas serán enviadas dentro de los 10-15 días calendario después de haber recibido los dosímetros dentro del tiempo establecido, cuando los dosímetros lleguen por fuera de la programación estos serán leídos de acuerdo con la disponibilidad del laboratorio el cual no superara 30 días calendario. Las lecturas solo serán enviadas al responsable del servicio el cual es informado al iniciar el servicio.</p>
        <br>
        <p style="font-size: 11px;">Las lecturas podrán ser consultadas por el responsable del servicio a través de nuestra página WEB, donde podrá consultar las veces que sea necesario las lecturas del año en curso; con el fin de entregar mejores tiempos e información consolidada.</p>
        <br>
        <p style="font-size: 11px;">Solo se asignará un usuario y contraseña a una persona ya que la información allí contenida es de carácter relevante y privado de cada entidad.</p>

        <div class="indices">
            <p style=""><b>_____________________________________</b></p>
            <p style="position: relative;"><small><sup>1</sup>Pagos periódicos</small></p>
            <p style="position: relative;"><small><sup>2</sup>Un solo pago anticipado por servicio de un año.</small></p>
        </div>
    </main>
    <!-- ////////////////////SCRIPT PARA CONTAR LAS PAGINAS/////////////// -->
    
    <script type="text/php">
        if (isset($pdf)) {
            $text = "página {PAGE_NUM} de {PAGE_COUNT}";
            $size = 8;
            $font = $fontMetrics->getFont("Verdana");
            $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
            $x = $pdf->get_width()-110;
            $y = $pdf->get_height() - 20;
            $pdf->page_text($x, $y, $text, $font, $size);
        }
    </script>
</body>