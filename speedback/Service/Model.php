<?php
include "../lib/AES-128-CTR.php";


function BasicAuth()
{
    $username = 'kOK24RIo625gOSCzPFK5cg==';
    $password = 'ymfqgoZg6BmJatEcSO7bNw==';   
    $ret=false;
    if(($_SERVER['PHP_AUTH_USER'] == $username)||$_SERVER['PHP_AUTH_PW']== $password )
    {
        $ret=true;
    }
    return $ret;
}
if(BasicAuth()!=true){
   echo "Error_Login";
   exit();
}

function SendSpeedEn($Code,$Lane, $Country, $Event, $PlateColor, $PlateNumber, $VehicleType, $Speed, $PlateType, $VehicleColor, $VehicleSign, $VehicleSize, $Time){
    $dbm=new DatabaseManage();
    $sql="INSERT INTO TTrnSpeedEnforce (XVSpeCode,XILane,XVSpeCountry, XVSpeEvent, XVSpePlateColor,XVSpePlateNumber,XVSpeVehicleType,XVSpeSpeed,XVSpePlateType,XVSpeVehicleColor,XVSpeVehicleSign,XVSpeVehicleSize,XVSpeTime) 
    VALUES('$Code',$Lane, '$Country','$Event','$PlateColor','$PlateNumber','$VehicleType', '$Speed','$PlateType','$VehicleColor','$VehicleSign','$VehicleSize','$Time')";  
    echo $sql; 
    $result=$dbm->QueryDB($sql);
    if($result){
        echo "Success";
    }else{
        echo "Error_Insert";
    }
}
function WeatherToVms($WssCode){
    $dbm=new DatabaseManage();
    $sql="SELECT XVWssCode, XVVmsCode
    FROM     dbo.TMstMWeatherSensor
    WHERE  (XVWssCode = '$WssCode')";
    $result=$dbm->QueryDB($sql);
    return $result;
}
function SendWeather($WssCode,$WindSpeed,$WindDirection,$Temperature,$Humidity,$AtmosphicPressure,$Rain,$PM25,$PM10,$PM1)
{   
    $dbm=new DatabaseManage();
    $sql="INSERT INTO TTrnTWeather
      (XVWssCode
      ,XTWstTime
      ,XFWstWindSpeed
      ,XFWstWindDirection
      ,XFWstTemperature
      ,XFWstHumidity
      ,XFWstAtmosphicPressure
      ,XFWstRain
      ,XFWstPM25
      ,XFWstPM10
      ,XFWstPM1
      ) VALUES (
         '$WssCode',
         GETDATE(),
         $WindSpeed,
         $WindDirection,
         $Temperature,
         $Humidity,
         $AtmosphicPressure,
         $Rain,
         $PM25,
         $PM10,
         $PM1
      )";
      echo $sql;
      $result=$dbm->QueryDB($sql);
      if($result){
          echo "Success";
      }else{
          echo "Error_Insert";
      }
      
}
function SendSensorRada($RadaCode,$DateTime,$LaneId,$Duration,$Speed,$Class,$Length,$Range){

    $dbm=new DatabaseManage();
    $sql="INSERT INTO TTrnTRada
    (XVRadaCode
    ,XTRadaTime
    ,XIRadaLaneId
    ,XFRadaDuration
    ,XFRadaSpeed
    ,XIRadaClass
    ,XFRadaLength
    ,XFRadaRange
    ) VALUES (
        '$RadaCode'
       ,'$DateTime'
       ,$LaneId
       ,$Duration
       ,$Speed
       ,$Class
       ,$Length
       ,$Range
    )";
    echo $sql;
    $result=$dbm->QueryDB($sql);
    if($result){
        echo "Success";
    }else{
        echo "Error_Insert";
    }
}
function  SendFsk($NodeCode, $NodeID, $Voltage,$Current,$Power,$Energy){
    $dbm=new DatabaseManage();
    $sql="SELECT [XVFskNodeCode],[XVFskNodeSN] FROM [NWL_VMSControl].[dbo].[TMstMFskNode] WHERE [XVFskNodeSN]='$NodeID' and [XIDISABLE]=0";
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $XVFskNodeCode="";
    $XVFskNodeSN="";
    foreach ($JsonObj as $result){ 
        $XVFskNodeCode=$result->XVFskNodeCode;
        $XVFskNodeSN=$result->XVFskNodeSN;
    }
    $sql="INSERT INTO TTrnTFsk
    (  XVFskCode
      ,XVFskNodeCode
      ,XVNodeID
      ,XFFskVoltage
      ,XFFskCurrent
      ,XFFskPower
      ,XFFskEnergy
      ,XTFskTime
    ) VALUES (
        '$NodeCode'
       ,'$XVFskNodeCode'
       ,'$NodeID'
       ,$Voltage
       ,$Current
       ,$Power
       ,$Energy
       ,GETDATE()
    )";
    echo $sql;
    $result=$dbm->QueryDB($sql);
    if($result){
        echo "Success";
    }else{
        echo "Error_Insert";
    }
}


