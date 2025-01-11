<?php 
    require_once __DIR__ . "../../../models/Connection.php";

    class ModelAuth {
        private static string $nomeTabela = "usuarios";

        public static function resgatarDadosUsuario($nomeUsuario) : array {
            if(empty($nomeUsuario)) {
                throw new Exception("Nome de usuário deve ser informado");
            }

            $pdo = Connection::conectar();

            $sqlSelectFrom = "SELECT * FROM " . self::$nomeTabela . " WHERE nome = :nomeUsuario";
            $stmt = $pdo->prepare($sqlSelectFrom);
            $stmt->bindParam(":nomeUsuario", $nomeUsuario, PDO::PARAM_STR);

            try {
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                throw new RuntimeException("Erro ao resgatar dados do usuário: " . $e->getMessage());
            }
        }

        public static function checarExistenciaUsuario($nomeUsuario, $senhaUsuario) : bool {
            if(empty($nomeUsuario) || empty($senhaUsuario)) {
                throw new Exception("Nome e senha devem ser informados");
            }

            $informacoesUsuario = self::resgatarDadosUsuario($nomeUsuario);

            if(!empty($informacoesUsuario)) {
                foreach ($informacoesUsuario as $usuario) {
                    if(password_verify($senhaUsuario, $usuario['senha'])) {
                        return true;
                    }
                }
            }

            return false;
        }

        public static function criarUsuario($nomeUsuario, $senhaUsuario) : bool {
            if(empty($nomeUsuario) || empty($senhaUsuario)) {
                throw new Exception("Nome e senha devem ser informados");
            }

            if(self::checarExistenciaUsuario($nomeUsuario, $senhaUsuario)) {
                return false;
            }

            $pdo = Connection::conectar();

            $sqlCadastrarUsuario = "INSERT INTO " . self::$nomeTabela . " (nome, senha) VALUES (:nome, :senha)";
            $stmt = $pdo->prepare($sqlCadastrarUsuario);
            $stmt->bindParam(':nome', $nomeUsuario, PDO::PARAM_STR);
            $hashSenha = password_hash($senhaUsuario, PASSWORD_DEFAULT);
            $stmt->bindParam(':senha', $hashSenha, PDO::PARAM_STR);

            try {
                $stmt->execute();
                return true;
            } catch(PDOException $e) {
                throw new RuntimeException("Erro ao cadastrar usuário: " . $e->getMessage());
            }
        }
    }