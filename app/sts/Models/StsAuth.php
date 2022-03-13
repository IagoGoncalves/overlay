<?php

namespace Sts\Models;
use Sts\Models\helper\StsConn;

if(!defined('URL')) {
    header("Location: /overlay/");
    exit;
}

class StsAuth extends StsConn{
    private $id;
    private $pdo;

    public function __construct($id) {
        $this->id = $id;
        $this->pdo = $this->getConnect();
        $this->authUser();
    }

    private function authUser() {
        $sql = "SELECT type FROM users WHERE id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $this->id);
        $sql->execute();
        $sql = $sql->fetch();
        $_SESSION['user_type'] = $sql['type'];

        if($sql['type'] == 1) {
            header("Location: admin");

        } else {
            header("Location: usuario");
        }
    }
}