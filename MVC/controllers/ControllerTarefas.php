<?php 
    require_once "MVC/models/tarefas/ModelTarefas.php";

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
    }