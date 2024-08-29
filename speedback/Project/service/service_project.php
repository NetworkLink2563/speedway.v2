<?php
session_start();

if(!isset($_SESSION["XVUsrCode"])){
	echo"Session คุณหมดอายุ กรุณาเข้าสู่ระบบอีกครั้ง";
	echo"<meta http-equiv='refresh' content='0; url=http://127.0.0.1/speedback/Dashboard/'>";
	exit();
	}

    require("../../config/config.NWL_SpeedWayTest2.php");

if(isset($_POST['load']) and $_POST['load']=='0001'){
    $projid=$_POST['idproj'];
    $q="SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMProject] WHERE XVPrjCode='$projid'";
    $cq=sqlsrv_query($conn,$q);
    $qus=sqlsrv_fetch_array($cq, SQLSRV_FETCH_ASSOC);
    $js= json_encode($qus,true);
    print_r($js);

}