<?php

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

require_once("../shared/Rest.inc.php");
require_once("../dao/UserDao.php");

    class API extends REST {

        public function __construct() {
            parent::__construct(); 
            $this->password_key_constant = "andrealmeidaceodacodemokey";
            $this->cookie_key_constant = "informacaodocoookie#";
        }

        public function processApi() {
            $func = strtolower(trim(str_replace("/", "", $_REQUEST['x'])));
            if ((int) method_exists($this, $func) > 0)
                $this->$func();
            else
                $this->response('', 404);
        }
        
        private function login() {
            $userDao = new UserDao();

            $loginData = json_decode(file_get_contents("php://input"));
            $loginData->password = md5($loginData->password . $this->password_key_constant);

            $foundUser = $userDao->findByLoginData($loginData);

            $isUserLogged = $foundUser != null;
            if ($isUserLogged) {
                setcookie("us", $this->str2hex($this->cookie_key_constant . $foundUser->userId), 2592000000, "/");
            }

            $response = new stdClass();
            $response->isUserLogged = $isUserLogged;
            $this->response(json_encode($response),200);
        }
        
        private function isUserLogged() {
            $isUserLogged = false;

            if (isset($_COOKIE["us"])) {
                $userDao = new UserDao();
                $us = $_COOKIE["us"];
                $token = $this->hex2str($us);
                $usid = explode("#", $token)[1];

                $foundUser = $userDao->findById($usid);
                if ($foundUser) {
                    $isUserLogged = true;
                }
            }

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