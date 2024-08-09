<?php
$serverName = "49.0.91.113,64433"; 
$dbName="NWL_SpeedWayTest2";
$userName="DevNwl";
$userPwd="Nwl!2563";
$connectionOptions = array(
    "Database" => $dbName,
    "Uid" => $userName,
    "PWD" => $userPwd
);
// Establishes the connection

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn) {
   // echo "Connection established.";
} else {
 //   echo "Connection could not be established.";
   // die(print_r(sqlsrv_errors(), true));
}

   
?>