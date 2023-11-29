<?php
    class Profesional{
        public $id;
        public $nombre;
        public $apellido;
        public $especialidad;
        public $experiencia;
        public $usuario;

        public function __construct($id, $nombre, $apellido, $especialidad, $experiencia, $usuario){
            $this->id = $id;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->especialidad = $especialidad;
            $this->experiencia = $experiencia;
            $this->usuario = $usuario;
        }

        public function guardar(){
            include_once '../conexion/bd.php';
            $db = new DB();
    
            if ($db->conectar()) {
                $sql = "INSERT INTO profesional (nomProfesional, apeProfesional, especialidad, experiencia, idUsuario) VALUES ('".$this->nombre."', '".$this->apellido."', 'Pendiente', 'Pendiente', '".$this->usuario."')";
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
            $profesionales = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM profesional";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Profesional($row["idProfesional"],
                                        $row["nomProfesional"],
                                        $row["apeProfesional"],
                                        $row["especialidad"],
                                        $row["experiencia"],
                                        $row["idUsuario"]);
                        array_push($profesionales, $u);
                    }
                    return $profesionales;
                }
            }else{
                return false;
            }
        }

        public static function buscarIdP($clave){
            include_once '../../conexion/bd.php';
            $db = new DB();
            $profesionales = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM profesional WHERE idProfesional LIKE '".$clave."'";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Profesional($row["idProfesional"],
                                        $row["nomProfesional"],
                                        $row["apeProfesional"],
                                        $row["especialidad"],
                                        $row["experiencia"],
                                        $row["idUsuario"]);
                        array_push($profesionales, $u);
                    }
                    return $profesionales;
                }
            }else{
                return false;
            }
        }

        public static function buscarId($clave){
            include_once '../../conexion/bd.php';
            $db = new DB();
            $profesionales = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM profesional WHERE idUsuario LIKE '".$clave."'";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Profesional($row["idProfesional"],
                                        $row["nomProfesional"],
                                        $row["apeProfesional"],
                                        $row["especialidad"],
                                        $row["experiencia"],
                                        $row["idUsuario"]);
                        array_push($profesionales, $u);
                    }
                    return $profesionales;
                }
            }else{
                return false;
            }
        }

        public static function buscarIdDos($clave){
            include_once '../conexion/bd.php';
            $db = new DB();
            $profesionales = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM profesional WHERE idUsuario LIKE '".$clave."'";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Profesional($row["idProfesional"],
                                        $row["nomProfesional"],
                                        $row["apeProfesional"],
                                        $row["especialidad"],
                                        $row["experiencia"],
                                        $row["idUsuario"]);
                        array_push($profesionales, $u);
                    }
                    return $profesionales;
                }
            }else{
                return false;
            }
        }

        public function actualizar(){
            include_once '../conexion/bd.php';
            $db = new DB();
        
            if($db->conectar()){
                $sql = "UPDATE profesional SET nomProfesional='".$this->nombre."', apeProfesional='".$this->apellido."', especialidad='".$this->especialidad."', experiencia='".$this->experiencia."' WHERE idProfesional=".$this->id;
        
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