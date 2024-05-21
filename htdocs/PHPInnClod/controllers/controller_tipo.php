<?php
    
    class tipoController{
        
        static public function ctrlTipo(){
           $object = tipoModel::mdlTipo();
           return $object;
        }
        //INSERTAR TIPO
        /* static public function crtlTipoByID($id){
            $object = tipoModel::mdlTipoByID($id);
            return $object;
        } */
        //INSERTAR DOCUMENTO
        static public function crtlTipoByID($nombre){
            $object = tipoModel::mdlTipoByID($nombre);
            return $object;
        }
        static public function crtPostTipo($nombre, $prefijo){
            $object = tipoModel::mdlPostTipo($nombre, $prefijo);
            return $object;
        }
    }