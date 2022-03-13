<?php


namespace Sts\Controllers;


if(!defined('URL')) {
    header("Location: /overlay/");
    exit;
}

class EditLink
{


    public function index() {

        if(!isset($_SESSION['user_logado'])) {
            header("Location: login");
        }
            $editLink = new \Sts\Models\StsEditLink($_GET['id']);
        if (!empty($_POST['link'])) {
            $editLink->updateLink($_GET['id'], $_POST['link']);
        }

        // ESTACIANDO A VIEW
        $loadView = new \Core\ConfigView('sts/Views/EditLink/editlink');
        $loadView->render();
    }

}