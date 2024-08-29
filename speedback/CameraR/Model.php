<?php


function FirstProgect(){
    $dbm=new DatabaseManage();
    $CstCode=$_SESSION["CstCode"];
    if( $_SESSION["CstCode"]=="CUS22-00001"){
        $sql=" SELECT TOP (1) [XVPrjCode], [XVPrjName]
        FROM [NWL_VMSControl].[dbo].[TMstMProject]  ORDER BY XVPrjCode";
    }else{
        $sql=" SELECT TOP (1) [XVPrjCode], [XVPrjName]
        FROM [NWL_VMSControl].[dbo].[TMstMProject] WHERE XVCstCode='$CstCode' ORDER BY XVPrjCode";
    }
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $VmsCode="";
    foreach ($JsonObj as $result){ 
        $VmsCode=$result->XVPrjCode;
    }
    return $VmsCode;
}
function Menu_Sub($PrjCode){
    $dbm=new DatabaseManage();
      $sql="SELECT dbo.TMstMSetupPoint.XVPrjCode, dbo.TMstMCamera.XVCamCode, dbo.TMstMCamera.XVCamName, dbo.TMstMCamera.XBCamIsActive
            FROM   dbo.TMstMSetupPoint INNER JOIN
                               dbo.TMstMCamera ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMCamera.XVSupCode
            WHERE        (dbo.TMstMSetupPoint.XVPrjCode = '$PrjCode')
            ORDER BY dbo.TMstMCamera.XBCamIsActive, dbo.TMstMCamera.XVCamCode";  
      $result=$dbm->QueryDB($sql);
      return $result;
}
function ShowCamera($PrjCode){
    
    $dbm=new DatabaseManage();
    $sql="SELECT dbo.TMstMSetupPoint.XVPrjCode, dbo.TMstMCamera.XVCamCode, dbo.TMstMCamera.XVCamName, dbo.TMstMCamera.XBCamIsActive, 
    dbo.TMstMCamera.XVCamURL
    FROM   dbo.TMstMSetupPoint INNER JOIN
                       dbo.TMstMCamera ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMCamera.XVSupCode
    WHERE        (dbo.TMstMSetupPoint.XVPrjCode = '$PrjCode')
    ORDER BY dbo.TMstMCamera.XBCamIsActive, dbo.TMstMCamera.XVCamCode";  
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $data="";
    
    foreach ($JsonObj as $result){ 
        $sql="SELECT [XVIP] FROM [NWL_VMSControl].[dbo].[TMstMIP] where XVPrjCode='$PrjCode'";
      
        $result2=$dbm->QueryDB($sql);
        $JsonObj2 = json_decode($result2);
        $url="";
        foreach ($JsonObj2 as $result2){
            $url='http://'.$result2->XVIP.$result->XVCamURL; 
        }

        $data.='<div id="'.$result->XVCamCode.'" class="col-4 pt-1" style="min-width: 430px;" >
                     <div class="cam-id">'.$result->XVCamName.
                      '<iframe style="width:430px;height:250px" scrolling="no"   src="'.$url.'" allowfullscreen></iframe>
                      </div>
                   
                
                </div>';
    }
    return $data;
    
}







