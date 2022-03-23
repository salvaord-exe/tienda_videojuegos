
<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/tienda_videojuegos/Models/Fabricante.php');
    

    class FabricanteController{

        function __construct()
        {
            $this->modelObject = new Fabricante();
        }

        function index(){
            $result = $this->modelObject->list();
            return $result;
        }

        function edit($request){
            $idObject = $request['id'];
            $result = $this->modelObject->findById($idObject);
            return $result;
        }

        function create($request){            
            return $this->modelObject->create($this->createVarObject($request));
        }

        function update($request){
            return $this->modelObject->update($this->createVarObject($request));
        }

        function delete($id){
            return $this->modelObject->delete($id);
        }

        function show(){
            $lstPaises = $this->modelObject->collectCountries();
            $arrReturn = array(
                "lstPaises" => $lstPaises
            );
            return $arrReturn;
        }

        function searchByText($request){
            return $this->modelObject->findByText($request);
        }

        function createVarObject($data){
            $varObject = new Fabricante();
            isset($data['id'])?$varObject->set("id",$data['id']):'';
            $varObject->set("id_pais",$data['id_pais']);
            $varObject->set("nombre_fabricante",$data['nombre_fabricante']);
            $varObject->set("nombre_contacto",$data['nombre_contacto']);
            $varObject->set("telefono1",$data['telefono1']);
            $varObject->set("telefono2",$data['telefono2']);
            $varObject->set("correo_fabricante",$data['correo_fabricante']);
            $varObject->set("fecha_inicio_contrato",$data['fecha_inicio_contrato']);
            $varObject->set("fecha_renovacion_contrato",$data['fecha_renovacion_contrato']);
            $varObject->set("fecha_fin_contrato",$data['fecha_fin_contrato']);
            return $varObject;
        }
    }

?>