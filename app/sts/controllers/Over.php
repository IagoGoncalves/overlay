<?php


namespace Sts\Controllers;


if(!defined('URL')) {
    header("Location: /overlay/");
    exit;
}
class Over
{
    public function index() {

        //retorna o site direct
        $link = new \Sts\Models\StsOver();
        $link->viewUrl();


    }


}