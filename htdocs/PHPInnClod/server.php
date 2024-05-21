
<?php
    /* $conexion=mysqli_connect("localhost", "root", "", "innclod_bd") or die ("error conexion bd");
    
    echo "conexion correcta con bd"; */
    class conexion{
        static public function conectar(){

            //$server=mysqli_connect("localhost", "root", "", "innclod_bd");

            $server = new PDO("mysql:host=localhost;
            dbname=innclod_db", 
            "root",
            "",
            array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
            
            return $server;
        }
    }

