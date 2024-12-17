<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/models/Connection.php";
    
    class ControllerContatos {

        public function getData() : array {
            $conexao = new Connection();
            return $conexao->fetchContatos();
        }

        public function cadastrarContato($nome, $email, $sexo, $telefone, $dataNascimento) {
            $conexao = new Connection();
            
        }
    }