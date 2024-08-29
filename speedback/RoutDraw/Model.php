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
      $sql="SELECT        TOP (100) PERCENT dbo.TMstMSetupPoint.XVPrjCode, dbo.TMstMVmsDirect.XVVmsCode, dbo.TMstMVmsDirect.XVVmsName, dbo.TMstMVmsDirect.XBVmsIsActive
      FROM            dbo.TMstMSetupPoint INNER JOIN
                               dbo.TMstMVmsDirect ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMVmsDirect.XVSupCode
      WHERE        (dbo.TMstMVmsDirect.XBVmsIsActive = 1) AND (dbo.TMstMSetupPoint.XVPrjCode = '$PrjCode')
      ORDER BY dbo.TMstMVmsDirect.XVVmsCode";  
      $result=$dbm->QueryDB($sql);
      return $result;
}
function InPutSelect_Rout($VmsCode){
    $CstCode=$_SESSION["CstCode"];
    $dbm=new DatabaseManage();
    $sql="SELECT XVRouteCode, XVRouteName, XVVmsCode
    FROM     dbo.TMstMRoute
    WHERE  (XVVmsCode = '$VmsCode')
    ORDER BY XVRouteCode" ;
   
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $InputData= '<option value="">...</option>';
    if (count($JsonObj)>0){
        foreach ($JsonObj as $result){ 
            $InputData.= '<option '.$selected.' value="'.$result->XVRouteCode.'">'.$result->XVRouteName.'</option>';
        }
    }
    return $InputData;
}
function InsertUpdatePoint($RouteCode,$PointX,$PointY,$Color){
    $UsrCode=$_SESSION["UsrCode"]; 
    $dbm=new DatabaseManage();
    $sql="SELECT XVRouteCode, MAX(XVPointNumber) AS XVPointNumber
    FROM     TRoutePointRoadXy
    WHERE  (XVRouteCode = '$RouteCode')
    GROUP BY XVRouteCode";
    $PointNumber=0;
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    foreach ($JsonObj as $result){ 
        $PointNumber=$result->XVPointNumber+1;
    }
    $sql="INSERT INTO TRoutePointRoadXy (XVRouteCode, XVPointNumber, XFPointX, XFPointY, XVColor, XVWhoCreate, XTWhenCreate) 
    VALUES('$RouteCode', '$PointNumber', $PointX, $PointY, '$Color', '$UsrCode', GETDATE())";
   
    $result=$dbm->QueryDB($sql);
    if($result){
    }else{
      echo "Err1";
    } 
}
function ShowDataTable($VmsCode){
    $UsrCode=$_SESSION["UsrCode"]; 
    $dbm=new DatabaseManage();
    $sql="SELECT  TRoutePointRoadXy.XIRoutePointXyID, TRoutePointRoadXy.XVRouteCode, TRoutePointRoadXy.XVPointNumber, TRoutePointRoadXy.XFPointX, TRoutePointRoadXy.XFPointY, TRoutePointRoadXy.XVColor, 
    dbo.TMstMRoute.XVRouteName, dbo.TMstMRoute.XVVmsCode
FROM     TRoutePointRoadXy INNER JOIN
    dbo.TMstMRoute ON TRoutePointRoadXy.XVRouteCode = dbo.TMstMRoute.XVRouteCode
WHERE  (dbo.TMstMRoute.XVVmsCode = '$VmsCode')
ORDER BY TRoutePointRoadXy.XIRoutePointXyID"; 

    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $data="";
    foreach ($JsonObj as $result){ 
        $para="'".$result->XIRoutePointXyID."'";
        $para2="'".$result->XIRoutePointXyID."','".$result->XFPointX."','".$result->XFPointY."','1'";
            $data.='<tr >   
                    <td hidden class="p-1">'.$result->XIRoutePointXyID.'</td>  
                    <td class="p-1">'.$result->XVRouteName.'</td> 
                    <td class="p-1">'.$result->XVPointNumber.'</td>
                    <td class="p-1 text-center">'.$result->XFPointX.'</td>
                    <td class="p-1 text-center">'.$result->XFPointY.'</td>
                    <td style="background-color:'.$result->XVColor.'" class="p-1 text-center">'.$result->XVColor.'</td>
                    <td class="p-1"><i class="fa fa-times" aria-hidden="true" title="ลบ" onclick="DeletePointXy('.$para.')"></i>
                    <td class="p-1"><i class="fa fa-magic" aria-hidden="true" title="แก้ไข" onclick="EditPointXy('.$para2.')"></i>
            </tr>';
    }
    return $data;
}
function InsertTimeGmap($VmsCode,$RouteCode,$PointX,$PointY){
    $UsrCode=$_SESSION["UsrCode"]; 
    $dbm=new DatabaseManage();
    $sql="INSERT INTO TRoutePointGMapXy (XVVmsCode, XVRouteCode, XFPointX, XFPointY, XVWhoCreate, XTWhenCreate) 
    VALUES('$VmsCode','$RouteCode', $PointX, $PointY, '$UsrCode', GETDATE())";
    
    $result=$dbm->QueryDB($sql);
    if($result){
    }else{
      echo "Err1";
    } 
}
function ShowDataTableGTime($VmsCode){
    $dbm=new DatabaseManage();
    $sql="SELECT  [XIRoutePointGMapID]
    ,[XVRouteCode]
    ,[XFPointX]
    ,[XFPointY]
    FROM [NWL_VMSControl].[dbo].[TRoutePointGMapXy] where XVVmsCode='$VmsCode'";
    $sql="SELECT  dbo.TRoutePointGMapXy.XIRoutePointGMapID, dbo.TMstMRoute.XVRouteName, dbo.TRoutePointGMapXy.XFPointX, dbo.TRoutePointGMapXy.XFPointY, dbo.TRoutePointGMapXy.XVVmsCode, 
    dbo.TRoutePointGMapXy.XVRouteCode
    FROM     dbo.TRoutePointGMapXy INNER JOIN
    dbo.TMstMRoute ON dbo.TRoutePointGMapXy.XVRouteCode = dbo.TMstMRoute.XVRouteCode
    WHERE  (dbo.TRoutePointGMapXy.XVVmsCode = '$VmsCode')
    ORDER BY dbo.TRoutePointGMapXy.XIRoutePointGMapID";
    $data="";
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    foreach ($JsonObj as $result){ 
        $para="'".$result->XIRoutePointGMapID."'";
        $para2="'".$result->XIRoutePointGMapID."','".$result->XFPointX."','".$result->XFPointY."','3'";
        $data.='<tr>   
                     <td class="p-1">'.$result->XIRoutePointGMapID.'</td>  
                     <td class="p-1">'.$result->XVRouteName.'</td>
                     <td class="p-1">'.$result->XFPointX.'</td>
                     <td class="p-1 text-center">'.$result->XFPointY.'</td>
                     <td class="p-1"><i class=" fa fa-times" aria-hidden="true" title="ลบ" onclick="DeleteGMapXy('.$para.')"></i>
                     <td class="p-1"><i class=" fa fa-magic" aria-hidden="true" title="ลบ" onclick="EditPointXy('.$para2.')"></i>
             </tr>';
    }
    return $data;
}
function UploadPicture($VMSC,$PointX,$PointY){
    $UsrCode=$_SESSION["UsrCode"]; 
   
    if(!is_dir($file)) {
        echo $VMSC;
      mkdir($VMSC); 
    }
    if(!is_dir($VMSC."/ImageLabel")) {
        mkdir($VMSC."/ImageLabel"); 
    }
    $filename = $_FILES['file']['name'];
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $f=date("YmdHis").".".$extension;
    $location = $VMSC."/ImageLabel"."/".$f;
	
    
    if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){
        $dbm=new DatabaseManage();
        $sql="INSERT INTO TRoutePointImageXy (XVVmsCode, XFImageName, XFPointX, XFPointY, XVWhoCreate, XTWhenCreate) 
        VALUES('$VMSC', '$f', $PointX, $PointY, '$UsrCode', GETDATE())";
        $result=$dbm->QueryDB($sql);
        if($result){
        }else{
          echo "Err1";
        } 
    }else{
		echo "Err1";
	}
}
function ShowDataTableImage($VmsCode){
    $dbm=new DatabaseManage();
    $sql="SELECT XIRoutePointImageXyID, XVVmsCode, XFImageName, XFPointX, XFPointY
    FROM     dbo.TRoutePointImageXy
    WHERE  (XVVmsCode = '$VmsCode')
    ORDER BY XIRoutePointImageXyID";
    $data="";
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    foreach ($JsonObj as $result){ 
        $para="'".$result->XIRoutePointImageXyID."'";
        $para2="'".$result->XIRoutePointImageXyID."','".$result->XFPointX."','".$result->XFPointY."','2'";
        $data.='<tr>   
                     <td class="p-1">'.$result->XIRoutePointImageXyID.'</td>  
                     <td class="p-1">'.$result->XFImageName.'</td> 
                     <td class="p-1">'.$result->XFPointX.'</td>
                     <td class="p-1 text-center">'.$result->XFPointY.'</td>
                     <td class="p-1"><i class=" fa fa-times" aria-hidden="true" title="ลบ" onclick="DeleteImageXy('.$para.')"></i>
                     <td class="p-1"><i class=" fa fa-magic" aria-hidden="true" title="ลบ" onclick="EditPointXy('.$para2.')"></i>
             </tr>';
    }
    return $data;
}
function EditXYPointRoad($Id,$X,$Y){
    $dbm=new DatabaseManage();
    $sql="Update TRoutePointRoadXy set XFPointX=$X,XFPointY=$Y where XIRoutePointXyID=$Id";
    $result=$dbm->QueryDB($sql);
    if($result){
        
    }else{
        echo "Err1";
    } 
}
function EditXYPointImage($Id,$X,$Y){
    $dbm=new DatabaseManage();
    $sql="Update TRoutePointImageXy set XFPointX=$X,XFPointY=$Y where XIRoutePointImageXyID=$Id";
    $result=$dbm->QueryDB($sql);
    if($result){
       
    }else{
        echo "Err1";
    } 
}

