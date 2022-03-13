<?php


namespace Sts\Models;
use Sts\Models\helper\StsConn;

if(!defined('URL')) {
    header("Location: /overlay/");
    exit;
}
class StsLink extends StsConn
{
    private $site;
    private $titulo;
    private $mensagem;
    private $botao;
    private $direcionamento;
    private $id;
    private $pdo;
    private $exists;

    public function __construct($link){
        $this->id = $_SESSION['user_logado'];
        $this->site = $link['site'];
        $this->titulo = $link['titulo'];
        $this->mensagem = $link['mensagem'];
        $this->botao = $link['botao'];
        $this->direcionamento = $link['direcionamento'];
        $this->pdo = $this->getConnect();
        $this->verificaUrl();
        $this->searchLink();
        $this->cadastrarLink();
    }

    public function VerificaUrl(){

        $file = $this->site;
        $file_headers = @get_headers($file);
        if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
            $exists = false;
        }
        else {
            $exists = true;
        }
        $file = $this->direcionamento;
        $file_headers = @get_headers($file);
        if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {

            $this->exists = false;
            $_SESSION['teste'] = $this->exists;
        }
        else {
            $this->exists = true;
            $_SESSION['teste'] = $this->exists;
        }

    }
    public function searchLink(){
        // para verificar se o link já foi cadastrado em algum momnto se sim exibira um erro de link ja cadastrado
        $sql = "SELECT * FROM link WHERE id_user = :id_user AND url = :url";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id_user", $this->id);
        $sql->bindValue(":url", $this->site);
        $sql->execute();
        $sql = $sql->fetch();
        $_SESSION['duplicata'] = $sql;

    }

    public function cadastrarLink (){
        if($_SESSION['duplicata'] == false) {
            if ($this->exists == true) {
                $sql = "INSERT INTO link (id_user, title, message, buttoon, url, direct) 
        VALUES (:id, :titulo, :mensagem, :botao, :site, :direcionamento)";
                $sql = $this->pdo->prepare($sql);
                $sql->bindValue(":id", $this->id);
                $sql->bindValue(":titulo", $this->titulo);
                $sql->bindValue(":mensagem", $this->mensagem);
                $sql->bindValue(":botao", $this->botao);
                $sql->bindValue(":site", $this->site);
                $sql->bindValue(":direcionamento", $this->direcionamento);
                $sql->execute();
                if ($sql == true) {
                    $_SESSION['msg-link'] = "Link criado, aguarde você será direcionado";
                    header("Refresh: 2; usuario");
                } else {
                    $_SESSION['msg-link'] = "Não foi possivel criar, veriquei os dados preenchidos";
                }
            } else {
                $_SESSION['msg-link'] = "Os links digitados são invalidos ou o site não está no ar";
            }
        }else{
            $_SESSION['msg-link'] = "Essa url já está cadastrada";
        }
    }




}