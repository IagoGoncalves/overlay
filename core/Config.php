<?php
session_start();
ob_start();

// ORIGEM DO PROJETO
define("URL", "http://localhost/overlay/");
define("ADM", "http://localhost/overlay/adm");

// CONTROLLER E METODO PRINCIPAL
define('CONTROLLER', 'Home');
define('METODO', 'Index');

// DB 
define("DB_NAME", "overlayWeb");
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");