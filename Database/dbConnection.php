<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/tienda_videojuegos/Core/config.php');

    class DBConnection{

        private $connection;
        private $host;
        private $bd;
        private $user;
        private $password;



        public function __construct(){
            $this->host = "localhost";
            $this->bd = "neg_tienda_videojuegos";
            $this->user = "root";
            $this->password = "Aa987123654";
            $dsn = "mysql:host={$this->host};dbname={$this->bd};charset=UTF8";

            $this->connection = new PDO($dsn,$this->user,$this->password);



        }

        public function consultaSimple($query){
            $db_exec = $this->connection->prepare($query);
            $this->connection->exec($db_exec);
        }

        public function consultaRetorno($query){
            $db_exec = $this->connection->prepare($query);
            $result = $db_exec->execute();
            $result = $db_exec->fetchAll();
            return $result;
        }

        public function getLastInsertId(){
            return $this->connection->lastInsertId();
        }
    }    

?>