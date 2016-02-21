<?php
	include_once("BaseDao.php");

	class DashboardDao extends BaseDao {

		public function __construct() {
            parent::__construct();
        }

		public function listAvailableQuestionaries($userId) {
			$sql =  " SELECT q.questionary_id, q.questionary_name, q.question_count FROM user_available_questionary uaq INNER JOIN questionary q ON uaq.questionary_id = q.questionary_id WHERE uaq.user_id = $userId ";
			$result =  $this->query($sql);
			$row = mysql_fetch_object($result);

			$availableQuestionaries = array();
			while ($row) {
				$questionary = new stdClass();
				$questionary->questionaryId = $row->questionary_id;
				$questionary->questionaryName = $row->questionary_name;
				$questionary->questionCount = $row->question_count;

				array_push($availableQuestionaries, $questionary);

				$row = mysql_fetch_object($result);
			}

			return $availableQuestionaries;
		}

		public function listExecutionHistory($userId) {
			$sql =  " SELECT uq.user_questionary_id, q.questionary_name, q.question_count, uq.score, uq.seconds_spent FROM user_questionary uq INNER JOIN questionary q ON uq.questionary_id = q.questionary_id WHERE uq.user_id = $userId ";
			$result =  $this->query($sql);
			$row = mysql_fetch_object($result);

			$executionHistory = array();
			while ($row) {
				$execution = new stdClass();
				$execution->userQuestionaryId = $row->user_questionary_id;
				$execution->questionaryName = $row->questionary_name;
				$execution->questionCount = $row->question_count;
				$execution->score = $row->score;
				$execution->secondsSpent = $row->seconds_spent;
				$execution->finished = $row->score != null;

				array_push($executionHistory, $execution);

				$row = mysql_fetch_object($result);
			}

			return $executionHistory;
		}

		public function createUserQuestionary($userId, $questionaryId) {
			$sql = "INSERT INTO user_questionary ( user_id, questionary_id ) VALUES ($userId, $questionaryId)";
			$result = $this->query($sql);
			$userQuestionaryId = mysql_insert_id($this->link);

			$sql =  " SELECT qq.question_id FROM questionary_question qq WHERE qq.questionary_id=$questionaryId ";
			$result =  $this->query($sql);
			$row = mysql_fetch_object($result);

			while ($row) {
				$questionId = $row->question_id;
				
				$sql = "INSERT INTO user_questionary_question_answer ( user_questionary_id, question_id ) VALUES ($userQuestionaryId, $questionId)";
				$this->query($sql);

				$row = mysql_fetch_object($result);
			}

			return $userQuestionaryId;
		}

	}
?>