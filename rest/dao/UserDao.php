<?php
	include_once("../model/User.php");
	include_once("../util/Database.php");

	class UserDao {

		var $database;

		function UserDao() {
			$this->database = new Database();
		}

		function select($id) { // usar flag active no login
			$sql =  "SELECT * FROM user WHERE user_id = $id;";
			$result =  $this->database->query($sql);
			$result = $this->database->result;
			$row = mysql_fetch_object($result);

			$this->user_id = $row->user_id;
			$this->full_name = $row->full_name;
			$this->email = $row->email;
			$this->login = $row->login;
			$this->password = $row->password;
			$this->active = $row->active;
			$this->creation_date = $row->creation_date;
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