<?php
namespace Sts\Controllers;

if(!defined('URL')) {
    header("Location: /overlay/");
    exit;
}

class Auth {
    
    private $id;

    public function index() {
    
        $this->id = $_SESSION['user_logado'];
        $auth = new \Sts\Models\StsAuth($this->id);
    }
}