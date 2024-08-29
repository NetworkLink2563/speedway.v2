<?php
session_start();
include '../lib/DatabaseManage.php';
include "Model.php";

if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {  
   
   if(isset($_POST['ShowSubMenu'])){
      $PrjCode=$_POST['PrjCode'];
      echo Menu_Sub($PrjCode);
   }
   

   if(isset($_POST['ShowChartCountDay'])){
         $WssCode=$_POST['WssCode']; 
         $datepicker=$_POST['datepicker'];  
         $ChartType=$_POST['ChartType'];
         
         echo ShowCharCountBydate($ChartType,$WssCode,$datepicker);

   }
}
?>