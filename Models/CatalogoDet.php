<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/tienda_videojuegos/Database/dbConnection.php');
require_once("CatalogoCab.php");

    class CatalogoDet{
        private $id;
        private $nombre_cat_detalle;
        private $descripcion;
        private $id_cabecera;
        private $id_padre;
        private $id_padre_cab;
        private $estado;
        private $fecha_creacion;
        private $fecha_modificacion;
        private $user_modificacion;
        private $bd_connection;
        private $table_name;

        public function get($attr){
            return $this->$attr;
        }

        public function set($attr, $value){
            $this->$attr = $value;
        }

        public function __construct(){
            $this->bd_connection = new DBConnection();
            $this->table_name = "Cat_Catalogo_Detalle";
        }

        public function list(){
            $query = "select * from {$this->table_name} where estado like 'A';";
            $result = $this->get("bd_connection")->consultaRetorno($query);

            return $result;

        }

        public function findById($id){
            $query = "select * from {$this->table_name} where id like '{$id}';";
            $result = $this->get("bd_connection")->consultaRetorno($query);
            $objectReturn = $result[0];
            return $objectReturn;
            
        }

        public function findByColumnValue($column,$value){
            $query = "select * from {$this->table_name} where {$column} like '%{$value}%';";
            $result = $this->get("bd_connection")->consultaRetorno($query);
            $objectReturn = $result[0];
            return $objectReturn;
            
        }

        public function collectByCabId($cabId){
            $query = "select * from {$this->table_name} where id_cabecera like '{$cabId}' and estado like 'A';";
            $result = $this->get("bd_connection")->consultaRetorno($query);
            return $result;
        }

        public function searchCabById($idCab){
            $varCab = new CatalogoCab();
            $result = $varCab->findById($idCab);
            return $result;
        }

        function collectPaises(){
            $query = "select * from {$this->table_name} where id_cabecera like 1 and estado like 'A'";
            $result = $this->get("bd_connection")->consultaRetorno($query);
            return $result;
        }

        function collectCiudades(){
            $query = "select * from {$this->table_name} where id_cabecera like 3 and estado like 'A'";
            $result = $this->get("bd_connection")->consultaRetorno($query);
            return $result;
        }

        function collectProvincias(){
            $query = "select * from {$this->table_name} where id_cabecera like 2 and estado like 'A'";
            $result = $this->get("bd_connection")->consultaRetorno($query);
            return $result;
        }

        function collectSexos(){
            $query = "select * from {$this->table_name} where id_cabecera like 4 and estado like 'A'";
            $result = $this->get("bd_connection")->consultaRetorno($query);
            return $result;
        }

        public function create($request){
            
            $query = "insert into {$this->table_name} 
            (nombre_cat_detalle,descripcion,id_cabecera,estado,fecha_creacion,fecha_modificacion,user_modificacion)
            values
            (
                '{$request->nombre_cat_detalle}',
                '{$request->descripcion}',
                '{$request->id_cabecera}',
                'A',
                '{$this->getNow()}',
                '{$this->getNow()}',
                '1'
            )
            ;";
            $result = $this->get("bd_connection")->consultaRetorno($query);
        
            return $result;
        }

        public function update($request){
            $query = "
            update {$this->table_name} 
            set
            
            nombre_cat_detalle = '{$request->nombre_cat_detalle}',
            descripcion = '{$request->descripcion}',
            id_cabecera = '{$request->id_cabecera}',
            fecha_modificacion = '{$this->getNow()}',
            user_modificacion = '1'
            where id like {$request->id};"
            ;
            $result = $this->get("bd_connection")->consultaRetorno($query);

            return $result;
        }

        public function delete($id){
            $query = "update {$this->table_name} set estado = 'I' where id like '{$id}'";
            return $this->get("bd_connection")->consultaRetorno($query);
        }

        public function findByText($request){
            if($request==""){
                $texToFind="recibio vacio";
            }else{
                $texToFind = "%".str_replace(" ","%",$request)."%";
            }

            $query = "
                select * from {$this->table_name} where 
                nombre_cabecera_completo like '{$texToFind}' or
                direccion like '{$texToFind}' or
                email like '{$texToFind}' or
                sueldo like '{$texToFind}' or
                cargo like '{$texToFind}'
            ";

            $result = $this->get("bd_connection")->consultaRetorno($query);

            return $result;
        }
       
        public function getNow(){
            $now = date('Y-m-d H:i:s', time());
            return $now;
        }

}



