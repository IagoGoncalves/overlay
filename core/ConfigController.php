<?php

namespace Core;

class ConfigController {

    private $url;
    private $urlConjunto;
    private $urlController;
    private $urlMetodo;
    private static $format;

    public function __construct() {

        if (!empty(filter_input(INPUT_GET, 'url', FILTER_SANITIZE_STRIPPED))) {
            
            $this->url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_STRIPPED);
            $this->cleanUrl();
            $this->urlConjunto = explode('/', $this->url);

            if (isset($this->urlConjunto[0])) {
                $this->urlController = $this->UpperCase($this->urlConjunto[0]);
                
                if(!file_exists('app/sts/Controllers/' . $this->urlController . '.php')) {
                    header('Location: ./error');
                }

            } else {
                $this->urlController = "Home";
            }

            if (isset($this->urlConjunto[1])) {
                $this->urlMetodo = $this->urlConjunto[1];
            } else {
                $this->urlMetodo = null;
            }
        } else {
            $this->urlController = "Home";
        }

        // echo "<b>   URL:</b> " . $this->url . "<br>";
        // echo "<b>CONTROLLER:</b> " . $this->urlController . "<br>";
        // echo "<b>METODO:</b> " . $this->urlMetodo;
    }

    private function cleanUrl() {
        $this->url = strip_tags($this->url);
        $this->url = trim($this->url);
        $this->url = rtrim($this->url, '/');

        self::$format = array();
        self::$format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        self::$format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr--------------------------------';
        
        $this->url = strtr(utf8_decode($this->url) , utf8_decode(self::$format['a']), self::$format['b']);
    }

    private function UpperCase($upper) {
        $urlController = strtolower($upper);
        $urlController = explode('-', $urlController);
        $urlController = implode(' ', $urlController);
        $urlController = ucwords($urlController);
        $urlController = str_replace(' ', '', $urlController);
        return $urlController;
    }

    public function load() {
        $class = "\\Sts\\Controllers\\" . $this->urlController;
        $classLoad = new $class;
        $classLoad->index();
    }

}
