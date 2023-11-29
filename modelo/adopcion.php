<?php
    class Adopcion{
        public $id;
        public $mascota;
        public $nombre;
        public $correo;
        public $telefono;

        public function __construct($id, $mascota, $nombre, $correo, $telefono){
            $this->id = $id;
            $this->mascota = $mascota;
            $this->nombre = $nombre;
            $this->correo = $correo;
            $this->telefono = $telefono;
        }

        public function guardar(){
            include_once '../conexion/bd.php';
            $db = new DB();
    
            if ($db->conectar()) {
                $sql = "INSERT INTO adopcion (idMascota, nomPersona, correoPersona, telefonoPersona) VALUES ('".$this->mascota."', '".$this->nombre."', '".$this->correo."', '".$this->telefono."')";
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
            $adopciones = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM adopcion WHERE idMascota LIKE '".$clave."'";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Adopcion($row["idAdopcion"],
                                        $row["idMascota"],
                                        $row["nomPersona"],
                                        $row["correoPersona"],
                                        $row["telefonoPersona"]);
                        array_push($adopciones, $u);
                    }
                    return $adopciones;
                }
            }else{
                return false;
            }
        }
    }
?>