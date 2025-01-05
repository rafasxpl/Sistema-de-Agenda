<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/models/tarefas/ModelTarefas.php";
   
    class ControllerTarefas {
        
        public static function resgatarDadosTarefas($chaveBusca)                  : array {
            return ModelTarefas::resgatarDadosTarefas($chaveBusca);
        }

        public static function resgatarQuantidadeTarefas()                        : int {
            return ModelTarefas::resgatarQuantidadeTarefas();
        }

        public static function getLimiteTarefasPagina()                           : int {
            return ModelTarefas::getLimiteTarefasPagina();
        }

        public static function getPaginaAtual()                                    : int {
            return ModelTarefas::getPaginaAtual();
        }

        public static function getQuantidadePaginas()                              : int {
            return ModelTarefas::getQuantidadePaginas();
        }

        public static function concluirTarefa($status, $id)                         :void {
            ModelTarefas::concluirTarefa($status, $id);
        }

        public static function atualizarInformacoesTarefa($matrizDeValores, $id)    :void {
            ModelTarefas::atualizarInformacoesTarefa($matrizDeValores, $id);
        }

        public static function excluirTarefa($id)                                   :void {
            ModelTarefas::excluirTarefa($id);
        }
    }