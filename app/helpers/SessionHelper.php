<?php 
    namespace App\Helpers;

    class SessionHelper {

        public static function set($name, $value) {
            $_SESSION[$name] = $value;
        }

        public static function get($name) {
            return $_SESSION[$name] ?? '';
        }

        public static function remove($name) {
            unset($_SESSION[$name]);
        }
    }