<?php 
    require_once __DIR__ . "../../../models/tarefas/ModelTarefas.php";
   
    class ControllerTarefas {
        
        public static function resgatarDadosTarefas($chaveBusca, $filtrarTarefasConcluidas) : array {
            return ModelTarefas::resgatarDadosTarefas($chaveBusca, $filtrarTarefasConcluidas);
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

        public static function criarTarefa($dadosTarefa) {
            ModelTarefas::criarTarefa($dadosTarefa);
        }
    }