<?php

include '../lib/DatabaseManageAdum.php';
function TTrnTControllerStatus($XVCtlSerial,$XFCstVoltage,$XFCstCurrent,$XFCstPower,$XFCstEnergy,$XFCstFrequency){
    $dbm=new DatabaseManage();   
    $sql="INSERT INTO TTrnTControllerStatus (XVCtlSerial, XFCstVoltage, XFCstCurrent, XFCstPower, XFCstEnergy, XFCstFrequency)
          VALUES ('$XVCtlSerial', $XFCstVoltage, $XFCstCurrent, $XFCstPower, $XFCstEnergy, $XFCstFrequency);
        ";
   
    $result2=$dbm->QueryDB($sql);
    return $ret;
 }
 function sendLineNotify($message,$Type)
{
 
    $sticker_package_id = '2';  
    $sticker_id = '34';    
    if( $Type==1){
        $imageFile=new CURLFILE("notconnect.jpg");
    }
    if( $Type==3){
        $imageFile=new CURLFILE("normal.jpg");
    }
    if( $Type==2){
        $imageFile=new CURLFILE("wranning.jpg");
    }
    
    $data = array (
        'message' => $message
      
    );
    
    /*
    $data = array (
        'message' => $message,
        "emojis": [
            {
              "index": 0,
              "productId": "5ac1bfd5040ab15980c9b435",
              "emojiId": "001"
            },
            {
              "index": 13,
              "productId": "5ac1bfd5040ab15980c9b435",
              "emojiId": "002"
            }
          ]
      
    );
    */
    /*
    $token = "vg4rCDnuMOlg2Y6009Kg1YsFrPNe2zZSJeHispje7yY"; // ใส่ Token ที่สร้างไว้
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://notify-api.line.me/api/notify");
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,  $data);
    $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $token . '',);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    if (curl_error($ch)) {
        echo 'error:' . curl_error($ch);
    } else {
        $res = json_decode($result, true);
        echo "status : " . $res['status'];
        echo "message : " . $res['message'];
    }
    curl_close($ch);
    */
    //--------------
    $token = "vg4rCDnuMOlg2Y6009Kg1YsFrPNe2zZSJeHispje7yY"; // ใส่ Token ที่สร้างไว้
    $chOne = curl_init();
    curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
    curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt( $chOne, CURLOPT_POST, 1);
    curl_setopt( $chOne, CURLOPT_POSTFIELDS, $data);
    curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1);
    $headers = array( 'Method: POST', 'Content-type: multipart/form-data', 'Authorization: Bearer '.$token, );
    curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
    curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec( $chOne );
    //Check error
    if(curl_error($chOne)) { echo 'error:' . curl_error($chOne); }
    else { $result_ = json_decode($result, true);
    echo "status : ".$result_['status']; echo "message : ". $result_['message']; 
    }
}
 if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') { 
    if(isset($_POST["TTrnTControllerStatus"])){ 
        $XVCtlSerial=$_POST["XVCtlSerial"];
        $XFCstVoltage=$_POST["XFCstVoltage"];
        $XFCstCurrent=$_POST["XFCstCurrent"];
        $XFCstPower=$_POST["XFCstPower"];
        $XFCstEnergy=$_POST["XFCstEnergy"];
        $XFCstFrequency=$_POST["XFCstFrequency"];
        echo TTrnTControllerStatus($XVCtlSerial,$XFCstVoltage,$XFCstCurrent,$XFCstPower,$XFCstEnergy,$XFCstFrequency);
     }
     
}


if(isset($_REQUEST["TTrnTControllerStatusLinenotify"])){
   
    $dbm=new DatabaseManage();   
    $Serial = array("BG202001", "BG202002", "BG202003" , "BG202003", "BG202004", "BG202005", "BG202006", "BG202007", "BG202008", "BG202009", "BG202010");
    $i=0;
    foreach ($Serial as $XVCtlSerial) {
        $sql="SELECT TOP (1) dbo.TTrnTControllerStatus.XVCtlSerial, dbo.TTrnTControllerStatus.XTCstDate, dbo.TTrnTControllerStatus.XFCstVoltage, dbo.TTrnTControllerStatus.XFCstCurrent, dbo.TTrnTControllerStatus.XFCstPower, 
                    dbo.TTrnTControllerStatus.XFCstEnergy, dbo.TTrnTControllerStatus.XFCstFrequency, dbo.TTrnTControllerStatus.XTCstPrevTime, dbo.TTrnTControllerStatus.XICstWaitTime, DATEDIFF(minute, dbo.TTrnTControllerStatus.XTCstDate, 
                    GETDATE()) AS DiffMinute, dbo.TMstMController.XFCtlAmpMin, dbo.TTrnTControllerStatus.XFCstCurrent - dbo.TMstMController.XFCtlAmpMin AS DiffCurent, dbo.TMstMController.XVCtlLat, dbo.TMstMController.XVCtlLong, 
                    dbo.TMstMController.XVCtlName, dbo.TMstMProject.XVPrjName
            FROM     dbo.TTrnTControllerStatus INNER JOIN
                    dbo.TMstMController ON dbo.TTrnTControllerStatus.XVCtlSerial = dbo.TMstMController.XVCtlCode INNER JOIN
                    dbo.TMstMProject ON dbo.TMstMController.XVPrjCode = dbo.TMstMProject.XVPrjCode
            WHERE  (dbo.TTrnTControllerStatus.XVCtlSerial = '$XVCtlSerial')
            ORDER BY dbo.TTrnTControllerStatus.XTCstDate DESC";
        $result=$dbm->QueryDB($sql);
        $obj=json_decode($result);
        foreach ($obj as $result){
            $Type=0;
            $tMsg="";
            $tMsg.="โครงการ : ".$result->XVPrjName;
            $tMsg.= "\n" . "กล่อง : ".$result->XVCtlName;
            if($result->DiffMinute>3){
                $tMsg .= "\n" . "สถานะ  ไม่เชื่อมต่อ ผิดปกติ";
                $Type=1;
            }else{
                $tMsg .= "\n" . "ค่าปัจจุบัน  " .$result->XFCstCurrent. " Amp";
                if($result->DiffCurent < -0.5 || $result->DiffCurent > 1.5){
                    $Type=2;
                    $tMsg .=  "\n" . "สถานะ : ผิดปกติ";
                }else{
                    $Type=3;
                    $tMsg .=  "\n" . "สถานะ : ปกติ";
                }    
            }
            $tMsg .= "\n" ."http://maps.google.com/maps?q=loc:".$result->XVCtlLat.",".$result->XVCtlLong;
            sendLineNotify($tMsg,$Type);
           
        }
       
    }
    
}

?>