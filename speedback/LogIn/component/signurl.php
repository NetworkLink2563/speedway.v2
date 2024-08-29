
<?php 
  
    session_start();
	//recieve user, password
 	$user_login = $_GET['user_login'];
	$pwd_login = $_GET['pwd_login'];
	//ref
	$module_token = 'home';
	$target_dir = 'default';
	//register session
	$_SESSION["login_true"] = $user_login;
 	//check user
     require("../../config/config.NWL_SpeedWayTest2.php");
 $w = "SELECT [XVUsrCode]
      ,[XVUsrPwd]
      ,[XVUsrPwdDef]
      ,[XVUsrName]
      ,[XVUsrPhone]
      ,[XVUsrDefaultPrj]
      ,[XVCstCode]
      ,[XVDptCode]
      ,[XBUsrIsActive2]
      ,[XBUsrIsActive]
      ,[XBUsrIsCstAdmin]
      ,[XVShfCode] FROM  [NWL_SpeedWayTest2].[dbo].[TMstMUser] 
  WHERE [NWL_SpeedWayTest2].[dbo].[TMstMUser].[XVUsrCode]
  LIKE  '$user_login' AND  ([NWL_SpeedWayTest2].[dbo].[TMstMUser].[XVUsrPwd] LIKE '$pwd_login'
  OR [NWL_SpeedWayTest2].[dbo].[TMstMUser].[XVUsrPwd] LIKE '".md5(base64_encode(md5(base64_encode($pwd_login))))."')";
 
  $stmt = sqlsrv_query($conn, $w);
  if ($stmt === false) {die(print_r(sqlsrv_errors(), true));}
  $arr = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
  if ($arr) {
 
  } else {
    echo 'missing user or password';
    exit();
  }
 
	
 
	/* Regist session for version <1.2 */
 
	$position = $arr ['XVDptCode'];

	if($position == 'Admin'){ 
		$dir = "Information"; 
	}
	


	$_SESSION["XVUsrCode"] = $arr['XVUsrCode']; 
	$_SESSION["XVUsrPwd"] = $arr['XVUsrPwd']; 
	$_SESSION["XVUsrName"] = $arr['XVUsrName']; 
	$_SESSION["XVUsrDefaultPrj"] = $arr['XVUsrDefaultPrj']; 
    $_SESSION["XVCstCode"] = $arr['XVCstCode']; 
    $_SESSION["XVDptCode"] = $arr['XVDptCode']; 
    $_SESSION["XBUsrIsActive2"] = $arr['XBUsrIsActive2']; 
    $_SESSION["XBUsrIsActive"] = $arr['XBUsrIsActive']; 
	$_SESSION["XBUsrIsCstAdmin"] = $arr['XBUsrIsCstAdmin']; 

	if($target_dir=='default'){
	      if($arr['XVUsrCode']==$user_login){
		   echo "<meta http-equiv='refresh' content='0; url=../../Dashboard/?m=customer'>";
		  }
	}else{
				echo "error session";
				exit();
    }
  
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);

 ?>
