<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../shared/Rest.inc.php");
require_once("../service/ResultService.php");
require_once("../service/UserService.php");

    class ResultController extends REST {

        public function __construct() {
            parent::__construct(); 
            $this->resultService = new ResultService();
            $this->userService = new UserService();
        }

        public function processApi() {
            $func = strtolower(trim(str_replace("/", "", $_REQUEST['x'])));
            if ((int) method_exists($this, $func) > 0) {
                if ($this->userService->isUserLogged($this->getUserSessionToken())) {
                    $this->$func();
                } else {
                    $this->response('', 401);
                }
            } else {
                $this->response('', 404);
            }
        }

        private function findUserQuestionaryResult() {
            $requestData = json_decode(file_get_contents("php://input"));
            $userQuestionaryResult = $this->resultService->findUserQuestionaryResult($requestData->userQuestionaryId);
            $this->response(json_encode($userQuestionaryResult),200);
            $this->response('',200);
        }
        
    }

$api = new ResultController();
$api->processApi();
?>