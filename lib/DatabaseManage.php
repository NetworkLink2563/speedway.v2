<?php
$serverName = "10.12.12.206";
$userName = 'DevNwl';
$userPassword = 'Nwl!2563';
$dbName = "NWL_SpeedWayTest2";

$connectionInfo = array("Database"=>$dbName, "UID"=>$userName, "PWD"=>$userPassword, "MultipleActiveResultSets"=>true, "CharacterSet" => "UTF-8");

$conn = sqlsrv_connect( $serverName, $connectionInfo);



