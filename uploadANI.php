<?php
ob_start();
session_start();
include "lib/DatabaseManage.php";
$XVVmsCode=$_POST['vmsCodeANI'];
$nameMSG=$_POST['nameMSGANI'];
$datestart=$_POST['datetimepicker4'];
$datetend=$_POST['datetimepickerend4'];
$inputTimerImg=$_POST['inputTimerANI'];
$img = $_FILES['filer_inputANI']['name'];
$tmp = $_FILES['filer_inputANI']['tmp_name'];
if(!empty($_POST['nameMSGANI']) && !empty($_POST['inputTimerANI'])  ) {
$ProcedSQL = "DECLARE @tCode nvarchar(100)
EXEC dbo. STP_NWLtGetMaxCode 'TMstMMessage', @tCode OUTPUT
PRINT 'TMstMMessage' + '-->' + @tCode
";
$queryProcedSQL = sqlsrv_query($conn, $ProcedSQL);
$resultProcedSQL = sqlsrv_fetch_array($queryProcedSQL, SQLSRV_FETCH_ASSOC);

$XVMsgCode=$resultProcedSQL['ptCode'];
$extension = pathinfo($img, PATHINFO_EXTENSION);
$filename=$XVMsgCode.'.'.$extension;
$filelocation='media/tmp/'.$img;

$path='media/tmp/'.$filename;
$ret=0;
if(move_uploaded_file($tmp,$filelocation)){
  
    if(strtoupper($extension)!='WEBM'){

        $cmd1='C:\\inetpub\\wwwroot\\VMS\\ffmpeg\bin\\ffmpeg -i '.$filelocation .' -c:v libvpx -crf 10 -b:v 8M -c:a libvorbis C:\\inetpub\wwwroot\\VMS\\media\\tmp\\'.$XVMsgCode.'.webm';
        shell_exec($cmd1);
        unlink($filelocation);
        
    }
    if(file_exists('C:\\inetpub\wwwroot\\VMS\\media\\tmp\\'.$XVMsgCode.'.webm')){
        $dur=0;
        $cmd2='C:\\inetpub\\wwwroot\\VMS\\ffmpeg\bin\\ffprobe -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 C:\\inetpub\wwwroot\\VMS\\media\\tmp\\'.$XVMsgCode.'.webm';
        
        $dur = shell_exec($cmd2);
       
        if($dur>0){
            
            $sql = "SELECT XVMssCode FROM TMstMItmVMS WHERE XVVmsCode='" . $XVVmsCode . "' ";
            $querySQL = sqlsrv_query($conn, $sql);
            $result = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC);
            $vmsSize = $result['XVMssCode'];

            $html='<html style="margin:0;padding: 0px;overflow: hidden;">
                            <body style="margin: 0px;padding: 0px;overflow: hidden;">
                            <div style=" margin:0;padding: 0px;width:100%;height:100%;">
                            <video style=" margin: 0px;padding: 0px;width:100%;height:100%;object-fit: cover;" autoplay="true" muted="true">
                            <source src="'.$XVMsgCode.'.webm'.'" type="video/webm"></video>
                            <div></body></html>';
            $fname=$XVMsgCode.'.webm';
            $stmt2Insert = "
            INSERT INTO TMstMMessage (XVMsgCode,XVMsgName,XVMsgHtml,XIVdoDuration,XVMssCode,XVMsgType,XVMsgFileName,XVMsgStatus,XVMsgBg,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
            SELECT '$XVMsgCode','$nameMSG','$html',$dur,'$vmsSize','3','".$fname."','1','','".$_SESSION['userName']."','','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
          
            $query = sqlsrv_query($conn, $stmt2Insert);

                $sql2 = "SELECT TOP 1 XIVmgSeqNo FROM TMstMItmVMSMessage WHERE XVVmsCode='" . $XVVmsCode . "' ORDER BY XIVmgSeqNo desc";
                $querySQL2 = sqlsrv_query($conn, $sql2);
                $result2 = sqlsrv_fetch_array($querySQL2, SQLSRV_FETCH_ASSOC);
                $XIVmgSeqNo = $result2['XIVmgSeqNo']+1;

                $sql4 = "SELECT TOP 1 XIVmgOrder FROM TMstMItmVMSMessage WHERE XVVmsCode='" . $XVVmsCode . "' ORDER BY XIVmgOrder desc";
                $querySQL4 = sqlsrv_query($conn, $sql4);
                $result4 = sqlsrv_fetch_array($querySQL4, SQLSRV_FETCH_ASSOC);
                $XIVmgOrder = $result4['XIVmgOrder']+1;

                if($datestart!='' && $datetend!=''){
                    $XBVmgHasExpiration=1;
                }else{
                    $XBVmgHasExpiration=0;
                }
            $stmtInsert = "
            INSERT INTO TMstMItmVMSMessage (XVVmsCode,XIVmgSeqNo,XIVmgOrder,XVMsgCode,XIVmgDuration,XBVmgHasExpiration,XTVmgStart,XTVmgEnd,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)values(
            '$XVVmsCode',$XIVmgSeqNo,$XIVmgOrder,'$XVMsgCode',$dur,'$XBVmgHasExpiration','$datestart','$datetend','".$_SESSION['userName']."','','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')";
          
            $query = sqlsrv_query($conn, $stmtInsert);
            $ret=1;
        }
    }
       
    }
}else{
    $ret=0;
}
sqlsrv_close( $conn );
echo $ret;