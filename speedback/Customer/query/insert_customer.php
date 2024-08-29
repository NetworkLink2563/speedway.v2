<?php
session_start();

if(!isset($_SESSION["XVUsrCode"])){
	echo"Session คุณหมดอายุ กรุณาเข้าสู่ระบบอีกครั้ง";
	echo"<meta http-equiv='refresh' content='0; url=http://127.0.0.1/speedback/Dashboard/'>";
	exit();
	}

    require("../../config/config.NWL_SpeedWayTest2.php");

if(isset($_POST['fn']) and $_POST['fn']=='0001'){// component major
    //Get Standard Session
    $XTWhenCreate = $_SESSION['XVUsrCode'];
    $dnow=date('Y-m-d H:i:s');
    if (isset($_POST['XVCstCode'])) {$XVCstCode = htmlspecialchars($_POST['XVCstCode'], ENT_QUOTES);} else {$XVCstCode = "";}
    if (isset($_POST['XVCstName'])) {$XVCstName = htmlspecialchars($_POST['XVCstName'], ENT_QUOTES);} else {$XVCstName = "";}
    if (isset($_POST['XVCstDescription'])) {$XVCXVCstDescriptionstName = htmlspecialchars($_POST['XVCstDescription'], ENT_QUOTES);} else {$XVCstDescription  = "";}
    if (isset($_POST['XVCstPhone'])) {$XVCstPhone = htmlspecialchars($_POST['XVCstPhone'], ENT_QUOTES);} else {$XVCstPhone  = "";}
    if(isset($_POST['XVCstEmail'])){ $XVCstEmail=htmlspecialchars($_POST['XVCstEmail'],ENT_QUOTES);}else{$XVCstEmail="";}
    if(isset($_POST['XBCstIsActive'])){ $XBCstIsActive=htmlspecialchars($_POST['XBCstIsActive'],ENT_QUOTES);}else{$XBCstIsActive="";}
    
    // check user customer > 1 customer 
    $q1="SELECT XVCstName FROM [dbo].[TMstMCustomer] WHERE XVCstName='$XVCstName'";
    $qr1=sqlsrv_query($conn,$q1);
    $qr1l=sqlsrv_fetch_array($qr1,SQLSRV_FETCH_ASSOC);
    if($qr1l){
      echo 2;
    }else{
    $cus1="INSERT INTO [dbo].[TMstMCustomer]
           ([XVCstCode]
           ,[XVCstName]
           ,[XVCstDescription]
           ,[XVCstPhone]
           ,[XVCstEmail]
           ,[XBCstIsAlwReg]
           ,[XBCstIsActive]
           ,[XVWhoCreate]
           ,[XVWhoEdit]
           ,[XTWhenCreate]
           ,[XTWhenEdit])
     VALUES
           ('$XVCstCode'
           ,'$XVCstName'
           ,'$XVCXVCstDescriptionstName'
           ,'$XVCstPhone'
           ,'$XVCstEmail'
           ,''
           ,'$XBCstIsActive'
           ,'$XTWhenCreate'
           ,''
           ,'$dnow'
           ,'')";

            $u1q=sqlsrv_query($conn,$cus1);
            if($u1q== true){ echo '1';}else{ echo 'Error';}

}
}
?>