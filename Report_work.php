<?php 
date_default_timezone_set("Asia/Bangkok");

include "lib/DatabaseManage.php";


if(!isset($_GET['dtpc'])){$dptm='ALL';}else{$dptm=$_GET['dtpc'];}
if(!isset($_GET['shift'])){$shift='ALL';}else{$shift=$_GET['shift'];}
if(!isset($_GET['customer'])){$customer='ALL';}else{$customer=$_GET['customer'];}
if(!isset($_GET['enddate'])){$enddate=date('Y-m-d');}else{$enddate=$_GET['enddate'];}
if(!isset($_GET['strdate'])){$strdate=date('Y-m-01');}else{$strdate=$_GET['strdate'];}

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
  border: 1px solid #ddd;
  text-align: left;
  font-size: 12px;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 15px;
}
</style>

<page size="A4">



<table id="tableuser" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Username | ชื่อผูัใช้</th>
                <th>Division | แผนก</th>
                <th>Customer | ลูกค้า </th>
                <th width="20%">Shift | กะเวลาทำงาน</th>
                <th width="30%">ประวัติเข้าใช้งานระบบ</th>
   
               
            </tr>
        </thead>
        <tbody>
           <?php 

            $conditions = [];
            $params = [];
            $WHERE="";
         if($dptm!='ALL'){ 
            $conditions[] = "XVDptCode = '$dptm'";
            $params['XVDptCode'] = $dptm;
         }  // departmentid
         if($shift!='ALL'){
            $conditions[] = "XVShfCode = '$shift'";
            $params['XVShfCode'] = $shift;
           } // shiftid
         if($customer!='ALL'){
            $conditions[] = "XVCstCode ='$customer'";
            $params['XVCstCode'] = $customer;
        } // customerid
            if(count($conditions)>0){
                $WHERE = 'WHERE ' . implode(' AND ', $conditions);
            }
           
            $i=1;
            $quser="SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMUser]  $WHERE";
          //  echo $quser;
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
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $arru['XVUsrName']; ?></td>
                <td><?php echo $dpf['XVDptName']?:"-"; ?></td>
                <td><?php echo $csf['XVCstName']?:"-"; ?></td>
                <td><?php echo $shf['XVShfName'].'&nbsp;|&nbsp;'.$timeshf; ?>
                  
            </td>
          <td>
               <?php $tmc=Logtime($UCode,$strdate,$enddate); // function Logtime 
               if(count($tmc)!=0){
               foreach($tmc as $k){
                  echo '<li>'.$k.'</li>';
                 }  // end foreach
               }else{
                echo '<div style="color:red">ไม่พบประวัติเข้าใช้งานระบบ</div>';
               } // if check null array function
               ?>

            </td>
         
           
            </tr>
          <?php $i++;} ?>
        </tfoot>
        
    </table>
  

    <?php  /// timelogin table [NWL_SpeedWayTest2].[dbo].[TLogLogIn] : check range datetime   
                  
                  function Logtime($UCode,$strdate,$enddate){
                  $data=array();
                  $dstr = date('Y-m-d',strtotime($strdate));
                  $dend = date('Y-m-d', strtotime($enddate));
                  include "lib/DatabaseManage.php";
                  $tstm="SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TLogLogIn] WHERE XVUsrCode ='$UCode'AND
                   XTLogInTime   between CONVERT(datetime,'$dstr') AND CONVERT(datetime,'$dend 23:59:59:998') "; 
                  $tstmq=sqlsrv_query($conn,$tstm);
                  while($tm=sqlsrv_fetch_array($tstmq, SQLSRV_FETCH_ASSOC)){
                    $data[]= date_format($tm['XTLogInTime'],"Y/m/d H:i:s");
                  }
                      return $data;
                  }
  ?>