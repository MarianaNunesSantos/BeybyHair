<?php
    class Conexao{
        //Atributos
        private $host = 'bewb7ckehuavj2tlnfqr-mysql.services.clever-cloud.com';
        private $db_name = 'bewb7ckehuavj2tlnfqr';
        private $username = 'uexhzdw8y1vbuahk';
        private $password = 'tlv6ZgTMyp3o12W5ZWuu';
        public $conn;

        public function fazConexao(){
            try{
                $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                echo "Erro de Conexao: ".$e->getMessage();
            }
            return $this->conn;
        }
    }
?>