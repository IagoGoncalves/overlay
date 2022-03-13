<?php
namespace Core;

class configView {
    
    public $file;
    public $data;

    public function __construct($file, array $data = null) {
        $this->file = (string) $file;
        $this->data = $data;
    }

    public function render() {
        if(file_exists('app/' . $this->file . '.php')) {

            include 'app/sts/Views/include/header.php';
            include 'app/' . $this->file . '.php';
            include 'app/sts/Views/include/footer.php';

        } else {
            include 'app/sts/Views/include/header.php';
            include 'app/sts/Views/error/error.php';
            include 'app/sts/Views/include/footer.php';
        }
    }

}