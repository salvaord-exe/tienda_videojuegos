
<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/tienda_videojuegos/Models/CatalogoCab.php');
    

    class CatalogoCabController{

        function __construct()
        {
            $this->modelObject = new CatalogoCab();
        }

        function index(){
            $result = $this->modelObject->list();
            return $result;
        }

        function edit($request){
            $idObject = $request['idCatCab'];
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

        function show($id){
            
        }

        function searchByText($request){
            return $this->modelObject->findByText($request);
        }

        function createVarObject($data){
            $varEmpleado = new CatalogoCab();
            isset($data['id'])?$varEmpleado->set("id",$data['id']):'';
            $varEmpleado->set("nombre_cabecera",$data['nombre_cabecera']);
            $varEmpleado->set("descripcion",$data['descripcion']);
            return $varEmpleado;
        }

    }

?>