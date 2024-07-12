<?php
  include "lib/DatabaseManage.php";
  $VmsCode=$_REQUEST["vmscode"];

  $sqlCommandList = "SELECT TOP 5  CONVERT(varchar, [XVLctTime], 120)  as XVLctTime,XVLctValue2  FROM TLogLVmsAction 
  WHERE XVVmsCode='".$VmsCode."' AND XVLctValue1='COMMAND' ORDER BY XVLctTime DESC ";
  

  $queryCommandList= sqlsrv_query($conn, $sqlCommandList);
  $data='<table>';
  $data.='<tr>';
  $data.='<th>วันที่</th>';
  $data.='<th>คำสั่ง</th>';
  $data.='</tr>';
  while($row = sqlsrv_fetch_array($queryCommandList, SQLSRV_FETCH_ASSOC)){
    $data.='<tr><td>'.$row['XVLctTime'].'</td><td>'.$row['XVLctValue2'].'</td></tr>';
  }
  $data.='</table>';
  echo $data;
?>