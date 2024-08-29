<?php
require('../MQTT/phpMQTT.php');


function Menu_Vms($PrjCode){
    $dbm=new DatabaseManage();
        $sql="SELECT  dbo.TMstMVmsDirect.XVVmsCode, dbo.TMstMVmsDirect.XVVmsName, dbo.TMstMSetupPoint.XVPrjCode, dbo.TMstMVmsDirect.XBVmsIsActive
        FROM     dbo.TMstMVmsDirect INNER JOIN
                          dbo.TMstMSetupPoint ON dbo.TMstMVmsDirect.XVSupCode = dbo.TMstMSetupPoint.XVSupCode
        WHERE  (dbo.TMstMVmsDirect.XBVmsIsActive = 1) AND (dbo.TMstMSetupPoint.XVPrjCode = '$PrjCode')
        ORDER BY dbo.TMstMVmsDirect.XVVmsCode";    
      $result=$dbm->QueryDB($sql);
      return $result;
}
function DeleteImage($VmsPictureDTID){
    $dbm=new DatabaseManage();
    $sql="SELECT  XVVmsCode,XVPictureName FROM TVmsPictureDT
    WHERE  (XVVmsPictureDTID = '$VmsPictureDTID')";
   
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $XVPictureName="";
    $XVVmsCode="";
    foreach ($JsonObj as $result){ 
        $XVVmsCode=$result->XVVmsCode;
        $XVPictureName=$result->XVPictureName;
    }
 
    $sql="DELETE
    FROM     dbo.TVmsPictureDT
    WHERE  (XVVmsPictureDTID = '$VmsPictureDTID')";
    $result=$dbm->QueryDB($sql);
    if($result){
        $location = $XVVmsCode."/ImagePlay"."/".$XVPictureName;
        
        unlink($location);
    }else{
        echo "Err1";
    } 
}
function UploadPicture($VMSC){
    $dbm=new DatabaseManage();
    $UsrCode=$_SESSION["UsrCode"]; 
    if(!is_dir($file)) {
        mkdir($VMSC); 
    }
    if(!is_dir($VMSC."/ImagePlay")) {
        mkdir($VMSC."/ImagePlay"); 
    }
    $filename = $_FILES['file']['name'];
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $filename=date("YmdHis").".".$extension;;
    $location = $VMSC."/ImagePlay"."/".$filename;
    echo   $location;
    if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){
      
        $sql="INSERT INTO TVmsPictureDT (XVVmsCode, XVPictureName, XVWhoCreate, XTWhenCreate) 
        VALUES('$VMSC', '$filename', '$UsrCode', GETDATE())";
     
        $result=$dbm->QueryDB($sql);
        if($result){
        }else{
          echo "Err1";
        } 
    }else{
      
		echo "Err2";
	}
    
}
function ShowDataTableImage($VmsCode){
    $dbm=new DatabaseManage();
    $sql="SELECT  [XVVmsPictureDTID]
    ,[XVVmsCode]
    ,[XVPictureName]
    ,XVPictureType
    FROM [NWL_VMSControl].[dbo].[TVmsPictureDT] WHERE XVVmsCode='$VmsCode'";
  
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    foreach ($JsonObj as $result){ 
        $para="'".$result->XVVmsPictureDTID."'";
        
        $filepath=$result->XVVmsCode."//ImagePlay//".$result->XVPictureName;

        $imgpath="'".$filepath."'";
        $data.='<tr>   
              <td class="p-1"><img  style="width:374px;height:278px;" src="'.$filepath.'" class="rounded"></td> ';
        if($result->XVPictureType=="1"){           
            $data.='<td class="p-1"><i class="'.$Permis[2].' fa-solid fa-pen-to-square" aria-hidden="true" title="แก้ไขข้อความ" onclick="EditImage('.$para.')"></i>';
        }
        $data.='<td class="p-1"><i class="'.$Permis[2].' fa fa-times" aria-hidden="true" title="ลบ" onclick="DeleteImage('.$para.')"></i>
             </tr>';
    }
    return $data;
}
function ShowCamera($VMSC)
{  
    $dbm=new DatabaseManage();
    $sql="SELECT  [XVCamCode]
         ,[XVCamName]
         ,[XVCamSN]
         ,[XVCamURL]
         ,[XBCamIsActive]
         ,[XVSupCode]
          FROM [NWL_VMSControl].[dbo].[TMstMCamera]   WHERE XVVmsDirectCode='$VMSC'";    
        
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $data='';
    $count=count($JsonObj);
    foreach ($JsonObj as $result){
       
            $data.= '
                    <div class="col-sm-12 text-center">
                            <div style="overflow-y: hidden;" class="embed-responsive embed-responsive-16by9">
                               <iframe style="overflow-y: hidden;" class="embed-responsive-item" src="'.$result->XVCamURL.'" allowfullscreen></iframe>
                            </div>
                          
                    </div>';    
       
    } 
    return $data;
   
} 
function SearchImage($PictureId){
    
    $dbm=new DatabaseManage();
    $sql="SELECT  *
    FROM [NWL_VMSControl].[dbo].[TVmsPictureDT] WHERE XVVmsPictureDTID=$PictureId";    
    $result=$dbm->QueryDB($sql);
    return $result;
}
function SendToVms($VmsCode){

    $dbm=new DatabaseManage(); 
    $sql="SELECT  dbo.TMstMRoute.XVLatitude, dbo.TMstMRoute.XVLongtitude, dbo.TMstMRoute.XVLatitudeE, dbo.TMstMRoute.XVLongtitudeE, dbo.TMstMRoute.XVRouteCode, dbo.TMstMVmsDirect.XVVmsCode
         FROM     dbo.TMstMRoute INNER JOIN
                        dbo.TMstMVmsDirect ON dbo.TMstMRoute.XVVmsCode = dbo.TMstMVmsDirect.XVVmsCode
         WHERE  (dbo.TMstMVmsDirect.XVVmsCode = '$VmsCode')
         ORDER BY dbo.TMstMRoute.XVRouteCode";
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);

    $Slatitude="";
    $Slongtitude="";
    $Elatitude="";
    $Elongtitude="";
    $data1="";
    foreach ($JsonObj as $result){
        $RouteCode=$result->XVRouteCode;
        $Slatitude=$result->XVLatitude;
        $Slongtitude=$result->XVLongtitude;
        $Elatitude=$result->XVLatitudeE;
        $Elongtitude=$result->XVLongtitudeE;
        $sql2="SELECT XFPointX, XFPointY, XVPointNumber, XVRouteCode
        FROM     dbo.TRoutePointRoadXy
        WHERE  (XVRouteCode = '$RouteCode')
        ORDER BY XVPointNumber";
        $result2=$dbm->QueryDB($sql2);
        $JsonObj2 = json_decode($result2);
        $X="";
        $Y="";
        foreach ($JsonObj2 as $result2){
                $X.=$result2->XFPointX.",";
                $Y.=$result2->XFPointY.",";
        }
        $X=substr($X,0,strlen($data)-1);
        $Y=substr($Y,0,strlen($data)-1);
        $data1.='{
            "Slatitude":"'.$Slatitude.'",
            "Slongtitude":"'.$Slongtitude.'",
            "Elatitude":'.$Elatitude.',
            "Elongtitude":'.$Elongtitude.',
            "PointX": ['.$X.'],
            "PointY": ['.$Y.']
        },';
    } 
    $data1=substr($data1,0,strlen($data1)-1);
    //---------------------------------------------------------------------------------
    $data2="";
    $X="";
    $Y="";
    $sql="SELECT  [XIRoutePointImageXyID]
      ,[XVVmsCode]
      ,[XFImageName]
      ,[XFPointX]
      ,[XFPointY]
       FROM [NWL_VMSControl].[dbo].[TRoutePointImageXy] WHERE XVVmsCode='$VmsCode'";
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);   
    foreach ($JsonObj as $result){
       $data2.='"'.$result->XFImageName.'"'.',';
       $X.=$result->XFPointX.",";
       $Y.=$result->XFPointY.",";
    }
    $data2=substr($data2,0,strlen($data2)-1);
    $X=substr($X,0,strlen($X)-1);
    $Y=substr($Y,0,strlen($Y)-1);
    $data2='{
        "Image": ['.$data2.'],
        "PointX": ['.$X.'],
        "PointY": ['.$Y.']
    }';
    //-----------------------------------------------------------------------------------
    $data3="";
    $sql="SELECT  [XVVmsPictureDTID]
      ,[XVVmsCode]
      ,[XVPictureName]
    FROM [NWL_VMSControl].[dbo].[TVmsPictureDT] WHERE XVVmsCode='$VmsCode' order by XVVmsPictureDTID";
   
     $result=$dbm->QueryDB($sql);
     $JsonObj = json_decode($result);   
     foreach ($JsonObj as $result){
        $data3.='"'.$result->XVPictureName.'",';
     }
     $data3=substr($data3,0,strlen($data3)-1);
     $data3='{
        "Image": ['.$data3.']
     }';
    //-----------------------------------------------------------------------------------
  
     $WeatherSensor=0;
     $GoogleMap=0;
     $sql="SELECT  [XVVmsCode]
      ,[XBWeatherSensor]
      ,[XBGoogleMap]
      FROM [NWL_VMSControl].[dbo].[TMstMVmsDirect] WHERE XVVmsCode='$VmsCode'";
      
      $result=$dbm->QueryDB($sql);
      $JsonObj = json_decode($result);   
      foreach ($JsonObj as $result){
        $WeatherSensor=$result->XBWeatherSensor;
        $GoogleMap=$result->XBGoogleMap;
      }
      
    //-----------------------------------------------------------------------------------
    $X="";
    $Y="";
    $sql="SELECT XVVmsCode, XFPointX, XFPointY
    FROM     dbo.TRoutePointGMapXy
    WHERE  (XVVmsCode = '$VmsCode')";
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);   
    foreach ($JsonObj as $result){
        $X.=$result->XFPointX.",";
        $Y.=$result->XFPointY.",";
    }
    $X=substr($X,0,strlen($X)-1);
    $Y=substr($Y,0,strlen($Y)-1);
    $data6='{
        "PointX": ['.$X.'],
        "PointY": ['.$Y.']
    }';
    //-----------------------------------------------------------------------------------
    $data1='"RoadPoint": ['.$data1.']';
    $data2='"ImagePoint": ['.$data2.']';
    $data3='"ImagePlay": ['.$data3.']';
    $data4='"GoogleMap":'.$GoogleMap;
    $data5='"WeatherSensor":'.$WeatherSensor;
    $data6='"GMapPoint":['.$data6.']';
   
    $Obj='{"Rout": [{'.$data1.",". $data2.",".$data3.",".$data4.",".$data5.",".$data6.'}]}';
   // echo $Obj;
    if(!is_dir($VmsCode)){
        mkdir($VmsCode);
    }
    if(!is_dir("Json")) {
        mkdir($VmsCode."/Json"); 
    }
    $FnamePath=$VmsCode."/"."Json"."/".$VmsCode.".json";
   
    $myfile = fopen($FnamePath, "w") or die("Unable to open file!");
    fwrite($myfile, $Obj);
    fclose($myfile);
    
    MqttPublish($VmsCode,$VmsCode);
    
}
function MqttPublish($ClientId,$VmsCode){
	$myfile = fopen("../Webconfig/WebConfig.cfg", "r") or die("Unable to open file!");
    $jsonobj= fread($myfile,filesize("../Webconfig/WebConfig.cfg"));
    fclose($myfile);
    $obj = json_decode($jsonobj);
    $Sms='{"MqttCommand":1,"MqttData":""}';
    $Publish="NWL_VMS/".$VmsCode."/RX1";
    
	$MqttServerIp = $obj->MqttServerIp;
    $MqttServerPort = $obj->MqttServerPort;
    $MqttUsereName =  $obj->MqttUsereName;
    $MqttPassword = $obj->MqttPassword;
    $MqttPublisher = $obj->MqttPublisher;  
	$mqtt = new Bluerhinos\phpMQTT($MqttServerIp, $MqttServerPort, $ClientId);
	if ($mqtt->connect(true, NULL, $MqttUsereName, $MqttPassword)) {
		$mqtt->publish($Publish, $Sms , 0, false);
		$mqtt->close();
		echo "Success";  
	}else{
        echo "Fail";
	}
    
}


