function valPrefijo(tipo) {

    var prefijo;

    switch (tipo) {
        case "acta":
            prefijo = "acta";
            break;
        case "boletin":
            prefijo = "bol";
            break;
        case "especificaciones":
            prefijo = "esp";
            break;
        case "instructivo":
            prefijo = "ins";
            break;
        case "licencias":
            prefijo = "licen";
            break;
        case "politicas":
            prefijo = "pol";
            break;
        case "certificacion":
            prefijo = "cert";
            break;
        case "diplomatura":
            prefijo = "diplo";
            break;
        case "doctorado":
            prefijo = "docto";
            break;
        case "ingenieria":
            prefijo = "ing";
            break;
        case "licenciatura":
            prefijo = "lic";
            break;
        case "maestria":
            prefijo = "mae";
            break;
        default:
            prefijo = null;
    }
    
    return prefijo;
}

function funTip(objID, tipN, proN){
    nTip= tipN

    $.ajax({
        url: "ajax/tipo_ajax.php?action=tipoByID",
        method: "GET",
        data: {TIP_NOMBRE: nTip},
        dataType: "json",

        success: function (respuesta) {
            idT= respuesta.TIP_ID
            nomT= respuesta.TIP_NOMBRE
            funPro(objID, proN, idT ,nomT)
        },
        error: function (error) {
            console.error('error al consultar datos tipo:', error);
        }
    })  
}

function funPro(objID, proN, idT ,nomT){

    nPro= proN
    
    $.ajax({
        url: "ajax/proceso_ajax.php?action=procesoByID",
        method: "GET",
        data: {PRO_NOMBRE: nPro},
        dataType: "json",

        success: function (respuesta) {
            editDocumento(objID, idT, nomT, respuesta.PRO_ID , respuesta.PRO_NOMBRE)
        },

        error: function (error) {
            console.error('error al consultar datos proceso:', error);
        }
    })
}

$(document).ready(function() {

    getAllDoc();

    editDocumento(1, 2, "boletin", 2 , "diplomatura")

    $('#tabla').on('click', '#editar', function() {
        fila = $(this).closest('tr');
        $(this).attr('id', 'actualizar').attr('src', '../media/img/approve.png');

        const op = [];

        fila.find('.editable').each(function() {
            valor = $(this).text().trim();
            elementos = document.querySelector("#selectTipo").querySelectorAll('option');

            elementos.forEach(function(elemento) {
                op.push(elemento.outerHTML);
            });

            $(this).html('<select name= "tipo" id="selectTipo">' + op + '</select>');
        });

        const opPro = [];
        fila.find('.editable1').each(function() {
            valor = $(this).text().trim();
            elementos = document.querySelector("#selectProceso").querySelectorAll('option');

            elementos.forEach(function(elemento) {
                opPro.push(elemento.outerHTML);
            });

            $(this).html('<select name= "proceso" id="selectProceso">' + opPro + '</select>');
        });

        fila.find('.oculto').each(function() {
            idAct = parseInt($(this).text().trim());
        });
    });

    $('#tabla').on('click', '#actualizar', function() {
        fila = $(this).closest('tr');
        docTipo = fila.find('td:eq(4) select').val();
        docProc = fila.find('td:eq(5) select').val();

        console.log("id antiguo " + idAct);
        console.log('Tipo:', docTipo, 'Proceso:', docProc);

        fila.find('.editable').each(function() {
            var valor = $(this).find('select').val();
            $(this).text(valor);
        });

        fila.find('.editable1').each(function() {
            var valor = $(this).find('select').val();
            $(this).text(valor);
        });

        $(this).attr('id', 'editar').attr('src', '../media/img/pen.png');
    });

    $("#send").on('click', function() {
        tipo = $("#selectTipo").val();
        proceso = $("#selectProceso").val();

        if (tipo === null || proceso === null) {
            alert('Por favor, selecciona una opción válida en ambos campos.');
        } else {
            getTipo(tipo, proceso);
        }
    });
});
