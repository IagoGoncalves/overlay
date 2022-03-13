<?php
namespace Sts\Controllers;

if(!defined('URL')) {
    header("Location: /overlay/");
    exit;
}

class Usuario {
    
    public function index() {
        
        if(!isset($_SESSION['user_logado'])) {
            header("Location: login");
        }

        $tbView = new \Sts\Models\StsUsuario();
        //para deletar a linha da tabela
        if (!empty($_GET['drop'])){
            //chama a função
            $tbView->dropLink();
        }

        // ESTACIANDO A VIEW
        $loadView = new \Core\ConfigView('sts/Views/usuario/usuario');
        $loadView->render();
    }
}