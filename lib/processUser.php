<?php
ob_start();
session_start();
header('Content-Type: application/json');
include "DatabaseManage.php";

$Type=$_POST["Type"];
//add user
if($Type==1){
    $usercode=$_POST["usercode"];
    $emailer=$_POST["emailer"];
    $password=$_POST["password"];
    $phone=$_POST["phone"];
    $userActive=$_POST["userActive"];
    $nameThai=$_POST["nameThai"];
    $usercreate=$_SESSION['user'];
    
    $sql="select XVCstCode from TMstMUser='$usercreate'";
   
    $querySQL = sqlsrv_query($conn, $sql);
    $XVCstCode="";
    while($resultSQL = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC))
    {
        $XVCstCode=$resultSQL['XVCstCode'];
    }

    $stmtInsert = "INSERT INTO TMstMUser (
                                XVUsrCode,
                                XVUsrPwd,
                                XVUsrPwdDef,
                                XVUsrName,
                                XVUsrPhone,
                                XVCstCode,
                                XBUsrIsActive2,
                                XBUsrIsActive,
                                XVWhoCreate,
                                XTWhenCreate
                                 )values(
                                 '".$emailer."',
                                 dbo.FN_GETtEncoding('".$password."','".$password."'),
                                 dbo.FN_GETtEncoding('".$password."','".$password."'),
                                 '".$emailer."',
                                 '".$phone."',
                                 '$XVCstCode',
                                 '1',
                                 '1',
                                 '".$usercreate."',
                                 GETDATE()
                                 )";
    $query = sqlsrv_query($conn, $stmtInsert);
}
    


//unsctive user
if($Type==3){
    $usercreate=$_SESSION['user'];
    $XVUsrCode=$_POST['XVUsrCode'];
    $stmt = "UPDATE TMstMUser SET XBUsrIsActive = '0', XBUsrIsActive2 = '0',XVWhoEdit='".$usercreate."',XTWhenEdit='".date('Y-m-d H:i:s')."' WHERE XVUsrCode='".$XVUsrCode."';";

    $query = sqlsrv_query($conn, $stmt);
    /*
    $stmtUserActive = "SELECT XBUsrIsActive,XBUsrIsActive2,XVCstCode FROM TMstMUser WHERE XVUsrCode='".$usercode."'";

    $queryUserActive = sqlsrv_query($conn, $stmtUserActive);
    $resultUserActive = sqlsrv_fetch_array($queryUserActive, SQLSRV_FETCH_ASSOC);
    if($resultUserActive['XBUsrIsActive']==0){
        echo 1;
    }else{
        echo 0;
    }
    $stmt = "UPDATE TMstMCustomer SET XBCstIsActive = '0',XVWhoEdit='".$usercode."',XTWhenEdit='".date('Y-m-d H:i:s')."' WHERE XVCstCode='".$resultUserActive['XVCstCode']."';";
    $query = sqlsrv_query($conn, $stmt);
    */
}

//active user
if($Type==2){
    $usercreate=$_SESSION['user'];
    $XVUsrCode=$_POST['XVUsrCode'];
    $stmt = "UPDATE TMstMUser SET XBUsrIsActive = '1', XBUsrIsActive2 = '1',XVWhoEdit='".$usercreate."',XTWhenEdit='".date('Y-m-d H:i:s')."' WHERE XVUsrCode='".$XVUsrCode."';";
  
    $query = sqlsrv_query($conn, $stmt);
    /*
    $stmtUserActive = "SELECT XBUsrIsActive,XBUsrIsActive2,XVCstCode FROM TMstMUser WHERE XVUsrCode='".$usercode."'";

    $queryUserActive = sqlsrv_query($conn, $stmtUserActive);
    $resultUserActive = sqlsrv_fetch_array($queryUserActive, SQLSRV_FETCH_ASSOC);
    if($resultUserActive['XBUsrIsActive']==1){
        echo 1;
    }else{
        echo 0;
    }
    $stmt = "UPDATE TMstMCustomer SET XBCstIsActive = '1',XVWhoEdit='".$usercode."',XTWhenEdit='".date('Y-m-d H:i:s')."' WHERE XVCstCode='".$resultUserActive['XVCstCode']."';";
    $query = sqlsrv_query($conn, $stmt);
    */
}

