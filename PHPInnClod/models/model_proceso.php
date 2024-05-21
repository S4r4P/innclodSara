<?php

    require_once "../server.php";
    
    class procesoModel{
        static public function mdlProceso(){
            
            $stmt = conexion::conectar()-> prepare("SELECT * FROM pro_proceso");

            $stmt -> execute();

            return $stmt -> fetchAll();
            
        }
        //INSERTAR DOCUMENTO
        /* static public function mdlProcesoByID($nombre) {
            $stmt = conexion::conectar()->prepare("SELECT * FROM pro_proceso WHERE PRO_NOMBRE = :PRO_NOMBRE");
            $stmt->bindParam(":PRO_NOMBRE", $nombre, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve un solo registro
        } */
        //INSERTAR PROCESO 
        static public function mdlProcesoByID($id) {
            $stmt = conexion::conectar()->prepare("SELECT * FROM pro_proceso WHERE PRO_ID = :PRO_ID");
            $stmt->bindParam(":PRO_ID", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve un solo registro
        } 
        static public function mdlPostProceso($nombre, $prefijo){
            try {
                $conn = conexion::conectar();
        
                $checkStmt = $conn->prepare("SELECT COUNT(*) FROM pro_proceso WHERE PRO_NOMBRE = :PRO_NOMBRE");
                $checkStmt->bindParam(":PRO_NOMBRE", $nombre, PDO::PARAM_STR);
                $checkStmt->execute();
                $count = $checkStmt->fetchColumn();
        
                if ($count > 0) {
                    return "duplicado";
                }

                $stmt = $conn->
                prepare("INSERT INTO pro_proceso(PRO_NOMBRE, PRO_PREFIJO) VALUES (:PRO_NOMBRE, :PRO_PREFIJO)");
                $stmt->bindParam(":PRO_NOMBRE", $nombre, PDO::PARAM_STR);
                $stmt->bindParam(":PRO_PREFIJO", $prefijo, PDO::PARAM_STR);
        
                if ($stmt->execute()) {
                    return $conn->lastInsertId();
                } else {
                    return "no inserto";
                }
            } catch (Exception $e) {
                return "error: " . $e->getMessage();
            }
        }
        
    }
/* 
    $proceso = procesoModel::mdlProceso();
    print_r($proceso); */