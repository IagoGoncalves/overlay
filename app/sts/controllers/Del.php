<?php

namespace Sts\Controllers;

use Sts\Models\helper\StsInsert;

if(!defined('URL')) {
    header("Location: /overlay/");
    exit;
}

class Del
{
    public function index(){
        
        $id = filter_var($_GET['id'], FILTER_SANITIZE_STRIPPED);
        $del = new \Sts\Models\helper\StsDelete($id);
        $del->deletar();
        header("Location: admin");

    }

}