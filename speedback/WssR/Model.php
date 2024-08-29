<?php

function Menu_Sub($PrjCode){
    $dbm=new DatabaseManage();
      $sql="SELECT dbo.TMstMSetupPoint.XVPrjCode, dbo.TMstMWeatherSensor.XVWssCode, dbo.TMstMWeatherSensor.XVWssName
      FROM     dbo.TMstMSetupPoint INNER JOIN
                        dbo.TMstMWeatherSensor ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMWeatherSensor.XVSupCode
      WHERE        (dbo.TMstMSetupPoint.XVPrjCode = '$PrjCode')
      ORDER BY  dbo.TMstMWeatherSensor.XVWssCode";  
      $result=$dbm->QueryDB($sql);
      return $result;
}


function MonthNameToNum($m){
    $mx=0;
    if( strtoupper($m)==strtoupper("January")){$mx=1;};
    if( strtoupper($m)==strtoupper("February")){$mx=2;};
    if( strtoupper($m)==strtoupper("March")){$mx=3;};
    if( strtoupper($m)==strtoupper("April")){$mx=4;};
    if( strtoupper($m)==strtoupper("May")){$mx=5;};
    if( strtoupper($m)==strtoupper("June")){$mx=6;};
    if( strtoupper($m)==strtoupper("July")){$mx=7;};
    if( strtoupper($m)==strtoupper("August")){$mx=8;};
    if( strtoupper($m)==strtoupper("September")){$mx=9;};
    if( strtoupper($m)==strtoupper("October")){$mx=10;};
    if( strtoupper($m)==strtoupper("November")){$mx=11;};
    if( strtoupper($m)==strtoupper("December")){$mx=12;};
    return $mx; 
}

function ShowChart2($RadaCode,$Month,$Lane){
  
    $tmp=explode("-",$Month);
    $m=$tmp[0];
    $Y=$tmp[1];
    $mn=MonthNameToNum($m);
     
    $dbm=new DatabaseManage();
    //$sumdayofmonth=cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"));
   
    $sumdayofmonth=cal_days_in_month(CAL_GREGORIAN, $mn,$Y);
    
    $daynow=date('d');
    $resultArray = array();
    for($x=1;$x<$sumdayofmonth;$x++){
        $strdate=$Y."-".$mn."-".$x." "."00:00:00";
        $xdate=$Y."-".$mn."-".$x;
       
        $sql="SELECT XVRadaCode, XILaneId, SUM(XICountCar) AS XICountCar, AVG(XFSpeed) AS XFSpeed, MIN(XFSpeedMin) AS XFSpeedMin, MAX(XFSpeedMax) AS XFSpeedMax
        FROM     dbo.TTrnTRadaSumByDate
        GROUP BY XVRadaCode, XILaneId, XTRadaTime
        HAVING (XILaneId = $Lane) AND (XVRadaCode = '$RadaCode') AND (XTRadaTime = CONVERT(DATETIME, '$strdate', 102))";
        
        $result=$dbm->QueryDB($sql);
        $obj=json_decode($result);
        $XICountCar=0;
        $XFSpeed=0;
        $XFSpeedMin=0;
        $XFSpeedMax=0;
        foreach ($obj as $result){
            $XICountCar=$result->XICountCar;
            $XFSpeed=$result->XFSpeed;
            $XFSpeedMin=$result->XFSpeedMin;
            $XFSpeedMax=$result->XFSpeedMax;
        }
        $a=array("Date"=>$xdate,"XICountCar"=>$XICountCar,"XFSpeed"=>$XFSpeed,"XFSpeedMin"=>$XFSpeedMin,"XFSpeedMax"=>$XFSpeedMax);
        array_push($resultArray,  $a);
    }
    $myJSON = json_encode($resultArray);
    return $myJSON;
}


function ShowCharCountBydate($ChartType,$WssCode,$datepicker){
    $dbm=new DatabaseManage();
    
    if ($ChartType==1){
        $sql="SELECT  XVWssCode, CONVERT(varchar, XTWstTime, 23) AS Ttime, DATEPART(hour, XTWstTime) AS Thour, AVG(XFWstTemperature) AS AvgValue
        FROM     dbo.TTrnTWeather
        WHERE  (XVWssCode = '$WssCode') AND (CONVERT(varchar, XTWstTime, 23) = '$datepicker')
        GROUP BY XVWssCode, CONVERT(varchar, XTWstTime, 23), DATEPART(hour, XTWstTime)
        ORDER BY Thour";
       
    }
    if ($ChartType==2){
            $sql="SELECT  XVWssCode, CONVERT(varchar, XTWstTime, 23) AS Ttime, DATEPART(hour, XTWstTime) AS Thour, AVG(XFWstHumidity) AS AvgValue
            FROM     dbo.TTrnTWeather
            WHERE  (XVWssCode = '$WssCode') AND (CONVERT(varchar, XTWstTime, 23) = '$datepicker')
            GROUP BY XVWssCode, CONVERT(varchar, XTWstTime, 23), DATEPART(hour, XTWstTime)
            ORDER BY Thour";
    }    
    
    if ($ChartType==3){
        $sql="SELECT  XVWssCode, CONVERT(varchar, XTWstTime, 23) AS Ttime, DATEPART(hour, XTWstTime) AS Thour, AVG(XFWstPM25) AS AvgValue
        FROM     dbo.TTrnTWeather
        WHERE  (XVWssCode = '$WssCode') AND (CONVERT(varchar, XTWstTime, 23) = '$datepicker')
        GROUP BY XVWssCode, CONVERT(varchar, XTWstTime, 23), DATEPART(hour, XTWstTime)
        ORDER BY Thour";
}    
    $result=$dbm->QueryDB($sql);
    return $result;
}
?>