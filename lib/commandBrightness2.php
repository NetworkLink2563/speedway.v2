<?php
ob_start();
session_start();
include "DatabaseManage.php";
include "function_VMS.php";

$vmscode=$_POST["vmscode"];
$valueBrightness=$_POST["valueBrightness"];
$option=$_POST["option"];

if ($option==11){
    $sql = "SELECT XIVmsBrightness FROM TMstMItmVMS_Status WHERE XISensorType=3 AND XVVmsCode='".$vmscode."'";
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    if($result['XIVmsBrightness']!=''){
        $sqlUpdate = "UPDATE TMstMItmVMS_Status SET XIVmsBrightness = '0',XVWhoEdit='".$_SESSION['userName']."',XTWhenEdit='".date('Y-m-d H:i:s')."' WHERE XVVmsCode='".$vmscode."' and XISensorType=3;";
        $queryUpdate = sqlsrv_query($conn, $sqlUpdate);


    }else{
        $sqlInsert = "INSERT INTO TMstMItmVMS_Status (XVVmsCode,XISensorType,XBVmsIsOn,XBVmsIsDisplay,XIVmsBrightness,XIVmsRackTemperature,XIVmsBoardTemperature,XBVmsFanIsActive,XBVmsFlashIsActive,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$vmscode."','3',NULL,NULL,'200',NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
        $queryUpdate = sqlsrv_query($conn, $sqlInsert);
    }
    callAPICOM($vmscode,2,'BRIGHT',200);
    insertLogVMS($vmscode,$_SESSION['userName'],'BRIGHT','ส่งคำสั่งความสว่างอัตโนมัติ');
echo $sqlInsert;
    //echo "ความสว่างอัตโนมัติ";

}

if($option==12){
    $sql = "SELECT XIVmsBrightness FROM TMstMItmVMS_Status WHERE XISensorType=3 AND XVVmsCode='".$vmscode."'";
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    if($result['XIVmsBrightness']!=''){
        $sqlUpdate = "UPDATE TMstMItmVMS_Status SET XIVmsBrightness = '".$valueBrightness."',XVWhoEdit='".$_SESSION['userName']."',XTWhenEdit='".date('Y-m-d H:i:s')."' WHERE XVVmsCode='".$vmscode."' and XISensorType=3;";
        $queryUpdate = sqlsrv_query($conn, $sqlUpdate);


    }else{
        $sqlInsert = "INSERT INTO TMstMItmVMS_Status (XVVmsCode,XISensorType,XBVmsIsOn,XBVmsIsDisplay,XIVmsBrightness,XIVmsRackTemperature,XIVmsBoardTemperature,XBVmsFanIsActive,XBVmsFlashIsActive,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$vmscode."','3',NULL,NULL,'".$valueBrightness."',NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
        $queryUpdate = sqlsrv_query($conn, $sqlInsert);
    }
    callAPICOM($vmscode,2,'BRIGHT',$valueBrightness);
    insertLogVMS($vmscode,$_SESSION['userName'],'BRIGHT','ส่งคำสั่งความสว่างตั้งค่าเป็น '.$valueBrightness);

    echo "ความสว่างตั้งค่าเป็น ".$valueBrightness;

}