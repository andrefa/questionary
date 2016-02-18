<?php
	include_once("../model/User.php");
	include_once("../shared/Database.php");

	class UserDao {

		var $database;

		function UserDao() {
			$this->database = new Database();
		}

		public function findByLoginData($loginData) {
			$sql =  " SELECT user_id, full_name FROM user WHERE login = '$loginData->login' and password = '$loginData->password' and active = 1 ";
			$result =  $this->database->query($sql);
			$result = $this->database->result;
			$row = mysql_fetch_object($result);

			if ($row) {
				$user = new stdClass();
				$user->userId = $row->user_id;
				$user->fullName = $row->full_name;

				return $user;
			}
			return null;
		}

		public function findById($id) {
			$sql =  " SELECT user_id, full_name FROM user WHERE user_id = $id ";
			$result =  $this->database->query($sql);
			$result = $this->database->result;
			$row = mysql_fetch_object($result);

			if ($row) {
				$user = new stdClass();
				$user->userId = $row->user_id;
				$user->fullName = $row->full_name;

				return $user;
			}
			return null;
		}

		function delete($id) {
			$sql = "DELETE FROM user WHERE user_id = $id;";
			$result = $this->database->query($sql);
		}

		function insert() {
			$this->user_id = "";

			$sql = "INSERT INTO user ( full_name,email,login,password,active,creation_date ) VALUES ( '$this->full_name','$this->email','$this->login','$this->password','$this->active','$this->creation_date' )";
			$result = $this->database->query($sql);
			$this->user_id = mysql_insert_id($this->database->link);
		}

		function update($id) {
			$sql = " UPDATE user SET  full_name = '$this->full_name',email = '$this->email',login = '$this->login',password = '$this->password',active = '$this->active',creation_date = '$this->creation_date' WHERE user_id = $id ";

			$result = $this->database->query($sql);
		}
	}
?>