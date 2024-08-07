
<?php
include "lib/DatabaseManage.php";
$XVMsgCode = base64_decode($_GET['msg']);
$v=$_GET['v'];
//dbo.TMstMMessageFrame.XVMsgCodeF2, dbo.TMstMMessageFrame.XVMsgCodeF3, 
//dbo.TMstMMessageFrame.XVMsgCodeF4, dbo.TMstMMessageFrame.XVMsgCodeF5,


if($v==1){
$sql ="SELECT dbo.TLogTItmVMSMessage.XVVmsCode, dbo.TLogTItmVMSMessage.XTWhenEdit,
                  DATEDIFF(Second, dbo.TLogTItmVMSMessage.XTWhenEdit, GETDATE()) AS XiSecDiff, 
                  dbo.TLogTItmVMSMessage.XVMsfCode, 
                  dbo.TMstMMessageFrame.XVMsfFormat, 
                  dbo.TMstMMessageFrame.XVMsgCodeF1,
                  dbo.TMstMMessage.XVMsgFileName,  
                  dbo.TMstMMsgSize.XIMssWPixel, 
                  dbo.TMstMMsgSize.XIMssHPixel, 
                  dbo.TMstMMessage.XVMsgHtml, 
                  dbo.TMstMMessageFrame.XVMsfType
FROM dbo.TLogTItmVMSMessage INNER JOIN
                  dbo.TMstMMessageFrame ON dbo.TLogTItmVMSMessage.XVMsfCode = dbo.TMstMMessageFrame.XVMsfCode INNER JOIN
                  dbo.TMstMMessage ON dbo.TMstMMessageFrame.XVMsgCodeF1 = dbo.TMstMMessage.XVMsgCode INNER JOIN
                  dbo.TMstMMsgSize ON dbo.TMstMMessageFrame.XVMssCode = dbo.TMstMMsgSize.XVMssCode
 WHERE dbo.TLogTItmVMSMessage.XVVmsCode = '$XVMsgCode'";
//echo $sql;
$querySQL = sqlsrv_query($conn, $sql);
$result_row = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC);
$XIMssWPixel=$result_row['XIMssWPixel'];
$XIMssHPixel=$result_row['XIMssHPixel'];
$XVMsgFileName=$result_row['XVMsgFileName'];
$html=$result_row['XVMsgHtml'];
$data=str_replace($XVMsgFileName,"media/tmp/".$XVMsgFileName,$html);
echo $data;
}
if($v==2){

    $sql ="SELECT dbo.TLogTItmVMSMessage.XVVmsCode, dbo.TLogTItmVMSMessage.XTWhenEdit,
    DATEDIFF(Second, dbo.TLogTItmVMSMessage.XTWhenEdit, GETDATE()) AS XiSecDiff, 
    dbo.TLogTItmVMSMessage.XVMsfCode, 
    dbo.TMstMMessageFrame.XVMsfFormat, 
   dbo.TMstMMessageFrame.XVMsgCodeF2,
    dbo.TMstMMessage.XVMsgFileName,  
    dbo.TMstMMsgSize.XIMssWPixel, 
    dbo.TMstMMsgSize.XIMssHPixel, 
    dbo.TMstMMessage.XVMsgHtml, 
    dbo.TMstMMessageFrame.XVMsfType
FROM dbo.TLogTItmVMSMessage INNER JOIN
    dbo.TMstMMessageFrame ON dbo.TLogTItmVMSMessage.XVMsfCode = dbo.TMstMMessageFrame.XVMsfCode INNER JOIN
    dbo.TMstMMessage ON dbo.TMstMMessageFrame.XVMsgCodeF1 = dbo.TMstMMessage.XVMsgCode INNER JOIN
    dbo.TMstMMsgSize ON dbo.TMstMMessageFrame.XVMssCode = dbo.TMstMMsgSize.XVMssCode
WHERE dbo.TLogTItmVMSMessage.XVVmsCode = '$XVMsgCode'";

  
//echo $sql;
$querySQL = sqlsrv_query($conn, $sql);
$result_row = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC);

