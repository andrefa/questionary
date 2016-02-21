<?php

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

require_once("../service/BaseService.php");
require_once("../dao/DashboardDao.php");

    class DashboardService extends BaseService {

        public function __construct() {
            $this->dashboardDao = new DashboardDao();
        }

        public function listAvailableQuestionaries($userId) {
            return $this->dashboardDao->listAvailableQuestionaries($userId);
        }

        public function listExecutionHistory($userId) {
            return $this->dashboardDao->listExecutionHistory($userId);
        }

        public function createUserQuestionary($userId, $questionaryId) {
            return $this->dashboardDao->createUserQuestionary($userId, $questionaryId);
        }

    }

?>