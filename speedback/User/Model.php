<?php


   
function InPutSelect_Customer($CstCode)
{   $CstCode=$_SESSION["CstCode"];
    $UsrCode=$_SESSION["UsrCode"];
    $dbm=new DatabaseManage();
    $sql="SELECT [XVCstCode], [XVCstName] FROM [TMstMCustomer]";
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $InputData='<option value="">...</option>';
    if (count($JsonObj)>0){
        foreach ($JsonObj as $result){ 
            $selected='';
            if($result->XVCstCode==$CstCode){
                $selected='selected';
            }
            $InputData.= '<option '.$selected.' value="'.$result->XVCstCode.'">'.$result->XVCstName.'</option>';
        }
    }
    $InputData.='</select>';
    return $InputData;
}  
function EmailRegister($CstCode){
    $ret=false;
    $dbm=new DatabaseManage();
    $sql="SELECT XVUsrCode  FROM TMstMUser WHERE XVUsrCode='$CstCode'";
   
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    if (count($JsonObj)>0){
        $ret=true;
    }
    return $ret;
}
function RegisterAccount($CstCode,$UsrCode, $UsrPwd, $UsrName,  $Status)
{  
    $UsrCode=str_replace("'","''",$UsrCode);
    $UsrPwd=str_replace("'","''",$UsrPwd);
    $UsrName=str_replace("'","''",$UsrName);
  
    $IsCstAdmin=0;
    if($_SESSION["CstCode"]=="CUS22-00001"){
        $IsCstAdmin=1;
    }

    if(EmailRegister($UsrCode)==true){
        echo "Err1";
    }else{
       
        $ret="";
        $dbm=new DatabaseManage();
        $sql="INSERT INTO TMstMUser ( XVCstCode, XVUsrCode, XVUsrPwd, XVUsrPwdDef, XVUsrName, XTWhenCreate, XBUsrIsActive2, XBUsrIsActive,XBUsrIsCstAdmin) 
        VALUES( '$CstCode', '$UsrCode', [dbo].[FN_GETtEncoding]('$UsrPwd','$UsrPwd'), 
        [dbo].[FN_GETtEncoding]('$UsrPwd','$UsrPwd'), '$UsrName', GETDATE(), $Status, 1, $IsCstAdmin)
        ";
      
        $result=$dbm->QueryDB($sql);
        
        if($result){
            //echo ShowBodyTable();
        }else{
            echo "Err2";
        }
        
    }
    
} 
function EditAccount($CstCode,$UsrCode,$Status){
    $IsCstAdmin=0;
    if($CstCode=="CUS22-00001"){
        $IsCstAdmin=1;
    }
    $dbm=new DatabaseManage();
    $sql="UPDATE TMstMUser SET XBUsrIsCstAdmin=$IsCstAdmin, XBUsrIsActive2='$Status' WHERE XVUsrCode='$UsrCode'";
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable($_SESSION["CstCode"]);
    }else{
        echo "Err2";
    }    
}
function DeleteAccount($UsrCode){
    $dbm=new DatabaseManage();
    $sql="DELETE FROM TMstMUser  WHERE XVUsrCode='$UsrCode'";
   

    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable($_SESSION["CstCode"]);
    }else{
        echo "Err1";
    } 
}
function ShowBodyTable($CustCode){
   // $Permis=Permission('MNU22-00004');
    $CstCode=$_SESSION["CstCode"];
    $dbm=new DatabaseManage();
    
    $sql="SELECT XVCstCode, XVUsrCode, XVUsrName, XVUsrPhone, XBUsrIsActive, XBUsrIsActive2, XBUsrIsCstAdmin FROM TMstMUser ";
    
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $data='[';
    foreach ($JsonObj as $result){ 
        $Status="ยกเลิก";
        if($result->XBUsrIsActive2==1){
            $Status="ใช้งาน";
        }
        $para0="'".$result->XVUsrCode."'";
        $para1="'".$result->XVUsrCode."'".",'".$result->XVUsrName."','".$result->XVUsrPhone."'".",'".$result->XBUsrIsActive2."'".",'".$result->XVCstCode."'";
        /*
        $UsrCode=$result->XVUsrCode;
        $p1=array();
        $p2=array();
        $p3=array();
        $sql="SELECT  [XVMnuCode],[XVUsrCode],[XBUmnIsRead],[XBUmnIsSave],[XBUmnIsDelete],[XBUmnIsCancel],[XBUmnIsApprove]
        FROM [NWL_VMSControl].[dbo].[TMnyMUserMenu] WHERE XVUsrCode='$UsrCode' ORDER BY XVMnuCode";
        $result1=$dbm->QueryDB($sql);
        $JsonObj1 = json_decode($result1);
      
        foreach ($JsonObj1 as $result1){
            array_push($p1,$result1->XBUmnIsRead);
            array_push($p2,$result1->XBUmnIsSave);
            array_push($p3,$result1->XBUmnIsDelete);
        }
        $UsrName=str_replace("'","\'",$result->XVUsrName);
        $para0="'".$result->XVUsrCode."'";
        $para1="'".$result->XVUsrCode."'".",'".$UsrName."','".$result->XVUsrPhone."'".",'".$result->XBUsrIsActive2."'";
        $para2="'".$result->XVUsrCode."'".",'".json_encode($p1)."','".json_encode($p2)."'".",'".json_encode($p3)."'";
        $para3="'".$result->XVUsrCode."'";
        $F='';
        $G='';
      */
       // if (($_SESSION["UsrIsCstAdmin"]!=$result->XBUsrIsCstAdmin)||( $_SESSION["CstCode"]=="CUS22-00001")){
          //  $F='<i '.$Permis[1].' style=\"cursor: pointer;\" class=\"fa fa-key\" aria-hidden=\"true\" title=\"กำหนดสิทธิ์เมนู\" onclick=\"FuPermis('.$para2.')\"></i>';
       // }
       
       // if (($_SESSION["UsrIsCstAdmin"]!=$result->XBUsrIsCstAdmin)||( $_SESSION["CstCode"]=="CUS22-00001")){          
            //$G='<i '.$Permis[1].' style=\"cursor: pointer;\" class=\"fa fa-folder\" aria-hidden=\"true\" title=\"กำหนดสิทธิ์โครงการ\" onclick=\"FuProject('.$para3.')\"></i>';
        //}
      
        $data.='
        {
            "A":"'.$result->XVUsrName.'",
            "B":"'.$result->XVUsrCode.'",
            "C":"'.$Status.'",
            "D":"<i '.$Permis[2].' style=\"cursor: pointer;\" class=\"fa-solid fa-trash\" aria-hidden=\"true\" title=\"ลบ\" onclick=\"FuDelete('.$para0.')\"></i>",
            "E":"<i style=\"cursor: pointer;\" class=\"fa-solid fa-pen-to-square\" aria-hidden=\"true\" title=\"แก้ไข\" onclick=\"FuEdit('.$para1.')\"></i>",
            "F":"'.$F.'",
            "G":"'.$G.'"
        },';
    }
    $data=substr($data,0,strlen($data)-1)."]";
    return $data;
}



    

