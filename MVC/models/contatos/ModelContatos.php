<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/models/Connection.php";
    
    class ModelContatos {

        public static function resgatarDadosContatos() : array {
            return Connection::resgatarDadosTabela("contatos");
        }

        public static function executarQuerySql($querySql) : array {
            return Connection::executarQuerySql($querySql);
        }

        public static function atualizarInformacoesContatos($nomeTabela, $matrizDeValores, $id) {
            return Connection::atualizarInformacaoTabela($nomeTabela, $matrizDeValores, $id);
        }

        public static function excluirContato($nomeTabela, $id) {
            return Connection::excluirInformacaoTabela($nomeTabela, $id);
        }

        public static function cadastrarInformacoesContatos($nomeTabela, $matrizDeValores, $tipoValores = null) {
            return Connection::cadastrarInformacaoTabela($nomeTabela, $matrizDeValores, $tipoValores);
        }
    }