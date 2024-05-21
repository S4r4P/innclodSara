<?php
    
    class documentoController{
        
        static public function ctrlDocumento(){
           $object = documentoModel::mdlDocumento();
           return $object;
        }
        static public function crtlDocumentoByID($id){
            $object = documentoModel::mdlDocumentoByID($id);
            return $object;
        }
        static public function crtPostDocumento($nombre, $codigo, $contenido, $tipo, $proceso){
            $object = documentoModel::mdlPostDocumento($nombre, $codigo, $contenido, $tipo, $proceso);
            return $object;
        }
        static public function crtlEditDocumento($id, $nombre, $codigo, $contenido, $tipo, $proceso){
            $object = documentoModel::mdlEditDocumento($id, $nombre, $codigo, $contenido, $tipo, $proceso);
            return $object;
        }
        static public function crtlDeletedDoc($id){
            $object = documentoModel::mdlDeletedDoc($id);
            return $object;
        }
    }
