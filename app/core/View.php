<?php

namespace App\Core;

class View {

    public static function render($fileName, $data=NULL)
    {
        $path = APP_PATH.'views/'.$fileName.'.php';
        $viewData = $data;
        if($viewData) {
            extract($viewData);
        }
        include($path);
    }
}