<?php

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

require_once("../service/BaseService.php");
require_once("../dao/QuestionaryDao.php");

    class QuestionaryService extends BaseService {

        public function __construct() {
            $this->questionaryDao = new QuestionaryDao();
        }

        public function findUserQuestionary($userId, $userQuestionaryId) {
            return $this->questionaryDao->findUserQuestionary($userId, $userQuestionaryId);
        }

        public function updateTimeSpent($userQuestionaryId, $secondsSpent) {
            $this->questionaryDao->updateTimeSpent($userQuestionaryId, $secondsSpent);
        }

        public function saveUserQuestionary($userQuestionary) {
            $this->questionaryDao->saveUserQuestionary($userQuestionary);
        }

        public function calculateScore($userQuestionaryId) {
            $this->questionaryDao->calculateScore($userQuestionaryId);
        }

    }

?>