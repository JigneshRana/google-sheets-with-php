<?php
$hostname = gethostname();
$ENVMOD = "Dev";
$VENDOR_LOCATION = __DIR__."";
$INTSEC = __DIR__."/../intsec/";

$pattern = "/ip-/i";
if( preg_match($pattern, $hostname) ){
    $ENVMOD = "Pro";
}
if($ENVMOD == "Dev"){
    $VENDOR_LOCATION =  __DIR__."";
}
elseif($ENVMOD == "Pro"){
    $VENDOR_LOCATION = __DIR__."/../";
    $INTSEC = __DIR__."/../../intsec/";
}



?>