<style>
    *{
        box-sizing: border-box;
        /* padding: 0;
        margin: 0; */
    }
    /* .gallery_container{
        display: flex;
        
        padding: 5px;
        
    }  */
    /* .columna {
        float: left;
        width: 33%;
        padding-right: 5px;
    }
    .fila::after {
        content: "";
        clear: both;
        display: table;
        background: green;
    } */
    .gallery_img_torax{
        height: auto;
        width: auto;
        max-width: 191px;
        max-height: 86px;
    }
    .gallery_img_cristalino{
        height: auto;
        width: auto;
        max-width: 236px;
        max-height: 43px;
    }
    /* .gallery_item{
        display: flex;
        padding: 5px;
    } */
    
    /* .caja{
        border: 1px solid black;
        background-color: red;
        color: black;
        width: 120px;
        height: 120px;
        margin: 5px;
       
    } */
    
</style>
<body>
    {{-- <section class="flex-container">

        <div class="caja">
            caja 1
        </div>
        <div class="caja">
            caja 2
        </div>
        <div class="caja">
            caja 3
        </div>
        <div class="caja">
            caja 4
        </div>
        <div class="caja">
            caja 5
        </div>
        <div class="caja">
            caja 6
        </div>
    </section> --}}
    <section class="flex-container">

        @php
            $total = 1;
        @endphp
        
        @foreach($trabajdosiasig as $trab)
            <div class="caja" style="float: left;">
                @if($trab->ubicacion == 'TORAX')
                    <img src="{{asset('imagenes/2.png')}}" id={{$total}} class= "gallery_img_torax" style="border:1px solid black;">
                    {{-- <h4 class="gallery_title">Imagen {{$total}}</h4> --}}
                @elseif($trab->ubicacion == 'CRISTALINO')
                    <img src="{{asset('imagenes/DOSIMETRIA_CRISTALINO_V3/2.png')}}" class= "gallery_img_cristalino" style="border:1px solid black;">
                    {{-- <h4 class="gallery_title">Imagen {{$total}}</h4> --}}
                @endif
            </div>
            @php
                $total += 1;
            @endphp
            
        @endforeach
    </section>
    <script type="text/javascript">
        $(document).ready(function(){
            var id = document.getElementById('{{$total}}');
            if({{$total}} %3 ==  0){
                alert("es multiplo de 3");
                /* id.style.clear = "left"; */
            }
        })
    </script>
</body>