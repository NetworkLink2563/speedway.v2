<?php

function Menu_Sub($PrjCode){
    $dbm=new DatabaseManage();
      $sql1="SELECT COUNT(dbo.TMstMCamera.XVCamCode) AS CountCamera
      FROM            dbo.TMstMSetupPoint INNER JOIN
                               dbo.TMstMCamera ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMCamera.XVSupCode
      WHERE        (dbo.TMstMSetupPoint.XVPrjCode = '$PrjCode') AND (dbo.TMstMCamera.XBCamIsActive = 1)";
      $result=$dbm->QueryDB($sql1);
      $JsonObj = json_decode($result);
      $CountCamera=0;
      foreach ($JsonObj as $result){ 
        $CountCamera=$result->CountCamera;
      }
    
      
      $sql="SELECT COUNT(dbo.TMstMWeatherSensor.XVWssCode) AS CountWss
            FROM dbo.TMstMSetupPoint INNER JOIN
                 dbo.TMstMWeatherSensor ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMWeatherSensor.XVSupCode
            WHERE (dbo.TMstMSetupPoint.XVPrjCode = '$PrjCode') AND (dbo.TMstMWeatherSensor.XBIsActive = 1)";
      $result=$dbm->QueryDB($sql);
      $JsonObj = json_decode($result);
      $CountWss=0;
      foreach ($JsonObj as $result){ 
        $CountWss=$result->CountWss;
      }

      $sql="SELECT COUNT(dbo.TMstMSpeedEnforce.XVSpeCode) AS CountSpeed
            FROM  dbo.TMstMSetupPoint INNER JOIN
                dbo.TMstMSpeedEnforce ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMSpeedEnforce.XVSupCode
            WHERE (dbo.TMstMSetupPoint.XVPrjCode = '$PrjCode') AND (dbo.TMstMSpeedEnforce.XBSpeIsActive = 1)";
      $result=$dbm->QueryDB($sql);
      $JsonObj = json_decode($result);
      $CountSpeed=0;
      foreach ($JsonObj as $result){ 
        $CountSpeed=$result->CountSpeed;
      }
      $sql="SELECT COUNT(dbo.TMstMVmsDirect.XVVmsCode) AS CountVms 
            FROM  dbo.TMstMSetupPoint INNER JOIN
                         dbo.TMstMVmsDirect ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMVmsDirect.XVSupCode
            WHERE (dbo.TMstMSetupPoint.XVPrjCode = '$PrjCode') AND (dbo.TMstMVmsDirect.XBVmsIsActive = 1)";
      $result=$dbm->QueryDB($sql);
      $JsonObj = json_decode($result);
      $CountVms=0;
      foreach ($JsonObj as $result){ 
        $CountVms=$result->CountVms ;
      }

      $sql="SELECT COUNT(dbo.TMstMRada.XVRadaCode) AS CountRada
      FROM            dbo.TMstMSetupPoint INNER JOIN
                         dbo.TMstMRada ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMRada.XVSupCode
            WHERE   (dbo.TMstMSetupPoint.XVPrjCode = '$PrjCode') AND (dbo.TMstMRada.XBRadaIsActive = 1)";

      $result=$dbm->QueryDB($sql);
      $JsonObj = json_decode($result);
      $CountRada=0;  
      foreach ($JsonObj as $result){ 
        $CountRada=$result-> CountRada;
      }


      $sql="SELECT COUNT(dbo.TMstMFsk.XVFskCode) AS CountFsk 
            FROM dbo.TMstMSetupPoint INNER JOIN
                         dbo.TMstMFsk ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMFsk.XVSupCode
            WHERE  (dbo.TMstMSetupPoint.XVPrjCode = '$PrjCode') AND (dbo.TMstMFsk.XBFskIsActive = 1)";

      $result=$dbm->QueryDB($sql);
      $JsonObj = json_decode($result);
      $CountFsk=0;  
      foreach ($JsonObj as $result){ 
        $CountFsk=$result-> CountFsk ;
      }

      $data="";
      if($CountCamera>0){
         $data.='<option value="1">กล้องวงจรปิด</option>';
      }  
      if($CountWss>0){
         $data.='<option value="2">วัดสภาพอากาศ</option>';
      }
      if($CountSpeed>0){
         $data.='<option value="3">ตรวจจับความเร็ว</option>';
      }
      if($CountVms>0){
        $data.='<option value="4">ป้าย Vms</option>';
      }
      if($CountRada>0){
        $data.='<option value="5">เรด้านับรถ</option>';
      }
      if($CountFsk>0){
        $data.='<option selected value="6">Fsk</option>';
      }
      return $data;
}
function DevicePoint($DeviceType,$PrjCode){
 
  $dbm=new DatabaseManage();
  $CstCode=$_SESSION["CstCode"];
  if($DeviceType==1){
      $sql="SELECT dbo.TMstMCamera.XVCamCode, dbo.TMstMCamera.XVCamName, dbo.TMstMSetupPoint.XVSupName, dbo.TMstMSetupPoint.XFSupLatitude, dbo.TMstMSetupPoint.XFSupLongitude, dbo.TMstMProject.XVCstCode
      FROM     dbo.TMstMCamera INNER JOIN
      dbo.TMstMSetupPoint ON dbo.TMstMCamera.XVSupCode = dbo.TMstMSetupPoint.XVSupCode INNER JOIN
      dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode
      WHERE  (dbo.TMstMSetupPoint.XVPrjCode = '$PrjCode') AND (dbo.TMstMProject.XVCstCode = '$CstCode')
      ORDER BY dbo.TMstMCamera.XVCamCode";
  }
  if($DeviceType==2){
      $sql="SELECT dbo.TMstMSetupPoint.XVSupName, dbo.TMstMSetupPoint.XFSupLatitude, dbo.TMstMSetupPoint.XFSupLongitude, dbo.TMstMProject.XVCstCode, dbo.TMstMWeatherSensor.XVWssCode, 
          dbo.TMstMWeatherSensor.XVWssName
      FROM     dbo.TMstMSetupPoint INNER JOIN
          dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode INNER JOIN
          dbo.TMstMWeatherSensor ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMWeatherSensor.XVSupCode
      WHERE  (dbo.TMstMSetupPoint.XVPrjCode = '$PrjCode') AND (dbo.TMstMProject.XVCstCode = '$CstCode')
      ORDER BY dbo.TMstMWeatherSensor.XVWssCode";
  }
  if($DeviceType==3){
    $sql="SELECT  dbo.TMstMSetupPoint.XVSupName, dbo.TMstMSetupPoint.XFSupLatitude, dbo.TMstMSetupPoint.XFSupLongitude, dbo.TMstMProject.XVCstCode, dbo.TMstMSpeedEnforce.XVSpeCode, 
                  dbo.TMstMSpeedEnforce.XVSpeName
          FROM     dbo.TMstMSetupPoint INNER JOIN
                            dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode INNER JOIN
                            dbo.TMstMSpeedEnforce ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMSpeedEnforce.XVSupCode
          WHERE  (dbo.TMstMSetupPoint.XVPrjCode = '$PrjCode') AND (dbo.TMstMProject.XVCstCode = '$CstCode')
          ORDER BY dbo.TMstMSpeedEnforce.XVSpeCode";
  }
  if($DeviceType==4){
    $sql="SELECT dbo.TMstMSetupPoint.XVSupName, dbo.TMstMSetupPoint.XFSupLatitude, dbo.TMstMSetupPoint.XFSupLongitude, dbo.TMstMProject.XVCstCode, dbo.TMstMVmsDirect.XVVmsCode, 
          dbo.TMstMVmsDirect.XVVmsName, dbo.TMstMProject.XVPrjCode
          FROM dbo.TMstMSetupPoint INNER JOIN
          dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode INNER JOIN
          dbo.TMstMVmsDirect ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMVmsDirect.XVSupCode
          WHERE        (dbo.TMstMProject.XVCstCode = '$CstCode') AND (dbo.TMstMProject.XVPrjCode = '$PrjCode')
          ORDER BY dbo.TMstMVmsDirect.XVVmsCode";
  }
  $result=$dbm->QueryDB($sql);
  return $result;
}

