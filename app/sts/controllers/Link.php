<?php
namespace Sts\Controllers;

if(!defined('URL')) {
    header("Location: /overlay/");
    exit;
}

class Link {
    
    public function index() {
        
        if(!isset($_SESSION['user_logado'])) {
            header("Location: login");
        }


        if (!empty($_POST['link'])){
            $clink =  new \Sts\Models\StsLink($_POST['link']);
        }

        // ESTACIANDO A VIEW
        $loadView = new \Core\ConfigView('sts/Views/link/link');
        $loadView->render();
    }
}