<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<?php /*
//////////// Log Edit ////////////////
FILE NAME : module_user.php 
Create By : Sivadol.J 
Log Edit  : Create 07/25/2024    
/////////////////////////////////////
*/
if (!isset($_GET['m'])) {
    $m = 'user';
} else {
    $m = $_GET['m'];
}

$c = "default";
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
} else { //case select auto

    $DB = date("Y-m-01");
    $DBS = date("m/01/Y");
    $DF = date("Y-m-30");
    $DBF = date("m/30/Y");
}
if(!isset($_GET['projv'])){ $projv='All';}else{ $projv=$_GET['projv']; }
if(!isset($_GET['departv'])){ $departv='All';}else{ $departv=$_GET['departv']; }
if(!isset($_GET['stav'])){ $stav='All';}else{ $stav=$_GET['stav']; }
if(!isset($_GET['customerv'])){ $customerv='All';}else{ $customerv=$_GET['customerv']; }
?>
<script type="text/JavaScript"> $(document).ready(function() { 
   //alert('test');
     $('#tlbuser').DataTable( { 
     } );  }); 
     </script>
<style>
    th,
    td,
    span {
        font-size: 13px;
    }
</style>
<script src="http://127.0.0.1/speedback/User/js/user.js"></script>
<div class="title_left" style="padding-left: 2%;">
    <h3>User Manager <small>(User control)</small></h3>
