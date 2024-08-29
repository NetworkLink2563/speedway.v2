<?php
  date_default_timezone_set("Asia/Bangkok");
  echo date("H:i:s")."<br>";
  $tstart=strtotime("05:50:00")."<br>";
  $nowtime=strtotime(date("H:i:s"))."<br>";
  $tend=strtotime("18:30:00")."<br>";
  /*
  if($nowtime>$tstart&&$nowtime<$tend){
    exit();
  }else{
    echo "Begin Update<BR>";
  }
   */

   include '../lib/DatabaseManage.php';
   $dbm=new DatabaseManage();
  
   $sql="SELECT dbo.TMstMSetupPoint.XVPrjCode, dbo.TMstMFsk.XVFskCode, dbo.TMstMFsk.XVFskName
   FROM     dbo.TMstMFsk INNER JOIN
                     dbo.TMstMSetupPoint ON dbo.TMstMFsk.XVSupCode = dbo.TMstMSetupPoint.XVSupCode
   WHERE  (dbo.TMstMSetupPoint.XVPrjCode = N'Prj23-00010')";
    
    $result3=$dbm->QueryDB($sql);
    $JsonObj3 = json_decode($result3);
 
    foreach ($JsonObj3 as $result3){
        $XVFskCode=$result3->XVFskCode; 
        $sql="SELECT TOP (1) dbo.TTrnTFsk.XVFskNodeCode, dbo.TTrnTFsk.XVNodeID, dbo.TTrnTFsk.XFFskVoltage, dbo.TTrnTFsk.XFFskCurrent, dbo.TTrnTFsk.XFFskPower, dbo.TTrnTFsk.XFFskEnergy, dbo.TTrnTFsk.XTFskTime, 
                    dbo.TMstMFskNode.XVFskCode
            FROM     dbo.TMstMFskNode INNER JOIN
                    dbo.TMstMSetupPoint ON dbo.TMstMFskNode.XVSupCode = dbo.TMstMSetupPoint.XVSupCode INNER JOIN
                    dbo.TTrnTFsk ON dbo.TMstMFskNode.XVFskNodeCode = dbo.TTrnTFsk.XVFskNodeCode
            WHERE  (dbo.TMstMSetupPoint.XVPrjCode = N'Prj23-00010') AND (CONVERT(DATE, dbo.TTrnTFsk.XTFskTime) = CONVERT(DATE, GETDATE())) AND (DATEDIFF(minute, dbo.TTrnTFsk.XTFskTime, GETDATE()) < 8) AND 
                    (dbo.TTrnTFsk.XFFskCurrent > 0) AND (dbo.TTrnTFsk.XFFskVoltage > 0) AND (dbo.TTrnTFsk.XFFskVoltage < 400) AND (dbo.TMstMFskNode.XVFskCode = '$XVFskCode' and  dbo.TTrnTFsk.XIM=0)
            ORDER BY dbo.TTrnTFsk.XVNodeID";
        $result2=$dbm->QueryDB($sql);
        $JsonObj2 = json_decode($result2);
        $CKDATA=0;
        foreach ($JsonObj2 as $result2){
           
            $CKDATA=1;
           
            $XFFskVoltage= $result2->XFFskVoltage; 
            $XFFskCurrent=$result2->XFFskCurrent; 
            $XFFskPower= $result2->XFFskPower; 
            $XFFskEnergy= $result2->XFFskEnergy; 
            break;
        }
        //-----------------------------------
        if($CKDATA==1){
            $sql="SELECT dbo.TMstMSetupPoint.XVPrjCode, dbo.TMstMFskNode.XVFskNodeCode, dbo.TMstMFskNode.XVFskNodeSN, dbo.TMstMFskNode.XVFskCode, dbo.TMstMFskNode.XIDISABLE
            FROM     dbo.TMstMFskNode INNER JOIN
                              dbo.TMstMSetupPoint ON dbo.TMstMFskNode.XVSupCode = dbo.TMstMSetupPoint.XVSupCode
            WHERE  (dbo.TMstMSetupPoint.XVPrjCode = N'Prj23-00010') AND (dbo.TMstMFskNode.XVFskCode = '$XVFskCode')";
            $result=$dbm->QueryDB($sql);
            $JsonObj = json_decode($result);
            $count=0;
            foreach ($JsonObj as $result){
            
                $ck1=0;
                $ck2=0;
                $XVFskNodeCode=$result->XVFskNodeCode; 
                $XVFskNodeSN=$result->XVFskNodeSN;
                $XIDISABLE=$result->XIDISABLE;
                echo $XVFskNodeCode."<br>";
                $sql="SELECT TOP (1) XVFskCode, XVFskNodeCode, XVNodeID, XFFskVoltage, XFFskCurrent, XFFskPower, XFFskEnergy, XTFskTime, DATEDIFF(minute, XTFskTime, GETDATE()) AS DateDiff
                FROM     dbo.TTrnTFsk
                WHERE  (DATEDIFF(minute, XTFskTime, GETDATE()) > 8) AND (CONVERT(DATE, XTFskTime) = CONVERT(DATE, GETDATE())) AND (XVFskNodeCode = '$XVFskNodeCode')";
                $result2=$dbm->QueryDB($sql);
                $JsonObj2 = json_decode($result2);
                if(count($JsonObj2)>0){
                    $ck1=1;
                }
                $sql="SELECT TOP (1) XVFskCode, XVFskNodeCode, XVNodeID, XFFskVoltage, XFFskCurrent, XFFskPower, XFFskEnergy, XTFskTime, DATEDIFF(minute, XTFskTime, GETDATE()) AS DateDiff
                FROM     dbo.TTrnTFsk
                WHERE   CONVERT(DATE, XTFskTime) = CONVERT(DATE, GETDATE()) AND (XVFskNodeCode = '$XVFskNodeCode')";
                $result2=$dbm->QueryDB($sql);
                $JsonObj2 = json_decode($result2);
                if(count($JsonObj2)==0){
                    $ck2=1;
                }
                if($ck1==1||$ck2==1){

                   if($XIDISABLE==0){
                            
                            $sql="insert into TTrnTFsk(
                                            XVFskCode, 
                                            XVFskNodeCode, 
                                            XVNodeID, 
                                            XFFskVoltage, 
                                            XFFskCurrent, 
                                            XFFskPower, 
                                            XFFskEnergy, 
                                            XTFskTime,
                                            XIM)VALUES(
                                                '',
                                                '$XVFskNodeCode',
                                                '$XVFskNodeSN',
                                                $XFFskVoltage,
                                                $XFFskCurrent,
                                                $XFFskPower,
                                                $XFFskEnergy,
                                                GETDATE(),
                                                1
                                            )";
                                        
                                            $result=$dbm->QueryDB($sql);
                                            if($result){
                                                echo "Insert Success<br>";
                                            }
                    }                        
                }    
                                

            }
            

        }
        //-----------------------------------
    }

    
  
   
   
    
?>