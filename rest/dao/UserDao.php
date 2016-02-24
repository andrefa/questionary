<?php
	include_once("BaseDao.php");

	class UserDao extends BaseDao {

		public function __construct() {
            parent::__construct();
        }

		public function findByLoginData($loginData) {
			$sql =  " SELECT user_id, full_name FROM user WHERE login = '$loginData->login' and password = '$loginData->password' and active = 1 ";
			$result =  $this->query($sql);
			$row = mysql_fetch_object($result);
 
			if ($row) {
				$user = new stdClass();
				$user->userId = $row->user_id;
				$user->fullName = $row->full_name;

				return $user;
			}

			return null;
		}

		public function findById($userId) {
			$sql =  " SELECT user_id, full_name FROM user WHERE user_id = $userId ";
			$result =  $this->query($sql);
			$row = mysql_fetch_object($result);

			if ($row) {
				$user = new stdClass();
				$user->userId = $row->user_id;
				$user->fullName = $row->full_name;

				return $user;
			}

			return null;
		}

		public function insert() {
			$this->user_id = "";

			$sql = "INSERT INTO user ( full_name,email,login,password,active,creation_date ) VALUES ( '$this->full_name','$this->email','$this->login','$this->password','$this->active','$this->creation_date' )";
			$result = $this->query($sql);
			// $this->user_id = mysql_insert_id($this->database->link);
		}

	}
?>