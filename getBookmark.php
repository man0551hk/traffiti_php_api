<?php
require_once("include.php");
require_once("db.php");
require_once("objectClass/homePageGrid.php");
$data = [];
if (isset($_POST["userID"]) && isset($_POST["countryID"]))
{
    $userID = $_POST["userID"];
    $countryID = $_POST["countryID"];

    $query = "select 
    l.location_id,
    case  '$lang' when 'en' then l.name_en when 'tc' then l.name_tc when 'sc' then l.name_sc end as name,
    case  '$lang' when 'en' then c.country_en when 'tc' then c.country_tc when 'sc' then c.country_sc end as country,
    case  '$lang' when 'en' then a.area_en when 'tc' then a.area_tc when 'sc' then a.area_sc end as area,
    case  '$lang' when 'en' then d.district_en when 'tc' then d.district_tc when 'sc' then d.district_sc end as district,
    (select source from sq_traffiter.location_image i where i.location_id = l.location_id and i.source is not null and i.source != '' order by image_id limit 1) as source,
    b.bookmark_id
    from location l
    inner join country c on l.country_id = c.country_id and c.country_id = '$countryID'
    inner join area a on l.area_id = a.area_id
    inner join district d on l.district_id = d.district_id
    inner join bookmark b on l.location_id = b.location_id and b.user_id = '$userID'";
    $result = mysql_query($query) or die ($data = mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $homepageGrid = new homePageGird($row["location_id"], $row["name"], 
        'https://'.$imageDomain.'/location/' . $row["location_id"] .'/'. $row["source"],
        $row["country"], $row["area"], $row["district"], $row["bookmark_id"]);
    
        array_push($data, $homepageGrid);
    }
    
    mysql_free_result($result);
}
else {
    array_push($data, 'empty');
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