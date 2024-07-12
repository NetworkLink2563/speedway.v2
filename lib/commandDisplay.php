<?php
ob_start();
session_start();
include "DatabaseManage.php";
include "function_VMS.php";
$vmscode=$_POST["vmscode"];
$value=$_POST["value"];
$option=$_POST["option"];
$datenow=date('Y-m-d H:i:s');

if ($option==7){
    $sql = "DECLARE @tCode nvarchar(100)
EXEC dbo. STP_NWLtGetMaxCode 'TDocTCmdSchedule', @tCode OUTPUT
PRINT 'TDocTCmdSchedule' + '-->' + @tCode";
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $runcode = $result['ptCode'];
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $runcode = $result['ptCode'];

    $sqlInsert = "INSERT INTO TDocTCmdSchedule (XVSccDocNo,XDSccDocDate,XTSccDocTime,XVVmsCode,XVCmdCode,XBSccIsSchedule,XTSccStart,XTSccEnd,XBSccIsDone,XBSccIsActive,XVSccValue,XTSccDocDoneTime,XBSccIsSun,XBSccIsMon,XBSccIsTue,XBSccIsWed,XBSccIsThu,XBSccIsFri,XBSccIsSat,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$runcode."','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','".$vmscode."','003',0,NULL,NULL,0,1,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
    $queryUpdate = sqlsrv_query($conn, $sqlInsert);
    $response=callAPICOM($vmscode);
    $return=$response['RETURN'];
    insertLogVMS($vmscode,$_SESSION['userName'],'POWERONOFF','การแสดงผล Online: '.$return,$runcode);
    echo "การแสดงผล Online";
}

if ($option==8){
    $sql = "DECLARE @tCode nvarchar(100)
EXEC dbo. STP_NWLtGetMaxCode 'TDocTCmdSchedule', @tCode OUTPUT
PRINT 'TDocTCmdSchedule' + '-->' + @tCode";
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $runcode = $result['ptCode'];
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $runcode = $result['ptCode'];

    $sqlInsert = "INSERT INTO TDocTCmdSchedule (XVSccDocNo,XDSccDocDate,XTSccDocTime,XVVmsCode,XVCmdCode,XBSccIsSchedule,XTSccStart,XTSccEnd,XBSccIsDone,XBSccIsActive,XVSccValue,XTSccDocDoneTime,XBSccIsSun,XBSccIsMon,XBSccIsTue,XBSccIsWed,XBSccIsThu,XBSccIsFri,XBSccIsSat,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$runcode."','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','".$vmscode."','003',0,NULL,NULL,0,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
    $queryUpdate = sqlsrv_query($conn, $sqlInsert);
    $response=callAPICOM($vmscode);
    $return=$response['RETURN'];
    insertLogVMS($vmscode,$_SESSION['userName'],'POWERONOFF','การแสดงผล Offline: '.$return,$runcode);
    echo "การแสดงผล Offline";
}