<?php

namespace Sts\Models;
use Sts\Models\helper\StsConn;

if(!defined('URL')) {
    header("Location: /overlay/");
    exit;
}

class StsLogin extends StsConn{

    private $email;
    private $senha;
    private $pdo;

    public function __construct(array $data = null) {
       if(!empty($data['email']) && !empty($data['senha'])) {   

        $this->email = $data["email"];
        $this->senha = md5($data["senha"]);
        $this->pdo = $this->getConnect();
        $this->logar();

       } else {
            $_SESSION['cod'] = 'warning';
            $_SESSION['msgLogin'] = 'PREENCHA TODOS OS CAMPOS!';
       }
    }

    private function logar() {
       $sql = "SELECT * FROM users WHERE email = :email AND pass = :senha";
       $sql = $this->pdo->prepare($sql);
       $sql->bindValue(":email", $this->email);
       $sql->bindValue(":senha", $this->senha);
       $sql->execute();

       if($sql->rowCount() > 0) {
          $sql = $sql->fetch();
          $_SESSION['user_logado'] = $sql['id'];
          $_SESSION['name'] = $sql['name'];
          header("Location: auth");

       } else {
            $_SESSION['cod'] = 'warning';
            $_SESSION['msgLogin'] = 'USUARIO OU SENHA INCORRETO';
       }
    }
}