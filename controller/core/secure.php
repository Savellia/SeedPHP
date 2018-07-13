<?php
    namespace App;

    class secure {
        static function hash($string){
            $string = md5 ($string);
            $string = sha1($string);
            $string = md5 ($string);
            $string = sha1($string);
            $string = hash("whirlpool", $string);

            return $string;
        }

        static function getIp($string){
            return $_SERVER['REMOTE_ADDR'];
        }
    }
?>
