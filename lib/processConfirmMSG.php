<?php
ob_start();
session_start();
include "DatabaseManage.php";
$usercode=$_SESSION['userName'];

$XVMsgCode=$_POST['XVMsgCode'];
$XVVmsCode=$_POST['vms'];
$vmsSize=$_POST['vmsSize'];
$XBVmgHasExpiration=$_POST['messageCheckboxManual'];
$inputTimer=$_POST['inputTimerManual'];
$datestart=$_POST['datestart'];
$dateend=$_POST['dateend'];
$msgBG=$_POST['msgBG'];
if($XBVmgHasExpiration==1){
    $XBVmgHasExpiration=1;
}else{
    $XBVmgHasExpiration=0;
}

$sql = "SELECT TOP 1 XVVmsCode,XIVmgSeqNo,XIVmgOrder FROM TMstMItmVMSMessage WHERE XVVmsCode='" . $XVVmsCode . "' ORDER BY XIVmgSeqNo DESC ";
$query = sqlsrv_query($conn, $sql);
$result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
$XIVmgSeqNo = $result['XIVmgSeqNo'] + 1;
$XIVmgOrder = $result['XIVmgOrder'] + 1;

$stmtInsert = "INSERT INTO TMstMItmVMSMessage (XVVmsCode,XIVmgSeqNo,XIVmgOrder,XVMsgCode,XIVmgDuration,XBVmgHasExpiration,XTVmgStart,XTVmgEnd,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '" . $XVVmsCode . "','" . $XIVmgSeqNo . "','".$XIVmgOrder."','" . $XVMsgCode . "','".$inputTimer."','".$XBVmgHasExpiration."','".$datestart."','".$dateend."','".$usercode."','','".date('Y-m-d H:i:s')."',''";
$query = sqlsrv_query($conn, $stmtInsert);

$sqlupdate="UPDATE TMstMMessage SET XVMsgStatus=4 WHERE XVMsgCode='".$XVMsgCode."'";
$query = sqlsrv_query($conn, $sqlupdate);

echo $stmtInsert;