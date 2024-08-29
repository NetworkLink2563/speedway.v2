<?php





function RunNumberRoute(){
    $dbm=new DatabaseManage();
    $sql="select  max(XVRouteCode) as XVRouteCode   from TMstMRoute";
    $result=$dbm->QueryDB($sql);  
    $JsonObj = json_decode($result);
    $XVRouteCode='';
    foreach ($JsonObj as $result){
        $XVRouteCode =$result->XVRouteCode;               
    }
    if($XVRouteCode==''){
        return 'ROU'.date("y")."-00001";
    }else{
        $DocNo=explode("-",$XVRouteCode);
        $RunDocNum=intval($DocNo[1])+1;
        $XVRouteCode=sprintf("%05d", $RunDocNum);
        return 'ROU'.date("y")."-".$XVRouteCode; 
    }   
}


function Search($RouteCode)
{  
    $dbm=new DatabaseManage();
    $sql="SELECT XVRouteCode, XVRouteName, XVRoadNumber, XBRouteIsActive, XVSupCode, XVLatitude, XVLongtitude, XVLatitudeE, XVLongtitudeE,  XVVmsCode,
    XFRouteNameAdjX, XFRouteNameAdjY, XFRoadNumberStartX, XFRoadNumberStartY, XFRoadNumberEndX, XFRoadNumberEndY
          FROM dbo.TMstMRoute
          WHERE (XVRouteCode = '$RouteCode')";     
        
    $result=$dbm->QueryDB($sql);
    return $result;
} 
function ShowBodyTable($PrjCode){
    $Permis=Permission('MNU22-00011');
    $CstCode=$_SESSION["CstCode"];
    $UsrCode=$_SESSION["UsrCode"];
    $dbm=new DatabaseManage();

            $sql="SELECT dbo.TMstMRoute.XVRouteCode,  dbo.TMstMRoute.XVRoadNumber, dbo.TMstMRoute.XVRouteName, dbo.TMstMRoute.XVLatitude, dbo.TMstMRoute.XVLongtitude, dbo.TMstMRoute.XBRouteIsActive, dbo.TMstMProject.XVCstCode, dbo.TMstMSetupPoint.XVSupName, dbo.TMstMProject.XVPrjCode
            FROM     dbo.TMstMSetupPoint INNER JOIN
                            dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode INNER JOIN
                            dbo.TMstMRoute ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMRoute.XVSupCode
            WHERE  (dbo.TMstMProject.XVPrjCode = '$PrjCode') 
            ORDER BY dbo.TMstMSetupPoint.XVSupCode, dbo.TMstMRoute.XVRouteCode";  
       

    
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $data="[";
    foreach ($JsonObj as $result){ 
        $para="'".$result->XVRouteCode."'";
        $RouteIsActive='ยกเลิก';
        if($result->XBRouteIsActive==1){
            $RouteIsActive='ใช้งาน';
        }
        $E='<i '.$Permis[2].' style=\"cursor: pointer;\" class=\"fa-solid fa-trash\" aria-hidden=\"true\" title=\"ลบ\" onclick=\"FuDelete('.$para.')\"></i>';
        $F='<i style=\"cursor: pointer;\"  class=\"fa-solid fa-pen-to-square\" aria-hidden=\"true\" title=\"แก้ไข\" onclick=\"FuEdit('.$para.')\"></i>';
            $data.='
            {
                "A":"'.$result->XVRouteCode.'",
                "B":"'.$result->XVRouteName.'",
                "C":"'.$RouteIsActive.'",
                "D":"'.$SpeIsActive.'",
                "E":"'.$E.'",
                "F":"'.$F.'"
            },';
          
    }
    $data=substr($data,0,strlen($data)-1)."]";
    return $data;
}
function Insert($RouteCode, $RouteName, $RoadNumber, $Latitude, $Longtitude, $Latitudeend, $Longtitudend, $RouteIsActive, $SupCode,$VmsCode){
    $UsrCode=$_SESSION["UsrCode"];  
    $RouteCode=RunNumberRoute();
    $dbm=new DatabaseManage();
    $sql="INSERT INTO TMstMRoute (XVRouteCode, XVRouteName, XVRoadNumber, XVLatitude, XVLongtitude, XVLatitudeE, XVLongtitudeE, XBRouteIsActive, XVSupCode, XVVmsCode, XVWhoCreate, XTWhenCreate) 
                         VALUES('$RouteCode', '$RouteName', '$RoadNumber',  '$Latitude', '$Longtitude', '$Latitudeend', '$Longtitudeed', '$RouteIsActive', '$SupCode', '$VmsCode', '$UsrCode', GETDATE())";
     
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    } 
}
function Update($RouteCode, $RouteName, $RoadNumber, $Latitude, $Longtitude, $Latitudeend, $Longtitudend, $RouteIsActive, $SupCode,$VmsCode){
    $UsrCode=$_SESSION["UsrCode"];  
    $dbm=new DatabaseManage();
    $sql="UPDATE TMstMRoute set  
                  XVRouteName='$RouteName'
                 ,XVRoadNumber='$RoadNumber'
                 ,XVLatitude='$Latitude'
                 ,XVLongtitude='$Longtitude' 

                 ,XVLatitudeE='$Latitudeend'
                 ,XVLongtitudeE='$Longtitudend'
                 ,XBRouteIsActive='$RouteIsActive'
                 ,XVSupCode='$SupCode'
                 ,XVVmsCode='$VmsCode'
                 ,XVWhoEdit='$UsrCode'
                 ,XTWhenEdit=GETDATE()
                 WHERE XVRouteCode='$RouteCode'";
   
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    } 
    
}
function  Delete($RouteCode){
    $dbm=new DatabaseManage();
    $sql="DELETE FROM TMstMRoute  WHERE XVRouteCode='$RouteCode'";
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    } 
}
function DeletePointDT($RoutedtId){
    $dbm=new DatabaseManage();
    $sql="DELETE FROM TMstMRouteDT  WHERE XIRoutedtId=$RoutedtId";
    
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    } 
}
function InsertDt($RouteCode,$Latitude,$Longitude){
    $UsrCode=$_SESSION["UsrCode"]; 
    $dbm=new DatabaseManage();
    $sql="INSERT INTO TMstMRouteDT (XVRouteCode, XVPointName, XFLatitude, XFLongitude, XVLatitudeE, XVLongtitudeE, XVWhoCreate, XTWhenCreate) 
    VALUES('$RouteCode', $Latitude, $Longitude, '$UsrCode', GETDATE())";
 
    $result=$dbm->QueryDB($sql);
    if($result){
       echo ShowBodyTable("");
    }else{
       echo "Err1";
    } 
}
function ShowBodyTableDT($RouteCode){
    $Permis=Permission('MNU22-00005');
    $CstCode=$_SESSION["CstCode"];
    $dbm=new DatabaseManage();
    $sql="SELECT  [XIRoutedtId]
        ,[XVRouteCode]
        ,[XVPointName]
        ,[XFLatitude]
        ,[XFLongitude]
    FROM [NWL_VMSControl].[dbo].[TMstMRouteDT] WHERE XVRouteCode='$RouteCode'";  
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $data="";
    foreach ($JsonObj as $result){ 
        $para="'".$result->XIRoutedtId."'";
       
      
            $data.='<tr>
            
                  
                    <td class="p-1">'.$result->XVPointName.'</td>
                    <td class="p-1 text-center">'.$result->XFLatitude.'</td>
                    <td class="p-1 text-center">'.$result->XFLongitude.'</td>
                    <td class="p-1"><i class="'.$Permis[2].' fa fa-times" aria-hidden="true" title="ลบ" onclick="DeletePointDT('.$para.')"></i>
                  
                    
            </tr>';
          
    }
    return $data;
}

function UpdateXY( $RoutCode,$RouteNameAdjX,$RouteNameAdjY,$RoadNumberStartX,$RoadNumberStartY,$RoadNumberEndX,$RoadNumberEndY){
    $UsrCode=$_SESSION["UsrCode"];  
    $dbm=new DatabaseManage();
    $sql="UPDATE TMstMRoute set  
                  XFRouteNameAdjX='$RouteNameAdjX'
                 ,XFRouteNameAdjY='$RouteNameAdjY'
                 ,XFRoadNumberStartX='$RoadNumberStartX'
                 ,XFRoadNumberStartY='$RoadNumberStartY' 
                 ,XFRoadNumberEndX='$RoadNumberEndX'
                 ,XFRoadNumberEndY='$RoadNumberEndY'
                 ,XVWhoEdit='$UsrCode'
                 ,XTWhenEdit=GETDATE()
                 WHERE XVRouteCode='$RoutCode'";
                  
    $result=$dbm->QueryDB($sql);
    if($result){
      // echo ShowBodyTable("");
    }else{
       echo "Err1";
    }
              
}
?>


