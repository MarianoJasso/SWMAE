<?php
    class Experto{
        public $id;
        public $nombre;
        public $apellido;
        public $area;
        public $descripcion;
        public $usuario;

        public function __construct($id, $nombre, $apellido, $area, $descripcion, $usuario){
            $this->id = $id;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->area = $area;
            $this->descripcion = $descripcion;
            $this->usuario = $usuario;
        }

        public function guardar(){
            include_once '../conexion/bd.php';
            $db = new DB();
    
            if ($db->conectar()) {
                $sql = "INSERT INTO experto (nomExperto, apeExperto, areaConocimiento, descripcionExperto, idUsuario) VALUES ('".$this->nombre."', '".$this->apellido."', 'Pendiente', 'Pendiente', '".$this->usuario."')";
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
            $expertos = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM experto";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Experto($row["idExperto"],
                                        $row["nomExperto"],
                                        $row["apeExperto"],
                                        $row["areaConocimiento"],
                                        $row["descripcionExperto"],
                                        $row["idUsuario"]);
                        array_push($expertos, $u);
                    }
                    return $expertos;
                }
            }else{
                return false;
            }
        }

        public static function buscarIdE($clave){
            include_once '../../conexion/bd.php';
            $db = new DB();
            $expertos = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM experto WHERE idExperto LIKE '".$clave."'";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Experto($row["idExperto"],
                                        $row["nomExperto"],
                                        $row["apeExperto"],
                                        $row["areaConocimiento"],
                                        $row["descripcionExperto"],
                                        $row["idUsuario"]);
                        array_push($expertos, $u);
                    }
                    return $expertos;
                }
            }else{
                return false;
            }
        }

        public static function buscarId($clave){
            include_once '../../conexion/bd.php';
            $db = new DB();
            $expertos = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM experto WHERE idUsuario LIKE '".$clave."'";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Experto($row["idExperto"],
                                        $row["nomExperto"],
                                        $row["apeExperto"],
                                        $row["areaConocimiento"],
                                        $row["descripcionExperto"],
                                        $row["idUsuario"]);
                        array_push($expertos, $u);
                    }
                    return $expertos;
                }
            }else{
                return false;
            }
        }

        public static function buscarIdDos($clave){
            include_once '../conexion/bd.php';
            $db = new DB();
            $expertos = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM experto WHERE idUsuario LIKE '".$clave."'";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Experto($row["idExperto"],
                                        $row["nomExperto"],
                                        $row["apeExperto"],
                                        $row["areaConocimiento"],
                                        $row["descripcionExperto"],
                                        $row["idUsuario"]);
                        array_push($expertos, $u);
                    }
                    return $expertos;
                }
            }else{
                return false;
            }
        }

        public function actualizar(){
            include_once '../conexion/bd.php';
            $db = new DB();
        
            if($db->conectar()){
                $sql = "UPDATE experto SET nomExperto='".$this->nombre."', apeExperto='".$this->apellido."', areaConocimiento='".$this->area."', descripcionExperto='".$this->descripcion."' WHERE idExperto=".$this->id;
        
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