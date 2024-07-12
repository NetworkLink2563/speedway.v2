<?php
ob_start();
session_start();

include "DatabaseManage.php";
$XVSccDocNo=$_POST['XVSccDocNo'];
$vmsID=$_POST['vmsID'];

$stmtInsert = "DELETE FROM TDocTCmdSchedule WHERE XVSccDocNo='".$XVSccDocNo."' AND XVVmsCode='".$vmsID."'";
sqlsrv_query($conn, $stmtInsert);
sqlsrv_close( $conn );
