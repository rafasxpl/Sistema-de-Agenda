<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/models/contatos/ModelContatos.php";

    class ControllerContatos {
        
        public static function resgatarDadosContatos($chaveBusca) {
            return ModelContatos::resgatarDadosContatos($chaveBusca);
        }

        public static function executarQuerySql($querySql) : array | string {
            return ModelContatos::executarQuerySql($querySql);
        }

        public static function atualizarInformacoesContatos($matrizDeValores = null, $id = null) {
            return ModelContatos::atualizarInformacoesContatos($matrizDeValores, $id);
        }

        public static function excluirContato($id) {
            return ModelContatos::excluirContato($id);
        }

        public static function cadastrarContato($matrizDeValores, $tipoValores = null) {
            return ModelContatos::cadastrarContato($matrizDeValores, $tipoValores);
        }
    }


