<?php
  function PermissionProject($PrjCode){
    $UsrCode=$_SESSION["UsrCode"];
    $dbm=new DatabaseManage();
    $sql1="SELECT XVPrjCode, XVUsrCode
    FROM     dbo.TMnyMUserProject
    WHERE  (XVPrjCode = '$PrjCode') AND (XVUsrCode = '$UsrCode')";    
    $result1=$dbm->QueryDB($sql1);
    $JsonObj1 = json_decode($result1);
    $ret=false;
    if( $_SESSION["CstCode"]=="CUS22-00001"){
        $ret=true;
    }else{
        if (count($JsonObj1)>0){
            $ret=true;
        }
    }
    return $ret;
}

/*
  function InPutSelect_Project()
  {  
      $dbm=new DatabaseManage();
      $sql="SELECT [XVPrjCode]
      ,[XVPrjName]
      FROM [NWL_VMSControl].[dbo].[TMstMProject]";
      $result=$dbm->QueryDB($sql);
      $JsonObj = json_decode($result);
      if (count($JsonObj)>0){
          foreach ($JsonObj as $result){ 
            $selected='';
            if($result->XVPrjCode==$PrjCode){
                $selected='selected';
            } 
            if(PermissionProject($result->XVPrjCode)==true){
               $InputData.= '<option '.$selected.' value="'.$result->XVPrjCode.'">'.$result->XVPrjName.'</option>';
            }
          }
      }
      return $InputData;
  } 
*/
function InPutSelect_Customer($XVCstCode){
    $dbm=new DatabaseManage();
    $InputData="";
    $sql="SELECT  [XVCstCode], 
       [XVCstName], 
       [XVCstDescription], 
       [XVCstPhone], 
       [XVCstEmail]
      ,[XBCstIsAlwReg]
      ,[XBCstIsActive]
      ,[XVWhoCreate]
      ,[XVWhoEdit]
      ,[XTWhenCreate]
      ,[XTWhenEdit]
      FROM [NWL_SpeedWayTest].[dbo].[TMstMCustomer]
    ";
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $InputData= '';
    if (count($JsonObj)>0){
        foreach ($JsonObj as $result){ 
            $selected='';
            if($result->XVCstCode==$XVCstCode){
                $selected='selected';
            } 
            $InputData.= '<option '.$selected.' value="'.$result->XVCstCode.'">'.$result->XVCstName.'</option>';
        }
    }
        
    return $InputData;
}
function InPutSelect_Project()
{   $CstCode=$_SESSION["CstCode"];
    $UsrCode=$_SESSION["UsrCode"];
    $dbm=new DatabaseManage();
 
    $sql="SELECT  dbo.TMstMProject.XVPrjCode, dbo.TMstMProject.XVPrjName, dbo.TMstMCustomer.XVCstCode
        FROM     dbo.TMstMProject INNER JOIN
                        dbo.TMstMCustomer ON dbo.TMstMProject.XVCstCode = dbo.TMstMCustomer.XVCstCode
        ORDER BY dbo.TMstMProject.XVPrjCode";
    echo $sqll;
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $InputData= '';
    if (count($JsonObj)>0){
        foreach ($JsonObj as $result){ 
            $selected='';
            if($result->XVPrjCode==$PrjCode){
                $selected='selected';
            } 
           
                $InputData.= '<option '.$selected.' value="'.$result->XVPrjCode.'">'.$result->XVPrjName.'</option>';
            
            
        }
    }
    return $InputData;
} 
/*
InPutSelect_Project();
  function InPutSelect_SetupPoint($SupCode,$PrjCode)
{   $Permis=Permission('MNU22-00013');
    $CstCode=$_SESSION["CstCode"];
    $UsrCode=$_SESSION["UsrCode"];
    $dbm=new DatabaseManage();
    if( $_SESSION["CstCode"]=="CUS22-00001"){
        $sql="SELECT  dbo.TMstMSetupPoint.XVSupCode, dbo.TMstMSetupPoint.XVSupName, dbo.TMstMProject.XVCstCode, dbo.TMstMProject.XVPrjCode, dbo.TMstMProject.XVPrjName

        FROM     dbo.TMstMSetupPoint INNER JOIN
                        dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode
        WHERE  (dbo.TMstMProject.XVPrjCode = '$PrjCode')
        ORDER BY dbo.TMstMSetupPoint.XVSupCode";
    }else{
        if( $_SESSION["UsrIsCstAdmin"]=="CUS22-00001"){
            $sql="SELECT  dbo.TMstMSetupPoint.XVSupCode, dbo.TMstMSetupPoint.XVSupName, dbo.TMstMProject.XVCstCode, dbo.TMstMProject.XVPrjCode, dbo.TMstMProject.XVPrjName
            FROM     dbo.TMstMSetupPoint INNER JOIN
                            dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode
            WHERE  (dbo.TMstMProject.XVCstCode = '$CstCode') and (dbo.TMstMProject.XVPrjCode = '$PrjCode')
            ORDER BY dbo.TMstMSetupPoint.XVSupCode";
        }else{
            $sql="SELECT  dbo.TMstMSetupPoint.XVSupCode, dbo.TMstMSetupPoint.XVSupName, dbo.TMstMProject.XVCstCode, dbo.TMstMProject.XVPrjCode, dbo.TMstMProject.XVPrjName, dbo.TMnyMUserProject.XVUsrCode
            FROM     dbo.TMstMSetupPoint INNER JOIN
                            dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode INNER JOIN
                            dbo.TMnyMUserProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMnyMUserProject.XVPrjCode
            WHERE  (dbo.TMnyMUserProject.XVUsrCode = '$UsrCode') and (dbo.TMstMProject.XVPrjCode = '$PrjCode')
            ORDER BY dbo.TMstMSetupPoint.XVSupCode";

        }    
    }
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $InputData= '<option value="">...</option>';
    if (count($JsonObj)>0){
        foreach ($JsonObj as $result){ 
            $selected='';
            if($result->XVSupCode==$SupCode){
                $selected='selected';
            } 
            if( $_SESSION["CstCode"]=="CUS22-00001"){
                $InputData.= '<option '.$selected.' value="'.$result->XVSupCode.'">'.$result->XVSupName." ".$result->XVPrjName.'</option>';
            }else{
                if(PermissionProject($result->XVPrjCode)==true){
                   $InputData.= '<option '.$selected.' value="'.$result->XVSupCode.'">'.$result->XVSupName." ".$result->XVPrjName.'</option>';
                }
                 
            }
        }
    }
    return $InputData;
} */
function InPutSelect_VmsDirect($VmsCode,$PrjCode)
{   $CstCode=$_SESSION["CstCode"];
    $UsrCode=$_SESSION["UsrCode"];
    $dbm=new DatabaseManage();
    
        if( $_SESSION["CstCode"]=="CUS22-00001"){
            $sql="SELECT  dbo.TMstMVmsDirect.XVVmsCode, dbo.TMstMVmsDirect.XVVmsName, dbo.TMstMProject.XVCstCode, dbo.TMstMProject.XVPrjName
            FROM     dbo.TMstMVmsDirect INNER JOIN
                            dbo.TMstMSetupPoint ON dbo.TMstMVmsDirect.XVSupCode = dbo.TMstMSetupPoint.XVSupCode INNER JOIN
                            dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode
            WHERE  (dbo.TMstMProject.XVPrjCode = '$PrjCode')
            ORDER BY dbo.TMstMVmsDirect.XVVmsCode";
        }else{
            if($_SESSION["UsrIsCstAdmin"]==1){
                $sql="SELECT  dbo.TMstMVmsDirect.XVVmsCode, dbo.TMstMVmsDirect.XVVmsName, dbo.TMstMProject.XVCstCode, dbo.TMstMProject.XVPrjName
                FROM     dbo.TMstMVmsDirect INNER JOIN
                                dbo.TMstMSetupPoint ON dbo.TMstMVmsDirect.XVSupCode = dbo.TMstMSetupPoint.XVSupCode INNER JOIN
                                dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode
                WHERE   (dbo.TMstMProject.XVCstCode = '$CstCode') and  (dbo.TMstMProject.XVPrjCode = '$PrjCode')
                ORDER BY dbo.TMstMVmsDirect.XVVmsCode";
            }else{
                $sql="SELECT  dbo.TMstMVmsDirect.XVVmsCode, dbo.TMstMVmsDirect.XVVmsName, dbo.TMstMProject.XVCstCode, dbo.TMstMProject.XVPrjName, dbo.TMnyMUserProject.XVUsrCode
                FROM  dbo.TMstMVmsDirect INNER JOIN
                                dbo.TMstMSetupPoint ON dbo.TMstMVmsDirect.XVSupCode = dbo.TMstMSetupPoint.XVSupCode INNER JOIN
                                dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode INNER JOIN
                                dbo.TMnyMUserProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMnyMUserProject.XVPrjCode
                WHERE  (dbo.TMnyMUserProject.XVUsrCode = '$UsrCode') and  (dbo.TMstMProject.XVPrjCode = '$PrjCode')
                ORDER BY dbo.TMstMVmsDirect.XVVmsCode";
            }

        }
    
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $InputData= '<option value="">...</option>';
    if (count($JsonObj)>0){
        foreach ($JsonObj as $result){ 
            $selected='';
            if($result->XVVmsCode==$VmsCode){
                $selected='selected';
            } 
            $InputData.= '<option '.$selected.' value="'.$result->XVVmsCode.'">'.$result->XVVmsName.'</option>';
        }
    }
    return $InputData;
} 
  function Permission($MnuCode){
    $UsrCode=$_SESSION["UsrCode"];
    $dbm=new DatabaseManage();
    $sql1="SELECT  [XVMnuCode]
        ,[XVUsrCode]
        ,[XBUmnIsRead]
        ,[XBUmnIsSave]
        ,[XBUmnIsDelete]
        ,[XBUmnIsCancel]
        ,[XBUmnIsApprove]
        FROM [NWL_VMSControl].[dbo].[TMnyMUserMenu] WHERE XVMnuCode='$MnuCode' And XVUsrCode='$UsrCode' ORDER BY XVMnuCode";    
    
    $result1=$dbm->QueryDB($sql1);
    $JsonObj1 = json_decode($result1);
   
    
    foreach ($JsonObj1 as $result1){ 
        $x='';
        if($result1->XBUmnIsRead==0){
            $x='disabled';
            if( $_SESSION["CstCode"]=="CUS22-00001"){
                $x='';
            }
        } 
        $p[0]=$x;
        $x='';
        if($result1->XBUmnIsSave==0){
            $x='disabled';
            if( $_SESSION["CstCode"]=="CUS22-00001"){
                $x='';
            }
        } 
        $p[1]=$x;
        $x='';
        if($result1->XBUmnIsDelete==0){
            $x='disabled';
            if( $_SESSION["CstCode"]=="CUS22-00001"){
                $x='';
            }
        } 
        $p[2]=$x;
        $x='';
        if($result1->XBUmnIsCancel==0){
            $x='disabled';
            if( $_SESSION["CstCode"]=="CUS22-00001"){
                $x='';
            }
        } 
        $p[3]=$x;
        $x='';
        if($result1->XBUmnIsApprove==0){
            $x='disabled';
            if( $_SESSION["CstCode"]=="CUS22-00001"){
                $x='';
            }
        } 
        $p[4]=$x;
    }
    return $p;
}
  
?>