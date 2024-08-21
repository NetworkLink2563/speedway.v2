<?php

ob_start();
session_start();
set_time_limit(0);

$ret='{"Return":"False"}';
include "lib/DatabaseManage.php";
$XVMsgName=$_POST['XVMsgName'];
$XVMsgStatus=$_POST['XVMsgStatus'];
$XVMssCode=$_POST['XVMssCode'];
$XVMsgType=$_POST['XVMsgType'];
$XVMsgInfoType=$_POST['XVMsgInfoType'];

$sql="SELECT XVMssCode, XIMssWPixel, XIMssHPixel
      FROM            dbo.TMstMMsgSize
      WHERE  (XVMssCode = '$XVMssCode')";

  $query = sqlsrv_query($conn, $sql);
  $row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);

//echo $sql;

$XIMssWPixel=$row['XIMssWPixel'];    
$XIMssHPixel=$row['XIMssHPixel'];

$filename = $_FILES['file']['name'];
$extension = pathinfo($filename, PATHINFO_EXTENSION);

$ProcedSQL = "DECLARE @tCode nvarchar(100)
EXEC dbo. STP_NWLtGetMaxCode 'TMstMMessage', @tCode OUTPUT
PRINT 'TMstMMessage' + '-->' + @tCode
";

$queryProcedSQL = sqlsrv_query($conn, $ProcedSQL);
$resultProcedSQL = sqlsrv_fetch_array($queryProcedSQL, SQLSRV_FETCH_ASSOC);
$XVMsgCode=$resultProcedSQL['ptCode'];


$filelocation = "media/tmp/".$filename;
$extension = pathinfo($filelocation, PATHINFO_EXTENSION);
//if($XVMsgType==2){
	$filelocation="media/tmp/".$XVMsgCode.'.'.$extension;
	//echo $filelocation;
//}

//print_r($_FILES);

if(move_uploaded_file($_FILES['file']['tmp_name'],$filelocation)){

	if($XVMsgType==3){
		
		$html='<html style="margin:0;padding: 0px;overflow: hidden;">
				<body style="margin: 0px;padding: 0px;overflow: hidden;">
				<div style=" margin:0;padding: 0px;width:100%;height:100%;">
				<video style=" margin: 0px;padding: 0px;width:100%;height:100%;object-fit: cover;" autoplay="true" muted="true">
				<source src="'.$XVMsgCode.'.webm'.'" type="video/webm"></video>
				<div></body></html>';

		if(strtoupper($extension)!='WEBM'){

			$cmd1='C:\\inetpub\\wwwroot\\speedway.v2\\ffmpeg\bin\\ffmpeg -i '.$filelocation .' -c:v libvpx -crf 10 -b:v 8M -c:a libvorbis C:\\inetpub\wwwroot\\speedway.v2\\media\\tmp\\'.$XVMsgCode.'.webm';
			shell_exec($cmd1);
			unlink($filelocation);
			
		}
		if(file_exists('C:\\inetpub\wwwroot\\speedway.v2\\media\\tmp\\'.$XVMsgCode.'.webm')){
			$dur =0;
			$cmd2='C:\\inetpub\\wwwroot\\speedway.v2\\ffmpeg\bin\\ffprobe -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 C:\\inetpub\wwwroot\\speedway.v2\\media\\tmp\\'.$XVMsgCode.'.webm';
			$dur = shell_exec($cmd2);
			if($dur>0){
				$filename=$XVMsgCode.'.webm';
				$XVWhoCreate=$_SESSION['userName'];
				$XTWhenCreate=date('Y-m-d H:i:s');
				$stmt2Insert = "INSERT INTO TMstMMessage (
			    XVMsgInfoType,
				XVMsgCode,
				XVMsgName,
				XVMssCode,
				XVMsgType,
				XVMsgHtml,
				XVMsgFileName,
				XIVdoDuration,
				XVMsgStatus,
				XVWhoCreate,
				XTWhenCreate
				)Values(
				'$XVMsgInfoType',
				'$XVMsgCode',
				'$XVMsgName',
				'$XVMssCode',
				'$XVMsgType',
				'$html',
				'$filename',
				$dur, 
				'1',
				'$XVWhoCreate',
				'$XTWhenCreate'
				)";
				$stmt = sqlsrv_query($conn, $stmt2Insert);
//echo $stmt2Insert.'/'.'1';
				if( $stmt === false ) {
					die( print_r( sqlsrv_errors(), true));
					$ret ='{'.'"Return":"False","XVMsgCode":""'.'}';
			   }else{
				   $ret ='{'.'"Return":"True","XVMsgCode":"'.$resultProcedSQL['ptCode'].'"'.'}';
			   }
			}
		}
	}else{
		    $filename=$XVMsgCode.'.'.$extension;
		    if($XVMsgType==2){
				$html='<html style="margin:0;padding: 0px;overflow: hidden;">
				<body style="margin: 0px;padding: 0px;overflow: hidden;">
				<div style=" margin:0;padding: 0px;width:100%;height:100%;">

				<img  style=" margin: 0px;padding: 0px;width:100%;height:100%;" src="'.$filename.'" >
				<div></body></html>';
			}
		    $XVWhoCreate=$_SESSION['userName'];
			$XTWhenCreate=date('Y-m-d H:i:s');
			$stmt2Insert = "INSERT INTO TMstMMessage (
			XVMsgInfoType,
			XVMsgCode,
			XVMsgName,
			XVMssCode,
			XVMsgType,
			XVMsgHtml,
			XVMsgFileName,
			XVMsgStatus,
			XVWhoCreate,
			XTWhenCreate
			)Values(
			'$XVMsgInfoType',
			'$XVMsgCode',
			'$XVMsgName',
			'$XVMssCode',
			'$XVMsgType',
			'$html',
			'$filename',
			'1',
			'$XVWhoCreate',
			'$XTWhenCreate'
			)";
		
		$stmt  = sqlsrv_query($conn, $stmt2Insert);
//echo $stmt2Insert.'/'.'2';
		if( $stmt === false ) {
			 die( print_r( sqlsrv_errors(), true));
			 $ret ='{'.'"Return":"False","XVMsgCode":""'.'}';
		}else{
			$ret ='{'.'"Return":"True","XVMsgCode":"'.$resultProcedSQL['ptCode'].'"'.'}';
		}
		
	}
	
	
	
		
	
}else{
	
}

echo $ret;
exit;
?>