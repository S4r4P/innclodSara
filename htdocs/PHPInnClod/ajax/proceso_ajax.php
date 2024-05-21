<?php

    require_once "../controllers/controller_proceso.php";
    require_once "../models/model_proceso.php";
    class ajaxProceso{
        public $id;
        public $nombre;
        public $prefijo;

        public function getProceso() {  

            if (ob_get_length()) {
                ob_clean();
            }

            $object = procesoController::ctrlProceso();     
            echo json_encode($object);                
        }

        //INSERTAR DOCUMENTO
        public function procesoByID() {
            $this->nombre = isset($_GET['PRO_NOMBRE']) ? $_GET['PRO_NOMBRE'] : null;
            //echo "Valor de TIP_NOMBRE: " . $this->nombre;
            if ($this->nombre) {
                $object = procesoController::crtlProcesoByID($this->nombre);
                echo json_encode($object);
            } 
            else {
                echo json_encode(['error' => 'ID no proporcionado']);
            }
        }
        //INSERTAR PROCESO
        /* public function procesoByID() {
            $this->id = isset($_GET['PRO_ID']) ? $_GET['PRO_ID'] : null;
            //echo "Valor de TIP_NOMBRE: " . $this->nombre;
            if ($this->id) {
                $object = procesoController::crtlProcesoByID($this->id);
                echo json_encode($object);
            } 
            else {
                echo json_encode(['error' => 'ID no proporcionado']);
            }
        }  */
        public function postProceso(){
            $object = procesoController::crtPostProceso($this->nombre, $this->prefijo);
            echo json_encode($object);
        }
    }

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    
        if ($action == 'procesoByID') {
            $object = new ajaxProceso();
            $object->procesoByID();
        }
    } else if (!isset($_POST["PRO_NOMBRE"])) {
        $object = new ajaxProceso();
        $object->getProceso();
    } else {
        $object = new ajaxProceso();
        $object->nombre = $_POST["PRO_NOMBRE"];
        $object->prefijo = $_POST["PRO_PREFIJO"];
        $object->postProceso();
    }

    