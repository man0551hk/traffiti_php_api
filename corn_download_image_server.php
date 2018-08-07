<?php
$hostName = "localhost";
$userName = "sq_traffiter";
$password = "78134698Aa";
$dbName = "sq_traffiter";
mysql_connect($hostName, $userName, $password) or die("Unable to connect to host $hostName");
mysql_select_db($dbName) or die("Unable to select database $dbName");
mysql_query("SET NAMES 'utf8'");

$result = mysql_query("select id, image_order, location_id, source from pending_image limit 10");
while($row = mysql_fetch_array($result))
{
    $id = $row["id"];
    $location_id = $row["location_id"];
    $source = $row["source"];
    $image_order = $row["image_order"];

    // echo $id."<br/>";
    // echo $location_id."<br/>";
    // echo $source."<br/>";
    // echo $image_order."<br/>";

    //$path = __DIR__.DIRECTORY_SEPARATOR.'location'.DIRECTORY_SEPARATOR.$location_id."<br/>";
    $path = $location_id;

    echo $path."<br/>";
    if (!file_exists($path))
    {
        if (!mkdir($path , 0777, true)) {
            $error = error_get_last();
            echo $error['message'];
            die('Failed to create folders...');
        }
    }
    // $randomName = generateRandomString(10);
    // $temp = explode(".", $source);
    // $extension = end($temp);
    // $image = file_get_contents($source);
    // $newImageName = $location_id.'_'.$image_order.'_'.$randomName.'.'.$extension;
    // echo $newImageName."<br/>";
    // file_put_contents($path.'/'.$newImageName, $image); //Where to save the image on your server
    // $error = error_get_last();
    // echo $error['message'];

    // mysql_query("insert into location_image (location_id, source) values ('$location_id', '$newImageName')");

    // mysql_query("delete from pending_image where id = '$id'");
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
