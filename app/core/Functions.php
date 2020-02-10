<?php

function ReflectionMethod($class, $method) {
    $r = new ReflectionMethod($class, $method);
    $result = array();
    foreach ($r->getParameters() as $param) {
        $result[] = $param->name;   
    }
    return $result;
}