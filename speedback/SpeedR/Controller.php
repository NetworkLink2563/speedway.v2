<?php
session_start();
include '../lib/DatabaseManage.php';
include "Model.php";

if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {  
   
   if(isset($_POST['ShowSubMenu'])){
      $PrjCode=$_POST['PrjCode'];
      echo Menu_Sub($PrjCode);
   }
   if(isset($_POST['ShowChart'])){
      $RadaCode=$_POST['RadaCode'];  
      $Month=$_POST['Month'];
      $Lane=$_POST['Lane'];
      echo ShowChart2($RadaCode,$Month,$Lane);
   }

   if(isset($_POST['ShowChartCountDay'])){
         $RadaCode=$_POST['RadaCode']; 
         $datepicker=$_POST['datepicker'];  
       
         echo ShowCharCountBydate($RadaCode,$datepicker);

   }
}
?>