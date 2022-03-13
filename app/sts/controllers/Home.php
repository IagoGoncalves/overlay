<?php
namespace Sts\Controllers;

if(!defined('URL')) {
    header("Location: /overlay/");
    exit;
}

class Home {
    
    public function index() {
        // ESTACIANDO A VIEW
        $loadView = new \Core\ConfigView('sts/Views/home/home');
        $loadView->render();
    }
}