<?php
session_start();
include '../lib/DatabaseManage.php';
include "Model.php";
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {  
   if(isset($_POST["SendToVms"]))
   {
         $VmsCode=$_POST['VmsCode'];  
         echo SendToVms($VmsCode);
   }
   if(isset($_POST['ShowSubMenu'])){
      $PrjCode=$_POST['PrjCode'];
      echo Menu_Sub($PrjCode);
   }
   if(isset($_POST['ShowCamera'])){
      $PrjCode=$_POST['PrjCode'];
    
      echo ShowCamera($PrjCode);
   }
}
?>