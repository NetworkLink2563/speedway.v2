<?php

class DatabaseConnect{
     public function ConnectDB() {
          
        
          $serverName = "43.229.151.106"; 
          $dbName="NWL_SpeedWayTest2";
          $userName="DevNwl";
          $userPassword="Nwl!2563";
          $connectionInfo = array("Database"=>$dbName, "UID"=>$userName, "PWD"=>$userPassword, "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');
          $conn = sqlsrv_connect( $serverName, $connectionInfo);
          return $conn;
     }
}
class DatabaseManage {
     public function UpdateDB($sql,$params){
          $ret=False;
          $dbcon = new DatabaseConnect();
          $conn=$dbcon->ConnectDB();
          if($conn){
              
               $stmt = sqlsrv_query( $conn, $sql,$params);
               if( $stmt === false ) {
                    die( print_r( sqlsrv_errors(), true));
                    $ret=False;
               }else{
                    
                    sqlsrv_close($conn);
                    $ret=True;
               }
          }else{
               echo "ConnectError";
               $ret=False; 
          }
          
          return $ret;
     }
     public function Query_DB($sql,$params){ 
          $ret=False; 
          $resultArray = array();
          $dbcon = new DatabaseConnect();
          $conn=$dbcon->ConnectDB();
          if($conn){
                   $query  = sqlsrv_query( $conn, $sql, $params);
                    while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
                         array_push($resultArray,$result);
                    }
                    sqlsrv_close($conn);
          }else{
               echo "Connect Error";
          }
          return json_encode($resultArray);
     }
     public function QueryDB($sql){ 
          $ret=False; 
          $resultArray = array();
          $dbcon = new DatabaseConnect();
          $conn=$dbcon->ConnectDB();
          if($conn){
                  
                   $query  = sqlsrv_query( $conn, $sql);
                  
                    while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){   
                         array_push($resultArray,$result);
                        
                    }
                    
                    sqlsrv_close($conn);
              
          }else{
               echo "Connect Error";
          }
          
          return json_encode($resultArray);
     }
     public function InserDelUpdatetDB($sql){ 
          $ret=False;
          $dbcon = new DatabaseConnect();
          $conn=$dbcon->ConnectDB();    
          if($conn){
               $stmt = sqlsrv_query( $conn, $sql);
               if( $stmt === false ) {
                    $ret=False;
               }else{
                    sqlsrv_close($conn);
                    $ret=True;
               }
          }else{
               $ret=False; 
          }
          
          return $ret;
     }
}

?>

