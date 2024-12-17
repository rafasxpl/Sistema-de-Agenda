<?php 
    class Connection {
        private string $server = 'localhost';
        private string $dbname = 'agenda';
        private string $password = '';
        private string $username = 'root';
        private static PDO $conn;
        
        public function __construct() {
            try {
                self::$conn = new PDO("mysql:host=$this->server;dbname=$this->dbname", $this->username, $this->password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo "Erro de conexão" . $e->getMessage();
            }
        }

        public static function resgatarDados($nomeTabela) {
            $stmt = self::$conn->prepare("SELECT * FROM {$nomeTabela}");
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    