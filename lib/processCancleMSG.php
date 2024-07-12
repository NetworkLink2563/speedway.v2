<?php
include "DatabaseManage.php";
$XVMsgCode=$_POST['XVMsgCode'];
$vms=$_POST['vms'];
$vmsSize=$_POST['vmsSize'];
$messageCheckboxManual=$_POST['messageCheckboxManual'];
$inputTimerManual=$_POST['inputTimerManual'];
$datestart=$_POST['datestart'];
$dateend=$_POST['dateend'];
$msgBG=$_POST['msgBG'];

$sqlSize = "DELETE FROM TMstMMessage WHERE XVMsgCode='".$XVMsgCode."' AND XVMsgStatus=3";
$querySize = sqlsrv_query($conn, $sqlSize);
echo $sqlSize;