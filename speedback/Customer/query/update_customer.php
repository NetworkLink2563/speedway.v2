<?php
session_start();

if(!isset($_SESSION["XVUsrCode"])){
	echo"Session คุณหมดอายุ กรุณาเข้าสู่ระบบอีกครั้ง";
	echo"<meta http-equiv='refresh' content='0; url=http://127.0.0.1/speedback/Dashboard/'>";
	exit();
	}

    require("../../config/config.NWL_SpeedWayTest2.php");

if(isset($_POST['edit']) and $_POST['edit']=='0001'){
    //Get Standard Session
    $XVWhoEdit = $_SESSION['XVUsrCode']; // userEdit
    $datetimeEdit=date('Y-m-d H:i:s'); // datetimeEdit

    if (isset($_POST['XVCstCode'])) {$XVCstCode = htmlspecialchars($_POST['XVCstCode'], ENT_QUOTES);} else {$XVCstCode = "";}
    if (isset($_POST['XVCstName'])) {$XVCstName = htmlspecialchars($_POST['XVCstName'], ENT_QUOTES);} else {$XVCstName = "";}
    if (isset($_POST['XVCstDescription'])) {$XVCXVCstDescriptionstName = htmlspecialchars($_POST['XVCstDescription'], ENT_QUOTES);} else {$XVCstDescription  = "";}
    if (isset($_POST['XVCstPhone'])) {$XVCstPhone = htmlspecialchars($_POST['XVCstPhone'], ENT_QUOTES);} else {$XVCstPhone  = "";}
    if(isset($_POST['XVCstEmail'])){ $XVCstEmail=htmlspecialchars($_POST['XVCstEmail'],ENT_QUOTES);}else{$XVCstEmail="";}
    if(isset($_POST['XBCstIsActive'])){ $XBCstIsActive=htmlspecialchars($_POST['XBCstIsActive'],ENT_QUOTES);}else{$XBCstIsActive="";}
    if(isset($_POST['XVCstNamechk'])){ $XVCstNamechk=htmlspecialchars($_POST['XVCstNamechk'],ENT_QUOTES);}else{$XVCstNamechk="";}
     // XVCstNamechk ชื่อเดิม
     // XVCstName ชื่อที่แก้ไข
    // check XVCstName ชื่อลูกค้าเดิมกับชื่อลูกค้าใหม่ ถ้ามีข้อมูลเท่ากันจะทำรายการ Update 
    
    if($XVCstName==$XVCstNamechk){
      $eq="UPDATE [dbo].[TMstMCustomer] SET 
       [XVCstName] = '$XVCstName'
      ,[XVCstDescription] = '$XVCXVCstDescriptionstName'
      ,[XVCstPhone] = '$XVCstPhone'
      ,[XVCstEmail] = '$XVCstEmail'
      ,[XBCstIsAlwReg] = ''
      ,[XBCstIsActive] ='$XBCstIsActive'
      ,[XVWhoEdit] = '$XVWhoEdit'
      ,[XTWhenEdit] = '$datetimeEdit'
       WHERE XVCstCode='$XVCstCode'";
       $h=sqlsrv_query($conn, $eq);
       if($h==true){echo '1';}else{echo 'error';}
    }else{
      // check user XVCstName > 1 customer  // กรณีไม่เท่ากันจะทำรายการตรวจสอบจากชือผู้ใช้งานไม่ให้ซ้ำกัน
      $e1="SELECT XVCstName FROM [dbo].[TMstMCustomer] WHERE XVCstName='$XVCstName'";
      $er1=sqlsrv_query($conn,$e1);
      $er1l=sqlsrv_fetch_array($er1,SQLSRV_FETCH_ASSOC);
    if($er1l){
      echo 2;
    }else{
      $b="UPDATE [dbo].[TMstMCustomer] SET 
       [XVCstName] = '$XVCstName'
      ,[XVCstDescription] = '$XVCXVCstDescriptionstName'
      ,[XVCstPhone] = '$XVCstPhone'
      ,[XVCstEmail] = '$XVCstEmail'
      ,[XBCstIsAlwReg] = ''
      ,[XBCstIsActive] ='$XBCstIsActive'
      ,[XVWhoEdit] = '$XVWhoEdit'
      ,[XTWhenEdit] = '$datetimeEdit'
       WHERE XVCstCode='$XVCstCode'";
       $b1=sqlsrv_query($conn, $b);
       if($b1==true){echo '1';}else{echo 'error';}

    } 
 }
}
 ?>