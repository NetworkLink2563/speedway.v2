<?php
  include "lib/DatabaseManage.php";
  $ret=1;
  $XVVmsCode=$_POST['XVVmsCode'];
  $XVMsgCode=$_POST['XVMsgCode'];
  $XIVmgOrder=$_POST['XIVmgOrder'];
  $XBVmgHasExpiration=$_POST['XBVmgHasExpiration'];
  $XIVmgDuration=$_POST['XIVmgDuration'];
  $XTVmgStart=$_POST['XTVmgStart'];
  $XTVmgEnd=$_POST['XTVmgEnd'];
  $sql="update TMstMItmVMSMessage set XBVmgHasExpiration=$XBVmgHasExpiration,XIVmgDuration=$XIVmgDuration,XTVmgStart='$XTVmgStart',XTVmgEnd='$XTVmgEnd',XTWhenEdit=GETDATE() 
       where XVVmsCode='$XVVmsCode' and XVMsgCode='$XVMsgCode' and XIVmgOrder='$XIVmgOrder'";

  $query = sqlsrv_query($conn, $sql);   
  if( $query === false ) {
    die( print_r( sqlsrv_errors(), true));
    $ret=0;
  }else{
    $ret=1;
  }
  sqlsrv_close( $conn );  
  echo $ret; 
?>