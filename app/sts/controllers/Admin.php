<?php
namespace Sts\Controllers;

if(!defined('URL')) {
    header("Location: /overlay/");
    exit;
}

class Admin {

    private $id;
    private $type;
    private $data;
    private $filter;
    private $user;

    public function index() {
        
        // VERIFICA SE HÀ USUARIO LOGADO
        if(!isset($_SESSION['user_logado'])) {
        header("Location: login");
        }

        // RECEBE O FILTRO INDICADO
        if (!empty(filter_input(INPUT_POST, 'filter', FILTER_SANITIZE_STRIPPED))) {
            $this->filter = filter_input(INPUT_POST, 'filter', FILTER_SANITIZE_STRIPPED);
        }

        // RECEBE OS DADOS DO USUARIOS
        if (!empty(filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED))) {
            $this->user = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);
        }
 

        // ID DO USUARIO LOGADO
        $this->id = $_SESSION['user_logado']; 
        // TIPO DE USUARIO LOGADO
        $this->type = $_SESSION['user_type'];


        // VERIFICA SE O USUARIO TEM PERMISSÃO ADMIN
        $type = new \Sts\Models\StsAdmin($this->id, $this->type);

        // BUSCA OS DADOS NO BANCO E RETORNA PARA O ATRIBUTO DATA
        $this->data['listagem'] = $type->listUsers($this->filter);

        // BUSCANDO DADOS DO USUARIO LOGADO
        $this->data['usuario_logado'] = $type->UserLogado();

        // BUSCANDO ASSINATES
        $this->data['assinantes'] = $type->UserData();

         // EFETUA O CADASTRO NO BANCO
        $type->insertUsers($this->user);

        // ESTACIANDO A VIEW
        $loadView = new \Core\ConfigView('sts/Views/admin/admin', $this->data);
        $loadView->render();
    }
}