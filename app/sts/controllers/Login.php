<?php
namespace Sts\Controllers;

if(!defined('URL')) {
    header("Location: /overlay/");
    exit;
}

class Login {

    private $data;
    
    public function index() {

        if(isset($_SESSION['user_logado']) && !empty($_SESSION['user_logado'])) {
            header("Location: auth");
        }

        $this->data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);
        
        if(isset($this->data['logar']) && !empty($this->data['logar'])) {
            $login = new \Sts\Models\StsLogin($this->data);
        }
       
        // ESTACIANDO A VIEW
        $loadView = new \Core\ConfigView('sts/Views/login/login', $this->data);
        $loadView->render();
    }

   
}