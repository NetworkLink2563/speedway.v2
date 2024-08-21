<?php
include "DatabaseManage.php";
$XVMssCode=$_POST['XVMssCode'];
$XVMsgName=$_POST['XVMsgName'];
$XVMsgStatus=$_POST['XVMsgStatus'];
$idmsgSize=$_POST['idmsgSize'];
$XVMsgBg=$_POST['msgBG'];
$XVMsgHtml="/media/tmp";
$explode=explode("<div>",$_POST['data']);
$data='<div style="width: 300px; height:300px; background: '.$XVMsgBg.';">'.$_POST['data']."</div>";
$stmt = "SELECT TOP 1 XVMsgOrder FROM TMstMMessage ORDER BY XVMsgOrder DESC";
$query = sqlsrv_query($conn, $stmt);
$result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
$XVMsgOrder=$result['XVMsgOrder']+1;
$msgCODE="MSGYYMM-".$XVMsgOrder;
$stmt2Insert = "
INSERT INTO TMstMMessage (XVMsgCode,XVMsgName,XVMsgHtml,XVMssCode,XVMsgType,XVMsgFileName,XVMsgStatus,XVMsgOrder,XVMsgBg,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$msgCODE."','".$XVMsgName."','".$data."','".$XVMssCode."','1','".$msgCODE.".pdf','".$XVMsgStatus."','".$XVMsgOrder."','".$XVMsgBg."','".$_SESSION['userName']."','','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
$query = sqlsrv_query($conn, $stmt2Insert);
echo $XVMsgOrder;