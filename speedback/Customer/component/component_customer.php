<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<?php /*
//////////// Log Edit ////////////////
FILE NAME : module_customer.php 
Create By : Sivadol.J 
Log Edit  : Create 07/25/2024    
/////////////////////////////////////
*/

$m = 'customer';
$c="default";
require("../config/config.NWL_SpeedWayTest2.php");
if (!isset($_GET['c'])) {
    $c = 'default';
} else {
    $c = $_GET['c'];
}
if (!isset($_GET['MM'])) {
    $MM = (int) date("m");
} else {
    $MM = $_GET['MM'];
}
if (!isset($_GET['YYYY'])) {
    $YYYY = (int) date("Y");
} else {
    $YYYY = $_GET['YYYY'];
}

if (isset($_GET['reservation'])) {
    //get range date
    $reservation = $_GET['reservation'];
    $DB = substr($reservation, 0, 10);
    $date_db = date_create($DB);
    $DB = date_format($date_db, "Y-m-d");
    $DBS = date_format($date_db, "m/d/Y");
    $DF = substr($reservation, -10);
    $date_df = date_create($DF);
    $DF = date_format($date_df, "Y-m-d");
    $DBF = date_format($date_df, "m/d/Y");
} else {//case select auto

    $DB = date("Y-m-01");
    $DBS = date("m/01/Y");
    $DF = date("Y-m-30");
    $DBF = date("m/30/Y");
}

if(!isset($_GET['customer'])){ $customerf='All';}else{ $customerf=$_GET['customer']; }
if(!isset($_GET['customerstatus'])){ $statusf='All';}else{ $statusf=$_GET['customerstatus']; }

?>
<script type="text/JavaScript"> $(document).ready(function() { 
   //alert('test');
     $('#tlbc').DataTable( { 
     } );  }); 
     </script>
<style>

 th,td,span{
    font-size: 13px;
 }

</style>
<script src="http://127.0.0.1/speedback/Customer/js/customer.js"></script>
<div class="title_left" style="padding-left: 2%;" >
<h3><a href="?m=customer" >Customer  Manager</a>   <small>(Customer Control)</small></h3>
</div>
<div style="text-align: right;">
<a href="#newcustomer" class="btn btn-primary" role="button" data-toggle="modal" data-target="#newcustomer" > <i class="fa fa-pencil"></i>เพิ่มข้อมูลลูกค้า</a>

</div>
<div class="x_panel">
    
<div class="x_title">
   
    <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                aria-expanded="false"><i class="fa fa-wrench"></i></a>
            <ul class="dropdown-menu" role="menu">
                <li><a class="dropdown-item" href="#">สิทธิ์การใช้งาน</a>
                </li>
                <li><a class="dropdown-item" href="#">คู่มือการใช้งานระบบ</a>
                </li>
            </ul>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
    </ul>
    <div class="clearfix"></div>
</div>

