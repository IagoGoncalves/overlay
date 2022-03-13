<?php

namespace Sts\Models;
use Sts\Models\helper\StsConn;

if(!defined('URL')) {
    header("Location: /overlay/");
    exit;
}

class StsCadastro {

    public function __construct(array $data = null) {
        $cadastrar = new \Sts\Models\helper\StsInsert($data);
    }
}