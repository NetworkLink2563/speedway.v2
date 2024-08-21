<?php

ob_start();
session_start();
date_default_timezone_set("Asia/Bangkok");
include "lib/MqttSend.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       if(isset($_POST["settimepc"])){
              $vmscode=$_POST["vmscode"];
              echo settimepc($vmscode);
       }
       if(isset($_POST["restartpc"])){
              $vmscode=$_POST["vmscode"];
              echo restartpc($vmscode);
       }
       if(isset($_POST["onoffpc"])){
              $vmscode=$_POST["vmscode"];
              $value=$_POST["value"];
              echo onoffpc($vmscode,$value);
       }
       if(isset($_POST["onofffan"])){
              $vmscode=$_POST["vmscode"];
              $value=$_POST["value"];
              echo onofffan($vmscode,$value);
       }
       if(isset($_POST["onoffpowervms"])){
              $vmscode=$_POST["vmscode"];
              $value=$_POST["value"];
              
              echo onoffpowervms($vmscode,$value);
       }
       if(isset($_POST["OnlineOfflinevms"])){
              $vmscode=$_POST["vmscode"];
              $value=$_POST["value"];
              
              echo OnlineOfflinevms($vmscode,$value);
       }
      
       if(isset($_POST["onoffflashvms"])){
              $vmscode=$_POST["vmscode"];
              $value=$_POST["value"];
              
              echo onoffflashvms($vmscode,$value);
       }
       if(isset($_POST["brightvms"])){
              $vmscode=$_POST["vmscode"];
              $value=$_POST["value"];
              
              echo brightvms($vmscode,$value);
       }
       if(isset($_POST["GetSensorStatus"])){
              $vmscode=$_POST["vmscode"];
              echo GetSensorStatus($vmscode);
       }       
}
function insertLogVMS($VMScode,$user,$XVLctType,$option){
       include "lib/DatabaseManage.php";
       $sqlInsert = "INSERT INTO TLogLVmsAction (XVLctType,XVLctUserCode,XVLctValue1,XVLctValue2,XVLctValue3,XVVmsCode)
       VALUES ('".$XVLctType."','".$user."','COMMAND','".$option."','".$countItem."','".$VMScode."')";
       $stmt= sqlsrv_query($conn, $sqlInsert);
       sqlsrv_close( $conn );
} 
function  onoffpowervms($vmscode,$value){
      
       include "lib/DatabaseManage.php";
       $XVSccValue=$value;
       if($value==1){
          $sms="ส่งคำสั่งเปิดระบบไฟฟ้า";
       }else{
          $sms="ส่งคำสั่งปิดระบบไฟฟ้า";
       }
       $sql = "DECLARE @tCode nvarchar(100)
       EXEC dbo. STP_NWLtGetMaxCode 'TDocTCmdSchedule', @tCode OUTPUT
       PRINT 'TDocTCmdSchedule' + '-->' + @tCode";
           $query = sqlsrv_query($conn, $sql);
           $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
           $runcode = $result['ptCode'];
          
           $sqlInsert = "INSERT INTO TDocTCmdSchedule (XVSccDocNo,XDSccDocDate,XTSccDocTime,XVVmsCode,XVCmdCode,XBSccIsSchedule,XTSccStart,XTSccEnd,XBSccIsDone,XBSccIsActive,XVSccValue,XTSccDocDoneTime,XBSccIsSun,XBSccIsMon,XBSccIsTue,XBSccIsWed,XBSccIsThu,XBSccIsFri,XBSccIsSat,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
       SELECT '".$runcode."','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','".$vmscode."','002',0,NULL,NULL,0,1,$XVSccValue,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
           
           sqlsrv_query($conn, $sqlInsert);
           sqlsrv_close( $conn );

           insertLogVMS($vmscode,$_SESSION['userName'], '002', $sms, $runcode);
           $topic='Center/Service/'.$vmscode;
           $data='{"cmd":"01"}';
           return mqttsend($topic,$data);
           
}
function  OnlineOfflinevms ($vmscode,$value){
       include "lib/DatabaseManage.php";
       $XVSccValue=$value;
       if($value==1){
          $sms="ส่งคำสั่งเปิดระบบไฟฟ้า";
       }else{
          $sms="ส่งคำสั่งปิดระบบไฟฟ้า";
       }
       $sql = "DECLARE @tCode nvarchar(100)
       EXEC dbo. STP_NWLtGetMaxCode 'TDocTCmdSchedule', @tCode OUTPUT
       PRINT 'TDocTCmdSchedule' + '-->' + @tCode";
           $query = sqlsrv_query($conn, $sql);
           $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
           $runcode = $result['ptCode'];
          
           $sqlInsert = "INSERT INTO TDocTCmdSchedule (XVSccDocNo,XDSccDocDate,XTSccDocTime,XVVmsCode,XVCmdCode,XBSccIsSchedule,XTSccStart,XTSccEnd,XBSccIsDone,XBSccIsActive,XVSccValue,XTSccDocDoneTime,XBSccIsSun,XBSccIsMon,XBSccIsTue,XBSccIsWed,XBSccIsThu,XBSccIsFri,XBSccIsSat,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
       SELECT '".$runcode."','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','".$vmscode."','003',0,NULL,NULL,0,1,$XVSccValue,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
           
           sqlsrv_query($conn, $sqlInsert);
           sqlsrv_close( $conn );

           insertLogVMS($vmscode,$_SESSION['userName'], '003', $sms, $runcode);
           $topic='Center/Service/'.$vmscode;
           $data='{"cmd":"01"}';
           return mqttsend($topic,$data);
}
function  onoffflashvms($vmscode,$value){
      
       include "lib/DatabaseManage.php";
       $XVSccValue=$value;
       if($value==1){
          $sms="ส่งคำสั่งเปิดระบบไฟกระพริบ";
       }else{
          $sms="ส่งคำสั่งปิดระบบไฟกระพริบ";
       }
       $sql = "DECLARE @tCode nvarchar(100)
       EXEC dbo. STP_NWLtGetMaxCode 'TDocTCmdSchedule', @tCode OUTPUT
       PRINT 'TDocTCmdSchedule' + '-->' + @tCode";
       $query = sqlsrv_query($conn, $sql);
       $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
       $runcode = $result['ptCode'];
       $query = sqlsrv_query($conn, $sql);
       $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
       $runcode = $result['ptCode'];
       $XVSccValue=1;
       $sqlInsert = "INSERT INTO TDocTCmdSchedule (XVSccDocNo,XDSccDocDate,XTSccDocTime,XVVmsCode,XVCmdCode,XBSccIsSchedule,XTSccStart,XTSccEnd,XBSccIsDone,XBSccIsActive,XVSccValue,XTSccDocDoneTime,XBSccIsSun,XBSccIsMon,XBSccIsTue,XBSccIsWed,XBSccIsThu,XBSccIsFri,XBSccIsSat,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
       SELECT '".$runcode."','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','".$vmscode."','004',0,NULL,NULL,0,1,$XVSccValue,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
       $queryUpdate = sqlsrv_query($conn, $sqlInsert);
       sqlsrv_close( $conn );
       insertLogVMS($vmscode,$_SESSION['userName'],'004', $sms,$runcode);
       $topic='Center/Service/'.$vmscode;
       $data='{"cmd":"01"}';
       return mqttsend($topic,$data);
           
}
function brightvms($vmscode,$value){
      
       include "lib/DatabaseManage.php";
     

       $sql = "DECLARE @tCode nvarchar(100)
  EXEC dbo. STP_NWLtGetMaxCode 'TDocTCmdSchedule', @tCode OUTPUT
  PRINT 'TDocTCmdSchedule' + '-->' + @tCode";
      $query = sqlsrv_query($conn, $sql);
      $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
      $runcode = $result['ptCode'];
      
      $sqlInsert = "INSERT INTO TDocTCmdSchedule (XVSccDocNo,XDSccDocDate,XTSccDocTime,XVVmsCode,XVCmdCode,XBSccIsSchedule,XTSccStart,XTSccEnd,XBSccIsDone,XBSccIsActive,XVSccValue,XTSccDocDoneTime,XBSccIsSun,XBSccIsMon,XBSccIsTue,XBSccIsWed,XBSccIsThu,XBSccIsFri,XBSccIsSat,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
  SELECT '".$runcode."','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','".$vmscode."','001',0,NULL,NULL,0,1, $value,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
   
   
      sqlsrv_query($conn, $sqlInsert);
      sqlsrv_close( $conn );
      insertLogVMS($vmscode,$_SESSION['userName'],'001',$sms,$runcode);
      $topic='Center/Service/'.$vmscode;
      $data='{"cmd":"01"}';
      return mqttsend($topic,$data);
}
function settimepc($vmscode){
        insertLogVMS($vmscode,$_SESSION['userName'],'005','ส่งคำสั่ง ปรับปรุงเวลาเครื่องคอมพิวเตอร์ควบคุมป้าย');
        $topic=$vmscode.'_Display';
        $datetime=date("Y-m-d H:i:s");
        $data='{"cmd":"02","DateTime":"'.$datetime.'"}';
        return mqttsend($topic,$data);
}     
function restartpc($vmscode){
       insertLogVMS($vmscode,$_SESSION['userName'],'006','ส่งคำสั่ง รีสตาร์ทเครื่องคอมพิวเตอร์ควบคุมป้าย');
       $topic=$vmscode.'_Display';
       $datetime=date("Y-m-d H:i:s");
       $data='{"cmd":"03"}';
       return mqttsend($topic,$data);
}
function onoffpc($vmscode,$value){
       if($value==0){
              $sms="ส่งคำสั่ง ปืดเครื่องคอมพิวเตอร์ควบคุมป้าย";
       }else{
              $sms="ส่งคำสั่ง เปิดเครื่องคอมพิวเตอร์ควบคุมป้าย";
       }
       insertLogVMS($vmscode,$_SESSION['userName'],'007',$sms);
       $topic=$vmscode.'_Control';
       $data='{"cmd":1,"Relay1":'.$value.'}';
       return mqttsend($topic,$data);
}
function onofffan($vmscode,$value){
       if($value==0){
              $sms="ส่งคำสั่ง ปิดพัดลมตู้ควบคุม";
       }else{
              $sms="ส่งคำสั่ง เปิดพัดลมตู้ควบคุม";
       }
       insertLogVMS($vmscode,$_SESSION['userName'],'008',$sms);
       $topic=$vmscode.'_Control';
       $data='{"cmd":2,"Relay2":'.$value.'}';
       return mqttsend($topic,$data);
}
function GetSensorStatus($vmscode){
       include "lib/DatabaseManage.php";
       $ST1=0;
       $ST2=0;
       $ST3=0;
       $ST4=0;
       $ST5=0;
       $ST6=0;
       $ST7=0;
       $ST8=0;
       $ST9=0;
       $sql = "SELECT XVVmsCode, XISensorType, XIValue
               FROM dbo.TMstMItmVMS_Status
               WHERE (XVVmsCode = '$vmscode')
              ORDER BY XISensorType";
     
       $query =sqlsrv_query($conn, $sql);
       while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
       {
          $XISensorType=$result['XISensorType'];
          if($XISensorType==1){
              $ST1=$result['XIValue'];
          }elseif($XISensorType==2){
              $ST2=$result['XIValue'];
          }elseif($XISensorType==3){
              $ST3=$result['XIValue'];
          }elseif($XISensorType==4){
              $ST4=$result['XIValue'];
          }elseif($XISensorType==5){
              $ST5=$result['XIValue'];
          }elseif($XISensorType==6){
              $ST6=$result['XIValue'];
          }elseif($XISensorType==7){
              $ST7=$result['XIValue'];
          }elseif($XISensorType==8){   
              $ST8=$result['XIValue'];
          }elseif($XISensorType==9){   
              $ST9=$result['XIValue'];
          }
       }  
       $data='{';
            $data.='"ST1":'.$ST1.',';
            $data.='"ST2":'.$ST2.',';
            $data.='"ST3":'.$ST3.',';
            $data.='"ST4":'.$ST4.',';
            $data.='"ST5":'.$ST5.',';
            $data.='"ST6":'.$ST6.',';
            $data.='"ST7":'.$ST7.',';
            $data.='"ST8":'.$ST8.',';
            $data.='"ST9":'.$ST9.'';
       $data.='}';
       sqlsrv_close( $conn );
       return   $data; 
}

?>

