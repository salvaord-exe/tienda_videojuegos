
<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/tienda_videojuegos/Models/Empleado.php');
    

    class EmpleadoController{
        private $modelObject;

        function __construct()
        {
            $this->modelObject = new Empleado();
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

        function collectPerfiles(){
            $result = $this->modelObject->collectPerfiles();
            return $result;
        }

        function create($request){            
            return $this->modelObject->create($request);
        }

        function update($request){
            return $this->modelObject->update($request);
        }

        function delete($id){
            return $this->modelObject->delete($id);
        }

        function show($id){
            
        }

        function searchByText($request){
            return $this->modelObject->findByText($request);
        }
        /*
        function createVarObject($data){
            $varEmpleado = new Empleado();
            isset($data['id'])?$varEmpleado->set("id",$data['id']):'';
            $varEmpleado->set("nombre_completo",$data['nombre_completo']);
            $varEmpleado->set("direccion",$data['direccion']);
            $varEmpleado->set("email",$data['email']);
            $varEmpleado->set("sueldo",$data['sueldo']);
            $varEmpleado->set("cargo",$data['cargo']);
            return $varEmpleado;
        }
        */
    }

?>