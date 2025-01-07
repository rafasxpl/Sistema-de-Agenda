<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/models/Connection.php";
    
    class ModelEventos {
        private static string $nomeTabela           = "eventos";
        private static int    $limiteEventosPagina  = 8;
        private static int    $quantidadePaginas    = 0;
        private static int    $paginaInicial        = 0;
        private static int    $paginaAtual          = 0;
        private static int    $totalEventos         = 0;

        public static function getLimiteEventosPagina() : int {
            return self::$limiteEventosPagina;
        }

        public static function getPaginaAtual() : int {
            return (!isset($_GET['idPaginaEvento']) || !is_numeric($_GET['idPaginaEvento']) || $_GET['idPaginaEvento'] < 1) ? 1 : (int) $_GET['idPaginaEvento'];
        }

        public static function getQuantidadePaginas() : int {
            return round(self::resgatarQuantidadeEventos() / self::$limiteEventosPagina);
        }

        public static function resgatarQuantidadeEventos() : int {
            $pdo = Connection::conectar();

            $sqlSelectFromAll = "SELECT COUNT(*) FROM " . self::$nomeTabela;
            $stmt = $pdo->prepare($sqlSelectFromAll);

            try {
                $stmt->execute();
                return $stmt->fetchColumn();
            } catch(PDOException $e) {
                throw new RuntimeException("Erro ao buscar quantidade de Eventos: " . $e->getMessage());
            }
        }

        public static function criarEvento($dadosEvento) {
            if(empty($dadosEvento)) {
                throw new Exception("Dados da Evento não informados");
            }

            $pdo = Connection::conectar();

            $sqlInsert     = "INSERT INTO " . self::$nomeTabela;
            $nomeCampos    = [];
            $valoresCampos = [];

            foreach ($dadosEvento as $chave => $valor) {
                $nomeCampos[]    = $chave;
                $valoresCampos[] = ":$chave";
            }
            
            $nomeCamposStr    = implode(", ", $nomeCampos);
            $valoresCamposStr = implode(", ", $valoresCampos);
            
            $stmt = $pdo->prepare("$sqlInsert ($nomeCamposStr) VALUES ($valoresCamposStr)");

            foreach ($dadosEvento as $chaveValor => $valor) {
                $stmt->bindValue(":$chaveValor", $valor, $tipoValores[$chaveValor] ?? PDO::PARAM_STR);
            }

            try {
                $stmt->execute();
            } catch(PDOException $e) {
                throw new RuntimeException("Erro ao cadastrar dados: ". $e->getMessage());
            }
        }

        public static function resgatarDadosEventos($chaveBusca, $filtrarEventosConcluidos) : array {
            $pdo = Connection::conectar();

            if(empty($chaveBusca)) {
                self::$paginaAtual   = self::getPaginaAtual();
                self::$totalEventos = self::resgatarQuantidadeEventos();
                
                self::$quantidadePaginas = ceil(self::$totalEventos / self::$limiteEventosPagina);
                self::$paginaInicial = (self::$paginaAtual - 1) * self::$limiteEventosPagina;

                if (self::$paginaAtual > self::$quantidadePaginas) {
                    self::$paginaAtual = self::$quantidadePaginas;
                }

                if($filtrarEventosConcluidos) {
                    $sqlSelectFrom = "SELECT * FROM " . self::$nomeTabela . " WHERE statusEvento = :statusEvento LIMIT :offset, :limit";
                    $stmt = $pdo->prepare($sqlSelectFrom);
                    $stmt->bindValue(':offset', self::$paginaInicial, PDO::PARAM_INT);
                    $stmt->bindValue(':limit', self::$limiteEventosPagina, PDO::PARAM_INT);
                    $stmt->bindValue(':statusEvento', 1, PDO::PARAM_INT);
    
                    try {
                        $stmt->execute();
                        return $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch (PDOException $e) {
                        throw new RuntimeException("Erro ao buscar Eventos: " . $e->getMessage());
                    }
                }

                $sqlSelectFromAll = "SELECT * FROM " . self::$nomeTabela . " ORDER BY statusEvento ASC LIMIT :offset, :limit";
                $sqlChaveBusca    = "SELECT * FROM " . self::$nomeTabela . " WHERE tituloEvento LIKE :chaveBusca ORDER BY statusEvento ASC LIMIT :offset, :limit";

                $sqlSelectFrom = empty($chaveBusca) ? $sqlSelectFromAll : $sqlComChaveBusca;

                $stmt = $pdo->prepare($sqlSelectFrom);
                $stmt->bindValue(':offset', self::$paginaInicial, PDO::PARAM_INT);
                $stmt->bindValue(':limit', self::$limiteEventosPagina, PDO::PARAM_INT);

                try {
                    $stmt->execute();
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    throw new RuntimeException("Erro ao buscar Eventos: " . $e->getMessage());
                }


            } elseif(is_int($chaveBusca)) {
                $stmt = $pdo->prepare("SELECT * FROM eventos WHERE idEvento = :id");
                $stmt->bindValue(':id', $chaveBusca, PDO::PARAM_INT);

                try {
                    $stmt->execute();
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch(PDOException $e) {
                    throw new RuntimeException("Erro ao buscar Evento: " . $e->getMessage());
                }
            } 
        }

        public static function concluirEvento($status, $idEvento) : void {
            $pdo = Connection::conectar();

            if(empty($idEvento) || !is_numeric($idEvento)) {
                throw new InvalidArgumentException("ID da Evento e status devem ser informados corretamente");
            }
 
            $sqlConcluirEvento = "UPDATE " . self::$nomeTabela ." SET statusEvento = :status WHERE idEvento = :id";
            $stmt = $pdo->prepare($sqlConcluirEvento);
            $stmt->bindValue(':id', $idEvento, PDO::PARAM_INT);
            $stmt->bindValue(':status', $status, PDO::PARAM_STR);

            try {
                $stmt->execute();
            } catch(PDOException $e) {
                throw new RuntimeException("Erro ao concluir Evento: ". $e->getMessage());
            }
        }

        public static function atualizarInformacoesEvento($matrizDeValores, $id) : void {
            if (!$matrizDeValores || !$id || !is_numeric($id)) {
            throw new InvalidArgumentException("A matriz de valores e um ID válido devem ser fornecidos!");
            }

            $pdo = Connection::conectar();

            $sqlUpdate = "UPDATE " . self::$nomeTabela . " SET ";
            $colunaValor = [];

            foreach ($matrizDeValores as $chave => $valor) {
            $colunaValor[] = "$chave = :$chave";
            }

            $sqlUpdate .= implode(", ", $colunaValor) . " WHERE idEvento = :id";
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

        public static function excluirEvento($id) : void {
            if (!$id || !is_numeric($id)) {
                throw new InvalidArgumentException("ID inválido fornecido!");
            }

            $pdo = Connection::conectar();
            $sqlDelete = "DELETE FROM " . self::$nomeTabela . " WHERE idEvento = :id";
        
            $stmt = $pdo->prepare($sqlDelete);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            try {
                $stmt->execute();
            } catch (PDOException $e) {
                throw new RuntimeException("Erro ao excluir contato: " . $e->getMessage());
            }

        }
    }