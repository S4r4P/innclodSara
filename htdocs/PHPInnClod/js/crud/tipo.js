function getTipo(IDTipo, proceso) {
    
    id= IDTipo

    $.ajax({
        url: "ajax/tipo_ajax.php?action=tipoByID",
        method: "GET",
        data: {TIP_ID: id},
        //data: {TIP_NOMBRE: id},
        dataType: "json",

        success: function (respuesta) {
            //INSERTAR TIPO
            //postProceso(proceso, respuesta.TIP_ID, respuesta.TIP_NOMBRE , respuesta.TIP_PREFIJO)
            //INSERTAR DOCUMENTO
            getProceso(proceso, respuesta.TIP_ID, respuesta.TIP_NOMBRE , respuesta.TIP_PREFIJO)
            console.log(proceso, respuesta.TIP_ID, respuesta.TIP_NOMBRE , respuesta.TIP_PREFIJO)
        },
        error: function (error) {
            console.error('error al consultar datos tipo:', error);
        }
    }) 
}

function postTipo(nomTipo, proceso){
    
    prefijo= valPrefijo(nomTipo)
    
    var datos = new FormData();
    datos.append('TIP_NOMBRE', nomTipo)
    datos.append('TIP_PREFIJO', prefijo)
    $.ajax({
        url: "ajax/tipo_ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {

            respuesta = respuesta.replace(/"/g, '').trim();
            console.log("respuesta sin comillas tipo " +respuesta)

            if (respuesta !== "duplicado" && respuesta !== "no inserto") {
                    
                var IDTipo = parseInt(respuesta);
                console.log("debe ser el ID del objeto insertado del tipo " +IDTipo)
                console.log("Tipo de dato de 'respuesta':", typeof IDTipo);
                getTipo(IDTipo, proceso)
                //postDocumento(IDTipo)
            } 
            else {
                    
                console.error("no insertó el registro del tipo: ", respuesta);
                console.log("Tipo de dato de 'respuesta':", typeof respuesta);
                        // Llamar al callback con un valor de error (por ejemplo, -1)
            } 
    
        },
        error: function (error) {
            console.error('error al consultar datos proceso:', error);
        }
    })
}
