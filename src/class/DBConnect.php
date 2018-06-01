<?php
    require_once('../src/config/dbConfig.inc.php');

    abstract class DBConnect {
        protected $pdo;
        public function __construct() {
            $dsn = DB_DRIVER . ':host=' . DB_HOST . ';port=' . DB_PORT . ';encoding=' . DB_ENCODING . ';dbname=' . DB_NAME; // database server name
            try {
                $this->pdo = new PDO($dsn, DB_USER, DB_PASS);
                $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo->query("SET NAMES 'utf8'");

            } catch (PDOException $e) {
                die('Wystapił błąd: ' . $e->getMessage());
            }
        }
        public function __destruct() {
            $this->pdo = null;
        }
    }
?>