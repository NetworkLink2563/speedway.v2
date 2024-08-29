<?php




if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') { 
   

    include '../lib/DatabaseManage.php';
    include "Model.php";    

    if(isset($_POST["SendSpeedEn"]))
    {   
        $Code=$_POST["Code"];
        $Lane=$_POST["Lane"];
        $Country=$_POST["Country"];
        $Event=$_POST["Event"];
        $PlateColor=$_POST["PlateColor"]; 
        $VehicleType=$_POST["VehicleType"];
        $PlateNumber=$_POST["PlateNumber"];
        $Speed=$_POST["Speed"];
        $PlateType=$_POST["PlateType"];
        $VehicleColor=$_POST["VehicleColor"];
        $VehicleSign=$_POST["VehicleSign"];
        $VehicleSize=$_POST["VehicleSize"];
        $Time=$_POST["Time"];
        SendSpeedEn($Code, $Lane, $Country, $Event, $PlateColor, $PlateNumber, $VehicleType, $Speed, $PlateType, $VehicleColor, $VehicleSign, $VehicleSize, $Time);  
    }
    if(isset($_POST["SendWeather"]))
    {
        $WssCode=$_POST["WssCode"];
      
        $WindSpeed=$_POST["WindSpeed"];
        $WindDirection=$_POST["WindDirection"];
        $Temperature=$_POST["Temperature"];
        $Humidity=$_POST["Humidity"];
        $AtmosphicPressure=$_POST["AtmosphicPressure"];
        $Rain=$_POST["Rain"];
        $PM25=$_POST["PM25"];
        $PM10=$_POST["PM10"];
        $PM1=$_POST["PM1"];
        SendWeather($WssCode,$WindSpeed,$WindDirection,$Temperature,$Humidity,$AtmosphicPressure,$Rain,$PM25,$PM10,$PM1);
    }
    if(isset($_POST["SensorRada"]))
    {
        $RadaCode=$_POST["RadaCode"];
        $DateTime=$_POST["DateTime"];
        $LaneId=$_POST["LaneId"];
        $Duration=$_POST["Duration"];
        $Speed=$_POST["Speed"];
        $Class=$_POST["Class"];
        $Length=$_POST["Length"];
        $Range=$_POST["Range"];
        SendSensorRada($RadaCode,$DateTime,$LaneId,$Duration,$Speed,$Class,$Length,$Range);
    }
    if(isset($_POST["WeatherToVms"])){
        $WssCode=$_POST["WssCode"];
        
        echo WeatherToVms($WssCode);
    }
    if(isset($_POST["SendFsk"])){
        $NodeCode=$_POST["NodeCode"];
        $NodeID=$_POST["NodeID"];
        $Voltage=$_POST["Voltage"];
        $Current=$_POST["Current"];
        $Power=$_POST["Power"];
        $Energy=$_POST["Energy"];
        SendFsk($NodeCode, $NodeID, $Voltage,$Current,$Power,$Energy);
    }
    if(isset($_POST["DownLoadVmsPlay"])){
        $VmsCode=$_POST["VmsCode"];
        echo DownLoadVmsPlay($VmsCode);
    }
    if(isset($_POST["DownLoadVmsPlay320480"])){
        $VmsCode=$_POST["VmsCode"];
        echo DownLoadVmsPlay320480($VmsCode);
    }
    if(isset($_POST["DownLoadTemplateLabel"])){ 
        $VmsCode=$_POST["VmsCode"];
        echo DownLoadTemplateLabel( $VmsCode);
    }
    if(isset($_POST["UpdateGoogleTimes"])){ 
      
       $XVMediaVmsCode=$_POST["XVMediaVmsCode"];
       $XILineNumber=$_POST["XILineNumber"]; 
       $XVTime=$_POST["XVTime"]; 
       echo UpdateGoogleTime($XVMediaVmsCode,$XILineNumber,$XVTime);

    }
    if(isset($_POST["UpdateIp"])){ 
        $Code=$_POST["Code"];
        $Password=$_POST["Password"];
        $IP=$_POST["Password"];
        echo UpdateIP($Code,$Password,$IP);
    }
    if(isset($_POST["GetWeatherSensor"])){ 
        $WssCode=$_POST["WssCode"];
        echo GetWeatherSensor($WssCode);
    }
    if(isset($_POST["GetRouteXY"])){ 
        $VmsCode=$_POST["VmsCode"];
        echo GetRouteXY($VmsCode);
    }
   
}
?>