$k="SELECT * FROM  [NWL_SpeedWayTest2].[dbo].[TMstMMessage] WHERE  XVMsgCode ='".$result_row['XVMsgCodeF2']."'";  
$r = sqlsrv_query($conn, $k);
$ht = sqlsrv_fetch_array($r, SQLSRV_FETCH_ASSOC);

$XIMssWPixel=$ht['XIMssWPixel'];
$XIMssHPixel=$ht['XIMssHPixel'];
$XVMsgFileName=$ht['XVMsgFileName'];
$html=$ht['XVMsgHtml'];
$data=str_replace($XVMsgFileName,"media/tmp/".$XVMsgFileName,$html);
echo $data;


}
if($v==3){

    $sql ="SELECT dbo.TLogTItmVMSMessage.XVVmsCode, dbo.TLogTItmVMSMessage.XTWhenEdit,
    DATEDIFF(Second, dbo.TLogTItmVMSMessage.XTWhenEdit, GETDATE()) AS XiSecDiff, 
    dbo.TLogTItmVMSMessage.XVMsfCode, 
    dbo.TMstMMessageFrame.XVMsfFormat, 
   dbo.TMstMMessageFrame.XVMsgCodeF3,
    dbo.TMstMMessage.XVMsgFileName,  
    dbo.TMstMMsgSize.XIMssWPixel, 
    dbo.TMstMMsgSize.XIMssHPixel, 
    dbo.TMstMMessage.XVMsgHtml, 
    dbo.TMstMMessageFrame.XVMsfType
FROM dbo.TLogTItmVMSMessage INNER JOIN
    dbo.TMstMMessageFrame ON dbo.TLogTItmVMSMessage.XVMsfCode = dbo.TMstMMessageFrame.XVMsfCode INNER JOIN
    dbo.TMstMMessage ON dbo.TMstMMessageFrame.XVMsgCodeF1 = dbo.TMstMMessage.XVMsgCode INNER JOIN
    dbo.TMstMMsgSize ON dbo.TMstMMessageFrame.XVMssCode = dbo.TMstMMsgSize.XVMssCode
WHERE dbo.TLogTItmVMSMessage.XVVmsCode = '$XVMsgCode'";

  
//echo $sql;
$querySQL = sqlsrv_query($conn, $sql);
$result_row = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC);

$k="SELECT * FROM  [NWL_SpeedWayTest2].[dbo].[TMstMMessage] WHERE  XVMsgCode ='".$result_row['XVMsgCodeF3']."'";  
$r = sqlsrv_query($conn, $k);
$ht = sqlsrv_fetch_array($r, SQLSRV_FETCH_ASSOC);

$XIMssWPixel=$ht['XIMssWPixel'];
$XIMssHPixel=$ht['XIMssHPixel'];
$XVMsgFileName=$ht['XVMsgFileName'];
$html=$ht['XVMsgHtml'];
$data=str_replace($XVMsgFileName,"media/tmp/".$XVMsgFileName,$html);
echo $data;


}
if($v==4){

    $sql ="SELECT dbo.TLogTItmVMSMessage.XVVmsCode, dbo.TLogTItmVMSMessage.XTWhenEdit,
    DATEDIFF(Second, dbo.TLogTItmVMSMessage.XTWhenEdit, GETDATE()) AS XiSecDiff, 
    dbo.TLogTItmVMSMessage.XVMsfCode, 
    dbo.TMstMMessageFrame.XVMsfFormat, 
   dbo.TMstMMessageFrame.XVMsgCodeF4,
    dbo.TMstMMessage.XVMsgFileName,  
    dbo.TMstMMsgSize.XIMssWPixel, 
    dbo.TMstMMsgSize.XIMssHPixel, 
    dbo.TMstMMessage.XVMsgHtml, 
    dbo.TMstMMessageFrame.XVMsfType
FROM dbo.TLogTItmVMSMessage INNER JOIN
    dbo.TMstMMessageFrame ON dbo.TLogTItmVMSMessage.XVMsfCode = dbo.TMstMMessageFrame.XVMsfCode INNER JOIN
    dbo.TMstMMessage ON dbo.TMstMMessageFrame.XVMsgCodeF1 = dbo.TMstMMessage.XVMsgCode INNER JOIN
    dbo.TMstMMsgSize ON dbo.TMstMMessageFrame.XVMssCode = dbo.TMstMMsgSize.XVMssCode
WHERE dbo.TLogTItmVMSMessage.XVVmsCode = '$XVMsgCode'";

  
//echo $sql;
$querySQL = sqlsrv_query($conn, $sql);
$result_row = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC);

