<?php
ob_start();
session_start();
include "DatabaseManage.php";
$vmsID=$_POST['vmsID'];
$msgcode=$_POST['msgcode'];

$inputTimerAuto=$_POST['inputTimerAuto'];

$datestart=$_POST['datestart'];
$dateend=$_POST['dateend'];


$messageCheckboxAuto=$_POST['messageCheckboxAuto'];
if($messageCheckboxAuto=='true'){
    $XBVmgHasExpiration=1;
}elseif($messageCheckboxAuto=='false'){
    $XBVmgHasExpiration=0;
}

$msgcode=str_replace('msgcode%5B%5D=','',$msgcode);
$msgcode=explode('&',$msgcode);
$msgCount=count($msgcode);
for ($x = 0; $x < $msgCount; $x++) {
    if($msgcode[$x]!=''){
    $sql2 = "SELECT TOP 1 XIVmgSeqNo FROM TMstMItmVMSMessage WHERE XVVmsCode='" . $vmsID . "' ORDER BY XIVmgSeqNo desc";
    $querySQL2 = sqlsrv_query($conn, $sql2);
    $result2 = sqlsrv_fetch_array($querySQL2, SQLSRV_FETCH_ASSOC);
    $XIVmgSeqNo = $result2['XIVmgSeqNo']+1;

    $sql3 = "SELECT TOP 1 XIVmgOrder FROM TMstMItmVMSMessage WHERE XVVmsCode='" . $vmsID . "' ORDER BY XIVmgOrder desc";
    $querySQL3 = sqlsrv_query($conn, $sql3);
    $result3 = sqlsrv_fetch_array($querySQL3, SQLSRV_FETCH_ASSOC);
    $XIVmgOrder = $result3['XIVmgOrder']+1;


    $sql4 = "SELECT        XVMsgCode, XVMsgName, ISNULL(XIVdoDuration, 0) AS XIVdoDuration
    FROM            dbo.TMstMMessage
    WHERE        XVMsgCode = '$msgcode[$x]'";
    $querySQL4 = sqlsrv_query($conn, $sql4);
    $result4 = sqlsrv_fetch_array($querySQL4, SQLSRV_FETCH_ASSOC);
    $XIVdoDuration = $result4['XIVdoDuration'];

    if( $XIVdoDuration>0){
        $inputTimerAuto=$XIVdoDuration;
    }else{
        $inputTimerAuto=$_POST['inputTimerAuto'];
    }
    if($XBVmgHasExpiration==1){
        $stmtInsert = "
                 INSERT INTO TMstMItmVMSMessage (XVVmsCode,XIVmgSeqNo,XIVmgOrder,XVMsgCode,XIVmgDuration,XBVmgHasExpiration,XTVmgStart,XTVmgEnd,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)values(
          '".$vmsID."','".$XIVmgSeqNo."','".$XIVmgOrder."','".$msgcode[$x]."','".$inputTimerAuto."','".$XBVmgHasExpiration."','".$datestart."','".$dateend."','".$_SESSION['userName']."','','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')";
    }else{  
        $stmtInsert = "
        INSERT INTO TMstMItmVMSMessage (XVVmsCode,XIVmgSeqNo,XIVmgOrder,XVMsgCode,XIVmgDuration,XBVmgHasExpiration,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)values(
        '".$vmsID."','".$XIVmgSeqNo."','".$XIVmgOrder."','".$msgcode[$x]."','".$inputTimerAuto."','".$XBVmgHasExpiration."','".$_SESSION['userName']."','','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')";
    }     
   sqlsrv_query($conn, $stmtInsert);

    $sql4 = "SELECT * FROM TMstMMessage WHERE XVMsgCode='" . $msgcode[$x] . "'";
    $querySQL4 = sqlsrv_query($conn, $sql4);
    $result4 = sqlsrv_fetch_array($querySQL4, SQLSRV_FETCH_ASSOC);
    copy("../media/tmp/".$result4['XVMsgFileName'],"../media/".$vmsID."/".$result4['XVMsgFileName']);

}
}
?>

