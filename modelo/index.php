<?php
    class Modelo{

        // Atributos de la clase
        private $Modelo;
        public $db;    
        private $datos;    

        // Métodos de la clase
        public function __construct(){
            $this->Modelo = array();
            $this->db = new PDO('mysql:host=localhost;dbname=Inventario',"root","");
       
        }

        public function consulta($query, $Assoc){
            $resultado = $this->db->query($query);
            if ($resultado) {

                if ($Assoc) {
                    $this->datos = $resultado->fetchAll(PDO::FETCH_ASSOC);
                }
                else {
                    $this->datos = $resultado->fetchAll(PDO::FETCH_NUM);
                }

                return $this->datos;
            }else {
                echo "Error en la consulta";
                return;
            }
         }


        public function insertar($tabla, $data){
            $consulta = "insert into ".$tabla." values(null,". $data .")";
            $resultado = $this->db->query($consulta);
            if ($resultado) {
                return true;
            }else {
                return false;
            }
         }

        public function mostrar($tabla,$condicion){
            $consul="select * from ".$tabla." where ".$condicion.";";
            $resu=$this->db->query($consul);        
            while($filas = $resu->fetch(PDO::FETCH_ASSOC)) {
                    $this->datos[]=$filas;
            }
            return $this->datos;
        } 

        public function actualizar($tabla, $data, $condicion){       
            $consulta="update ".$tabla." set ". $data ." where ".$condicion;
            $resultado=$this->db->query($consulta);
            if ($resultado) {
                return true;
            }else {
                return false;
            }
        }
        public function eliminar($tabla, $condicion){
            $eli="delete from ".$tabla." where ".$condicion;
            $res=$this->db->query($eli);
            if ($res) {
                return true; 
            }else {
                return false;
            }
        }
    }
?>