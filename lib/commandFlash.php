<?php
ob_start();
session_start();
include "DatabaseManage.php";
include "function_VMS.php";

$vmscode=$_POST["vmscode"];
$value=$_POST["value"];
$option=$_POST["option"];

if ($option==9){
    $sql = "DECLARE @tCode nvarchar(100)
EXEC dbo. STP_NWLtGetMaxCode 'TDocTCmdSchedule', @tCode OUTPUT
PRINT 'TDocTCmdSchedule' + '-->' + @tCode";
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $runcode = $result['ptCode'];

    $sqlInsert = "INSERT INTO TDocTCmdSchedule (XVSccDocNo,XDSccDocDate,XTSccDocTime,XVVmsCode,XVCmdCode,XBSccIsSchedule,XTSccStart,XTSccEnd,XBSccIsDone,XBSccIsActive,XVSccValue,XTSccDocDoneTime,XBSccIsSun,XBSccIsMon,XBSccIsTue,XBSccIsWed,XBSccIsThu,XBSccIsFri,XBSccIsSat,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$runcode."','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','".$vmscode."','004',0,NULL,NULL,1,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
    $queryUpdate = sqlsrv_query($conn, $sqlInsert);
    callAPICOM($vmscode);
    insertLogVMS($vmscode,$_SESSION['userName'],'BRINK','ส่งคำสั่งเปิดไฟกระพริบ');
    echo "เปิดไฟกระพริบ";
}

if($option==10){
    $sql = "DECLARE @tCode nvarchar(100)
EXEC dbo. STP_NWLtGetMaxCode 'TDocTCmdSchedule', @tCode OUTPUT
PRINT 'TDocTCmdSchedule' + '-->' + @tCode";
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $runcode = $result['ptCode'];

    $sqlInsert = "INSERT INTO TDocTCmdSchedule (XVSccDocNo,XDSccDocDate,XTSccDocTime,XVVmsCode,XVCmdCode,XBSccIsSchedule,XTSccStart,XTSccEnd,XBSccIsDone,XBSccIsActive,XVSccValue,XTSccDocDoneTime,XBSccIsSun,XBSccIsMon,XBSccIsTue,XBSccIsWed,XBSccIsThu,XBSccIsFri,XBSccIsSat,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$runcode."','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','".$vmscode."','004',0,NULL,NULL,1,1,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
    $queryUpdate = sqlsrv_query($conn, $sqlInsert);
    callAPICOM($vmscode);
    insertLogVMS($vmscode,$_SESSION['userName'],'BRINK','ส่งคำสั่งปิดไฟกระพริบ');
    echo "ปิดไฟกระพริบ";
}
sqlsrv_close( $conn );