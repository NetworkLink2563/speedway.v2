<?php
ob_start();
session_start();
include "DatabaseManage.php";
$checkedValue=$_POST['checkedValue'];
$XVVmsCode=$_POST['vms'];
$XVMsgCode=$_POST['vmsMSG'];
$inputTimer=$_POST['inputTimer'];
$datetimepicker=$_POST['datetimepicker'];
$datetimepickerend2=$_POST['datetimepickerend2'];
$usercode = $_SESSION['userName'];

if($checkedValue==1){
    $XBVmgHasExpiration=1;
    $sql = "SELECT TOP 1 XVVmsCode,XIVmgSeqNo,XIVmgOrder FROM TMstMItmVMSMessage WHERE XVVmsCode='" . $XVVmsCode . "' ORDER BY XIVmgSeqNo DESC ";
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $XIVmgSeqNo = $result['XIVmgSeqNo'] + 1;
    $XIVmgOrder = $result['XIVmgOrder'] + 1;
    $stmtInsert = "INSERT INTO TMstMItmVMSMessage (XVVmsCode,XIVmgSeqNo,XIVmgOrder,XVMsgCode,XIVmgDuration,XBVmgHasExpiration,XTVmgStart,XTVmgEnd,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '" . $XVVmsCode . "','" . $XIVmgSeqNo . "','".$XIVmgOrder."','" . $XVMsgCode . "','".$inputTimer."','".$XBVmgHasExpiration."','".$datetimepicker."','".$datetimepickerend2."','".$usercode."','','".date('Y-m-d H:i:s')."',''";
   $query = sqlsrv_query($conn, $stmtInsert);
}else{
    $XBVmgHasExpiration=0;
    $sql = "SELECT TOP 1 XVVmsCode,XIVmgSeqNo,XIVmgOrder FROM TMstMItmVMSMessage WHERE XVVmsCode='" . $XVVmsCode . "' ORDER BY XIVmgSeqNo DESC ";
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $XIVmgSeqNo = $result['XIVmgSeqNo'] + 1;
    $XIVmgOrder = $result['XIVmgOrder'] + 1;
    $stmtInsert = "INSERT INTO TMstMItmVMSMessage (XVVmsCode,XIVmgSeqNo,XIVmgOrder,XVMsgCode,XIVmgDuration,XBVmgHasExpiration,XTVmgStart,XTVmgEnd,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '" . $XVVmsCode . "','" . $XIVmgSeqNo . "','".$XIVmgOrder."','" . $XVMsgCode . "','".$inputTimer."','".$XBVmgHasExpiration."','','','".$usercode."','','".date('Y-m-d H:i:s')."',''";
    $query = sqlsrv_query($conn, $stmtInsert);
}