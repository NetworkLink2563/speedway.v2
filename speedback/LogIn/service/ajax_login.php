<?php
require("../../config/config.NWL_SpeedWayTest2.php");
if (isset($_POST['flag']) and $_POST['flag'] == '00001') { //check password 
  $uname = $_POST['uname'];
  $pwd = $_POST['pwd'];

  $q = "SELECT [XVUsrCode], [XVUsrPwd],[XVUsrName],[XBUsrIsActive] FROM  [NWL_SpeedWayTest2].[dbo].[TMstMUser] 
  WHERE [NWL_SpeedWayTest2].[dbo].[TMstMUser].[XVUsrCode]
  LIKE  '$uname' AND  ([NWL_SpeedWayTest2].[dbo].[TMstMUser].[XVUsrPwd] LIKE '$pwd'
  OR [NWL_SpeedWayTest2].[dbo].[TMstMUser].[XVUsrPwd] LIKE '" . md5(base64_encode(md5(base64_encode($pwd)))) . "')";

  $stmt = sqlsrv_query($conn, $q);
  if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
  }
  $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
  /// check XBUsrIsActive2 = 1
  if ($row) {

    $REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
    $sql = "INSERT INTO TLogLogIn (XVUsrCode, XTLogInTime, XVFromIp)
    VALUES ('$uname', GETDATE(), '$REMOTE_ADDR')";
    sqlsrv_query($conn, $sql); // ADD LOG LOGIN BY SIVADOL.J

    echo '{ "RESULT":"true",
   "uname":"' . $uname . '", 
   "status":"' . $row['XBUsrIsActive'] . '" 
    }';
  } else {
    echo '{ "RESULT":"false", "uname":"' . $uname . '"  }';
  }

  sqlsrv_free_stmt($stmt);
  sqlsrv_close($conn);
}
