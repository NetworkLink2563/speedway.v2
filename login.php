<<<<<<< HEAD

<?php
header('Content-type: text/html; charset=utf-8');
ob_start();
session_start();

if(isset($_POST['load']) and $_POST['load']=='0001'){
    $username=$_POST["userName"];
    $password=$_POST["password"];
    include "config_NWL.php";
     $Q="SELECT XVShfCode FROM [NWL_SpeedWayTest2].[dbo].[TMstMUser] WHERE XVUsrCode='$username'";
     $Qk=sqlsrv_query($conn, $Q);
     $QF=sqlsrv_fetch_array($Qk, SQLSRV_FETCH_ASSOC);
     echo $QF['XVShfCode'];
  }

=======

<?php
header('Content-type: text/html; charset=utf-8');
ob_start();
session_start();

if(isset($_POST['load']) and $_POST['load']=='0001'){
    $username=$_POST["userName"];
    $password=$_POST["password"];
    include "config_NWL.php";
     $Q="SELECT XVShfCode FROM [NWL_SpeedWayTest2].[dbo].[TMstMUser] WHERE XVUsrCode='$username'";
     $Qk=sqlsrv_query($conn, $Q);
     $QF=sqlsrv_fetch_array($Qk, SQLSRV_FETCH_ASSOC);
     echo $QF['XVShfCode'];
  }

>>>>>>> origin/main
?>