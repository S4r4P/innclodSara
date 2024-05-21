function getProceso(IDproceso, IDTipo, nomTipo, preTipo) {

    id= IDproceso
    
    $.ajax({
        url: "ajax/proceso_ajax.php?action=procesoByID",
        method: "GET",
        data: {PRO_ID: id},
        //data: {PRO_NOMBRE: id},
        dataType: "json",

        success: function (respuesta) {
  
            console.log(IDTipo, nomTipo, preTipo, respuesta.PRO_ID , respuesta.PRO_NOMBRE, respuesta.PRO_PREFIJO)
            postDocumento(IDTipo, nomTipo, preTipo, respuesta.PRO_ID , respuesta.PRO_NOMBRE, respuesta.PRO_PREFIJO)
        },

        error: function (error) {
            console.error('error al consultar datos proceso:', error);
        }
    }) 
} 

function postProceso(proceso, IDTipo, nomTipo, preTipo){

    prefijo= valPrefijo(proceso)
    
    var datos = new FormData();

    datos.append('PRO_NOMBRE', proceso)
    datos.append('PRO_PREFIJO', prefijo)
    
    $.ajax({
        url: "ajax/proceso_ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {

            respuesta = respuesta.replace(/"/g, '').trim();
            console.log("respuesta sin comillas proceso " +respuesta)
    
            if (respuesta !== "duplicado" && respuesta !== "no insertó") {
                    
                var IDproceso = parseInt(respuesta);
                console.log("debe ser el ID del objeto insertado del proceso " +IDproceso)
                console.log("Tipo de dato de 'respuesta':", typeof IDproceso);
                
                getProceso(IDproceso, IDTipo, nomTipo, preTipo)
            } 
            else {
                console.error("no insertó el registro del proceso:", respuesta);
                console.log("Tipo de dato de 'respuesta':", typeof respuesta);
            }
                   //table.ajax.reload(null, false)
        },
        error: function (error) {
            console.error('error al registrar datos proceso:', error);
        }
    })
} 

