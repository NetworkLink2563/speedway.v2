<?php

class DatabaseConnect{
     public function ConnectDB() {
          
        
       $serverName = "85.204.247.82,64433";
       $userName = 'DevNwl';
       $userPassword = 'Nwl!2563';
       $dbName = "NWL_SpeedWayTest2";
          $connectionInfo = array("Database"=>$dbName, "UID"=>$userName, "PWD"=>$userPassword, "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');
          $conn = sqlsrv_connect( $serverName, $connectionInfo);
          
          return $conn;
     }
}
class DatabaseManage {
     
     
     public function QueryDBArr($sql){ 
        
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
          
          return $resultArray;
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

