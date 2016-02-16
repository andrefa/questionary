<?php
	class Database {
	 
		var $host;
		var $password;
		var $user;
		var $database;
		var $link;
		var $query;
		var $result;
		var $rows;
		 
		function Database() {
			$this->host = "localhost";
			$this->password = "";
			$this->user = "root";
			$this->database = "mydb";
			$this->rows = 0;
		}
		 
		function OpenLink() {
			$this->link = @mysql_connect($this->host,$this->user,$this->password) or die (print "Class Database: Error while connecting to DB (link)");
		}
		 
		function SelectDB() {
			@mysql_select_db($this->database,$this->link) or die (print "Class Database: Error while selecting DB");
		}
		 
		function CloseDB() {
			mysql_close();
		}
		 
		function Query($query) {
			$this->OpenLink();
			$this->SelectDB();
			$this->query = $query;
			$this->result = mysql_query($query,$this->link) or die (print "Class Database: Error while executing Query");
			 
			if(ereg("SELECT",$query)){
				$this->rows = mysql_num_rows($this->result);
			}
			 
			$this->CloseDB();
		}
	}
	
?>