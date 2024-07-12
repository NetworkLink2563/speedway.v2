<?php
ob_start();
session_start();
include "DatabaseManage.php";
include "function_VMS.php";
$vmscode=$_POST["vmscode"];
$value=$_POST["value"];
$option=$_POST["option"];
$datenow=date('Y-m-d H:i:s');

if ($option==2){
    callAPICOM($vmscode,3,'SETTIME',date('YmdHis'));
    insertLogVMS($vmscode,$_SESSION['userName'],'SETTIME','ส่งคำสั่งปรับเวลาป้าย');
    echo 'ส่งคำสั่ง ปรับเวลาจากศูนย์ควบคุม';
}
if ($option==3){
    callAPICOM($vmscode,4,'RESTART',1);
    insertLogVMS($vmscode,$_SESSION['userName'],'RESTART','ส่งคำสั่งรีเซ็ตป้าย VMS');
    echo 'Restart ป้าย VMS สำเร็จ';
}
if ($option==5){
    $sql = "SELECT XBVmsIsOn FROM TMstMItmVMS_Status WHERE XISensorType=1 AND XVVmsCode='".$vmscode."'";

    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $textsend=$result['XBVmsIsOn'].'|'.'VMS';
    $vmssend=explode('@',$textsend);
    $vmsExplode=explode('|',$vmssend[0]);
    if($vmsExplode[0]==''){
        $sqlInsert = "INSERT INTO TMstMItmVMS_Status (XVVmsCode,XISensorType,XBVmsIsOn,XBVmsIsDisplay,XIVmsBrightness,XIVmsRackTemperature,XIVmsBoardTemperature,XBVmsFanIsActive,XBVmsFlashIsActive,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$vmscode."','1',1,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
        $queryUpdate = sqlsrv_query($conn, $sqlInsert);
        echo "เพิ่มคำสั่ง เปิดระบบไฟฟ้า";
    }else{
        $sqlUpdate = "UPDATE TMstMItmVMS_Status SET XBVmsIsOn = '1',XVWhoEdit='".$_SESSION['userName']."',XTWhenEdit='".date('Y-m-d H:i:s')."' WHERE XVVmsCode='".$vmscode."' and XISensorType=1;";
        $queryUpdate = sqlsrv_query($conn, $sqlUpdate);
        echo "อัพเดจคำสั่ง เปิดระบบไฟฟ้า";

    }
    callAPIRpi($vmscode,7,'POWERONOFF',1);
    insertLogVMS($vmscode,$_SESSION['userName'],'POWERONOFF','ส่งคำสั่งเปิดระบบไฟฟ้า');
}

if($option==6){
    $sql = "SELECT XBVmsIsOn FROM TMstMItmVMS_Status WHERE XISensorType=1 AND XVVmsCode='".$vmscode."'";
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $textsend=$result['XBVmsIsOn'].'|'.'VMS';
    $vmssend=explode('@',$textsend);
    $vmsExplode=explode('|',$vmssend[0]);
    if($vmsExplode[0]==''){
        $sqlInsert = "INSERT INTO TMstMItmVMS_Status (XVVmsCode,XISensorType,XBVmsIsOn,XBVmsIsDisplay,XIVmsBrightness,XIVmsRackTemperature,XIVmsBoardTemperature,XBVmsFanIsActive,XBVmsFlashIsActive,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$vmscode."','1',0,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
        $queryUpdate = sqlsrv_query($conn, $sqlInsert);
        echo "เพิ่มคำสั่ง ปิดระบบไฟฟ้า";
    }else{
        $sqlUpdate = "UPDATE TMstMItmVMS_Status SET XBVmsIsOn = '0',XVWhoEdit='".$_SESSION['userName']."',XTWhenEdit='".date('Y-m-d H:i:s')."' WHERE XVVmsCode='".$vmscode."' and XISensorType=1;";
        $queryUpdate = sqlsrv_query($conn, $sqlUpdate);
        echo "อัพเดจคำสั่ง ปิดระบบไฟฟ้า";
    }
    callAPIRpi($vmscode,7,'POWERONOFF',0);
    insertLogVMS($vmscode,$_SESSION['userName'],'POWERONOFF','ส่งคำสั่งปิดระบบไฟฟ้า');

}
sqlsrv_close( $conn );
