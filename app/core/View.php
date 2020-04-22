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

    public static function show($fileName, $data=NULL)
    {
        $path = APP_PATH.'views/'.$fileName.'.html';
        $viewData = $data;
        if($viewData) {
            extract($viewData);
        }
        
        $file = file_get_contents($path);
        $new = str_replace("qwe", "xzc", $file);
        file_put_contents($path, $new);

        // include($path);
    }
}