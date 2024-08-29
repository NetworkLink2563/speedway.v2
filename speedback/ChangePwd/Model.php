<?php
function ShangePwd($UsrPwd)
{  
  $UsrCode=$_SESSION["UsrCode"];
  $dbm=new DatabaseManage();
  $sql="Update TMstMUser SET 
           XVUsrPwd= [dbo].[FN_GETtEncoding]('$UsrPwd','$UsrPwd') 
           WHERE XVUsrCode='$UsrCode'";
  $result=$dbm->QueryDB($sql);
  if($result){
      $ret="Success";
  }else{
      $ret="Err1";
  }
  return $ret;
} 
?>







