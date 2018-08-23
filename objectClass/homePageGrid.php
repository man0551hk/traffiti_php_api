<?php
class homePageGird {
    var $locationID;
    var $name;
    var $image;
    var $countryName;
    var $areaName;
    var $districtName;
    var $bookmarkID;

    function __construct( $locationID, $name,  $image, 
    $countryName, $areaName, $districtName,  $bookmarkID
    ) {
        $this->locationID = $locationID;
        $this->name = $name;
        $this->image = $image;
        $this->countryName = $countryName;
        $this->areaName = $areaName;
        $this->districtName = $districtName;
        $this->bookmarkID = $bookmarkID;
     }
}

?>