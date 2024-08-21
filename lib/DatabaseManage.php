<?php
$serverName = "49.0.91.113,64433";
$userName = 'DevNwl';
$userPassword = 'Nwl!2563';
$dbName = "NWL_SpeedWayTest2";

$connectionInfo = array("Database"=>$dbName, "UID"=>$userName, "PWD"=>$userPassword, "MultipleActiveResultSets"=>true, "CharacterSet" => "UTF-8");

$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}


