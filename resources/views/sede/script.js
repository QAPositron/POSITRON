/* const button = document.getElementById('button');
button.addEvenListener('click', ()=>{
    axios({
        method:'POST',
        url:'/prueba1',
        data:{
            title:'a new prueba'
        }
    }).then(res=>console.log(res.data))
}) */

    var $empresa = document.querySelector('#id_empresas')
    var $sede = document.querySelector('#id_sedes')

    function cargarSedes(sendDatos){
        axios.post('prueba',{
            sendDatos
        }).then(function(response){
            console.log(response); 
            const sedes = JSON.parse(response);
            let template = '<option class="form-control" selected disabled>--SELECCIONE SEDE--</option>'

            sedes.forEach(sede => {
            template += `<option value="${sede.idSede}">${sede.nombreSede}</option>`;
            })
            $sede.innerHTML= template;
        })
    }
    $empresa.addEventListener('change', function(){
        const codEmpresa = $empresa.value
        console.log(codEmpresa);
        const sendDatos = {
            'codigoEmp' : codEmpresa,
        }

        cargarSedes(sendDatos);
    });
