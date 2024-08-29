<?php
session_start();

if(!isset($_SESSION["XVUsrCode"])){
	echo"Session คุณหมดอายุ กรุณาเข้าสู่ระบบอีกครั้ง";
	echo"<meta http-equiv='refresh' content='0; url=http://127.0.0.1/speedback/Dashboard/'>";
	exit();
	}

    require("../../config/config.NWL_SpeedWayTest2.php");

if(isset($_POST['del']) and $_POST['del']=='0001'){// component major

    $delid=$_POST['dlid'];
    $u1="SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMUser] WHERE XVCstCode='$delid'";
    $ul1=sqlsrv_query($conn,$u1);
    $ulq1=sqlsrv_fetch_array($ul1, SQLSRV_FETCH_ASSOC);
    if($ulq1){
        echo '2';
    }else{
        $del="DELETE FROM [dbo].[TMstMCustomer] WHERE XVCstCode='$delid'";
        $delq=sqlsrv_query($conn,$del);
        if($delq==true){ echo '1';}else{ echo 'error';}
    }

} 








?>