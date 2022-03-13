<?php


namespace Sts\Controllers;
if(!defined('URL')) {
    header("Location: /overlay/");
    exit;
}

class Editar {

    private $data;

    public function index(){

        $data = new \Sts\Models\StsEditar($_GET['id']);
        $this->data = $data->getData();

        $user = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);
        $data->updateUser($user);

        $loadView = new \Core\ConfigView('sts/Views/editar/editar', $this->data);
        $loadView->render();


    }

}