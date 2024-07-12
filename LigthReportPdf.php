<?php
ob_start();
session_start();

include "lib/DatabaseManage.php";
$de=$_REQUEST['de'];
$ds=$_REQUEST['ds'];
$vms=$_REQUEST['vms'];
$html = '

<html>
<head>
<style>
    @page {
        size: auto;
        odd-header-name: MyHeader1;
        odd-footer-name: MyFooter1;
    }
    @page chapter2 {
        odd-header-name: MyHeader2;
        odd-footer-name: MyFooter2;
    }
    @page noheader {
        odd-header-name: _blank;
        odd-footer-name: _blank;
    }
    div.chapter2 {
        page-break-before: always;
        page: chapter2;
    }
    div.noheader {
        page-break-before: always;
        page: noheader;
    }
</style>
</head>
<body>
    <pageheader name="MyHeader1" content-left="รายงานระดับความสว่าง วันที่ '.$ds. ' ถึง '.$de.'"   header-style="font-size: 8pt;font-weight: bold; color: #000000;" line="on" />

    <pagefooter name="MyFooter1" content-left="" content-center="" content-right="{PAGENO}/{nbpg}" footer-style="font-size: 8pt;" line="on"/>
    
    <table>
         <tr>
            <td style="width: 200px;text-align: leftr;">วันที่</td>
            <td style="width: 400px;text-align: left;">ป้าย</td>
            <td style="width: 400px;text-align: center;">ความสว่าง</td>
         </tr>
    ';
       
    if($vms==0){
            $sql = "SELECT   dbo.TDocTCmdSchedule.XVSccDocNo, dbo.TDocTCmdSchedule.XDSccDocDate, CONVERT(varchar, dbo.TDocTCmdSchedule.XTSccDocTime, 120) AS XTSccDocTime, dbo.TDocTCmdSchedule.XVVmsCode, 
            dbo.TMstMItmVMS.XVVmsName, dbo.TDocTCmdSchedule.XVCmdCode, dbo.TDocTCmdSchedule.XBSccIsDone, dbo.TDocTCmdSchedule.XBSccIsSchedule, dbo.TDocTCmdSchedule.XVSccValue
        FROM            dbo.TDocTCmdSchedule INNER JOIN
            dbo.TMstMItmVMS ON dbo.TDocTCmdSchedule.XVVmsCode = dbo.TMstMItmVMS.XVVmsCode
        WHERE        (dbo.TDocTCmdSchedule.XVCmdCode = N'001') AND (dbo.TDocTCmdSchedule.XBSccIsDone = 1) AND (XTSccDocTime>='$ds' and XTSccDocTime<='$de') 
        ORDER BY XTSccDocTime DESC";
    }else{
        $sql = "SELECT   dbo.TDocTCmdSchedule.XVSccDocNo, dbo.TDocTCmdSchedule.XDSccDocDate, CONVERT(varchar, dbo.TDocTCmdSchedule.XTSccDocTime, 120) AS XTSccDocTime, dbo.TDocTCmdSchedule.XVVmsCode, 
        dbo.TMstMItmVMS.XVVmsName, dbo.TDocTCmdSchedule.XVCmdCode, dbo.TDocTCmdSchedule.XBSccIsDone, dbo.TDocTCmdSchedule.XBSccIsSchedule, dbo.TDocTCmdSchedule.XVSccValue
        FROM            dbo.TDocTCmdSchedule INNER JOIN
            dbo.TMstMItmVMS ON dbo.TDocTCmdSchedule.XVVmsCode = dbo.TMstMItmVMS.XVVmsCode
        WHERE        (dbo.TDocTCmdSchedule.XVCmdCode = N'001') AND (dbo.TDocTCmdSchedule.XBSccIsDone = 1) AND (XTSccDocTime>='$ds' and XTSccDocTime<='$de') and  (dbo.TDocTCmdSchedule.XVVmsCode = '$vms')
        ORDER BY XTSccDocTime DESC";
    }

    $query = sqlsrv_query($conn, $sql);

    while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
      
        $html .='<tr>
            <td style="text-align: left;">'.$row['XTSccDocTime'].'</td>
            <td style="text-align: left;">'.$row['XVVmsName'].'</td>
            <td style="text-align: center;">'.$row['XVSccValue'].'</td>
        </tr>';
    }
$html .='
</table>
</body>
</html>';                        


require_once __DIR__ . '/mpdf/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];
$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];
$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/mpdf/fonts',
    ]),
    'fontdata' => $fontData + [
        // จุดสำคัญคือตรงชื่อ font ตรงนี้ต้องตัวเล็กหมดครับ
        'th_sarabun' => [
            'R' => 'SarunThangLuang.ttf',
        ]
    ],
    'default_font' => 'th_sarabun',
    
]);
$mpdf->WriteHTML($html);
$path =  'tmp/'.$_SESSION['user'].".pdf";
if(file_exists($path)){
    unlink($path);
}
$mpdf->Output($path, "F");
echo $path; 

?>