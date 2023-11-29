<?php
    class DB{
        private $host;
        private $user;
        private $pw;
        private $db;
        public $conn;

        public function __construct(){
            $this->host = "localhost";
            $this->user = "root";
            $this->pw = "";
            $this->db = "bdprueba";
            $this->conn = null;
        }

        public function conectar(){
            $this->conn = new mysqli($this->host, $this->user, $this->pw, $this->db);
            if($this->conn->connect_error){
                return false;
            }else{
                return true;
            }
        }

        public function cerrar(){
            if(isset($this->conn)){
                $this->conn->close();
                $this->conn = null;
            }
        }
    }
?>