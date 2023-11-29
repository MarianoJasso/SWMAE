<?php
    class Historia{
        public $id;
        public $descripcion;

        public function __construct($id, $descripcion){
            $this->id = $id;
            $this->descripcion = $descripcion;
        }

        public function guardar(){
            include_once '../conexion/bd.php';
            $db = new DB();
    
            if ($db->conectar()) {
                $sql = "INSERT INTO historia (descripcionHistoria) VALUES ('".$this->descripcion."')";
                if ($db->conn->query($sql)===TRUE) {
                    $db->cerrar();
                    return true;
                }else {
                    echo($sql);
                    $db->cerrar();
                    return false;
                }
            }
        }

        public static function buscar(){
            include_once '../../conexion/bd.php';
            $db = new DB();
            $historias = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM historia";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Historia($row["idHistoria"],
                                        $row["descripcionHistoria"]);
                        array_push($historias, $u);
                    }
                    return $historias;
                }
            }else{
                return false;
            }
        }

        public static function buscarDos(){
            include_once '../conexion/bd.php';
            $db = new DB();
            $historias = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM historia";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Historia($row["idHistoria"],
                                        $row["descripcionHistoria"]);
                        array_push($historias, $u);
                    }
                    return $historias;
                }
            }else{
                return false;
            }
        }

        public static function buscarId($clave){
            include_once '../../conexion/bd.php';
            $db = new DB();
            $historias = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM historia WHERE idHistoria LIKE '".$clave."'";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Historia($row["idHistoria"],
                                        $row["descripcionHistoria"]);
                        array_push($historias, $u);
                    }
                    return $historias;
                }
            }else{
                return false;
            }
        }

        public static function buscardescripcion($clave){
            include_once '../conexion/bd.php';
            $db = new DB();
            $historias = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM historia WHERE descripcionHistoria LIKE '".$clave."'";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Historia($row["idHistoria"],
                                        $row["descripcionHistoria"]);
                        array_push($historias, $u);
                    }
                    return $historias;
                }
            }else{
                return false;
            }
        }

        public function actualizar(){
            include_once '../conexion/bd.php';
            $db = new DB();
        
            if($db->conectar()){
                $sql = "UPDATE historia SET descripcionHistoria='".$this->descripcion."' WHERE idHistoria=".$this->id;
        
                if($db->conn->query($sql)===TRUE){
                    $db->cerrar();
                    return true;
                }else{
                    $db->cerrar();
                    return false;
                }
            }
        }

        public static function eliminar($historiaId){
            include_once '../conexion/bd.php';

            $db = new DB();
        
            if($db->conectar()){
                $sql = "DELETE FROM historia WHERE idHistoria  = '".$historiaId."'";
                if($db->conn->query($sql)===TRUE){
                    $db->cerrar();
                    return true;
                }else{
                    $db->cerrar();
                    return false;
                }
            }
        }
    }
?>