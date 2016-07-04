<?php
class Conexao {
    private $user;
    private $password;
    private $host;
    private $db_name;
 
    public function __construct() {
        $this->user     = 'site1387212428';
        $this->password = 'ki@coaching';
        $this->host     = 'mysql01.site1387212428.hospedagemdesites.ws';
        $this->db_name  = 'site1387212428';
    }

    public function connect() {
        try{
            $conn = new PDO('mysql:host=' . $this->host  . ';dbname=' . $this->db_name, $this->user, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }catch(PDOException $e){
            echo 'ERROR: ' . $e->getMessage();
        }
    }
}