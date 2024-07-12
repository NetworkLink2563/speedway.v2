<?php
ob_start();
session_start();
header('Content-Type: application/json');


function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}
include "DatabaseManage.php";
$msgcode=$_POST["msgcode"];
$md5Hash=$_POST["encode"];

//add user
if($md5Hash=='d15866ec75f5cedd2c0865041b9b1a6b'){
    $genCode=generateRandomString();
    $emailer=$_POST["emailer"];
    $password=$_POST["password"];
    $phone=$_POST["phone"];
    $userActive=$_POST["userActive"];
    $nameThai=$_POST["nameThai"];
    $usercreate=$_SESSION['userName'];
    $stmtInsert = "INSERT INTO TMstMUser (XVUsrCode,XVUsrPwd,XVUsrPwdDef,XVUsrName,XVUsrPhone,XVUsrDefaultPrj,XVCstCode,XVDptCode,XBUsrIsActive2,XBUsrIsActive,XBUsrIsCstAdmin,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$emailer."',dbo.FN_GETtEncoding('".$password."','".$password."'),dbo.FN_GETtEncoding('".$password."','".$password."'),'".$emailer."','".$phone."','','".$genCode."','','','".$userActive."','','".$usercreate."','','".date('Y-m-d H:i:s')."',''";
    $query = sqlsrv_query($conn, $stmtInsert);

    $stmt2Insert = "
INSERT INTO TMstMCustomer (XVCstCode,XVCstName,XVCstDescription,XVCstPhone,XVCstEmail,XBCstIsAlwReg,XBCstIsActive,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$genCode."','".$nameThai."','','".$phone."','".$emailer."','','".$userActive."','".$usercreate."','','".date('Y-m-d H:i:s')."',''";
    $query = sqlsrv_query($conn, $stmt2Insert);
}
//unsctive user
if($md5Hash=='76605981da8c7170dd309c591438288b'){
    $usercode=$_SESSION['userName'];
    $stmt = "UPDATE TMstMItmVMS SET XBVmsIsActive = '0',XVWhoEdit='".$usercode."',XTWhenEdit='".date('Y-m-d H:i:s')."' WHERE XVVmsCode='".$VMScode."';";
    $query = sqlsrv_query($conn, $stmt);
    $stmt = "UPDATE TMstMItmVMS_LiveViews SET XBLiveIsActive = '0',XVWhoEdit='".$usercode."',XTWhenEdit='".date('Y-m-d H:i:s')."' WHERE XVVmsCode='".$VMScode."';";
    $query = sqlsrv_query($conn, $stmt);
    $stmt = "UPDATE TMstMItmVMS_Status SET XBVmsIsOn = '0',XVWhoEdit='".$usercode."',XTWhenEdit='".date('Y-m-d H:i:s')."' WHERE XVVmsCode='".$VMScode."';";
    $query = sqlsrv_query($conn, $stmt);
    $stmtUserActive = "SELECT XBVmsIsActive FROM TMstMItmVMS WHERE XVVmsCode='".$VMScode."'";

    //$stmt = "UPDATE TMstMItmVMS_Status SET XBVmsIsDisplay = NULL,XIVmsBrightness=NULL,XIVmsRackTemperature=NULL,XIVmsBoardTemperature=NULL,XBVmsFanIsActive=NULL,XBVmsFlashIsActive=NULL,XVWhoEdit='".$usercode."',XTWhenEdit='".date('Y-m-d H:i:s')."' WHERE XVVmsCode='".$VMScode."';";
    $stmt = "DELETE FROM TMstMItmVMS_Status WHERE XVVmsCode='".$VMScode."'";
    $query = sqlsrv_query($conn, $stmt);

    $queryUserActive = sqlsrv_query($conn, $stmtUserActive);
    $resultUserActive = sqlsrv_fetch_array($queryUserActive, SQLSRV_FETCH_ASSOC);
    if($resultUserActive['XBVmsIsActive']==0){
        echo 1;
    }else{
        echo 0;
    }
}

//active user
if($md5Hash=='7c08aa10ab8b543cf5f3ebab19c55587'){
    $usercode=$_SESSION['userName'];
    $stmt = "UPDATE TMstMItmVMS SET XBVmsIsActive = '1',XVWhoEdit='".$usercode."',XTWhenEdit='".date('Y-m-d H:i:s')."' WHERE XVVmsCode='".$VMScode."';";
    $query = sqlsrv_query($conn, $stmt);
    $stmt = "UPDATE TMstMItmVMS_LiveViews SET XBLiveIsActive = '1',XVWhoEdit='".$usercode."',XTWhenEdit='".date('Y-m-d H:i:s')."' WHERE XVVmsCode='".$VMScode."';";
    $query = sqlsrv_query($conn, $stmt);
    $stmt = "UPDATE TMstMItmVMS_Status SET XBVmsIsOn = '1',XVWhoEdit='".$usercode."',XTWhenEdit='".date('Y-m-d H:i:s')."' WHERE XVVmsCode='".$VMScode."';";
    $query = sqlsrv_query($conn, $stmt);
    $stmtUserActive = "SELECT XBVmsIsActive FROM TMstMItmVMS WHERE XVVmsCode='".$VMScode."'";

    $queryUserActive = sqlsrv_query($conn, $stmtUserActive);
    $resultUserActive = sqlsrv_fetch_array($queryUserActive, SQLSRV_FETCH_ASSOC);
    if($resultUserActive['XBVmsIsActive']==1){
        echo 1;
    }else{
        echo 0;
    }
}

//delete user
if($md5Hash=='9aa1fca65b77dd8b8b7a88dfe547d35c'){
    $stmt = "SELECT TOP 1 XVMsgFileName FROM TMstMMessage WHERE XVMsgCode='".$msgcode."'";
    $query = sqlsrv_query($conn, $stmt);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $delete="../media/tmp/".$result['XVMsgFileName'];
    echo $delete;
    @unlink($delete);

    $stmt = "DELETE FROM TMstMMessage WHERE XVMsgCode='".$msgcode."';";
    //$query = sqlsrv_query($conn, $stmt);
        echo 1;
}
