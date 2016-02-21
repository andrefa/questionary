<?php

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

    class BaseService {

        public function hex2str( $hex ) {
            $tmp = pack('H*', $hex);
            return $tmp;
        }

        public function str2hex( $str ) {
            $tmp = unpack('H*', $str);
            return array_shift( $tmp );
        }       
        
    }

?>