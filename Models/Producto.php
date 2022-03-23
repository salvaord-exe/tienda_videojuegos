<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/tienda_videojuegos/Database/dbConnection.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/tienda_videojuegos/Models/Fabricante.php');

class Producto
{
    private $id;
    private $nombre;
    private $descripcion;
    private $id_fabricante;
    private $precio;
    private $dir_imagen;
    private $calificacion;
    private $estado;
    private $fecha_creacion;
    private $fecha_modificacion;
    private $user_modificacion;
    private $bd_connection;
    private $table_name;

    public function get($attr)
    {
        return $this->$attr;
    }

    public function set($attr, $value)
    {
        $this->$attr = $value;
    }

    public function __construct()
    {
        $this->bd_connection = new DBConnection();
        $this->table_name = "Neg_Producto";
    }

    public function list()
    {
        $query = "select * from {$this->table_name} where estado like 'A';";
        $result = $this->get("bd_connection")->consultaRetorno($query);

        return $result;
    }

    public function findById($id)
    {
        $query = "select * from {$this->table_name} where id like '{$id}';";
        $result = $this->get("bd_connection")->consultaRetorno($query);
        $objectReturn = $result[0];
        return $objectReturn;
    }

    public function findByIdWhitManufacturer($id){
        $query = "select * from view_producto_fabricante where id like '{$id}';";
        $result = $this->get("bd_connection")->consultaRetorno($query);
        $objectReturn = $result[0];
        return $objectReturn;
    }

    public function indexWithManufacturers(){
        $query = "select * from view_producto_fabricante;";
        $result = $this->get("bd_connection")->consultaRetorno($query);

        return $result;
    }

    public function create($request)
    {

        $now = $this->getCurrentTimestamp();

        $query = "insert into {$this->table_name} 
            (nombre,descripcion,id_fabricante,precio,dir_imagen,calificacion,estado,fecha_creacion,fecha_modificacion,user_modificacion)
            values
            (
                '{$request->nombre}',
                '{$request->descripcion}',
                '{$request->id_fabricante}',
                '{$request->precio}',
                '{$request->dir_imagen}',
                '{$request->calificacion}',
                'A',
                '{$now}',
                '{$now}',
                '1'
                
            )
            ;";
        $this->get("bd_connection")->consultaRetorno($query);
        $result = $this->get("bd_connection")->getLastInsertId();

        return $result;
    }

    public function collectManufacturers()
    {
        $varFabricante = new Fabricante();
        $lstFabricantes = $varFabricante->list();
        return $lstFabricantes;
    }

    public function update($request)
    {
        $query = "
            update {$this->table_name} 
            set
            
            nombre = '{$request->nombre}',
            descripcion = '{$request->descripcion}',
            id_fabricante = '{$request->id_fabricante}',
            precio = '{$request->precio}',
            dir_imagen = '{$request->dir_imagen}',
            calificacion = '{$request->calificacion}',
            fecha_modificacion = '{$this->getCurrentTimestamp()}',
            user_modificacion = '1'

            where id like {$request->id};";
        $result = $this->get("bd_connection")->consultaRetorno($query);

        return $result;
    }

    public function delete($id)
    {
        $query = "update {$this->table_name} set estado = 'I' where id like '{$id}'";
        return $this->get("bd_connection")->consultaRetorno($query);
    }

    public function findByText($request)
    {
        if ($request == "") {
            $texToFind = "recibio vacio";
        } else {
            $texToFind = "%" . str_replace(" ", "%", $request) . "%";
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

    public function updateImageDir($imgDir, $id)
    {
        $query = "
            update {$this->table_name} 
            set
            dir_imagen = '{$imgDir}'
            where id like {$id};";
        $result = $this->get("bd_connection")->consultaRetorno($query);

        return $result;
    }

    public function getCurrentTimestamp()
    {
        $now = date('Y-m-d H:i:s', time());
        return $now;
    }
}
