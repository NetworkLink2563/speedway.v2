<?php
function RunNumberSpeedEnforce(){
    $dbm=new DatabaseManage();
    $sql="select  max(XVSpeCode) as XVSpeCode from TMstMSpeedEnforce";
    $result=$dbm->QueryDB($sql);  
    $JsonObj = json_decode($result);
    $XVSpeCode='';
    foreach ($JsonObj as $result){
        $XVSpeCode =$result->XVSpeCode;               
    }
    if($XVSpeCode==''){
        return 'SPE'.date("y")."-00001";
    }else{
        $DocNo=explode("-",$XVSpeCode);
        $RunDocNum=intval($DocNo[1])+1;
        $XVSpeCode=sprintf("%05d", $RunDocNum);
        return 'SPE'.date("y")."-".$XVSpeCode; 
    }   
}

function SearchSpeedEnforce($SpeCode)
{  
    $dbm=new DatabaseManage();
    $sql="SELECT [XVSpeCode]
    ,[XVSpeName]
    ,[XVSpeSN]
    ,[XVSpeURL]
    ,[XBSpeIsActive]
    ,[XVSupCode]
    FROM [NWL_VMSControl].[dbo].[TMstMSpeedEnforce] WHERE XVSpeCode='$SpeCode'" ;
    $result=$dbm->QueryDB($sql);
    return $result;
} 
function ShowBodyTable($PrjCode){
    $Permis=Permission('MNU22-00008');
    $CstCode=$_SESSION["CstCode"];
    $UsrCode=$_SESSION["UsrCode"];
    $dbm=new DatabaseManage();
   
        
    $sql="SELECT dbo.TMstMSpeedEnforce.XVSpeCode, dbo.TMstMSpeedEnforce.XVSpeName, dbo.TMstMSpeedEnforce.XVSpeSN, dbo.TMstMSpeedEnforce.XVSpeURL, dbo.TMstMSpeedEnforce.XBSpeIsActive, 
                        dbo.TMstMSpeedEnforce.XVSupCode, dbo.TMstMSetupPoint.XVSupName, dbo.TMstMProject.XVCstCode, dbo.TMstMProject.XVPrjCode
                FROM     dbo.TMstMSetupPoint INNER JOIN
                        dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode INNER JOIN
                        dbo.TMstMSpeedEnforce ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMSpeedEnforce.XVSupCode
                WHERE  (dbo.TMstMProject.XVPrjCode = '$PrjCode') 
                ORDER BY dbo.TMstMSpeedEnforce.XVSupCode, dbo.TMstMSpeedEnforce.XVSpeCode" ; 
        
    
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $data="[";
    foreach ($JsonObj as $result){ 
        $para="'".$result->XVSpeCode."'";
        $SpeIsActive='ยกเลิก';
        if($result->XBSpeIsActive==1){
            $SpeIsActive='ใช้งาน';
        }
        $E='<i '.$Permis[2].' style=\"cursor: pointer;\" class=\"fa-solid fa-trash\" aria-hidden=\"true\" title=\"ลบ\" onclick=\"FuDelete('.$para.')\"></i>';
        $F='<i style=\"cursor: pointer;\" class=\"fa-solid fa-pen-to-square\" aria-hidden=\"true\" title=\"แก้ไข\" onclick=\"FuEdit('.$para.')\"></i>';
        if($_SESSION["CstCode"]!="CUS22-00001"){
            $E="";
        }
            $data.='
            {
                "A":"'.$result->XVSpeCode.'",
                "B":"'.$result->XVSpeName.'",
                "C":"'.$result->XVSupName.'",
                "D":"'.$SpeIsActive.'",
                "E":"'.$E.'",
                "F":"'.$F.'"
            },';
           
    }
    $data=substr($data,0,strlen($data)-1)."]";
    return $data;
}
function InsertSpeedEnforce($SpeCode, $SpeName, $SpeSN, $SpeURL, $SpeIsActive, $SupCode){
    $UsrCode=$_SESSION["UsrCode"];  
    $SpeCode=RunNumberSpeedEnforce();
    $dbm=new DatabaseManage();
    $sql="INSERT INTO TMstMSpeedEnforce (XVSpeCode, XVSpeName, XVSpeSN, XVSpeURL, XBSpeIsActive, XVSupCode, XVWhoCreate, XTWhenCreate) 
                                VALUES('$SpeCode', '$SpeName', '$SpeSN', '$SpeURL', '$SpeIsActive', '$SupCode', '$UsrCode', GETDATE())";
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    } 
}

function UpdateSpeedEnforce($SpeCode, $SpeName, $SpeSN, $SpeURL, $SpeIsActive, $SupCode){
    $UsrCode=$_SESSION["UsrCode"];  
    $dbm=new DatabaseManage();
    $sql="UPDATE TMstMSpeedEnforce set  
                    XVSpeName='$SpeName', 
                    XVSpeSN='$SpeSN', 
                    XVSpeURL='$SpeURL',
                    XBSpeIsActive='$SpeIsActive', 
                    XVSupCode='$SupCode',
                    XVWhoEdit='$UsrCode', 
                    XTWhenEdit=GETDATE() 
                    WHERE XVSpeCode='$SpeCode'";             
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    } 
}
function DeleteSpeedEnforce($SpeCode){
    $dbm=new DatabaseManage();
    $sql="DELETE FROM TMstMSpeedEnforce WHERE XVSpeCode='$SpeCode'";             
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    } 
}
?>