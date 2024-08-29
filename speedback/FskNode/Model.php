<?php

function RunNumberFskNodeCode(){
    $dbm=new DatabaseManage();
    $sql="select  max(XVFskNodeCode) as XVFskNodeCode   from TMstMFskNode";
    $result=$dbm->QueryDB($sql);  
    $JsonObj = json_decode($result);
    $XVFskNodeCode='';
    foreach ($JsonObj as $result){
        $XVFskNodeCode =$result->XVFskNodeCode;               
    }
    if($XVFskNodeCode==''){
        return 'FSN'.date("y")."-00001";
    }else{
        $DocNo=explode("-",$XVFskNodeCode);
        $RunDocNum=intval($DocNo[1])+1;
        $XVFskNodeCode=sprintf("%05d", $RunDocNum);
        return 'FSN'.date("y")."-".$XVFskNodeCode; 
    }   
}

function InPutSelect_Fsk($FskCode,$PrjCode){
    $CstCode=$_SESSION["CstCode"];
    $UsrCode=$_SESSION["UsrCode"];
    $dbm=new DatabaseManage();
    
        if( $_SESSION["CstCode"]=="CUS22-00001"){
            $sql="SELECT  dbo.TMstMProject.XVCstCode, dbo.TMstMProject.XVPrjName, dbo.TMstMFsk.XVFskCode, dbo.TMstMFsk.XVFskName
                  FROM  dbo.TMstMSetupPoint INNER JOIN
                              dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode INNER JOIN
                              dbo.TMstMFsk ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMFsk.XVSupCode
                              where dbo.TMstMProject.XVPrjCode='$PrjCode'
                              ";
        }else{
            if($_SESSION["UsrIsCstAdmin"]==1){
                $sql="SELECT  dbo.TMstMProject.XVCstCode, dbo.TMstMProject.XVPrjName, dbo.TMstMFsk.XVFskCode, dbo.TMstMFsk.XVFskName
                FROM     dbo.TMstMSetupPoint INNER JOIN
                                  dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode INNER JOIN
                                  dbo.TMstMFsk ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMFsk.XVSupCode
                WHERE  (dbo.TMstMProject.XVCstCode = '$CstCode') and (dbo.TMstMProject.XVPrjCode='$PrjCode')
                ORDER BY dbo.TMstMFsk.XVFskCode";
            }else{
                $sql="SELECT  dbo.TMstMProject.XVCstCode, dbo.TMstMProject.XVPrjName, dbo.TMnyMUserProject.XVUsrCode, dbo.TMstMFsk.XVFskCode, dbo.TMstMFsk.XVFskName
                FROM     dbo.TMstMSetupPoint INNER JOIN
                                  dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode INNER JOIN
                                  dbo.TMnyMUserProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMnyMUserProject.XVPrjCode INNER JOIN
                                  dbo.TMstMFsk ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMFsk.XVSupCode
                WHERE  (dbo.TMnyMUserProject.XVUsrCode = '$UsrCode') and (dbo.TMstMProject.XVPrjCode='$PrjCode')
                ORDER BY dbo.TMstMFsk.XVFskCode";
            }

        }
    
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $InputData= '<option value="">...</option>';
    if (count($JsonObj)>0){
        foreach ($JsonObj as $result){ 
            $selected='';
            if($result->XVFskCode==$FskCode){
                $selected='selected';
            } 
            $InputData.= '<option '.$selected.' value="'.$result->XVFskCode.'">'.$result->XVFskName.'</option>';
        }
    }
    return $InputData;
}

function SearchNodeFsk($FskNodeCode)
{  
    $dbm=new DatabaseManage();
    $sql="SELECT XVFskNodeCode, XVFskNodeName, XVFskNodeSN, XBFskNodeIsActive, XVFskCode, XVSupCode, XVWhoCreate
    FROM     dbo.TMstMFskNode
    WHERE  (XVFskNodeCode = '$FskNodeCode')";
   
    $result=$dbm->QueryDB($sql);
    return $result;
} 

