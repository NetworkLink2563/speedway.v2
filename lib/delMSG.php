<?php
include "DatabaseManage.php";
$msgCODE=$_POST['msgCODE'];
$XVVmsCode=$_POST['XVVmsCode'];

$stmt = "SELECT TOP 1 XVMsgFileName FROM TMstMMessage WHERE XVMsgCode='".$msgCODE."'";
$query = sqlsrv_query($conn, $stmt);
$result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
$delete="../media/".$XVVmsCode."/".$result['XVMsgFileName'];
//@unlink($delete);

$stmt = "DELETE FROM TMstMMessage WHERE XVMsgCode='".$msgCODE."' and XVMsgStatus=4";
$stmt2 = "DELETE FROM TMstMItmVMSMessage WHERE XVMsgCode='".$msgCODE."' and XVVmsCode='".$XVVmsCode."'";
sqlsrv_query($conn, $stmt);
sqlsrv_query($conn, $stmt2);