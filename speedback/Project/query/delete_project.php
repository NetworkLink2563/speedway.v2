<?php
session_start();

if(!isset($_SESSION["XVUsrCode"])){
	echo"Session คุณหมดอายุ กรุณาเข้าสู่ระบบอีกครั้ง";
	echo"<meta http-equiv='refresh' content='0; url=http://127.0.0.1/speedback/Dashboard/'>";
	exit();
	}

    require("../../config/config.NWL_SpeedWayTest2.php");

if(isset($_POST['del']) and $_POST['del']=='0001'){

  $delid= $_POST['delid'];
  $setu="SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMSetupPoint] WHERE XVPrjCode='$delid'"; // check user project > 1 
  $setuq=sqlsrv_query($conn,$setu);
  $setl=sqlsrv_fetch_array($setuq, SQLSRV_FETCH_ASSOC);
  if($setl){
     echo 2 ; 
  }else{
    $deq="DELETE FROM [dbo].[TMstMProject] WHERE XVPrjCode ='$delid'";
    $delk=sqlsrv_query($conn,$deq);
    if($delk==true){ echo 1;}else{ echo 'error';}
  }

}