</div>
<div style="text-align: right;">
    <a href="#newshifttime" class="btn btn btn-info" role="button" data-toggle="modal" data-target="#newshifttime"> <i class="fa fa-sun-o"></i> ตั้งค่ากะการทำงาน</a>
    <a href="#newDepartment" class="btn btn-success" role="button" data-toggle="modal" data-target="#newDepartment"> <i class="fa fa-sun-o"></i> ตั้งค่าแผนก</a>
    <a href="#newuser" class="btn btn-primary" role="button" data-toggle="modal" data-target="#newuser"> <i class="fa fa-users"></i> เพิ่มผู้ใช้งาน</a>
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
                            สถานะ : </button>
                    </span>

                    <select name="stav" id="stav" class="form-control" style="width:auto;">
                    <option value="All">เลือก</option>
                     <option value="1" <?php if($stav=='1'){ echo 'selected=seleted';} ?>>ใช้งาน</option>
                     <option value="0" <?php if($stav=='0'){ echo 'selected=seleted';} ?>>ยกเลิกใช้งาน</option>
                    </select>
                </div>
            <div class="input-group col-md-2 col-sm-2 col-xs-2">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default" disabled=""><i class="fa fa-filter"></i> ตัวกรอง |
                            แผนก : </button>
                    </span>

                    <select name="departv" id="departv" class="form-control" style="width:auto;">
                    <option value="All">เลือก</option>
                        <?php 
                        $depr="SELECT *   FROM [TMstMDepartment]"; 
                        $deprq=sqlsrv_query($conn, $depr);
                        while($depx=sqlsrv_fetch_array($deprq, SQLSRV_FETCH_ASSOC)){?> 
                          <option value="<?php echo $depx['XVDptCode']; ?>" <?php if($departv==$depx['XVDptCode']){ echo 'selected=seleted';} ?> ><?php echo $depx['XVDptName']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input-group col-md-2 col-sm-2 col-xs-2">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default" disabled=""><i class="fa fa-filter"></i> ตัวกรอง |
                            โครงการ : </button>
                    </span>

                    <select name="projv" id="projv" class="form-control" style="width:auto;">
                    <option value="All">เลือก</option>
                        <?php 
                        $proj="SELECT *   FROM TMstMProject"; 
                        $projq=sqlsrv_query($conn, $proj);
                        while($proarr=sqlsrv_fetch_array($projq, SQLSRV_FETCH_ASSOC)){?> 
                          <option value="<?php echo $proarr['XVPrjCode']; ?>" <?php if($projv==$proarr['XVPrjCode']){ echo 'selected=seleted';} ?>><?php echo $proarr['XVPrjName']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input-group col-md-2 col-sm-2 col-xs-2">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default" disabled=""><i class="fa fa-filter"></i> ตัวกรอง |
                            ลูกค้า : </button>
                    </span>

                    <select name="customerv" id="customerv" class="form-control" style="width:auto;">
                    <option value="All">เลือก</option>
                        <?php 
                        $cust="SELECT *   FROM [NWL_SpeedWayTest2].[dbo].[TMstMCustomer]"; 
                        $custq=sqlsrv_query($conn, $cust);
                        while($cusar=sqlsrv_fetch_array($custq, SQLSRV_FETCH_ASSOC)){?> 
                          <option value="<?php echo $cusar['XVCstCode']; ?>" <?php if($customerv==$cusar['XVCstCode']){ echo 'selected=seleted';} ?>><?php echo $cusar['XVCstName']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            

                <div class="input-group col-md-1 col-sm-1 col-xs-1">
                    <span class="input-group-btn" style="width: 200px;">
                        <button type="submit" name="submit" class="form-control btn btn-success">Search</button>
                    </span>
                </div>
            </div>
        </form>
  <?php
 
 
  $conditions1 = [];
  $WHERE1="";
  if($projv!='All'){ 
  $conditions1[] = "XVUsrDefaultPrj = '$projv'";
  }  // XVCmdCode
  if($departv!='All'){
  $conditions1[] = "XVDptCode = '$departv'";
  } // XVVmsCode 
  if($stav!='All'){
    $conditions1[] = "XBUsrIsActive = '$stav'";
    } 
    if($customerv!='All'){
        $conditions1[] = "XVCstCode = '$customerv'";
        }
 

  if(count($conditions1)>0){
      $WHERE1 =  "WHERE  XVUsrCode='" . $_SESSION['XVUsrCode'] . "'"; 
      $WHERE2 = 'WHERE '.implode(' OR ', $conditions1) ." AND XVUsrCode !='" . $_SESSION['XVUsrCode'] . "'";
  } else{
     $WHERE1 = "WHERE XVUsrCode='" . $_SESSION['XVUsrCode'] . "'";
     $WHERE2 = "WHERE XVUsrCode !='" . $_SESSION['XVUsrCode'] . "'";
  }
  
  ?>
        <div class="table-responsive">
            <table id="tlbuser" class="table table-striped table-bordered dataTable no-footer">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>รหัสผู้ใช้อีเมล</th>
                        <th>ชื่อผู้ใช้งาน</th>
                        <th>แผนก</th>
                        <th>โครงการ / ลูกค้า</th>
                        <th>กะเวลาทำงาน</th>
                        <th style="text-align: center;">เวลาใช้งานล่าสุด</th>
                        <th style="text-align: center;">สถานะการใช้งาน</th>
                        <th style="text-align: center;">เครื่องมือ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    function proj($idproj){
                        require("../config/config.NWL_SpeedWayTest2.php");
                        $f1="SELECT XVPrjName FROM [dbo].[TMstMProject] WHERE XVPrjCode ='$idproj'";
                        $f1q=sqlsrv_query($conn, $f1);
                        $f1ar=sqlsrv_fetch_array($f1q, SQLSRV_FETCH_ASSOC);
                        return $f1ar['XVPrjName'];
                    }
                    $i = 1;
                    if(count($conditions1)==0){
                    if ($i == 1) {
                        $i = 1;
                        $quserd = "SELECT * FROM [TMstMUser] $WHERE1 ";
                        $quser1i = sqlsrv_query($conn, $quserd);
                        $arrxv = sqlsrv_fetch_array($quser1i, SQLSRV_FETCH_ASSOC);
                        $timelog = "SELECT TOP (1) *   FROM [TLogLogIn] WHERE XVUsrCode='" . $_SESSION['XVUsrCode'] . "' ORDER BY XTLogInTime DESC";
                        $timeq = sqlsrv_query($conn, $timelog);
                        $qtime_ = sqlsrv_fetch_array($timeq, SQLSRV_FETCH_ASSOC);
                        $timelog= date_format($qtime_['XTLogInTime'], "Y-m-d H:i:s") ?: "0000-00-00 00:00:00";
                        $cus = "SELECT * FROM [TMstMCustomer] WHERE XVCstCode='" . $arrxv['XVCstCode'] . "'";
                        $cusq = sqlsrv_query($conn, $cus);
                        $cusqr = sqlsrv_fetch_array($cusq, SQLSRV_FETCH_ASSOC);

                         ?>
                        <tr style="background-color:#f7e1e1;">
                            <th scope="row"><?php echo '1' ?></th>
                            <td><?php echo $arrxv['XVUsrCode']; ?></td>
                            <td><?php echo $arrxv['XVUsrName']; ?></td>
                            <td><?php
                                $dept1 = "SELECT *   FROM [TMstMDepartment] WHERE XVDptCode='" . $arrxv['XVDptCode'] . "'";
                                $dqp = sqlsrv_query($conn, $dept1);
                                $dqp1 = sqlsrv_fetch_array($dqp, SQLSRV_FETCH_ASSOC);
                                echo $dqp1['XVDptName'] ?: "-"; ?>
                                </td>
                            <td><?php echo proj($arrxv['XVUsrDefaultPrj']).'&nbsp/<b>&nbsp'.$cusqr['XVCstName']; ?></td>
                            
                            <td style=" color: green; font-weight: 600;" ><?php
                             $shf="SELECT *  FROM [NWL_SpeedWayTest2].[dbo].[TMstMShift] WHERE XVShfCode='".$arrxv['XVShfCode']."' ";
                             $qshf=sqlsrv_query($conn,$shf);
                             $qar=sqlsrv_fetch_array($qshf, SQLSRV_FETCH_ASSOC);
                             $timeshf='[&nbsp;'.str_pad($qar['XIShfStartHour'],2,"0",STR_PAD_LEFT).':'
                             .str_pad($qar['XIShfStartMin'],2,"0",STR_PAD_LEFT).'&nbsp;|&nbsp;'
                             .str_pad($qar['XIShfEndHour'],2,"0",STR_PAD_LEFT).':'
                             .Str_pad($qar['XIShfEndMin'],2,"0",STR_PAD_LEFT).'&nbsp;]';
                             echo $qar['XVShfName'].'&nbsp'.$timeshf ;
                            ?></td>
                            <td style="text-align: center;">
                                <?php echo '<code>'.$timelog.'</code>';  ?>
                            </td>
                            <td style="text-align: center;"><?php if ($arrxv['XBUsrIsActive'] == 1) { ?>
                                    <span style="background-color:green; color:white;" class="badge">ใช้งาน</span>
                                <?php } else { ?>
                                    <span style="background-color:red; color:white;" class="badge">ยกเลิกใช้งาน</span>
                                <?php } ?>
                            </td>
                            <td>
                                <div style="text-align:center;">
                                    <ul class="nav navbar-right panel_toolbox">
                                        <!--<li><a href=""  target="_blank" ><i class="fa fa-search"></i></a>
                                         </li>-->
                                        <li class="dropdown">

                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true"><i class="glyphicon glyphicon-option-vertical"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li role="presentation"><a onclick="edituser('<?php echo $arrxv['XVUsrCode']; ?>')"><i class="fa fa-pencil"></i>แก้ไข</a> </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php  }
                    $i = 2;
                                } // end if count array
                    $quser = "SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMUser] $WHERE2 ";
                    $quser1 = sqlsrv_query($conn, $quser);
                    if ($quser1 === false) {
                        die(print_r(sqlsrv_errors(), true));
                    }
                    while ($arruser = sqlsrv_fetch_array($quser1, SQLSRV_FETCH_ASSOC)) { 
                        $timelogx = "SELECT TOP (1) *   FROM [TLogLogIn] WHERE XVUsrCode='" . $arruser['XVUsrCode'] . "' ORDER BY XTLogInTime DESC ";
                        $timeqx = sqlsrv_query($conn, $timelogx);
                        $qtime_x = sqlsrv_fetch_array($timeqx, SQLSRV_FETCH_ASSOC);
                        $datelog_=date_format($qtime_x['XTLogInTime'], "Y-m-d H:i:s") ?: "0000-00-00 00:00:00";
                        ?>
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                           
                            <td><?php echo $arruser['XVUsrCode']; ?></td>
                            <td><?php echo $arruser['XVUsrName']; ?></td>
                            <td><?php
                                $dept1x = "SELECT *   FROM [TMstMDepartment] WHERE XVDptCode='" . $arruser['XVDptCode'] . "'";
                                $dqpx = sqlsrv_query($conn, $dept1x);
                                $dqp1x = sqlsrv_fetch_array($dqpx, SQLSRV_FETCH_ASSOC);
                                echo $dqp1x['XVDptName'] ?: '-';
                                ?></td>
                            <td><?php
                                $cusx = "SELECT * FROM [TMstMCustomer] WHERE XVCstCode='" . $arruser['XVCstCode'] . "'";
                                $cusqx = sqlsrv_query($conn, $cusx);
                                $cusqrx = sqlsrv_fetch_array($cusqx, SQLSRV_FETCH_ASSOC);
                                echo proj($arruser['XVUsrDefaultPrj']).'&nbsp/<b>&nbsp'.$cusqrx['XVCstName']; ?></td>
                            <td  style=" color: green; font-weight: 600;" ><?php
                             $shf="SELECT *  FROM [NWL_SpeedWayTest2].[dbo].[TMstMShift] WHERE XVShfCode='".$arruser['XVShfCode']."' ";
                             $qshf=sqlsrv_query($conn,$shf);
                             $qar=sqlsrv_fetch_array($qshf, SQLSRV_FETCH_ASSOC);
                             $timeshf='[&nbsp;'.str_pad($qar['XIShfStartHour'],2,"0",STR_PAD_LEFT).':'
                             .str_pad($qar['XIShfStartMin'],2,"0",STR_PAD_LEFT).'&nbsp;|&nbsp;'
                             .str_pad($qar['XIShfEndHour'],2,"0",STR_PAD_LEFT).':'
                             .Str_pad($qar['XIShfEndMin'],2,"0",STR_PAD_LEFT).'&nbsp;]';
                             echo $qar['XVShfName'].'&nbsp'.$timeshf ;
                            ?></td>
                            <td style="text-align: center;">
                                <?php echo '<code>'.$datelog_.'</code>';?>
                            </td>
                            <td style="text-align: center;"><?php if ($arruser['XBUsrIsActive'] == 1) { ?>
                                    <span style="background-color:green; color:white;" class="badge">ใช้งาน</span>
                                <?php } else { ?>
                                    <span style="background-color:red; color:white;" class="badge">ยกเลิกใช้งาน</span>
                                <?php } ?>
                            </td>
                            <td>
                                <div style="text-align:center;">
                                    <ul class="nav navbar-right panel_toolbox">
                                        <!--<li><a href=""  target="_blank" ><i class="fa fa-search"></i></a> </li>-->
                                        <li class="dropdown">

                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true"><i class="glyphicon glyphicon-option-vertical"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li role="presentation"><a onclick="edituser('<?php echo $arruser['XVUsrCode']; ?>')"><i class="fa fa-pencil"></i>แก้ไข</a> </li>
                                         
                                              
                                            </ul>
                                        </li>


                                    </ul>

                                </div>
                            </td>
                        </tr>
                    <?php $i++;
                    }  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include("../User/subpage/user_shifttime_new_popup.php"); ?>
<?php include("../User/subpage/user_depart_new_popup.php"); ?>
<?php include("../User/subpage/user_new_popup.php"); ?>
<?php include("../User/subpage/user_edit_popup.php"); ?>
<?php include("../core/modalfacebox.php"); ?>