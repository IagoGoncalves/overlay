<?php
namespace Sts\Controllers;

if(!defined('URL')) {
    header("Location: /overlay/");
    exit;
}

class Sair {

    public function index() {
       session_destroy();
       header("Location: login");
       exit;
    }
}