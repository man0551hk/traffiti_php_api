<?php
require_once("include.php");
require_once("db.php");
require_once("objectClass/country.php");

$data = array();
$sql = "select concat('http://image.traffiter.com/location/', location_id, '/', source) as image from sq_traffiter.location_image order by RAND() limit 20";

$result = mysql_query($sql) or die ($data = mysql_error());
while ($row = mysql_fetch_array($result)) {
    array_push($data, $row["image"]);
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


?>