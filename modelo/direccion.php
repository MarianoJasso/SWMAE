<?php
    class Direccion{
        public $id;
        public $ciudad;
        public $estado;
        public $detalles;

        public function __construct($id, $ciudad, $estado, $detalles){
            $this->id = $id;
            $this->ciudad = $ciudad;
            $this->estado = $estado;
            $this->detalles = $detalles;
        }

        public static function buscarId($clave){
            include_once '../../conexion/bd.php';
            $db = new DB();
            $direcciones = [];
        
            if($db->conectar()){
                $sql = "SELECT * FROM direccion WHERE idDireccion LIKE '".$clave."'";
                $result = $db->conn->query($sql);
        
                if(is_null($result)){
                    return false;
                }
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $u = new Direccion($row["idDireccion"],
                                       $row["ciudad"],
                                       $row["estado"],
                                       $row["detalles"]);
                        array_push($direcciones, $u);
                    }
                    return $direcciones;
                }
            }else{
                return false;
            }
        }

        public function actualizar(){
            include_once '../conexion/bd.php';
            $db = new DB();
        
            if($db->conectar()){
                $sql = "UPDATE direccion SET ciudad='".$this->ciudad."', estado='".$this->estado."', detalles='".$this->detalles."' WHERE idDireccion=".$this->id;
        
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