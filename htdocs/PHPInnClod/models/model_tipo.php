<?php

    require_once "../server.php";
    
    class tipoModel{

        static public function mdlTipo(){
            
            $stmt = conexion::conectar()-> prepare("SELECT * FROM tip_tipo_doc");

            $stmt -> execute();

            return $stmt -> fetchAll();
            
        }
        //INSERTAR DOCUMENTO
/*         static public function mdlTipoByID($nombre) {
            $stmt = conexion::conectar()->prepare("SELECT * FROM tip_tipo_doc WHERE TIP_NOMBRE  = :TIP_NOMBRE");
            $stmt->bindParam(":TIP_NOMBRE", $nombre, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } */
        
         //para insertar tipo
        static public function mdlTipoByID($id) {
            $stmt = conexion::conectar()->prepare("SELECT * FROM tip_tipo_doc WHERE TIP_ID = :TIP_ID");
            $stmt->bindParam(":TIP_ID", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve un solo registro
        } 
        static public function mdlPostTipo($nombre, $prefijo){
            try {
                $conn = conexion::conectar();
    
                $checkStmt = $conn->prepare("SELECT COUNT(*) FROM tip_tipo_doc WHERE TIP_NOMBRE = :TIP_NOMBRE");
                $checkStmt->bindParam(":TIP_NOMBRE", $nombre, PDO::PARAM_STR);
                $checkStmt->execute();
                $count = $checkStmt->fetchColumn();
        
                if ($count > 0) {
                    return "duplicado";
                }
        
                $stmt = $conn->
                prepare("INSERT INTO tip_tipo_doc(TIP_NOMBRE, TIP_PREFIJO) VALUES (:TIP_NOMBRE, :TIP_PREFIJO)");
                $stmt->bindParam(":TIP_NOMBRE", $nombre, PDO::PARAM_STR);
                $stmt->bindParam(":TIP_PREFIJO", $prefijo, PDO::PARAM_STR);
        
                if ($stmt->execute()) {
                    return $conn->lastInsertId();
                    //return "insertó";
                } else {
                    return "no inserto";
                }
            } catch (Exception $e) {
                return "error: " . $e->getMessage();
            }
        }
        
    }

    /* $tipo = tipoModel::mdlTipo();
    print_r($tipo); */