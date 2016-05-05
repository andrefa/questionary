<?php
	include_once("BaseDao.php");

	class ResultDao extends BaseDao {

		public function __construct() {
            parent::__construct();
        }

        public function findUserQuestionaryResult($userId, $userQuestionaryId) {
        	$sql = " SELECT q.questionary_name, uq.seconds_spent, uq.score FROM user_questionary uq INNER JOIN questionary q ON uq.questionary_id=q.questionary_id where uq.user_questionary_id=$userQuestionaryId and uq.user_id = $userId and uq.score is not null ";
            $result =  $this->query($sql);
			$row = mysql_fetch_object($result);

			$userQuestionaryResult = new stdClass();
			if ($result) {
				$userQuestionaryResult->questionaryName = $row->questionary_name;
				$userQuestionaryResult->secondsSpent = $row->seconds_spent;
				$userQuestionaryResult->score = $row->score;
				$userQuestionaryResult->questions = array();

				$sql = " SELECT uqqa.question_id, q.question_description, correctqo.question_option_description correct_option, userqo.question_option_description user_option,
						( CASE
							WHEN uqqa.answered_question_option_id is null THEN qss.blank_score
							WHEN uqqa.answered_question_option_id = q.correct_question_option_id THEN qss.correct_score
							WHEN uqqa.answered_question_option_id <> q.correct_question_option_id THEN qss.wrong_score
							END) score
					from user_questionary_question_answer uqqa
					inner join question q on uqqa.question_id=q.question_id
					inner join question_score_setting qss on q.question_score_setting_id=qss.question_score_setting_id
					inner join question_option correctqo on q.correct_question_option_id=correctqo.question_option_id
					left join question_option userqo on uqqa.answered_question_option_id=userqo.question_option_id
					where user_questionary_id=$userQuestionaryId order by uqqa.question_id";

				$result =  $this->query($sql);
				$row = mysql_fetch_object($result);

				while($row) {
					$question = new stdClass();
					$question->questionId = $row->question_id;
					$question->questionDescription = utf8_encode($row->question_description);
					$question->correctOption = $row->correct_option;
					$question->userOption = $row->user_option;
					$question->score = $row->score;

					array_push($userQuestionaryResult->questions, $question);
					$row = mysql_fetch_object($result);
				}
			}

			return $userQuestionaryResult;
        }

	}
?>