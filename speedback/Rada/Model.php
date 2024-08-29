<?php

function RunNumberRadaCode(){
    $dbm=new DatabaseManage();
    $sql="select  max(XVRadaCode) as XVRadaCode   from TMstMRada";
    $result=$dbm->QueryDB($sql);  
    $JsonObj = json_decode($result);
    $XVRadaCode='';
    foreach ($JsonObj as $result){
        $XVRadaCode =$result->XVRadaCode;               
    }
    if($XVRadaCode==''){
        return 'RAD'.date("y")."-00001";
    }else{
        $DocNo=explode("-",$XVRadaCode);
        $RunDocNum=intval($DocNo[1])+1;
        $XVRadaCode=sprintf("%05d", $RunDocNum);
        return 'RAD'.date("y")."-".$XVRadaCode; 
    }   
}


function SearchCamera($RadaCode)
{  
    $dbm=new DatabaseManage();
    $sql="SELECT  [XVRadaCode]
        ,[XVRadaName]
        ,[XVRadaSN]
        ,[XVRadaIp]
        ,[XIRadaPort]
        ,[XBRadaIsActive]
        ,[XVSupCode]
        FROM [NWL_VMSControl].[dbo].[TMstMRada] WHERE XVRadaCode='$RadaCode'";     
    $result=$dbm->QueryDB($sql);
    return $result;
} 

function ShowBodyTable($PrjCode){
    $Permis=Permission('MNU22-00010');
    $CstCode=$_SESSION["CstCode"];
    $UsrCode=$_SESSION["UsrCode"];
    $dbm=new DatabaseManage();

        
            $sql="SELECT  dbo.TMstMRada.XVRadaCode, dbo.TMstMRada.XVRadaName, dbo.TMstMRada.XVRadaSN, dbo.TMstMRada.XVRadaIp, dbo.TMstMRada.XIRadaPort, dbo.TMstMRada.XBRadaIsActive, dbo.TMstMProject.XVCstCode, 
            dbo.TMstMSetupPoint.XVSupName, dbo.TMstMProject.XVPrjCode
            FROM dbo.TMstMSetupPoint INNER JOIN
            dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode INNER JOIN
            dbo.TMstMRada ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMRada.XVSupCode
            WHERE  (dbo.TMstMProject.XVPrjCode = '$PrjCode') 
            ORDER BY dbo.TMstMSetupPoint.XVSupCode, dbo.TMstMRada.XVRadaCode";  
             

       
 
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $data="[";
    foreach ($JsonObj as $result){ 
        $para="'".$result->XVRadaCode."'";
        $XBRadaIsActive='ยกเลิก';
        if($result->XBRadaIsActive==1){
            $XBRadaIsActive='ใช้งาน';
        }
        $E='<i '.$Permis[2].' style=\"cursor: pointer;\" class=\"fa-solid fa-trash\" aria-hidden=\"true\" title=\"ลบ\" onclick=\"FuDelete('.$para.')\"></i>';
        $F='<i style=\"cursor: pointer;\" class=\"fa-solid fa-pen-to-square\" aria-hidden=\"true\" title=\"แก้ไข\" onclick=\"FuEdit('.$para.')\"></i>';
        if($_SESSION["CstCode"]!="CUS22-00001"){
            $E="";
        } 
            $data.='
            {
                "A":"'.$result->XVRadaCode.'",
                "B":"'.$result->XVRadaName.'",
                "C":"'.$result->XVSupName.'",
                "D":"'.$XBRadaIsActive.'",
                "E":"'.$E.'",
                "F":"'.$F.'"
            },';
        
    }
    $data=substr($data,0,strlen($data)-1)."]";
    return $data;
}
function InsertRada($RadaCode, $RadaName, $RadaSN, $RadaIp, $RadaPort, $RadaIsActive, $SupCode){
    $UsrCode=$_SESSION["UsrCode"];  
    $RadaCode=RunNumberRadaCode();
    $dbm=new DatabaseManage();
    $sql="INSERT INTO TMstMRada (XVRadaCode, XVRadaName, XVRadaSN, XVRadaIp, XIRadaPort, XBRadaIsActive, XVSupCode, XVWhoCreate, XTWhenCreate) 
                         VALUES('$RadaCode', '$RadaName', '$RadaSN', '$RadaIp', '$RadaPort', '$RadaIsActive', '$SupCode', '$UsrCode', GETDATE())";
    
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    } 
}
function UpdateRada($RadaCode, $RadaName, $RadaSN, $RadaIp, $RadaPort, $RadaIsActive, $SupCode){
    $UsrCode=$_SESSION["UsrCode"];  
    $dbm=new DatabaseManage();
    $sql="UPDATE TMstMRada set  
                  XVRadaName='$RadaName'
                 ,XVRadaSN='$RadaSN'
                 ,XVRadaIp='$RadaIp'
                 ,XIRadaPort='$RadaPort'
                 ,XBRadaIsActive='$RadaIsActive'
                 ,XVSupCode='$SupCode'
                 ,XVWhoEdit='$UsrCode'
                 ,XTWhenEdit=GETDATE()
                 WHERE XVRadaCode='$RadaCode'";
           
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    } 
    
}
function  DeleteRada($RadaCode){
    $dbm=new DatabaseManage();
    $sql="DELETE FROM TMstMRada  WHERE XVRadaCode='$RadaCode'";
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    } 
}
?>

