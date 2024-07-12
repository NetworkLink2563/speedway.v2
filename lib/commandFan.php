<?php
ob_start();
session_start();
include "DatabaseManage.php";
$vmscode=$_POST["vmscode"];
$value=$_POST["value"];
$option=$_POST["option"];

if ($option==7){
    $sql = "SELECT XBVmsFanIsActive FROM TMstMItmVMS_Status WHERE XISensorType=6 AND XVVmsCode='".$vmscode."'";

    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $textsend=$result['XBVmsFanIsActive'].'|'.'Fan';
    $vmssend=explode('@',$textsend);
    $vmsExplode=explode('|',$vmssend[0]);
    if($vmsExplode[0]==''){
        $sqlInsert = "INSERT INTO TMstMItmVMS_Status (XVVmsCode,XISensorType,XBVmsIsOn,XBVmsIsDisplay,XIVmsBrightness,XIVmsRackTemperature,XIVmsBoardTemperature,XBVmsFanIsActive,XBVmsFlashIsActive,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$vmscode."','6',NULL,NULL,NULL,NULL,NULL,1,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
        $queryUpdate = sqlsrv_query($conn, $sqlInsert);
        echo "เพิ่มคำสั่ง เปิดพัดลมตู้ควบคุม";
    }else{
        $sqlUpdate = "UPDATE TMstMItmVMS_Status SET XBVmsFanIsActive = '1',XVWhoEdit='".$_SESSION['userName']."',XTWhenEdit='".date('Y-m-d H:i:s')."' WHERE XVVmsCode='".$vmscode."' and XISensorType=6;";
        $queryUpdate = sqlsrv_query($conn, $sqlUpdate);
        echo "อัพเดจคำสั่ง เปิดพัดลมตู้ควบคุม";
    }
}

if($option==8){
    $sql = "SELECT XBVmsFanIsActive FROM TMstMItmVMS_Status WHERE XISensorType=6 AND XVVmsCode='".$vmscode."'";
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $textsend=$result['XBVmsFanIsActive'].'|'.'Fan';
    $vmssend=explode('@',$textsend);
    $vmsExplode=explode('|',$vmssend[0]);
    if($vmsExplode[0]==''){
        $sqlInsert = "INSERT INTO TMstMItmVMS_Status (XVVmsCode,XISensorType,XBVmsIsOn,XBVmsIsDisplay,XIVmsBrightness,XIVmsRackTemperature,XIVmsBoardTemperature,XBVmsFanIsActive,XBVmsFlashIsActive,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$vmscode."','6',NULL,NULL,NULL,NULL,NULL,0,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
        $queryUpdate = sqlsrv_query($conn, $sqlInsert);
        echo "เพิ่มคำสั่ง ปิดพัดลมตู้ควบคุม";
    }else{
        $sqlUpdate = "UPDATE TMstMItmVMS_Status SET XBVmsFanIsActive = '0',XVWhoEdit='".$_SESSION['userName']."',XTWhenEdit='".date('Y-m-d H:i:s')."' WHERE XVVmsCode='".$vmscode."' and XISensorType=6;";
        $queryUpdate = sqlsrv_query($conn, $sqlUpdate);
        echo "อัพเดจคำสั่ง ปิดพัดลมตู้ควบคุม";
    }
}

$api_key = "kOK24RIo625gOSCzPFK5cg==";
$password = "ymfqgoZg6BmJatEcSO7bNw==";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://43.229.151.102/speedway/service/poweronoff.php");
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $api_key.':'.$password);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Accept: application/json',
        'Content-Type: application/json')
);

if(curl_exec($ch) === false)
{
    echo 'Curl error: ' . curl_error($ch);
}
$errors = curl_error($ch);
$result = curl_exec($ch);
$returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
$response =  json_decode($result,true);