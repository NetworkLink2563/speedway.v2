<?php
ob_start();
session_start();


include "DatabaseManage.php";
include "MqttSend.php";
$vmscode=$_POST["vmscode"];
$value=$_POST["value"];
$option=$_POST["option"];
$datenow=date('Y-m-d H:i:s');
if(isset($_POST["valueBrightness"])){
    $valueBrightness=$_POST["valueBrightness"];
}



function insertLogVMS($VMScode,$user,$XVLctType,$option,$docid){
    include "DatabaseManage.php";
    
    $countItem="";
    $countItem=0;
    $sqlInsert = "INSERT INTO TLogLVmsAction (XVLctType,XVLctUserCode,XVLctValue1,XVLctValue2,XVLctValue3,XVVmsCode,XVSccDocNo)
     VALUES
           ('".$XVLctType."','".$user."','COMMAND','".$option."','".$countItem."','".$VMScode."','".$docid."')";

    $stmt= sqlsrv_query($conn, $sqlInsert);
      
}
if ($option==2){
    /*
    $sql = "DECLARE @tCode nvarchar(100)
    EXEC dbo. STP_NWLtGetMaxCode 'TDocTCmdSchedule', @tCode OUTPUT
    PRINT 'TDocTCmdSchedule' + '-->' + @tCode";
        $query = sqlsrv_query($conn, $sql);
        $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
        $runcode = $result['ptCode'];
        $XVSccValue=1;
        $sqlInsert = "INSERT INTO TDocTCmdSchedule (XVSccDocNo,XDSccDocDate,XTSccDocTime,XVVmsCode,XVCmdCode,XBSccIsSchedule,XTSccStart,XTSccEnd,XBSccIsDone,XBSccIsActive,XVSccValue,XTSccDocDoneTime,XBSccIsSun,XBSccIsMon,XBSccIsTue,XBSccIsWed,XBSccIsThu,XBSccIsFri,XBSccIsSat,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
    SELECT '".$runcode."','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','".$vmscode."','005',0,NULL,NULL,0,1,$XVSccValue,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
       
        $queryUpdate = sqlsrv_query($conn, $sqlInsert);
        insertLogVMS($vmscode,$_SESSION['userName'],'005','ส่งคำสั่งRestart เครื่องควบคุมป้าย: 1',$runcode);
        $topic='Center/Service/'.$vmscode;

        $data='{"cmd":"01"}';
        echo mqttsend($topic,$data);
        */
        $topic=$vmscode.'_Display';
        $datetime=date("Y-m-d H:i:s");
        $data='{"cmd":"02","DateTime":"'.$datetime.'"}';
        echo mqttsend($topic,$data);
}
if ($option==3){
    /*
    $sql = "DECLARE @tCode nvarchar(100)
    EXEC dbo. STP_NWLtGetMaxCode 'TDocTCmdSchedule', @tCode OUTPUT
    PRINT 'TDocTCmdSchedule' + '-->' + @tCode";
        $query = sqlsrv_query($conn, $sql);
        $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
        $runcode = $result['ptCode'];
        $XVSccValue=1;
        $sqlInsert = "INSERT INTO TDocTCmdSchedule (XVSccDocNo,XDSccDocDate,XTSccDocTime,XVVmsCode,XVCmdCode,XBSccIsSchedule,XTSccStart,XTSccEnd,XBSccIsDone,XBSccIsActive,XVSccValue,XTSccDocDoneTime,XBSccIsSun,XBSccIsMon,XBSccIsTue,XBSccIsWed,XBSccIsThu,XBSccIsFri,XBSccIsSat,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
    SELECT '".$runcode."','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','".$vmscode."','006',0,NULL,NULL,0,1,$XVSccValue,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
       
        $queryUpdate = sqlsrv_query($conn, $sqlInsert);
        insertLogVMS($vmscode,$_SESSION['userName'],'006','ส่งคำสั่งRestart เครื่องควบคุมป้าย: 1',$runcode);
        $topic='Center/Service/'.$vmscode;
       
        VMS2403-0005_Display = {"cmd":"01"}
        */
        $topic=$vmscode.'_Display';
        $datetime=date("Y-m-d H:i:s");
        $data='{"cmd":"03"}';
        echo mqttsend($topic,$data);
        
}
if ($option==5){
   
     
    $sql = "DECLARE @tCode nvarchar(100)
    EXEC dbo. STP_NWLtGetMaxCode 'TDocTCmdSchedule', @tCode OUTPUT
    PRINT 'TDocTCmdSchedule' + '-->' + @tCode";
        $query = sqlsrv_query($conn, $sql);
        $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
        $runcode = $result['ptCode'];
        $XVSccValue=1;
       
        $sqlInsert = "INSERT INTO TDocTCmdSchedule (XVSccDocNo,XDSccDocDate,XTSccDocTime,XVVmsCode,XVCmdCode,XBSccIsSchedule,XTSccStart,XTSccEnd,XBSccIsDone,XBSccIsActive,XVSccValue,XTSccDocDoneTime,XBSccIsSun,XBSccIsMon,XBSccIsTue,XBSccIsWed,XBSccIsThu,XBSccIsFri,XBSccIsSat,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
    SELECT '".$runcode."','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','".$vmscode."','002',0,NULL,NULL,0,1,$XVSccValue,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
        $queryUpdate = sqlsrv_query($conn, $sqlInsert);

        insertLogVMS($vmscode,$_SESSION['userName'],'002','ส่งคำสั่งเปิดระบบไฟฟ้า: 1',$runcode);
        $topic='Center/Service/'.$vmscode;
        $data='{"cmd":"01"}';
        echo mqttsend($topic,$data);
        /*
        $topic='SPEEDWAY/DOWNLINKRPI/'.$vmscode;
        //$data='{"cmd":"01"}';
        $data='{"CMD":7,"POWERONOFF":1}';
        $ret=mqttsend($topic,$data);
        if($ret=="Success"){
            $sql = "update TMstMItmVMS_Status set XBVmsIsOn=1  
            WHERE        (XVVmsCode = '$vmscode') AND (XISensorType = 1)";
          
            sqlsrv_query($conn, $sql);
        }
        echo $ret;
         */
}
if($option==6){
    
    $sql = "DECLARE @tCode nvarchar(100)
EXEC dbo. STP_NWLtGetMaxCode 'TDocTCmdSchedule', @tCode OUTPUT
PRINT 'TDocTCmdSchedule' + '-->' + @tCode";
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $runcode = $result['ptCode'];
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $runcode = $result['ptCode'];
    $XVSccValue=0;
    
    $sqlInsert = "INSERT INTO TDocTCmdSchedule (XVSccDocNo,XDSccDocDate,XTSccDocTime,XVVmsCode,XVCmdCode,XBSccIsSchedule,XTSccStart,XTSccEnd,XBSccIsDone,XBSccIsActive,XVSccValue,XTSccDocDoneTime,XBSccIsSun,XBSccIsMon,XBSccIsTue,XBSccIsWed,XBSccIsThu,XBSccIsFri,XBSccIsSat,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$runcode."','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','".$vmscode."','002',0,NULL,NULL,0,1,$XVSccValue,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
    $queryUpdate = sqlsrv_query($conn, $sqlInsert);
    
    insertLogVMS($vmscode,$_SESSION['userName'],'002','ส่งคำสั่งเปิดระบบไฟฟ้า: 1',$runcode);
    $topic='Center/Service/'.$vmscode;
    $data='{"cmd":"01"}';
    echo mqttsend($topic,$data);
    /*
    $topic='SPEEDWAY/DOWNLINKRPI/'.$vmscode;
    $data='{"CMD":7,"POWERONOFF":0}';
    $ret=mqttsend($topic,$data);
    if($ret=="Success"){
        $sql = "update TMstMItmVMS_Status set XBVmsIsOn=0 
        WHERE        (XVVmsCode = '$vmscode') AND (XISensorType = 1)";
        
        sqlsrv_query($conn, $sql);
    }
    echo $ret;
    */
}
if ($option==7){
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
SELECT '".$runcode."','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','".$vmscode."','003',0,NULL,NULL,0,1, $XVSccValue,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
    $queryUpdate = sqlsrv_query($conn, $sqlInsert);
    insertLogVMS($vmscode,$_SESSION['userName'],'003','การแสดงผล Online: 1',$runcode);
    $topic='Center/Service/'.$vmscode;
    $data='{"cmd":"01"}';
    echo mqttsend($topic,$data);
   
}