function  Camera($ProjectCode){
  $dbm=new DatabaseManage();
  $sql="SELECT dbo.TMstMCamera.XVCamCode, dbo.TMstMCamera.XVCamName, dbo.TMstMSetupPoint.XVSupName, dbo.TMstMSetupPoint.XFSupLatitude, dbo.TMstMSetupPoint.XFSupLongitude, dbo.TMstMProject.XVCstCode
  FROM     dbo.TMstMCamera INNER JOIN
  dbo.TMstMSetupPoint ON dbo.TMstMCamera.XVSupCode = dbo.TMstMSetupPoint.XVSupCode INNER JOIN
  dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode
  WHERE  (dbo.TMstMSetupPoint.XVPrjCode = '$ProjectCode')
  ORDER BY dbo.TMstMCamera.XVCamCode";
  
   $result=$dbm->QueryDB($sql);
   return $result;
}
function SpeedEn($ProjectCode){
  $dbm=new DatabaseManage();
  $sql="SELECT dbo.TMstMSetupPoint.XVSupName, dbo.TMstMSetupPoint.XFSupLatitude, dbo.TMstMSetupPoint.XFSupLongitude, dbo.TMstMProject.XVCstCode, dbo.TMstMProject.XVPrjCode, dbo.TMstMSpeedEnforce.XVSpeCode, 
    dbo.TMstMSpeedEnforce.XVSpeName
  FROM            dbo.TMstMSetupPoint INNER JOIN
    dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode INNER JOIN
    dbo.TMstMSpeedEnforce ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMSpeedEnforce.XVSupCode
  WHERE        (dbo.TMstMProject.XVPrjCode = '$ProjectCode')";
  $result=$dbm->QueryDB($sql);
  return $result;
}
function Vms($ProjectCode){
  $dbm=new DatabaseManage();
  $sql="SELECT        dbo.TMstMSetupPoint.XVSupName, dbo.TMstMSetupPoint.XFSupLatitude, dbo.TMstMSetupPoint.XFSupLongitude, dbo.TMstMProject.XVCstCode, dbo.TMstMProject.XVPrjCode, dbo.TMstMVmsDirect.XVVmsCode, 
                         dbo.TMstMVmsDirect.XVVmsName
        FROM            dbo.TMstMSetupPoint INNER JOIN
                         dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode INNER JOIN
                         dbo.TMstMVmsDirect ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMVmsDirect.XVSupCode
        WHERE        (dbo.TMstMProject.XVPrjCode = '$ProjectCode')";
       $result=$dbm->QueryDB($sql);
       return $result;
}
function Rada($ProjectCode){
   $dbm=new DatabaseManage();
   $sql="SELECT  dbo.TMstMSetupPoint.XVSupName, dbo.TMstMSetupPoint.XFSupLatitude, dbo.TMstMSetupPoint.XFSupLongitude, dbo.TMstMProject.XVCstCode, dbo.TMstMProject.XVPrjCode, dbo.TMstMRada.XVRadaCode, 
                         dbo.TMstMRada.XVRadaName
        FROM dbo.TMstMSetupPoint INNER JOIN
                         dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode INNER JOIN
                         dbo.TMstMRada ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMRada.XVSupCode
        WHERE (dbo.TMstMProject.XVPrjCode = '$ProjectCode')";
  $result=$dbm->QueryDB($sql);
  
  return $result;
}
function Fsk($ProjectCode){
  $dbm=new DatabaseManage();
  $sql="SELECT  dbo.TMstMFsk.XVFskCode, dbo.TMstMFsk.XVFskName, dbo.TMstMSetupPoint.XVSupSetupPoint, dbo.TMstMSetupPoint.XFSupKmPoint, dbo.TMstMSetupPoint.XFSupLatitude, dbo.TMstMSetupPoint.XFSupLongitude, 
      dbo.TMstMProject.XVCstCode FROM     dbo.TMstMFsk INNER JOIN
      dbo.TMstMSetupPoint ON dbo.TMstMFsk.XVSupCode = dbo.TMstMSetupPoint.XVSupCode INNER JOIN
      dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode
  WHERE  (dbo.TMstMProject.XVPrjCode='$ProjectCode') 
  ORDER BY dbo.TMstMFsk.XVFskCode"; 
 
  $result=$dbm->QueryDB($sql);
  return $result;
  
}

