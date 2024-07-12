<?php
ob_start();
session_start();
include "DatabaseManage.php";
include "function_VMS.php";

$vmscode=$_POST["vmscode"];
$valueBrightness=$_POST["valueBrightness"];
$option=$_POST["option"];

if ($option==11){
    $sql = "DECLARE @tCode nvarchar(100)
  EXEC dbo. STP_NWLtGetMaxCode 'TDocTCmdSchedule', @tCode OUTPUT
  PRINT 'TDocTCmdSchedule' + '-->' + @tCode";
      $query = sqlsrv_query($conn, $sql);
      $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
      $runcode = $result['ptCode'];

      $sqlInsert = "INSERT INTO TDocTCmdSchedule (XVSccDocNo,XDSccDocDate,XTSccDocTime,XVVmsCode,XVCmdCode,XBSccIsSchedule,XTSccStart,XTSccEnd,XBSccIsDone,XBSccIsActive,XVSccValue,XTSccDocDoneTime,XBSccIsSun,XBSccIsMon,XBSccIsTue,XBSccIsWed,XBSccIsThu,XBSccIsFri,XBSccIsSat,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
  SELECT '".$runcode."','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','".$vmscode."','001',0,NULL,NULL,0,1,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
      $queryUpdate = sqlsrv_query($conn, $sqlInsert);
      $response=callAPICOM($vmscode);
      $return=$response['RETURN'];
      insertLogVMS($vmscode,$_SESSION['userName'],'BRIGHT','ส่งคำสั่งความสว่างอัตโนมัติ: '.$return,$runcode);
      echo "ความสว่างอัตโนมัติ: ".$return;
}
if($option==12){
    $sql = "DECLARE @tCode nvarchar(100)
EXEC dbo. STP_NWLtGetMaxCode 'TDocTCmdSchedule', @tCode OUTPUT
PRINT 'TDocTCmdSchedule' + '-->' + @tCode";
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $runcode = $result['ptCode'];

    $sqlInsert = "INSERT INTO TDocTCmdSchedule (XVSccDocNo,XDSccDocDate,XTSccDocTime,XVVmsCode,XVCmdCode,XBSccIsSchedule,XTSccStart,XTSccEnd,XBSccIsDone,XBSccIsActive,XVSccValue,XTSccDocDoneTime,XBSccIsSun,XBSccIsMon,XBSccIsTue,XBSccIsWed,XBSccIsThu,XBSccIsFri,XBSccIsSat,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$runcode."','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','".$vmscode."','001',0,NULL,NULL,0,1,'".$valueBrightness."',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
    $queryUpdate = sqlsrv_query($conn, $sqlInsert);

    $response=callAPICOM($vmscode);
    $return=$response['RETURN'];
    insertLogVMS($vmscode,$_SESSION['userName'],'BRIGHT','ส่งคำสั่งความสว่างตั้งค่าเป็น '.$valueBrightness.' : '.$return,$runcode);
    echo "ความสว่างตั้งค่าเป็น ".$valueBrightness." : ".$return;


}
