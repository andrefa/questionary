<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../shared/Rest.inc.php");
require_once("../service/DashboardService.php");
require_once("../service/UserService.php");

    class DashboardController extends REST {

        public function __construct() {
            parent::__construct(); 
            $this->dashboardService = new DashboardService();
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

        private function listAvailableQuestionaries() {
            $loggedUserId = $this->userService->getLoggedUserId($this->getUserSessionToken());
            $availableQuestionaries = $this->dashboardService->listAvailableQuestionaries($loggedUserId);
            $this->response(json_encode($availableQuestionaries),200);
        }

        private function listExecutionHistory() {
            $loggedUserId = $this->userService->getLoggedUserId($this->getUserSessionToken());
            $executionHistory = $this->dashboardService->listExecutionHistory($loggedUserId);
            $this->response(json_encode($executionHistory),200);
        }

        private function createUserQuestionary() {
            $loggedUserId = $this->userService->getLoggedUserId($this->getUserSessionToken());
            $requestData = json_decode(file_get_contents("php://input"));

            $userQuestionaryId = $this->dashboardService->createUserQuestionary($loggedUserId, $requestData->questionaryId);

            $response = new stdClass();
            $response->userQuestionaryId = $userQuestionaryId;
            $this->response(json_encode($response),200);
        }
        
    }

$api = new DashboardController();
$api->processApi();
?>