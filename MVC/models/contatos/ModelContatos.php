<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/models/Connection.php";
    
    class ModelContatos {
        private static string $nomeTabela = "contatos";

        public static function resgatarDadosContatos($chaveBusca) : array {
            $pdo = Connection::conectar();
            if(!$chaveBusca) {
                $stmt = $pdo->prepare("SELECT * FROM contatos");
                $stmt->execute();
    
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } 

            $sqlLike = "SELECT * FROM contatos WHERE nomeContato LIKE :chaveBusca";

            $stmt = $pdo->prepare($sqlLike);
            // $stmt->bindParam(':chaveBusca', $chaveBusca);
            $stmt->bindValue(':chaveBusca', "%{$chaveBusca}%");
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function executarQuerySql($querySql) : array {
            return Connection::executarQuerySql($querySql);
        }

        public static function atualizarInformacoesContatos($matrizDeValores, $id) {
            $pdo = Connection::conectar();

            if(!$matrizDeValores || !$id) {
                die("Nome da tabela, a matriz de valores e o ID devem ser fornecidos!");
            }

            $sqlUpdate = "UPDATE contatos SET ";
            $colunaValor = "";

            foreach ($matrizDeValores as $chave => $valor) {
                $colunaValor .= $chave . " = ". "'". $valor ."'" . ",";
            }

            $colunaValor = trim($colunaValor, ",");
            $sqlUpdate .= $colunaValor . " WHERE idContato = :id";
            $stmt = $pdo->prepare($sqlUpdate);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();
        }

        public static function excluirContato($id) {
            $pdo = Connection::conectar();
            $sqlDelete = "DELETE FROM contatos WHERE idContato = :id";
        
            $stmt = $pdo->prepare($sqlDelete);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $sqlDelete;
        }

        public static function cadastrarContato($matrizDeValores, $tipoValores = null) {
            if(!$matrizDeValores) {
                die("Nome da tabela e a matriz de valores devem ser fornecidos!");
            }

            $pdo = Connection::conectar();

            $sqlInsert     = "INSERT INTO";
            $nomeCampos    = null;
            $valoresCampos = null;

            foreach ($matrizDeValores as $chave => $valor) {
                $valoresCampos .=   ":". $chave . ",";
                $nomeCampos    .=  $chave . ",";     
            }
            
            $nomeCampos    = trim($nomeCampos, ",");
            $valoresCampos = trim($valoresCampos, ",");
            
            $stmt = $pdo->prepare(($sqlInsert . " " . self::$nomeTabela . " (". $nomeCampos .")" . " VALUES " . "(" . $valoresCampos . ")"));

            if ($tipoValores) {
                foreach ($matrizDeValores as $chaveValor => $valor) {
                    $stmt->bindValue(":$chaveValor" ?? "", $valor, $tipoValores[$chaveValor] ?? PDO::PARAM_STR);
                }
            } else {
                foreach ($matrizDeValores as $chaveValor => $valor) {
                    $stmt->bindValue(":$chaveValor" ?? "", $valor);
                }
            }

            try {
                $stmt->execute();
            } catch(PDOException $e) {
                die("Erro ao cadastrar dados: ". $e->getMessage());
            }
        }
    }