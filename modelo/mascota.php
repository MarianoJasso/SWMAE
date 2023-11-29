<?php
    class Mascota{
        public $id;
        public $nombre;
        public $especie;
        public $tamano;
        public $sexo;
        public $edad;
        public $color;
        public $personalidad;
        public $fechaRegistro;
        public $estatus;
        public $imagen;
        public $propietario;

        public function __construct($id, $nombre, $especie, $tamano, $sexo, $edad, $color, $personalidad, $fechaRegistro, $estatus, $imagen, $propietario){
            $this->id = $id;
            $this->nombre = $nombre;
            $this->especie = $especie;
            $this->tamano = $tamano;
            $this->sexo = $sexo;
            $this->edad = $edad;
            $this->color = $color;
            $this->personalidad = $personalidad;
            $this->fechaRegistro = $fechaRegistro;
            $this->estatus = $estatus;
            $this->imagen = $imagen;
            $this->propietario = $propietario;
        }

        public function existe(){
            include_once '../conexion/bd.php';
            $db = new DB();

            $sql = "SELECT * FROM mascota WHERE nomMascota = '".$this->nombre."' AND especie = '".$this->especie."' AND idPropietario = '".$this->propietario."'";
            if($db->conectar()){
                $result = $db->conn->query($sql);
                if($result==null){
                    return false;
                }
                if($result->num_rows > 0){
                    $db->cerrar();
                    return true;
                }else{
                    $db->cerrar();
                    return false;
                }
            }
        }

        public function guardar(){
            include_once '../conexion/bd.php';
            $db = new DB();
    
            if ($db->conectar()) {
                $imagen = $db->conn->real_escape_string($this->imagen);

                $sql = "INSERT INTO mascota (nomMascota, especie, tamano, sexo, edad, color, personalidad, fechaRegistroMascota, estatus, imagen, idPropietario) VALUES ('".$this->nombre."', '".$this->especie."', '".$this->tamano."', '".$this->sexo."', '".$this->edad."', '".$this->color."', '".$this->personalidad."', NOW(), '".$this->estatus."', '".$imagen."', '".$this->propietario."')";
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
            $mascotas = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM mascota";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Mascota($row["idMascota"],
                                        $row["nomMascota"],
                                        $row["especie"],
                                        $row["tamano"],
                                        $row["sexo"],
                                        $row["edad"],
                                        $row["color"],
                                        $row["personalidad"],
                                        $row["fechaRegistroMascota"],
                                        $row["estatus"],
                                        $row["imagen"],
                                        $row["idPropietario"]);
                        array_push($mascotas, $u);
                    }
                    return $mascotas;
                }
            }else{
                return false;
            }
        }
        public static function buscarDos(){
            include_once '../conexion/bd.php';
            $db = new DB();
            $mascotas = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM mascota";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Mascota($row["idMascota"],
                                        $row["nomMascota"],
                                        $row["especie"],
                                        $row["tamano"],
                                        $row["sexo"],
                                        $row["edad"],
                                        $row["color"],
                                        $row["personalidad"],
                                        $row["fechaRegistroMascota"],
                                        $row["estatus"],
                                        $row["imagen"],
                                        $row["idPropietario"]);
                        array_push($mascotas, $u);
                    }
                    return $mascotas;
                }
            }else{
                return false;
            }
        }
        
        public static function buscarId($clave){
            include_once '../../conexion/bd.php';
            $db = new DB();
            $mascotas = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM mascota WHERE idMascota LIKE '".$clave."'";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Mascota($row["idMascota"],
                                        $row["nomMascota"],
                                        $row["especie"],
                                        $row["tamano"],
                                        $row["sexo"],
                                        $row["edad"],
                                        $row["color"],
                                        $row["personalidad"],
                                        $row["fechaRegistroMascota"],
                                        $row["estatus"],
                                        $row["imagen"],
                                        $row["idPropietario"]);
                        array_push($mascotas, $u);
                    }
                    return $mascotas;
                }
            }else{
                return false;
            }
        }

        public static function buscarPropietario($clave){
            include_once '../../conexion/bd.php';
            $db = new DB();
            $mascotas = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM mascota WHERE idPropietario LIKE '".$clave."'";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Mascota($row["idMascota"],
                                        $row["nomMascota"],
                                        $row["especie"],
                                        $row["tamano"],
                                        $row["sexo"],
                                        $row["edad"],
                                        $row["color"],
                                        $row["personalidad"],
                                        $row["fechaRegistroMascota"],
                                        $row["estatus"],
                                        $row["imagen"],
                                        $row["idPropietario"]);
                        array_push($mascotas, $u);
                    }
                    return $mascotas;
                }
            }else{
                return false;
            }
        }

        public function actualizar(){
            include_once '../conexion/bd.php';
            $db = new DB();
        
            if($db->conectar()){
                $sql = "UPDATE mascota SET nomMascota='".$this->nombre."', especie='".$this->especie."', tamano='".$this->tamano."', sexo='".$this->sexo."', edad='".$this->edad."', color='".$this->color."', personalidad='".$this->personalidad."' WHERE idMascota=".$this->id;
        
                if($db->conn->query($sql)===TRUE){
                    $db->cerrar();
                    return true;
                }else{
                    $db->cerrar();
                    return false;
                }
            }
        }

        public function actualizarI(){
            include_once '../conexion/bd.php';
            $db = new DB();
        
            if($db->conectar()){
                $imagen = $db->conn->real_escape_string($this->imagen);

                $sql = "UPDATE mascota SET nomMascota='".$this->nombre."', especie='".$this->especie."', tamano='".$this->tamano."', sexo='".$this->sexo."', edad='".$this->edad."', color='".$this->color."', personalidad='".$this->personalidad."', imagen='".$imagen."' WHERE idMascota=".$this->id;
        
                if($db->conn->query($sql)===TRUE){
                    $db->cerrar();
                    return true;
                }else{
                    $db->cerrar();
                    return false;
                }
            }
        }

        public function actualizarEstatus(){
            include_once '../conexion/bd.php';
            $db = new DB();
        
            if($db->conectar()){
                $sql = "UPDATE mascota SET estatus='".$this->estatus."' WHERE idMascota=".$this->id;
        
                if($db->conn->query($sql)===TRUE){
                    $db->cerrar();
                    return true;
                }else{
                    $db->cerrar();
                    return false;
                }
            }
        }

        public static function eliminar($mascotaId){
            include_once '../conexion/bd.php';

            $db = new DB();
        
            if($db->conectar()){
                $sql = "DELETE FROM mascota WHERE idMascota  = '".$mascotaId."'";
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