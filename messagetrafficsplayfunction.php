<?php
ob_start();
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST["showsms"])){
       echo showsms();
    }
    if(isset($_POST["Insert"])){
        $XVVmsCode=$_POST["XVVmsCode"];
        $XVPltCode=$_POST["XVPltCode"];
        echo insert($XVVmsCode,$XVPltCode);
    }
    if(isset($_POST["ShowPlayList"])){
        $XVVmsCode=$_POST["XVVmsCode"];
       echo ShowPlayList($XVVmsCode);
    }
    if(isset($_POST["SendMqtt"])){
       $vmscode=$_POST["vmsID"];
       echo SendMqtt($vmscode);
    }
    if(isset($_POST["cancelsms"])){
        $XVVmsCode=$_POST["XVVmsCode"];
        echo cancelsms($XVVmsCode);
    }
   
}
function cancelsms($XVVmsCode){
    include "lib/DatabaseManage.php";
    $sql="DELETE FROM TMstMItmVMSPlayList WHERE XVVmsCode='$XVVmsCode' and XVPltType=2";
 
    
    $stmt = sqlsrv_query( $conn, $sql);
    if( $stmt === false ) {    
        $ret='{"Return":"CancelError"}';
    }else{
        $ret='{"Return":"CancelSuccess"}'; 
    }
    sqlsrv_close( $conn );
    return $ret;
}
function showsms(){
    include "lib/DatabaseManage.php";
    $stmt = "SELECT  dbo.TMstMPlaylist.XVPltCode, dbo.TMstMPlaylist.XVPltName, dbo.TMstMPlaylist.XVPltType, dbo.TMstMMsgSize.XIMssWPixel, dbo.TMstMMsgSize.XIMssHPixel
        FROM            dbo.TMstMPlaylist INNER JOIN
                                dbo.TMstMMsgSize ON dbo.TMstMPlaylist.XVMssCode = dbo.TMstMMsgSize.XVMssCode
        WHERE        (dbo.TMstMPlaylist.XVPltType = N'2')
        ORDER BY dbo.TMstMPlaylist.XVPltCode DESC
    ";
    $data='
        <table id="TableSms" class="table table-striped table-hover" style="width:100%;">
            <thead>
                    <tr style="font-size: 10pt">
                        <th class="th-sm">รหัสชุดการแสดงป้าย
                        </th>
                        <th class="th-sm" style="text-align: left;">ชื่อชุดการแสดงป้าย
                        </th>
                        <th class="th-sm">ขนาด
                        </th>
                        <th class="th-sm">
                        </th>
                        <th class="th-sm">
                        </th>
                    </tr>
            </thead>
            <tbody>
    ';
                    $query = sqlsrv_query($conn, $stmt);
                    while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                    {
                       $data.='<tr>';
                       $data.='<td>'.$result["XVPltCode"].'</td>';
                       $data.='<td style="text-align: left;">'.$result["XVPltName"].'</td>';
                       $data.='<td>'.$result["XIMssWPixel"].'x'.$result["XIMssHPixel"].'px</td>';
                       $data.='<td>'.$result["XIMssWPixel"].'x'.$result["XIMssHPixel"].'px</td>';
                       $data.='<td><button type="button"  onclick="SelectSms(\''.$result["XVPltCode"].'\')"   class="btn btn-primary btn-sm">ใช้ชุดข้อความนี้<i style="margin-left: 10px;color:#09C703;font-size: 18px;float: ritht;" class="fa fa-file-text"></i></button>';
                       $data.='</tr>';
                      
                    }
    $data.='
            </tbody>
        </table>

    ';
    sqlsrv_close( $conn );
    return $data; 
   
}
function insert($XVVmsCode,$XVPltCode){
        $XVPltType='2';
        session_start();
        $XVWhoCreate=$_SESSION['user'];
        $XVWhoEdit=$_SESSION['userName'];
        $dnow=date('Y-m-d H:i:s');
        include "lib/DatabaseManage.php";
        $sql="DELETE FROM TMstMItmVMSPlayList WHERE XVVmsCode='$XVVmsCode' and XVPltType=2";
        
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {
                
                $ret='{"Return":"InsertError"}';
                
                exit();
        }
        
       



          $user="SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMUser] JOIN [NWL_SpeedWayTest2].[dbo].[TMstMShift] 
          ON [NWL_SpeedWayTest2].[dbo].[TMstMUser].XVShfCode = [NWL_SpeedWayTest2].[dbo].[TMstMShift].XVShfCode 
          WHERE [NWL_SpeedWayTest2].[dbo].[TMstMUser].XVUsrCode ='$XVWhoCreate'";
     /// echo $user;

        $q=sqlsrv_query($conn, $user);
        $d1=sqlsrv_fetch_array($q, SQLSRV_FETCH_ASSOC);

       // $TmStr_conH = date('H',strtotime($shf1['XIShfStartHour']));
       // $TmStr_conM = date('i',strtotime($shf1['XIShfStartMin']));
        
       // $TmEd_conH = date('H',strtotime($shf1['XIShfEndHour']));
       // $TmEd_conM = date('i',strtotime($shf1['XIShfEndMin']));
        
   //     $datestr = date('Y-m-d'.$TmStr_conH.$TmStr_conM);
      //  $dateend = date('Y-m-d'.$TmEd_conH.$TmEd_conM);
 
        $hour = $d1['XIShfStartHour'];// echo $hour.'test';
        $minute = $d1['XIShfStartMin'];
        
        // ตั้งค่าวันที่ที่ต้องการ
        $year = date('Y');
        $month = date('m');
        $day = date('d');;
        
        // สร้าง DateTime object
        $date = new DateTime();
        $date->setDate($year, $month, $day);
        $date->setTime($hour, $minute);

        $hourend = $d1['XIShfEndHour'];
        $minuteend= $d1['XIShfEndMin'];

        $datec = new DateTime();
        $datec->setDate($year, $month, $day);
        $datec->setTime($hourend,$minuteend);
        
        // แปลง DateTime object เป็น string
        $dateString_end = $datec->format('Y-m-d H:i:s');
        $dateString_str = $date->format('Y-m-d H:i:s');

        $sql="INSERT INTO TMstMItmVMSPlayList ( 
                                               XVVmsCode
                                              ,XVPltType
                                              ,XVPltCode
                                              ,XTVmpStart
                                              ,XTVmpEnd
                                              ,XVWhoCreate
                                              ,XTWhenCreate
                                              )
                                              VALUES ('$XVVmsCode'
                                              ,'$XVPltType'
                                              ,'$XVPltCode'
                                              ,'$dateString_str'
                                              ,'$dateString_end'
                                              ,'$XVWhoCreate'
                                              ,GETDATE()
                                              );";
        // echo $sql;
         $stmt = sqlsrv_query( $conn, $sql);
         if( $stmt === false ) {
                 $ret='{"Return":"InsertError"}';
                
         }else{
                 $ret='{"Return":"InsertSuccess"}';
                
         }
         sqlsrv_close( $conn );
         return $ret;
        
}
function ShowPlayList($XVVmsCode){
    include "lib/DatabaseManage.php";
    $sql="SELECT        dbo.TMstMPlaylist.XVPltCode, dbo.TMstMPlaylist.XVPltName, dbo.TMstMItmVMSPlayList.XVVmsCode, dbo.TMstMPlaylist.XVPltType
          FROM            dbo.TMstMPlaylist INNER JOIN
                         dbo.TMstMItmVMSPlayList ON dbo.TMstMPlaylist.XVPltCode = dbo.TMstMItmVMSPlayList.XVPltCode
     
           WHERE        (dbo.TMstMItmVMSPlayList.XVVmsCode = '$XVVmsCode') and   (dbo.TMstMPlaylist.XVPltType = N'2')";
  
    $query = sqlsrv_query($conn,  $sql);
    $XVPltCode='';
    $data='';
    while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
    {
             $XVPltCode=$result["XVPltCode"];
             $data.='<p>ชุดแสดงป้าย '.$result["XVPltCode"].' '.$result["XVPltName"].'</p>';
    }
    
    
    $data.='
        <table id="TableSms" class="table" style="width:100%;">
            <thead>
                    <tr style="font-size: 10pt">
                        <th class="th-sm">รหัสชุดการแสดงป้าย
                        </th>
                        <th class="th-sm" style="text-align: left;">ชื่อชุดการแสดงป้าย
                        </th>
                        <th class="th-sm">ขนาด
                        </th>
                    </tr>
            </thead>
            <tbody>
    ';
    $sql = "SELECT        TOP (100) PERCENT dbo.TMstMPlaylistDT.XVPltCode, dbo.TMstMPlaylistDT.XIPltSeqNo, dbo.TMstMPlaylistDT.XVMsfCode, dbo.TMstMPlaylistDT.XIPltDuration, dbo.TMstMPlaylistDT.XBPltHasExpiration, 
                         dbo.TMstMPlaylistDT.XTPltStart, dbo.TMstMPlaylistDT.XTPltEnd, dbo.TMstMMessageFrame.XVMsfName, dbo.TMstMMsgSize.XIMssWPixel, dbo.TMstMMsgSize.XIMssHPixel, dbo.TMstMMessageFrame.XVMsfType
FROM            dbo.TMstMPlaylistDT INNER JOIN
                         dbo.TMstMMessageFrame ON dbo.TMstMPlaylistDT.XVMsfCode = dbo.TMstMMessageFrame.XVMsfCode INNER JOIN
                         dbo.TMstMMsgSize ON dbo.TMstMMessageFrame.XVMssCode = dbo.TMstMMsgSize.XVMssCode

    WHERE        (dbo.TMstMPlaylistDT.XVPltCode = '$XVPltCode') and  (dbo.TMstMMessageFrame.XVMsfType = N'2')
    ORDER BY dbo.TMstMPlaylistDT.XIPltSeqNo
    ";               
                    $query = sqlsrv_query($conn, $sql);
                    while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                    {
                       $data.='<tr it="'.$result["XVPltCode"].$result["XIPltSeqNo"].'">';
                       $data.='<td>'.$result["XVMsfCode"].'</td>';
                       $data.='<td  style="text-align: left;">'.$result["XVMsfName"].'</td>';
                       $data.='<td>'.$result["XIMssWPixel"].'x'.$result["XIMssHPixel"].'px</td>';
                      
                       
                       $data.='</tr>';
                      
                    }
    $data.='
            </tbody>
        </table>

    ';
    sqlsrv_close( $conn );
    return $data; 
    
}
function twodigit($number){
     
     if($number<10){
       $ret='0'.$number;
     }else{
        $ret=$number;
     }
    return $ret;
}
function SendMqtt($vmscode){
    date_default_timezone_set("Asia/Bangkok");
    include "Lib/MqttSend.php";
    include "lib/DatabaseManage.php";
    $XVUsrCode=$_SESSION['userName'];



    $sql="SELECT  dbo.TMstMItmVMSPlayList.XVVmsCode, dbo.TMstMPlaylist.XVPltCode, dbo.TMstMPlaylist.XVPltName, dbo.TMstMPlaylist.XVMssCode, dbo.TMstMPlaylist.XVPltType
          FROM  dbo.TMstMPlaylist INNER JOIN
                 dbo.TMstMItmVMSPlayList ON dbo.TMstMPlaylist.XVPltCode = dbo.TMstMItmVMSPlayList.XVPltCode
          WHERE (dbo.TMstMItmVMSPlayList.XVVmsCode = '$vmscode') AND (dbo.TMstMPlaylist.XVPltType = N'2')";
   
    $query = sqlsrv_query($conn, $sql);
  
    $XVPltCode="";
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
  
    $XVPltCode=$result["XVPltCode"];
    $XVPltName=$result["XVPltName"];
    $XVMssCode=$result["XVMssCode"];
    $XVPltType=$result["XVPltType"];
    $sql="insert into TMstMPlaylistReport (XVUsrCode
                                              ,XTSendPlaylist
                                              ,XVPltCode
                                              ,XVPltName
                                              ,XVMssCode
                                              ,XVPltType)VaLUES(
                                              '$XVUsrCode'
                                              ,GETDATE()
                                              ,'$XVPltCode'
                                              ,'$XVPltName'
                                              ,'$XVMssCode'
                                              ,'$XVPltType'
                                              )
                                              ";
                                   
      
    
    sqlsrv_query($conn, $sql);
    $sql1="SELECT  XVPltCode, XIPltSeqNo, XIPltOrder, XVMsfCode, XIPltDuration, XBPltHasExpiration, XTPltStart, XTPltEnd
                FROM   dbo.TMstMPlaylistDT
                WHERE  (XVPltCode = '$XVPltCode')
                ORDER BY XIPltSeqNo";

            $data="";
   
    $sql2="insert into TMstMPlaylistDTReport (
                XVVmsCode
               ,XVUsrCode
               ,XTSendPlaylist
               ,XVPltCode
               ,XIPltSeqNo
               ,XIPltOrder
               ,XVMsfCode
               ,XIPltDuration
               ,XBPltHasExpiration
               ,XTPltStart
               ,XTPltEnd)VALUES";
    $CountRecord=0;   
    $query = sqlsrv_query($conn, $sql1);
    while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
    {
                $XVPltCode=$result["XVPltCode"];
                $XIPltSeqNo=$result["XIPltSeqNo"];
                $XIPltOrder=$result["XIPltOrder"];
                $XVMsfCode=$result["XVMsfCode"];
                $XIPltDuration=$result["XIPltDuration"];
                $XBPltHasExpiration=$result["XBPltHasExpiration"];
                $XTPltStart=$result["XTPltStart"];
                $XTPltEnd=$result["XTPltEnd"];
                if($XBPltHasExpiration==1){
                    $sql2.="(
                            '$vmscode'
                            ,'$XVUsrCode'
                            ,GETDATE()
                            ,'$XVPltCode'
                            ,$XIPltSeqNo
                            ,$XIPltOrder
                            ,'$XVMsfCode'
                            ,$XIPltDuration
                            ,'$XBPltHasExpiration'
                            ,'$XTPltStart'
                            ,'$XTPltEnd'     
                            ),";
                }else{
                    $sql2.="(
                        '$vmscode'
                        ,'$XVUsrCode'
                        ,GETDATE()
                        ,'$XVPltCode'
                        ,$XIPltSeqNo
                        ,$XIPltOrder
                        ,'$XVMsfCode'
                        ,$XIPltDuration
                        ,'$XBPltHasExpiration'
                        ,GETDATE()
                        ,GETDATE()   
                        ),";
                }

                $CountRecord++;
            
    }
    if($CountRecord>0){

                $sql2=substr($sql2,0,strlen($sql2)-1);
                sqlsrv_query($conn, $sql2);
    }
    
    sqlsrv_close( $conn );
    $topic=$vmscode.'_Display'; 
    $data='{"cmd":"01"}';
    return   mqttsend($topic,$data);
}       
?>