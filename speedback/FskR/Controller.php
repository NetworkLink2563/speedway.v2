<?php
session_start();
include '../lib/DatabaseManage.php';
include "Model.php";
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {  
   
   if(isset($_POST['ShowSubMenu'])){
      $PrjCode=$_POST['PrjCode'];
      $StrDate=$_POST['StrDate'];

      //echo Menu_Sub($PrjCode);
     // echo  ShowTableStatus($PrjCode,$StrDate);
   }
   
   if(isset($_POST["Chart_1"])){    
      $PrjCode=$_POST["Pcode"];  
      
       echo Chart1($PrjCode);
   }
   if(isset($_POST["Chart2"])){   
      $PrjCode=$_POST["PrjCode"];  
      echo Chart2($PrjCode);
   }
   if(isset($_POST["Chart4"])){    
      $PrjCode=$_POST["Pcode"];   
      echo Chart4( $PrjCode);
   }
   if(isset($_POST["Chart5"])){     
      echo Chart5();
   }
   if(isset($_POST["Chart6"])){     
      echo Chart6();
   }
   if(isset($_POST["ShowTableStatus"])){     
      
      $PrjCode=$_POST["PrjCode"];
      $StrDate=$_POST["StrDate"];
    
      echo  ShowTableStatus($PrjCode,$StrDate);
   }
   if(isset($_POST["LampOnOFF"])){ 
      $PrjCode=$_POST["PrjCode"];
      $StrDate=$_POST["StrDate"]; 
      echo LampOnOFF($PrjCode,$StrDate);
   }   

}
?>