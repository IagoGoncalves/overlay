<?php
require __DIR__."/core/Config.php";
require __DIR__."/vendor/autoload.php";
use Core\ConfigController as Controller;
$url = new Controller();
$url->load();
?>