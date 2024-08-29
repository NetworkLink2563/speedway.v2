<?php
session_start();
include '../lib/DatabaseManage.php';
include "../Function/Function.php";
include "Model.php";


if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') { 
   if(isset($_POST["InsertUpdate"])){
      $Mode=$_POST["Mode"];
      $VmsCode=$_POST["VmsCode"];
      $SupCode=$_POST["SupCode"];
      $RouteCode=$_POST["RouteCode"];
      $RouteName=$_POST["RouteName"];
      $RoadNumber=$_POST["RoadNumber"];
      $Latitude=$_POST["Latitude"];
      $Longtitude=$_POST["Longtitude"];
      $Latitudeend=$_POST["Latitudeend"];
      $Longtitudend=$_POST["Longtitudend"];
      $RouteIsActive=$_POST["RouteIsActive"];
      $RouteName=str_replace("'","''",$RouteName);
      $RoadNumber=str_replace("'","''",$RoadNumber);
      $Latitude=str_replace("'","''",$Latitude);
      $Longtitude=str_replace("'","''",$Longtitude);
      $Latitudeend=str_replace("'","''",$Latitudeend);
      $Longtitudeed=str_replace("'","''",$Longtitudeed);
      $Ip=str_replace("'","''",$Ip);
      if ($Mode==0){
          echo Insert($RouteCode, $RouteName, $RoadNumber, $Latitude, $Longtitude, $Latitudeend, $Longtitudend, $RouteIsActive, $SupCode,$VmsCode);
      }else if($Mode==1){
          echo Update($RouteCode, $RouteName, $RoadNumber, $Latitude, $Longtitude, $Latitudeend, $Longtitudend, $RouteIsActive, $SupCode,$VmsCode);
      }
   }
   if(isset($_POST["Edit"])){
       $RouteCode=$_POST["RouteCode"];
       echo Search($RouteCode);
   }  
   if(isset($_POST["ShowPoint"]))
   {
       $PrjCode=$_POST["PrjCode"];
       echo ShowBodyTable($PrjCode);
   } 
   if(isset($_POST["Delete"]))
   {
      $RouteCode=$_POST["RouteCode"];
      Delete($RouteCode);
   }
   if(isset($_POST["InsertUpdatePoint"])){
      $ModePoint=$_POST['ModePoint'];
      $RouteCode=$_POST['RouteCode'];
      $PointName=$_POST['PointName'];
      $Latitude=$_POST['Latitude'];
      $Longitude=$_POST['Longitude'];
      if($ModePoint==0){
          echo InsertDt($RouteCode,$PointName,$Latitude,$Longitude);
      }
   }
  
   if(isset($_POST["ShowPointDT"])){
      $RouteCode=$_POST['RouteCode'];
      echo ShowBodyTableDT($RouteCode);
   }
   if(isset($_POST["DeletePointDt"])){
      $RoutedtId=$_POST['RoutedtId'];
      echo DeletePointDT($RoutedtId);
     
   }
   
   if(isset($_POST["UpdateXY"])){
      $RoutCode=$_POST['RoutCode'];
      $RouteNameAdjX=$_POST['RouteNameAdjX'];
      $RouteNameAdjY=$_POST['RouteNameAdjY'];
      $RoadNumberStartX=$_POST['RoadNumberStartX'];
      $RoadNumberStartY=$_POST['RoadNumberStartY'];
      $RoadNumberEndX=$_POST['RoadNumberEndX'];
      $RoadNumberEndY=$_POST['RoadNumberEndY'];
      UpdateXY( $RoutCode,$RouteNameAdjX,$RouteNameAdjY,$RoadNumberStartX,$RoadNumberStartY,$RoadNumberEndX,$RoadNumberEndY);
      
   }
   if(isset($_POST["ShowBodyTable"]))
   {    $PrjCode=$_POST["PrjCode"];
       echo ShowBodyTable($PrjCode); 
   }
   if(isset($_POST["SetPoint"]))
   {  $PrjCode=$_POST["PrjCode"];
      $SupCode=$_POST["SupCode"];
      echo  InPutSelect_SetupPoint($SupCode,$PrjCode);
   }
   if(isset($_POST["VmsDirect"]))
   {  $PrjCode=$_POST["PrjCode"];
      $VmsCode=$_POST["VmsCode"];
      echo  InPutSelect_VmsDirect($VmsCode,$PrjCode);
   }
}
?>