<?php
session_start();

include '../lib/DatabaseManage.php';
include "Model.php";
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') { 
   
    if(isset($_POST['VmsMenu'])){
      $PrjCode=$_POST['PrjCode'];
      echo Menu_Vms($PrjCode);
    }

  
    
    if(isset($_POST['UpdateSms1'])){
      $VmsCode=$_POST['VmsCode'];
      $TxtSms1=$_POST['TxtSms1'];
      echo UpdateSms1($VmsCode,$TxtSms1);
    }
    if(isset($_POST['UpdateSms2'])){
      $VmsCode=$_POST['VmsCode'];
      $TxtSms2=$_POST['TxtSms2'];
      echo UpdateSms2($VmsCode,$TxtSms2);
    }
    if(isset($_POST['UpdateSms3'])){
      $VmsCode=$_POST['VmsCode'];
      $TxtSms3=$_POST['TxtSms3'];
      echo UpdateSms3($VmsCode,$TxtSms3);
    }
    if(isset($_POST['SearchVms'])){
      $VmsCode=$_POST['VmsCode'];
      echo SearchVms( $VmsCode);
    }
    if(isset($_POST['UpdateStream'])){
      $VmsCode=$_POST['VmsCode'];
      $XVLinkStream=$_POST['XVLinkStream'];
      echo UpdateStream($VmsCode,  $XVLinkStream);
    }
    if(isset($_POST['UploadLogo'])){
      $VmsCode=$_POST['VmsCode'];
   
      echo UploadLogo($VmsCode);    
   }  
   if(isset($_POST['UploadMap'])){
      $VmsCode=$_POST['VmsCode'];
    
      echo UploadMap($VmsCode);    
   }  
   if(isset($_POST['UpdatePoint'])){
      $VmsCode=$_POST['VmsCode'];
      $X1=$_POST['X1'];
      $Y1=$_POST['Y1'];
      $X2=$_POST['X2'];
      $Y2=$_POST['Y2'];
      $PointNumber=$_POST['PointNumber'];
      $Remark=$_POST['Remark'];
      echo UpdatePoint($VmsCode,$X1,$Y1,$X2,$Y2,$PointNumber,$Remark);
   }  
   if(isset($_POST['ShowPoint'])){
     
     $VmsCode=$_POST['VmsCode'];
    
     echo ShowPoint($VmsCode);
   } 
   if(isset($_POST['DeletePoint'])){
      $VmsCode=$_POST['VmsCode'];
      $XVPointNumber=$_POST['XVPointNumber'];
    
      echo  DeletePoint($VmsCode,$XVPointNumber);
   }
   if(isset($_POST['SerchPoint'])){
      $VmsCode=$_POST['VmsCode'];
      $XVPointNumber=$_POST['XVPointNumber'];
  
      echo  SerchPoint($VmsCode,$XVPointNumber);
   }
   if(isset($_POST['ShowData'])){
       
        $VmsCode=$_POST['VmsCode'];
      
        echo ShowData($VmsCode);
   }
   
}
?>