function UpdateMenu($MnuCode,$UsrCode,$s1,$s2,$s3,$UserEdit){
    $dbm=new DatabaseManage();
    $sql="UPDATE TMnyMUserMenu SET 
         XBUmnIsRead='$s1', 
         XBUmnIsSave='$s2', 
         XBUmnIsDelete='$s3', 
        
         XVWhoEdit='$UserEdit',
         XTWhenEdit=GETDATE()  
    WHERE XVMnuCode='$MnuCode' AND XVUsrCode='$UsrCode'";


$dbm=new DatabaseManage();
$sql="INSERT INTO TMnyMUserMenu (XVMnuCode,XVUsrCode,XBUmnIsRead,XBUmnIsSave,XBUmnIsDelete,XVWhoCreate,XTWhenCreate) VALUES ('$MnuCode','$UsrCode','$UserCreate',GETDATE())";
$result=$dbm->QueryDB($sql);
    $result=$dbm->QueryDB($sql);
}
function Permissions($UsrCode,$s1,$s2,$s3){
    $dbm=new DatabaseManage();
    $sql="delete FROM TMnyMUserMenu WHERE  XVUsrCode='$UsrCode'";
    
    $result=$dbm->QueryDB($sql);
    $MenuCode = array("","MNU22-00001","MNU22-00002","MNU22-00003","MNU22-00004","MNU22-00005","MNU22-00006","MNU22-00007","MNU22-00008",
    "MNU22-00009","MNU22-00010","MNU22-00011","MNU22-00012","MNU22-00013","MNU22-00014","MNU22-00015","MNU22-00016","MNU22-00017","MNU22-00018",
    "MNU22-00019","MNU22-00020","MNU22-00021","MNU22-00022"
    );
    for ($i=1;$i<=21;$i++){
        $s_1=$s1[$i];
        $s_2=$s2[$i];
        $s_3=$s3[$i];
        $MnuCode=$MenuCode[$i];
        $sql="INSERT INTO TMnyMUserMenu (XVMnuCode,
                                         XVUsrCode,
                                         XBUmnIsRead,
                                         XBUmnIsSave,
                                         XBUmnIsDelete,
                                         XVWhoCreate,
                                         XTWhenCreate) VALUES (
                                            '$MnuCode',
                                            '$UsrCode',
                                             $s_1,
                                             $s_2,
                                             $s_3,
                                            '$UserCreate',
                                            GETDATE())";
                                            $result=$dbm->QueryDB($sql);
                                            echo $sql."\n";
        //InsertMenu($MenuCode[$i],$UsrCode,$_SESSION["UsrCode"]);
        //UpdateMenu($MenuCode[$i],$UsrCode,$s1[$i],$s2[$i],$s3[$i],$_SESSION["UsrCode"]);
    }
    ///echo ShowBodyTable();
}
function ShowProject(){
    $dbm=new DatabaseManage();
    $CstCode=$_SESSION["CstCode"];
    $UsrCode=$_SESSION["UsrCode"];
    if( $_SESSION["CstCode"]=="CUS22-00001"){
        $sql="SELECT  XVPrjCode, XVPrjName, XVCstCode
          FROM     dbo.TMstMProject
          ORDER BY XVPrjCode";
    }else{
        $sql="SELECT  XVPrjCode, XVPrjName, XVCstCode
        FROM     dbo.TMstMProject
        WHERE  (XVCstCode = '$CstCode')
        ORDER BY XVPrjCode";
    } 
    $result=$dbm->QueryDB($sql); 
    $JsonObj = json_decode($result);
    $data="";
    $i=0;
    foreach ($JsonObj as $result){
            $PrjTxtId='txt'.$i;
            $PrjSelId='Sel'.$i;
            $data.='<div class="form-group row p-0 m-0">
                <div class="col-sm-12 pt-1 m-0">
                    <input type="hidden" value="'.$result->XVPrjCode.'" name="txtProjectC[]">
                    <input class="p-0 m-0" type="checkbox" id="'.$PrjSelId.'"> '.$result->XVPrjName.'
                </div>
            </div>';
            $i++; 
    }
    return $data;     
}
function UsrPrj($UsrCode){
    $dbm=new DatabaseManage();
    $sql="SELECT  [XVPrjCode]
        ,[XVUsrCode]
    FROM [NWL_VMSControl].[dbo].[TMnyMUserProject] WHERE XVUsrCode ='$UsrCode' ORDER BY XVPrjCode";
    $result=$dbm->QueryDB($sql);
    return  $result;
}
function PermisPrj($UsrCode,$s1){
    $UserCreate=$_SESSION["UsrCode"];
    $dbm=new DatabaseManage();
    $sql="DELETE FROM [NWL_VMSControl].[dbo].[TMnyMUserProject] WHERE XVUsrCode ='$UsrCode'";
    $result=$dbm->QueryDB($sql);
    foreach ($s1 as $PrjCode) {
        $sql="INSERT INTO TMnyMUserProject (XVPrjCode,XVUsrCode,XVWhoCreate,XTWhenCreate) VALUES ('$PrjCode','$UsrCode','$UserCreate',GETDATE())";
        $result=$dbm->QueryDB($sql);
    }   
}
?>