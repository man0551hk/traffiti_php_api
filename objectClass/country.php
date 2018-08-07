<?php
class country {
    var $countryID;
    var $countryName;
    var $countryNameEn;
    var $countryNameTc;
    var $countryNameSc;
    var $lat;
    var $lng;

    function __construct( $countryID, $countryName,  $countryNameEn, 
    $countryNameTc, $countryNameSc, $lat, $lng
    ) {
        $this->countryID = $countryID;
        $this->countryName = $countryName;
        $this->countryNameEn = $countryNameEn;
        $this->countryNameTc = $countryNameTc;
        $this->countryNameSc = $countryNameSc;
        $this->lat = $lat;
        $this->lng = $lng;
     }
}

?>