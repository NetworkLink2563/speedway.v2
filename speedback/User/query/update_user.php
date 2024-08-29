<?php
session_start();

if(!isset($_SESSION["XVUsrCode"])){
	echo"Session คุณหมดอายุ กรุณาเข้าสู่ระบบอีกครั้ง";
	echo"<meta http-equiv='refresh' content='0; url=http://127.0.0.1/speedback/'>";
	exit();
	}

    require("../../config/config.NWL_SpeedWayTest2.php");

    if(isset($_POST['edit']) and $_POST['edit']=='0001'){
        //Get Standard Session
    $XVWhoEdit = $_SESSION['XVUsrCode']; // userEdit
    $datetimeEdit=date('Y-m-d H:i:s'); // datetimeEdit
        if (isset($_POST['XVUsrCodex'])) {$XVUsrCodex = htmlspecialchars($_POST['XVUsrCodex'], ENT_QUOTES);} else {$XVUsrCodex = "";} 
        if (isset($_POST['XVUsrPwdx'])) {$XVUsrPwdx = htmlspecialchars(md5(base64_encode(md5(base64_encode($_POST['XVUsrPwdx'])))), ENT_QUOTES);} else {$XVUsrPwdx = "NWL";} // time strart
        if (isset($_POST['XVUsrNamex'])) {$XVUsrNamex = htmlspecialchars($_POST['XVUsrNamex'], ENT_QUOTES);} else {$XVUsrNamex = "";} 
        if (isset($_POST['XVUsrPhonex'])) {$XVUsrPhonex = htmlspecialchars($_POST['XVUsrPhonex'], ENT_QUOTES);} else {$XVUsrPhonex = "";} 
        if (isset($_POST['idcustx'])) {$idcustx = htmlspecialchars($_POST['idcustx'], ENT_QUOTES);} else {$idcustx = "";} 
        if (isset($_POST['XVUsrDefaultPrjx'])) {$XVUsrDefaultPrjx = htmlspecialchars($_POST['XVUsrDefaultPrjx'], ENT_QUOTES);} else {$XVUsrDefaultPrjx = "";} 
        if (isset($_POST['XVShfCodex'])) {$XVShfCodex = htmlspecialchars($_POST['XVShfCodex'], ENT_QUOTES);} else {$XVShfCodex = "";} 
        if (isset($_POST['XBUsrIsActivex'])) {$XBUsrIsActivex = htmlspecialchars($_POST['XBUsrIsActivex'], ENT_QUOTES);} else {$XBUsrIsActivex = "";}
        if (isset($_POST['XBUsrIsCstAdminx'])) {$XBUsrIsCstAdminx = htmlspecialchars($_POST['XBUsrIsCstAdminx'], ENT_QUOTES);} else {$XBUsrIsCstAdminx = "";}  
        if(isset($_POST['XVDptCodex'])){$XVDptCodex=htmlspecialchars($_POST['XVDptCodex'], ENT_QUOTES);}else{$XVDptCodex="";}

        
        $ul="UPDATE [dbo].[TMstMUser] SET 
            [XVUsrPwd]='$XVUsrPwdx'
           ,[XVUsrPwdDef] ='$XVUsrPwdx'
           ,[XVUsrName]='$XVUsrNamex'
           ,[XVUsrPhone]='$XVUsrPhonex'
           ,[XVUsrDefaultPrj] ='$XVUsrDefaultPrjx'
           ,[XVCstCode] ='$idcustx'
           ,[XVDptCode] ='$XVDptCodex'
           ,[XBUsrIsActive] ='$XBUsrIsActivex'
           ,[XBUsrIsCstAdmin] ='$XBUsrIsCstAdminx'
           ,[XVShfCode] ='$XVShfCodex'
           ,[XVWhoEdit]='$XVWhoEdit'
           ,[XTWhenEdit] ='$datetimeEdit' WHERE XVUsrCode='$XVUsrCodex'" ;

          $ulq=sqlsrv_query($conn, $ul);
          if($ulq==true){ echo '1';}else{ echo 'error';}
}