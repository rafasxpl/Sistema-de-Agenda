<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/models/auth/ModelAuth.php";

    class ControllerAuth {
        public static function criarUsuario($nomeUsuario, $senhaUsuario) : bool {
            return ModelAuth::criarUsuario($nomeUsuario, $senhaUsuario);
        }

        public static function checarExistenciaUsuario($nomeUsuario, $senhaUsuario) : bool {
            return ModelAuth::checarExistenciaUsuario($nomeUsuario, $senhaUsuario);
        }
    }