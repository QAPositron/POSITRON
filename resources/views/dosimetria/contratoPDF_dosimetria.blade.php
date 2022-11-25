<style>
    body{
        background: orange;
        font-family: sans-serif;
        font-size: 12px;
        margin: 30pt 30pt 30pt 30pt;
    }
    
    td, th{
        border:0.1px solid black;
    }
</style>
<body>
    <center><img src="{{asset('imagenes/VerdeSF.png')}}" width="200" ></center>
    <p style="text-align:center;">CONTRATO DE ARRENDAMIENTO DE DOSIMETROS Y PRESTACIÓN DE SERVICIOS COMPLEMENTARIOS DE DOSIMETRÍA PERSONAL </p>
    <h4 style="text-align: center;">QA-CTO-{{$contdosi}}</h4>
    <p style="text-align:justify;">Entre los suscritos <b>QA POSITRON S.A.S.</b>, sociedad comercial, con domicilio en la ciudad de Bucaramanga, constituida mediante escritura pública a número 13 de fecha 14 de enero de 1.997, otorgada en la Notaría 52 del Círculo Notaria de Bucaramanga, debidamente inscrita en la Cámara de Comercio de esta ciudad, representada en este acto por su Representante Legal y Gerente General Asociado, <b>DIEGO FERNANDO APONTE CASTAÑEDA</b>, mayor de edad, con domicilio en la ciudad de Bucaramanga, identificado con Cédula de Ciudadanía número 80.115.846 expedida de Bogotá, quien en el texto de este contrato se denominará, <b>QA POSITRON S.A.S.</b>, sociedad que actúa como distribuidor y prestador se servicio de dosimetría personal autorizado bajo licencia No. _____________ del Ministerio de Minas, por una parte, y ____NOMBRE DEL REPRESENTANTEL LEGAL____, identificado con el numero de cedula No.____________, que actúa como representante legal de, ubicada en la dirección {{$contrato->direccion_empresa}} de la ciudad de {{$contrato->nombre_municol}}- {{$contrato->nombre_deptocol}} y NIT: {{$contrato->num_iden_empresa}} - {{$contrato->DV}}, quien   en el texto de este se denominará <b>EL USUARIO</b>, se ha celebrado un <b>CONTRATO COMERCIAL</b>, contenido en las siguientes cláusula:
        <b>PRIMERA. - OBJETO:</b>  Por medio del presente contrato <b>QA POSITRON S.A.S.</b>, se compromete a entregar a manera de comodato o préstamo comercial al <b>USUARIO</b>, para que este utilice en forma gratuita y restituya al final de cada período de uso, uno o varios dosímetros personales con sus respectivos portadosímetros, y prestar el servicio global de dosimetría, el cual incluye entre otros, el servicio técnico, servicio al cliente, logística de distribución y recolección (de ser aplicable), servicios complementarios de lectura y reporte periódico de los resultados. Como contraprestación de estos servicios, el USUARIO se obliga a pagar el valor convenido, todo de conformidad con las condiciones que sobre productos, duración del contrato, costo y plazos de entrega de resultados, se  establecen en el “Formato de Solicitud de Servicios de Dosimetría”, adjunto a este contrato formando parte integral del mismo, concordante con la correspondiente cotización del servicio y demás documentos y comunicaciones relativos a esta orden contractual, que hacen también parte integral de este contrato.
    </p>
</body>