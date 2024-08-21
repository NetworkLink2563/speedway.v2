<?php
ob_start();
session_start();
include "lib/DatabaseManage.php";
$XVMsgCode=$_POST['XVMsgCode'];
$nameMSG=$_POST['XVMsgName'];
$data=$_POST['data'];
$vmsSize=$_POST['idmsgSize'];
$msgBG=$_POST['msgBG'];
$XVMsgCode=$_POST['XVMsgCode'];
$XVMsgInfoType=$_POST['XVMsgInfoType'];

if($nameMSG!=''){

$ProcedSQL = "DECLARE @tCode nvarchar(100)
EXEC dbo. STP_NWLtGetMaxCode 'TMstMMessage', @tCode OUTPUT
PRINT 'TMstMMessage' + '-->' + @tCode
";
$queryProcedSQL = sqlsrv_query($conn, $ProcedSQL);
$resultProcedSQL = sqlsrv_fetch_array($queryProcedSQL, SQLSRV_FETCH_ASSOC);

$sqlSize = "SELECT XIMssWPixel,XIMssHPixel FROM TMstMMsgSize WHERE XVMssCode='".$vmsSize."'";
$querySize = sqlsrv_query($conn, $sqlSize);
$resultSize = sqlsrv_fetch_array($querySize, SQLSRV_FETCH_ASSOC);
$sizeW=$resultSize["XIMssWPixel"];
$sizeH=$resultSize["XIMssHPixel"];
$tmp=$data;
$datains="";

    $tmp=explode("|",$tmp);
    if(count($tmp)==3){
        $s=$tmp[0];
        $b='<marquee direction="left">'.$tmp[1].'</marquee>';
        $e=$tmp[2];
        $datains=$s.$b.$e;
    }
    else{
       $datains=$data;
    }
$dataInsert ='<html style="margin:0;padding: 0px;overflow: hidden;">
                <body style="margin: 0px;padding: 0px;overflow: hidden;">';
                          
$dataInsert .= '<div style="overflow: hidden;height: 100vh; width: 100%;margin:0px;;padding:0px;background: '.$msgBG.';">'.$datains.'</div>';
$dataInsert .='</body></html>';


if($XVMsgCode=="MSGXXXX-XXXX"){
    $stmt2Insert = "
    INSERT INTO TMstMMessage (XVMsgInfoType,XVMsgCode,XVMsgName,XVMsgHtml,XVMsgHtmlM,XVMssCode,XVMsgType,XVMsgFileName,XVMsgStatus,XVMsgBg,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
    VALUES ('$XVMsgInfoType','".$resultProcedSQL['ptCode']."','".$nameMSG."','".$dataInsert."','".$data."','".$vmsSize."','1','".$resultProcedSQL['ptCode'].".png','1','".$msgBG."','".$_SESSION['userName']."','','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')";

}else{
    $stmt2Insert = "UPDATE TMstMMessage
    SET XVMsgHtml = '$dataInsert', XVMsgHtmlM = '$data'
    WHERE XVMsgCode='$XVMsgCode'";
}

$stmt  = sqlsrv_query($conn, $stmt2Insert);
if( $stmt === false ) {
    // die( print_r( sqlsrv_errors(), true));
     echo '{'.'"Return":"False","XVMsgCode":""'.'}';
}else{
    echo '{'.'"Return":"True","XVMsgCode":"'.$resultProcedSQL['ptCode'].'"'.'}';
}


/*
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
$ptcode=$resultProcedSQL['ptCode'];
$mpdf->WriteHTML($dataInsert);
$path = "media/tmp/".$resultProcedSQL['ptCode'].".pdf";
$mpdf->Output($path, "F");

$jdata = array("VmsCode" => "VMS2403-0001",
    "PdfFileName" => "C:\\inetpub\\wwwroot\\VMS\\media\\tmp\\".$ptcode.".pdf",
    "PngFileName" => $ptcode.".png",
    "DestinationPath" => "C:\\inetpub\\wwwroot\\VMS\\media\\tmp",
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
*/
}
