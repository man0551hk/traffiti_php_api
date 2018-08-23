<?php
class user {
    var $userID;
    var $fistName;
    var $lastName;
    var $profileImage;

    function __construct( $userID, $fistName,  $lastName, $profileImage
    ) {
        $this->userID = $userID;
        $this->fistName = $fistName;
        $this->lastName = $lastName;
        $this->profileImage = $profileImage;
     }
}

?>