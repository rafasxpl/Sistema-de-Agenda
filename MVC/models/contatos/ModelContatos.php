<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/models/Connection.php";
    
    class ModelContatos {
        private static string $nomeTabela        = "contatos";
        private static int $limiteContatosPagina = 8;
        private static int $quantidadePaginas    = 0;
        private static int $paginaInicial        = 0;
        private static int $paginaAtual          = 0;
        private static int $totalContatos        = 0;

        public static function getLimiteContatosPagina() : int {
            return self::$limiteContatosPagina;
        }

        public static function getPaginaAtual() : int {
            return (!isset($_GET['idPagina']) || !is_numeric($_GET['idPagina']) || $_GET['idPagina'] < 1) ? 1 : (int) $_GET['idPagina'];
        }

        public static function getQuantidadePaginas() : int {
            return round(self::resgatarQuantidadeContatos() / self::$limiteContatosPagina);
        }

        public static function resgatarQuantidadeContatos() : int {
            $pdo = Connection::conectar();

            $sqlSelectFromAll = "SELECT COUNT(*) FROM " . self::$nomeTabela;
            $stmt = $pdo->prepare($sqlSelectFromAll);

            try {
                $stmt->execute();
                return $stmt->fetchColumn();
            } catch(PDOException $e) {
                throw new RuntimeException("Erro ao buscar quantidade de contatos: " . $e->getMessage());
            }
        }

        public static function resgatarDadosContatos($chaveBusca) : array {
            $pdo = Connection::conectar();

            self::$paginaAtual   = self::getPaginaAtual();
            self::$totalContatos = self::resgatarQuantidadeContatos();
            
            self::$quantidadePaginas = ceil(self::$totalContatos / self::$limiteContatosPagina);
            self::$paginaInicial = (self::$paginaAtual - 1) * self::$limiteContatosPagina;

            if (self::$paginaAtual > self::$quantidadePaginas) {
                self::$paginaAtual = self::$quantidadePaginas;
            }

            $sqlSelectFrom = empty($chaveBusca) ? "SELECT * FROM " . self::$nomeTabela . " LIMIT :offset, :limit" : "SELECT * FROM " . self::$nomeTabela . " WHERE nomeContato LIKE :chaveBusca LIMIT :offset, :limit";

            $stmt = $pdo->prepare($sqlSelectFrom);
            $stmt->bindValue(':offset', self::$paginaInicial, PDO::PARAM_INT);
            $stmt->bindValue(':limit', self::$limiteContatosPagina, PDO::PARAM_INT);

            if(empty($chaveBusca)) {
                try {
                    $stmt->execute();
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    throw new RuntimeException("Erro ao buscar contatos: " . $e->getMessage());
                }
            } else {
                if(is_numeric($chaveBusca)) {
                    $stmt = $pdo->prepare("SELECT * FROM contatos WHERE idContato = :id");
                    $stmt->bindValue(':id', $chaveBusca, PDO::PARAM_INT);

                    try {
                        $stmt->execute();
                        return $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch(PDOException $e) {
                        throw new RuntimeException("Erro ao buscar contato: " . $e->getMessage());
                    }
                } 

                $stmt->bindValue(':chaveBusca', "%{$chaveBusca}%", PDO::PARAM_STR);

                try {
                    $stmt->execute();
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    throw new RuntimeException("Erro ao buscar contatos: " . $e->getMessage());
                }
            }
        }

        public static function executarQuerySql($querySql) : array {
            return Connection::executarQuerySql($querySql);
        }

        public static function atualizarInformacoesContatos($matrizDeValores, $id) : void {
            if (!$matrizDeValores || !$id || !is_numeric($id)) {
            throw new InvalidArgumentException("A matriz de valores e um ID válido devem ser fornecidos!");
            }

            $pdo = Connection::conectar();

            $sqlUpdate = "UPDATE " . self::$nomeTabela . " SET ";
            $colunaValor = [];

            foreach ($matrizDeValores as $chave => $valor) {
            $colunaValor[] = "$chave = :$chave";
            }

            $sqlUpdate .= implode(", ", $colunaValor) . " WHERE idContato = :id";
            $stmt = $pdo->prepare($sqlUpdate);

            foreach ($matrizDeValores as $chave => $valor) {
                $stmt->bindValue(":$chave", $valor, PDO::PARAM_STR);
            }

            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            try {
                $stmt->execute();
            } catch (PDOException $e) {
                throw new RuntimeException("Erro ao atualizar contato: " . $e->getMessage());
            }
        }

        public static function excluirContato($id) : void {
            if (!$id || !is_numeric($id)) {
                throw new InvalidArgumentException("ID inválido fornecido!");
            }

            $pdo = Connection::conectar();
            $sqlDelete = "DELETE FROM contatos WHERE idContato = :id";
        
            $stmt = $pdo->prepare($sqlDelete);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            try {
                $stmt->execute();
            } catch (PDOException $e) {
                throw new RuntimeException("Erro ao excluir contato: " . $e->getMessage());
            }

        }

        public static function cadastrarContato($matrizDeValores, $tipoValores = null) : void {
            if(!$matrizDeValores) {
                throw new InvalidArgumentException("A matriz de valores deve ser fornecida!");
            }

            $pdo = Connection::conectar();

            $sqlInsert     = "INSERT INTO " . self::$nomeTabela;
            $nomeCampos    = [];
            $valoresCampos = [];

            foreach ($matrizDeValores as $chave => $valor) {
                $nomeCampos[]    = $chave;
                $valoresCampos[] = ":$chave";
            }
            
            $nomeCamposStr    = implode(", ", $nomeCampos);
            $valoresCamposStr = implode(", ", $valoresCampos);
            
            $stmt = $pdo->prepare("$sqlInsert ($nomeCamposStr) VALUES ($valoresCamposStr)");

            foreach ($matrizDeValores as $chaveValor => $valor) {
                $stmt->bindValue(":$chaveValor", $valor, $tipoValores[$chaveValor] ?? PDO::PARAM_STR);
            }

            try {
                $stmt->execute();
            } catch(PDOException $e) {
                throw new RuntimeException("Erro ao cadastrar dados: ". $e->getMessage());
            }
        }

        public static function cadastrarImagemContato($nomeImagem, $id) : void {
            if(!$id || !is_numeric($id)) {
                throw new InvalidArgumentException("O nome da imagem e um ID válido devem ser fornecidos!");
            }

            $pdo = Connection::conectar();

            $sqlInsertImage = "UPDATE " . self::$nomeTabela . " SET fotoContato = :nomeImagem WHERE idContato = :idContato";
            $stmt = $pdo->prepare($sqlInsertImage);
            $stmt->bindValue(':nomeImagem',$nomeImagem, PDO::PARAM_STR);
            $stmt->bindValue(':idContato', (int) $id, PDO::PARAM_INT);

            try {
                $stmt->execute();
            } catch(PDOException $e) {
                throw new RuntimeException("Erro ao cadastrar imagem: ". $e->getMessage());
            }
        }
    }