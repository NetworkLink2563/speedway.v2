<?php

function RunNumberFskCode(){
    $dbm=new DatabaseManage();
    $sql="select  max(XVFskCode) as XVFskCode   from TMstMFsk";
    $result=$dbm->QueryDB($sql);  
    $JsonObj = json_decode($result);
    $XVFskCode='';
    foreach ($JsonObj as $result){
        $XVFskCode =$result->XVFskCode;               
    }
    if($XVFskCode==''){
        return 'FSK'.date("y")."-00001";
    }else{
        $DocNo=explode("-",$XVFskCode);
        $RunDocNum=intval($DocNo[1])+1;
        $XVFskCode=sprintf("%05d", $RunDocNum);
        return 'FSK'.date("y")."-".$XVFskCode; 
    }   
}



function SearchFsk($FskCode)
{  
    $dbm=new DatabaseManage();
    $sql="SELECT XVFskCode, XVFskName, XVFskSN, XBFskIsActive, XVSupCode, XVWhoCreate, XVWhoEdit, XTWhenCreate, XTWhenEdit
    FROM     dbo.TMstMFsk
    WHERE  (XVFskCode = '$FskCode')";
   
    $result=$dbm->QueryDB($sql);
    return $result;
} 

function ShowBodyTable($PrjCode){
    $Permis=Permission('MNU22-00013');
    $CstCode=$_SESSION["CstCode"];
    $UsrCode=$_SESSION["UsrCode"];
    $dbm=new DatabaseManage();
    
       
           $sql="SELECT  dbo.TMstMProject.XVCstCode, dbo.TMstMSetupPoint.XVSupName, dbo.TMstMProject.XVPrjCode, dbo.TMstMFsk.XVFskCode, dbo.TMstMFsk.XVFskName, dbo.TMstMFsk.XVFskSN, dbo.TMstMFsk.XBFskIsActive, 
           dbo.TMstMFsk.XVSupCode, dbo.TMstMFsk.XVWhoCreate, dbo.TMstMFsk.XVWhoEdit, dbo.TMstMFsk.XTWhenCreate, dbo.TMstMFsk.XTWhenEdit
FROM     dbo.TMstMSetupPoint INNER JOIN
           dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode INNER JOIN
           dbo.TMstMFsk ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMFsk.XVSupCode
WHERE  (dbo.TMstMProject.XVPrjCode = '$PrjCode')
ORDER BY dbo.TMstMSetupPoint.XVSupCode" ;
        
 
   
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $data="[";
    foreach ($JsonObj as $result){ 
        $para="'".$result->XVFskCode."'";
        $FskIsActive='ยกเลิก';
        if($result->XBFskIsActive==1){
            $FskIsActive='ใช้งาน';
        }
       
           
        $E='<i '.$Permis[2].' style=\"cursor: pointer;\" class=\"fa-solid fa-trash\" aria-hidden=\"true\" title=\"ลบ\" onclick=\"FuDelete('.$para.')\"></i>';
        $F='<i style=\"cursor: pointer;\" class=\"fa-solid fa-pen-to-square\" aria-hidden=\"true\" title=\"แก้ไข\" onclick=\"FuEdit('.$para.')\"></i>';
        if($_SESSION["CstCode"]!="CUS22-00001"){
            $E="";
        }    
        $data.='
            {
                "A":"'.$result->XVFskCode.'",
                "B":"'.$result->XVFskName.'",
                "C":"'.$result->XVSupName.'",
                "D":"'.$FskIsActive.'",
                "E":"'.$E.'",
                "F":"'.$F.'"
            },';

        
    }
    $data=substr($data,0,strlen($data)-1)."]";
    return $data;
}

function InsertFsk($FskCode, $FskName, $FskSN, $FskIsActive, $SupCode){
    $UsrCode=$_SESSION["UsrCode"];  
    $FskCode=RunNumberFskCode();
    $dbm=new DatabaseManage();
    $sql="INSERT INTO TMstMFsk 
            (XVFskCode
            ,XVFskName
            ,XVFskSN 
            ,XBFskIsActive 
            ,XVSupCode
            ,XVWhoCreate  
            ,XTWhenCreate)VALUES(
                '$FskCode'
                ,'$FskName'
                ,'$FskSN'
                ,$FskIsActive
                ,'$SupCode'
                ,'$UsrCode'
                ,GETDATE()
            ) 
    ";
    
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    } 
}

function UpdateFsk($FskCode, $FskName, $FskSN, $FskIsActive, $SupCode){
    $UsrCode=$_SESSION["UsrCode"];  
    $dbm=new DatabaseManage();
    $sql="UPDATE TMstMFsk set  
                    XVFskName='$FskName', 
                    XVFskSN='$FskSN', 
                    XBFskIsActive='$FskIsActive', 
                    XVSupCode='$SupCode',
                    XVWhoEdit='$UsrCode', 
                    XTWhenEdit=GETDATE() 
                    WHERE XVFskCode='$FskCode'";
        
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    } 
}
function  DeleteFsk($FskCode){
    $dbm=new DatabaseManage();
    $sql="DELETE FROM TMstMFsk  WHERE XVFskCode='$FskCode'";
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    } 
}
?>