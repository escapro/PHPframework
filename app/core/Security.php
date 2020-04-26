<?php

namespace App\Core;

use App\Core\Session;
use App\Core\Input;
use App\Core\Exeptions;

class Security {

    public static function init() {
        if (config('csrf_protection')) {
            self::csrf_token();
        }
    }

    public static function xss_clean($input_str) {
        $return_str = str_replace( array('<','>',"'",'"',')','('), array('&lt;','&gt;','&apos;','&#x22;','&#x29;','&#x28;'), $input_str );
        $return_str = str_ireplace( '%3Cscript', '', $return_str );
        return $return_str;
    }

    public static function csrf_token($update=false) {
        if (PHP_MAJOR_VERSION >= 7) {
            if (Cookie::get(config('csrf_token_name')) == NULL || $update) {
                Cookie::put(config('csrf_token_name'), bin2hex(random_bytes(32)), config('csrf_expire'));
            }
        }else {
            if (Cookie::get(config('csrf_token_name')) == NULL || $update) {
                if (function_exists('mcrypt_create_iv')) {
                    Cookie::put(config('csrf_token_name'), bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM)), onfig('csrf_expire'));
                } else {
                    Cookie::put(config('csrf_token_name'), bin2hex(openssl_random_pseudo_bytes(32)), onfig('csrf_expire'));
                }
            }
        }
    }

    public static function csrf_check() {
        if (!empty(Input::post(config('csrf_token_name'))) && !empty(Cookie::get(config('csrf_token_name')))) {
            if (hash_equals(Cookie::get(config('csrf_token_name')), Input::post(config('csrf_token_name')))) {
                return true;
            } else {
                self::csrf_token(true);
                return false;
            }
        }else {
            self::csrf_token(true);
            return false;
        }
    }

    public static function csrf_field() {

       return '<input type="input" name="'.config('csrf_token_name').'" value="'.Cookie::get(config('csrf_token_name')).'">';
    }
}