<?php
ob_start();
session_start();
include "DatabaseManage.php";
$XVVmsCode=$_POST['vmsCodeANI'];
$nameMSG=$_POST['nameMSGANI'];
$datestart=$_POST['datetimepicker4'];
$datetend=$_POST['datetimepickerend4'];
$inputTimerImg=$_POST['inputTimerANI'];
$img = $_FILES['filer_inputANI']['name'];
$tmp = $_FILES['filer_inputANI']['tmp_name'];
if(!empty($_POST['nameMSGANI']) && !empty($_POST['inputTimerANI'])  ) {
$ProcedSQL = "DECLARE @tCode nvarchar(100)
EXEC dbo. STP_NWLtGetMaxCode 'TMstMMessage', @tCode OUTPUT
PRINT 'TMstMMessage' + '-->' + @tCode
";
$queryProcedSQL = sqlsrv_query($conn, $ProcedSQL);
$resultProcedSQL = sqlsrv_fetch_array($queryProcedSQL, SQLSRV_FETCH_ASSOC);


$imgname=explode('.',$img);
$imgname=$resultProcedSQL['ptCode'].'.'.$imgname[1];
$path='../media/tmp/'.$imgname;
move_uploaded_file($tmp,$path);

$sql = "SELECT XVMssCode FROM TMstMItmVMS WHERE XVVmsCode='" . $XVVmsCode . "' ";
$querySQL = sqlsrv_query($conn, $sql);
$result = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC);
$vmsSize = $result['XVMssCode'];


$stmt2Insert = "
INSERT INTO TMstMMessage (XVMsgCode,XVMsgName,XVMsgHtml,XVMssCode,XVMsgType,XVMsgFileName,XVMsgStatus,XVMsgBg,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$resultProcedSQL['ptCode']."','".$nameMSG."','','".$vmsSize."','3','".$imgname."','4','','".$_SESSION['userName']."','','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
$query = sqlsrv_query($conn, $stmt2Insert);

    $sql2 = "SELECT TOP 1 XIVmgSeqNo FROM TMstMItmVMSMessage WHERE XVVmsCode='" . $XVVmsCode . "' ORDER BY XIVmgSeqNo desc";
    $querySQL2 = sqlsrv_query($conn, $sql2);
    $result2 = sqlsrv_fetch_array($querySQL2, SQLSRV_FETCH_ASSOC);
    $XIVmgSeqNo = $result2['XIVmgSeqNo']+1;

    $sql4 = "SELECT TOP 1 XIVmgOrder FROM TMstMItmVMSMessage WHERE XVVmsCode='" . $XVVmsCode . "' ORDER BY XIVmgOrder desc";
    $querySQL4 = sqlsrv_query($conn, $sql4);
    $result4 = sqlsrv_fetch_array($querySQL4, SQLSRV_FETCH_ASSOC);
    $XIVmgOrder = $result4['XIVmgOrder']+1;

    if($datestart!='' && $datetend!=''){
        $XBVmgHasExpiration=1;
    }else{
        $XBVmgHasExpiration=0;
    }
$stmtInsert = "
INSERT INTO TMstMItmVMSMessage (XVVmsCode,XIVmgSeqNo,XIVmgOrder,XVMsgCode,XIVmgDuration,XBVmgHasExpiration,XTVmgStart,XTVmgEnd,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$XVVmsCode."','".$XIVmgSeqNo."','".$XIVmgOrder."','".$resultProcedSQL['ptCode']."','".$inputTimerImg."','".$XBVmgHasExpiration."','".$datestart."','".$datetend."','".$_SESSION['userName']."','','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
$query = sqlsrv_query($conn, $stmtInsert);
echo 1;
}else{
    echo 0;
}
