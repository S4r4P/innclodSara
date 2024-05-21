<?php
    require_once "../controllers/controller_documento.php";
    require_once "../models/model_documento.php";
class ajaxDocumento {
    public $id;
    public $nombre;
    public $codigo;
    public $contenido;
    public $tipo;
    public $proceso;

    public function getDocumento() {   

        if (ob_get_length()) {
            ob_clean();
        }
        
        $object = documentoController::ctrlDocumento();
        echo json_encode($object);
    }

    public function documentoByID() {
        $this->id = isset($_GET['DOC_ID']) ? $_GET['DOC_ID'] : null;

        if ($this->id) {
            $object = documentoController::crtlDocumentoByID($this->id);
            echo json_encode($object);
        } else {
            echo json_encode(['error' => 'ID no proporcionado']);
        }
    }

    public function postDocumento() {
        $object = documentoController::crtPostDocumento($this->nombre, $this->codigo, $this->contenido, $this->tipo, $this->proceso);
        echo json_encode($object);
    }
    Public function editDocumento() {
        $this->id = isset($_GET['DOC_ID']) ? $_GET['DOC_ID'] : null;

        if ($this->id) {
            $object = documentoController::crtlEditDocumento($this->id, $this->nombre, $this->codigo, $this->contenido, $this->tipo, $this->proceso);
            echo json_encode($object);
        } else {
            echo json_encode(['error' => 'ID no proporcionado']);
        }
    }
    public function deletedDoc() {
        $this->id = isset($_DELETE['DOC_ID']) ? $_DELETE['DOC_ID'] : null;

        if ($this->id) {
            $object = documentoController::crtlDeletedDoc($this->id);
            echo json_encode($object);
        } else {
            echo json_encode(['error' => 'ID no proporcionado']);
        }
    }
}

if (isset($_GET['action'])) {

    $action = $_GET['action'];

    if ($action == 'documentoByID') {

        $object = new ajaxDocumento();
        $object->documentoByID();
    }
} 

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == 'documentoByID') {
        $object = new ajaxDocumento();
        $object->documentoByID();
    }
} elseif (isset($_POST['action'])) {
    $action = $_POST['action'];
    
    if ($action == 'postDocumento') {
        $object = new ajaxDocumento();
        $object->nombre = $_POST["DOC_NOMBRE"];
        $object->codigo = $_POST["DOC_CODIGO"];
        $object->contenido = $_POST["DOC_CONTENIDO"];
        $object->tipo = $_POST["DOC_ID_TIPO"];
        $object->proceso = $_POST["DOC_ID_PROCESO"];
        $object->postDocumento();

    } elseif ($action == 'editDocumento') {
        $object = new ajaxDocumento();
        $object->id = $_POST["DOC_ID"];
        $object->nombre = $_POST["DOC_NOMBRE"];
        $object->codigo = $_POST["DOC_CODIGO"];
        $object->contenido = $_POST["DOC_CONTENIDO"];
        $object->tipo = $_POST["DOC_ID_TIPO"];
        $object->proceso = $_POST["DOC_ID_PROCESO"];
        $object->editDocumento();
    }

} else if (isset($_DELETE['action'])){
    $object = new ajaxDocumento();
    $object->documentoByID();
}

else {
    $object = new ajaxDocumento();
    $object->getDocumento();
}