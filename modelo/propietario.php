<?php
    class Propietario{
        public $id;
        public $nombre;
        public $apellido;
        public $telefono;
        public $usuario;

        public function __construct($id, $nombre, $apellido, $telefono, $usuario){
            $this->id = $id;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->telefono = $telefono;
            $this->usuario = $usuario;
        }

        public function guardar(){
            include_once '../conexion/bd.php';
            $db = new DB();
    
            if ($db->conectar()) {
                $sql = "INSERT INTO propietario (nomPropietario, apePropietario, telefonoPropietario, idUsuario) VALUES ('".$this->nombre."', '".$this->apellido."', 'Pendiente', '".$this->usuario."')";
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
            $propietarios = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM propietario";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Propietario($row["idPropietario"],
                                        $row["nomPropietario"],
                                        $row["apePropietario"],
                                        $row["telefonoPropietario"],
                                        $row["idUsuario"]);
                        array_push($propietarios, $u);
                    }
                    return $propietarios;
                }
            }else{
                return false;
            }
        }

        public static function buscarIdM($clave){
            include_once '../../conexion/bd.php';
            $db = new DB();
            $propietarios = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM propietario WHERE idPropietario LIKE '".$clave."'";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Propietario($row["idPropietario"],
                                        $row["nomPropietario"],
                                        $row["apePropietario"],
                                        $row["telefonoPropietario"],
                                        $row["idUsuario"]);
                        array_push($propietarios, $u);
                    }
                    return $propietarios;
                }
            }else{
                return false;
            }
        }

        public static function buscarId($clave){
            include_once '../../conexion/bd.php';
            $db = new DB();
            $propietarios = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM propietario WHERE idUsuario LIKE '".$clave."'";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Propietario($row["idPropietario"],
                                        $row["nomPropietario"],
                                        $row["apePropietario"],
                                        $row["telefonoPropietario"],
                                        $row["idUsuario"]);
                        array_push($propietarios, $u);
                    }
                    return $propietarios;
                }
            }else{
                return false;
            }
        }

        public static function buscarIdDos($clave){
            include_once '../conexion/bd.php';
            $db = new DB();
            $propietarios = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM propietario WHERE idUsuario LIKE '".$clave."'";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Propietario($row["idPropietario"],
                                        $row["nomPropietario"],
                                        $row["apePropietario"],
                                        $row["telefonoPropietario"],
                                        $row["idUsuario"]);
                        array_push($propietarios, $u);
                    }
                    return $propietarios;
                }
            }else{
                return false;
            }
        }

        public function actualizar(){
            include_once '../conexion/bd.php';
            $db = new DB();
        
            if($db->conectar()){
                $sql = "UPDATE propietario SET nomPropietario='".$this->nombre."', apePropietario='".$this->apellido."', telefonoPropietario='".$this->telefono."' WHERE idPropietario=".$this->id;
        
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