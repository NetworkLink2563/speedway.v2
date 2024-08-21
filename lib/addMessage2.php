<?php
include "DatabaseManage.php";
$XVMsgName=$_POST['XVMsgName'];
$XVMssCode=$_POST['XVMssCode'];
$XVMsgStatus=$_POST['XVMsgStatus'];
$XVMsgHtml="/media/tmp";
$explode=explode("<div>",$_POST['data']);
$data='<div style="width: 300px; height:300px; background: #0a0a0a;">'.$explode[1];
$stmt = "SELECT TOP 1 XVMsgOrder FROM TMstMMessage ORDER BY XVMsgOrder DESC";
$query = sqlsrv_query($conn, $stmt);
$result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $XVMsgOrder=$result['XVMsgOrder']+1;
$msgCODE="MSGYYMM-".$XVMsgOrder;
$stmt2Insert = "
INSERT INTO TMstMMessage (XVMsgCode,XVMsgName,XVMsgHtml,XVMssCode,XVMsgType,XVMsgFileName,XVMsgStatus,XVMsgOrder,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$msgCODE."','".$XVMsgName."','".$data."','".$XVMssCode."','1','".$msgCODE.".pdf','".$XVMsgStatus."','".$XVMsgOrder."','".$_SESSION['userName']."','','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
$query = sqlsrv_query($conn, $stmt2Insert);

$stmt = "SELECT TOP 1 XVMsgHtml FROM TMstMMessage WHERE XVMsgCode = '".$msgCODE."' ORDER BY XVMsgCode DESC";
$query = sqlsrv_query($conn, $stmt);
$result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);

require_once __DIR__ . '/mpdf/autoload.php';
$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];
$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '\mpdf\fonts',
    ]),
    'fontdata' => $fontData + [
            'sarabun' => [
                'R' => 'SarunThangLuang.ttf',
                'I' => 'THSarabunNew Italic.ttf',
                'B' =>  'THSarabunNew Bold.ttf',
            ]
        ],'default_font' => 'sarabun'
]);
$mpdf->WriteHTML($data);
$path = "../media/tmp/".$msgCODE.".pdf";
$mpdf->Output($path, "F");
echo 1;