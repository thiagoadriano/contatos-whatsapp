<?php
require_once 'conexao.class.php';

class Usuarios {
    private $con;
    private $table;

    public function __construct()
    {
        $this->con = new Conexao();
        $this->table = 'contato_whatsapp';
    }

    public function buscarRegistros($query = 'all')
    {

        if($query == 'all'){
            $queryExecute = "SELECT * FROM ".$this->table;
        }else{
            $queryExecute = "SELECT * FROM ".$this->table . ' ' . $query;
        }

        $stmt = $this->con->connect()->prepare($queryExecute . " GROUP BY hour(DATA), email ORDER BY id DESC;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function insert()
    {
        global $nome, $email, $telefone, $mensagem;
        $query = "INSERT INTO ".$this->table." (nome, email, telefone, mensagem)
                   VALUES (:nome, :email, :telefone, :mensagem)";
        $stmt = $this->con->connect()->prepare($query);
        $stmt->bindParam(':nome',          $nome);
        $stmt->bindParam(':email',         $email);
        $stmt->bindParam(':telefone',      $telefone);
        $stmt->bindParam(':mensagem',      $mensagem);
        $stmt->execute();
    }


}
