<?php 
    class Connection {
        private static ?PDO   $conn     = null;
        private static string $server   = 'localhost';
        private static string $dbname   = 'agenda';
        private static string $password = '';
        private static string $username = 'root';

        private static function getServer()       : string {return self::$server;}
        private static function getDataBaseName() : string {return self::$dbname;}
        private static function getPassword()     : string {return self::$password;}
        private static function getUserName()     : string {return self::$username;}

        private static function gerarUrl() : string {
            return "mysql:host=".self::getServer().";dbname=".self::getDataBaseName();
        }

        public static function conectar() : PDO {
            if(self::$conn === null) {
                try {
                    self::$conn = new PDO("mysql:" . self::gerarUrl(), self::getUserName(), self::getPassword());
                    self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch(PDOException $e) {
                    die("Erro de conexão" . $e->getMessage());
                }
            }

            return self::$conn;
        }

        public static function resgatarDadosTabela($nomeTabela) : array | string {
            $pdo = self::conectar();

            if($nomeTabela !== null) {
                $stmt = $pdo->prepare("SELECT * FROM {$nomeTabela}");
                $stmt->execute();
    
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }

            return "Nome da tabela não informado";

        }

        
        public static function resgatarDadosQuery($querySql) : array | string{
            $pdo = self::conectar();

            if($querySql !== null) {
                $stmt = $pdo->prepare($querySql);
                $stmt->execute();
        
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }

            return "Query SQL não informada";
        }

        public static function cadastrarInformacaoTabela($nomeTabela = null, $matrizDeValores = null, $tipoValores = null) {
            if(!$nomeTabela || !$matrizDeValores) {
                die("Nome da tabela e a matriz de valores devem ser fornecidos!");
            }

            $pdo = self::conectar();

            $sqlInsert     = "INSERT INTO";
            $nomeCampos    = null;
            $valoresCampos = null;

            foreach ($matrizDeValores as $chave => $valor) {
                $valoresCampos .=   ":". $chave . ",";
                $nomeCampos    .=  $chave . ",";     
            }
            
            $nomeCampos    = trim($nomeCampos, ",");
            $valoresCampos = trim($valoresCampos, ",");
            
            $stmt = $pdo->prepare(($sqlInsert . " " . $nomeTabela . " (". $nomeCampos .")" . " VALUES " . "(" . $valoresCampos . ")"));

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