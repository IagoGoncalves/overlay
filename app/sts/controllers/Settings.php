<?php
namespace Sts\Controllers;

if(!defined('URL')) {
    header("Location: /overlay/");
    exit;
}

class Settings {
    
    public function index() {
        // ESTACIANDO A VIEW
        $loadView = new \Core\ConfigView('sts/Views/settings/settings');
        $loadView->render();
    }
}