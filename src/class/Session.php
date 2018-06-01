<?php

    class Session {
        public function __set($name, $value) {
            $_SESSION[$name] = $value;
        }
        public function __get($name) {
            if (isset($_SESSION[$name])) {
                return $_SESSION[$name];
            } else {
                return NULL;
            }
        }
    }
?>