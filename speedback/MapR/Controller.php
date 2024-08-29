<?php
session_start();
include '../lib/DatabaseManage.php';
include "Model.php";

if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {  
   
   if(isset($_POST['ShowSubMenu'])){
      $PrjCode=$_POST['PrjCode'];
      echo Menu_Sub($PrjCode);
   }
   if(isset($_POST["ShowMap"]))
   {
       $PrjCode=$_POST["Project"];
       $DeviceType=$_POST["DeviceType"]; 
       echo DevicePoint($DeviceType,$PrjCode);
   } 
   if(isset($_POST["Camera"])){   
      $ProjectCode=$_POST["ProjectCode"];  
      echo Camera($ProjectCode);
   }
   if(isset($_POST["SpeedEn"])){   
      $ProjectCode=$_POST["ProjectCode"];  
      echo SpeedEn($ProjectCode);
   }
  
   if(isset($_POST["Vms"])){   
      $ProjectCode=$_POST["ProjectCode"];  
      echo  Vms($ProjectCode);
   }

   if(isset($_POST["Rada"])){     
      $ProjectCode=$_POST["ProjectCode"];
      echo Rada($ProjectCode);
   }
   if(isset($_POST["Fsk"])){     
      $ProjectCode=$_POST["ProjectCode"];
      echo Fsk($ProjectCode);
   }
   if(isset($_POST["FskNode"])){   
      $ProjectCode=$_POST["ProjectCode"];  
      echo FskNode($ProjectCode);
   }
}
?>