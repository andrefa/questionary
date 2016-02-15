
<!-- begin of generated class -->
<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        QuestionOptions
* GENERATION DATE:  15.02.2016
* CLASS FILE:       /var/www/html/gen/generated_classes/class.QuestionOptions.php
* FOR MYSQL TABLE:  question_options
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

class QuestionOptions
{ // class : begin


// **********************
// ATTRIBUTE DECLARATION
// **********************

var $;   // KEY ATTR. WITH AUTOINCREMENT

var $question_id;   // (normal Attribute)
var $question_option_id;   // (normal Attribute)

var $database; // Instance of class database


// **********************
// CONSTRUCTOR METHOD
// **********************

function QuestionOptions()
{

$this->database = new Database();

}


// **********************
// GETTER METHODS
// **********************


function getquestion_id()
{
return $this->question_id;
}

function getquestion_option_id()
{
return $this->question_option_id;
}

// **********************
// SETTER METHODS
// **********************


function setquestion_id($val)
{
$this->question_id =  $val;
}

function setquestion_option_id($val)
{
$this->question_option_id =  $val;
}

// **********************
// SELECT METHOD / LOAD
// **********************

function select($id)
{

$sql =  "SELECT * FROM question_options WHERE  = $id;";
$result =  $this->database->query($sql);
$result = $this->database->result;
$row = mysql_fetch_object($result);


$this->question_id = $row->question_id;

$this->question_option_id = $row->question_option_id;

}

// **********************
// DELETE
// **********************

function delete($id)
{
$sql = "DELETE FROM question_options WHERE  = $id;";
$result = $this->database->query($sql);

}

// **********************
// INSERT
// **********************

function insert()
{
$this-> = ""; // clear key for autoincrement

$sql = "INSERT INTO question_options ( question_id,question_option_id ) VALUES ( '$this->question_id','$this->question_option_id' )";
$result = $this->database->query($sql);
$this-> = mysql_insert_id($this->database->link);

}

// **********************
// UPDATE
// **********************

function update($id)
{



$sql = " UPDATE question_options SET  question_id = '$this->question_id',question_option_id = '$this->question_option_id' WHERE  = $id ";

$result = $this->database->query($sql);



}


} // class : end

?>
<!-- end of generated class -->
