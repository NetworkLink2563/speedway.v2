<?php



function RunNumberWSSCode(){
    $dbm=new DatabaseManage();
    $sql="select  max(XVWssCode) as XVWssCode   from TMstMWeatherSensor";
    $result=$dbm->QueryDB($sql);  
    $JsonObj = json_decode($result);
    $XVWssCode='';
    foreach ($JsonObj as $result){
        $XVWssCode =$result->XVWssCode;               
    }
    if($XVWssCode==''){
        return 'WSS'.date("y")."-00001";
    }else{
        $DocNo=explode("-",$XVWssCode);
        $RunDocNum=intval($DocNo[1])+1;
        $XVWssCode=sprintf("%05d", $RunDocNum);
        return 'WSS'.date("y")."-".$XVWssCode; 
    }   
}

function SearchWeatherSensor($WssCode)
{  
    $dbm=new DatabaseManage();
    $sql="SELECT [XVWssCode]
         ,[XVWssName]
         ,[XVSN]
         ,[XBIsActive]
         ,[XVSupCode]
         ,[XVVmsCode]
        FROM [NWL_VMSControl].[dbo].[TMstMWeatherSensor] WHERE XVWssCode='$WssCode'";
      
        $result=$dbm->QueryDB($sql);
        return $result;
} 
function ShowBodyTable($PrjCode){
    $Permis=Permission('MNU22-00007');
    $CstCode=$_SESSION["CstCode"];
    $UsrCode=$_SESSION["UsrCode"];
    $dbm=new DatabaseManage();

        
            $sql="SELECT dbo.TMstMWeatherSensor.XVWssCode, dbo.TMstMWeatherSensor.XVWssName, dbo.TMstMWeatherSensor.XVSN, dbo.TMstMWeatherSensor.XBIsActive, 
                    dbo.TMstMWeatherSensor.XVSupCode, dbo.TMstMSetupPoint.XVSupName, dbo.TMstMProject.XVCstCode, dbo.TMstMProject.XVPrjCode 
            FROM     dbo.TMstMSetupPoint INNER JOIN
                    dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode INNER JOIN
                    dbo.TMstMWeatherSensor ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMWeatherSensor.XVSupCode
            WHERE  (dbo.TMstMProject.XVPrjCode  = '$PrjCode')
            ORDER BY dbo.TMstMWeatherSensor.XVSupCode, dbo.TMstMWeatherSensor.XVWssCode" ;
    
  
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $data="[";
    foreach ($JsonObj as $result){ 
        $para="'".$result->XVWssCode."'";
        $IsActive='ยกเลิก';
        if($result->XBIsActive==1){
            $IsActive='ใช้งาน';
        }
        $E='<i '.$Permis[2].' style=\"cursor: pointer;\" class=\"fa-solid fa-trash\" aria-hidden=\"true\" title=\"ลบ\" onclick=\"FuDelete('.$para.')\"></i>';
        $F='<i style=\"cursor: pointer;\" class=\"fa-solid fa-pen-to-square\" aria-hidden=\"true\" title=\"แก้ไข\" onclick=\"FuEdit('.$para.')\"></i>';
        if($_SESSION["CstCode"]!="CUS22-00001"){
            $E="";
        }
            $data.='
            {
                "A":"'.$result->XVWssCode.'",
                "B":"'.$result->XVWssName.'",
                "C":"'.$result->XVSupName.'",
                "D":"'.$IsActive.'",
                "E":"'.$E.'",
                "F":"'.$F.'"
            },';
        
    }
    $data=substr($data,0,strlen($data)-1)."]";
    return $data;
}
function InsertWeatherSensor($WssCode, $WssName, $SN, $IsActive, $SupCode, $VmsCode){
    $UsrCode=$_SESSION["UsrCode"];  
    $WssCode=RunNumberWSSCode();
    $dbm=new DatabaseManage();
    $sql="INSERT INTO TMstMWeatherSensor (XVWssCode, XVWssName, XVSN, XBIsActive, XVSupCode, XVVmsCode, XVWhoCreate, XTWhenCreate) 
                         VALUES('$WssCode', '$WssName', '$SN', '$SpeIsActive', '$SupCode', '$VmsCode', '$UsrCode', GETDATE())";
                       
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    } 
}
function UpdateWeatherSensor($WssCode, $WssName, $SN, $IsActive, $SupCode, $VmsCode){
    $UsrCode=$_SESSION["UsrCode"];  
    $dbm=new DatabaseManage();
    $sql="UPDATE TMstMWeatherSensor set  
                    XVWssName='$WssName', 
                    XVSN='$SN', 
                    XBIsActive='$IsActive', 
                    XVSupCode='$SupCode',
                    XVVmsCode='$VmsCode',
                    XVWhoEdit='$UsrCode', 
                    XTWhenEdit=GETDATE() 
                    WHERE XVWssCode='$WssCode'";                        
    $result=$dbm->QueryDB($sql);

    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    } 
}
function DeleteWeatherSensor($WssCode){
    $dbm=new DatabaseManage();
    $sql="DELETE TMstMWeatherSensor WHERE XVWssCode='$WssCode'";                        
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    } 
}

?>