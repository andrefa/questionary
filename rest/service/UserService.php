<?php

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

require_once("../service/BaseService.php");
require_once("../dao/UserDao.php");

    class UserService extends BaseService {

        public function __construct() {
            $this->password_key_constant = "andrealmeidaceodacodemokey";
            $this->cookie_key_constant = "informacaodocoookie#";
            $this->userDao = new UserDao();
        }

        public function logUser($loginData) {
            $loginData->password = md5($loginData->password . $this->password_key_constant);
            return $this->userDao->findByLoginData($loginData);
        }
        
        public function getLoggedUserId($userSessionToken) {
            $loggedUserId = null;

            if ($userSessionToken) {
                $token = $this->hex2str($userSessionToken);

                $explodedToken = explode("#", $token);
                $loggedUserId = $explodedToken[1];

                $foundUser = $this->userDao->findById($loggedUserId);
                if ($foundUser) {
                    $isUserLogged = true;
                }                
            }
            
            return $loggedUserId;
        }

        public function isUserLogged($userSessionToken) {
            return $this->getLoggedUserId($userSessionToken) != null;
        }

        public function encodeUserId($userId) {
            return $this->str2hex($this->cookie_key_constant . $userId);
        }
        
    }

?>