<?php
if($_SERVER['HTTP_REFERER'] != "traffiter.com")
{
    // exit(); 
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // exit(); 
}
//
// header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$lang = $_POST["lang"];
if (!isset($_POST["lang"])) {
    $lang = "tc";
}

?>