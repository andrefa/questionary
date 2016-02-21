<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../shared/Rest.inc.php");
require_once("../service/QuestionaryService.php");
require_once("../service/UserService.php");

    class QuestionaryController extends REST {

        public function __construct() {
            parent::__construct(); 
            $this->questionaryService = new QuestionaryService();
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

        private function findUserQuestionary() {
            $loggedUserId = $this->userService->getLoggedUserId($this->getUserSessionToken());
            $requestData = json_decode(file_get_contents("php://input"));

            $userQuestionary = $this->questionaryService->findUserQuestionary($loggedUserId, $requestData->userQuestionaryId);
            $this->response(json_encode($userQuestionary),200);
        }

        private function updateTimeSpent() {
            $requestData = json_decode(file_get_contents("php://input"));

            $this->questionaryService->updateTimeSpent($requestData->userQuestionaryId, $requestData->secondsSpent);
            $this->response('',200);
        }

        private function saveAndCalculateScore() {
            $userQuestionary = json_decode(file_get_contents("php://input"));

            $this->questionaryService->saveUserQuestionary($userQuestionary);
            $this->questionaryService->calculateScore($userQuestionary->userQuestionaryId);
            $this->response('',200);
        }

        private function save() {
            $userQuestionary = json_decode(file_get_contents("php://input"));

            $this->questionaryService->saveUserQuestionary($userQuestionary);
            $this->response('',200);
        }
        
    }

$api = new QuestionaryController();
$api->processApi();
?>