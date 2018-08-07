<?php

require_once("db.php");
require_once("objectClass/country.php");

$data = array();
$sql = "select * from country";

if(isset($_POST["keyword"])) {
    $text = $_POST["keyword"];
    $sql .= " where keyword like '%$text%'";
}
//$data = $sql;
$result = mysql_query($sql) or die ($data = mysql_error());
while ($row = mysql_fetch_array($result)) {
    $country = ""; 
    switch ($lang) {
        case "en": $country = $row["country_en"]; break;
        case "tc": $country = $row["country_tc"]; break;
        case "sc": $country = $row["country_sc"]; break;
    }
    $country = new country($row["country_id"], $country, $row["country_en"], $row["country_tc"], $row["country_sc"], 0, 0);
    array_push($data, $country);
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