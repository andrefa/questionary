<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
            $response = new stdClass();
            $response->isUserLogged = true;
            $this->response(json_encode($response),200);
           /* $method = $_SERVER['REQUEST_METHOD'];
            $request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));

            switch ($method) {
              case 'PUT':
                do_something_with_put($request);  
                break;
              case 'POST':
                do_something_with_post($request);  
                break;
              case 'GET':
                do_something_with_get($request);  
                break;
              case 'HEAD':
                do_something_with_head($request);  
                break;
              case 'DELETE':
                do_something_with_delete($request);  
                break;
              case 'OPTIONS':
                do_something_with_options($request);    
                break;
              default:
                handle_error($request);  
                break;*/
        }
        
        private function isUserLogged() {
            $response = new stdClass();
            $response->isUserLogged = false;
            $this->response(json_encode($response),200);
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