<?php

namespace Sts\Models;
use Sts\Models\helper\StsConn;

if(!defined('URL')) {
    header("Location: /overlay/");
    exit;
}

class StsEditar extends StsConn{

    private $id;
    private $pdo;

    public function __construct($id) {
        $this->id = $id;
        $this->pdo = $this->getConnect();
    }

    public function getData() {

        $sql = "SELECT * FROM users WHERE id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindvalue(":id", $this->id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            return $sql;
        }
    }


    public function updateUser(array $data = null) {

        if(isset($_POST['nome']) && !empty($_POST['nome'])) {

            $nome = $data['nome'];
            $email = $data['email'];
            $cpf = $data['cpf'];
            $type = $data['tipo_user'];
            $user = $data['status_user'];

            $sql = "UPDATE users SET name = :n, email = :e, cpf = :c, type = :t, status = :u WHERE id = :id";
            $sql = $this->pdo->prepare($sql);
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":c", $cpf);
            $sql->bindValue(":t", $type);
            $sql->bindValue(":u", $user);
            $sql->bindValue(":id", $this->id);
            $sql->execute();

            header("Location: admin");
        }
    }

}