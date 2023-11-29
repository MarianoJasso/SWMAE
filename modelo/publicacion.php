<?php
    class Publicacion{
        public $id;
        public $usuario;
        public $titulo;
        public $fecha;
        public $cuerpo;
        public $articulo;
        public $historia;

        public function __construct($id, $usuario, $titulo, $fecha, $cuerpo, $articulo, $historia){
            $this->id = $id;
            $this->usuario = $usuario;
            $this->titulo = $titulo;
            $this->fecha = $fecha;
            $this->cuerpo = $cuerpo;
            $this->articulo = $articulo;
            $this->historia = $historia;
        }

        public function existe(){
            include_once '../conexion/bd.php';
            $db = new DB();

            $sql = "SELECT * FROM publicacion WHERE idUsuario = '".$this->usuario."' AND tituloPublicacion = '".$this->titulo."' AND fechaPublicacion = '".$this->fecha."'";
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

        public function guardarHistoria(){
            include_once '../conexion/bd.php';
            $db = new DB();
    
            if ($db->conectar()) {
                $sql = "INSERT INTO publicacion (idUsuario, tituloPublicacion, fechaPublicacion, cuerpoPublicacion, idHistoria) VALUES ('".$this->usuario."', '".$this->titulo."', NOW(), '".$this->cuerpo."', '".$this->historia."')";
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

        public function guardarArticulo(){
            include_once '../conexion/bd.php';
            $db = new DB();
    
            if ($db->conectar()) {
                $sql = "INSERT INTO publicacion (idUsuario, tituloPublicacion, fechaPublicacion, cuerpoPublicacion, idArticulo) VALUES ('".$this->usuario."', '".$this->titulo."', NOW(), '".$this->cuerpo."', '".$this->articulo."')";
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

        public static function buscarIdP($clave){
            include_once '../../conexion/bd.php';
            $db = new DB();
            $publicaciones = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM publicacion WHERE idPublicacion LIKE '".$clave."'";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Publicacion($row["idPublicacion"],
                                        $row["idUsuario"],
                                        $row["tituloPublicacion"],
                                        $row["fechaPublicacion"],
                                        $row["cuerpoPublicacion"],
                                        $row["idArticulo"],
                                        $row["idHistoria"]);
                        array_push($publicaciones, $u);
                    }
                    return $publicaciones;
                }
            }else{
                return false;
            }
        }

        public static function buscarIdA($clave){
            include_once '../../conexion/bd.php';
            $db = new DB();
            $publicaciones = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM publicacion WHERE idArticulo LIKE '".$clave."'";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Publicacion($row["idPublicacion"],
                                        $row["idUsuario"],
                                        $row["tituloPublicacion"],
                                        $row["fechaPublicacion"],
                                        $row["cuerpoPublicacion"],
                                        $row["idArticulo"],
                                        $row["idHistoria"]);
                        array_push($publicaciones, $u);
                    }
                    return $publicaciones;
                }
            }else{
                return false;
            }
        }

        public static function buscarIdADos($clave){
            include_once '../conexion/bd.php';
            $db = new DB();
            $publicaciones = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM publicacion WHERE idArticulo LIKE '".$clave."'";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Publicacion($row["idPublicacion"],
                                        $row["idUsuario"],
                                        $row["tituloPublicacion"],
                                        $row["fechaPublicacion"],
                                        $row["cuerpoPublicacion"],
                                        $row["idArticulo"],
                                        $row["idHistoria"]);
                        array_push($publicaciones, $u);
                    }
                    return $publicaciones;
                }
            }else{
                return false;
            }
        }

        public static function buscarId($clave){
            include_once '../../conexion/bd.php';
            $db = new DB();
            $publicaciones = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM publicacion WHERE idHistoria LIKE '".$clave."'";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Publicacion($row["idPublicacion"],
                                        $row["idUsuario"],
                                        $row["tituloPublicacion"],
                                        $row["fechaPublicacion"],
                                        $row["cuerpoPublicacion"],
                                        $row["idArticulo"],
                                        $row["idHistoria"]);
                        array_push($publicaciones, $u);
                    }
                    return $publicaciones;
                }
            }else{
                return false;
            }
        }

        public static function buscarIdDos($clave){
            include_once '../conexion/bd.php';
            $db = new DB();
            $publicaciones = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM publicacion WHERE idHistoria LIKE '".$clave."'";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Publicacion($row["idPublicacion"],
                                        $row["idUsuario"],
                                        $row["tituloPublicacion"],
                                        $row["fechaPublicacion"],
                                        $row["cuerpoPublicacion"],
                                        $row["idArticulo"],
                                        $row["idHistoria"]);
                        array_push($publicaciones, $u);
                    }
                    return $publicaciones;
                }
            }else{
                return false;
            }
        }

        public static function buscarAutor($clave){
            include_once '../../conexion/bd.php';
            $db = new DB();
            $publicaciones = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM publicacion WHERE idUsuario LIKE '".$clave."'";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Publicacion($row["idPublicacion"],
                                        $row["idUsuario"],
                                        $row["tituloPublicacion"],
                                        $row["fechaPublicacion"],
                                        $row["cuerpoPublicacion"],
                                        $row["idArticulo"],
                                        $row["idHistoria"]);
                        array_push($publicaciones, $u);
                    }
                    return $publicaciones;
                }
            }else{
                return false;
            }
        }

        public function actualizar(){
            include_once '../conexion/bd.php';
            $db = new DB();
        
            if($db->conectar()){
                $sql = "UPDATE publicacion SET tituloPublicacion='".$this->titulo."', cuerpoPublicacion='".$this->cuerpo."' WHERE idPublicacion=".$this->id;
        
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