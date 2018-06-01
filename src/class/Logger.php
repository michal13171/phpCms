<?php

    declare(strict_types=1);

    class Logger {
        private $dir;
        private $file;
        private $log;
        private $date;
        private $ip;
        private $login;

        public function __construct(String $file, String $log, String $login) {
            $this->dir = '../src/log/';
            $this->file = $this->dir . $file;
            $this->date = date('Y-m-d H:m:s');
            $this->ip = $_SERVER['REMOTE_ADDR'];
            $this->login = $login;
            $this->log = $log . ' | ' . $this->date . ' | ' . $this->ip . ' | ' . $this->login . "\n";

            $this->mkDir();
            $this->touchFile();
            $this->saveLog();
        }

        private function mkDir(): void {
            if (!file_exists($this->dir)) {
                mkdir($this->dir);
            }
        }

        private function touchFile(): void {
            if (!file_exists($this->file)) {
                touch($this->file);
            }
        }

        private function saveLog():void {
            file_put_contents($this->file, $this->log, FILE_APPEND);
        }
    }

?>