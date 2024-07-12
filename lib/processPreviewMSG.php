<?php
ob_start();
session_start();
include "DatabaseManage.php";
$vms=$_POST['vms'];
$vmsSize=$_POST['vmsSize'];
$messageCheckboxManual=$_POST['messageCheckboxManual'];
$inputTimerManual=$_POST['inputTimerManual'];
$datestart=$_POST['datestart'];
$dateend=$_POST['dateend'];
$msgBG=$_POST['msgBG'];
$data='111';
$ProcedSQL = "DECLARE @tCode nvarchar(100)
EXEC dbo. STP_NWLtGetMaxCode 'TMstMMessage', @tCode OUTPUT
PRINT 'TMstMMessage' + '-->' + @tCode
";
$queryProcedSQL = sqlsrv_query($conn, $ProcedSQL);
$resultProcedSQL = sqlsrv_fetch_array($queryProcedSQL, SQLSRV_FETCH_ASSOC);
$stmt2Insert = "
INSERT INTO TMstMMessage (XVMsgCode,XVMsgName,XVMsgHtml,XVMssCode,XVMsgType,XVMsgFileName,XVMsgStatus,XVMsgBg,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$resultProcedSQL['ptCode']."','','$data','".$vmsSize."','1','".$resultProcedSQL['ptCode'].".pdf','2','".$msgBG."','".$_SESSION['userName']."','','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
$query = sqlsrv_query($conn, $stmt2Insert);

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
$mpdf->WriteHTML('<div style="margin-top:-100px;width: 300px; height:300px; background: #0a0a0a;"><span style="color:#ffa500"><span style="font-size:48px">asdasdsadasdasdasd</span></span></div>
');
$path = "../media/tmp/sss.pdf";
$mpdf->Output($path, "F");