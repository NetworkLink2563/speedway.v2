<?php
include "DatabaseManage.php";
$runcode=$_POST["runcode"];
$codeprocess=$_POST["codeprocess"];
$option=$_POST["option"];

$sql = "SELECT XBSccIsDone FROM TDocTCmdSchedule WHERE XVSccDocNo='".$runcode."' AND XVCmdCode='".$codeprocess."'";
$query = sqlsrv_query($conn, $sql);
$result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);

if($result['XBSccIsDone']=='True'){
echo 'true';
}

