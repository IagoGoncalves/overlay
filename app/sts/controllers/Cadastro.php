<?php
namespace Sts\Controllers;

if(!defined('URL')) {
    header("Location: /overlay/");
    exit;
}

class Cadastro {
   
    private $data;

    public function index() {

        if(isset($_SESSION['user_logado']) && !empty($_SESSION['user_logado'])) {
            header("Location: auth");
        }

        $this->data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);
        
        if(isset($this->data['cadastrar']) && !empty($this->data['cadastrar'])) {
            $cadastro = new \Sts\Models\StsCadastro($this->data);
        }

        // ESTACIANDO A VIEW
        $loadView = new \Core\ConfigView('sts/Views/cadastro/cadastro');
        $loadView->render();
    }
}