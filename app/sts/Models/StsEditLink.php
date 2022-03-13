<?php


namespace Sts\Models;
use Sts\Models\helper\StsConn;

if(!defined('URL')) {
    header("Location: /overlay/");
    exit;
}

class StsEditLink extends StsConn
{

    private $pdo;
    private $idLink;

    public function __construct($idLink)
    {
        $this->pdo = $this->getConnect();
        $this->idLink = $idLink;
        $this->EdiLink();

    }


    public function EdiLink(){
        $sql = "SELECT * FROM link WHERE id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $this->idLink);
        $sql->execute();
        $sql = $sql->fetchAll();
        $_SESSION['sql-edit'] = $sql;

    }

    public function updateLink($id, $link){
        $this->id = $id;
        $this->titulo = $link['titulo'];
        $this->mensagem = $link['mensagem'];
        $this->botao = $link['botao'];

        $sql = "UPDATE link SET title = :titulo, message = :mensagem, buttoon = :botao
        WHERE id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $this->id);
        $sql->bindValue(":titulo", $this->titulo);
        $sql->bindValue(":mensagem", $this->mensagem);
        $sql->bindValue(":botao", $this->botao);
        $sql->execute();

        if($sql == true){
            $_SESSION['msg-link'] = "Link atualizado, aguarde você será direcionado";
            header("Refresh: 2; usuario");
        }else{
            $_SESSION['msg-link'] = "Não foi possivel atualizar, veriquei os dados preenchidos";
        }
    }


}