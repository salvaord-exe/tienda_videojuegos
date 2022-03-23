<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/tienda_videojuegos/Models/Producto.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/tienda_videojuegos/Core/url.php');


class ProductoController
{

    function __construct()
    {
        $this->modelObject = new Producto();
    }

    function index()
    {
        $result = $this->modelObject->list();
        return $result;
    }

    function indexWithManufacturers(){
        $result = $this->modelObject->indexWithManufacturers();
        return $result;
    }

    function findById($request){
        $result = $this->modelObject->findById($request);
        return $result;
    }


    function findByIdWhitManufacturer($request){
        $result = $this->modelObject->findByIdWhitManufacturer($request);
        return $result;
    }

    function edit($request)
    {
        $idObject = $request['id'];
        $result = $this->modelObject->findById($idObject);
        return $result;
    }

    function create($request)
    {
        $lastInsertId = $this->modelObject->create($this->createVarObject($request));
        return $this->saveFile($request,$lastInsertId);
    }

    function saveFile($request,$id)
    {
        // Se crea o define el directorio del fichero
        $file_dir = $_SERVER['DOCUMENT_ROOT'] . '/tienda_videojuegos/Uploads/Producto/' . $id . '/';
        if(!is_dir($file_dir)){
            mkdir($file_dir);
        }

        // Se crea nombre del fichero
        $img_path = $request['files']['imagen_prod']['name'];
        $ext = pathinfo($img_path, PATHINFO_EXTENSION);
        $file_name = 'img_' . str_replace(" ","-",$request['request']['nombre'])  . '_id_' . $id . '.'.$ext;
        $file_save_at = $file_dir.$file_name;
        $file_bd_dir = "/Uploads/Producto/{$id}/{$file_name}";
        
        // Se guarda fichero
        $file = $request['files']['imagen_prod']['tmp_name'];
        move_uploaded_file($file, $file_save_at);
        return $this->modelObject->updateImageDir($file_bd_dir,$id);
    }

    function update($request)
    {
        $this->modelObject->update($this->createVarObject($request));
        return $this->saveFile($request,$request['request']['id']);
    }

    function delete($id)
    {
        return $this->modelObject->delete($id);
    }

    function show()
    {
        $lstFabricantes = $this->collectManufacturers();
        $arrReturn = array(
            "lstFabricantes" => $lstFabricantes
        );
        return $arrReturn;
    }

    function collectManufacturers(){
        return $this->modelObject->collectManufacturers();
    }

    function searchByText($request)
    {
        return $this->modelObject->findByText($request);
    }

    function createVarObject($data)
    {
        $varObject = new Producto();
        isset($data['request']['id']) ? $varObject->set("id", $data['request']['id']) : '';
        $varObject->set("nombre", $data['request']['nombre']);
        $varObject->set("descripcion", $data['request']['descripcion']);
        $varObject->set("id_fabricante", $data['request']['id_fabricante']);
        $varObject->set("precio", $data['request']['precio']);
        $varObject->set("calificacion", $data['request']['calificacion']);
        /*
            $file_dir = $_SERVER['DOCUMENT_ROOT'] .'/tienda_videojuegos/Uploads/Producto/';
            if(!is_dir($file_dir.)){

            }
            */
        return $varObject;
    }
}

?>