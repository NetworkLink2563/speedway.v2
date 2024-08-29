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
    $XTWhoCreate = $_SESSION['XVUsrCode'];
    $dnow=date('Y-m-d H:i:s');

    if (isset($_POST['XVPrjCode'])) {$XVPrjCode = htmlspecialchars($_POST['XVPrjCode'], ENT_QUOTES);} else {$XVPrjCode = "";}
    if (isset($_POST['XVCstCode'])) {$XVCstCode = htmlspecialchars($_POST['XVCstCode'], ENT_QUOTES);} else {$XVCstCode = "";}
    if (isset($_POST['XVPrjName'])) {$XVPrjName = htmlspecialchars($_POST['XVPrjName'], ENT_QUOTES);} else {$XVPrjName  = "";}
    if (isset($_POST['XVPrjType'])) {$XVPrjType = htmlspecialchars($_POST['XVPrjType'], ENT_QUOTES);} else {$XVPrjType  = "";}
    if(isset($_POST['XVPrjLineToken1'])){ $XVPrjLineToken1=htmlspecialchars($_POST['XVPrjLineToken1'],ENT_QUOTES);}else{$XVPrjLineToken1="";}
    if(isset($_POST['XVPrjLineToken2'])){ $XVPrjLineToken2=htmlspecialchars($_POST['XVPrjLineToken2'],ENT_QUOTES);}else{$XVPrjLineToken2="";}
    if(isset($_POST['XVPrjDescription'])){$XVPrjDescription=htmlspecialchars($_POST['XVPrjDescription'],ENT_QUOTES);}else{$XVPrjDescription="";}
    // check user project > 1 project &  XVPrjName and XVCstCode
    $q1="SELECT XVPrjName,XVCstCode FROM [dbo].[TMstMProject] WHERE XVPrjName='$XVPrjName' OR(XVPrjName='$XVPrjName' AND XVCstCode='$XVCstCode')";
   // echo $q1;
    $qr1=sqlsrv_query($conn,$q1);
    $qr1l=sqlsrv_fetch_array($qr1,SQLSRV_FETCH_ASSOC);
    if($qr1l){
      echo 2;
    }else{
    $proj1="INSERT INTO [dbo].[TMstMProject]
           ([XVPrjCode]
           ,[XVPrjName]
           ,[XVPrjDescription]
           ,[XVPrjType]
           ,[XVCstCode]
           ,[XVPrjLineToken1]
           ,[XVPrjLineToken2]
           ,[XVWhoCreate]
           ,[XTWhenCreate])
     VALUES
           ('$XVPrjCode'
           ,'$XVPrjName'
           ,'$XVPrjDescription'
           ,'$XVPrjType'
           ,'$XVCstCode'
           ,'$XVPrjLineToken1'
           ,'$XVPrjLineToken2'
           ,'$XTWhoCreate'
           ,'$dnow')";
  
            $pjl=sqlsrv_query($conn,$proj1);
            if($pjl== true){ echo '1';}else{ echo 'Error';}

}
}
?>