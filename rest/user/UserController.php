<?php

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

require_once("../shared/Rest.inc.php");
require_once("../service/UserService.php");

    class API extends REST {

        public function __construct() {
            parent::__construct(); 
            $this->userService = new UserService();
        }

        public function processApi() {
            $func = strtolower(trim(str_replace("/", "", $_REQUEST['x'])));
            if ((int) method_exists($this, $func) > 0)
                $this->$func();
            else
                $this->response('', 404);
        }
        
        private function login() {
            $loginData = json_decode(file_get_contents("php://input"));
            $foundUser = $this->userService->logUser($loginData);

            $isUserLogged = $foundUser != null;
            if ($isUserLogged) {
                setcookie("us", $this->userService->encodeUserId($foundUser->userId), 2592000000, "/");
            }

            $response = new stdClass();
            $response->isUserLogged = $isUserLogged;
            $this->response(json_encode($response),200);
        }
        
        private function isUserLogged() {
            $isUserLogged = $this->userService->isUserLogged($this->getUserSessionToken());

            $response = new stdClass();
            $response->isUserLogged = $isUserLogged;
            $this->response(json_encode($response),200);
        }

        private function logoff() {
            unset($_COOKIE["us"]);
            setcookie("us", "", -3600, "/");
            $this->response("",200);
        }
        
    }

// Initiate Library
$api = new API;
$api->processApi();
?>