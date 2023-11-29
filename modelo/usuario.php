<?php
    class Usuario{
        public $id;
        public $correo;
        public $contrasena;
        public $fechaRegistro;
        public $direccion;

        public function __construct($id, $correo, $contrasena, $fechaRegistro, $direccion){
            $this->id = $id;
            $this->correo = $correo;
            $this->contrasena = $contrasena;
            $this->fechaRegistro = $fechaRegistro;
            $this->direccion = $direccion;
        }

        public function existe(){
            include_once '../conexion/bd.php';
            $db = new DB();

            $sql = "SELECT * FROM usuario WHERE correoUsuario ='".$this->correo."' AND contrasena = MD5('".$this->contrasena."')";
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
                $sql = "INSERT INTO direccion (ciudad, estado, detalles) VALUES ('Pendiente', 'Pendiente', 'Pendiente')";
                $db->conn->query($sql);
                $direccionId=$db->conn->insert_id;
                echo $direccionId;

                $sql = "INSERT INTO usuario (correoUsuario, contrasena, fechaRegistroUsuario, idDireccion) VALUES ('".$this->correo."', MD5('".$this->contrasena."'), NOW(), '".$direccionId."')";
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

        public static function buscarId($clave){
            include_once '../../conexion/bd.php';
            $db = new DB();
            $usuarios = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM usuario WHERE idUsuario LIKE '".$clave."'";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Usuario($row["idUsuario"],
                                       $row["correoUsuario"],
                                       $row["contrasena"],
                                       $row["fechaRegistroUsuario"],
                                       $row["idDireccion"]);
                        array_push($usuarios, $u);
                    }
                    return $usuarios;
                }
            }else{
                return false;
            }
        }

        public static function buscarIdDos($clave){
            include_once '../conexion/bd.php';
            $db = new DB();
            $usuarios = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM usuario WHERE idUsuario LIKE '".$clave."'";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Usuario($row["idUsuario"],
                                       $row["correoUsuario"],
                                       $row["contrasena"],
                                       $row["fechaRegistroUsuario"],
                                       $row["idDireccion"]);
                        array_push($usuarios, $u);
                    }
                    return $usuarios;
                }
            }else{
                return false;
            }
        }

        public static function buscarCorreo($clave){
            include_once '../conexion/bd.php';
            $db = new DB();
            $usuarios = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM usuario WHERE correoUsuario = '".$clave."'";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Usuario($row["idUsuario"],
                                       $row["correoUsuario"],
                                       $row["contrasena"],
                                       $row["fechaRegistroUsuario"],
                                       $row["idDireccion"]);
                        array_push($usuarios, $u);
                    }
                    return $usuarios;
                }
            }else{
                return false;
            }
        }

        public function guardarSesion(){
            session_start();
            $_SESSION['usuario'] = $this->correo;

            include_once '../conexion/bd.php';
            $db = new DB();

            $sql = "SELECT idUsuario, idDireccion FROM usuario WHERE correoUsuario = '".$this->correo."'";
            if($db->conectar()){
                $resultado = $db->conn->query($sql);
                if ($resultado->num_rows > 0) {
                    while($row = $resultado->fetch_assoc()){
                        $bandera = $row['idDireccion'];
                        $_SESSION['id'] = $row['idUsuario'];
                    }
                }

                $sql = "SELECT * FROM direccion WHERE idDireccion = '".$bandera."'";
                $result = $db->conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        $_SESSION['ciudad'] = $row['ciudad'];
                        $_SESSION['estado'] = $row['estado'];
                        $_SESSION['detalles'] = $row['detalles'];
                    }
                }
            }
        }

        public function guardarSesionPropi(){
            include_once '../conexion/bd.php';

            if(isset($_SESSION['usuario'])){
                $db = new DB();

                $sql = "SELECT idUsuario FROM usuario WHERE correoUsuario = '".$_SESSION['usuario']."'";
                if($db->conectar()){
                    $resultado = $db->conn->query($sql);
                    if ($resultado->num_rows > 0) {
                        while($row = $resultado->fetch_assoc()){
                            $bandera = $row['idUsuario'];
                        }
                    }

                    $sql = "SELECT * FROM propietario WHERE idUsuario = '".$bandera."'";
                    $result = $db->conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()){
                            $_SESSION['nombre'] = $row['nomPropietario'];
                            $_SESSION['apellido'] = $row['apePropietario'];
                            $_SESSION['propietario'] = $row['idPropietario'];
                            $_SESSION['telefono'] = $row['telefonoPropietario'];
                        }
                    }
                }
            }
        }

        public function guardarSesionExpe(){
            include_once '../conexion/bd.php';

            if(isset($_SESSION['usuario'])){
                $db = new DB();

                $sql = "SELECT idUsuario FROM usuario WHERE correoUsuario = '".$_SESSION['usuario']."'";
                if($db->conectar()){
                    $resultado = $db->conn->query($sql);
                    if ($resultado->num_rows > 0) {
                        while($row = $resultado->fetch_assoc()){
                            $bandera = $row['idUsuario'];
                        }
                    }

                    $sql = "SELECT * FROM experto WHERE idUsuario = '".$bandera."'";
                    $result = $db->conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()){
                            $_SESSION['nombre'] = $row['nomExperto'];
                            $_SESSION['apellido'] = $row['apeExperto'];
                            $_SESSION['experto'] = $row['idExperto'];
                            $_SESSION['area'] = $row['areaConocimiento'];
                            $_SESSION['descripcion'] = $row['descripcionExperto'];
                        }
                    }
                }
            }
        }

        public function guardarSesionProfe(){
            include_once '../conexion/bd.php';

            if(isset($_SESSION['usuario'])){
                $db = new DB();

                $sql = "SELECT idUsuario FROM usuario WHERE correoUsuario = '".$_SESSION['usuario']."'";
                if($db->conectar()){
                    $resultado = $db->conn->query($sql);
                    if ($resultado->num_rows > 0) {
                        while($row = $resultado->fetch_assoc()){
                            $bandera = $row['idUsuario'];
                        }
                    }

                    $sql = "SELECT * FROM profesional WHERE idUsuario = '".$bandera."'";
                    $result = $db->conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()){
                            $_SESSION['nombre'] = $row['nomProfesional'];
                            $_SESSION['apellido'] = $row['apeProfesional'];
                            $_SESSION['profesional'] = $row['idProfesional'];
                            $_SESSION['especialidad'] = $row['especialidad'];
                            $_SESSION['experiencia'] = $row['experiencia'];
                        }
                    }
                }
            }
        }

        public function actualizar(){
            include_once '../conexion/bd.php';
            $db = new DB();
        
            if($db->conectar()){
                $sql = "UPDATE usuario SET correoUsuario='".$this->correo."' WHERE idUsuario=".$this->id;
        
                if($db->conn->query($sql)===TRUE){
                    $db->cerrar();
                    return true;
                }else{
                    $db->cerrar();
                    return false;
                }
            }
        }

        public static function eliminar($usuarioId){
            include_once '../conexion/bd.php';

            $db = new DB();
        
            if($db->conectar()){
                $sql = "DELETE FROM usuario WHERE idUsuario  = '".$usuarioId."'";
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