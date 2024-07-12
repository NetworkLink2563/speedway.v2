<?php
ob_start();
session_start();

include "lib/DatabaseManage.php";
$de=$_REQUEST['de'];
$ds=$_REQUEST['ds'];
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
   
    <pageheader name="MyHeader1" content-left="รายงงานการปฏิบัติงาน วันที่ '.$ds. ' ถึง '.$de.'"   header-style="font-size: 8pt;font-weight: bold; color: #000000;" line="on" />

    <pagefooter name="MyFooter1" content-left="" content-center="" footer-style="font-size: 8pt;" line="on"/>
   
    <table>
         <tr>
            <td style="width: 200px;text-align: left;">วันที่</td>
            <td style="width: 400px;text-align: left;">ผู้ใช้</td>
         </tr>
    ';
       
    
    $sql = "SELECT   CONVERT(varchar,dbo.TLogLogIn.XTLogInTime,120) as XTLogInTime, dbo.TLogLogIn.XVUsrCode, dbo.TMstMUser.XVUsrName
    FROM            dbo.TLogLogIn INNER JOIN
                             dbo.TMstMUser ON dbo.TLogLogIn.XVUsrCode = dbo.TMstMUser.XVUsrCode where dbo.TLogLogIn.XTLogInTime>='$ds' and dbo.TLogLogIn.XTLogInTime<='$de' 
    ORDER BY dbo.TLogLogIn.XTLogInTime";
    $query = sqlsrv_query($conn, $sql);

    while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
      
        $html .='<tr>
            <td style="text-align: left;">'.$row['XTLogInTime'].'</td>
            <td style="text-align: left;">'.$row['XVUsrName'].'</td>
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