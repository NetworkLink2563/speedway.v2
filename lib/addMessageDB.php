<?php
include "DatabaseManage.php";
$XVMsgCode=$_POST['XVMsgCode'];
$typeSeqNo=$_POST['typeSeqNo'];
$XVVmsCode=$_POST['vms'];
$chbox=$_POST['chbox'];

if($chbox==1) {
    $sql = "SELECT TOP 1 XIVmgSeqNo FROM TMstMItmVMSMessage WHERE XVVmsCode='" . $XVVmsCode . "' AND $XVMsgCode='" . $XVMsgCode . "' ORDER BY XVVmsCode DESC";
    $querySQL = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC);

    $stmtInsert = "INSERT INTO TMstMItmVMSMessage (XVVmsCode,XIVmgSeqNo,XIVmgOrder,XVMsgCode,XIVmgDuration,XBVmgHasExpiration,XTVmgStart,XTVmgEnd,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '" . $XVVmsCode . "','" . $XIVmgSeqNo . "','".$XIVmgOrder."','" . $XVMsgCode . "','".$inputTimer."','".$XBVmgHasExpiration."','','','".$usercode."','','".date('Y-m-d H:i:s')."',''";
    $query = sqlsrv_query($conn, $stmtInsert);
echo $sql;
}
