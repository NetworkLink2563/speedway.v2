<?php
ob_start();
session_start();

if(isset($_POST['load']) and $_POST['load']=='0001'){
    $username=$_POST["userName"];
    $password=$_POST["password"];
    include "config_NWL.php";
    $Q="SELECT XVShfCode FROM [NWL_SpeedWayTest2].[dbo].[TMstMUser] WHERE XVUsrCode='$username'";
    echo $Q;
    $Qk=sqlsrv_query($conn, $Q);
     $QF=sqlsrv_fetch_array($QK, SQLSRV_FETCH_ASSOC);
     echo $QF['XVShfCode'];
   

  }

?>