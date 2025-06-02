<?php

class ModelBDD
{
    private $conn;

    private function getBdd()
    {
        if ($this->conn == null) {
            try {
                require_once('Config/configBDD.php');

                $this->conn = new PDO("mysql:host=localhost;dbname=projet;charset=utf8", DB_USER, DB_PASS);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }
        return $this->conn;
    }

    public function execute_query($sql)
    {
        $conn = $this->getBdd();

        try {
            $result = $conn->query($sql);
            return $result;
        } catch (PDOException $e) {
            die("Erreur d'exécution de la requête : " . $e->getMessage());
        }
    }

    public function getconn()
    {
        return $this->conn;
    }
}