function DownLoadVmsPlay( $VmsCode){
        $dbm=new DatabaseManage();  
        $sql="SELECT dbo.TMstMMediaVms.XVMediaVmsCode, dbo.TMstMMediaVms.XVMediaName, dbo.TMstMMediaVms.XVMediaType, dbo.TMstMMediaSetVms.XVVmsCode, dbo.TMstMMediaSetVms.XIDelay, 
                dbo.TMstMMediaSetVms.XIID, dbo.TMstMMediaVms.XVPrjCode, dbo.TMstMMediaVms.XVFileName,dbo.TMstMMediaVms.XVSms
            FROM            dbo.TMstMMediaVms INNER JOIN
                dbo.TMstMMediaSetVms ON dbo.TMstMMediaVms.XVMediaVmsCode = dbo.TMstMMediaSetVms.XVMediaVmsCode
            WHERE        (dbo.TMstMMediaSetVms.XVVmsCode = '$VmsCode')
            ORDER BY dbo.TMstMMediaSetVms.XIID";
            $result=$dbm->QueryDB($sql);
            return $result;
}
function DownLoadVmsPlay320480( $VmsCode){
    $dbm=new DatabaseManage();  
    $sql="SELECT XVVmsCode, XVFileLogo, XVFileMap, XVLinkStream, XVSms1, XVSms2, XVSms3
          FROM     dbo.TMstMVmsDirect
          WHERE  (XVVmsCode = '$VmsCode')";
        $result=$dbm->QueryDB($sql);
        return $result;
}
function DownLoadTemplateLabel( $VmsCode){
    $dbm=new DatabaseManage();  
    $sql="SELECT  dbo.TMstMMediaSetVms.XVVmsCode, dbo.TMstMMediaSetVmsLabel.XVLabelPosition_Y, dbo.TMstMMediaSetVmsLabel.XIID,dbo.TMstMMediaSetVmsLabel.XVTime,dbo.TMstMMediaSetVmsLabel.XILineNumber,dbo.TMstMMediaSetVmsLabel.XBLineShow
    FROM        dbo.TMstMMediaSetVms INNER JOIN
                      dbo.TMstMMediaSetVmsLabel ON dbo.TMstMMediaSetVms.XVMediaVmsCode = dbo.TMstMMediaSetVmsLabel.XVMediaVmsCode
    WHERE     (dbo.TMstMMediaSetVms.XVVmsCode = '$VmsCode')
    ORDER BY dbo.TMstMMediaSetVmsLabel.XILineNumber";
   
    $result=$dbm->QueryDB($sql);
    return $result;
}
function DownloadTemplateImage(){
    $dbm=new DatabaseManage();  
    $sql="SELECT dbo.TMstTemplateVms.XVVmsCode, dbo.TMstTemplateVmsDT.XVLabelPosition_Y, dbo.TMstTemplateVmsDT.XVLabelName, dbo.TMstTemplateVmsDT.XIID
    FROM        dbo.TMstTemplateVms INNER JOIN
                      dbo.TMstTemplateVmsDT ON dbo.TMstTemplateVms.XVTemplateVmsCode = dbo.TMstTemplateVmsDT.XVTemplateVmsCode
    WHERE     (dbo.TMstTemplateVms.XVVmsCode = '$VmsCode')
    ORDER BY dbo.TMstTemplateVmsDT.XIID";
    $result=$dbm->QueryDB($sql);
    return $result;
}
function UpdateGoogleTime($XVMediaVmsCode,$XILineNumber,$XVTime){
    $dbm=new DatabaseManage(); 
    $sql="Update TMstMMediaSetVmsLabel set XVTime='$XVTime' WHERE XVMediaVmsCode='$XVMediaVmsCode' and XILineNumber='$XILineNumber'";
    $result=$dbm->QueryDB($sql);
    return $result;
}
function GetWeatherSensor($XVWssCode){
    $dbm=new DatabaseManage(); 
    $sql="SELECT TOP (1) XVWssCode, XTWstTime, XFWstWindSpeed, XFWstWindDirection, XFWstTemperature, XFWstHumidity, XFWstAtmosphicPressure, XFWstRain, XFWstPM25, XFWstPM10, XFWstPM1, XIWstID
    FROM     dbo.TTrnTWeather
    WHERE  (XVWssCode = '$XVWssCode')
    ORDER BY XIWstID DESC";
    $result=$dbm->QueryDB($sql);
    return $result;
}
function GetRouteXY($VmsCode){
    $dbm=new DatabaseManage(); 
    $sql="SELECT  [XVVmsCode]
      ,[XVPointNumber]
      ,[XVRemark]
      ,[XIX1]
      ,[XIY1]
      ,[XIX2]
      ,[XIY2]
      ,[XVLatitudeS]
      ,[XVLongitudeS]
      ,[XVLatitudeE]
      ,[XVLongitudeE]
      ,XVColor
       FROM [NWL_VMSControl].[dbo].[TMstRoutePoint] WHERE XVVmsCode='$VmsCode' Order by XVPointNumber";  
       $result=$dbm->QueryDB($sql);
       return $result;
}
?>