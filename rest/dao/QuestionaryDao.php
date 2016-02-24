<?php
	include_once("BaseDao.php");

	class QuestionaryDao extends BaseDao {

		public function __construct() {
            parent::__construct();
        }

        public function findUserQuestionary($userId, $userQuestionaryId) {
        	$sql = " SELECT uq.user_questionary_id, q.questionary_name, uq.seconds_spent FROM user_questionary uq INNER JOIN questionary q ON uq.questionary_id=q.questionary_id where uq.user_questionary_id=$userQuestionaryId and uq.user_id=$userId and uq.score is null ";
            $userQuestionaryResult =  $this->query($sql);
			$userQuestionaryRow = mysql_fetch_object($userQuestionaryResult);

			$userQuestionary = null;
			if ($userQuestionaryRow) {
				$userQuestionary = new stdClass();

				$userQuestionary->userQuestionaryId = $userQuestionaryRow->user_questionary_id;
				$userQuestionary->questionaryName = $userQuestionaryRow->questionary_name;
				$userQuestionary->secondsSpent = $userQuestionaryRow->seconds_spent;
				$userQuestionary->questions = array();
				
				$sql = " SELECT eqqa.user_questionary_question_answer_id, q.question_id, q.question_description, eqqa.answered_question_option_id FROM user_questionary_question_answer eqqa INNER JOIN question q ON eqqa.question_id=q.question_id where eqqa.user_questionary_id=$userQuestionaryId ";
				$questionsResult =  $this->query($sql);
				$questionRow = mysql_fetch_object($questionsResult);

				while($questionRow) {
					$question = new stdClass();
					$question->userQuestionaryQuestionAnswerId = $questionRow->user_questionary_question_answer_id;
					$question->questionId = $questionRow->question_id;
					$question->questionDescription = utf8_encode($questionRow->question_description);
					$question->answeredQuestionOptionId = $questionRow->answered_question_option_id;
					$question->questionOptions = array();
					$questionId = $questionRow->question_id;

					$sql = " SELECT qo.question_option_id, qo.question_option_description FROM question_available_option qao INNER JOIN question_option qo ON qao.question_option_id=qo.question_option_id WHERE qao.question_id=$questionId ";
					$questionsOptionResult =  $this->query($sql);
					$questionOptionRow = mysql_fetch_object($questionsOptionResult);

					while($questionOptionRow) {
						$questionOption = new stdClass();
						$questionOption->questionOptionId = $questionOptionRow->question_option_id;
						$questionOption->questionOptionDescription = $questionOptionRow->question_option_description;

						array_push($question->questionOptions, $questionOption);
						$questionOptionRow = mysql_fetch_object($questionsOptionResult);
					}

					array_push($userQuestionary->questions, $question);
					$questionRow = mysql_fetch_object($questionsResult);
				}
			}

			return $userQuestionary;
        }

        public function updateTimeSpent($userQuestionaryId, $secondsSpent) {
        	$sql = " UPDATE user_questionary SET seconds_spent=$secondsSpent WHERE user_questionary_id=$userQuestionaryId ";
            $this->query($sql);
        }

        public function saveUserQuestionary($userQuestionary) {
        	foreach ($userQuestionary->questions as $question) {
        		if(!$question->answeredQuestionOptionId) {
        			$question->answeredQuestionOptionId = "null";
        		}

        		$sql = " UPDATE user_questionary_question_answer SET answered_question_option_id = $question->answeredQuestionOptionId WHERE user_questionary_question_answer_id = $question->userQuestionaryQuestionAnswerId ";
        		$this->query($sql);
        	}
        }

        public function calculateScore($userQuestionaryId) {
        	$sql = " SELECT SUM( CASE 
						WHEN eqqa.answered_question_option_id is null THEN qss.blank_score
						WHEN eqqa.answered_question_option_id = q.correct_question_option_id THEN qss.correct_score
						WHEN eqqa.answered_question_option_id <> q.correct_question_option_id THEN qss.wrong_score
						END) score
				FROM user_questionary_question_answer eqqa 
				INNER JOIN question q ON eqqa.question_id=q.question_id 
				INNER JOIN question_score_setting qss ON q.question_score_setting_id=qss.question_score_setting_id
				WHERE eqqa.user_questionary_id = $userQuestionaryId ";


			$result =  $this->query($sql);
			$row = mysql_fetch_object($result);
			$score = $row->score;
			if ($score < 0) {
				$score = 0;
			}

			$sql = " UPDATE user_questionary SET score = $score WHERE user_questionary_id=$userQuestionaryId ";
			$this->query($sql);
        }

	}
?>