function FskNode($ProjectCode){
  $dbm=new DatabaseManage();
  $sql="SELECT dbo.TMstMSetupPoint.XVSupSetupPoint, dbo.TMstMSetupPoint.XFSupKmPoint, dbo.TMstMSetupPoint.XFSupLatitude, dbo.TMstMSetupPoint.XFSupLongitude, dbo.TMstMProject.XVCstCode, dbo.TMstMFskNode.XVFskNodeName, 
  dbo.TMstMFskNode.XVFskNodeCode, COALESCE
      ((SELECT TOP (1) XFFskCurrent
      FROM      dbo.TTrnTFsk
      WHERE   (XVFskNodeCode = dbo.TMstMFskNode.XVFskNodeCode)
      ORDER BY XTFskTime DESC), 0) AS XFFskCurrent,
      (SELECT TOP (1) DATEDIFF(MINUTE, XTFskTime , GETDATE()) 
      FROM      dbo.TTrnTFsk
      WHERE   (XVFskNodeCode = dbo.TMstMFskNode.XVFskNodeCode) 
      ORDER BY XTFskTime DESC) AS MinuteDiff 
     FROM     dbo.TMstMSetupPoint INNER JOIN
  dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode INNER JOIN
  dbo.TMstMFskNode ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMFskNode.XVSupCode
      WHERE  (dbo.TMstMProject.XVPrjCode='$ProjectCode') ORDER BY dbo.TMstMFskNode.XVFskNodeCode";
   
  
    $result=$dbm->QueryDB($sql);
  return $result;
  
}
?>