function ShowBodyTable($PrjCode){
    $Permis=Permission('MNU22-00014');
    $CstCode=$_SESSION["CstCode"];
    $UsrCode=$_SESSION["UsrCode"];
    $dbm=new DatabaseManage();
   
           $sql="SELECT  dbo.TMstMProject.XVCstCode, dbo.TMstMSetupPoint.XVSupName, dbo.TMstMProject.XVPrjCode, dbo.TMstMFskNode.XVFskNodeCode, dbo.TMstMFskNode.XVFskNodeName, dbo.TMstMFskNode.XVFskNodeSN, 
                    dbo.TMstMFskNode.XBFskNodeIsActive, dbo.TMstMFskNode.XVFskCode, dbo.TMstMFskNode.XVSupCode, dbo.TMstMFskNode.XVWhoCreate, dbo.TMstMFskNode.XVWhoEdit, dbo.TMstMFskNode.XTWhenCreate, 
                    dbo.TMstMFskNode.XTWhenEdit
            FROM     dbo.TMstMSetupPoint INNER JOIN
                    dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode INNER JOIN
                    dbo.TMstMFskNode ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMFskNode.XVSupCode
            WHERE  (dbo.TMstMProject.XVPrjCode = '$PrjCode')
            ORDER BY dbo.TMstMSetupPoint.XVSupCode, dbo.TMstMFskNode.XVFskNodeCode" ;
      
   
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $data="[";
    foreach ($JsonObj as $result){ 
        $para="'".$result->XVFskNodeCode."'";
        $FskIsActive='ยกเลิก';
        if($result->XBFskNodeIsActive==1){
            $FskIsActive='ใช้งาน';
        }
        $E='<i '.$Permis[2].' style=\"cursor: pointer;\" class=\"fa-solid fa-trash\" aria-hidden=\"true\" title=\"ลบ\" onclick=\"FuDelete('.$para.')\"></i>';
        $F='<i style=\"cursor: pointer;\" class=\"fa-solid fa-pen-to-square\" aria-hidden=\"true\" title=\"แก้ไข\" onclick=\"FuEdit('.$para.')\"></i>';
        if($_SESSION["CstCode"]!="CUS22-00001"){
            $E="";
        }   
        $data.='
            {
                "A":"'.$result->XVFskNodeCode.'",
                "B":"'.$result->XVFskNodeName.'",
                "C":"'.$result->XVSupName.'",
                "D":"'.$FskIsActive.'",
                "E":"'.$E.'",
                "F":"'.$F.'"
            },';
         
    }
    $data=substr($data,0,strlen($data)-1)."]";
    return $data;
}

function InsertFsk($FskCode,$FskNodeCode, $FskNodeName, $FsNodekSN, $FskNodeIsActive, $SupCode){
    $UsrCode=$_SESSION["UsrCode"];  
    $FskNodeCode=RunNumberFskNodeCode();
    $dbm=new DatabaseManage();
    $sql="INSERT INTO TMstMFskNode 
            ([XVFskNodeCode]
            ,[XVFskNodeName]
            ,[XVFskNodeSN]
            ,[XBFskNodeIsActive]
            ,[XVFskCode]
            ,[XVSupCode]
            ,XVWhoCreate  
            ,XTWhenCreate)VALUES(
                '$FskNodeCode'
                ,'$FskNodeName'
                ,'$FsNodekSN'
                ,$FskNodeIsActive
                ,'$FskCode'
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

function UpdateFsk($FskCode,$FskNodeCode, $FskNodeName, $FsNodekSN, $FskNodeIsActive, $SupCode){
    $UsrCode=$_SESSION["UsrCode"];  
    $dbm=new DatabaseManage();
    $sql="UPDATE TMstMFskNode  set  
                    [XVFskNodeName]='$FskNodeName'
                    ,[XVFskNodeSN]='$FsNodekSN'
                    ,[XBFskNodeIsActive]=$FskNodeIsActive
                    ,[XVFskCode]='$FskCode'
                    ,[XVSupCode]='$SupCode'
                    ,XVWhoEdit='$UsrCode'
                    ,XTWhenEdit=GETDATE() 
                    WHERE XVFskNodeCode='$FskNodeCode'";
    
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    } 
}
function  DeleteFsk($FskCode){
    $dbm=new DatabaseManage();
    $sql="DELETE FROM TMstMFskNode  WHERE XVFskNodeCode='$FskCode'";
   
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    } 
}
?>