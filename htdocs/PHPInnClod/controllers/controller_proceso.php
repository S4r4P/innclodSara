<?php
    
    class procesoController{

        static public function ctrlProceso() {
            return procesoModel::mdlProceso();
        }
        //INSERTAR
        static public function crtlProcesoByID($nombre){
            $object = procesoModel::mdlProcesoByID($nombre);
            return $object;
        }
        //INSERTAR PROCESO
        /* static public function crtlProcesoByID($id){
            $object = procesoModel::mdlProcesoByID($id);
            return $object;
        } */
        static public function crtPostProceso($nombre, $prefijo){
            $object = procesoModel::mdlPostProceso($nombre, $prefijo);
            return $object;
        }
    }