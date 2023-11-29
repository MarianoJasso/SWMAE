<?php
    class Articulo{
        public $id;
        public $enlace;

        public function __construct($id, $enlace){
            $this->id = $id;
            $this->enlace = $enlace;
        }

        public function guardar(){
            include_once '../conexion/bd.php';
            $db = new DB();
    
            if ($db->conectar()) {
                $sql = "INSERT INTO articulo (enlaceApoyo) VALUES ('".$this->enlace."')";
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
            $articulos = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM articulo";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Articulo($row["idArticulo"],
                                        $row["enlaceApoyo"]);
                        array_push($articulos, $u);
                    }
                    return $articulos;
                }
            }else{
                return false;
            }
        }

        public static function buscarDos(){
            include_once '../conexion/bd.php';
            $db = new DB();
            $articulos = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM articulo";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Articulo($row["idArticulo"],
                                        $row["enlaceApoyo"]);
                        array_push($articulos, $u);
                    }
                    return $articulos;
                }
            }else{
                return false;
            }
        }

        public static function buscarId($clave){
            include_once '../../conexion/bd.php';
            $db = new DB();
            $articulos = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM articulo WHERE idArticulo LIKE '".$clave."'";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Articulo($row["idArticulo"],
                                        $row["enlaceApoyo"]);
                        array_push($articulos, $u);
                    }
                    return $articulos;
                }
            }else{
                return false;
            }
        }

        public static function buscarenlace($clave){
            include_once '../conexion/bd.php';
            $db = new DB();
            $articulos = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM articulo WHERE enlaceApoyo LIKE '".$clave."'";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Articulo($row["idArticulo"],
                                        $row["enlaceApoyo"]);
                        array_push($articulos, $u);
                    }
                    return $articulos;
                }
            }else{
                return false;
            }
        }

        public function actualizar(){
            include_once '../conexion/bd.php';
            $db = new DB();
        
            if($db->conectar()){
                $sql = "UPDATE articulo SET enlaceApoyo='".$this->enlace."' WHERE idArticulo=".$this->id;
        
                if($db->conn->query($sql)===TRUE){
                    $db->cerrar();
                    return true;
                }else{
                    $db->cerrar();
                    return false;
                }
            }
        }

        public static function eliminar($articuloId){
            include_once '../conexion/bd.php';

            $db = new DB();
        
            if($db->conectar()){
                $sql = "DELETE FROM articulo WHERE idArticulo  = '".$articuloId."'";
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