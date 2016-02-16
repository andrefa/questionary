<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("model/AdminUser.php");
require_once("Rest.inc.php");

    class API extends REST {

        public function __construct() {
            parent::__construct(); 
        }

        public function processApi() {
            $func = strtolower(trim(str_replace("/", "", $_REQUEST['x'])));
            if ((int) method_exists($this, $func) > 0)
                $this->$func();
            else
                $this->response('', 404);
        }
        
        private function login() {
        }
        
        private function customers() {
            $bla = new AdminUser();
            $this->response(json_encode($bla),200);
        }
        
        private function insertCustomer() {
            $this->response($this->json("{teste:2}"));
        }
        
        private function updateCustomer() {
            $this->response($this->json("{teste:3}"));
        }
        
        private function deleteCustomer() {
            $this->response($this->json("{teste:4}"));
        }
        
    }

// Initiate Library
$api = new API;
$api->processApi();
?>