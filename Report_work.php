<?php 
date_default_timezone_set("Asia/Bangkok");

include "lib/DatabaseManage.php";


if(!isset($_GET['userid'])){$userid='ALL';}else{$userid=$_GET['userid'];}
if(!isset($_GET['enddate'])){$enddate=date('Y-m-d');}else{$enddate=$_GET['enddate'];}
if(!isset($_GET['strdate'])){$strdate=date('Y-m-01');}else{$strdate=$_GET['strdate'];}
if(isset($_GET['page'])){$page=$_GET['page'];}else{$page=1;}
if(isset($_GET['pagechk'])){$pagechk=$_GET['page'];}else{$pagechk=1;}
/// timelogin table [NWL_SpeedWayTest2].[dbo].[TLogLogIn] : check range datetime   
                  

  $data=array();
  $dstr = date('Y-m-d',strtotime($strdate));
  $dend = date('Y-m-d', strtotime($enddate));
 
  $x="SELECT count(*) as cp FROM [NWL_SpeedWayTest2].[dbo].[TLogLogIn] WHERE XVUsrCode ='$userid'AND
  XTLogInTime   between CONVERT(datetime,'$dstr') AND CONVERT(datetime,'$dend 23:59:59:998') "; 
  $xq=sqlsrv_query($conn,$x);
  $xa=sqlsrv_fetch_array($xq, SQLSRV_FETCH_ASSOC);


 
  

  $countdata = $xa['cp'];
  $perpage= 40 ;
  $start_p = ($page-1)* $perpage;
  $total_p = ceil($countdata/ $perpage);
  $d=$perpage*1;
  $s=$start_p*1;
 // echo $d.'-'.$s; 

  $tstm="SELECT  * FROM [NWL_SpeedWayTest2].[dbo].[TLogLogIn] WHERE XVUsrCode ='$userid'AND
  XTLogInTime   between CONVERT(datetime,'$dstr') AND CONVERT(datetime,'$dend 23:59:59:998') ORDER BY XVUsrCode,XTLogInTime OFFSET $s ROWS FETCH NEXT  $d ROWS ONLY;"; 

  $tstmq=sqlsrv_query($conn,$tstm);
  while($tm=sqlsrv_fetch_array($tstmq, SQLSRV_FETCH_ASSOC)){
    $data[]= date_format($tm['XTLogInTime'],"Y/m/d H:i:s");
  }
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
  padding: 4px;
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

<table id="tableuser" class="table table-striped" style="width:100%">
        <thead>
          <tr colspan="2">
          <th>ชื่อผู้ใช้งาน : <b style="color:blue;"><?php echo $userid; ?></b>
        </th>
          </tr>
            <tr>
            
                <th width="30%">ประวัติเข้าใช้งานระบบ</th>
            </tr>
        </thead>
        <tbody>
           <?php 

            $conditions = [];
            $params = [];
            $WHERE="";
        
         if($customer!='ALL'){
            $conditions[] = "XVCstCode ='$customer'";
            $params['XVCstCode'] = $customer;
        } // customerid
            if(count($conditions)>0){
                $WHERE = 'WHERE ' . implode(' AND ', $conditions);
            }
           
            $i=1;
            $quser="SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMUser] WHERE  XVUsrCode ='$userid'";
          // echo $quser;
            $quser_=sqlsrv_query($conn,$quser);
           // echo sqlsrv_num_rows($quser_);
            while($arru=sqlsrv_fetch_array($quser_, SQLSRV_FETCH_ASSOC)){
                    //XVUsrCode //
                    $UCode=$arru['XVUsrCode'];
                    /// customer ///
                    $cstid= $arru['XVCstCode'];
                    $cus="SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMCustomer] WHERE XVCstCode='$cstid'";
                    $csq=sqlsrv_query($conn,$cus);
                    $csf=sqlsrv_fetch_array($csq,SQLSRV_FETCH_ASSOC);
                    ///Department ///
                    $dptid= $arru['XVDptCode'];
                    $dps="SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMDepartment] WHERE XVDptCode='$dptid'";
                    $dpq=sqlsrv_query($conn,$dps);
                    $dpf=sqlsrv_fetch_array($dpq,SQLSRV_FETCH_ASSOC);
                    /// Shift time user ///
                    $shtid= $arru['XVShfCode'];
                    $shfs="SELECT *  FROM [NWL_SpeedWayTest2].[dbo].[TMstMShift] WHERE XVShfCode='$shtid'";
                    $shfq=sqlsrv_query($conn,$shfs);
                    $shf=sqlsrv_fetch_array( $shfq,SQLSRV_FETCH_ASSOC);

                    $timeshf='[&nbsp;'.str_pad($shf['XIShfStartHour'],2,"0",STR_PAD_LEFT).':'
                    .str_pad($shf['XIShfStartMin'],2,"0",STR_PAD_LEFT).'&nbsp;|&nbsp;'
                    .str_pad($shf['XIShfEndHour'],2,"0",STR_PAD_LEFT).':'
                    .Str_pad($shf['XIShfEndMin'],2,"0",STR_PAD_LEFT).'&nbsp;]';
                    ?>
        
          <td>
               <?php  // function Logtime 
               $io=1;
               if(count($data)!=0){
               foreach($data as $k){
                  echo '<li style="padding:4px;">'.$k.'</li>';
                
                  $io++;}  // end foreach
               }else{
                echo '<div style="color:red">ไม่พบประวัติเข้าใช้งานระบบ</div>';
               } // if check null array function
               ?>

            </td>
          
            </tr>
          <?php $i++;} ?>
        </tfoot>
        
    </table>
  
    
    <div class="pagination">
  <?php for($p=1; $p<=$total_p;$p++){ ?>
   <a href="Report_work.php?userid=<?php echo $userid; ?>&strdate=<?php echo $strdate; ?>&enddate=<?php echo $enddate;  ?>&page=<?php echo $p; ?>&pagechk=<?php echo $pagechk; ?>"><?php echo $p; ?></a>
 <?php } ?>
 </div>