<?php
namespace Sts\Controllers;

if(!defined('URL')) {
    header("Location: /overlay/");
    exit;
}

class Planos {
    
    public function index() {
        // ESTACIANDO A VIEW
        $loadView = new \Core\ConfigView('sts/Views/planos/planos');
        $loadView->render();
    }
}