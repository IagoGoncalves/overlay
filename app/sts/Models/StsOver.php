<?php


namespace Sts\Models;
use Sts\Models\helper\StsConn;

if(!defined('URL')) {
    header("Location: /overlay/");
    exit;
}

class StsOver extends StsConn
{

        private $url;
        private $id_user;
        public $pdo;

        public function __construct()
        {
            $this->pdo = $this->getConnect();
            $url = $_GET['link'];
            $_SESSION['link'] = $url; //para conversao StsDirect
            $id_user = $_GET['id'];
            $_SESSION['id_user'] = $id_user; //para conversao StsDirect
            $this->id_user = $id_user;
            $this->url = $url;
            $this->searchLink();
            $loadView = new \Core\ConfigView('sts/Views/over/over');
            $loadView->render();
        }

        public function searchLink(){
            $sql = "SELECT * FROM link WHERE id_user = :id_user AND url = :url";
            $sql = $this->pdo->prepare($sql);
            $sql->bindValue(":id_user", $this->id_user);
            $sql->bindValue(":url", $this->url);
            $sql->execute();
            $sql = $sql->fetch();
            $_SESSION['title'] = $sql['title'];
            $_SESSION['message'] = $sql['message'];
            $_SESSION['buttoon'] = $sql['buttoon'];
            $_SESSION['direct'] = $sql['direct'];
            //$this->viewUrl($sql['url']);
            $_SESSION['url'] = $sql['url'];
            $_SESSION['totalcliques'] = $sql['totalclique'];
        }

        public function viewUrl(){
        if (!empty($_SESSION['url'])){
            $dadosSite = file_get_contents($_SESSION['url']);
            echo $dadosSite;
            // chama função que conta o total de cliques do link atual
            $this->cliqueLink();
        }else{
                echo $_SESSION['msg-over'] = "Link não cadastrado";
            }
        }
        // função para atualizar quantidades de cliques em um determinado link
        public function cliqueLink(){
            global $contador;
            $this->contador = $contador;
            $this->contador = 1;
            // total de cliques já no banco de dados referente ao link visualizado;
            $_SESSION['totalcliques'];
            $soma = $this->contador +  $_SESSION['totalcliques'];
            $this->soma = $soma;
            // faz update na tabela com a contagem de cliques atual;
            $sql = "UPDATE link SET totalclique = :soma  WHERE id_user = :id_user AND url = :url";
            $sql = $this->pdo->prepare($sql);
            $sql->bindValue(":id_user", $this->id_user);
            $sql->bindValue(":url", $this->url);
            $sql->bindValue(":soma", $this->soma);
            $sql->execute();
            }


}