function EditXYPointGMap($Id,$X,$Y){
    $dbm=new DatabaseManage();
    $sql="Update TRoutePointGMapXy set XFPointX=$X,XFPointY=$Y where XIRoutePointGMapID=$Id";
    $result=$dbm->QueryDB($sql);
    if($result){
        
    }else{
        echo "Err1";
    } 
}
function DeletePointXy($RoutePointXyID){
    $dbm=new DatabaseManage();
    $sql="DELETE FROM TRoutePointRoadXy  WHERE XIRoutePointXyID=$RoutePointXyID";
    $result=$dbm->QueryDB($sql);
    if($result){
       
    }else{
        echo "Err1";
    } 
}
function DeleteImageXy($RoutePointImageXyID){
    $dbm=new DatabaseManage();
    $sql="select XVVmsCode,XFImageName from TRoutePointImageXy  WHERE XIRoutePointImageXyID=$RoutePointImageXyID"; 
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $XVVmsCode="";
    $XFImageName="";
    foreach ($JsonObj as $result){ 
        $XVVmsCode=$result->XVVmsCode;
        $XFImageName=$result->XFImageName;
    }

    $sql="DELETE FROM TRoutePointImageXy  WHERE XIRoutePointImageXyID=$RoutePointImageXyID"; 
    $result=$dbm->QueryDB($sql);
    if($result){
        
        $f=$XVVmsCode."//ImageLabel//".$XFImageName;
        unlink($f);
    }else{
        echo "Err1";
    } 
}
function DeleteGMapXy($RoutePointGMapID){
    $dbm=new DatabaseManage();
    $sql="DELETE FROM TRoutePointGMapXy  WHERE XIRoutePointGMapID=$RoutePointGMapID";
    $result=$dbm->QueryDB($sql);
    if($result){
       
    }else{
        echo "Err1";
    } 
}
?>