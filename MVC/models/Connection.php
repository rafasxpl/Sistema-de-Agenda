<?php 
    class Connection {
        private string $server = 'localhost';
        private string $dbname = 'agenda';
        private string $password = '';
        private string $username = 'root';
        private PDO $conn;

        public function __construct() {
            try {
                $this->conn = new PDO("mysql:host=$this->server;dbname=$this->dbname", $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo "Erro de conexão" . $e->getMessage();
            }
        }

        public function fetchContatos() : array {
            $stmt = $this->conn->prepare("SELECT * FROM contatos");
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getConn() : PDO {
            return $this->conn;
        }
    }

    