<?php
	include_once("../model/AdminUser.php");
	include_once("../util/Database.php");

	class AdminUserDao {

		var $database;

		function AdminUserDao() {
			$this->database = new Database();
		}

		function select($id) {
			$adminUser = new AdminUser();
			$sql =  "SELECT * FROM admin_user WHERE admin_user_id = $id;";
			$result =  $this->database->query($sql);
			$result = $this->database->result;
			$row = mysql_fetch_object($result);

			$adminUser->adminUserId=$row->admin_user_id;
			$adminUser->fullName=$row->full_name;
			$adminUser->email=$row->email;
			$adminUser->login=$row->login;
			$adminUser->password=$row->password;
			$adminUser->creationDate=$row->creation_date;

			return $adminUser;
		}

		function delete($id) {
			$sql = "DELETE FROM admin_user WHERE admin_user_id = $id;";
			$this->database->query($sql);
		}

		function insert($adminUser) {
			$adminUser->admin_user_id = "";

			$sql = "INSERT INTO admin_user ( full_name,email,login,password) VALUES ( '$adminUser->getFullName()','$adminUser->getEmail()','$adminUser->getLogin()','$adminUser->getPassword()')";
			$this->database->query($sql);
			$adminUser->setAdminUserId(mysql_insert_id($this->database->link));

			return $adminUser;
		}

		function update($adminUser) {
			$sql = "UPDATE admin_user SET  full_name = '$adminUser->getFullName()',email = '$adminUser->getEmail()',login = '$adminUser->getLogin()',password = '$adminUser->getPassword()'' WHERE admin_user_id = $adminUser.getAdminUserId()";
			$this->database->query($sql);
		}
	}

?>