function TextToBmp($Mode,$PictureId,$color1, $color2, $color3, $color4, $color5, $color6, $color7, $color8, $sms1, $sms2, $sms3, $sms4, $sms5, $sms6, $sms7, $sms8, $fontsize1,$fontsize2,$fontsize3,$fontsize4,$fontsize5,$fontsize6,$fontsize7,$fontsize8,$VMSC){
    
    $sms=array();
    $fontsize=array();
    $G = array();
    $R = array();
    $B = array();
    $countsms=0;
    //if($sms1!=""){
        $sms[$countsms]=$sms1;
        $fontsize[$countsms]=$fontsize1;
        $R[$countsms]=hexdec(substr($color1,1,2));
        $G[$countsms]=hexdec(substr($color1,3,2));
        $B[$countsms]=hexdec(substr($color1,5,2));
        $countsms++;
       
    //}
    //if($sms2!=""){  
        $sms[$countsms]=$sms2;
        $fontsize[$countsms]=$fontsize2;
        $R[$countsms]=hexdec(substr($color2,1,2));
        $G[$countsms]=hexdec(substr($color2,3,2));
        $B[$countsms]=hexdec(substr($color2,5,2));
        $countsms++;
    //}
    //if($sms3!=""){
        $sms[$countsms]=$sms3;
        $fontsize[$countsms]=$fontsize3;
        $R[$countsms]=hexdec(substr($color3,1,2));
        $G[$countsms]=hexdec(substr($color3,3,2));
        $B[$countsms]=hexdec(substr($color3,5,2));
        $countsms++;
    //}
    //if($sms4!=""){
        $sms[$countsms]=$sms4;
        $fontsize[$countsms]=$fontsize4;
        $R[$countsms]=hexdec(substr($color4,1,2));
        $G[$countsms]=hexdec(substr($color4,3,2));
        $B[$countsms]=hexdec(substr($color4,5,2));
        $countsms++;
    //}
    //if($sms5!=""){
        $sms[$countsms]=$sms5;
        $fontsize[$countsms]=$fontsize5;
        $R[$countsms]=hexdec(substr($color5,1,2));
        $G[$countsms]=hexdec(substr($color5,3,2));
        $B[$countsms]=hexdec(substr($color5,5,2));
        $countsms++;
    //}
    //if($sms6!=""){
        $sms[$countsms]=$sms6;
        $fontsize[$countsms]=$fontsize6;
        $R[$countsms]=hexdec(substr($color6,1,2));
        $G[$countsms]=hexdec(substr($color6,3,2));
        $B[$countsms]=hexdec(substr($color6,5,2));
        $countsms++;
    //}
    //if($sms7!=""){
        $sms[$countsms]=$sms7;
        $fontsize[$countsms]=$fontsize7;
        $R[$countsms]=hexdec(substr($color7,1,2));
        $G[$countsms]=hexdec(substr($color7,3,2));
        $B[$countsms]=hexdec(substr($color7,5,2));
        $countsms++;
    //}
    //if($sms8!=""){
        $sms[$countsms]=$sms8;
        $fontsize[$countsms]=$fontsize8;
        $R[$countsms]=hexdec(substr($color8,1,2)).",";
        $G[$countsms]=hexdec(substr($color8,5,2)).",";
        $B[$countsms]=hexdec(substr($color8,5,2));
        $countsms++;
    //}
    
    $S1=$sms[0];
    $S2=$sms[1];
    $S3=$sms[2];
    $S4=$sms[3];
    $S5=$sms[4];
    $S6=$sms[5];
    $S7=$sms[6];
    $S8=$sms[7];
  
            $dbm=new DatabaseManage();  
            $images = imagecreatetruecolor(384,288);
            $bgcolor = imagecolorallocate($images,0,0,0);
            $font = __DIR__."\SarunThangLuang.ttf";
            for($i=0;$i<=$countsms-1;$i++){
              $fontcolor = imagecolorallocate($images, $R[$i], $G[$i], $B[$i]);
              ImagettfText($images, $fontsize[$i], 0, 5, ($i+1)*($fontsize[$i]+10), $fontcolor, $font, $sms[$i]);        
            }
            
            
            $dir = $VMSC."\\ImagePlay\\";
            $fanme=strtotime("now").".bmp";
            $filename=$dir.$fanme;
            if($Mode=="1"){
                $sql="SELECT XVPictureName
                FROM     TVmsPictureDT
                WHERE  (XVVmsPictureDTID = $PictureId)";
                $result=$dbm->QueryDB($sql);
                $JsonObj = json_decode($result);   
                foreach ($JsonObj as $result){
                    $fanme_=$result->XVPictureName;
                    $filename_=$dir.$fanme;
                    unlink($filename_);
                }
            }
          
            imagebmp($images,$filename);
            imagedestroy($images);   
            
            if($Mode=="1"){
                $sql="UPDATE TVmsPictureDT SET
                XVSmsA='$S1',
                XVSmsB='$S2',
                XVSmsC='$S3',
                XVSmsD='$S4',
                XVSmsE='$S5',
                XVSmsF='$S6',
                XVSmsG='$S7',
                XVSmsH='$S8', 
                XIFontSizeA=$fontsize1,
                XIFontSizeB=$fontsize2,
                XIFontSizeC=$fontsize3,
                XIFontSizeD=$fontsize4,
                XIFontSizeE=$fontsize5,
                XIFontSizeF=$fontsize6,
                XIFontSizeG=$fontsize7,
                XIFontSizeH=$fontsize8,
                XVPictureName='$fanme',
                XVWhoEdit='$UsrCode', 
                XTWhenEdit=GETDATE()";
              
            }else{
              

                $sql="INSERT INTO TVmsPictureDT (
                    XVVmsCode, 
                    XVPictureName, 
                    XVSmsA,
                    XVSmsB,
                    XVSmsC,
                    XVSmsD,
                    XVSmsE,
                    XVSmsF,
                    XVSmsG,
                    XVSmsH, 
                    XIFontSizeA,
                    XIFontSizeB,
                    XIFontSizeC,
                    XIFontSizeD,
                    XIFontSizeE,
                    XIFontSizeF,
                    XIFontSizeG,
                    XIFontSizeH,
                    XVPictureType,
                    XVWhoCreate, 
                    XTWhenCreate) 
                VALUES('$VMSC', 
                    '$fanme', 
                    '$S1',
                    '$S2',
                    '$S3',
                    '$S4',
                    '$S5',
                    '$S6',
                    '$S7',
                    '$S8',
                     $fontsize1,
                     $fontsize2,
                     $fontsize3,
                     $fontsize4,
                     $fontsize5,
                     $fontsize6,
                     $fontsize7,
                     $fontsize8,
                    '1', 
                    '$UsrCode', 
                        GETDATE())";   
            }
            $result=$dbm->QueryDB($sql);
            if($result){
            }else{
                echo "Err1";
            } 

    
    echo "OK"; 
}

