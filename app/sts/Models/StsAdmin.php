<?php

namespace Sts\Models;
use Sts\Models\helper\StsConn;

if(!defined('URL')) {
    header("Location: /overlay/");
    exit;
}

class StsAdmin extends StsConn{

    private $id;
    private $type;
    private $pdo;

   public function __construct($id, $type) {
        $this->id = $id;
        $this->type = $type;
        $this->pdo = $this->getConnect();
        $this->typeUser();
   }
   
   private function typeUser() {
        if($this->type != 1) {
           header("Location: usuario");
        }
   }


   public function listUsers($filter = null) {
     $array = array();

     if ($filter) {
          $sql = "SELECT * FROM users ORDER BY $filter";
          $sql = $this->pdo->prepare($sql);
          $sql->execute();

          if($sql->rowCount() > 0) {
               $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
          }

     } else {
          $filter = "";
          $sql = "SELECT * FROM users";
          $sql = $this->pdo->query($sql);
         
          if($sql->rowCount() > 0) {
               $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
          }

     }

     return $array;
   } 


   public function UserLogado() {
     $array = array();

     $sql = "SELECT * FROM users WHERE id = :id";
     $sql = $this->pdo->prepare($sql);
     $sql->bindValue(":id", $this->id);
     $sql->execute();
     
     if($sql->rowCount() > 0) {
          $array = $sql->fetch();
     }

     return $array;

   }


   public function userData() {
     $array = array();

     $sql = "SELECT COUNT(id) as cUser, 
            (SELECT COUNT(id) FROM link) as cLink, 
            (SELECT COUNT(id) FROM controler WHERE plano = 1) AS cPlano 
             FROM users WHERE type != 1";

     $sql = $this->pdo->query($sql);

     if($sql->rowCount() > 0) {
          $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
     }

     return $array;
   }


   public function insertUsers($data) {
     $cadastrar = new \Sts\Models\helper\StsInsert($data);
   }

}