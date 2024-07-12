<?php
include "DatabaseManage.php";
$msgCODE=$_POST['msgCODE'];

    $stmt = "UPDATE TMstMMessage SET XVMsgStatus = '1' WHERE XVMsgCode='".$msgCODE."';";
$query = sqlsrv_query($conn, $stmt);