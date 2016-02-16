<?php

class Question
{ // class : begin

var $question_id;   // KEY ATTR. WITH AUTOINCREMENT

var $question_description;   // (normal Attribute)
var $seconds_to_answer;   // (normal Attribute)
var $correct_question_option_id;   // (normal Attribute)
var $question_score_setting_id;   // (normal Attribute)
var $creation_date;   // (normal Attribute)

function select($id)
{

$sql =  "SELECT * FROM question WHERE question_id = $id;";
$result =  $this->database->query($sql);
$result = $this->database->result;
$row = mysql_fetch_object($result);


$this->question_id = $row->question_id;

$this->question_description = $row->question_description;

$this->seconds_to_answer = $row->seconds_to_answer;

$this->correct_question_option_id = $row->correct_question_option_id;

$this->question_score_setting_id = $row->question_score_setting_id;

$this->creation_date = $row->creation_date;

}

function delete($id)
{
$sql = "DELETE FROM question WHERE question_id = $id;";
$result = $this->database->query($sql);

}

function insert()
{
$this->question_id = ""; // clear key for autoincrement

$sql = "INSERT INTO question ( question_description,seconds_to_answer,correct_question_option_id,question_score_setting_id,creation_date ) VALUES ( '$this->question_description','$this->seconds_to_answer','$this->correct_question_option_id','$this->question_score_setting_id','$this->creation_date' )";
$result = $this->database->query($sql);
$this->question_id = mysql_insert_id($this->database->link);

}

function update($id)
{



$sql = " UPDATE question SET  question_description = '$this->question_description',seconds_to_answer = '$this->seconds_to_answer',correct_question_option_id = '$this->correct_question_option_id',question_score_setting_id = '$this->question_score_setting_id',creation_date = '$this->creation_date' WHERE question_id = $id ";

$result = $this->database->query($sql);



}


} // class : end

?>