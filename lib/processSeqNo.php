<?php
ob_start();
session_start();
include "DatabaseManage.php";
$XVVmsCode=$_POST['XVVmsCode'];
$typeSeqNo=$_POST['typeSeqNo'];
$XVMsgCode=$_POST['XVMsgCode'];
if($typeSeqNo=='DOWN'){
    $sql = "SELECT        COUNT(XIVmgSeqNo) AS CountItem, XVVmsCode
    FROM            dbo.TMstMItmVMSMessage
    GROUP BY XVVmsCode
    HAVING    (XVVmsCode='$XVVmsCode') and  (XVVmsCode = '$XVMsgCode') ";
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $CountItem=$result['CountItem'];
   

        $sql = "SELECT TOP 1 * FROM TMstMItmVMSMessage WHERE XVVmsCode='$XVVmsCode' and XVMsgCode='$XVMsgCode' ORDER BY XIVmgOrder DESC ";
        $query = sqlsrv_query($conn, $sql);
        $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);

        $lastOrder=$result['XIVmgOrder']+1;
        if($lastOrder> $CountItem ){
            $sql2 = "SELECT * FROM TMstMItmVMSMessage WHERE  XVVmsCode='$XVVmsCode' and XVVmsCode='$XVVmsCode' AND XIVmgOrder='".$lastOrder."' ORDER BY XIVmgOrder DESC ";
            $query2 = sqlsrv_query($conn, $sql2);
            $result2 = sqlsrv_fetch_array($query2, SQLSRV_FETCH_ASSOC);

            $changeUP = $result2['XIVmgOrder']-1;
            $changeDOWN = $result['XIVmgOrder']+1;
            $XVMsgCode1=$result['XVMsgCode'];
            $XVMsgCode2=$result2['XVMsgCode'];
            $stmt2 = "UPDATE TMstMItmVMSMessage SET XIVmgOrder = '$changeDOWN' WHERE XVVmsCode='$XVVmsCode' and XVMsgCode='$XVMsgCode1'";
            $query = sqlsrv_query($conn, $stmt2);
            $stmt = "UPDATE TMstMItmVMSMessage SET XIVmgOrder = '$changeUP' WHERE XVVmsCode='$XVVmsCode' and XVMsgCode='$XVMsgCode2';";
            $query = sqlsrv_query($conn, $stmt);
        }
    }


if($typeSeqNo=='UP'){
    $sql = "SELECT        COUNT(XIVmgSeqNo) AS CountItem, XVVmsCode
    FROM            dbo.TMstMItmVMSMessage
    GROUP BY XVVmsCode
    HAVING    (XVVmsCode='$XVVmsCode') and (XVVmsCode = '$XVMsgCode')";
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $CountItem=$result['CountItem'];
   
        $sql = "SELECT TOP 1 * FROM TMstMItmVMSMessage WHERE XVVmsCode='$XVVmsCode' and XVMsgCode='$XVMsgCode' ORDER BY XIVmgOrder DESC ";
        $query = sqlsrv_query($conn, $sql);
        $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
        if($result['XIVmgOrder']>1){
            $lastOrder=$result['XIVmgOrder']-1;
        
            $sql2 = "SELECT * FROM TMstMItmVMSMessage WHERE XVVmsCode='$XVVmsCode' and XVVmsCode='$XVVmsCode' AND XIVmgOrder='$lastOrder' ORDER BY XIVmgOrder DESC ";
            $query2 = sqlsrv_query($conn, $sql2);
            $result2 = sqlsrv_fetch_array($query2, SQLSRV_FETCH_ASSOC);

            $XVMsgCode1=$result['XVMsgCode'];
            $XVMsgCode2=$result2['XVMsgCode'];
            $changeDOWN = $result2['XIVmgOrder']+1;
            $stmt = "UPDATE TMstMItmVMSMessage SET XIVmgOrder = '$lastOrder' WHERE XVVmsCode='$XVVmsCode' and XVMsgCode='$XVMsgCode1';";
            $query = sqlsrv_query($conn, $stmt);
            $stmt2 = "UPDATE TMstMItmVMSMessage SET XIVmgOrder = '$changeDOWN' WHERE XVVmsCode='$XVVmsCode' and XVMsgCode='$XVMsgCode2'";
            $query = sqlsrv_query($conn, $stmt2);
        }
    
   
}