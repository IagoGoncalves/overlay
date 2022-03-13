<?php


namespace Sts\Models;
use Sts\Models\helper\StsConn;

if(!defined('URL')) {
    header("Location: /overlay/");
    exit;
}

class StsDirect extends StsConn
{
    private $contador;
    private $url;
    private $id_user;
    public $pdo;

    public function __construct()
    {
        $this->pdo = $this->getConnect();
        $url = $_SESSION['link'];
        $id_user = $_SESSION['id_user'];
        $this->id_user = $id_user;
        $this->url = $url;
        $this->searchLink();
    }
    public function searchLink(){
        $sql = "SELECT * FROM link WHERE id_user = :id_user AND url = :url";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id_user", $this->id_user);
        $sql->bindValue(":url", $this->url);
        $sql->execute();
        $sql = $sql->fetch();
        $_SESSION['conversao'] = $sql['totalconversao'];
        $this->TotalConversao();
    }


    public function TotalConversao(){
        $this->contador = 1;
        // total de cliques já no banco de dados referente ao link visualizado;
        $soma = $this->contador +  $_SESSION['conversao'];
        $this->soma = $soma;
        // faz update na tabela com a contagem de cliques atual;
        $sql = "UPDATE link SET totalconversao = :soma  WHERE id_user = :id_user AND url = :url";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id_user", $this->id_user);
        $sql->bindValue(":url", $this->url);
        $sql->bindValue(":soma", $this->soma);
        $sql->execute();
    }

}