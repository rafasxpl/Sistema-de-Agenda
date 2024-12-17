<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/models/contatos/ModelContatos.php";
    
    class ControllerContatos {

        public function resgatarDadosContatos() : array {
            return ModelContatos::resgatarDadosContatos();
        }

        public function cadastrarContato($nomeTabela, $matrizDeValores) {
            return ModelContatos::cadastrarInformacoesContatos($nomeTabela, $matrizDeValores);
        }
    }