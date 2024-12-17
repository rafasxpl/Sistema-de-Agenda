<?php 
    require_once "MVC/models/Connection.php";
    
    class ModelContatos {

        public static function resgatarDadosContatos() : array {
            return Connection::resgatarDadosTabela("contatos");
        }

        public static function cadastrarInformacoesContatos($nomeTabela, $matrizDeValores) {
            return Connection::cadastrarInformacaoTabela($nomeTabela, $matrizDeValores);
        }
    }