if ($option==8){
    $sql = "DECLARE @tCode nvarchar(100)
EXEC dbo. STP_NWLtGetMaxCode 'TDocTCmdSchedule', @tCode OUTPUT
PRINT 'TDocTCmdSchedule' + '-->' + @tCode";
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $runcode = $result['ptCode'];
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $runcode = $result['ptCode'];
    $XVSccValue=0;
    $sqlInsert = "INSERT INTO TDocTCmdSchedule (XVSccDocNo,XDSccDocDate,XTSccDocTime,XVVmsCode,XVCmdCode,XBSccIsSchedule,XTSccStart,XTSccEnd,XBSccIsDone,XBSccIsActive,XVSccValue,XTSccDocDoneTime,XBSccIsSun,XBSccIsMon,XBSccIsTue,XBSccIsWed,XBSccIsThu,XBSccIsFri,XBSccIsSat,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$runcode."','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','".$vmscode."','003',0,NULL,NULL,0,1,$XVSccValue,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
    $queryUpdate = sqlsrv_query($conn, $sqlInsert);
    insertLogVMS($vmscode,$_SESSION['userName'],'003','การแสดงผล Offline: 0',$runcode);
    $topic='Center/Service/'.$vmscode;
    $data='{"cmd":"01"}';
    echo mqttsend($topic,$data);
   
}


