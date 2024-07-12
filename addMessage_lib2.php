<?php
ob_start();
session_start();
include "lib/DatabaseManage.php";
$data=$_POST['data'];
$vms=$_POST['vms'];
$vmsSize=$_POST['vmsSize'];
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

$sqlSize = "SELECT XIMssWPixel,XIMssHPixel FROM TMstMMsgSize WHERE XVMssCode='".$vmsSize."'";
$querySize = sqlsrv_query($conn, $sqlSize);
$resultSize = sqlsrv_fetch_array($querySize, SQLSRV_FETCH_ASSOC);
$dataInsert = '<div style="A_CSS_ATTRIBUTE:all;position: absolute;bottom: 0px; right: 0px;left: 0px; top: 0px;  "><div style="margin-top:0px;width: '.$resultSize["XIMssWPixel"].'px; height:'.$resultSize["XIMssHPixel"].'px; background: '.$msgBG.';"><span style="color:#ffa500"><span style="font-size:30px">'.$resultProcedSQL['ptCode'].' '.$data.'</span></span></div>
</div>';

$stmt2Insert = "
INSERT INTO TMstMMessage (XVMsgCode,XVMsgName,XVMsgHtml,XVMssCode,XVMsgType,XVMsgFileName,XVMsgStatus,XVMsgBg,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$resultProcedSQL['ptCode']."','','".$dataInsert."','".$vmsSize."','1','".$resultProcedSQL['ptCode'].".pdf','2','".$msgBG."','".$_SESSION['userName']."','','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
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

$mpdf->WriteHTML($dataInsert);
$path = "media/tmp/".$resultProcedSQL['ptCode'].".pdf";
$mpdf->Output($path, "F");

echo $dataInsert;