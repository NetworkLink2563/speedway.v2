<?php
session_start();

if(!isset($_SESSION["XVUsrCode"])){
	echo"Session คุณหมดอายุ กรุณาเข้าสู่ระบบอีกครั้ง";
	echo"<meta http-equiv='refresh' content='0; url=http://127.0.0.1/speedback/Dashboard/'>";
	exit();
	}

    require("../../config/config.NWL_SpeedWayTest2.php");
 // Delete Department
if(isset($_POST['del']) and $_POST['del']=='0001'){

    if (isset($_POST['val1'])) {$val1 = htmlspecialchars($_POST['val1'], ENT_QUOTES);} else {$val1 = "";}
    // Check if have data in table user, can't delete department this. <- Sivadol.J Note
    $ql1= "SELECT *  FROM [dbo].[TMstMUser] WHERE XVDptCode='$val1'";
    $ql1i=sqlsrv_query($conn, $ql1);
    $qlr=sqlsrv_fetch_array($ql1i, SQLSRV_FETCH_ASSOC);
    if($qlr){
        echo '2'; // have data already.
    }else{
      $del="DELETE FROM [dbo].[TMstMDepartment] WHERE XVDptCode='$val1'";
      $deli=sqlsrv_query($conn,$del);       
      echo '1';     
    }
    // end check

}
 // Delete Shift Time
 if(isset($_POST['del']) and $_POST['del']=='0002'){

    if (isset($_POST['val1'])) {$val1 = htmlspecialchars($_POST['val1'], ENT_QUOTES);} else {$val1 = "";}
    // Check if have data in table user, can't delete department this. <- Sivadol.J Note
    $ql1= "SELECT *  FROM [dbo].[TMstMUser] WHERE XVShfCode='$val1'";
    $ql1i=sqlsrv_query($conn, $ql1);
    $qlr=sqlsrv_fetch_array($ql1i, SQLSRV_FETCH_ASSOC);
    if($qlr){
        echo '2'; // have data already.
    }else{
      $del="DELETE FROM [dbo].[TMstMShift] WHERE XVShfCode='$val1'";
      $deli=sqlsrv_query($conn,$del);       
      echo '1';     
    }
    // end check

}
 // Delete privileage
 if(isset($_POST['del']) and $_POST['del']=='0003'){

  if (isset($_POST['xvusercode'])) {$xvusercode = htmlspecialchars($_POST['xvusercode'], ENT_QUOTES);} else {$xvusercode = "";}
  if (isset($_POST['xvmenucode'])) {$xvmenucode = htmlspecialchars($_POST['xvmenucode'], ENT_QUOTES);} else {$xvmenucode = "";}

  $ql1= "DELETE FROM [dbo].[TMnyMUserMenu] WHERE XVUsrCode='$xvusercode' AND XVMnuCode = '$xvmenucode'";
  $ql1i=sqlsrv_query($conn, $ql1);
  if($ql1i== false){   echo 'Error';}else{ echo '1';}
  // end check

}
?>