<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DOCUMENTOS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../media/css/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
    <body>
        <img id="logout" src="../media/img/log-out.png" title="Cerrar sesión">
        <section>
            <article>
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <strong id="textBot">NUEVO DOCUMENTO</strong>
            </button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">SELECCIONA</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body">
                    <div class="dropdown-center">
                    <select name="tipo" id="selectTipo">
                        <option disabled selected>Tipo de documento</option>
                        <option value="acta">Acta</option>
                        <option value="boletin">Boletín</option>
                        <option value="especificaciones">Especificaciones</option>
                        <option value="instructivo">Instructivo</option>
                        <option value="licencias">Licencias</option>
                        <option value="politicas">Políticas</option>
                    </select>
                    </div>
                    <div class="dropdown-center">
                    <select name="proceso" id="selectProceso">
                        <option disabled selected>Proceso de documento</option>
                        <option value="certificacion">Certificación</option>
                        <option value="diplomatura">Diplomatura</option>
                        <option value="doctorado">Doctorado</option>
                        <option value="ingenieria">Ingenieria</option>
                        <option value="licenciatura">Licenciatura</option>
                        <option value="maestria">Maestría</option>
                    </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-custom " id="send"><strong>Registrar</strong></button>
                </div>
                </div>
            </div>
            </div>
            <input type="text" id="search">
            </article>

            <table id="tabla">
            <thead>
                <tr>
                <th scope="col">NOMBRE DOCUMENTO</th>
                <th scope="col">CÓDIGO DOCUMENTO</th>
                <th scope="col">CONTENIDO DOCUMENTO</th>
                <th scope="col">TIPO DOCUMENTO</th>
                <th scope="col">PROCESO DOCUMENTO</th>
                <th colspan="2">ACCIONES</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            </table>
        </section>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../js/user/logout.js"></script>
    <script src="../js/crud/view.js"></script>
    <script src="../js/crud/view.js"></script>
    <script src="../js/crud/tipo.js"></script>
    <script src="../js/crud/doc.js"></script>
    <script src="../js/crud/proceso.js"></script>
</html>
