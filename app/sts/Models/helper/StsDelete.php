<?php

namespace Sts\Models\helper;
use Sts\Models\helper\StsConn;

if(!defined('URL')) {
    header("Location: /overlay/");
    exit;
}

class StsDelete extends StsConn{

    private $id;
    private $pdo;

    public function __construct($id) {
      $this->id = $id;
      $this->pdo = $this->getConnect();
    }

    public function deletar() {

        $sql = "DELETE FROM controler WHERE id_user = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $this->id);
        $sql->execute();

        $sql = "DELETE FROM users WHERE id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $this->id);
        $sql->execute();
    }


}