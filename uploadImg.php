<?php
ob_start();
session_start();
include "lib/DatabaseManage.php";
$sql = "DECLARE @tCode nvarchar(100)
EXEC dbo. STP_NWLtGetMaxCode 'TMstMMessage', @tCode OUTPUT
PRINT 'TMstMMessage' + '-->' + @tCode
";

$query = sqlsrv_query($conn, $sql);


$result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
$XVMsgCode=$result['ptCode'];

$XVVmsCode=$_POST['vmsCodeImg'];
$nameMSG=$_POST['nameMSGImg'];
$datestart=$_POST['datetimepicker2'];
$datetend=$_POST['datetimepickerend2'];
$inputTimerImg=$_POST['inputTimerImg'];
$img = $_FILES['filer_input2']['name'];
$tmp = $_FILES['filer_input2']['tmp_name'];
if(!empty($_POST['nameMSGImg']) && !empty($_POST['inputTimerImg'])  ) {
   
    

$extension = pathinfo($img, PATHINFO_EXTENSION);
$filename=$XVMsgCode.'.'.$extension;
$path='media/tmp/'.$filename;
move_uploaded_file($tmp,$path);

$sql = "SELECT XVMssCode FROM TMstMItmVMS WHERE XVVmsCode='" . $XVVmsCode . "' ";
$querySQL = sqlsrv_query($conn, $sql);
$result = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC);
$vmsSize = $result['XVMssCode'];


$html='<html style="margin:0;padding: 0px;overflow: hidden;">
				<body style="margin: 0px;padding: 0px;overflow: hidden;">
				<div style=" margin:0;padding: 0px;width:100%;height:100%;">

				<img  style=" margin: 0px;padding: 0px;width:100%;height:100%;" src="'.$filename.'" >
				<div></body></html>';
$stmt2Insert = "
INSERT INTO TMstMMessage (
                        XVMsgCode,
                        XVMsgName,
                        XVMsgHtml,
                        XVMssCode,
                        XVMsgType,
                        XVMsgFileName,
                        XVMsgStatus,
                        XVMsgBg,
                        XVWhoCreate,
                        XVWhoEdit,
                        XTWhenCreate,
                        XTWhenEdit)values(
                        '$XVMsgCode',
                        '".$nameMSG."',
                        '$html',
                        '".$vmsSize."',
                        '2',
                        '$filename',
                        '1',
                        '',
                        '".$_SESSION['userName']."',
                        '',
                        '".date('Y-m-d H:i:s')."',
                        '".date('Y-m-d H:i:s')."')";

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
INSERT INTO TMstMItmVMSMessage (XVVmsCode,XIVmgSeqNo,XIVmgOrder,XVMsgCode,XIVmgDuration,XBVmgHasExpiration,XTVmgStart,XTVmgEnd,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)values(
 '".$XVVmsCode."','".$XIVmgSeqNo."','".$XIVmgOrder."','".$XVMsgCode."','".$inputTimerImg."','".$XBVmgHasExpiration."','".$datestart."','".$datetend."','".$_SESSION['userName']."','','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')";

$query = sqlsrv_query($conn, $stmtInsert);
echo 1;
}else{
    echo 0;
}

?>