<?php

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

require_once("../service/BaseService.php");
require_once("../dao/ResultDao.php");

    class ResultService extends BaseService {

        public function __construct() {
            $this->resultDao = new ResultDao();
        }

        public function findUserQuestionaryResult($userQuestionaryId) {
            return $this->resultDao->findUserQuestionaryResult($userQuestionaryId);
        }

    }

?>