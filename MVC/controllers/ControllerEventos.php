<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/models/eventos/ModelEventos.php";
   
    class ControllerEventos {
        
        public static function resgatarDadosEventos($chaveBusca, $filtrarEventosConcluidas) : array {
            return ModelEventos::resgatarDadosEventos($chaveBusca, $filtrarEventosConcluidas);
        }

        public static function resgatarQuantidadeEventos()                        : int {
            return ModelEventos::resgatarQuantidadeEventos();
        }

        public static function getLimiteEventosPagina()                           : int {
            return ModelEventos::getLimiteEventosPagina();
        }

        public static function getPaginaAtual()                                    : int {
            return ModelEventos::getPaginaAtual();
        }

        public static function getQuantidadePaginas()                              : int {
            return ModelEventos::getQuantidadePaginas();
        }

        public static function concluirEvento($status, $id)                         :void {
            ModelEventos::concluirEvento($status, $id);
        }

        public static function atualizarInformacoesEvento($matrizDeValores, $id)    :void {
            ModelEventos::atualizarInformacoesEvento($matrizDeValores, $id);
        }

        public static function excluirEvento($id)                                   :void {
            ModelEventos::excluirEvento($id);
        }

        public static function criarEvento($dadosEvento) {
            ModelEventos::criarEvento($dadosEvento);
        }
    }