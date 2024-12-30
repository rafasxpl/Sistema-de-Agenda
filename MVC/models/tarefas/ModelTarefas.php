<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/models/Connection.php";
    
    class ModelTarefas {
        private static string $nomeTabela        = "tarefas";
        private static int $limiteTarefasPagina  = 10;
        private static int $quantidadePaginas    = 0;
        private static int $paginaInicial        = 0;
        private static int $paginaAtual          = 0;
        private static int $totalTarefas         = 0;

        public static function getLimiteTarefasPagina() : int {
            return self::$limiteTarefasPagina;
        }

        public static function getPaginaAtual() : int {
            return (!isset($_GET['idPagina']) || !is_numeric($_GET['idPagina']) || $_GET['idPagina'] < 1) ? 1 : (int) $_GET['idPagina'];
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

        public static function resgatarDadosTarefas($chaveBusca) : array {
            $pdo = Connection::conectar();

            if(empty($chaveBusca)) {
                self::$paginaAtual   = self::getPaginaAtual();
                self::$totalTarefas = self::resgatarQuantidadeTarefas();
                
                self::$quantidadePaginas = ceil(self::$totalTarefas / self::$limiteTarefasPagina);
                self::$paginaInicial = (self::$paginaAtual - 1) * self::$limiteTarefasPagina;

                if (self::$paginaAtual > self::$quantidadePaginas) {
                    self::$paginaAtual = self::$quantidadePaginas;
                }

                $sqlSelectFrom = "SELECT * FROM " . self::$nomeTabela . " LIMIT :offset, :limit";
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
    }