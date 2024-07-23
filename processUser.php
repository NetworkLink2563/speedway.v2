<?php
ob_start();
session_start();
include "lib/DatabaseManage.php";

$Type=$_POST["Type"];

//add user
if($Type==1){
   
    $emailer=$_POST["emailer"];
    $password=$_POST["password"];
    $XVShfCode=$_POST["XVShfCode"];
    $usercreate=$_SESSION['user'];
    $sql="select XVCstCode from TMstMUser where XVUsrCode='$usercreate'";
    $querySQL = sqlsrv_query($conn, $sql);
    while($resultSQL = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC))
    {
        $XVCstCode=$resultSQL['XVCstCode'];
    }
    
    $stmtInsert = "INSERT INTO TMstMUser (
                                XVUsrCode,
                                XVUsrPwd,
                                XVUsrPwdDef,
                                XVUsrName,
                                XVCstCode,
                                XVShfCode,
                                XBUsrIsActive2,
                                XBUsrIsActive,
                                XVWhoCreate,
                                XTWhenCreate
                                 )values(
                                 '$emailer',
                                 dbo.FN_GETtEncoding('$password','$password'),
                                 dbo.FN_GETtEncoding('$password','$password'),
                                 '$emailer',
                                 '$XVCstCode',
                                 '$XVShfCode',
                                 '1',
                                 '1',
                                 '$usercreate',
                                 GETDATE()
                                 )";
    echo    $stmtInsert;
    sqlsrv_query($conn, $stmtInsert);
    sqlsrv_close( $conn );
}
    


/*
if($Type==2){
    $stmt = "UPDATE TMstMUser SET XBUsrIsActive = '0', XBUsrIsActive2 = '0',XVWhoEdit='".$usercode."',XTWhenEdit='".date('Y-m-d H:i:s')."' WHERE XVUsrCode='".$usercode."';";
    $query = sqlsrv_query($conn, $stmt);

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
}


if($Type==3){
    $stmt = "UPDATE TMstMUser SET XBUsrIsActive = '1', XBUsrIsActive2 = '1',XVWhoEdit='".$usercode."',XTWhenEdit='".date('Y-m-d H:i:s')."' WHERE XVUsrCode='".$usercode."';";
    $query = sqlsrv_query($conn, $stmt);

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
}
*/
sqlsrv_close( $conn );
?>

