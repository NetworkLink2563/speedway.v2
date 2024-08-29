<?php




function SelGate($PrjCode){
    $dbm=new DatabaseManage();
    $sql="SELECT dbo.TMstMProject.XVPrjCode, dbo.TMstMFsk.XVFskCode, dbo.TMstMFsk.XVFskName
    FROM     dbo.TMstMProject INNER JOIN
                    dbo.TMstMSetupPoint ON dbo.TMstMProject.XVPrjCode = dbo.TMstMSetupPoint.XVPrjCode INNER JOIN
                    dbo.TMstMFsk ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMFsk.XVSupCode
    WHERE  (dbo.TMstMProject.XVPrjCode = '$PrjCode') ";
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $InputData= '<option value="">ทั้งหมด</option>';
    if (count($JsonObj)>0){
        foreach ($JsonObj as $result){ 
            
            $InputData.= '<option  value="'.$result->XVFskCode.'">'.$result->XVFskName.'</option>';
        }
    }
    return $InputData;
    
}


function ShowBodyTable($PrjCode, $XVFskCode){
   
    $dbm=new DatabaseManage();
        if($XVFskCode==""){
           $sql="SELECT  dbo.TMstMProject.XVCstCode, dbo.TMstMSetupPoint.XVSupName, dbo.TMstMProject.XVPrjCode, dbo.TMstMFskNode.XVFskNodeCode, dbo.TMstMFskNode.XVFskNodeName, dbo.TMstMFskNode.XVFskNodeSN, 
                    dbo.TMstMFskNode.XBFskNodeIsActive, dbo.TMstMFskNode.XVFskCode, dbo.TMstMFskNode.XVSupCode, dbo.TMstMFskNode.XVWhoCreate, dbo.TMstMFskNode.XVWhoEdit, dbo.TMstMFskNode.XTWhenCreate, 
                    dbo.TMstMFskNode.XTWhenEdit, dbo.TMstMSetupPoint.XFSupLatitude,dbo.TMstMSetupPoint.XFSupLongitude
            FROM     dbo.TMstMSetupPoint INNER JOIN
                    dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode INNER JOIN
                    dbo.TMstMFskNode ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMFskNode.XVSupCode
            WHERE  (dbo.TMstMProject.XVPrjCode = '$PrjCode')
            ORDER BY dbo.TMstMSetupPoint.XVSupCode, dbo.TMstMFskNode.XVFskNodeCode" ;
        }else{
            $sql="SELECT  dbo.TMstMProject.XVCstCode, dbo.TMstMSetupPoint.XVSupName, dbo.TMstMProject.XVPrjCode, dbo.TMstMFskNode.XVFskNodeCode, dbo.TMstMFskNode.XVFskNodeName, dbo.TMstMFskNode.XVFskNodeSN, 
            dbo.TMstMFskNode.XBFskNodeIsActive, dbo.TMstMFskNode.XVFskCode, dbo.TMstMFskNode.XVSupCode, dbo.TMstMFskNode.XVWhoCreate, dbo.TMstMFskNode.XVWhoEdit, dbo.TMstMFskNode.XTWhenCreate, 
            dbo.TMstMFskNode.XTWhenEdit, dbo.TMstMSetupPoint.XFSupLatitude,dbo.TMstMSetupPoint.XFSupLongitude
            FROM     dbo.TMstMSetupPoint INNER JOIN
                    dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode INNER JOIN
                    dbo.TMstMFskNode ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMFskNode.XVSupCode
            WHERE  (dbo.TMstMProject.XVPrjCode = '$PrjCode') and dbo.TMstMFskNode.XVFskCode='$XVFskCode'
            ORDER BY dbo.TMstMSetupPoint.XVSupCode, dbo.TMstMFskNode.XVFskNodeCode" ;
        }
  
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $data="[";
    foreach ($JsonObj as $result){ 
        $XVFskNodeCode=$result->XVFskNodeCode;
        
        $sql="SELECT AVG(ISNULL(XFFskCurrent, 0)) AS XFFskCurrent, CONVERT(varchar, XTFskTime, 23) AS XTFskTime, XVFskNodeCode
        FROM     dbo.TTrnTFsk
        WHERE  (CONVERT(varchar, XTFskTime, 23) = CONVERT(varchar, GETDATE(), 23))
        GROUP BY CONVERT(varchar, XTFskTime, 23), XVFskNodeCode, XTFskTime
        HAVING (AVG(ISNULL(XFFskCurrent, 0)) > 0) AND (DATEDIFF(minute, MAX(XTFskTime), GETDATE()) < 10) AND (XVFskNodeCode = '$XVFskNodeCode')";
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
            $status='<h3 style=\"background-color: green;color:white;border-radius: 5px;text-align: center;\">ติด ' .$XFFskCurrent.' A</h3>';
        }else{
           $status='<h3 style=\"background-color: red;color:white;border-radius: 5px;text-align: center;\">ดับ '.$XFFskCurrent.' A</h3>';
        }
        $data.='
            {
                "A":"'.$result->XVFskNodeCode.'",
                "B":"'.$result->XVFskNodeName.'",
                "C":"'.$result->XFSupLatitude.'",
                "D":"'.$result->XFSupLongitude.'",
                "E":"'.$status.'"
               
            },';
    }
    $data=substr($data,0,strlen($data)-1)."]";
    return $data;
}

?>