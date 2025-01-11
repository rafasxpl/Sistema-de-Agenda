<?php 
    require_once __DIR__ . "../../../models/auth/ModelAuth.php";

    class ControllerAuth {
        public static function criarUsuario($nomeUsuario, $senhaUsuario) : bool {
            return ModelAuth::criarUsuario($nomeUsuario, $senhaUsuario);
        }

        public static function checarExistenciaUsuario($nomeUsuario, $senhaUsuario) : bool {
            return ModelAuth::checarExistenciaUsuario($nomeUsuario, $senhaUsuario);
        }
    }