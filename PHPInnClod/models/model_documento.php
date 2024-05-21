<?php

    require_once "../server.php";
    
    class documentoModel{

        static public function mdlDocumento(){
            
            $stmt = conexion::conectar()-> prepare("SELECT DOC.*, TIPO.TIP_NOMBRE, PRO.PRO_NOMBRE FROM  doc_documento AS DOC INNER JOIN tip_tipo_doc AS TIPO ON    DOC.DOC_ID_TIPO = TIPO.TIP_ID INNER JOIN pro_proceso AS PRO on DOC.DOC_ID_PROCESO = PRO.PRO_ID");

            $stmt -> execute();

            return $stmt -> fetchAll();
            
        }
        static public function mdlDocumentoByID($id) {
            $stmt = conexion::conectar()->prepare("SELECT * FROM doc_documento WHERE DOC_ID = :DOC_ID");
            $stmt->bindParam(":DOC_ID", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        }

        static public function mdlPostDocumento($nombre, $codigo, $contenido, $tipo, $proceso) {
            
            try {
                $conn = conexion::conectar();
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                $checkStmt = $conn->prepare("SELECT COUNT(*) FROM doc_documento WHERE DOC_CODIGO = :DOC_CODIGO");
                $checkStmt->bindParam(":DOC_CODIGO", $codigo, PDO::PARAM_STR);
                $checkStmt->execute();
                $count = $checkStmt->fetchColumn();
        
                if ($count > 0) {
                    return "duplicado";
                }

                $stmt = $conn->prepare("INSERT INTO doc_documento (DOC_NOMBRE, DOC_CODIGO, DOC_CONTENIDO, DOC_ID_TIPO, DOC_ID_PROCESO) VALUES (:DOC_NOMBRE, :DOC_CODIGO, :DOC_CONTENIDO, :DOC_ID_TIPO, :DOC_ID_PROCESO)");
                $stmt->bindParam(":DOC_NOMBRE", $nombre, PDO::PARAM_STR);
                $stmt->bindParam(":DOC_CODIGO", $codigo, PDO::PARAM_STR);
                $stmt->bindParam(":DOC_CONTENIDO", $contenido, PDO::PARAM_STR);
                $stmt->bindParam(":DOC_ID_TIPO", $tipo, PDO::PARAM_INT);
                $stmt->bindParam(":DOC_ID_PROCESO", $proceso, PDO::PARAM_INT);
        
                if ($stmt->execute()) {
                    $lastId = $conn->lastInsertId();
        
                    $codigoActualizado = $codigo . '-' . $lastId;
                    $updateStmt = $conn->prepare("UPDATE doc_documento SET DOC_CODIGO = :DOC_CODIGO WHERE DOC_ID = :DOC_ID");
                    $updateStmt->bindParam(":DOC_CODIGO", $codigoActualizado, PDO::PARAM_STR);
                    $updateStmt->bindParam(":DOC_ID", $lastId, PDO::PARAM_INT);
                    
                    if ($updateStmt->execute()) {
                        return $updateStmt->fetch(PDO::FETCH_ASSOC);
                    } else {
                        return "no actualizo";
                    }
                } else {
                    return "no inserto";
                }
            } catch (Exception $e) {
                return "error: " . $e->getMessage();
            }
        }
        
        static public function mdlEditDocumento($ID, $nombre, $codigo, $contenido, $tipo, $proceso){
            try {
                $conn = conexion::conectar();

                $checkStmt = $conn->prepare("SELECT COUNT(*) FROM pro_proceso WHERE DOC_ID = :DOC_ID");
                $checkStmt->bindParam(":DOC_ID", $ID, PDO::PARAM_INT);
                $checkStmt->execute();
                $count = $checkStmt->fetchColumn();
        
                if ($count < 0) {
                    return "no existe el registro";
                }
                
                $stmt = $conn->
                prepare("UPDATE pro_proceso SET DOC_ID(DOC_NOMBRE, DOC_CODIGO, DOC_CONTENIDO, DOC_ID_TIPO, DOC_ID_PROCESO) VALUES (:DOC_NOMBRE, :DOC_CODIGO, :DOC_CONTENIDO, :DOC_ID_TIPO, :DOC_ID_PROCESO) WHERE DOC_ID = :DOC_ID");
                $stmt->bindParam(":DOC_ID", $ID, PDO::PARAM_INT);
                $stmt->bindParam(":DOC_NOMBRE", $nombre, PDO::PARAM_STR);
                $stmt->bindParam(":DOC_CODIGO", $codigo, PDO::PARAM_STR);
                $stmt->bindParam(":DOC_CONTENIDO", $contenido, PDO::PARAM_STR);
                $stmt->bindParam(":DOC_ID_TIPO", $tipo, PDO::PARAM_INT);
                $stmt->bindParam(":DOC_ID_PROCESO", $proceso, PDO::PARAM_INT);
        
                if ($stmt->execute()) {
                    return $stmt->fetch(PDO::FETCH_ASSOC);
                } else {
                    return "no inserto";
                }
            } catch (Exception $e) {
                return "error: " . $e->getMessage();
            }
        }
        static public function mdlDeletedDoc($ID){
            try {
                $conn = conexion::conectar();

                $checkStmt = $conn->prepare("DELETE FROM pro_proceso WHERE DOC_ID = :DOC_ID");
                $checkStmt->bindParam(":DOC_ID", $ID, PDO::PARAM_INT);
                $checkStmt->execute();
                $count = $checkStmt->fetchColumn();
        
                if ($checkStmt->execute()) {
                    return "eliminado";
                } else {
                    return "no se elimino";
                }
            } catch (Exception $e) {
                return "error: " . $e->getMessage();
            }
        }
    }

    $documento = documentoModel::mdlDocumento();
    print_r($documento);