<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/tienda_videojuegos/Database/dbConnection.php');

    class Empleado{
        private $id;
        private $primer_nombre;
        private $segundo_nombre;
        private $primer_apellido;
        private $segundo_apellido;
        private $fecha_nacimiento;
        private $sexo;
        private $celular1;
        private $celular2;
        private $id_pais;
        private $id_provincia;
        private $id_ciudad;
        private $direccion;
        private $dir_curriculum;
        private $dir_copia_cedula;
        private $id_usuario;
        private $estado;
        private $fecha_creacion;
        private $fecha_modificacion;
        private $user_modificacion;
        private $id_usuario_orig;
        private $correo_usuario;
        private $contrasenia;
        private $id_perfil;
        private $url_img_perfil;
        private $estado_user;
        private $fecha_creacion_user;
        private $fecha_modificacion_user;
        private $user_modificacion_user;

        private $bd_connection;
        private $table_empleado;
        private $view_empleado;
        private $table_usuario;

        public function get($attr){
            return $this->$attr;
        }

        public function set($attr, $value){
            $this->$attr = $value;
        }

        public function __construct(){
            $this->bd_connection = new DBConnection();
            $this->table_empleado = "seg_personal";
            $this->view_empleado = "view_personal";
        }

        public function list(){
            $query = "select * from {$this->view_empleado};";
            $result = $this->get("bd_connection")->consultaRetorno($query);

            return $result;

        }

        public function findById($id){
            $query = "select * from {$this->view_empleado} where id like '{$id}';";
            $result = $this->get("bd_connection")->consultaRetorno($query);
            $objectReturn = $result[0];
            return $objectReturn;
            
        }

        public function create($request){
    
            $queryVal = "select count(*) from seg_usuario where correo_usuario like '".$request['correo_usuario']."';";

            if($queryVal>0){
                return false;
            }

            $query1 = "insert into seg_usuario (correo_usuario,contrasenia,id_perfil,estado)
            values (
                '".$request['correo_usuario']."',
                '".$request['contrasenia']."',
                '".$request['id_perfil']."',
                'A'
            );";
            $result = $this->get("bd_connection")->consultaRetorno($query1);
            $id_user = $this->get("bd_connection")->getLastInsertId();

            $query2 = "insert into {$this->table_empleado} 
            (primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,
            fecha_nacimiento,sexo,celular1,celular2,id_pais,id_provincia,id_ciudad,
            direccion,id_usuario,estado)
            values
            (
                '".$request['primer_nombre']."',
                '".$request['segundo_nombre']."',
                '".$request['primer_apellido']."',
                '".$request['segundo_apellido']."',
                '".$request['fecha_nacimiento']."',
                '".$request['id_sexo']."',
                '".$request['celular1']."',
                '".$request['celular2']."',
                '".$request['id_pais']."',
                '".$request['id_provincia']."',
                '".$request['id_ciudad']."',
                '".$request['direccion']."',
                '".$id_user."',
                'A'
                
            )
            ;";
            $result = $this->get("bd_connection")->consultaRetorno($query2);

            return true;
        }

        public function update($request){
            $query1 = '
            update '.$this->table_empleado.' 
            set
                        
            primer_nombre = '."'".$request['primer_nombre']."'".', 
            segundo_nombre = '."'".$request['segundo_nombre']."'".', 
            primer_apellido = '."'".$request['primer_apellido']."'".', 
            segundo_apellido = '."'".$request['segundo_apellido']."'".', 
            fecha_nacimiento = '."'".$request['fecha_nacimiento']."'".', 
            sexo = '."'".$request['id_sexo']."'".', 
            celular1 = '."'".$request['celular1']."'".', 
            celular2 = '."'".$request['celular2']."'".', 
            id_pais = '."'".$request['id_pais']."'".', 
            id_provincia = '."'".$request['id_provincia']."'".', 
            id_ciudad = '."'".$request['id_ciudad']."'".', 
            direccion = '."'".$request['direccion']."'".'
            

            where id like '.$request['id'].'
            ;';
            $result = $this->get("bd_connection")->consultaRetorno($query1);

            $query2 = '
            update seg_usuario set

            correo_usuario = '."'".$request['correo_usuario']."'".', 
            contrasenia = '."'".$request['contrasenia']."'".', 
            id_perfil = '."'".$request['id_perfil']."'".'

            where id like '.$request['id'].';';

            $result = $this->get("bd_connection")->consultaRetorno($query2);

            return $query2;
        }

        public function delete($id){
            $query = "delete from {$this->table_empleado} where id_empleado like '{$id}'";
            return $this->get("bd_connection")->consultaRetorno($query);
        }

        public function findByText($request){
            if($request==""){
                $texToFind="recibio vacio";
            }else{
                $texToFind = "%".str_replace(" ","%",$request)."%";
            }

            $query = "
                select * from {$this->table_empleado} where 
                nombre_completo like '{$texToFind}' or
                direccion like '{$texToFind}' or
                email like '{$texToFind}' or
                sueldo like '{$texToFind}' or
                cargo like '{$texToFind}'
            ";

            $result = $this->get("bd_connection")->consultaRetorno($query);

            return $result;
        }

        public function collectPerfiles(){
            $query = "select * from seg_perfil;";
            $result = $this->get("bd_connection")->consultaRetorno($query);
            return $result;
        }


}



