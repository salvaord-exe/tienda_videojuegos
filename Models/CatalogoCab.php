<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/tienda_videojuegos/Database/dbConnection.php');

    class CatalogoCab{
        private $id;
        private $nombre_cabecera;
        private $descripcion;
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
            $this->table_name = "Cat_Catalogo_Cabecera";
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
            return $result;
            
        }

        public function create($request){
            $query = "insert into {$this->table_name} 
            (nombre_cabecera,descripcion,estado,fecha_creacion,fecha_modificacion,user_modificacion)
            values
            (
                '{$request->nombre_cabecera}',
                '{$request->descripcion}',
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
            nombre_cabecera = '{$request->nombre_cabecera}',
            descripcion = '{$request->descripcion}',
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



