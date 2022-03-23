<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/tienda_videojuegos/Database/dbConnection.php');
require_once("CatalogoDet.php");
    class Fabricante{
        private $id;
        private $id_pais;
        private $nombre_fabricante;
        private $nombre_contacto;
        private $telefono1;
        private $telefono2;
        private $correo_fabricante;
        private $fecha_inicio_contrato;
        private $fecha_renovacion_contrato;
        private $fecha_fin_contrato;
        private $dir_logo;
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
            $this->table_name = "neg_fabricante";
        }

        public function list(){
            $query = "select * from {$this->table_name};";
            $result = $this->get("bd_connection")->consultaRetorno($query);

            return $result;

        }

        public function findById($id){
            $query = "select * from {$this->table_name} where id like '{$id}';";
            $result = $this->get("bd_connection")->consultaRetorno($query);
            $objectReturn = $result[0];
            return $objectReturn;
            
        }

        public function create($request){
    
            $query = "insert into {$this->table_name} 
            (id_pais,nombre_fabricante,nombre_contacto,telefono1,telefono2,correo_fabricante,fecha_inicio_contrato,fecha_renovacion_contrato,fecha_fin_contrato,estado,fecha_creacion,fecha_modificacion,user_modificacion)
            values
            (
                '{$request->id_pais}',
                '{$request->nombre_fabricante}',
                '{$request->nombre_contacto}',
                '{$request->telefono1}',
                '{$request->telefono2}',
                '{$request->correo_fabricante}',
                '{$request->fecha_inicio_contrato}',
                '{$request->fecha_renovacion_contrato}',
                '{$request->fecha_fin_contrato}',
                'A',
                '{$this->getCurrentTimestamp()}',
                '{$this->getCurrentTimestamp()}',
                '1'
            )
            ;";
            $result = $this->get("bd_connection")->consultaRetorno($query);

            return $query;
        }

        public function collectCountries(){
            $varCatCab = new CatalogoCab();
            $oCatCab = $varCatCab->findByColumnValue("nombre_cabecera","Paises");
            $varCatPaises = new CatalogoDet();
            return $varCatPaises->collectByCabId($oCatCab[0]['id']);
        }

        public function update($request){
            $query = "
            update {$this->table_name} 
            set
            
            id_pais = '{$request->id_pais}',
            nombre_fabricante = '{$request->nombre_fabricante}',
            nombre_contacto = '{$request->nombre_contacto}',
            telefono1 = '{$request->telefono1}',
            telefono2 = '{$request->telefono2}',
            correo_fabricante = '{$request->correo_fabricante}',
            fecha_inicio_contrato = '{$request->fecha_inicio_contrato}',
            fecha_renovacion_contrato = '{$request->fecha_renovacion_contrato}',
            fecha_fin_contrato = '{$request->fecha_fin_contrato}',
            fecha_modificacion = '{$this->getCurrentTimestamp()}',
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
                nombre_completo like '{$texToFind}' or
                direccion like '{$texToFind}' or
                email like '{$texToFind}' or
                sueldo like '{$texToFind}' or
                cargo like '{$texToFind}'
            ";

            $result = $this->get("bd_connection")->consultaRetorno($query);

            return $result;
        }

        public function getCurrentTimestamp(){
            $now = date('Y-m-d H:i:s', time());
            return $now;
        }
}



