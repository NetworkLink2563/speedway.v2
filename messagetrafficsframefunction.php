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
         
         $XVMsgCodeF1c=$result["XVMsgCodeF1"];
         
         $qchk1 = "SELECT * FROM TMstMMessage WHERE XVMsgCode ='$XVMsgCodeF1c'";
         $q1=sqlsrv_query($conn,  $qchk1);
         $qc1=sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC);
         $k = $qc1['XVMsgType'];
         if($k==1){
            $XVMsgCodeF1=$XVMsgCodeF1c;
         }else{
            $XVMsgCodeF1=$qc1["XVMsgFileName"];
         }
    
         $XVMsgCodeF2c=$result["XVMsgCodeF2"];
         $qchk2 = "SELECT * FROM TMstMMessage WHERE XVMsgCode ='$XVMsgCodeF2c'";
         $q2=sqlsrv_query($conn,  $qchk2);
         $qc2=sqlsrv_fetch_array($q2, SQLSRV_FETCH_ASSOC);
         $k2 = $qc2['XVMsgType'];
         if($k2==1){
            $XVMsgCodeF2=$XVMsgCodeF2c;
         }else{
            $XVMsgCodeF2=$qc2["XVMsgFileName"];
         }

         $XVMsgCodeF3c=$result["XVMsgCodeF3"];
         $qchk3 = "SELECT * FROM TMstMMessage WHERE XVMsgCode ='$XVMsgCodeF3c'";
         $q3=sqlsrv_query($conn,  $qchk3);
         $qc3=sqlsrv_fetch_array($q3 ,SQLSRV_FETCH_ASSOC);
         $k3 = $qc3['XVMsgType'];
         if($k3==1){
            $XVMsgCodeF3=$XVMsgCodeF3c;
         }else{
            $XVMsgCodeF3=$qc3["XVMsgFileName"];
         }
         $XVMsgCodeF4c=$result["XVMsgCodeF4"];
         $qchk4 = "SELECT * FROM TMstMMessage WHERE XVMsgCode ='$XVMsgCodeF4c'";
         $q4=sqlsrv_query($conn,  $qchk4);
         $qc4=sqlsrv_fetch_array($q4, SQLSRV_FETCH_ASSOC);
         $k4 = $qc4['XVMsgType'];
         if($k4==1){
            $XVMsgCodeF4=$XVMsgCodeF4c;
         }else{
            $XVMsgCodeF4=$qc4["XVMsgFileName"];
         }
         $XVMsgCodeF5c=$result["XVMsgCodeF5"];
         $qchk5 = "SELECT * FROM TMstMMessage WHERE XVMsgCode ='$XVMsgCodeF5c'";
         $q5=sqlsrv_query($conn,  $qchk5);
         $qc5=sqlsrv_fetch_array($q5, SQLSRV_FETCH_ASSOC);
         $k5 = $qc5['XVMsgType'];
       
         if($k5==1){
            $XVMsgCodeF5=$XVMsgCodeF5c;
         }else{
            $XVMsgCodeF5=$qc5["XVMsgFileName"];
         }
    }
    sqlsrv_close( $conn );
    $data='{';
    $data.='"XVMsfName":"'.$XVMsfName.'",';
    $data.='"XVMsfFormat":"'.$XVMsfFormat.'",';
    $data.='"XVMsgCodeF1":"'.$XVMsgCodeF1.'",';
    $data.='"XVMsgCodeF2":"'.$XVMsgCodeF2.'",';
    $data.='"XVMsgCodeF3":"'.$XVMsgCodeF3.'",';
    $data.='"XVMsgCodeF4":"'.$XVMsgCodeF4.'",';
    $data.='"XVMsgCodeF5":"'.$XVMsgCodeF5.'",';
    $data.='"Type1":"'.$k.'",';
    $data.='"Type2":"'.$k2.'",';
    $data.='"Type3":"'.$k3.'",';
    $data.='"Type4":"'.$k4.'",';
    $data.='"Type5":"'.$k5.'"';
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
            $TF3 = explode(".", $XVMsgCodeF3);
            $XVMsfFormat='001';
            $XVMsfType='2';
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
                            '".$TF3[0]."',
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
                    XVMsgCodeF3='".$TF3[0]."',
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
        $TF1 = explode(".", $XVMsgCodeF1);
        $TF2 = explode(".", $XVMsgCodeF2);
        $TF3 = explode(".", $XVMsgCodeF3);
        $TF4 = explode(".", $XVMsgCodeF4);
        $TF5 = explode(".", $XVMsgCodeF5);
        $XVMsfFormat='002';
        $XVMsfType='2';
        $XVWhoCreate=$_SESSION['userName'];
        $XVWhoEdit=$_SESSION['userName'];
        if($InsertUpdate==1){
               $sql="
                INSERT INTO TMstMMessageFrame (XVMsfCode, XVMsfName, XVMssCode, XVMsfFormat,XVMsgCodeF1,XVMsgCodeF2,XVMsgCodeF3,XVMsgCodeF4,XVMsgCodeF5,XVMsfType,XVWhoCreate,XTWhenCreate)
                VALUES ('$XVMsfCode', 
                        '$XVMsfName',
                        '$XVMssCode',
                        '$XVMsfFormat', 
                        '".$TF1[0]."',
                        '".$TF2[0]."',
                        '".$TF3[0]."',
                        '".$TF4[0]."',
                        '".$TF5[0]."',
                        '$XVMsfType',
                        '$XVWhoCreate',
                        GETDATE()

                );
            ";
        }else{
            $sql=" UPDATE TMstMMessageFrame
            SET XVMsfName='$XVMsfName',
                XVMsgCodeF1='".$TF1[0]."',
                XVMsgCodeF2='".$TF2[0]."',
                XVMsgCodeF3='".$TF3[0]."',
                XVMsgCodeF4='".$TF4[0]."',
                XVMsgCodeF5='".$TF5[0]."',
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
        $TF1 = explode(".", $XVMsgCodeF1);
        $TF3 = explode(".", $XVMsgCodeF3);
        $TF4 = explode(".", $XVMsgCodeF4);
        $XVMsfFormat='003';
        $XVMsfType='2';
        $XVWhoCreate=$_SESSION['userName'];
        $XVWhoEdit=$_SESSION['userName'];
        if($InsertUpdate==1){
        $sql="
                INSERT INTO TMstMMessageFrame (XVMsfCode, XVMsfName, XVMssCode, XVMsfFormat,XVMsgCodeF1,XVMsgCodeF2,XVMsgCodeF3,XVMsgCodeF4,XVMsgCodeF5,XVMsfType,XVWhoCreate,XTWhenCreate)
                VALUES ('$XVMsfCode', 
                        '$XVMsfName',
                        '$XVMssCode',
                        '$XVMsfFormat', 
                        '".$TF1[0]."',
                        '$XVMsgCodeF2',
                        '".$TF3[0]."',
                        '".$TF4[0]."',
                        '$XVMsgCodeF5',
                        '$XVMsfType',
                        '$XVWhoCreate',
                        GETDATE()

                );
            ";
        }else{
            $sql=" UPDATE TMstMMessageFrame
            SET XVMsfName='$XVMsfName',
                XVMsgCodeF1='".$TF1[0]."',
                XVMsgCodeF2='$XVMsgCodeF2',
                XVMsgCodeF3='".$TF3[0]."',
                XVMsgCodeF4='".$TF4[0]."',
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
                

		        $XVMsgType=$result['XVMsgType'];
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
                    <td><button onclick="SelSms(\''.$result['XVMsgType'].'\',\''.$XVMsgFileName.'\')" type="button" class="btn btn-success btn-sm">เลือก</button></td>';
                $data.='</tr>';
            
        }            
            
        $data.='</tbody>
        </table>
        '; 
        sqlsrv_close( $conn );
        return $data;    

   }
  
?>