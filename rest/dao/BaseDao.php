<?php

	class BaseDao {
	 
		var $host;
		var $password;
		var $user;
		var $database;
		var $link;
		var $rows;
		
		public function __construct() {
			$this->host = "cpmy0130.servidorwebfacil.com";
			$this->password = "gajbr_appinfo";
			$this->user = "gajbr_appinfo";
			$this->database = "gajbr_app_info";
			$this->rows = 0;
		}
		 
		public function Query($query) {
			$this->OpenLink();
			$this->SelectDB();
			$result = mysql_query($query,$this->link) or die (print "Class Database: Error while executing Query");
			 
			if(preg_match("/SELECT/",$query)){
				$this->rows = mysql_num_rows($result);
			}
			 
			$this->CloseDB();

			return $result;
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

	}
	
?>