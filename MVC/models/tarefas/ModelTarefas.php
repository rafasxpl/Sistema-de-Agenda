<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/models/Connection.php";
    
    class ModelTarefas {
        private static string $nomeTabela           = "tarefas";
        private static int    $limiteTarefasPagina  = 8;
        private static int    $quantidadePaginas    = 0;
        private static int    $paginaInicial        = 0;
        private static int    $paginaAtual          = 0;
        private static int    $totalTarefas         = 0;

        public static function getLimiteTarefasPagina() : int {
            return self::$limiteTarefasPagina;
        }

        public static function getPaginaAtual() : int {
            return (!isset($_GET['idPaginaTarefa']) || !is_numeric($_GET['idPaginaTarefa']) || $_GET['idPaginaTarefa'] < 1) ? 1 : (int) $_GET['idPaginaTarefa'];
        }

        public static function getQuantidadePaginas() : int {
            return round(self::resgatarQuantidadeTarefas() / self::$limiteTarefasPagina);
        }

        public static function resgatarQuantidadeTarefas() : int {
            $pdo = Connection::conectar();

            $sqlSelectFromAll = "SELECT COUNT(*) FROM " . self::$nomeTabela;
            $stmt = $pdo->prepare($sqlSelectFromAll);

            try {
                $stmt->execute();
                return $stmt->fetchColumn();
            } catch(PDOException $e) {
                throw new RuntimeException("Erro ao buscar quantidade de Tarefas: " . $e->getMessage());
            }
        }

        public static function resgatarDadosTarefas($chaveBusca, $filtrarTarefasConcluidas) : array {
            $pdo = Connection::conectar();

            if(empty($chaveBusca)) {
                self::$paginaAtual   = self::getPaginaAtual();
                self::$totalTarefas = self::resgatarQuantidadeTarefas();
                
                self::$quantidadePaginas = ceil(self::$totalTarefas / self::$limiteTarefasPagina);
                self::$paginaInicial = (self::$paginaAtual - 1) * self::$limiteTarefasPagina;

                if (self::$paginaAtual > self::$quantidadePaginas) {
                    self::$paginaAtual = self::$quantidadePaginas;
                }

                if($filtrarTarefasConcluidas) {
                    $sqlSelectFrom = "SELECT * FROM " . self::$nomeTabela . " WHERE statusTarefa = :statusTarefa LIMIT :offset, :limit";
                    $stmt = $pdo->prepare($sqlSelectFrom);
                    $stmt->bindValue(':offset', self::$paginaInicial, PDO::PARAM_INT);
                    $stmt->bindValue(':limit', self::$limiteTarefasPagina, PDO::PARAM_INT);
                    $stmt->bindValue(':statusTarefa', 1, PDO::PARAM_INT);
    
                    try {
                        $stmt->execute();
                        return $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch (PDOException $e) {
                        throw new RuntimeException("Erro ao buscar Tarefas: " . $e->getMessage());
                    }
                }

                $sqlSelectFrom = "SELECT * FROM " . self::$nomeTabela . " ORDER BY statusTarefa DESC LIMIT :offset, :limit";
                $stmt = $pdo->prepare($sqlSelectFrom);
                $stmt->bindValue(':offset', self::$paginaInicial, PDO::PARAM_INT);
                $stmt->bindValue(':limit', self::$limiteTarefasPagina, PDO::PARAM_INT);

                try {
                    $stmt->execute();
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    throw new RuntimeException("Erro ao buscar Tarefas: " . $e->getMessage());
                }


            } elseif(is_int($chaveBusca)) {
                $stmt = $pdo->prepare("SELECT * FROM tarefas WHERE idTarefa = :id");
                $stmt->bindValue(':id', $chaveBusca, PDO::PARAM_INT);

                try {
                    $stmt->execute();
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch(PDOException $e) {
                    throw new RuntimeException("Erro ao buscar tarefa: " . $e->getMessage());
                }
            } 

            $sqlLike = "SELECT * FROM tarefas WHERE tituloTarefa LIKE :chaveBusca";

            $stmt = $pdo->prepare($sqlLike);
            $stmt->bindValue(':chaveBusca', "%{$chaveBusca}%");

            try {
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new RuntimeException("Erro ao buscar Tarefas: " . $e->getMessage());
            }
        }

        public static function concluirTarefa($status, $idTarefa) : void {
            $pdo = Connection::conectar();

            if(empty($idTarefa) || !is_numeric($idTarefa)) {
                throw new InvalidArgumentException("ID da tarefa e status devem ser informados corretamente");
            }
 
            $sqlConcluirTarefa = "UPDATE " . self::$nomeTabela ." SET statusTarefa = :status WHERE idTarefa = :id";
            $stmt = $pdo->prepare($sqlConcluirTarefa);
            $stmt->bindValue(':id', $idTarefa, PDO::PARAM_INT);
            $stmt->bindValue(':status', $status, PDO::PARAM_STR);

            try {
                $stmt->execute();
            } catch(PDOException $e) {
                throw new RuntimeException("Erro ao concluir tarefa: ". $e->getMessage());
            }
        }

        public static function atualizarInformacoesTarefa($matrizDeValores, $id) : void {
            if (!$matrizDeValores || !$id || !is_numeric($id)) {
            throw new InvalidArgumentException("A matriz de valores e um ID válido devem ser fornecidos!");
            }

            $pdo = Connection::conectar();

            $sqlUpdate = "UPDATE " . self::$nomeTabela . " SET ";
            $colunaValor = [];

            foreach ($matrizDeValores as $chave => $valor) {
            $colunaValor[] = "$chave = :$chave";
            }

            $sqlUpdate .= implode(", ", $colunaValor) . " WHERE idTarefa = :id";
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

        public static function excluirTarefa($id) : void {
            if (!$id || !is_numeric($id)) {
                throw new InvalidArgumentException("ID inválido fornecido!");
            }

            $pdo = Connection::conectar();
            $sqlDelete = "DELETE FROM " . self::$nomeTabela . " WHERE idTarefa = :id";
        
            $stmt = $pdo->prepare($sqlDelete);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            try {
                $stmt->execute();
            } catch (PDOException $e) {
                throw new RuntimeException("Erro ao excluir contato: " . $e->getMessage());
            }

        }
    }