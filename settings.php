<?php
$hostname = gethostname();
$setting =[];
$setting['mod'] = "Dev";
$setting['vendor_location'] = __DIR__."";
$setting['intsec'] = __DIR__."/../intsec/";

$pattern = "/ip-/i";
if( preg_match($pattern, $hostname) ){
    $setting['mod'] = "Pro";
}
if($setting['mod'] == "Dev"){
    $setting['vendor_location'] =  __DIR__."";
}
elseif($setting['mod'] == "Pro"){
    $setting['vendor_location'] = __DIR__."/../";
    $setting['intsec'] = __DIR__."/../../intsec/";
}



?>