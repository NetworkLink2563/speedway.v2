<?php
ob_start();
session_start();
include "config_NWL.php";
if(isset($_POST['load']) and $_POST['load']=='0001'){
    $username=$_POST["userName"];
    $password=$_POST["password"];
    $Q="SELECT XVShfCode FROM [NWL_SpeedWayTest2].[dbo].[TMstMUser] WHERE XVUsrCode='$username'";
    $Qk=sqlsrv_query($conn, $Q);
    if($Qk==false){die(print_r(sqlsrv_errors(),true));}
    $QF=sqlsrv_fetch_array($QK, SQLSRV_FETCH_ASSOC);
     echo $QF['XVShfCode'];
     sqlsrv_free_stmt($Qk);
     sqlsrv_close($conn);
  }

?>