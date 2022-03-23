
<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/tienda_videojuegos/Models/CatalogoDet.php');
    

    class CatalogoDetController{

        function __construct()
        {
            $this->modelObject = new CatalogoDet();
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

        function show($id){
            
        }

        function searchByText($request){
            return $this->modelObject->findByText($request);
        }

        function searchCabById($cabId){
            return $this->modelObject->searchCabById($cabId);
        }

        function collectByCabId($cabId){
            return $this->modelObject->collectByCabId($cabId);
        }

        function collectPaises(){
            return $this->modelObject->collectPaises();
        }

        function collectCiudades(){
            return $this->modelObject->collectCiudades();
        }

        function collectProvincias(){
            return $this->modelObject->collectProvincias();
        }

        function collectSexos(){
            return $this->modelObject->collectSexos();
        }

        function createVarObject($data){
            $varObject = new CatalogoDet();
            isset($data['id'])?$varObject->set("id",$data['id']):'';
            $varObject->set("nombre_cat_detalle",$data['nombre_cat_detalle']);
            $varObject->set("descripcion",$data['descripcion']);
            $varObject->set("id_cabecera",$data['idCab']);
            return $varObject;
        }

    }

?>