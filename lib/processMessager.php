<?php
ob_start();
session_start();
include "DatabaseManage.php";
$usercode=$_SESSION['userName'];
$XVVmsCode=$_POST['vms'];
$XVMsgCode=$_POST['XVMsgCode'];
$typeAction = $_POST['typeAction'];
$inputTimer = $_POST['inputTimer'];
$datestart = $_POST['datestart'];
$dateend = $_POST['dateend'];


if($typeAction=='timer') {
    $sql = "SELECT TOP 1 XVVmsCode,XIVmgSeqNo,XIVmgOrder FROM TMstMItmVMSMessage WHERE XVVmsCode='" . $XVVmsCode . "' ORDER BY XIVmgSeqNo DESC ";
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $XIVmgSeqNo = $result['XIVmgSeqNo'] + 1;
    $XIVmgOrder = $result['XIVmgOrder'] + 1;
    $XBVmgHasExpiration='0';

    $stmtInsert = "INSERT INTO TMstMItmVMSMessage (XVVmsCode,XIVmgSeqNo,XIVmgOrder,XVMsgCode,XIVmgDuration,XBVmgHasExpiration,XTVmgStart,XTVmgEnd,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '" . $XVVmsCode . "','" . $XIVmgSeqNo . "','".$XIVmgOrder."','" . $XVMsgCode . "','".$inputTimer."','".$XBVmgHasExpiration."','','','".$usercode."','','".date('Y-m-d H:i:s')."',''";
    $query = sqlsrv_query($conn, $stmtInsert);

}elseif($typeAction=='scheule') {
    $sql = "SELECT TOP 1 XVVmsCode,XIVmgSeqNo,XIVmgOrder FROM TMstMItmVMSMessage WHERE XVVmsCode='" . $XVVmsCode . "' ORDER BY XIVmgSeqNo DESC ";
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $XIVmgSeqNo = $result['XIVmgSeqNo'] + 1;
    $XIVmgOrder = $result['XIVmgOrder'] + 1;
    $XBVmgHasExpiration='1';

    $stmtInsert = "INSERT INTO TMstMItmVMSMessage (XVVmsCode,XIVmgSeqNo,XIVmgOrder,XVMsgCode,XIVmgDuration,XBVmgHasExpiration,XTVmgStart,XTVmgEnd,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '" . $XVVmsCode . "','" . $XIVmgSeqNo . "','".$XIVmgOrder."','" . $XVMsgCode . "','".$inputTimer."','".$XBVmgHasExpiration."','".$datestart."','".$dateend."','".$usercode."','','".date('Y-m-d H:i:s')."',''";
    $query = sqlsrv_query($conn, $stmtInsert);
}