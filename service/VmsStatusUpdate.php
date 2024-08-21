<?php

$XVVmsCode = $_REQUEST['XVVmsCode'];
$XISensorType = $_REQUEST['XISensorType'];
$XIValue= $_REQUEST['XIValue'];
 $serverName = "10.12.12.205";
      $userName = 'DevNwl';
      $userPassword = 'Nwl!2563';
      $dbName = "NWL_SpeedWayTest2";

          $connectionInfo = array("Database"=>$dbName, "UID"=>$userName, "PWD"=>$userPassword, "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');
          $conn = sqlsrv_connect( $serverName, $connectionInfo);

$sql = "SELECT XVVmsCode
FROM            TMstMItmVMS_Status
WHERE        (XVVmsCode = '$XVVmsCode') AND (XISensorType = $XISensorType)";

$stmt= sqlsrv_query($conn, $sql);

if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
}
$countsensortype=0;
while($result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
{
    $countsensortype++;
}

if($countsensortype==0){
    $sql="INSERT INTO TMstMItmVMS_Status (XVVmsCode, XISensorType, XIValue, XTWhenUpdate)VALUES ('$XVVmsCode', '$XISensorType', $XIValue, GETDATE());";
    sqlsrv_query($conn, $sql);
}else{
    $sql="UPDATE TMstMItmVMS_Status set 
                XIValue=$XIValue,
                XTWhenUpdate=GETDATE() 
          WHERE  (XVVmsCode = '$XVVmsCode') AND (XISensorType = $XISensorType)";
    
    sqlsrv_query($conn, $sql);
}

sqlsrv_close( $conn );
?>