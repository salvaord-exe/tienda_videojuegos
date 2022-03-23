<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/tienda_videojuegos/Database/dbConnection.php');

    class Perfil{
        private $id;
        private $nombre_perfil;
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
            $this->table_name = "seg_perfil";
        }

        public function list(){
            $query = "select * from {$this->table_name};";
            $result = $this->bd_connection->consultaRetorno($query);

            return $result;

        }

        public function findById($id){
            $query = "select * from {$this->table_name} where id like '{$id}';";
            $result = $this->bd_connection->consultaRetorno($query);
            //$producto = mysqli_fetch_array($result,MYSQLI_ASSOC);

            return $result;
            
        }

        public function create($request){
    
            $query = "insert into empleado 
            (nombre_completo,direccion,email,sueldo,cargo)
            values
            (
                '{$request->nombre_completo}',
                '{$request->direccion}',
                '{$request->email}',
                '{$request->sueldo}',
                '{$request->cargo}'
                
            )
            ;";
            $result = $this->bd_connection->consultaRetorno($query);

            return $query;
        }

        public function update($request){
            $query = "
            update empleado 
            set
            
            nombre_completo = '{$request->nombre_completo}',
            direccion = '{$request->direccion}',
            email = '{$request->email}',
            sueldo = '{$request->sueldo}',
            cargo = '{$request->cargo}'
            
            where id_empleado like {$request->id};"
            ;
            $result = $this->bd_connection->consultaRetorno($query);

            return $result;
        }

        public function delete($id){
            $query = "delete from empleado where id_empleado like '{$id}'";
            return $this->bd_connection->consultaSimple($query);
        }

        public function findByText($request){
            if($request==""){
                $texToFind="recibio vacio";
            }else{
                $texToFind = "%".str_replace(" ","%",$request)."%";
            }

            $query = "
                select * from empleado where 
                nombre_completo like '{$texToFind}' or
                direccion like '{$texToFind}' or
                email like '{$texToFind}' or
                sueldo like '{$texToFind}' or
                cargo like '{$texToFind}'
            ";

            $result = $this->bd_connection->consultaRetorno($query);

            return $result;
        }

    }

?>