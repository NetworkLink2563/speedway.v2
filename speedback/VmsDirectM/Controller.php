<?php
session_start();
include '../lib/DatabaseManage.php';
include "../Function/Function.php";
include "Model.php";
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {  
    
   
    
    
     if(isset($_POST["ShowBodyTable"]))
     {   $PrjCode=$_POST["PrjCode"];                           
         echo ShowBodyTable($PrjCode); 
     }
     if(isset($_POST["InserUpdateSms"]))
     { 
        $PrjCode=$_POST["PrjCode"];
        $MediaVmsCode=$_POST["MediaVmsCode"];
        $MediaName=$_POST["MediaName"];
        $Sms=$_POST["Sms"];
        $Type=$_POST["Type"];
        $Mode=$_POST["Mode"];
        InserUpdateSms($PrjCode,$MediaVmsCode,$Mode,$Type,$Sms,$MediaName);
     }
    
     if(isset($_POST["Search"]))
     {
        $MediaVmsCode=$_POST["MediaVmsCode"];
      
        echo Search($MediaVmsCode);
     } 
    
     if(isset($_POST["Delete"]))
     {
        $MediaVmsCode=$_POST["MediaVmsCode"];
        $Type=$_POST["Type"];
        
        echo Delete($MediaVmsCode,$Type);
     } 
     if(isset($_POST['UploadFile'])){
      
         $PrjCode=$_POST['PrjCode'];
         $MediaVmsCode=$_POST['PrjCode'];
         $MediaName=$_POST['MediaName'];
         UploadPicture($PrjCode,$MediaVmsCode,$MediaName);    
     }  
     if(isset($_POST['UploadTemplate'])){
      
        $PrjCode=$_POST['PrjCode'];
        $MediaVmsCode=$_POST['PrjCode'];
        $MediaName=$_POST['MediaName'];
        UploadTemplate($PrjCode,$MediaVmsCode,$MediaName);    
    }  
    if(isset($_POST['UploadTemplateMap'])){
      
        $PrjCode=$_POST['PrjCode'];
        $MediaVmsCode=$_POST['PrjCode'];
        $MediaName=$_POST['MediaName'];
        UploadTemplateMap($PrjCode,$MediaVmsCode,$MediaName);    
    }  
     if(isset($_POST['UploadVdo'])){
      
        $PrjCode=$_POST['PrjCode'];
        $MediaVmsCode=$_POST['PrjCode'];
        $MediaName=$_POST['MediaName'];
        UploadVdo($PrjCode,$MediaVmsCode,$MediaName);    
    }  
     if(isset($_POST["ShowImg"]))
     {
         $MediaVmsCode=$_POST['MediaVmsCode'];
      
         Search($MediaVmsCode);
     }
   

    
}
?>