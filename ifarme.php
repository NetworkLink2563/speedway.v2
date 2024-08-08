
<?php
include "lib/DatabaseManage.php";
$XVMsgCode = base64_decode($_GET['msg']);




$sql ="SELECT dbo.TLogTItmVMSMessage.XVVmsCode, dbo.TLogTItmVMSMessage.XTWhenEdit, DATEDIFF(Second, dbo.TLogTItmVMSMessage.XTWhenEdit, GETDATE()) AS XiSecDiff, dbo.TLogTItmVMSMessage.XVMsfCode, 
                  dbo.TMstMMessageFrame.XVMsfFormat, dbo.TMstMMessageFrame.XVMsgCodeF1, dbo.TMstMMessage.XVMsgFileName, dbo.TMstMMessageFrame.XVMsgCodeF2, dbo.TMstMMessageFrame.XVMsgCodeF3, 
                  dbo.TMstMMessageFrame.XVMsgCodeF4, dbo.TMstMMessageFrame.XVMsgCodeF5, dbo.TMstMMsgSize.XIMssWPixel, dbo.TMstMMsgSize.XIMssHPixel, dbo.TMstMMessage.XVMsgHtml
FROM     dbo.TLogTItmVMSMessage INNER JOIN
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

//echo $html;
$data=str_replace($XVMsgFileName,"media/tmp/".$XVMsgFileName,$html);
//echo '<div style="text-align: left;height: overflow: hidden;'.$XIMssHPixel.'px;width:'.$XIMssWPixel.'px;>'.$data.'</div>';
echo $data;
?>

