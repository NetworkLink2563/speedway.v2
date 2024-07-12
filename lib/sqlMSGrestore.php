<?php
ob_start();
session_start();
include "DatabaseManage.php";
$vmsID=$_POST['vmsID'];
$msgcode=$_POST['msgcodeRestore'];
$msgcode=str_replace('msgcodeRestore%5B%5D=','',$msgcode);
$msgcode=explode('&',$msgcode);
$msgCount=count($msgcode);
for ($x = 0; $x < $msgCount; $x++) {
    if($msgcode[$x]!=''){
        $sql4 = "SELECT * FROM TMstMMessage WHERE XVMsgCode='" . $msgcode[$x] . "'";
        $querySQL4 = sqlsrv_query($conn, $sql4);
        $result4 = sqlsrv_fetch_array($querySQL4, SQLSRV_FETCH_ASSOC);
        unlink("../media/".$vmsID."/".$result4['XVMsgFileName']);
        $sql = "DELETE FROM TMstMItmVMSMessage WHERE XVVmsCode='" . $vmsID . "' AND XVMsgCode='".$msgcode[$x]."'";
        $querySQL = sqlsrv_query($conn, $sql);
    }
}
?>

