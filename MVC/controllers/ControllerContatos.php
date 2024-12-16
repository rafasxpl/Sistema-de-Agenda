<?php 
    require_once "MVC/models/Connection.php";
    
    class ControllerContatos {
        public function getData() : array {
            $conexao = new Connection();
            return $conexao->fetchContatos();
        }
    }