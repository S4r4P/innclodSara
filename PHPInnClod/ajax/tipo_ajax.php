
<?php

    require_once "../controllers/controller_tipo.php";
    require_once "../models/model_tipo.php";
    class ajaxTipo{

        public $id;
        public $nombre;
        public $prefijo;

        public function getTipo() {   

            if (ob_get_length()) {
                ob_clean();
            }    
                    
            $object = tipoController::ctrlTipo();
            echo json_encode($object);
        }
        //INSERTAR TIPO
        /* public function tipoByID() {
            $this->id = isset($_GET['TIP_ID']) ? $_GET['TIP_ID'] : null;
            //echo "Valor de TIP_ID: " . $this->nombre;
            if ($this->id) {
                $object = tipoController::crtlTipoByID($this->id);
                echo json_encode($object);
            } 
            else {
                echo json_encode(['error' => 'ID no proporcionado']);
        } 
    }*/
    //INSERTAR DOCUMENTO
        public function tipoByID() {
            $this->nombre = isset($_GET['TIP_NOMBRE']) ? $_GET['TIP_NOMBRE'] : null;
            //echo "Valor de TIP_ID: " . $this->nombre;
            if ($this->nombre) {
                $object = tipoController::crtlTipoByID($this->nombre);
                echo json_encode($object);
            } 
            else {
                echo json_encode(['error' => 'ID no proporcionado']);
            }
        }
        public function postTipo(){
            $object = tipoController::crtPostTipo($this->nombre, $this->prefijo);
            echo json_encode($object);
        }
    }

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    
        if ($action == 'tipoByID') {
            $object = new ajaxTipo();
            $object->tipoByID();
        }
    } else if (!isset($_POST["TIP_NOMBRE"])) {
        $object = new ajaxTipo();
        $object->getTipo();
    } else {
        $object = new ajaxTipo();
        $object->nombre = $_POST["TIP_NOMBRE"];
        $object->prefijo = $_POST["TIP_PREFIJO"];
        $object->postTipo();
    }