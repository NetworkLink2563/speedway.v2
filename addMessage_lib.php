<?php

ob_start();
session_start();

 //nameMSG':nameMSG,
//'data':data,
//'vms':vms,
//'vmsSize':vmsSize,
//'messageCheckboxManual':messageCheckboxManual,
//'inputTimerManual':inputTimerManual,
//'datestart':datestart,
//'dateend':dateend,
//'msgBG':msgBG 


include "lib/DatabaseManage.php";
$nameMSG=$_POST['nameMSG'];
$data=$_POST['data'];
$XVVmsCode=$_POST['vms'];
$XVMssCode=$_POST['vmsSize'];
$messageCheckboxManual=$_POST['messageCheckboxManual'];
$inputTimerManual=$_POST['inputTimerManual'];
$datestart=$_POST['datestart'];
$dateend=$_POST['dateend'];
$msgBG=$_POST['msgBG'];

$ProcedSQL = "DECLARE @tCode nvarchar(100)
EXEC dbo. STP_NWLtGetMaxCode 'TMstMMessage', @tCode OUTPUT
PRINT 'TMstMMessage' + '-->' + @tCode
";
$queryProcedSQL = sqlsrv_query($conn, $ProcedSQL);
$resultProcedSQL = sqlsrv_fetch_array($queryProcedSQL, SQLSRV_FETCH_ASSOC);
$ptcode=$resultProcedSQL['ptCode'];

$sqlSize = "SELECT XIMssWPixel,XIMssHPixel FROM TMstMMsgSize WHERE XVMssCode='".$XVMssCode."'";
$querySize = sqlsrv_query($conn, $sqlSize);
$resultSize = sqlsrv_fetch_array($querySize, SQLSRV_FETCH_ASSOC);
$sizeW=$resultSize["XIMssWPixel"];
$sizeH=$resultSize["XIMssHPixel"];

$dataInsert ='<html style="margin:0;padding: 0px;">
<body style="margin: 0px;padding: 0px;">
<div style=" margin:0;padding: 0px;width:'.$sizeW.'px;height:'.$sizeH.'px;background-color:'.$msgBG.';"><div style="A_CSS_ATTRIBUTE:all;position: absolute;bottom: 0px; right: 0px;left: 0px; top: 0px;  ">'.$data.'
</div></div></div></div>
<div></body></html>';

$stmt2Insert = "
INSERT INTO TMstMMessage (XVMsgCode,XVMsgName,XVMsgHtml,XVMssCode,XVMsgType,XVMsgFileName,XVMsgStatus,XVMsgBg,XVWhoCreate,XTWhenCreate)
VALUES ('".$ptcode."','".$nameMSG."','".$dataInsert."','".$XVMssCode."','1','".$resultProcedSQL['ptCode'].".png','1','".$msgBG."','".$_SESSION['userName']."','".date('Y-m-d H:i:s')."')";

$query = sqlsrv_query($conn, $stmt2Insert);


$sql2 = "SELECT TOP 1 XIVmgSeqNo FROM TMstMItmVMSMessage WHERE XVVmsCode='" . $XVVmsCode . "' ORDER BY XIVmgSeqNo desc";
$querySQL2 = sqlsrv_query($conn, $sql2);
$result2 = sqlsrv_fetch_array($querySQL2, SQLSRV_FETCH_ASSOC);
$XIVmgSeqNo = $result2['XIVmgSeqNo']+1;

$sql4 = "SELECT TOP 1 XIVmgOrder FROM TMstMItmVMSMessage WHERE XVVmsCode='" . $XVVmsCode . "' ORDER BY XIVmgOrder desc";
$querySQL4 = sqlsrv_query($conn, $sql4);
$result4 = sqlsrv_fetch_array($querySQL4, SQLSRV_FETCH_ASSOC);
$XIVmgOrder = $result4['XIVmgOrder']+1;


if($messageCheckboxManual==1){
    
    $XBVmgHasExpiration=1;
    $stmtInsert = "
    INSERT INTO TMstMItmVMSMessage (XVVmsCode,XIVmgSeqNo,XIVmgOrder,XVMsgCode,XIVmgDuration,XBVmgHasExpiration,XTVmgStart,XTVmgEnd,XVWhoCreate,XTWhenCreate)VALUES(
    SELECT '".$XVVmsCode."','".$XIVmgSeqNo."','".$XIVmgOrder."','".$ptcode."','".$inputTimerManual."','".$XBVmgHasExpiration."','".$datestart."','".$datetend."','".$_SESSION['userName']."','','".date('Y-m-d H:i:s')."')";
    
}else{
    
    $XBVmgHasExpiration=0;
    $stmtInsert = "
    INSERT INTO TMstMItmVMSMessage (XVVmsCode,XIVmgSeqNo,XIVmgOrder,XVMsgCode,XIVmgDuration,XBVmgHasExpiration,XVWhoCreate,XVWhoEdit,XTWhenCreate)VALUES(
     '".$XVVmsCode."','".$XIVmgSeqNo."','".$XIVmgOrder."','".$ptcode."','".$inputTimerManual."','".$XBVmgHasExpiration."','".$_SESSION['userName']."','','".date('Y-m-d H:i:s')."')";
    
}


$query = sqlsrv_query($conn, $stmtInsert);
$Fname= "C:\\inetpub\\wwwroot\\speedway\\media\\tmp\\".$ptcode.".pdf";
$jdata = array("VmsCode" => $XVVmsCode,
    "PdfFileName" =>$Fname,
    "PngFileName" => $ptcode.".png",
    "DestinationPath" => "C:\\inetpub\\wwwroot\\speedway\\media\\tmp",
    "Width" => $sizeW,
    "Height" => $sizeH
);
$data_string = json_encode($jdata);

$api_key = "kOK24RIo625gOSCzPFK5cg==";
$password = "ymfqgoZg6BmJatEcSO7bNw==";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8989");
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $api_key . ':' . $password);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Accept: application/json',
        'Content-Type: application/json')
);

if (curl_exec($ch) === false) {
    echo 'Curl error: ' . curl_error($ch);
}
$errors = curl_error($ch);
$result = curl_exec($ch);
$returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
$response = json_decode($result, true);
unlink($Fname);
echo $response;

?>