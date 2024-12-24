<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/models/Connection.php";
    
    class ModelContatos {
        private static string $nomeTabela        = "contatos";
        private static int $limiteContatosPagina = 10;
        private static int $quantidadePaginas    = 0;
        private static int $paginaInicial        = 0;
        private static int $paginaAtual         = 0;

        // public static function get

        public static function resgatarQuantidadeContatos() {
            $pdo = Connection::conectar();
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM contatos");
            $stmt->execute();

            return $stmt->fetchColumn();
        }

        public static function resgatarDadosContatos($chaveBusca) {
            $pdo = Connection::conectar();

            
            if(empty($chaveBusca)) {
                if (!isset($_GET['idPagina']) || !is_numeric($_GET['idPagina']) || $_GET['idPagina'] < 1) {
                    self::$paginaAtual = 1; // Página inicial como padrão
                } else {
                    self::$paginaAtual = (int) $_GET['idPagina'];
                }
                
                $totalContatos = self::resgatarQuantidadeContatos();

                self::$quantidadePaginas = ceil($totalContatos / self::$limiteContatosPagina);
                self::$paginaInicial = (self::$paginaAtual - 1) * self::$limiteContatosPagina;

                if (self::$paginaAtual > self::$quantidadePaginas) {
                    self::$paginaAtual = self::$quantidadePaginas;
                }

                $sqlSelectFrom = "SELECT * FROM " . self::$nomeTabela . " LIMIT :offset, :limit";
                $stmt = $pdo->prepare($sqlSelectFrom);
                $stmt->bindValue(':offset', self::$paginaInicial, PDO::PARAM_INT);
                $stmt->bindValue(':limit', self::$limiteContatosPagina, PDO::PARAM_INT);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);

            } elseif(is_int($chaveBusca)) {
                $stmt = $pdo->prepare("SELECT * FROM contatos WHERE idContato = :id");
                $stmt->bindValue(':id', $chaveBusca, PDO::PARAM_INT);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } 

            $sqlLike = "SELECT * FROM contatos WHERE nomeContato LIKE :chaveBusca";

            $stmt = $pdo->prepare($sqlLike);
            $stmt->bindValue(':chaveBusca', "%{$chaveBusca}%");
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function executarQuerySql($querySql) {
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