<div class="x_content">
    <form class="form-inline" id="form1" name="form1" method="get" action="" enctype="multipart/form-data">
        <input type="hidden" value="<?php echo $m; ?>" id="m" name="m" />
        <input type="hidden" value="<?php echo $c; ?>" id="c" name="c" />
        <div class="row">

            <div class="input-group col-md-2 col-sm-2 col-xs-2">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default" disabled=""><i class="fa fa-filter"></i> ตัวกรอง |
                        ชื่อลูกค้า : </button>
                </span>

                <select name="customer" id="customer" class="form-control" style="width:auto;">
                    <option value="All">ทั้งหมด</option>
                <?php 
                  $cus1="SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMCustomer]  ORDER BY XVCstName ASC ";
                  $cusq=sqlsrv_query($conn,$cus1);
                  while($cusq1=sqlsrv_fetch_array($cusq,SQLSRV_FETCH_ASSOC)){ ?>
                       <option <?php if($customerf==$cusq1['XVCstCode']){ echo 'selected=selected';} ?> value="<?php echo $cusq1['XVCstCode']; ?>"><?php echo $cusq1['XVCstName'];?></option>;
                <?php   }
                 ?>
                </select>
            </div> <div class="input-group col-md-2 col-sm-2 col-xs-2">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default" disabled=""><i class="fa fa-filter"></i>สถานะการใช้งาน: </button>
                </span>
                <select name="customerstatus" id="customerstatus" class="form-control" style="width:auto;">
                <option value="All">เลือก</option>    
                <option <?php if($statusf=='1'){ echo 'selected=selected';} ?> value="1">ใช้งาน</option>
                <option  <?php if($statusf=='0'){ echo 'selected=selected';} ?> value="0">ยกเลิกใช้งาน</option>  
            </select>
            </div>
            <div class="input-group col-md-2 col-sm-2 col-xs-2">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default" disabled=""> <i
                            class="glyphicon glyphicon-calendar fa fa-calendar"></i> Range Date </button> </span>
                <input type="text" style="width: 180px" name="reservation" id="reservation" class="form-control"
                    value="<?php echo $DBS . " - " . $DBF; ?>" data-toggle="tooltip"
                    data-original-title="ดด/วว/ปปปป - ดด/วว/ปปปป">
            </div>

            <div class="input-group col-md-1 col-sm-1 col-xs-1">
                <span class="input-group-btn" style="width: 200px;">
                    <button type="submit" name="submit" class="form-control btn btn-success">Search</button>
                </span>
            </div>
        </div>
    </form>
  
    <div class="table-responsive">
        <table id="tlbc" class="table table-striped table-bordered dataTable no-footer">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>รหัสลูกค้า</th>
                    <th>ชื่อลูกค้า</th>
                    <th>รายละเอียดลูกค้า</th>
                    <th>เบอร์โทรลูกค้า</th>
                    <th>อีเมลลูกค้า</th>
                    <th>ผู้สร้าง</th>
                    <th>เวลาที่สร้าง</th>
                    <th>สถานะการใช้งาน</th>
                    <th>เครื่องมือ</th>
                </tr>
            </thead>
            <tbody>
            <?php
        /*     
      filter XVCstName/XBCstIsActive get form 
     input attr(name)-> customer[XVCstCode], 
     input attr(name)->customerstatus[XBCstIsActive] */ 

    //echo $DBS.'+-'.$DBF;
 
    $conditions1 = [];
    $WHERE1="";
    $conditions2 = [];
    $WHERE2="";
    if($customerf!='All'){ 
    $conditions1[] = "XVCstCode = '$customerf'";
    }  // XVCmdCode
    if($statusf!='All'){
    $conditions1[] = "XBCstIsActive = '$statusf'";
    } // XVVmsCode 
    $dstr = date('Y-m-d',strtotime($DBS));
    $dend = date('Y-m-d', strtotime($DBF));
    if ($reservation!=''){
        $conditions1[] = "XTWhenCreate  between CONVERT(datetime,'$dstr') AND CONVERT(datetime,'$dend 23:59:59:998')";
     }else{
        //$Q1="WHERE ";
     }

    if(count($conditions1)>0){
        $WHERE1 =  'WHERE '.implode(' AND ', $conditions1); 
    }
    $i=1;
    $q="SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMCustomer] $WHERE1 ";
    //echo $q;
    $qcust = sqlsrv_query($conn, $q);
     if ($stmt === false) {die(print_r(sqlsrv_errors(), true));}
     while($arr = sqlsrv_fetch_array($qcust, SQLSRV_FETCH_ASSOC)){
     ?>
                <tr>
                    <th scope="row"><?php echo  $i; ?></th>
                    <td><?php echo $arr['XVCstCode']; ?></td>
                    <td><?php echo $arr['XVCstName']; ?></td>
                    <td><?php echo $arr['XVCstDescription']; ?></td>
                    <td><?php echo $arr['XVCstPhone']; ?></td>
                    <td><?php echo $arr['XVCstEmail']; ?></td>
                    <td><?php echo $arr['XVWhoCreate']; ?></td>
                    <td><?php echo date_format($arr['XTWhenCreate'],"Y/m/d H:i:s");?></td>
                    <td style="text-align: center;"><?php if($arr['XBCstIsActive']==1) {?> 
                        <span class="badge badge-success"  style=" background-color:green; color:white; width:65%" >ใช้งาน</span>
                        <?php }else{ ?>
                            <span class="badge badge-danger"   style="background-color:red; color:white;" >ยกเลิกใช้งาน</span>
                       <?php } ?>
                    </td>
                    <td><div style="text-align:center;">
                            <ul class="nav navbar-right panel_toolbox">
                            <li><a href=""  target="_blank" ><i class="fa fa-search"></i></a>
                             </li>
                            <li class="dropdown">
                                
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true"><i class="glyphicon glyphicon-option-vertical"></i></a>
                                                <ul class="dropdown-menu" role="menu">
                                                        <li role="presentation"><a   tabindex="-1" role="dialog" data-toggle="modal" onclick="edit('<?php echo $arr['XVCstCode']; ?>')"><i class="fa fa-pencil"></i>แก้ไข</a> </li>
                                                        <li role="presentation" class="divider"></li>
                                                        <li role="presentation"><a onclick="delcust('<?php echo $arr['XVCstCode']; ?>')" ><i class="fa fa-trash"></i> Delete</a>  </li>
                                                </ul>
                                            </li>


                                        </ul>

                                    </div></td>
                </tr>
                <?php  $i++;} ?>
            </tbody>
        </table>
    </div>
</div>
</div>
<?php include("../Customer/subpage/customer_edit_popup.php"); ?>
<?php include("../Customer/subpage/customer_new_popup.php"); ?>
<?php include("../core/modalfacebox.php"); ?>
