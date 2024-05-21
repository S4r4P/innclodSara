const nomDocumento = (a, b) => {
    return a +" de "+ b;
}

const codDocumento = (a, b) => {
    return a +"-"+ b;
}
const contenidoDoc = (a, b) => {
    return a.toUpperCase() +" DE "+ b.toUpperCase() + "\nDocumento de apoyo único y de uso propio para el proceso elegido.\n¡Suerte!"
}

function getAllDoc() {
    $.ajax({
        url: "ajax/doc_ajax.php",
        method: "GET",
        dataType: "json",
        success: function(respuesta) {
            if (Array.isArray(respuesta)) {
                for (i = 0; i < respuesta.length; i++) {
                    var documento = respuesta[i];

                    var idDoc = documento.DOC_ID;
                    var nombre = documento.DOC_NOMBRE;
                    var codigo = documento.DOC_CODIGO;
                    var contenido = documento.DOC_CONTENIDO;
                    var idTipo = documento.TIP_NOMBRE;
                    var idProceso = documento.PRO_NOMBRE;

                    var registroView = '<tr>' +
                        '<td class="oculto">' + idDoc + '</td>' +
                        '<td>' + nombre + '</td>' +
                        '<td>' + codigo + '</td>' +
                        '<td>' + contenido + '</td>' +
                        '<td class="editable">' + idTipo + '</td>' +
                        '<td class="editable1">' + idProceso + '</td>' +
                        '<td><img src="../media/img/pen.png" alt="" class="icono" id="editar" ></td>' +
                        '<td><img src="../media/img/bin.png" alt="" class="icono" id="eliminar"></td>' +
                        '</tr>';

                    $('table tbody').append(registroView);
                }
            } else {
                console.error('La respuesta no es un array:', respuesta);
            }
        },
        error: function(error) {
            console.error('Error en la petición:', error);
        }
    });
}

function getDocumento(ID) {
    console.log("este es el id del documento que recibe " + ID + " es un " + typeof ID);
    var IDDoc = ID;

    $.ajax({
        url: "ajax/documento_ajax.php?action=documentoByID",
        method: "GET",
        data: { DOC_ID: IDDoc },
        dataType: "json",
        success: function(respuesta) {
            var idDoc = respuesta.DOC_ID;
            var documento = respuesta.DOC_NOMBRE;
            var codigo = respuesta.DOC_CODIGO;
            var contenido = respuesta.DOC_CONTENIDO;
            var IDTipo = respuesta.DOC_ID_TIPO;
            var IDProceso = respuesta.DOC_ID_PROCESO;
            var nomTipo = respuesta.TIP_NOMBRE;
            var nomProceso = respuesta.PRO_NOMBRE;

            var registroView = '<tr>' +
                '<td class="oculto">' + idDoc + '</td>' +
                '<td>' + documento + '</td>' +
                '<td>' + codigo + '</td>' +
                '<td>' + contenido + '</td>' +
                '<td class="editable">' + nomTipo + '</td>' +
                '<td class="editable1">' + nomProceso + '</td>' +
                '<td><img src="../media/img/pen.png" alt="" class="icono" id="editar" ></td>' +
                '<td><img src="../media/img/bin.png" alt="" class="icono" id="eliminar"></td>' +
                '</tr>';

            $('table tbody').append(registroView);
        },
        error: function(error) {
            console.error('error al consultar datos proceso:', error);
        }
    });
}

function postDocumento(IDTipo, nomTipo, preTipo, IDPro, nomPro, prePro){
    
    /* console.log(`id tipo: ${IDTipo} \n  
    nombre tipo: ${nomTipo} \n 
    prefijo tipo: ${preTipo} \n 
    id proceso: ${IDPro} \n 
    nombre proceso: ${nomPro} \n 
    prefijo proceso: ${prePro}`);
*/
    const nombre=nomDocumento(nomTipo, nomPro)
    const codigo=codDocumento(preTipo, prePro)
    const contenido=contenidoDoc(nomTipo, nomPro)
    tipo= IDTipo
    pro=IDPro

    console.log("Tipo de dato de 'documento':", typeof nombre);
    console.log("Tipo de dato de 'codigo':", typeof codigo);
    console.log("Tipo de dato de 'contenido':", typeof contenido);
    console.log("Tipo de dato de 'tipo':", typeof tipo);
    console.log("Tipo de dato de 'proceso':", typeof pro);
    
    var datos = new FormData();
    datos.append('action', 'postDocumento');
    datos.append('DOC_NOMBRE', nombre)
    datos.append('DOC_CODIGO', codigo)
    datos.append('DOC_CONTENIDO', contenido)
    datos.append('DOC_ID_TIPO', tipo)
    datos.append('DOC_ID_PROCESO', pro)


    $.ajax({
        url: "ajax/doc_ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,

        success: function (respuesta) {
            console.log("cual es la respuesta alv "+respuesta)
            respuesta = respuesta.replace(/"/g, '').trim();
            console.log("respuesta sin comillas documento " +respuesta)
    
            if (respuesta !== "duplicado" && respuesta !== "no inserto") {
                var IDDoc = parseInt(respuesta);
                console.log("debe ser el ID del objeto insertado del documento" +IDDoc)
                console.log("Tipo de dato de 'respuesta':", typeof IDDoc);
                //postDocumento(IDproceso)
                //getDocumento(IDDoc)
            } 
            else {
                console.error("no insertó el registro del proceso:", respuesta);
                console.log("Tipo de dato de 'respuesta':", typeof respuesta);
            }
        },
        error: function (error) {
            console.error('Error al registrar documento:', error);
        }
    });
}

function editDocumento(IDDoc, IDTipo, nomT, IDPro, nomP ){

    console.log( `datos que llegan a la funcion : ${IDDoc} , ${IDTipo}, ${nomT}, ${IDPro},${nomP}}`)

    id=IDDoc
    tipo= IDTipo
    pro=IDPro
    nombre=nomDocumento(nomT, nomP)
    codigo=codDocumento(valPrefijo(nomT),valPrefijo(nomP))
    codigoAct=codigo + '-' + id
    contenido=contenidoDoc(nomT, nomP)
    console.log( `datos que se van a enviar : ${id} , ${tipo,nombre}, ${codigoAct}, ${contenido},${pro}}`)

    var datos = new FormData();
    datos.append('action', 'editDocumento');
    datos.append('DOC_ID', id);
    datos.append('DOC_NOMBRE', nombre);
    datos.append('DOC_CODIGO', codigoAct);
    datos.append('DOC_CONTENIDO', contenido);
    datos.append('DOC_ID_TIPO', tipo);
    datos.append('DOC_ID_PROCESO', pro);

    $.ajax({
        url: "ajax/doc_ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,

        success: function (respuesta) {
            console.log("cual es la respuesta alv "+respuesta)
            respuesta = respuesta.replace(/"/g, '').trim();
            console.log("respuesta sin comillas documento " +respuesta)
    
            if (respuesta !== "duplicado" && respuesta !== "no inserto") {
                    
                var IDDoc = parseInt(respuesta);
                console.log("debe ser el ID del objeto insertado del documento" +IDDoc)
                console.log("Tipo de dato de 'respuesta':", typeof IDDoc);
                //postDocumento(IDproceso)
                //getDocumento(IDDoc, nomTipo, nomPro)
            } 
            else {
                console.error("no insertó el registro del proceso:", respuesta);
                console.log("Tipo de dato de 'respuesta':", typeof respuesta);
            }
        },
        error: function (error) {
            console.error('Error al registrar documento:', error);
        }
    });
}