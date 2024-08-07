<?php
ob_start();
session_start();
include "lib/DatabaseManage.php";

$Type = $_POST["Type"];

//add user
if ($Type == 1) {

    $emailer = $_POST["emailer"];
    $password = $_POST["password"];
    $pwd = md5(base64_encode(md5(base64_encode($password))));
    $XVShfCode = $_POST["XVShfCode"];
    $usercreate = $_SESSION['user'];

    $qchk = "SELECT * FROM  [NWL_SpeedWayTest2].[dbo].[TMstMUser] WHERE XVUsrCode ='$emailer'";
    $qd = sqlsrv_query($conn, $qchk);
    $qfu = sqlsrv_fetch_array($qd, SQLSRV_FETCH_ASSOC);
    if ($qfu) {
        echo '2';
    } else {
        $sql = "select XVCstCode from TMstMUser where XVUsrCode='$usercreate'";
        $querySQL = sqlsrv_query($conn, $sql);
        while ($resultSQL = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC)) {
            $XVCstCode = $resultSQL['XVCstCode'];
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
                                 '$pwd',
                                 '$pwd',
                                 '$emailer',
                                 '$XVCstCode',
                                 '$XVShfCode',
                                 '1',
                                 '1',
                                 '$usercreate',
                                 GETDATE()
                                 )";
        //echo    $stmtInsert;
        $qchk=sqlsrv_query($conn, $stmtInsert);
        if($qchk==true){ echo '1';}else{ echo 'error';}
        sqlsrv_close($conn);
    }
}  ///  End Type


// Change Password Create By Sivadol.J
if ($Type == 2) {
    $uname = $_POST['uname'];
    $pwdnow = md5(base64_encode(md5(base64_encode($_POST['password']))));

    $qpwd="SELECT * FROM TMstMUser WHERE XVUsrName='$uname'";
    $qc=sqlsrv_query($conn, $qpwd);
    $resultSQL = sqlsrv_fetch_array($qc, SQLSRV_FETCH_ASSOC);
    if($pwdnow==$resultSQL['XVUsrPwdDef']){
        echo '2';
    }else{

    $uppwd = "UPDATE TMstMUser SET  
    XVUsrPwd='" . $pwdnow . "', 
    XVUsrPwdDef='" . $pwdnow . "'
    WHERE XVUsrName='$uname' ";
    $d=sqlsrv_query($conn, $uppwd);
    if($d==true){
         echo '1';
         $_SESSION['chgPwd']='0';
        }else{ 
         echo 'error';
        }
    sqlsrv_close($conn);
    }
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
sqlsrv_close($conn);
