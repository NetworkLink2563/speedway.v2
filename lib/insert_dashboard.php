<?php
ob_start();
session_start();

if(isset($_POST['load']) and $_POST['load']=='0001'){
   include "../service/config_NWL.php";
    $val=$_POST["val"];
    $user=$_SESSION['user'];
    $check=$_POST['check'];

     echo $check;
     if($check=='true'){ 
        $Q="INSERT INTO [dbo].[TMstMUserDashboard]
        (XVUsrCode
        ,XIShowColumn)
      VALUES(
         '$user',
         '$val')";
      $Qkx=sqlsrv_query($conn, $Q);
      if($Qkx!==false ){
      echo 1;
      }
     }else{ 
        $R="DELETE FROM [dbo].[TMstMUserDashboard]
      WHERE XVUsrCode='$user' AND XIShowColumn='$val'";
      echo $R;
      $Qki=sqlsrv_query($conn, $R);
      if($Qki!==false ){
        echo 1;
        }
     }
}
?>