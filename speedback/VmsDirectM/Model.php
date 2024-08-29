<?php

function RunID(){
    $dbm=new DatabaseManage();
    $sql="select  max(XVMediaVmsCode) as XVMediaVmsCode   from TMstMMediaVms";
    $result=$dbm->QueryDB($sql);  
    $JsonObj = json_decode($result);
    $XVMediaVmsCode='';
    foreach ($JsonObj as $result){
        $XVMediaVmsCode =$result->XVMediaVmsCode;               
    }
    if($XVMediaVmsCode==''){
        return 'MDV'.date("y")."-00001";
    }else{
        $DocNo=explode("-",$XVMediaVmsCode);
        $RunDocNum=intval($DocNo[1])+1;
        $XVCamCode=sprintf("%05d", $RunDocNum);
        return 'MDV'.date("y")."-".$XVCamCode; 
    }   
}

function Search($MediaVmsCode)
{  
       
       $dbm=new DatabaseManage();
        
        $sql="SELECT [XVMediaVmsCode]
            ,[XVPrjCode]
            ,[XVMediaName]
            ,[XVFileName]
            ,[XVSms]
            ,[XVMediaType]
            FROM [NWL_VMSControl].[dbo].[TMstMMediaVms] WHERE XVMediaVmsCode='$MediaVmsCode'";
      
    
        
        $result=$dbm->QueryDB($sql);
        return $result;
} 

function ShowBodyTable($PrjCode){
    $Permis=Permission('MNU22-00006');
    $CstCode=$_SESSION["CstCode"];
    $UsrCode=$_SESSION["UsrCode"];
    $dbm=new DatabaseManage();
    
       
    $sql="SELECT  XVMediaVmsCode, XVPrjCode, XVMediaName, XVSms, XVFileName, XVMediaType
    FROM   dbo.TMstMMediaVms
    WHERE (XVPrjCode = '$PrjCode')
    ORDER BY XVMediaVmsCode DESC" ;
        
       
   
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $data="[";
    foreach ($JsonObj as $result){ 
        $para="'".$result->XVMediaVmsCode."',"."'".$result->XVMediaType."'";
        $CamIsActive='ยกเลิก';
        if($result->XBCamIsActive==1){
            $CamIsActive='ใช้งาน';
        }
       
          $D='<i  style=\"cursor: pointer;\" class=\"fa-solid fa-trash\" aria-hidden=\"true\" title=\"ลบ\" onclick=\"FuDelete('.$para.')\"></i>';
       
        $E='<i style=\"cursor: pointer;\" class=\"fa-solid fa-pen-to-square\" aria-hidden=\"true\" title=\"แก้ไข\" onclick=\"FuEdit('.$para.')\"></i>';
       
        $Type="";
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
        if($result->XVMediaType==5){
            $Type="เส้นทางแผนที่";
        }
            $data.='
            {
                "A":"'.$result->XVMediaVmsCode.'",
                "B":"'.$result->XVMediaName.'",
                "C":"'.$Type.'",
                "D":"'. $D.'",
                "E":"'. $E.'"
            },';
          
    }
    $data=substr($data,0,strlen($data)-1)."]";
    return $data;
}
function  Delete($MediaVmsCode,$Type){
    $dbm=new DatabaseManage();
    $sql="SELECT [XVMediaVmsCode]
            ,[XVPrjCode]
            ,[XVMediaName]
            ,[XVFileName]
            ,[XVSms]
            ,[XVMediaType]
            FROM [NWL_VMSControl].[dbo].[TMstMMediaVms] WHERE XVMediaVmsCode='$MediaVmsCode'";
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $XVPrjCode="";
    $XVFileName="";    
    $XVMediaType=0;
    foreach ($JsonObj as $result){     
        $XVPrjCode=$result->XVPrjCode;
        $XVFileName=$result->XVFileName;
        $XVMediaType=$result->XVMediaType;
    }

    $sql="DELETE FROM TMstMMediaVms  WHERE XVMediaVmsCode='$MediaVmsCode'";
    $result=$dbm->QueryDB($sql);
    if($result){
    if($XVMediaType==2){
        $filepath=$XVPrjCode."\\".$XVFileName;
      
        unlink($filepath);
    }
    }else{
        echo "Err1";
    } 
}


