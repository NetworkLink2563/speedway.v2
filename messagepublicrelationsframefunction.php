<?php
ob_start();
session_start();
   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       if(isset($_POST["showsmssel"])){
          echo showsmssel();
       }
       if(isset($_POST["f1_sel_sms1"])){
         $XVMsgCode=$_POST["XVMsgCode"];
         echo getsms($XVMsgCode);
       }
       if(isset($_POST["saveframe1"])){
           $XVMsfCode=$_POST["XVMsfCode"];
           echo  SaveFrame1($XVMsfCode);
       }
       if(isset($_POST["saveframe2"])){
           $XVMsfCode=$_POST["XVMsfCode"];
           echo SaveFrame2($XVMsfCode);
       }
       if(isset($_POST["saveframe3"])){
           $XVMsfCode=$_POST["XVMsfCode"];
           echo  SaveFrame3($XVMsfCode);
       }
       if(isset($_POST["Delete"])){
          $XVMsfCode=$_POST["XVMsfCode"];
           echo Delete($XVMsfCode);
           
       }
       if(isset($_POST["SearchEdit"])){
            $XVMsfCode=$_POST["XVMsfCode"];
            echo  SearchEdit($XVMsfCode);
             
       }
      

    
   }
   function SearchEdit($XVMsfCode){
    $XVMsfName='';
    $XVMsfFormat='';
    $XVMsgCodeF1='';
    $XVMsgCodeF2='';
    $XVMsgCodeF3='';
    $XVMsgCodeF4='';
    $XVMsgCodeF5='';   
    include "lib/DatabaseManage.php";
    $stmt = "SELECT        XVMsfCode, XVMsfName, XVMssCode, XVMsfFormat, XVMsgCodeF1, XVMsgCodeF2, XVMsgCodeF3, XVMsgCodeF4, XVMsgCodeF5, XVMsfType
            FROM     dbo.TMstMMessageFrame
            WHERE   (XVMsfCode = '$XVMsfCode')";
    $query = sqlsrv_query($conn, $stmt);
    
    while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
    {
         $XVMsfName=$result["XVMsfName"];
         $XVMsfFormat=$result["XVMsfFormat"];
         $XVMsgCodeF1=$result["XVMsgCodeF1"];
         $XVMsgCodeF2=$result["XVMsgCodeF2"];
         $XVMsgCodeF3=$result["XVMsgCodeF3"];
         $XVMsgCodeF4=$result["XVMsgCodeF4"];
         $XVMsgCodeF5=$result["XVMsgCodeF5"];
    }
    sqlsrv_close( $conn );
    $data='{';
    $data.='"XVMsfName":"'.$XVMsfName.'",';
    $data.='"XVMsfFormat":"'.$XVMsfFormat.'",';
    $data.='"XVMsgCodeF1":"'.$XVMsgCodeF1.'",';
    $data.='"XVMsgCodeF2":"'.$XVMsgCodeF2.'",';
    $data.='"XVMsgCodeF3":"'.$XVMsgCodeF3.'",';
    $data.='"XVMsgCodeF4":"'.$XVMsgCodeF4.'",';
    $data.='"XVMsgCodeF5":"'.$XVMsgCodeF5.'"';
    $data.='}';
    return $data;
   }

   function Delete($XVMsfCode){
       include "lib/DatabaseManage.php";
       $sql="SELECT dbo.TMstMPlaylistDT.XVMsfCode, dbo.TMstMPlaylistDT.XVPltCode, dbo.TMstMPlaylist.XVPltName
             FROM  dbo.TMstMPlaylistDT INNER JOIN
                         dbo.TMstMPlaylist ON dbo.TMstMPlaylistDT.XVPltCode = dbo.TMstMPlaylist.XVPltCode
             WHERE  (dbo.TMstMPlaylistDT.XVMsfCode = '$XVMsfCode')";
     
        $query = sqlsrv_query($conn, $sql);
        $countp=0;
        while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
        {
            $ret='{"Return":"'.$result["XVPltCode"].' '.$result["XVPltName"].'"}';

            $countp++;
            break;
        }
        if($countp>0){
           return $ret;
        }
    
        
        $sql="DELETE FROM TMstMMessageFrame WHERE XVMsfCode='$XVMsfCode'";

        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {
                    $ret='{"Return":"DeleteError"}';
                    die( print_r( sqlsrv_errors(), true));
        }else{
                    $ret='{"Return":"DeleteSuccess"}';
        }
        sqlsrv_close( $conn );
       return $ret;
   }
   function SaveFrame1($XVMsfCode){
        include "lib/DatabaseManage.php";
        $InsertUpdate=2;
        if($XVMsfCode=='MSFYYMM-####'){
            $InsertUpdate=1;
            $XVMsfCode=RunCode();
        }
        if($XVMsfCode!=''){
           
            $XVMsgCodeF1='';
            $XVMsgCodeF2='';
            $XVMsgCodeF3='';
            $XVMsgCodeF4='';
            $XVMsgCodeF5='';
            
            
            $XVMssCode=$_POST["XVMssCode"];
            $XVMsfName=$_POST["XVMsfName"];
            $XVMsgCodeF3=$_POST['XVMsgCodeF3'];
            $XVMsfFormat='001';
            $XVMsfType='1';
            $XVWhoCreate=$_SESSION['userName'];
            $XVWhoEdit=$_SESSION['userName'];
            if($InsertUpdate==1){
                $sql="
                    INSERT INTO TMstMMessageFrame (XVMsfCode, XVMsfName, XVMssCode, XVMsfFormat,XVMsgCodeF1,XVMsgCodeF2,XVMsgCodeF3,XVMsgCodeF4,XVMsgCodeF5,XVMsfType,XVWhoCreate,XTWhenCreate)
                    VALUES ('$XVMsfCode', 
                            '$XVMsfName',
                            '$XVMssCode',
                            '$XVMsfFormat', 
                            '$XVMsgCodeF1',
                            '$XVMsgCodeF2',
                            '$XVMsgCodeF3',
                            '$XVMsgCodeF4',
                            '$XVMsgCodeF5',
                            '$XVMsfType',
                            '$XVWhoCreate',
                            GETDATE()

                    );
                ";
            }else{
                $sql=" UPDATE TMstMMessageFrame
                SET XVMsfName='$XVMsfName',
                    XVMsgCodeF1='$XVMsgCodeF1',
                    XVMsgCodeF2='$XVMsgCodeF2',
                    XVMsgCodeF3='$XVMsgCodeF3',
                    XVMsgCodeF4='$XVMsgCodeF4',
                    XVMsgCodeF5='$XVMsgCodeF5',
                    XVWhoEdit='$XVWhoEdit'
                    WHERE XVMsfCode='$XVMsfCode';";
            }
            $stmt = sqlsrv_query( $conn, $sql);
            if( $stmt === false ) {
                    $ret='{"Retrune":"InsertError"}';
                    die( print_r( sqlsrv_errors(), true));
            }else{
                    $ret='{"Return":"'.$XVMsfCode.'"}';
            }
            sqlsrv_close( $conn );
        }else{
            $ret='{"Return":"InsertError"}';
        }
       
        return  $ret;
   }
   function SaveFrame2( $XVMsfCode){
    include "lib/DatabaseManage.php";
    $InsertUpdate=2;
    if($XVMsfCode=='MSFYYMM-####'){
        $InsertUpdate=1;
        $XVMsfCode=RunCode();
    }
    if($XVMsfCode!=''){
       
        $XVMsgCodeF1='';
        $XVMsgCodeF2='';
        $XVMsgCodeF3='';
        $XVMsgCodeF4='';
        $XVMsgCodeF5='';
        
        
        $XVMssCode=$_POST["XVMssCode"];
        $XVMsfName=$_POST["XVMsfName"];
        $XVMsgCodeF1=$_POST['XVMsgCodeF1'];
        $XVMsgCodeF2=$_POST['XVMsgCodeF2'];
        $XVMsgCodeF3=$_POST['XVMsgCodeF3'];
        $XVMsgCodeF4=$_POST['XVMsgCodeF4'];
        $XVMsgCodeF5=$_POST['XVMsgCodeF5'];
        $XVMsfFormat='002';
        $XVMsfType='1';
        $XVWhoCreate=$_SESSION['userName'];
        $XVWhoEdit=$_SESSION['userName'];
        if($InsertUpdate==1){
               $sql="
                INSERT INTO TMstMMessageFrame (XVMsfCode, XVMsfName, XVMssCode, XVMsfFormat,XVMsgCodeF1,XVMsgCodeF2,XVMsgCodeF3,XVMsgCodeF4,XVMsgCodeF5,XVMsfType,XVWhoCreate,XTWhenCreate)
                VALUES ('$XVMsfCode', 
                        '$XVMsfName',
                        '$XVMssCode',
                        '$XVMsfFormat', 
                        '$XVMsgCodeF1',
                        '$XVMsgCodeF2',
                        '$XVMsgCodeF3',
                        '$XVMsgCodeF4',
                        '$XVMsgCodeF5',
                        '$XVMsfType',
                        '$XVWhoCreate',
                        GETDATE()

                );
            ";
        }else{
            $sql=" UPDATE TMstMMessageFrame
            SET XVMsfName='$XVMsfName',
                XVMsgCodeF1='$XVMsgCodeF1',
                XVMsgCodeF2='$XVMsgCodeF2',
                XVMsgCodeF3='$XVMsgCodeF3',
                XVMsgCodeF4='$XVMsgCodeF4',
                XVMsgCodeF5='$XVMsgCodeF5',
                XVWhoEdit='$XVWhoEdit'
                WHERE XVMsfCode='$XVMsfCode';";
        }

        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {
                $ret='{"Retrune":"InsertError"}';
                die( print_r( sqlsrv_errors(), true));
        }else{
                $ret='{"Return":"'.$XVMsfCode.'"}';
        }
        sqlsrv_close( $conn );
    }else{
        $ret='{"Return":"InsertError"}';
    }
   
    return  $ret;
}

