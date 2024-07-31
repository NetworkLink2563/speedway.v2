<?php
date_default_timezone_set('Asia/Bangkok');

include "lib/DatabaseManage.php";

if(!isset($_GET['vmschk'])){$vms='ALL';}else{$vms=$_GET['vmschk'];}
if(!isset($_GET['enddate'])){$enddate=date('Y/m/d');}else{$enddate=$_GET['enddate'];}
if(!isset($_GET['strdate'])){$strdate=date('Y-m-01');}else{$strdate=$_GET['strdate'];}
if(!isset($_GET['TSysSCommand'])){$TSysSCommand='ALL';}else{$TSysSCommand=$_GET['TSysSCommand'];}


?>

<style>
   body {
  background: rgb(204,204,204); 
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  
}
page[size="A4"] {  
  width: 21cm;
  height: 29.7cm; 
  padding: 1cm;
}
@media print {
  body, page {
    background: white;
    margin: 0;
    box-shadow: 0;
  }
}
table, td, th {  
  border: 1px solid black;
  text-align: left;
  font-size: 14px;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 1px;
}
.pagination {
    display: flex;
    justify-content: center;
    padding: 10px 0;
}

/* Links inside pagination */
.pagination a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color 0.3s;
    margin: 0 4px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

/* Add a background color on mouse-over */
.pagination a:hover {
    background-color: #ddd;
}

/* Style for the active/current page */
.pagination a.active {
    background-color: #4CAF50;
    color: white;
    border: 1px solid #4CAF50;
}

/* Add a gray background color to the previous/next buttons 
.pagination a:first-child, .pagination a:last-child {
    background-color: #f1f1f1;
    color: black;
    border: 1px solid #ddd;
}*/

/* Add some space between the pagination container and content */
.pagination + .content {
    margin-top: 20px;
}
</style>

<page size="A4">
   
<?php
$conditions1 = [];
$WHERE1="";
$conditions2 = [];
$WHERE2="";
if($TSysSCommand!='ALL'){ 
$conditions1[] = "XVLctType = '$TSysSCommand'";
}  // XVCmdCode
if($vms!='ALL'){
$conditions1[] = "XVVmsCode = '$vms'";
} // XVVmsCode 
$dstr = date('Y-m-d',strtotime($strdate));
$dend = date('Y-m-d', strtotime($enddate));
?>



<?php if(count($conditions1)>0){
    $WHERE1 =  'AND '.implode(' AND ', $conditions1); 
}
             $i=1;
             $data = array();

             $dtcomm="SELECT XVVmsCode,XVLctTime,XVLctType,XVLctValue2 FROM [NWL_SpeedWayTest2].[dbo].[TLogLVmsAction] WHERE  XVLctTime  between CONVERT(datetime,'$dstr') AND CONVERT(datetime,'$dend 23:59:59:998')  $WHERE1  ";
             $dtqcom=sqlsrv_query($conn,$dtcomm);
          
             while($dtarr=sqlsrv_fetch_array($dtqcom,SQLSRV_FETCH_ASSOC)){
                $j= $dtarr['XVLctValue2'].' /  '.$dtarr['XVLctTime']->format('Y-m-d H:i:s');
                if ( empty($data[$dtarr['XVVmsCode'] ]) ) { 
                    $data[$dtar['XVVmsCode'] ] = array();
                }
                if ( empty( $data[$dtarr['XVVmsCode'] ][$dtarr['XVLctType'] ] ) ) 
                {
                    $data[$dtarr['XVVmsCode'] ][$dtarr['XVLctType'] ] = array();
                }
             
                $data[$dtarr['XVVmsCode'] ][$dtarr['XVLctType'] ][] = $j;
 

             }   
             ?>
  <?php  
     $totalSum = 0;
     $r = 0;
     foreach ( $data as $XVVmsCode => $v ) { 

     $r ="SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMItmVMS] WHERE XVVmsCode='$XVVmsCode' ";
     $dr=sqlsrv_query($conn,$r);
     $dt_=sqlsrv_fetch_array($dr,SQLSRV_FETCH_ASSOC);
     
     if($totalSum!=0){
     echo '<div style="padding-left:4%" >ชื่อป้าย &nbsp;<b style="color:blue">' .$dt_['XVVmsName'] . '</b></div><br/>';
     }
     $totalSum++;
    
    foreach ( $v as $k => $t ) {
   
        $count=count($t);
        $sum = array_sum($t);
        $y ="SELECT *  FROM [NWL_SpeedWayTest2].[dbo].[TSysSCommand] WHERE XVCmdCode='$k' ";
        $y1=sqlsrv_query($conn,$y);
        $y1_=sqlsrv_fetch_array($y1,SQLSRV_FETCH_ASSOC);
        echo '<div style="padding-left:5%" >คำสั่ง &nbsp;<b style="color:blue">' . $y1_['XVCmdName'] . '</b></div><br/>';
        echo '<div style="padding-left:10%">';
        $array = array_slice($t, 0, 5);
        $dt= implode('<li>', $array);
        echo  '<li>'.$dt;
        echo '</div><hr>';
        echo $h;
        $count++;
        $r += $sum;
  } 
}
 ?>