if ($option==9){
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
    insertLogVMS($vmscode,$_SESSION['userName'],'004','การไฟกระพริบ เปิด: 1',$runcode);
    $topic='Center/Service/'.$vmscode;
    $data='{"cmd":"01"}';
    echo mqttsend($topic,$data);
   
}
if ($option==10){
    $sql = "DECLARE @tCode nvarchar(100)
EXEC dbo. STP_NWLtGetMaxCode 'TDocTCmdSchedule', @tCode OUTPUT
PRINT 'TDocTCmdSchedule' + '-->' + @tCode";
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $runcode = $result['ptCode'];
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $runcode = $result['ptCode'];
    $XVSccValue=0;
    $sqlInsert = "INSERT INTO TDocTCmdSchedule (XVSccDocNo,XDSccDocDate,XTSccDocTime,XVVmsCode,XVCmdCode,XBSccIsSchedule,XTSccStart,XTSccEnd,XBSccIsDone,XBSccIsActive,XVSccValue,XTSccDocDoneTime,XBSccIsSun,XBSccIsMon,XBSccIsTue,XBSccIsWed,XBSccIsThu,XBSccIsFri,XBSccIsSat,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$runcode."','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','".$vmscode."','004',0,NULL,NULL,0,1,$XVSccValue,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
    $queryUpdate = sqlsrv_query($conn, $sqlInsert);
    insertLogVMS($vmscode,$_SESSION['userName'],'004','การไฟกระพริบ ปิด: 0',$runcode);
    $topic='Center/Service/'.$vmscode;
    $data='{"cmd":"01"}';
    echo mqttsend($topic,$data);
   
}
if ($option>=11&&$option<=21){
    
    $XVSccValue=$valueBrightness;
    $level="ส่งคำสั่งความสว่างอัตโนมัติ";
    if($option==11){
        $level="ส่งคำสั่งความสว่างอัตโนมัติ";
    }else if($option==12){
        $level="ส่งคำสั่งความระดับ1";
    }else if($option==13){
        $level="ส่งคำสั่งความระดับ2";
    }else if($option==14){
        $level="ส่งคำสั่งความระดับ3";
    }else if($option==15){
        $level="ส่งคำสั่งความระดับ4";
    }else if($option==16){
        $level="ส่งคำสั่งความระดับ5";
    }else if($option==17){
        $level="ส่งคำสั่งความระดับ6";
    }else if($option==18){
        $level="ส่งคำสั่งความระดับ7";
    }else if($option==19){
        $level="ส่งคำสั่งความระดับ8";
    }else if($option==20){
        $level="ส่งคำสั่งความระดับ9";
    }else if($option==21){
        $level="ส่งคำสั่งความระดับ10";
    }
    $sql = "DECLARE @tCode nvarchar(100)
  EXEC dbo. STP_NWLtGetMaxCode 'TDocTCmdSchedule', @tCode OUTPUT
  PRINT 'TDocTCmdSchedule' + '-->' + @tCode";
      $query = sqlsrv_query($conn, $sql);
      $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
      $runcode = $result['ptCode'];
   
      $sqlInsert = "INSERT INTO TDocTCmdSchedule (XVSccDocNo,XDSccDocDate,XTSccDocTime,XVVmsCode,XVCmdCode,XBSccIsSchedule,XTSccStart,XTSccEnd,XBSccIsDone,XBSccIsActive,XVSccValue,XTSccDocDoneTime,XBSccIsSun,XBSccIsMon,XBSccIsTue,XBSccIsWed,XBSccIsThu,XBSccIsFri,XBSccIsSat,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
  SELECT '".$runcode."','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','".$vmscode."','001',0,NULL,NULL,0,1,$XVSccValue,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
   
     
      sqlsrv_query($conn, $sqlInsert);
      insertLogVMS($vmscode,$_SESSION['userName'],'001',$level,$runcode);
      $topic='Center/Service/'.$vmscode;
      $data='{"cmd":"01"}';
      echo mqttsend($topic,$data);
      
}