$k="SELECT * FROM  [NWL_SpeedWayTest2].[dbo].[TMstMMessage] WHERE  XVMsgCode ='".$result_row['XVMsgCodeF4']."'";  
$r = sqlsrv_query($conn, $k);
$ht = sqlsrv_fetch_array($r, SQLSRV_FETCH_ASSOC);

$XIMssWPixel=$ht['XIMssWPixel'];
$XIMssHPixel=$ht['XIMssHPixel'];
$XVMsgFileName=$ht['XVMsgFileName'];
$html=$ht['XVMsgHtml'];
$data=str_replace($XVMsgFileName,"media/tmp/".$XVMsgFileName,$html);
echo $data;


}
if($v==5){

    $sql ="SELECT dbo.TLogTItmVMSMessage.XVVmsCode, dbo.TLogTItmVMSMessage.XTWhenEdit,
    DATEDIFF(Second, dbo.TLogTItmVMSMessage.XTWhenEdit, GETDATE()) AS XiSecDiff, 
    dbo.TLogTItmVMSMessage.XVMsfCode, 
    dbo.TMstMMessageFrame.XVMsfFormat, 
   dbo.TMstMMessageFrame.XVMsgCodeF5,
    dbo.TMstMMessage.XVMsgFileName,  
    dbo.TMstMMsgSize.XIMssWPixel, 
    dbo.TMstMMsgSize.XIMssHPixel, 
    dbo.TMstMMessage.XVMsgHtml, 
    dbo.TMstMMessageFrame.XVMsfType
FROM dbo.TLogTItmVMSMessage INNER JOIN
    dbo.TMstMMessageFrame ON dbo.TLogTItmVMSMessage.XVMsfCode = dbo.TMstMMessageFrame.XVMsfCode INNER JOIN
    dbo.TMstMMessage ON dbo.TMstMMessageFrame.XVMsgCodeF1 = dbo.TMstMMessage.XVMsgCode INNER JOIN
    dbo.TMstMMsgSize ON dbo.TMstMMessageFrame.XVMssCode = dbo.TMstMMsgSize.XVMssCode
WHERE dbo.TLogTItmVMSMessage.XVVmsCode = '$XVMsgCode'";

$querySQL = sqlsrv_query($conn, $sql);
$result_row = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC);

$k="SELECT * FROM  [NWL_SpeedWayTest2].[dbo].[TMstMMessage] WHERE  XVMsgCode ='".$result_row['XVMsgCodeF5']."'";  
$r = sqlsrv_query($conn, $k);
$ht = sqlsrv_fetch_array($r, SQLSRV_FETCH_ASSOC);

$XIMssWPixel=$ht['XIMssWPixel'];
$XIMssHPixel=$ht['XIMssHPixel'];
$XVMsgFileName=$ht['XVMsgFileName'];
$html=$ht['XVMsgHtml'];
$data=str_replace($XVMsgFileName,"media/tmp/".$XVMsgFileName,$html);
echo $data;


}
?>

