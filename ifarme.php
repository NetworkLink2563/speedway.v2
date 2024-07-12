
<?php
include "lib/DatabaseManage.php";
$XVMsgCode = base64_decode($_GET[ 'msg' ]);
$sql = "SELECT        dbo.TMstMMessage.XVMsgCode, dbo.TMstMMessage.XVMssCode, dbo.TMstMMessage.XVMsgHtml, dbo.TMstMMessage.XVMsgType, dbo.TMstMMessage.XVMsgFileName, dbo.TMstMMsgSize.XIMssWPixel, 
                         dbo.TMstMMsgSize.XIMssHPixel, dbo.TMstMMessage.XVMsgName
FROM            dbo.TMstMMessage INNER JOIN
                         dbo.TMstMMsgSize ON dbo.TMstMMessage.XVMssCode = dbo.TMstMMsgSize.XVMssCode
WHERE        (dbo.TMstMMessage.XVMsgCode = '$XVMsgCode')";


$querySQL = sqlsrv_query($conn, $sql);
$result_row = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC);
$XIMssWPixel=$result_row['XIMssWPixel'];
$XIMssHPixel=$result_row['XIMssHPixel'];
$XVMsgCode=$result_row['XVMsgCode'];
$XVMsgFileName=$result_row['XVMsgFileName'];
$html=$result_row['XVMsgHtml'];

$data=str_replace($XVMsgFileName,"media/tmp/".$XVMsgFileName,$html);
//echo '<div style="text-align: left;height: overflow: hidden;'.$XIMssHPixel.'px;width:'.$XIMssWPixel.'px;>'.$data.'</div>';
echo $data;
?>