function  InserUpdateSms($PrjCode,$MediaVmsCode,$Mode,$Type,$Sms,$MediaName){
  $dbm=new DatabaseManage();
  
   if($Mode==0){
        $MediaVmsCode=RunID();
        $sql="INSERT INTO  [TMstMMediaVms] (
             [XVMediaVmsCode],
             [XVPrjCode],
             [XVMediaName],
             [XVSms],
             [XVMediaType] ) VALUES (
             '$MediaVmsCode',
             '$PrjCode',
             '$MediaName',
             '$Sms',
              $Type 
            )";
        $result=$dbm->QueryDB($sql);
        if($result){
          
        }else{
           echo "Err1";
        }                 
   }else{
      if($Mode==1){
            $sql="UPDATE  [TMstMMediaVms] SET
                [XVMediaName]='$MediaName',
                [XVSms]='$Sms'
                WHERE [XVMediaVmsCode]='$MediaVmsCode'
            ";
     
        $result=$dbm->QueryDB($sql);
        if($result){
            
        }else{
            echo "Err1";
        }                 
      }
   }
}

function UploadPicture($PrjCode,$MediaVmsCode,$MediaName){
    $dbm=new DatabaseManage();
    $UsrCode=$_SESSION["UsrCode"]; 
    if(!is_dir($PrjCode)) {
        mkdir($PrjCode); 
    }
   
    $filename = $_FILES['file']['name'];
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $filename=date("YmdHis").".".$extension;;
    $location = $PrjCode."/".$filename;
 
    if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){
        $MediaVmsCode=RunID();
        $sql="INSERT INTO  [TMstMMediaVms] (
            [XVMediaVmsCode],
            [XVPrjCode],
            [XVMediaName],
            [XVFileName],
            [XVMediaType] ) VALUES (
            '$MediaVmsCode',
            '$PrjCode',
            '$MediaName',
            '$filename',
             2 
           )";
      
        $result=$dbm->QueryDB($sql);
        if($result){
        }else{
          echo "Err1";
        } 
    }else{
      
		echo "Err2";
	}
    
}
function UploadVdo($PrjCode,$MediaVmsCode,$MediaName){
    $dbm=new DatabaseManage();
    $UsrCode=$_SESSION["UsrCode"]; 
    if(!is_dir($PrjCode)) {
        mkdir($PrjCode); 
    }
   
    $filename = $_FILES['file']['name'];
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $filename=date("YmdHis").".".$extension;;
    $location = $PrjCode."/".$filename;
 
    if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){
        $MediaVmsCode=RunID();
        $sql="INSERT INTO  [TMstMMediaVms] (
            [XVMediaVmsCode],
            [XVPrjCode],
            [XVMediaName],
            [XVFileName],
            [XVMediaType] ) VALUES (
            '$MediaVmsCode',
            '$PrjCode',
            '$MediaName',
            '$filename',
             3 
           )";
      
        $result=$dbm->QueryDB($sql);
        if($result){
        }else{
          echo "Err1";
        } 
    }else{
      
		echo "Err2";
	}
    
}

function UploadTemplate($PrjCode,$MediaVmsCode,$MediaName){
    $dbm=new DatabaseManage();
    $UsrCode=$_SESSION["UsrCode"]; 
    if(!is_dir($PrjCode)) {
        mkdir($PrjCode); 
    }
   
    $filename = $_FILES['file']['name'];
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $filename=date("YmdHis").".".$extension;;
    $location = $PrjCode."/".$filename;
 
    if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){
        $MediaVmsCode=RunID();
        $sql="INSERT INTO  [TMstMMediaVms] (
            [XVMediaVmsCode],
            [XVPrjCode],
            [XVMediaName],
            [XVFileName],
            [XVMediaType] ) VALUES (
            '$MediaVmsCode',
            '$PrjCode',
            '$MediaName',
            '$filename',
             4 
           )";
      
        $result=$dbm->QueryDB($sql);
        if($result){
        }else{
          echo "Err1";
        } 
    }else{
      
		echo "Err2";
	}
    
}

function UploadTemplateMap($PrjCode,$MediaVmsCode,$MediaName){
    $dbm=new DatabaseManage();
    $UsrCode=$_SESSION["UsrCode"]; 
    if(!is_dir($PrjCode)) {
        mkdir($PrjCode); 
    }
   
    $filename = $_FILES['file']['name'];
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $filename=date("YmdHis").".".$extension;;
    $location = $PrjCode."/".$filename;
 
    if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){
        $MediaVmsCode=RunID();
        $sql="INSERT INTO  [TMstMMediaVms] (
            [XVMediaVmsCode],
            [XVPrjCode],
            [XVMediaName],
            [XVFileName],
            [XVMediaType] ) VALUES (
            '$MediaVmsCode',
            '$PrjCode',
            '$MediaName',
            '$filename',
             5 
           )";
      
        $result=$dbm->QueryDB($sql);
        if($result){
        }else{
          echo "Err1";
        } 
    }else{
      
		echo "Err2";
	}
    
}
?>