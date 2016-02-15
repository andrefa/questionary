
<!-- begin of generated class -->
<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        QuestionScoreSetting
* GENERATION DATE:  15.02.2016
* CLASS FILE:       /var/www/html/gen/generated_classes/class.QuestionScoreSetting.php
* FOR MYSQL TABLE:  question_score_setting
* FOR MYSQL DB:     mydb
* -------------------------------------------------------
* CODE GENERATED BY:
* MY PHP-MYSQL-CLASS GENERATOR
* from: >> www.voegeli.li >> (download for free!)
* -------------------------------------------------------
*
*/

include_once("resources/class.database.php");

// **********************
// CLASS DECLARATION
// **********************

class QuestionScoreSetting
{ // class : begin


// **********************
// ATTRIBUTE DECLARATION
// **********************

var $question_score_setting_id;   // KEY ATTR. WITH AUTOINCREMENT

var $correct_score;   // (normal Attribute)
var $wrong_score;   // (normal Attribute)
var $blank_score;   // (normal Attribute)
var $creation_date;   // (normal Attribute)

var $database; // Instance of class database


// **********************
// CONSTRUCTOR METHOD
// **********************

function QuestionScoreSetting()
{

$this->database = new Database();

}


// **********************
// GETTER METHODS
// **********************


function getquestion_score_setting_id()
{
return $this->question_score_setting_id;
}

function getcorrect_score()
{
return $this->correct_score;
}

function getwrong_score()
{
return $this->wrong_score;
}

function getblank_score()
{
return $this->blank_score;
}

function getcreation_date()
{
return $this->creation_date;
}

// **********************
// SETTER METHODS
// **********************


function setquestion_score_setting_id($val)
{
$this->question_score_setting_id =  $val;
}

function setcorrect_score($val)
{
$this->correct_score =  $val;
}

function setwrong_score($val)
{
$this->wrong_score =  $val;
}

function setblank_score($val)
{
$this->blank_score =  $val;
}

function setcreation_date($val)
{
$this->creation_date =  $val;
}

// **********************
// SELECT METHOD / LOAD
// **********************

function select($id)
{

$sql =  "SELECT * FROM question_score_setting WHERE question_score_setting_id = $id;";
$result =  $this->database->query($sql);
$result = $this->database->result;
$row = mysql_fetch_object($result);


$this->question_score_setting_id = $row->question_score_setting_id;

$this->correct_score = $row->correct_score;

$this->wrong_score = $row->wrong_score;

$this->blank_score = $row->blank_score;

$this->creation_date = $row->creation_date;

}

// **********************
// DELETE
// **********************

function delete($id)
{
$sql = "DELETE FROM question_score_setting WHERE question_score_setting_id = $id;";
$result = $this->database->query($sql);

}

// **********************
// INSERT
// **********************

function insert()
{
$this->question_score_setting_id = ""; // clear key for autoincrement

$sql = "INSERT INTO question_score_setting ( correct_score,wrong_score,blank_score,creation_date ) VALUES ( '$this->correct_score','$this->wrong_score','$this->blank_score','$this->creation_date' )";
$result = $this->database->query($sql);
$this->question_score_setting_id = mysql_insert_id($this->database->link);

}

// **********************
// UPDATE
// **********************

function update($id)
{



$sql = " UPDATE question_score_setting SET  correct_score = '$this->correct_score',wrong_score = '$this->wrong_score',blank_score = '$this->blank_score',creation_date = '$this->creation_date' WHERE question_score_setting_id = $id ";

$result = $this->database->query($sql);



}


} // class : end

?>
<!-- end of generated class -->
