<?php
session_start();

include '../lib/DatabaseManage.php';
include "Model.php";
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') { 
    if(isset($_POST['UploadFile'])){
      
        $VMSC=$_POST['VMSC'];
       
        UploadPicture($VMSC);
        
     }  
     if(isset($_POST['ShowDataTableImage'])){
        
        $VmsCode=$_POST['VmsCode'];
      
        echo ShowDataTableImage($VmsCode);
    
     } 
     if(isset($_POST['DeleteImage'])){
         $VmsPictureDTID=$_POST['VmsPictureDTID'];
       
         echo DeleteImage($VmsPictureDTID);
     }
     if(isset($_POST["ShowCamera"]))
      {
         $VmsCode=$_POST['VmsCode'];  
         echo ShowCamera($VmsCode);
      }
      if(isset($_POST["SendToVms"]))
      {
         $VmsCode=$_POST['VmsCode'];  
         SendToVms($VmsCode);
      }

      if(isset($_POST['createimg'])){
         $Mode=$_POST["Mode"];
         $PictureId=$_POST["PictureId"];
         $color1=$_POST["color1"];
         $color2=$_POST["color2"];
         $color3=$_POST["color3"];
         $color4=$_POST["color4"];
         $color5=$_POST["color5"];
         $color6=$_POST["color6"];
         $color7=$_POST["color7"];
         $color8=$_POST["color8"];
         $sms1=$_POST["sms1"];
         $sms2=$_POST["sms2"];
         $sms3=$_POST["sms3"];
         $sms4=$_POST["sms4"];
         $sms5=$_POST["sms5"];
         $sms6=$_POST["sms6"];
         $sms7=$_POST["sms7"];
         $sms8=$_POST["sms8"];
         $fontsize1=$_POST["fontsize1"];
         $fontsize2=$_POST["fontsize2"];
         $fontsize3=$_POST["fontsize3"];
         $fontsize4=$_POST["fontsize4"];
         $fontsize5=$_POST["fontsize5"];
         $fontsize6=$_POST["fontsize6"];
         $fontsize7=$_POST["fontsize7"];
         $fontsize8=$_POST["fontsize8"];
        
         $VMSC=$_POST["VMSC"];
         
         TextToBmp($Mode,$PictureId,$color1, $color2, $color3, $color4, $color5, $color6, $color7, $color8, $sms1, $sms2, $sms3, $sms4, $sms5, $sms6, $sms7, $sms8, $fontsize1,$fontsize2,$fontsize3,$fontsize4,$fontsize5,$fontsize6,$fontsize7,$fontsize8,$VMSC);
    }
    if(isset($_POST['VmsMenu'])){
      $PrjCode=$_POST['PrjCode'];
      echo Menu_Vms($PrjCode);
    }

    if(isset($_POST['EditImage'])){
      $Mode=$_POST['Mode'];
      $PictureId=$_POST['PictureId'];
      //echo $Mode;
      //echo $PictureId;
      echo SearchImage($PictureId);
    }

}
?>