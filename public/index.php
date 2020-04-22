<?php

define("BASE_PATH", str_replace('\\', '/', str_replace('public', '', __DIR__)));
define("APP_PATH", BASE_PATH.'app/');

require_once(APP_PATH.'config/autoload.php');
require_once(APP_PATH.'core/Framework.php');