<?php 
    require_once __DIR__ . "../../../models/contatos/ModelContatos.php";

    class ControllerContatos {
        
        public static function resgatarDadosContatos($chaveBusca)                  : array {
            return ModelContatos::resgatarDadosContatos($chaveBusca);
        }

        public static function executarQuerySql($querySql)                         : array {
            return ModelContatos::executarQuerySql($querySql);
        }

        public static function resgatarQuantidadeContatos()                        : int {
            return ModelContatos::resgatarQuantidadeContatos();
        }

        public static function atualizarInformacoesContatos($matrizDeValores, $id) : void {
            ModelContatos::atualizarInformacoesContatos($matrizDeValores, $id);
        }

        public static function excluirContato($id)                                 : void {
            ModelContatos::excluirContato($id);
        }

        public static function cadastrarContato($matrizDeValores, $tipoValores)    : void {
            ModelContatos::cadastrarContato($matrizDeValores, $tipoValores);
        }

        public static function getLimiteContatosPagina()                           : int {
            return ModelContatos::getLimiteContatosPagina();
        }

        public static function getPaginaAtual()                                    : int {
            return ModelContatos::getPaginaAtual();

        }

        public static function getQuantidadePaginas()                              : int {
            return ModelContatos::getQuantidadePaginas();
        }

        public static function cadastrarNomeImagemContato($nomeImagem, $id)        : void {
            ModelContatos::cadastrarNomeImagemContato($nomeImagem, $id);
        }

        public static function favoritarContato($id, $flagFavorito)                : void {
            ModelContatos::favoritarContato($id, $flagFavorito);
        }
    }