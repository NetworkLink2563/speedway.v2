<?php

ob_start();
session_start();
include "DatabaseManage.php";
include "MqttSend.php";
$vmscode=$_POST["vmsID"];

//echo $vmscode;

$sql="SELECT        COUNT(XVVmsCode) AS Expr1, XVVmsCode
FROM            dbo.TMstMItmVMSMessage
GROUP BY XVVmsCode
HAVING        (XVVmsCode = '$vmscode')";

$count=0;
$query = sqlsrv_query($conn, $sql);
while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
  $count++;
}

if($count>0){
    $topic=$vmscode.'_Display'; 
    $data='{"cmd":"01"}';
    echo mqttsend($topic,$data);
}else{
    echo "nodata";
}



/*
$sql = "DECLARE @tCode nvarchar(100)
  EXEC dbo. STP_NWLtGetMaxCode 'TDocTCmdSchedule', @tCode OUTPUT
  PRINT 'TDocTCmdSchedule' + '-->' + @tCode";
$query = sqlsrv_query($conn, $sql);
$result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
$runcode = $result['ptCode'];

$sqlInsert = "INSERT INTO TDocTCmdSchedule (XVSccDocNo,XDSccDocDate,XTSccDocTime,XVVmsCode,XVCmdCode,XBSccIsSchedule,XTSccStart,XTSccEnd,XBSccIsDone,XBSccIsActive,XVSccValue,XTSccDocDoneTime,XBSccIsSun,XBSccIsMon,XBSccIsTue,XBSccIsWed,XBSccIsThu,XBSccIsFri,XBSccIsSat,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
  SELECT '".$runcode."','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','".$vmscode."','007',0,NULL,NULL,0,1,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
$queryUpdate = sqlsrv_query($conn, $sqlInsert);
$response=callAPIDisplay($vmscode);
$return=$response['RETURN'];
insertLogVMS($vmscode,$_SESSION['userName'],'BRIGHT','ส่งคำสั่งความสว่างอัตโนมัติ: '.$return,$runcode);
echo $sqlInsert;
*/
//echo "OK";