<?php
session_start();
include '../lib/DatabaseManage.php';
include "Model.php";
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {  
   
   if(isset($_POST['ShowSubMenu'])){
      $PrjCode=$_POST['PrjCode'];
      echo Menu_Sub($PrjCode);
   }
   if(isset($_POST["ShowRout"])){
      $VmsCode=$_POST["VmsCode"];
      echo InPutSelect_Rout($VmsCode);
   }
   if(isset($_POST["InsertUpdatePoint"])){
      $RouteCode=$_POST["RouteCode"];
      $PointX=$_POST["PointX"];
      $PointY=$_POST["PointY"];
      $Color=$_POST["Color"];
      echo InsertUpdatePoint($RouteCode,$PointX,$PointY,$Color);
   }
   if(isset($_POST["ShowDataTable"])){
      $VmsCode=$_POST["VmsCode"];
      echo ShowDataTable($VmsCode);
   }

   if(isset($_POST["InsertTimeGmap"])){
      $VmsCode=$_POST["VmsCode"];
      $RouteCode=$_POST["RouteCode"];
      $PointX=$_POST["PointX"];
      $PointY=$_POST["PointY"];
      InsertTimeGmap($VmsCode,$RouteCode,$PointX,$PointY);
   }
   if(isset($_POST["ShowDataTableTableGTime"])){
      $VmsCode=$_POST["VmsCode"];
      echo ShowDataTableGTime($VmsCode);
   }
   if(isset($_POST['UploadFile'])){
      $VMSC=$_POST['VMSC'];
      $PointX=$_POST['PointX'];
      $PointY=$_POST['PointY'];
      UploadPicture($VMSC,$PointX,$PointY);
   }   
   if(isset($_POST["ShowDataTableImage"])){
      $VmsCode=$_POST["VmsCode"];
      echo ShowDataTableImage($VmsCode);
   }
   if(isset($_POST["EditXY"])){
      $Select=$_POST["Select"];
      $Id=$_POST["XYID"];
      $X=$_POST["X"];
      $Y=$_POST["Y"];
      if($Select==1){
         echo EditXYPointRoad($Id,$X,$Y);
      }
      if($Select==2){
         echo EditXYPointImage($Id,$X,$Y);
      }
      if($Select==3){
         echo EditXYPointGMap($Id,$X,$Y);
      }
   }
   if(isset($_POST["DeletePointImageXy"])){
      $RoutePointXyImageID=$_POST['RoutePointXyImageID'];
      echo DeleteImageXy($RoutePointXyImageID);
   } 
   if(isset($_POST["DeleteXPointGMapXy"])){
      $RoutePointGMapID=$_POST["RoutePointGMapID"];
      echo DeleteGMapXy($RoutePointGMapID);
   }
  if(isset($_POST["DeletePointXy"])){
      $RoutePointXyID=$_POST['RoutePointXyID'];
      echo DeletePointXy($RoutePointXyID);
   }
}
?>