function SaveFrame3( $XVMsfCode){
    include "lib/DatabaseManage.php";
  
    $InsertUpdate=2;
    if($XVMsfCode=='MSFYYMM-####'){
        $InsertUpdate=1;
        $XVMsfCode=RunCode();
    }
    if($XVMsfCode!=''){
       
        $XVMsgCodeF1='';
        $XVMsgCodeF2='';
        $XVMsgCodeF3='';
        $XVMsgCodeF4='';
        $XVMsgCodeF5='';
        $XVMssCode=$_POST["XVMssCode"];
        $XVMsfName=$_POST["XVMsfName"];
        $XVMsgCodeF1=$_POST['XVMsgCodeF1'];
        $XVMsgCodeF3=$_POST['XVMsgCodeF3'];
        $XVMsgCodeF4=$_POST['XVMsgCodeF4'];
        $XVMsfFormat='003';
        $XVMsfType='1';
        $XVWhoCreate=$_SESSION['userName'];
        $XVWhoEdit=$_SESSION['userName'];
        if($InsertUpdate==1){
        $sql="
                INSERT INTO TMstMMessageFrame (XVMsfCode, XVMsfName, XVMssCode, XVMsfFormat,XVMsgCodeF1,XVMsgCodeF2,XVMsgCodeF3,XVMsgCodeF4,XVMsgCodeF5,XVMsfType,XVWhoCreate,XTWhenCreate)
                VALUES ('$XVMsfCode', 
                        '$XVMsfName',
                        '$XVMssCode',
                        '$XVMsfFormat', 
                        '$XVMsgCodeF1',
                        '$XVMsgCodeF2',
                        '$XVMsgCodeF3',
                        '$XVMsgCodeF4',
                        '$XVMsgCodeF5',
                        '$XVMsfType',
                        '$XVWhoCreate',
                        GETDATE()

                );
            ";
        }else{
            $sql=" UPDATE TMstMMessageFrame
            SET XVMsfName='$XVMsfName',
                XVMsgCodeF1='$XVMsgCodeF1',
                XVMsgCodeF2='$XVMsgCodeF2',
                XVMsgCodeF3='$XVMsgCodeF3',
                XVMsgCodeF4='$XVMsgCodeF4',
                XVMsgCodeF5='$XVMsgCodeF5',
                XVWhoEdit='$XVWhoEdit'
                WHERE XVMsfCode='$XVMsfCode';";
        }
        $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {
                $ret='{"Retrune":"InsertError"}';
                die( print_r( sqlsrv_errors(), true));
        }else{
                $ret='{"Return":"'.$XVMsfCode.'"}';
        }
        sqlsrv_close( $conn );
    }else{
        $ret='{"Return":"InsertError"}';
    }
   
    return  $ret;
}
   function RunCode(){
    include "lib/DatabaseManage.php";
        $ptcode="";
        $ProcedSQL = "DECLARE @tCode nvarchar(100)
            EXEC dbo. STP_NWLtGetMaxCode 'TMstMMessageFrame', @tCode OUTPUT
            PRINT 'TMstMMessageFrame' + '-->' + @tCode
        ";
        $queryProcedSQL = sqlsrv_query($conn, $ProcedSQL);
        if( $queryProcedSQL === false ) {
            $ptcode="";
            die( print_r( sqlsrv_errors(), true));
        }else{

            $resultProcedSQL = sqlsrv_fetch_array($queryProcedSQL, SQLSRV_FETCH_ASSOC);
            $ptcode=$resultProcedSQL['ptCode'];
           
        }
        sqlsrv_close( $conn );
        return $ptcode;
   }
   function getsms($XVMsgCode){
       $data="";
       include "lib/DatabaseManage.php";
       $stmt = "SELECT        dbo.TMstMMessage.XVMsgCode, dbo.TMstMMessage.XVMsgHtml, dbo.TMstMMessage.XVMsgFileName, dbo.TMstMMessage.XVMsgName, dbo.TMstMMsgSize.XIMssWPixel, dbo.TMstMMsgSize.XIMssHPixel, 
                         dbo.TMstMMessage.XVMsgType, dbo.TMstMMessage.XVMsgHtmlM
                FROM            dbo.TMstMMessage INNER JOIN
                         dbo.TMstMMsgSize ON dbo.TMstMMessage.XVMssCode = dbo.TMstMMsgSize.XVMssCode
        WHERE        (dbo.TMstMMessage.XVMsgCode = '$XVMsgCode')";
       $query = sqlsrv_query($conn, $stmt);
       $XVMsgCode="";
       $XVMsgHtmlM="";
       $XVMsgFileName="";
       $XIMssWPixel="";
       $XIMssHPixel="";
       while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
       {
          $XVMsgCode=$result['XVMsgCode'];
          $XVMsgHtmlM=$result['XVMsgHtmlM'];
          $XVMsgFileName=$result['XVMsgFileName'];
          $XIMssWPixel=$result['XIMssWPixel'];
          $XIMssHPixel=$result['XIMssHPixel'];
       }  
       sqlsrv_close( $conn );
       $data=$XVMsgHtmlM.'|'.$XVMsgFileName;
       return $data;
   }
   function showsmssel(){
         include "lib/DatabaseManage.php";
         $data='<table id="VMSTable" class="table" style="width:100%;">
         <thead>
             <tr style="font-size: 10pt">
                 <th class="th-sm">รหัสข้อความ
                 </th>
                 <th class="th-sm">ชื่อข้อความ
                 </th>
                 <th class="th-sm" style="text-align: left">ตัวอย่าง
                 </th>
                 <th class="th-sm" style="text-align: center">ขนาด
                 </th>
                 <th class="th-sm" style="text-align: center">ประเภท
                 </th>
                 <th class="th-sm" style="text-align: center"></th>
                 
             </tr>
         </thead>
         <tbody>';
         
        $stmt = "SELECT TMstMMessage.XVMsgCode,TMstMMessage.XVMsgName,TMstMMessage.XVWhoCreate,TMstMMsgSize.XIMssWPixel,TMstMMsgSize.XIMssHPixel,XVMsgFileName,TMstMMessage.XVMsgType FROM TMstMMessage 
              INNER JOIN TMstMMsgSize ON TMstMMsgSize.XVMssCode=TMstMMessage.XVMssCode
              
            ORDER BY TMstMMessage.XTWhenCreate DESC";
        $query = sqlsrv_query($conn, $stmt);
        
        while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
        {
              
                if($result['XVMsgType']==1){
                    $icot='<i class="fa fa-text-width" aria-hidden="true" title="ข้อความ"></i>';
                    $XVMsgFileName = $result['XVMsgCode'];
                }elseif($result['XVMsgType']==2){
                    $icot='<i class="fa fa-picture-o" aria-hidden="true" title="รูปภาพ"></i>';
                    $XVMsgFileName = $result['XVMsgFileName'];
                }elseif($result['XVMsgType']==3){
                    $icot='<i class="fa fa-video-camera" aria-hidden="true" title="ภาพเคลื่อนไหว"></i>';
                    $XVMsgFileName = $result['XVMsgFileName'];
                }
               
               
                $XVMsgType = $result['XVMsgType'];
                $XIMssWPixel=$result['XIMssWPixel'];
                $XIMssHPixel=$result['XIMssHPixel'];
                $url="ifarmeimg.php?msg=$XVMsgFileName&type=$XVMsgType";
                $url."&wp=".base64_encode($result['XIMssWPixel']);
                $url."&hp=".base64_encode($result['XIMssHPixel']);
                $XVMsgName=$result['XVMsgName'];
                
                $data.='<tr style="font-size: 10pt">
                    <td>'.$result['XVMsgCode'].'</td>
                    <td>'.$result['XVMsgName'].'</td>
                    <td style="text-align: center;">';
                $data.='<i style="cursor: -webkit-grab; cursor: grab;" class="fa fa-search"
                    aria-hidden="true"
                    onclick="examplesms(\''.$url.'\','.$result['XIMssHPixel'].','.$result['XIMssWPixel'].',\''.$XVMsgName.'\');"></i></td>';

                $data.='<td style="text-align: center">'.$result['XIMssWPixel'].'x'.$result['XIMssHPixel'].'</td>
                    <td style="text-align: center;"><div style=" margin-top: 5px">'.$icot.'</div></td>
                    <td><button onclick="SelSms(\''.$result['XVMsgType'].'\',\''.$result['XVMsgFileName'].'\')" type="button" class="btn btn-success btn-sm">เลือก</button></td>';
                $data.='</tr>';
            
        }            
            
        $data.='</tbody>
        </table>
        ';
        sqlsrv_close( $conn );
        return $data;    

   }
  
?>