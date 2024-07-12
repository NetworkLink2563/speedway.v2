<?php
ob_start();
session_start();
include "DatabaseManage.php";
$username=$_POST["username"];
$password=$_POST["password"];
$md5Hash=$_POST["encode"];
$XVShfCode=$_POST["XVShfCode"];
    if ($md5Hash == 'd56b699830e77ba53855679cb1d252da') {

        $sql="SELECT XVShfCode, XIShfStartHour, XIShfStartMin, XIShfEndHour, XIShfEndMin
              FROM   dbo.TMstMShift
              WHERE  (XVShfCode = '$XVShfCode')";
      
        $query = sqlsrv_query($conn, $sql);
        while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
        {
             $_SESSION['XIShfStartHour'] = $result["XIShfStartHour"];
             $_SESSION['XIShfStartMin'] = $result["XIShfStartMin"];
             $_SESSION['XIShfEndHour'] = $result["XIShfEndHour"];
             $_SESSION['XIShfEndMin'] = $result["XIShfEndMin"];
        }
      
      
        $stmt = "DECLARE @tUser nvarchar(100)
    DECLARE @tPassword nvarchar(100)
    SET @tUser = '" . $username . "'
    SET @tPassword = '" . $password . "'
    SELECT XVUsrCode,dbo.FN_GETtDecoding(XVUsrPwd,@tPassword) as 'password' ,XVUsrPwdDef,XVUsrName,XVCstCode
    FROM TMstMUser
    WHERE XVUsrCode=@tUser and XBUsrIsActive=1";
   
        $query = sqlsrv_query($conn, $stmt);
        $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
        $realPass = $result["password"];
        $realUser = $result["XVCstCode"];
        $realUserName = $result["XVUsrName"];
        
        if ($realPass != '') {
            $_SESSION['user'] = $username;
            $_SESSION['userName'] = $realUserName;
            $result = "True";

            $REMOTE_ADDR=$_SERVER['REMOTE_ADDR'];
            $sql="INSERT INTO TLogLogIn (XVUsrCode, XTLogInTime, XVFromIp)
            VALUES ('$username', GETDATE(), '$REMOTE_ADDR')";
        
            sqlsrv_query($conn, $sql);

        } else {
            $_SESSION['user'] = '';
            $result = "False";
        }
        echo $result;
    }
?>