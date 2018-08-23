<?php
require_once("include.php");
require_once("db.php");
require_once("objectClass/homePageGrid.php");

$userID = 0;
$locationID = 0;
if (isset($_POST["userID"]))
{
    $userID = $_POST["userID"];
}
if (isset($_POST["locationID"]))
{
    $locationID = $_POST["locationID"];
}


$sql = "select 
l.location_id,
case  '$lang' when 'en' then l.name_en when 'tc' then l.name_tc when 'sc' then l.name_sc end as name,
case  '$lang' when 'en' then c.country_en when 'tc' then c.country_tc when 'sc' then c.country_sc end as country,
case  '$lang' when 'en' then a.area_en when 'tc' then a.area_tc when 'sc' then a.area_sc end as area,
case  '$lang' when 'en' then d.district_en when 'tc' then d.district_tc when 'sc' then d.district_sc end as district,
case isnull(b.bookmark_id) when true then 0 else b.bookmark_id end as bookmark_id
from location l
inner join country c on l.country_id = c.country_id
inner join area a on l.area_id = a.area_id
inner join district d on l.district_id = d.district_id
left outer join bookmark b on l.location_id = b.location_id and b.user_id = '$userID'
where 
l.location_id  = '$locationID'";


$result = mysql_query($sql) or die ($data = mysql_error());
while ($row = mysql_fetch_array($result)) {
    $homepageGrid = new homePageGird($row["location_id"], $row["name"], null,

    $row["country"], $row["area"], $row["district"], $row["bookmark_id"]);

    //array_push($data, $homepageGrid);
}

$image_array = array();
$query = "select source from location_image i where i.location_id ='$locationID'";
$result = mysql_query($query) or die ($data = mysql_error());
while ($row = mysql_fetch_array($result)) {
    array_push($image_array, 'https://'.$imageDomain.'/location/' . $locationID .'/'. $row["source"]);
}
$homepageGrid->image = $image_array;
mysql_free_result($result);
$data = $homepageGrid;
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