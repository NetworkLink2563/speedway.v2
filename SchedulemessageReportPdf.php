<?php
ob_start();
session_start();

include "lib/DatabaseManage.php";
$XVVmsCode=$_REQUEST["vmsID"] ;

$sql="SELECT XVVmsName, XVVmsCode, XIVmsPixelW, XIVmsPixelH
      FROM dbo.TMstMItmVMS
      WHERE (XVVmsCode = '$XVVmsCode')";
 $query = sqlsrv_query($conn, $sql);
 while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
    $XVVmsName=$row['XVVmsName'];
    $size='กว้าง='.$row['XIVmsPixelW']."px".' สูง='.$row['XIVmsPixelH']."px";
 }
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
    <pageheader name="MyHeader1" content-left="{DATE j-m-Y}" content-right="{PAGENO}/{nbpg}" header-style="font-weight: bold; color: #000000;" line="on" />

    <pagefooter name="MyFooter1" content-left="" content-center="" footer-style="font-size: 8pt;" line="on"/>
    <p>'.$XVVmsName.' ขนาด '. $size.'</p>
    <table>
         <tr>
            <td style="width: 100px;text-align: center;">ลำดับ</td>
            <td style="width: 200px;">ชื่อข้อความ</td>
            <td style="width: 100px;">ประเภท</td>
            <td style="width: 200px;">ขนาด</td>
            <td style="width: 100px;text-align: center;">เริ่ม</td>
            <td style="width: 100px;text-align: center;">สิ้นสุด</td>
            <td style="width: 100px;text-align: center;">ระยะเวลา</td>
         </tr>
    ';
       
  
        $sql = "SELECT        dbo.TMstMItmVMSMessage.XVVmsCode, dbo.TMstMItmVMS.XVVmsName, dbo.TMstMItmVMSMessage.XIVmgOrder, dbo.TMstMItmVMSMessage.XBVmgHasExpiration, ISNULL(dbo.TMstMItmVMSMessage.XTVmgStart, N'') 
        AS XTVmgStar, ISNULL(dbo.TMstMItmVMSMessage.XTVmgEnd, N'') AS XTVmgEnd, dbo.TMstMMessage.XVMsgName, dbo.TMstMMsgSize.XIMssWPixel, dbo.TMstMMsgSize.XIMssHPixel, 
        dbo.TMstMItmVMSMessage.XIVmgSeqNo, dbo.TMstMMessage.XVMsgType, dbo.TMstMItmVMSMessage.XIVmgDuration
    FROM            dbo.TMstMItmVMSMessage INNER JOIN
        dbo.TMstMMessage ON dbo.TMstMItmVMSMessage.XVMsgCode = dbo.TMstMMessage.XVMsgCode INNER JOIN
        dbo.TMstMItmVMS ON dbo.TMstMItmVMSMessage.XVVmsCode = dbo.TMstMItmVMS.XVVmsCode INNER JOIN
        dbo.TMstMMsgSize ON dbo.TMstMMessage.XVMssCode = dbo.TMstMMsgSize.XVMssCode
        WHERE        (dbo.TMstMItmVMSMessage.XVVmsCode = '$XVVmsCode')
        ORDER BY dbo.TMstMItmVMSMessage.XIVmgOrder";
    
    $query = sqlsrv_query($conn, $sql);
    while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
        $size='กว้าง='.$row['XIMssWPixel']."px".' สูง='.$row['XIMssHPixel']."px";
        if($result_row['XBVmgHasExpiration']!=0)
        {
           $sdate=$result_row['XTVmgStart'];
           $edate=$result_row['XTVmgEnd'];
        }else{
            $sdate="";
            $edate="";
        }
        if($row['XVMsgType']==1){
            $XVMsgType='ข้อความ';
        }elseif($row['XVMsgType']==2){
            $XVMsgType='รูปภาพ';
        }elseif($row['XVMsgType']==3){
            $XVMsgType='วีดีโอ';
        }
        $html .='<tr>
            <td style="text-align: center;">'.$row['XIVmgOrder'] .'</td>
            <td>'.$row['XVMsgName'] .'</td>
            <td>'.$XVMsgType.'</td>
            <td>'.$size.'</td>
            <td style="text-align: center;">'.$sdate.'</td>
            <td style="text-align: center;">'.$edate.'</td>
            <td style="text-align: center;">'.$row['XIVmgDuration'] .'</td>
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