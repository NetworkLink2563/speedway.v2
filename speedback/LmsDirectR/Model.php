<?php

require('../MQTT/phpMQTT.php');

function Menu_Vms($PrjCode){
    $dbm=new DatabaseManage();
        $sql="SELECT  dbo.TMstMVmsDirect.XVVmsCode, dbo.TMstMVmsDirect.XVVmsName, dbo.TMstMSetupPoint.XVPrjCode, dbo.TMstMVmsDirect.XBVmsIsActive
        FROM     dbo.TMstMVmsDirect INNER JOIN
                          dbo.TMstMSetupPoint ON dbo.TMstMVmsDirect.XVSupCode = dbo.TMstMSetupPoint.XVSupCode
        WHERE  (dbo.TMstMVmsDirect.XBVmsIsActive = 1) AND (dbo.TMstMVmsDirect.XVTYPE = 2) AND (dbo.TMstMSetupPoint.XVPrjCode = '$PrjCode')
        ORDER BY dbo.TMstMVmsDirect.XVVmsCode";    
      $result=$dbm->QueryDB($sql);
      return $result;
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
            $data.='<td class="p-1"><i class="fa-solid fa-pen-to-square" aria-hidden="true" title="แก้ไขข้อความ" onclick="EditImage('.$para.')"></i>';
        }
        $data.='<td class="p-1"><i class="fa fa-times" aria-hidden="true" title="ลบ" onclick="DeleteImage('.$para.')"></i>
             </tr>';
    }
    return $data;
}
function ShowCamera($VMSC)
{  
    $dbm=new DatabaseManage();
    $sql="SELECT     dbo.TMstMCamera.XVVmsDirectCode, dbo.TMstMSetupPoint.XVSupCode, dbo.TMstMSetupPoint.XVPrjCode, dbo.TMstMCamera.XVCamURL
    FROM        dbo.TMstMCamera INNER JOIN
                      dbo.TMstMSetupPoint ON dbo.TMstMCamera.XVSupCode = dbo.TMstMSetupPoint.XVSupCode
    WHERE     (dbo.TMstMCamera.XVVmsDirectCode = '$VMSC')";    
     
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $data='';
    $count=count($JsonObj);
    foreach ($JsonObj as $result){
            $XVCamURL=$result->XVCamURL;
            $XVPrjCode=$result->XVPrjCode;
            $sql="SELECT [XVIP] FROM [NWL_VMSControl].[dbo].[TMstMIP] where XVPrjCode='$XVPrjCode'";
           
            $result2=$dbm->QueryDB($sql);
            $JsonObj2 = json_decode($result2);
            foreach ($JsonObj2 as $result2){
                $data='http://'.$result2->XVIP.$XVCamURL; 
            }
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

function MqttPublish($ClientId,$VmsCode){
	$myfile = fopen("../Webconfig/WebConfig.cfg", "r") or die("Unable to open file!");
    $jsonobj= fread($myfile,filesize("../Webconfig/WebConfig.cfg"));
    fclose($myfile);
    $obj = json_decode($jsonobj);
    $Sms='{"Command":1}';
    $Publish="VMS/".$VmsCode;
    
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



function MediaProject($PrjCode){
    $dbm=new DatabaseManage();  
    $sql="SELECT   XVPrjCode, XVMediaVmsCode, XVMediaName, XVMediaType
    FROM dbo.TMstMMediaVms
    WHERE (XVPrjCode = '$PrjCode') AND (XVMediaType=2) ORDER BY XVMediaVmsCode";
     $result=$dbm->QueryDB($sql);
     $JsonObj = json_decode($result); 
     $CountRec=0;  
     $data="[";
     foreach ($JsonObj as $result){ 
            // $para="'".$result->XVMediaVmsCode."',"."'".$result->XVMediaType."'";
            $CountRec=$CountRec+1;
            $CheckBox='<input name=\"Ck[]\" type=\"checkbox\" class=\"form-check-input\" value=\"'.$result->XVMediaVmsCode.'\">';
            if($result->XVMediaType==1){
                $Type="ข้อความ";
            }
            if($result->XVMediaType==2){
                $Type="รูปภาพ";
            }
            if($result->XVMediaType==3){
                $Type="วีดีโอ";
             }
             if($result->XVMediaType==4){
                $Type="เส้นทาง";
             }
            $data.='
            {
              
                 "A":"'.$result->XVMediaName.'",
                 "B":"'.$Type.'",
                 "C":"'.$CheckBox.'"
            },';
     }
     if ($CountRec==0){
        $data.="-"; 
     }
     $data=substr($data,0,strlen($data)-1)."]";
     return $data;
}
function MediaSetTable($VmsCode){
    $dbm=new DatabaseManage();  
    $sql="SELECT dbo.TMstMMediaVms.XVMediaVmsCode, dbo.TMstMMediaVms.XVMediaName, dbo.TMstMMediaVms.XVMediaType, dbo.TMstMMediaSetVms.XVVmsCode, 
                         dbo.TMstMMediaSetVms.XIDelay, dbo.TMstMMediaSetVms.XIID
          FROM dbo.TMstMMediaVms INNER JOIN
                         dbo.TMstMMediaSetVms ON dbo.TMstMMediaVms.XVMediaVmsCode = dbo.TMstMMediaSetVms.XVMediaVmsCode
          WHERE     (dbo.TMstMMediaSetVms.XVVmsCode = '$VmsCode')
          ORDER BY dbo.TMstMMediaSetVms.XIID";
            
           $result=$dbm->QueryDB($sql);
           $JsonObj = json_decode($result);   
           $CountRec=0;
           $data="[";
           foreach ($JsonObj as $result){ 
                  $CountRec=$CountRec+1;
                  $CheckBox='<input name=\"Cks[]\" type=\"checkbox\" class=\"form-check-input\" value=\"'.$result->XIID.'\">';
                  if($result->XVMediaType==1){
                      $Type="ข้อความ";
                  }
                  if($result->XVMediaType==2){
                      $Type="รูปภาพ";
                  }
                  if($result->XVMediaType==3){
                    $Type="วีดีโอ";
                  }
                  $C='<button style=\"width:50px;\" type=\"button\" class=\"btn btn-info btn-sm\" onclick=\"SetDelay('.$result->XIID.')\">'.$result->XIDelay.'</button>';
                  $data.='
                  {
                      
                       "A":"'.$result->XVMediaName.'",
                       "B":"'.$Type.'",
                       "C":"'.$C.'",
                       "D":"'.$CheckBox.'"
                  },';
           }
           if ($CountRec==0){
              $data.="-"; 
           }
           $data=substr($data,0,strlen($data)-1)."]";
         
           return $data;
}
function SampleMediaSetTable($VmsCode){
    $dbm=new DatabaseManage();  
    $sql="SELECT dbo.TMstMMediaVms.XVMediaVmsCode, dbo.TMstMMediaVms.XVMediaName, dbo.TMstMMediaVms.XVMediaType, dbo.TMstMMediaSetVms.XVVmsCode, dbo.TMstMMediaSetVms.XIDelay, 
            dbo.TMstMMediaSetVms.XIID, dbo.TMstMMediaVms.XVPrjCode, dbo.TMstMMediaVms.XVFileName,dbo.TMstMMediaVms.XVSms
        FROM            dbo.TMstMMediaVms INNER JOIN
            dbo.TMstMMediaSetVms ON dbo.TMstMMediaVms.XVMediaVmsCode = dbo.TMstMMediaSetVms.XVMediaVmsCode
        WHERE        (dbo.TMstMMediaSetVms.XVVmsCode = '$VmsCode')
        ORDER BY dbo.TMstMMediaSetVms.XIID";
        $result=$dbm->QueryDB($sql);
        return $result;
}
function InsertMediaSet($MediaVmsCode,$VmsCode,$Delay){
    $dbm=new DatabaseManage();
    $CountInsert=0;
    foreach ($MediaVmsCode as $value) {
            $Media_VmsCode=$value;
            $sql="INSERT INTO TMstMMediaSetVms (
            XVMediaVmsCode, XVVmsCode, XIDelay)VALUES('$Media_VmsCode','$VmsCode',$Delay)";
            if($dbm->QueryDB($sql)){
                $CountInsert=$CountInsert+1;
            }
    }
    return $CountInsert;
}
function DeleteMediaSet($ID){
    $dbm=new DatabaseManage();
    $CountDelete=0;
    foreach ($ID as $value) {
            $I_D=$value;
            $sql="DELETE TMstMMediaSetVms WHERE XIID=$I_D";
            echo $sql;
            if($dbm->QueryDB($sql)){
                $CountDelete=$CountDelete+1;
            }
    }
    return $CountDelete;
}
function SetMediaDelay($ID,$Delay){
    $dbm=new DatabaseManage();
    $sql="Update TMstMMediaSetVms SET XIDelay=$Delay WHERE XIID=$ID";
    return  $dbm->QueryDB($sql);
} 