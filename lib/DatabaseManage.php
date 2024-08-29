<?php

// $serverName = "85.204.247.82,64433"; //IP NWL

$serverName = "10.140.12.14,1433";
$userName = 'DevNwl'; 
$userPassword = 'Nwl!2563';
$dbName = "NWL_SpeedWayTest2";

$connectionInfo = array("Database"=>$dbName, "UID"=>$userName, "PWD"=>$userPassword, "MultipleActiveResultSets"=>true, "CharacterSet" => "UTF-8");

$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}


