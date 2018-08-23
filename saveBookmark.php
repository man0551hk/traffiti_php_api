<?php
require_once("include.php");
require_once("db.php");
if (isset($_POST["locationID"]) && isset ($_POST["userID"]))
{
    $locationID = $_POST["locationID"];
    $userID = $_POST["userID"];
    $query = "select bookmark_id from bookmark where location_id = '$locationID' and user_id = '$userID'";
    $result = mysql_query($query);
    $firstrow = mysql_fetch_assoc($result);
    if ($firstrow["bookmark_id"] == 0) {
        $query = "insert into bookmark (location_id, plan_id, user_id) values ('$locationID', 0, '$userID')";
        $result = mysql_query($query);
        $bookmark_id = mysql_insert_id();
            
        if ($bookmark_id > 0) {
            $data = 'success';
        } 
    } else {
        $data =  'already bookmarked';
    }
} else if (isset($_POST["planID"]) && isset ($_POST["userID"]))
{
    $planID = $_POST["planID"];
    $userID = $_POST["userID"];
    $query = "select bookmark_id from bookmark where plan_id = '$planID' and user_id = '$user_id'";
    $result = mysql_query($query);
    $firstrow = mysql_fetch_assoc($result);
    if ($firstrow["bookmark_id"] == 0) {
        $query = "insert into bookmark (location_id, plan_id, user_id) values (0, '$planID', '$userID')";
        $result = mysql_query($query);
        $bookmark_id = mysql_insert_id();
            
        if ($bookmark_id > 0) {
            $data =  'success';
        } 
    } else {
        $data =  'already bookmarked';
    }
}

$json = json_encode($data);
if ($json === false) {

    $json = json_encode(array("jsonError", json_last_error_msg()));
    if ($json === false) {
        $json = '{"jsonError": "unknown"}';
    }
    http_response_code(500);
}
echo $json;
?>