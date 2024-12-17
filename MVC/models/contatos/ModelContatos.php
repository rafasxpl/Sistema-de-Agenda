<?php 
    require_once "../Connection.php";
    
    class ModelContatos {

        public static function resgatarDadosContatos() : array {
            $conexao = new Connection();
            return Connection::resgatarDados("contatos");
        }
    }

    ModelContatos::resgatarDadosContatos();