<?php

function Menu_Sub($PrjCode){
    $dbm=new DatabaseManage();
      $sql="SELECT  dbo.TMstMSetupPoint.XVPrjCode, dbo.TMstMRada.XVRadaCode, dbo.TMstMRada.XVRadaName
      FROM            dbo.TMstMSetupPoint INNER JOIN
                               dbo.TMstMRada ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMRada.XVSupCode
      WHERE        (dbo.TMstMSetupPoint.XVPrjCode = '$PrjCode')
      ORDER BY dbo.TMstMRada.XVRadaCode";  
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


function ShowCharCountBydate($RadaCode,$datepicker){
    $dbm=new DatabaseManage();
    $sql="SELECT 
          [XVRadaCode]
          ,COUNT([XVRadaCode]) AS TCountCar
          ,CONVERT(varchar,[XTRadaTime], 23) AS Ttime
          ,DATEPART(hour, [XTRadaTime]) AS Thour
          ,AVG([XFRadaSpeed]) AS AvgSpeed				  
           FROM [NWL_VMSControl].[dbo].[TTrnTRada]
           WHERE CONVERT(varchar,[XTRadaTime], 23)='$datepicker' and XVRadaCode='$RadaCode'
           GROUP BY  CONVERT(varchar,[XTRadaTime], 23), DATEPART(hour, [XTRadaTime]) , XVRadaCode
           ORDER BY DATEPART(hour, [XTRadaTime])";
  
    $result=$dbm->QueryDB($sql);
    return $result;
}

function ShowTableCountBydate($RadaCode,$datepicker){
    $dbm=new DatabaseManage();

     
     $T=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
     $T1=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
     $T2=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
     $T3=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
     $T4=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
     $data="[";
     $sql1="SELECT  XVRadaCode, CONVERT(varchar, XTRadaTime, 23) AS Ttime, XIRadaClass, COUNT(XTRadaTime) AS Tcount, DATEPART(hour, XTRadaTime) AS Thour
     FROM     dbo.TTrnTRada
     GROUP BY XVRadaCode, CONVERT(varchar, XTRadaTime, 23), XIRadaClass, DATEPART(hour, XTRadaTime)
     HAVING (CONVERT(varchar, XTRadaTime, 23) = '$datepicker') AND (XVRadaCode = '$RadaCode') AND (XIRadaClass = 0)
     ORDER BY Thour";
     $result=$dbm->QueryDB($sql1);
     $JsonObj = json_decode($result);
     $i=0;
     $data.="{";
     $data.= '"A":"มอเตอร์ไซค์",';
     $sum1=0;
     foreach ($JsonObj as $result){ 
       
        $data.= '"'.$i.'":"'.number_format($result->Tcount).'",';
        $sum1=$sum1+$result->Tcount;
        $T1[$i]= $T1[$i]+$result->Tcount;   
        
        $i++;    
          
     }
     
     for($x=$i;$x<=23;$x++){
        $T1[$x]= 0; 
    
        $data.= '"'.$x.'":"0",';
     }
     
     $data.= '"'.$x.'":"'.number_format($sum1).'",';
    
     $data=substr($data,0,strlen($data)-1);
     $data.="},";


     $sql2="SELECT  XVRadaCode, CONVERT(varchar, XTRadaTime, 23) AS Ttime, XIRadaClass, COUNT(XTRadaTime) AS Tcount, DATEPART(hour, XTRadaTime) AS Thour
     FROM     dbo.TTrnTRada
     GROUP BY XVRadaCode, CONVERT(varchar, XTRadaTime, 23), XIRadaClass, DATEPART(hour, XTRadaTime)
     HAVING (CONVERT(varchar, XTRadaTime, 23) = '$datepicker') AND (XVRadaCode = '$RadaCode') AND (XIRadaClass = 1)
     ORDER BY Thour";
     $i=0;
     $sum2=0;
     $result=$dbm->QueryDB($sql2);
     $JsonObj = json_decode($result);
     $data.="{";
     $data.= '"A":"รถเก๋ง",';
     foreach ($JsonObj as $result){ 
           $T2[$i]= $T2[$i]+$result->Tcount;   
           $data.= '"'.$i.'":"'.number_format($result->Tcount).'",';
           $sum2=$sum2+$result->Tcount;
           $i++;           
      }
     for($x=$i;$x<=23;$x++){
           $T2[$x]= 0;   
           $data.= '"'.$x.'":"0",';
     }
     $data.= '"'.$x.'":"'.number_format($sum2).'",';
     $data=substr($data,0,strlen($data)-1);
     $data.="},";

     $sql3="SELECT  XVRadaCode, CONVERT(varchar, XTRadaTime, 23) AS Ttime, XIRadaClass, COUNT(XTRadaTime) AS Tcount, DATEPART(hour, XTRadaTime) AS Thour
     FROM     dbo.TTrnTRada
     GROUP BY XVRadaCode, CONVERT(varchar, XTRadaTime, 23), XIRadaClass, DATEPART(hour, XTRadaTime)
     HAVING (CONVERT(varchar, XTRadaTime, 23) = '$datepicker') AND (XVRadaCode = '$RadaCode') AND (XIRadaClass = 2)
     ORDER BY Thour";
     $i=0;
     $sum3=0;
     $result=$dbm->QueryDB($sql3);
     $JsonObj = json_decode($result);
     $data.="{";
     $data.= '"A":"รถกระบะ",';
     foreach ($JsonObj as $result){ 
           $T3[$i]= $T3[$i]+$result->Tcount;  
           $data.= '"'.$i.'":"'.number_format($result->Tcount).'",';
           $sum3= $sum3+1;
           $i++;           
      }
     for($x=$i;$x<=23;$x++){
           $T3[$x]= 0;  
           $data.= '"'.$x.'":"0",';
     }
     $data.= '"'.$x.'":"'.number_format($sum3).'",';
     $data=substr($data,0,strlen($data)-1);
     $data.="},";

     $sql4="SELECT  XVRadaCode, CONVERT(varchar, XTRadaTime, 23) AS Ttime, XIRadaClass, COUNT(XTRadaTime) AS Tcount, DATEPART(hour, XTRadaTime) AS Thour
     FROM     dbo.TTrnTRada
     GROUP BY XVRadaCode, CONVERT(varchar, XTRadaTime, 23), XIRadaClass, DATEPART(hour, XTRadaTime)
     HAVING (CONVERT(varchar, XTRadaTime, 23) = '$datepicker') AND (XVRadaCode = '$RadaCode') AND (XIRadaClass >= 3)
     ORDER BY Thour";
     $i=0;
     $sum4=0;
     $result=$dbm->QueryDB($sql4);
     $JsonObj = json_decode($result);
     $data.="{";
     $data.= '"A":"รถบรรทุก",';
     foreach ($JsonObj as $result){ 
           $T4[$i]= $T4[$i]+$result->Tcount; 
           $data.= '"'.$i.'":"'.number_format($result->Tcount).'",';
           $sum4=$sum4+$result->Tcount;
           $i++;           
      }
     for($x=$i;$x<=23;$x++){
           $T4[$x]= 0; 
           $data.= '"'.$x.'":"0",';
     }
     $data.= '"'.$x.'":"'.number_format($sum4).'",';
     $data=substr($data,0,strlen($data)-1);
     $data.="},";

   
    

     $data.="{";
     $data.= '"A":"รวม",';
    
     for($x=0;$x<=23;$x++){
        $Sum=$T1[$x]+$T2[$x]+$T3[$x]+$T4[$x];
        $data.= '"'.$x.'":"'.$Sum.'",';
          
     }
     $Tot=$sum1+$sum2+$sum3+$sum4;
     $data.= '"'.$x.'":"'.number_format($Tot).'",';
     $data=substr($data,0,strlen($data)-1);
     $data.="}";
     
     

     $data.="]";
     
    
   /*
    $sql3="SELECT  XVRadaCode, CONVERT(varchar, XTRadaTime, 23) AS Ttime, XIRadaClass, COUNT(XTRadaTime) AS Tcount, DATEPART(hour, XTRadaTime) AS Thour
    FROM     dbo.TTrnTRada
    GROUP BY XVRadaCode, CONVERT(varchar, XTRadaTime, 23), XIRadaClass, DATEPART(hour, XTRadaTime)
    HAVING (CONVERT(varchar, XTRadaTime, 23) = '$datepicker') AND (XVRadaCode = '$RadaCode') AND (XIRadaClass = 2)
    ORDER BY Thour";

    $sql4="SELECT  XVRadaCode, CONVERT(varchar, XTRadaTime, 23) AS Ttime, XIRadaClass, COUNT(XTRadaTime) AS Tcount, DATEPART(hour, XTRadaTime) AS Thour
    FROM     dbo.TTrnTRada
    GROUP BY XVRadaCode, CONVERT(varchar, XTRadaTime, 23), XIRadaClass, DATEPART(hour, XTRadaTime)
    HAVING (CONVERT(varchar, XTRadaTime, 23) = '$datepicker') AND (XVRadaCode = '$RadaCode') AND (XIRadaClass >= 3)
    ORDER BY Thour";



    $sql="SELECT  XVRadaCode, CONVERT(varchar, XTRadaTime, 23) AS Ttime, XIRadaClass, COUNT(XTRadaTime) AS Tcount
          FROM     dbo.TTrnTRada
          GROUP BY XVRadaCode, CONVERT(varchar, XTRadaTime, 23), XIRadaClass
          HAVING (CONVERT(varchar, XTRadaTime, 23) = '$datepicker') AND (XVRadaCode = '$RadaCode')
          ORDER BY XIRadaClass";
          
     
     $result=$dbm->QueryDB($sql);
     $JsonObj = json_decode($result);
     $CountGroup1=0;
     $CountGroup2=0;
     $CountGroup3=0;
     $CountGroup4=0;
    
     foreach ($JsonObj as $result){ 
      
        if($result->XIRadaClass=='0'){
            $CountGroup1=$result->Tcount;
        }elseif($result->XIRadaClass=='1'){
            $CountGroup2=$result->Tcount;
        }elseif($result->XIRadaClass=='2'){
            $CountGroup3=$result->Tcount;
        }else{
            $CountGroup4=$result->Tcount;
        }  
     }
    $Total=$CountGroup1+$CountGroup2+$CountGroup3+$CountGroup4;
    $data="[";
    $data.='
            {
                 "A":"'.number_format($CountGroup1).'",
                 "B":"'.number_format($CountGroup2).'",
                 "C":"'.number_format($CountGroup3).'",
                 "D":"'.number_format($CountGroup4).'",
                 "E":"'.number_format($Total).'"
            }';
          
     $data.="]";
     */
     return $data;
     
}

?>