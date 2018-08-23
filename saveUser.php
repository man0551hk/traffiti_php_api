<?php
require_once("include.php");
require_once("db.php");
require_once("objectClass/user.php");
$data = "";
if (isset($_POST["facebook_id"]) && isset ($_POST["first_name"]) && isset ($_POST["last_name"]) && isset($_POST["email"]))
{
  
  $first_name = $_POST["first_name"];
  $last_name= $_POST["last_name"];
  $email= $_POST["email"];
  $facebook_id = $_POST["facebook_id"];

  $query = "select user_id from user where email = '$email'";
  $result = mysql_query($query);
  $firstrow = mysql_fetch_assoc($result);
  if ($firstrow["user_id"] == 0) {
    $query = "insert into user (first_name, last_name, email, facebook_id, password, profile_image) values ('$first_name', '$last_name', '$email', '$facebook_id', '', '')";
    mysql_query($query);
    $user_id = mysql_insert_id();
    $data = new user($row["user_id"], '', '', '');
  }
  else {
    $data = new user($firstrow["user_id"], '', '', '');
  }


  mysql_free_result($result);

  $json = json_encode($data);
  if ($json === false) {

      $json = json_encode(array("jsonError", json_last_error_msg()));
      if ($json === false) {
          $json = '{"jsonError": "unknown"}';
      }
      http_response_code(500);
  }
  echo $json;

  
}

?>