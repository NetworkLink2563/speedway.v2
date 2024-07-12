<?php

ob_start();
session_start();
include "DatabaseManage.php";
include "MqttSend.php";
//include "function_VMS.php";
//include "lib/centerservice.php";
$vmsID=$_POST['vmsID'];
$time=$_POST['time'];
$radiobutton=$_POST['radiobutton'];
$mon=$_POST['mon'];
$tue=$_POST['tue'];
$wed=$_POST['wed'];
$thu=$_POST['thu'];
$fri=$_POST['fri'];
$sat=$_POST['sat'];
$sun=$_POST['sun'];
$myRange=$_POST['myRange'];
if($radiobutton==0){
    $value='0';
}elseif($radiobutton==1){
    $value=$myRange;
}
if($mon=='true'){ $mon=1; }else{ $mon=0; }
if($tue=='true'){ $tue=1; }else{ $tue=0; }
if($wed=='true'){ $wed=1; }else{ $wed=0; }
if($thu=='true'){ $thu=1; }else{ $thu=0; }
if($fri=='true'){ $fri=1; }else{ $fri=0; }
if($sat=='true'){ $sat=1; }else{ $sat=0; }
if($sun=='true'){ $sun=1; }else{ $sun=0; }
$ProcedSQL = "DECLARE @tCode nvarchar(100)
EXEC dbo. STP_NWLtGetMaxCode 'TDocTCmdSchedule', @tCode OUTPUT
PRINT 'TDocTCmdSchedule' + '-->' + @tCode
";
$queryProcedSQL = sqlsrv_query($conn, $ProcedSQL);
$resultProcedSQL = sqlsrv_fetch_array($queryProcedSQL, SQLSRV_FETCH_ASSOC);

$stmtInsert = "INSERT INTO TDocTCmdSchedule (XVSccDocNo,XDSccDocDate,XTSccDocTime,XVVmsCode,XVCmdCode,XBSccIsSchedule,XTSccStart,XTSccEnd,XVSccActiveTime,XBSccIsDone,XBSccIsActive,XVSccValue,XTSccDocDoneTime,XBSccIsSun,XBSccIsMon,XBSccIsTue,XBSccIsWed,XBSccIsThu,XBSccIsFri,XBSccIsSat,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '" . $resultProcedSQL['ptCode'] . "','" . date('Y-m-d') . "','".date('Y-m-d H:i:s')."','" . $vmsID . "','001','1','','','".$time."','0','1','".$value."','','".$sun."','".$mon."','".$tue."','".$wed."','".$thu."','".$fri."','".$sat."','".$_SESSION['userName']."','','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";

$stmt = sqlsrv_query($conn, $stmtInsert);
if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
}else{
   $topic='Center/Service/'.$vmsID;
   $data='{"cmd":"01"}';
   echo mqttsend($topic,$data);
}
//$response=callAPICOM($vmsID);
//echo $response;

