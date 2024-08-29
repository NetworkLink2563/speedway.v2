<?php


function FirstProgect(){
    $dbm=new DatabaseManage();
    $CstCode=$_SESSION["CstCode"];
    if( $_SESSION["CstCode"]=="CUS22-00001"){
        $sql=" SELECT TOP (1) [XVPrjCode], [XVPrjName]
        FROM [NWL_VMSControl].[dbo].[TMstMProject]  ORDER BY XVPrjCode";
    }else{
        $sql=" SELECT TOP (1) [XVPrjCode], [XVPrjName]
        FROM [NWL_VMSControl].[dbo].[TMstMProject] WHERE XVCstCode='$CstCode' ORDER BY XVPrjCode";
    }
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $VmsCode="";
    foreach ($JsonObj as $result){ 
        $VmsCode=$result->XVPrjCode;
    }
    return $VmsCode;
}
function Menu_Sub($PrjCode){
    $dbm=new DatabaseManage();
      $sql="SELECT dbo.TMstMSetupPoint.XVPrjCode, dbo.TMstMFskNode.XVFskNodeCode, dbo.TMstMFskNode.XVFskNodeName
      FROM            dbo.TMstMSetupPoint INNER JOIN
                               dbo.TMstMFskNode ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMFskNode.XVSupCode
      WHERE        (dbo.TMstMSetupPoint.XVPrjCode = '$PrjCode')
      ORDER BY dbo.TMstMFskNode.XVFskNodeCode";  
      $result=$dbm->QueryDB($sql);
      return $result;
}
function ShowTableStatus($PrjCode,$StrDate){
    $dbm=new DatabaseManage();
    $sql="SELECT    dbo.TMstMSetupPoint.XVPrjCode, dbo.TMstMFskNode.XVFskNodeCode, dbo.TMstMFskNode.XVFskNodeName
    FROM         dbo.TMstMSetupPoint INNER JOIN
                             dbo.TMstMFskNode ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMFskNode.XVSupCode
    GROUP BY dbo.TMstMSetupPoint.XVPrjCode, dbo.TMstMFskNode.XVFskNodeCode, dbo.TMstMFskNode.XVFskNodeName
    HAVING   (dbo.TMstMSetupPoint.XVPrjCode = '$PrjCode')
    ORDER BY dbo.TMstMFskNode.XVFskNodeCode";
   
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $data="[";
    foreach ($JsonObj as $result){ 
            $XVFskNodeCode=$result->XVFskNodeCode;
            if($StrDate==date("Y-m-d")){
                $sql="SELECT  AVG(ISNULL(XFFskCurrent, 0)) AS XFFskCurrent, CONVERT(varchar, XTFskTime, 23) AS XTFskTime, XVFskNodeCode
                FROM         dbo.TTrnTFsk
                WHERE     (CONVERT(varchar, XTFskTime, 23) = '$StrDate')
                GROUP BY CONVERT(varchar, XTFskTime, 23), XVFskNodeCode
                HAVING   (AVG(ISNULL(XFFskCurrent, 0)) > 0) AND (XVFskNodeCode = '$XVFskNodeCode') and  (DATEDIFF(minute, MAX(dbo.TTrnTFsk.XTFskTime), GETDATE()) < 10)";
            }else{
                $sql="SELECT  AVG(ISNULL(XFFskCurrent, 0)) AS XFFskCurrent, CONVERT(varchar, XTFskTime, 23) AS XTFskTime, XVFskNodeCode
                FROM         dbo.TTrnTFsk
                WHERE     (CONVERT(varchar, XTFskTime, 23) = '$StrDate')
                GROUP BY CONVERT(varchar, XTFskTime, 23), XVFskNodeCode
                HAVING   (AVG(ISNULL(XFFskCurrent, 0)) > 0) AND (XVFskNodeCode = '$XVFskNodeCode') ";
            }
            
            $result2=$dbm->QueryDB($sql);
            $JsonObj2 = json_decode($result2);
            $XFFskCurrent=0;
            foreach ($JsonObj2 as $result2){ 
                if($result2->XFFskCurrent>0){
                    $XFFskCurrent=$result2->XFFskCurrent/10;
                }else{
                    $XFFskCurrent=$result2->XFFskCurrent;
                }
            }
            if(count($JsonObj2)>0){
                  $status='<h3 style=\"background-color: green;color:white;border-radius: 5px;text-align: center;\">ติด</h3>';
            }else{
                 $status='<h3 style=\"background-color: red;color:white;border-radius: 5px;text-align: center;\">ดับ</h3>';
            }
           
            $data.='
            {
                "A":"'.$result->XVFskNodeName.'",
                "B":"'.number_format( $XFFskCurrent, 1 ).'",
                "C":"'.$status.'"
            },';
    }

    if(count($JsonObj)>0){
        $data=substr($data,0,strlen($data)-1)."]";
    }else{
        $data.="]";
    }
    return $data;
          
}
function LampOnOFF($PrjCode,$StrDate){
    $dbm=new DatabaseManage();
    $sql="SELECT    dbo.TMstMSetupPoint.XVPrjCode, dbo.TMstMFskNode.XVFskNodeCode, dbo.TMstMFskNode.XVFskNodeName
    FROM         dbo.TMstMSetupPoint INNER JOIN
                             dbo.TMstMFskNode ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMFskNode.XVSupCode
    GROUP BY dbo.TMstMSetupPoint.XVPrjCode, dbo.TMstMFskNode.XVFskNodeCode, dbo.TMstMFskNode.XVFskNodeName
    HAVING   (dbo.TMstMSetupPoint.XVPrjCode = '$PrjCode') 
    ORDER BY dbo.TMstMFskNode.XVFskNodeCode";
   
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $ON=0;
    $OFF=0;
    foreach ($JsonObj as $result){ 
            $XVFskNodeCode=$result->XVFskNodeCode;
            if($StrDate==date("Y-m-d")){
            $sql="SELECT  AVG(ISNULL(XFFskCurrent, 0)) AS XFFskCurrent, CONVERT(varchar, XTFskTime, 23) AS XTFskTime, XVFskNodeCode
                FROM         dbo.TTrnTFsk
                WHERE     (CONVERT(varchar, XTFskTime, 23) = '$StrDate')
                GROUP BY CONVERT(varchar, XTFskTime, 23), XVFskNodeCode
                HAVING   (AVG(ISNULL(XFFskCurrent, 0)) > 0) AND (XVFskNodeCode = '$XVFskNodeCode') and  (DATEDIFF(minute, MAX(dbo.TTrnTFsk.XTFskTime), GETDATE()) < 10)";
            }else{
                $sql="SELECT  AVG(ISNULL(XFFskCurrent, 0)) AS XFFskCurrent, CONVERT(varchar, XTFskTime, 23) AS XTFskTime, XVFskNodeCode
                FROM         dbo.TTrnTFsk
                WHERE     (CONVERT(varchar, XTFskTime, 23) = '$StrDate')
                GROUP BY CONVERT(varchar, XTFskTime, 23), XVFskNodeCode
                HAVING   (AVG(ISNULL(XFFskCurrent, 0)) > 0) AND (XVFskNodeCode = '$XVFskNodeCode') ";
            }
            $result2=$dbm->QueryDB($sql);
            $JsonObj2 = json_decode($result2);
            
            if(count($JsonObj2)>0){
                $ON=$ON+1; 
            }else{
                $OFF=$OFF+1; 
            }
           
    }
    $data='{"ON":'.$ON.',"OFF":'.$OFF.'}';
    return  $data;
}
function FskNodeJson(){
    $dbm=new DatabaseManage();
    $CstCode=$_SESSION["XVCstCode"];
    $sql="SELECT dbo.TMstMSetupPoint.XVSupSetupPoint, dbo.TMstMSetupPoint.XFSupKmPoint, dbo.TMstMSetupPoint.XFSupLatitude, dbo.TMstMSetupPoint.XFSupLongitude, dbo.TMstMProject.XVCstCode, dbo.TMstMFskNode.XVFskNodeName, 
            dbo.TMstMFskNode.XVFskNodeCode,
                (SELECT TOP (1) XFFskCurrent
                FROM      dbo.TTrnTFsk
                WHERE   (XVFskNodeCode = dbo.TMstMFskNode.XVFskNodeCode)
                ORDER BY XTFskTime DESC) AS XFFskCurrent, COALESCE
                ((SELECT TOP (1) XTFskTime
                FROM      dbo.TTrnTFsk AS TTrnTFsk_1
                WHERE   (XVFskNodeCode = dbo.TMstMFskNode.XVFskNodeCode)
                ORDER BY XTFskTime DESC), 0) AS XTFskTime
        FROM     dbo.TMstMSetupPoint INNER JOIN
            dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode INNER JOIN
            dbo.TMstMFskNode ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMFskNode.XVSupCode
        WHERE  (dbo.TMstMProject.XVCstCode = '$CstCode')";
    $result=SqlQuery($sql);

    return $result;
}
function SumOnOffByDate(){
    $dbm=new DatabaseManage();
    $sql="SELECT dbo.TMstMSetupPoint.XVSupSetupPoint, dbo.TMstMSetupPoint.XFSupKmPoint, dbo.TMstMSetupPoint.XFSupLatitude, dbo.TMstMSetupPoint.XFSupLongitude, dbo.TMstMProject.XVCstCode, dbo.TMstMFskNode.XVFskNodeName, 
    dbo.TMstMFskNode.XVFskNodeCode,
        (SELECT TOP (1) XFFskCurrent
        FROM      dbo.TTrnTFsk
        WHERE   (XVFskNodeCode = dbo.TMstMFskNode.XVFskNodeCode)
        ORDER BY XTFskTime DESC) AS XFFskCurrent, COALESCE
        ((SELECT TOP (1) XTFskTime
        FROM      dbo.TTrnTFsk AS TTrnTFsk_1
        WHERE   (XVFskNodeCode = dbo.TMstMFskNode.XVFskNodeCode)
        ORDER BY XTFskTime DESC), 0) AS XTFskTime
    FROM     dbo.TMstMSetupPoint INNER JOIN
        dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode INNER JOIN
        dbo.TMstMFskNode ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMFskNode.XVSupCode";
        $result=SqlQuery($sql);
}
function Chart1($PrjCode){
    $dbm=new DatabaseManage();
    $DateNow=date("Y-m-d");
    $CstCode=$_SESSION["XVCstCode"];
    $sql="SELECT   dbo.TMstMFskNode.XVFskNodeCode, AVG(dbo.TTrnTFsk.XFFskCurrent) AS XFFskCurrent, MAX(dbo.TTrnTFsk.XTFskTime) AS Expr1, dbo.TMstMSetupPoint.XVPrjCode
    FROM         dbo.TMstMFskNode INNER JOIN
                             dbo.TTrnTFsk ON dbo.TMstMFskNode.XVFskNodeCode = dbo.TTrnTFsk.XVFskNodeCode INNER JOIN
                             dbo.TMstMSetupPoint ON dbo.TMstMFskNode.XVSupCode = dbo.TMstMSetupPoint.XVSupCode
   
    GROUP BY dbo.TMstMFskNode.XVFskNodeCode, dbo.TMstMSetupPoint.XVPrjCode
    HAVING   (AVG(dbo.TTrnTFsk.XFFskCurrent) > 0) AND (dbo.TMstMSetupPoint.XVPrjCode = '$PrjCode') AND (DATEDIFF(minute, MAX(dbo.TTrnTFsk.XTFskTime), GETDATE()) < 10)";
  

    $result=$dbm->QueryDB($sql);
    $obj=json_decode($result);
    $On=count($obj);
   
    $sql="SELECT   dbo.TMstMFskNode.XVFskNodeCode, dbo.TMstMSetupPoint.XVPrjCode
            FROM         dbo.TMstMFskNode INNER JOIN
                                    dbo.TMstMSetupPoint ON dbo.TMstMFskNode.XVSupCode = dbo.TMstMSetupPoint.XVSupCode
            GROUP BY dbo.TMstMFskNode.XVFskNodeCode, dbo.TMstMSetupPoint.XVPrjCode
            HAVING   (dbo.TMstMSetupPoint.XVPrjCode = '$PrjCode')";
    $result=$dbm->QueryDB($sql);
    $obj=json_decode($result);
    $NodeTotal=count($obj);

    
    $PercenOn=0;
    $PercenOff=0;
    if($On>0){    
        $PercenOn=($On/$NodeTotal)*100;
        $PercenOff=100-$PercenOn; 
    }else{
        $PercenOff=100;
        $PercenOn=0;
    }
    $myObj=array("PercenOn"=>$PercenOn,"PercenOff"=>$PercenOff);
    $myJSON = json_encode($myObj);
   
    return $myJSON;
    
   
    
    
}
function Chart2($PrjCode){
    $dbm=new DatabaseManage();
    $CstCode=$_SESSION["XVCstCode"];
    $sumdayofmonth=cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"));

    $sql="SELECT TOP (100) PERCENT dbo.TMstMFskNode.XVFskNodeCode, dbo.TMstMProject.XVCstCode, dbo.TMstMProject.XVPrjCode
    FROM     dbo.TMstMFskNode INNER JOIN
                      dbo.TMstMSetupPoint ON dbo.TMstMFskNode.XVSupCode = dbo.TMstMSetupPoint.XVSupCode INNER JOIN
                      dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode
    WHERE  (dbo.TMstMProject.XVPrjCode = '$PrjCode')
    ORDER BY dbo.TMstMFskNode.XVFskNodeCode";
    
    $daynow=date('d');
    $result=$dbm->QueryDB($sql);
    $obj=json_decode($result);
    $NodeTotal=count($obj);
   
    $resultArray = array();
    for($x=1;$x<$daynow;$x++){
        if($x<10){
            $x='0'.$x;
        }
        $strdate=date("Y-m-").$x;
        $sql="SELECT dbo.TMstMFskNode.XVFskNodeCode, dbo.TMstMSetupPoint.XVPrjCode, dbo.TTrnTFskSumByDate.XTFskDateFirstOn, AVG(dbo.TTrnTFskSumByDate.XFCurrent) AS Expr1
        FROM     dbo.TMstMFskNode INNER JOIN
                          dbo.TMstMSetupPoint ON dbo.TMstMFskNode.XVSupCode = dbo.TMstMSetupPoint.XVSupCode INNER JOIN
                          dbo.TTrnTFskSumByDate ON dbo.TMstMFskNode.XVFskNodeCode = dbo.TTrnTFskSumByDate.XVFskNodeCode
        GROUP BY dbo.TMstMFskNode.XVFskNodeCode, dbo.TMstMSetupPoint.XVPrjCode, dbo.TTrnTFskSumByDate.XTFskDateFirstOn
        HAVING (dbo.TMstMSetupPoint.XVPrjCode = '$PrjCode') AND (CONVERT(VARCHAR(10), dbo.TTrnTFskSumByDate.XTFskDateFirstOn, 23) = '$strdate') AND (AVG(dbo.TTrnTFskSumByDate.XFCurrent) > 0)
        
        ";      
        
        $result2=$dbm->QueryDB($sql);
        $obj2=json_decode($result2);
        $On=count($obj2);
       
        
        if($On>0){
            $PercenOn=($On/$NodeTotal)*100;
            $PercenOff=100-$PercenOn;
        }else{
            $PercenOff=100;
            $PercenOn=0;
        }
        $a=array("Date"=>$strdate,"PercenOn"=>$PercenOn,"PercenOff"=>$PercenOff);
        array_push($resultArray,  $a);
    }
    return json_encode($resultArray);
}
function Chart3(){
    $dbm=new DatabaseManage();
    $resultArray = array();
    $sql="SELECT  [XVFskNodeCode] FROM [NWL_VMSControl].[dbo].[TMstMFskNode]";
    $result=SqlQuery($sql);
    $obj=json_decode($result);
    $NodeTotal=count($obj);

    $sql="SELECT  MONTH(XTFskTime) AS XIMonth, YEAR(XTFskTime) AS XIYear, COUNT(XVFskNodeCode) AS CountOn, AVG(XFFskCurrent) AS AvgCurrent
    FROM     dbo.TTrnTFsk
    GROUP BY MONTH(XTFskTime), YEAR(XTFskTime), XVFskNodeCode
    ORDER BY XIMonth, XIYear, XVFskNodeCode";
    $result=$dbm->QueryDB($sql);
    $obj=json_decode($result);
   
    foreach ($obj as $result){
        $XCmonthYear=$result->XIMonth."-".$result->XIYear;
        $PercenOn=($result->CountOn/$NodeTotal)*100;
        $PercenOff=100-$PercenOn;
        $a=array("MonthYear"=>$XCmonthYear,"PercenOn"=>$PercenOn,"PercenOff"=>$PercenOff);
        array_push($resultArray,  $a);
    }
    return json_encode($resultArray); 
}
function Chart4($PrjCode){
    $dbm=new DatabaseManage();
    $CstCode=$_SESSION["XVCstCode"];
    $sql="SELECT dbo.TMstMFskNode.XVFskNodeCode, AVG(dbo.TTrnTFsk.XFFskCurrent) AS XFFskCurrent, MAX(dbo.TTrnTFsk.XTFskTime) AS XTFskTime, dbo.TMstMSetupPoint.XVPrjCode, AVG(dbo.TTrnTFsk.XFFskVoltage) AS XFFskVoltage
    FROM     dbo.TMstMFskNode INNER JOIN
                      dbo.TTrnTFsk ON dbo.TMstMFskNode.XVFskNodeCode = dbo.TTrnTFsk.XVFskNodeCode INNER JOIN
                      dbo.TMstMSetupPoint ON dbo.TMstMFskNode.XVSupCode = dbo.TMstMSetupPoint.XVSupCode
    GROUP BY dbo.TMstMFskNode.XVFskNodeCode, dbo.TMstMSetupPoint.XVPrjCode
    HAVING (dbo.TMstMSetupPoint.XVPrjCode = '$PrjCode') AND (DATEDIFF(minute, MAX(dbo.TTrnTFsk.XTFskTime), GETDATE()) < 10) AND (AVG(dbo.TTrnTFsk.XFFskCurrent) > 0) AND (AVG(dbo.TTrnTFsk.XFFskVoltage) > 0)";
   
   $result=$dbm->QueryDB($sql);
    $obj=json_decode($result);
    $Current=0;
    $Voltage=0;
    $count=0;
    foreach ($obj as $result){
           $count=$count+1;
           if($result->XFFskCurrent>0){
              if($result->XFFskCurrent>17){
               $c=17/10;
              }else{
                $c=$result->XFFskCurrent/10;
              }
           }else{
               $c=0;
           }
            $Current=$Current+$c;
            $Voltage= $Voltage+$result->XFFskVoltage;    
    }
    if($count>0){
        $myObj->Voltage = $Voltage/$count;
        $myObj->Current = $Current; 
    }
    $myJSON = json_encode($myObj);
    return $myJSON;
}
function Chart6(){
    $dbm=new DatabaseManage();
    $resultArray = array();
    $sumdayofmonth=cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"));
    $daynow=date('d');
    for($x=1;$x<$daynow;$x++){
       
        $strdate=date("Y-m-").$x;
        $sql="SELECT SUM(XFWatt) AS XFWatt, SUM(DATEDIFF(hour, XTFskDateFirstOn, 'XTFskDateLastOn'))  AS XFHour
        FROM     dbo.TTrnTFskSumByDate
        WHERE  (CONVERT(VARCHAR(10), XTFskDateLastOn, 23) = '$strdate')";
       
        $sql="SELECT SUM(XFWatt) AS XFWatt
        FROM     dbo.TTrnTFskSumByDate
        WHERE  (CONVERT(VARCHAR(10), XTFskDateLastOn, 23) = '$strdate')";
        $result=$dbm->QueryDB($sql);
        $obj=json_decode($result);
     
            foreach ($obj as $result){
                $a=array("Date"=>$strdate,"Watt"=>$result->XFWatt,"Hour"=>0);
                array_push($resultArray,  $a);
            }
    }
    return json_encode($resultArray); 
}
?>