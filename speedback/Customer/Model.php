<?php

function ShowBodyTable(){
        $data='';
        $CstCode=$_SESSION["CstCode"];
        $dbm=new DatabaseManage();
        $sql="SELECT 
        XVCstCode 
        ,XVCstName
        ,XVCstPhone
        ,XVCstEmail
        ,XBCstIsActive
        FROM TMstMCustomer";

        $result=$dbm->QueryDB($sql);
        $JsonObj = json_decode($result);
        $data="[";
        foreach ($JsonObj as $result){ 
            $Status="ยกเลิก";
            if($result->XBCstIsActive==1){
                $Status="ใช้งาน";
            }
            $para="'".$result->XVCstCode."'";
            /*
            $data.='<tr>
                    <td class="p-1">'.$result->XVCstCode.'</td>
                    <td class="p-1">'.$result->XVCstName.'</td>  
           
                    <td class="p-1">'.$Status.'</td>
                    <td class="p-1"><i '.$Permis[2].' class="fa-solid fa-trash" aria-hidden="true" title="ลบ" onclick="FuDelete('.$para.')"></i>
                    <td class="p-1"><i class="fa-solid fa-pen-to-square" aria-hidden="true" title="แก้ไข" onclick="FuEdit('.$para.')"></i></td>
            </tr>';
            */
            $data.='
            {
                "A":"'.$result->XVCstCode.'",
                "B":"'.$result->XVCstName.'",
                "C":"'.$Status.'",
             
                "D":"<i '.$Permis[2].' style=\"cursor: pointer;\" class=\"fa-solid fa-trash\" aria-hidden=\"true\" title=\"ลบ\" onclick=\"FuDelete('.$para.')\">",
                "E":"<i style=\"cursor: pointer;\" class=\"fa-solid fa-pen-to-square\" aria-hidden=\"true\" title=\"แก้ไข\" onclick=\"FuEdit('.$para.')\"></i>"
            },';
        }    
        
    
        $data=substr($data,0,strlen($data)-1)."]";
        return $data;
}

function SearchCustomer($CstCode)
{  
    $dbm=new DatabaseManage();
    $sql="SELECT XVCstCode, XVCstName, XVCstPhone, XVCstEmail, XBCstIsAlwReg, XBCstIsActive
    FROM     dbo.TMstMCustomer
    WHERE  (XVCstCode = '$CstCode')";
    $result=$dbm->QueryDB($sql);
    return $result;
} 
function RunNumberCustomerCode(){
    $dbm=new DatabaseManage();
    $sql="select  max(XVCstCode) as XVCstCode   from TMstMCustomer ";
    $result=$dbm->QueryDB($sql);  
    $JsonObj = json_decode($result);
    $XVCstCode='';
    foreach ($JsonObj as $result){
        $XVCstCode =$result->XVCstCode;               
    }
    if($XVCstCode==''){
        return "CST-0001";
    }else{
        $DocNo=explode("-",$XVCstCode);
        $RunDocNum=intval($DocNo[1])+1;
        $XVCstCode=sprintf("%04d", $RunDocNum);
        return 'CST'."-".$XVCstCode; 
    }   
}

function InsertUpdate($Mode,$CstCode,$CstName,$CstEmail,$CstPhone,$CstIsActive){
    $UsrCode=$_SESSION["UsrCode"];  
    $dbm=new DatabaseManage();
    if($Mode==0){
        $CstCode=RunNumberCustomerCode();
        $sql="INSERT INTO TMstMCustomer (XVCstCode, XVCstName, XVCstPhone, XVCstEmail, XBCstIsActive, XVWhoCreate, XTWhenCreate) 
            VALUES('$CstCode', '$CstName', '$CstPhone', '$CstEmail', '$CstIsActive', '$UsrCode', GETDATE())";
    }
    if($Mode==1){
        $sql="UPDATE TMstMCustomer SET 
               XVCstName='$CstName', 
               XVCstPhone='$CstPhone', 
               XVCstEmail='$CstEmail', 
               XBCstIsActive='$CstIsActive', 
               XVWhoEdit='$UsrCode', 
               XTWhenEdit= GETDATE()
               WHERE XVCstCode='$CstCode'
        ";
    }
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    } 
}
function  DeleteCustomer($CstCode){
    $dbm=new DatabaseManage();
    $sql="DELETE FROM TMstMCustomer  WHERE XVCstCode='$CstCode'";
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    } 
}
?>