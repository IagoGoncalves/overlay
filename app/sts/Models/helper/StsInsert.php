<?php

namespace Sts\Models\helper;
use Sts\Models\helper\StsConn;

if(!defined('URL')) {
    header("Location: /overlay/");
    exit;
}

class StsInsert extends StsConn{

    private $nome;
    private $email;
    private $senha;
    private $cpf;
    private $type = 0;
    private $pdo;

    public function __construct(array $data = null) {
       if(!empty($data['email']) && !empty($data['senha']) && !empty($data['cpf'])) {   

        $this->nome = $data["nome"];
        $this->email = $data["email"];
        $this->senha = md5($data["senha"]);
        $this->cpf = $data["cpf"];
        $this->type = $data["tipo_user"];
        $this->pdo = $this->getConnect();
        $this->cadastrar();

       } else {
            $_SESSION['cod'] = 'warning';
            $_SESSION['msgCadastro'] = 'PREENCHA TODOS OS CAMPOS!';
       }
    }

    public function cadastrar() {
      if($this->verifyCpf($this->cpf)) {
        if($this->verifyEmail($this->email)) {
            
            $sql = "INSERT INTO users (name, email, pass, cpf, type) VALUES (:name, :email, :pass, :cpf, :type)";
            $sql = $this->pdo->prepare($sql);
            $sql->bindValue(":name", $this->nome);
            $sql->bindValue(":email", $this->email);
            $sql->bindValue(":pass", $this->senha);
            $sql->bindValue(":cpf", $this->cpf);
            $sql->bindValue(":type", $this->type);
            $sql->execute();

            $sql = "SELECT id FROM users WHERE email = :email";
            $sql = $this->pdo->prepare($sql);
            $sql->bindValue(":email", $this->email);
            $sql->execute();
            $sql = $sql->fetch();
            $id = $sql['id'];
            $plano = "0";


            $sql = "INSERT INTO controler(id_user, plano) VALUES(:id, :plano)";
            $sql = $this->pdo->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->bindValue(":plano", $plano);
            $sql->execute();

            if($sql == true) {
                $_SESSION['cod'] = 'SUCCESS';
                $_SESSION['msgLogin'] = 'CADASTRO REALIZADO! FAÇA O LOGIN';
                header("Location: login");

            } else {
                $_SESSION['cod'] = 'warning';
                $_SESSION['msgCadastro'] = 'ERRO, TENTE NOVAMENTE';
            }

        } else {
            $_SESSION['cod'] = 'warning';
            $_SESSION['msgCadastro'] = 'EMAIL, JÁ CADASTRADO';
        }

      } else {
            $_SESSION['cod'] = 'warning';
            $_SESSION['msgCadastro'] = 'CPF, JÁ CADASTRADO';
      }
    }


    private function verifyCpf($cpf) {
        $sql = "SELECT id FROM users WHERE cpf = :cpf";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":cpf", $this->cpf);
        $sql->execute();

        if($sql->rowCount() > 0 ) {
            return false;

        } else {
            return true;
        }

    }

    private function verifyEmail($email) {
        $sql = "SELECT id FROM users WHERE email = :email";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":email", $this->email);
        $sql->execute();

        if($sql->rowCount() > 0 ) {
        return false;

        } else {
        return true;
        }
    }
}