<?php
include "DatabaseManage.php";
$msgCODE=$_POST['msgCODE'];
$ret='{"RETURN":"False"}';

$sql="SELECT        XVMsgCodeF1, XVMsgCodeF2, XVMsgCodeF3, XVMsgCodeF4, XVMsgCodeF5, XVMsfName, XVMsfCode
FROM            dbo.TMstMMessageFrame
WHERE        (XVMsgCodeF1 = '$msgCODE') OR
                         (XVMsgCodeF2 = '$msgCODE') OR
                         (XVMsgCodeF2 = '$msgCODE') OR
                         (XVMsgCodeF3 = '$msgCODE') OR
                         (XVMsgCodeF4 = '$msgCODE') OR
                         (XVMsgCodeF5 = '$msgCODE')";
$count=0;
$query2 = sqlsrv_query($conn, $sql);
while($result2 = sqlsrv_fetch_array($query2, SQLSRV_FETCH_ASSOC)){
    $count++;
    $XVVmsName=$result2["XVMsfCode"]." ".$result2["XVMsfName"];
}

if ($count==0){
    $stmt2 = "SELECT * FROM TMstMItmVMSMessage WHERE XVMsgCode='".$msgCODE."'";
    $query2 = sqlsrv_query($conn, $stmt2);
    while($result2 = sqlsrv_fetch_array($query2, SQLSRV_FETCH_ASSOC)){

        $stmt3 = "SELECT * FROM TMstMMessage WHERE XVMsgCode='".$result2['XVMsgCode']."'";
        $query3 = sqlsrv_query($conn, $stmt3);
        $result3 = sqlsrv_fetch_array($query3, SQLSRV_FETCH_ASSOC);
        @unlink("../media/".$result2['XVVmsCode']."/".$result3['XVMsgFileName']);
    }

    $stmt = "SELECT TOP 1 XVMsgFileName FROM TMstMMessage WHERE XVMsgCode='".$msgCODE."'";
    $query = sqlsrv_query($conn, $stmt);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);

    $stmt = "DELETE FROM TMstMItmVMSMessage WHERE XVMsgCode='".$msgCODE."'";
    $query = sqlsrv_query($conn, $stmt);

    $stmt = "DELETE FROM TMstMMessage WHERE XVMsgCode='".$msgCODE."'";
    $query = sqlsrv_query($conn, $stmt);
    $pdf=explode('.',$result['XVMsgFileName']);
    $pdffile=$pdf[0].'.pdf';
    @unlink("../media/tmp/".$pdffile);
    @unlink("../media/tmp/".$result['XVMsgFileName']);
    $ret='{"RETURN":"True"}';

   
}else{
    $ret='{"RETURN":"False","XVVmsName":"'.$XVVmsName.'"}';
    
}

echo $ret;