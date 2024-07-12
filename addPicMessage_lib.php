<?php

ob_start();
session_start();
echo "OK";
/*
include "lib/DatabaseManage.php";
$VMsgName=$_POST['VMsgName'];
$XVMsgStatus=$_POST['XVMsgStatus'];
$idmsgSize=$_POST['idmsgSize'];

$filename = $_FILES['file']['name'];


	$location = "media/tmp/".$filename;
	$imageFileType = pathinfo($location,PATHINFO_EXTENSION);
	$imageFileType = strtolower($imageFileType);




	$response = 0;
	
	
	if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
	     	$response = $location;
	}
	

	echo $response;
	exit;
*/
/*
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
$dataInsert = '<div style="A_CSS_ATTRIBUTE:all;position: absolute;bottom: 0px; right: 0px;left: 0px; top: 0px;  "><div style="margin-top:0px;width: '.$sizeW.'px; height:'.$sizeH.'px; background: '.$msgBG.';">'.$data.'</div></div>';

$stmt2Insert = "
INSERT INTO TMstMMessage (XVMsgCode,XVMsgName,XVMsgHtml,XVMssCode,XVMsgType,XVMsgFileName,XVMsgStatus,XVMsgBg,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$resultProcedSQL['ptCode']."','".$nameMSG."','".$dataInsert."','".$vmsSize."','1','".$resultProcedSQL['ptCode'].".png','3','".$msgBG."','".$_SESSION['userName']."','','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";

$query = sqlsrv_query($conn, $stmt2Insert);

*/


?>