/*
if ($option==2){
    $sql = "DECLARE @tCode nvarchar(100)
EXEC dbo. STP_NWLtGetMaxCode 'TDocTCmdSchedule', @tCode OUTPUT
PRINT 'TDocTCmdSchedule' + '-->' + @tCode";
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $runcode = $result['ptCode'];

    $sqlInsert = "INSERT INTO TDocTCmdSchedule (XVSccDocNo,XDSccDocDate,XTSccDocTime,XVVmsCode,XVCmdCode,XBSccIsSchedule,XTSccStart,XTSccEnd,XBSccIsDone,XBSccIsActive,XVSccValue,XTSccDocDoneTime,XBSccIsSun,XBSccIsMon,XBSccIsTue,XBSccIsWed,XBSccIsThu,XBSccIsFri,XBSccIsSat,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$runcode."','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','".$vmscode."','005',0,NULL,NULL,1,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
    $queryUpdate = sqlsrv_query($conn, $sqlInsert);

 
    insertLogVMS($vmscode,$_SESSION['userName'],'SETTIME','ส่งคำสั่งปรับเวลาป้าย');
    echo 'ส่งคำสั่ง ปรับเวลาจากศูนย์ควบคุม';
}

if ($option==3){
    $sql = "DECLARE @tCode nvarchar(100)
EXEC dbo. STP_NWLtGetMaxCode 'TDocTCmdSchedule', @tCode OUTPUT
PRINT 'TDocTCmdSchedule' + '-->' + @tCode";
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $runcode = $result['ptCode'];

    $sqlInsert = "INSERT INTO TDocTCmdSchedule (XVSccDocNo,XDSccDocDate,XTSccDocTime,XVVmsCode,XVCmdCode,XBSccIsSchedule,XTSccStart,XTSccEnd,XBSccIsDone,XBSccIsActive,XVSccValue,XTSccDocDoneTime,XBSccIsSun,XBSccIsMon,XBSccIsTue,XBSccIsWed,XBSccIsThu,XBSccIsFri,XBSccIsSat,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$runcode."','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','".$vmscode."','006',0,NULL,NULL,1,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
    $queryUpdate = sqlsrv_query($conn, $sqlInsert);

   
    insertLogVMS($vmscode,$_SESSION['userName'],'RESTART','ส่งคำสั่งรีเซ็ตป้าย VMS');
    echo 'Restart ป้าย VMS สำเร็จ';
}

if ($option==5){
    $sql = "DECLARE @tCode nvarchar(100)
EXEC dbo. STP_NWLtGetMaxCode 'TDocTCmdSchedule', @tCode OUTPUT
PRINT 'TDocTCmdSchedule' + '-->' + @tCode";
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $runcode = $result['ptCode'];

    $sqlInsert = "INSERT INTO TDocTCmdSchedule (XVSccDocNo,XDSccDocDate,XTSccDocTime,XVVmsCode,XVCmdCode,XBSccIsSchedule,XTSccStart,XTSccEnd,XBSccIsDone,XBSccIsActive,XVSccValue,XTSccDocDoneTime,XBSccIsSun,XBSccIsMon,XBSccIsTue,XBSccIsWed,XBSccIsThu,XBSccIsFri,XBSccIsSat,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$runcode."','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','".$vmscode."','002',0,NULL,NULL,0,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
    echo  $sqlInsert;
    $queryUpdate = sqlsrv_query($conn, $sqlInsert);

 
    insertLogVMS($vmscode,$_SESSION['userName'],'POWERONOFF','ส่งคำสั่งเปิดระบบไฟฟ้า: '.$return,$runcode);
    echo "เปิดไฟป้าย";

}

if($option==6){
    $sql = "DECLARE @tCode nvarchar(100)
EXEC dbo. STP_NWLtGetMaxCode 'TDocTCmdSchedule', @tCode OUTPUT
PRINT 'TDocTCmdSchedule' + '-->' + @tCode";
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $runcode = $result['ptCode'];
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $runcode = $result['ptCode'];

    $sqlInsert = "INSERT INTO TDocTCmdSchedule (XVSccDocNo,XDSccDocDate,XTSccDocTime,XVVmsCode,XVCmdCode,XBSccIsSchedule,XTSccStart,XTSccEnd,XBSccIsDone,XBSccIsActive,XVSccValue,XTSccDocDoneTime,XBSccIsSun,XBSccIsMon,XBSccIsTue,XBSccIsWed,XBSccIsThu,XBSccIsFri,XBSccIsSat,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$runcode."','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','".$vmscode."','002',0,NULL,NULL,0,1,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
    $queryUpdate = sqlsrv_query($conn, $sqlInsert);
    
    insertLogVMS($vmscode,$_SESSION['userName'],'POWERONOFF','ส่งคำสั่งปิดระบบไฟฟ้า: '.$return,$runcode);
    echo "ปิดไฟป้าย";
}


if ($option==7){
    $sql = "DECLARE @tCode nvarchar(100)
EXEC dbo. STP_NWLtGetMaxCode 'TDocTCmdSchedule', @tCode OUTPUT
PRINT 'TDocTCmdSchedule' + '-->' + @tCode";
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $runcode = $result['ptCode'];
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $runcode = $result['ptCode'];

    $sqlInsert = "INSERT INTO TDocTCmdSchedule (XVSccDocNo,XDSccDocDate,XTSccDocTime,XVVmsCode,XVCmdCode,XBSccIsSchedule,XTSccStart,XTSccEnd,XBSccIsDone,XBSccIsActive,XVSccValue,XTSccDocDoneTime,XBSccIsSun,XBSccIsMon,XBSccIsTue,XBSccIsWed,XBSccIsThu,XBSccIsFri,XBSccIsSat,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$runcode."','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','".$vmscode."','003',0,NULL,NULL,0,1,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
    $queryUpdate = sqlsrv_query($conn, $sqlInsert);
  
    insertLogVMS($vmscode,$_SESSION['userName'],'POWERONOFF','การแสดงผล Online: '.$return,$runcode);
    echo "การแสดงผล Online";
}

if ($option==8){
    $sql = "DECLARE @tCode nvarchar(100)
EXEC dbo. STP_NWLtGetMaxCode 'TDocTCmdSchedule', @tCode OUTPUT
PRINT 'TDocTCmdSchedule' + '-->' + @tCode";
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $runcode = $result['ptCode'];
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $runcode = $result['ptCode'];

    $sqlInsert = "INSERT INTO TDocTCmdSchedule (XVSccDocNo,XDSccDocDate,XTSccDocTime,XVVmsCode,XVCmdCode,XBSccIsSchedule,XTSccStart,XTSccEnd,XBSccIsDone,XBSccIsActive,XVSccValue,XTSccDocDoneTime,XBSccIsSun,XBSccIsMon,XBSccIsTue,XBSccIsWed,XBSccIsThu,XBSccIsFri,XBSccIsSat,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$runcode."','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','".$vmscode."','003',0,NULL,NULL,0,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
    $queryUpdate = sqlsrv_query($conn, $sqlInsert);
  
    insertLogVMS($vmscode,$_SESSION['userName'],'POWERONOFF','การแสดงผล Offline: '.$return,$runcode);
    echo "การแสดงผล Offline";
}




if ($option==11){
    $sql = "DECLARE @tCode nvarchar(100)
  EXEC dbo. STP_NWLtGetMaxCode 'TDocTCmdSchedule', @tCode OUTPUT
  PRINT 'TDocTCmdSchedule' + '-->' + @tCode";
      $query = sqlsrv_query($conn, $sql);
      $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
      $runcode = $result['ptCode'];

      $sqlInsert = "INSERT INTO TDocTCmdSchedule (XVSccDocNo,XDSccDocDate,XTSccDocTime,XVVmsCode,XVCmdCode,XBSccIsSchedule,XTSccStart,XTSccEnd,XBSccIsDone,XBSccIsActive,XVSccValue,XTSccDocDoneTime,XBSccIsSun,XBSccIsMon,XBSccIsTue,XBSccIsWed,XBSccIsThu,XBSccIsFri,XBSccIsSat,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
  SELECT '".$runcode."','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','".$vmscode."','001',0,NULL,NULL,0,1,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
      $queryUpdate = sqlsrv_query($conn, $sqlInsert);
     
      insertLogVMS($vmscode,$_SESSION['userName'],'BRIGHT','ส่งคำสั่งความสว่างอัตโนมัติ: '.$return,$runcode);
      echo "ความสว่างอัตโนมัติ: ".$return;
}
if($option==12){
    $sql = "DECLARE @tCode nvarchar(100)
EXEC dbo. STP_NWLtGetMaxCode 'TDocTCmdSchedule', @tCode OUTPUT
PRINT 'TDocTCmdSchedule' + '-->' + @tCode";
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $runcode = $result['ptCode'];

    $sqlInsert = "INSERT INTO TDocTCmdSchedule (XVSccDocNo,XDSccDocDate,XTSccDocTime,XVVmsCode,XVCmdCode,XBSccIsSchedule,XTSccStart,XTSccEnd,XBSccIsDone,XBSccIsActive,XVSccValue,XTSccDocDoneTime,XBSccIsSun,XBSccIsMon,XBSccIsTue,XBSccIsWed,XBSccIsThu,XBSccIsFri,XBSccIsSat,XVWhoCreate,XVWhoEdit,XTWhenCreate,XTWhenEdit)
SELECT '".$runcode."','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','".$vmscode."','001',0,NULL,NULL,0,1,'".$valueBrightness."',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'".$_SESSION['userName']."',NULL,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'";
    $queryUpdate = sqlsrv_query($conn, $sqlInsert);

    
    insertLogVMS($vmscode,$_SESSION['userName'],'BRIGHT','ส่งคำสั่งความสว่างตั้งค่าเป็น '.$valueBrightness.' : '.$return,$runcode);
    echo "ความสว่างตั้งค่าเป็น ".$valueBrightness." : ".$return;


}
*/
sqlsrv_close( $conn );
