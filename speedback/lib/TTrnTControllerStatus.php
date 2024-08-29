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
 function sendLineNotify($message)
{
    $token = "vg4rCDnuMOlg2Y6009Kg1YsFrPNe2zZSJeHispje7yY"; // ใส่ Token ที่สร้างไว้
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://notify-api.line.me/api/notify");
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "message=" . $message);
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
if(isset($_POST["TTrnTControllerStatusLinenotify"])){
    $dbm=new DatabaseManage();   
    $Serial = array("BG202001", "BG202002", "BG202003" , "BG202003", "BG202004", "BG202005", "BG202006", "BG202007", "BG202008", "BG202009", "BG202010");
    $i=0;
    foreach ($Serial as $XVCtlSerial) {
       
        $sql="SELECT TOP (1) dbo.TTrnTControllerStatus.XVCtlSerial, dbo.TTrnTControllerStatus.XTCstDate, dbo.TTrnTControllerStatus.XFCstVoltage, dbo.TTrnTControllerStatus.XFCstCurrent, dbo.TTrnTControllerStatus.XFCstPower, 
                dbo.TTrnTControllerStatus.XFCstEnergy, dbo.TTrnTControllerStatus.XFCstFrequency, dbo.TTrnTControllerStatus.XTCstPrevTime, dbo.TTrnTControllerStatus.XICstWaitTime, DATEDIFF(minute, dbo.TTrnTControllerStatus.XTCstDate, 
                GETDATE()) AS DiffMinute, dbo.TMstMController.XFCtlAmpMin, dbo.TTrnTControllerStatus.XFCstCurrent - dbo.TMstMController.XFCtlAmpMin AS DiffCurent
        FROM     dbo.TTrnTControllerStatus INNER JOIN
                dbo.TMstMController ON dbo.TTrnTControllerStatus.XVCtlSerial = dbo.TMstMController.XVCtlCode
        ORDER BY dbo.TTrnTControllerStatus.XTCstDate DESC";
        $result=$dbm->QueryDB($sql);
        $obj=json_decode($result);
        $data="";
        foreach ($obj as $result){
            $tMsg="";
            if($result->DiffMinute>3){
                $tMsg .= "\n" . "สถานะ  ไม่เชื่อมต่อ ผิดปกติ";
            }else{
                $tMsg .= "\n" . "ค่าปัจจุบัน  " .$result->XFCstCurrent. " Amp";
                if($result->DiffCurent < -0.5 || $result->DiffCurent > 1.5){
                    echo "XXXX";
                    $tMsg .=  "\n" + "สถานะ : ผิดปกติ";
                }else{
                    echo "ZZZZ";
                    $tMsg .=  "\n" + "สถานะ : ปกติ";
                }    
            }
            $data.=$tMsg.;
            echo $data; 
            //sendLineNotify($tMsg);
        }
        
    }
    
}

?>