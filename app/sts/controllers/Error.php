<?php
namespace Sts\Controllers;

if(!defined('URL')) {
    header("Location: /overlay/");
    exit;
}

class Error {
    
    public function index() {
        // ESTACIANDO A VIEW
        $loadView = new \Core\ConfigView('sts/Views/error/error');
        $loadView->render();
    }
}