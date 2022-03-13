<?php


namespace Sts\Controllers;
if(!defined('URL')) {
    header("Location: /overlay/");
    exit;
}

class Direct
{
    public function index(){

        $loadView = new \Core\ConfigView('sts/Views/Over/direct');
        $loadView->render();
        // para conversão
        $conver = new \Sts\Models\StsDirect();




}

}