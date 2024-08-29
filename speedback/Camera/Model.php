<?php

function RunNumberCamCode(){
    $dbm=new DatabaseManage();
    $sql="select  max(XVCamCode) as XVCamCode   from TMstMCamera";
    $result=$dbm->QueryDB($sql);  
    $JsonObj = json_decode($result);
    $XVCamCode='';
    foreach ($JsonObj as $result){
        $XVCamCode =$result->XVCamCode;               
    }
    if($XVCamCode==''){
        return 'CAM'.date("y")."-00001";
    }else{
        $DocNo=explode("-",$XVCamCode);
        $RunDocNum=intval($DocNo[1])+1;
        $XVCamCode=sprintf("%05d", $RunDocNum);
        return 'CAM'.date("y")."-".$XVCamCode; 
    }   
}



function SearchCamera($CamCode)
{  
    $dbm=new DatabaseManage();
    $sql="SELECT  [XVCamCode]
         ,[XVCamName]
         ,[XVCamSN]
         ,[XVCamURL]
         ,[XBCamIsActive]
         ,[XVSupCode]
         ,[XVVmsDirectCode]
          FROM [NWL_VMSControl].[dbo].[TMstMCamera] WHERE XVCamCode='$CamCode'";
    $result=$dbm->QueryDB($sql);
    return $result;
} 

function ShowBodyTable($PrjCode){
    $Permis=Permission('MNU22-00006');
    $CstCode=$_SESSION["CstCode"];
    $UsrCode=$_SESSION["UsrCode"];
    $dbm=new DatabaseManage();
    
       
           $sql="SELECT  dbo.TMstMCamera.XVCamCode, dbo.TMstMCamera.XVCamName, dbo.TMstMCamera.XVCamSN, dbo.TMstMCamera.XVCamURL, dbo.TMstMCamera.XBCamIsActive, dbo.TMstMCamera.XVSupCode, 
                    dbo.TMstMCamera.XVVmsCode, dbo.TMstMProject.XVCstCode, dbo.TMstMSetupPoint.XVSupName, dbo.TMstMProject.XVPrjCode
            FROM     dbo.TMstMSetupPoint INNER JOIN
                    dbo.TMstMCamera ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMCamera.XVSupCode INNER JOIN
                    dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode
            WHERE  (dbo.TMstMProject.XVPrjCode= '$PrjCode') 
            ORDER BY dbo.TMstMSetupPoint.XVSupCode, dbo.TMstMCamera.XVCamCode" ;
        
       
   
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $data="[";
    foreach ($JsonObj as $result){ 
        $para="'".$result->XVCamCode."'";
        $CamIsActive='ยกเลิก';
        if($result->XBCamIsActive==1){
            $CamIsActive='ใช้งาน';
        }
        $E='<i '.$Permis[2].'  style=\"cursor: pointer;\" class=\"fa-solid fa-trash\" aria-hidden=\"true\" title=\"ลบ\" onclick=\"FuDelete('.$para.')\"></i>';
        $F='<i style=\"cursor: pointer;\" class=\"fa-solid fa-pen-to-square\" aria-hidden=\"true\" title=\"แก้ไข\" onclick=\"FuEdit('.$para.')\"></i>';
        if($_SESSION["CstCode"]!="CUS22-00001"){
            $E="";
        }
            $data.='
            {
                "A":"'.$result->XVCamCode.'",
                "B":"'.$result->XVCamName.'",
                "C":"'.$result->XVSupName.'",
                "D":"'.$CamIsActive.'",
                "E":"'. $E.'",
                "F":"'. $F.'"
            },';
          
    }
    $data=substr($data,0,strlen($data)-1)."]";
    return $data;
}

function InsertCamera($CamCode, $CamName, $CamSN, $CamURL, $CamIsActive, $SupCode, $VmsDirectCode){
    $UsrCode=$_SESSION["UsrCode"];  
    $CamCode=RunNumberCamCode();
    $dbm=new DatabaseManage();
    $sql="INSERT INTO TMstMCamera (XVCamCode, XVCamName, XVCamSN, XVCamURL, XBCamIsActive, XVSupCode, XVVmsDirectCode, XVWhoCreate, XTWhenCreate) 
                         VALUES('$CamCode', '$CamName', '$CamSN', '$CamURL', '$CamIsActive', '$SupCode', '$VmsDirectCode', '$UsrCode', GETDATE())";
   
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    } 
}

function UpdateCamera($CamCode, $CamName, $CamSN, $CamURL, $CamIsActive, $SupCode, $VmsDirectCode){
    $UsrCode=$_SESSION["UsrCode"];  
    $dbm=new DatabaseManage();
    $sql="UPDATE TMstMCamera set  
                  
                    XVCamName='$CamName', 
                    XVCamSN='$CamSN', 
                    XVCamURL='$CamURL', 
                    XBCamIsActive='$CamIsActive', 
                    XVSupCode='$SupCode',
                    XVWhoEdit='$UsrCode', 
                  
                    XVVmsDirectCode='$VmsDirectCode',
                    XTWhenEdit=GETDATE() 
                    WHERE XVCamCode='$CamCode'";
    
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    } 
}
function  DeleteCamera($CamCode){
    $dbm=new DatabaseManage();
    $sql="DELETE FROM TMstMCamera  WHERE XVCamCode='$CamCode'";
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    } 
}
?>