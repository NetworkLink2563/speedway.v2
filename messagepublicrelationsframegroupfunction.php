<?php
ob_start();
session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST["InsertUpdate"])){
            $XVPltCode=$_POST["XVPltCode"];
            $XVPltName=$_POST["XVPltName"];
            $data=$_POST["data"];
            $XVMssCode=$_POST["XVMssCode"];
            echo InsertUpdate($XVPltCode,$XVPltName,$data,$XVMssCode);
        }
        
        if(isset($_POST["SearchEdit"])){
            $XVPltCode=$_POST["XVPltCode"];
            echo SearchEdit($XVPltCode);
          
        }
        if(isset($_POST["deletesms"])){
            $XVPltCode=$_POST["XVPltCode"];
            echo DeleteSms($XVPltCode);
        }
       
    }
    function RunCode(){
            include "lib/DatabaseManage.php";
            $ptcode="";
            $ProcedSQL = "DECLARE @tCode nvarchar(100)
                EXEC dbo. STP_NWLtGetMaxCode 'TMstMPlaylist', @tCode OUTPUT
                PRINT 'TMstMPlaylist' + '-->' + @tCode
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
    
    function InsertUpdate($XVPltCode,$XVPltName,$data,$XVMssCode){
        $XVWhoCreate=$_SESSION['userName'];
        $XVWhoEdit=$_SESSION['userName'];
        include "lib/DatabaseManage.php";
        if($XVPltCode=='PLTYYMM-####'){
             $XVPltCode=RunCode();
             if($XVPltCode==''){
                $ret='{"Retrune":"InsertError"}';
                return $ret;
                exit();
            }
             $sql="INSERT INTO TMstMPlaylist ( 
                               XVPltCode
                               ,XVPltName
                               ,XVMssCode
                               ,XVPltType
                               ,XVUsrCode
                               ,XVWhoCreate
                               ,XTWhenCreate
               )
               VALUES (
               '$XVPltCode'
               ,'$XVPltName'
                                ,'$XVMssCode'
                                ,'1'
                                ,'$XVWhoCreate'
                                ,'$XVWhoCreate'
                                ,GETDATE() 
               );";
             
             $stmt = sqlsrv_query($conn,  $sql);
             if( $stmt === false ) {
                $ret='{"Retrune":"InsertError"}';
                return $ret; 
                exit();
             }
        }else{
            $sql="DELETE FROM TMstMPlaylistDT WHERE XVPltCode='$XVPltCode';";
            $stmt = sqlsrv_query($conn,  $sql);
            if( $stmt === false ) {
               $ret='{"Retrune":"InsertError"}';
               return $ret; 
               exit();
            }
        }
       

       
        $obj=json_decode($data);
        $counterr=0;
        if(count($obj)>0){
            foreach ($obj as $row) {
                  $XVMsfCode=$row->XVMsfCode;
                  $XIPltSeqNo=$row->XIPltSeqNo;
                  $XBPltHasExpiration=$row->XBPltHasExpiration;
                  $XTPltStart=$row->XTPltStart;
                  $XTPltEnd=$row->XTPltEnd;
                  $XIPltDuration=$row->XIPltDuration;
                  if($XBPltHasExpiration==1){
                        
                            $sql="INSERT INTO TMstMPlaylistDT ( 
                                                    XVPltCode
                                                ,XIPltSeqNo
                                                ,XIPltOrder
                                                ,XVMsfCode
                                                ,XIPltDuration
                                                ,XBPltHasExpiration
                                                ,XTPltStart
                                                ,XTPltEnd
                                                )
                                                VALUES (
                                                '$XVPltCode'
                                                ,$XIPltSeqNo
                                                ,$XIPltSeqNo
                                                ,'$XVMsfCode'  
                                                ,$XIPltDuration
                                                ,$XBPltHasExpiration
                                                ,'$XTPltStart'
                                                ,'$XTPltEnd'   
                                                );";
                        
                  }else{
                                $sql="INSERT INTO TMstMPlaylistDT ( 
                                    XVPltCode
                                ,XIPltSeqNo
                                ,XIPltOrder
                                ,XVMsfCode
                                ,XIPltDuration
                                ,XBPltHasExpiration
                               
                                )
                                VALUES (
                                '$XVPltCode'
                                ,$XIPltSeqNo
                                ,$XIPltSeqNo
                                ,'$XVMsfCode'  
                                ,$XIPltDuration
                                ,$XBPltHasExpiration
                               
                                );";
                  }
               
                $stmt = sqlsrv_query($conn,  $sql);
                if( $stmt === false ) {

                    $ret='{"Retrune":"InsertError"}';
                    $counterr++;
                    break;
                   // die( print_r( sqlsrv_errors(), true));
                   
                }
            }
        }
        if($counterr==0){
            $ret='{"Retrune":"'.$XVPltCode.'"}';
        }else{
            $ret='{"Retrune":"InsertError"}';
        }
        sqlsrv_close( $conn );
        return  $ret;
    }
    function SearchEdit($XVPltCode){
        include "lib/DatabaseManage.php";
        $sql="SELECT        dbo.TMstMPlaylistDT.XVPltCode, dbo.TMstMPlaylistDT.XIPltSeqNo, dbo.TMstMPlaylistDT.XIPltOrder, dbo.TMstMPlaylistDT.XVMsfCode, dbo.TMstMPlaylistDT.XIPltDuration, dbo.TMstMPlaylistDT.XBPltHasExpiration, 
                  CONVERT(varchar, dbo.TMstMPlaylistDT.XTPltStart, 120)  as XTPltStart, CONVERT(varchar, dbo.TMstMPlaylistDT.XTPltEnd, 120)  AS XTPltEnd, dbo.TMstMMessageFrame.XVMsfName
        FROM            dbo.TMstMMessageFrame INNER JOIN
                         dbo.TMstMPlaylistDT ON dbo.TMstMMessageFrame.XVMsfCode = dbo.TMstMPlaylistDT.XVMsfCode
        WHERE        (dbo.TMstMPlaylistDT.XVPltCode = '$XVPltCode') order by XIPltSeqNo";
     
        include "lib/DatabaseManage.php";
        $query = sqlsrv_query($conn, $sql);
        $data='[';
        while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
        { 
            $data.='{';
            $data.='"XVPltCode":"'.$result["XVPltCode"].'",';
            $data.='"XIPltSeqNo":"'.$result["XIPltSeqNo"].'",';
            $data.='"XVMsfCode":"'.$result["XVMsfCode"].'",';
            $data.='"XVMsfName":"'.$result["XVMsfName"].'",';
            $data.='"XIPltDuration":"'.$result["XIPltDuration"].'",';
                
          
            $data.='"XBPltHasExpiration":"'.$result["XBPltHasExpiration"].'",';
             
            $data.='"XTPltStart":"'.$result["XTPltStart"].'",';
            
            $data.='"XTPltEnd":"'.$result["XTPltEnd"].'"';
             
            $data.='},';
            
        }
       
        $tmp=substr($data,0, strlen($data)-1) ;
        $data=$tmp.']';
        sqlsrv_close( $conn );
        
        return   $data;
    }
    
    function DeleteSms($XVPltCode){
        include "lib/DatabaseManage.php";
        
        

        $sql="SELECT dbo.TMstMPlaylist.XVPltCode, dbo.TMstMPlaylist.XVPltName, dbo.TMstMItmVMSPlayList.XVVmsCode, dbo.TMstMItmVMS.XVVmsName
              FROM  dbo.TMstMPlaylist INNER JOIN
                         dbo.TMstMItmVMSPlayList ON dbo.TMstMPlaylist.XVPltCode = dbo.TMstMItmVMSPlayList.XVPltCode INNER JOIN
                         dbo.TMstMItmVMS ON dbo.TMstMItmVMSPlayList.XVVmsCode = dbo.TMstMItmVMS.XVVmsCode
        WHERE (dbo.TMstMPlaylist.XVPltCode = '$XVPltCode')";
        $query = sqlsrv_query($conn, $sql);
        $count=0;
        while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
            $count++;
            $XVVmsName=$result["XVVmsCode"]." ".$result["XVVmsName"];
            break;
        }
        if($count>0){
            $ret='{"Return":"'.$XVVmsName.'"}';
            return $ret;
            exit(); 
        }    
        $sql="DELETE FROM TMstMPlaylist WHERE XVPltCode='$XVPltCode'";
        $query = sqlsrv_query($conn, $sql);
        $sql="DELETE FROM TMstMPlaylistDT WHERE XVPltCode='$XVPltCode'";
        $query = sqlsrv_query($conn, $sql);
        $ret='{"Return":"DeleteSuccess"}';
        sqlsrv_close( $conn );
        return  $ret;
    }
        
?>