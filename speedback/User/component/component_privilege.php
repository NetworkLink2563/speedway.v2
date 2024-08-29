<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<?php /*
//////////// Log Edit ////////////////
FILE NAME : module_user.php 
Create By : Sivadol.J 
Log Edit  : Create 07/25/2024    
/////////////////////////////////////
*/
if (!isset($_GET['m'])) {
    $m = 'privilegeuser';
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
if (!isset($_GET['userpri'])) {$userpri = 'All';} else {$userpri = $_GET['userpri'];}
if (!isset($_GET['menuids'])){ $menuid= 'All';}else {  $menuid = $_GET['menuids'];}

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
<link href="../lib/gentelella/vendors/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="../lib/gentelella/vendors/select2/dist/js/select2.min.js"></script>
<script src="http://127.0.0.1/speedback/User/js/user.js"></script>
</div>
<div class="title_left" style="padding-left: 2%;">
    <h3>Privilege User <small>(Privilege control)</small></h3>
</div>
<div style="text-align: right;">
    <a href="#newprivl" class="btn btn btn-primary" role="button" data-toggle="modal" data-target="#newprivl"> <i class="fa fa-pencil"></i>เพิ่มสิทธิ์การใช้งาน</a>

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
        <form class="form-inline" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $m; ?>" id="m" name="m" />
            <input type="hidden" value="<?php echo $c; ?>" id="c" name="c" />
            <div class="row">
                <div class="input-group col-md-2 col-sm-2 col-xs-2">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default" disabled=""><i class="fa fa-filter"></i> ตัวกรอง |
                            ผู้ใช้งาน  : </button>
                    </span>

                    <select name="userpri" id="userpri" class="form-control" style="width:auto;">
                        <option value="All">เลือก</option>
                        <?php
                        $depr = "SELECT XVUsrCode FROM [dbo].[TMnyMUserMenu] GROUP BY XVUsrCode";
                        $deprq = sqlsrv_query($conn, $depr);
                        while ($depx = sqlsrv_fetch_array($deprq, SQLSRV_FETCH_ASSOC)) { ?>
                            <option value="<?php echo $depx['XVUsrCode']; ?>" 
                            <?php if ($userpri == $depx['XVUsrCode']) { echo 'selected=seleted'; } ?>>
                                    <?php echo $depx['XVUsrCode']; ?>
                                </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input-group col-md-2 col-sm-2 col-xs-2">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default" disabled=""><i class="fa fa-filter"></i> ตัวกรอง |
                            ชื่อเมนู : </button>
                    </span>

                    <select name="menuids" id="menuids" class="form-control" style="width:auto;">
                        <option value="All">เลือก</option>
                        <?php
                        $menuq = "SELECT *   FROM [dbo].[TSysSMenu] ";
                        $menuq1 = sqlsrv_query($conn, $menuq);
                        while ($qm1 = sqlsrv_fetch_array($menuq1, SQLSRV_FETCH_ASSOC)) { ?>
                            <option value="<?php echo $qm1['XVMnuCode']; ?>" <?php if ($menuid == $qm1['XVMnuCode']) {
                                                                                    echo 'selected=seleted';
                                                                                } ?>><?php echo $qm1['XVMnuName']; ?></option>
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
        $WHERE1 = "";
        if ($userpri != 'All') {
            $conditions1[] = "XVUsrCode = '$userpri'";
        }  // XVCmdCode
        if ($menuid != 'All') {
            $conditions1[] = "XVMnuCode = '$menuid'";
        } // XVVmsCode 
        
        if (count($conditions1) > 0) {
            $WHERE2 = 'WHERE ' . implode('AND ', $conditions1);
        } 

        ?>
        <div class="table-responsive">
            <table id="tlbuser" class="table table-striped table-bordered dataTable no-footer">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ผู้ใช้งาน</th>
                        <th>ชื่อเมนู</th>
                        <th>สิทธิ์การเข้าถึง</th>
                        <th>ผู้สร้าง</th>
                        <th style="text-align: center;">วันเวลาที่สร้าง</th>
                        <th style="text-align: center;">เครื่องมือ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $qc = "SELECT *   FROM [NWL_SpeedWayTest2].[dbo].[TMnyMUserMenu] $WHERE2  ORDER BY XTWhenCreate DESC ";
                   // echo $qc ;

                    $quser = sqlsrv_query($conn, $qc);
                    while ($qrr = sqlsrv_fetch_array($quser, SQLSRV_FETCH_ASSOC)) {
                        if ($qrr['XBDmnIsRead'] == 1) {
                            $Read = 'อ่าน';
                        } else {
                            $Read = '';
                        }
                        if ($qrr['XBDmnIsAdd'] == 1) {
                            $Add = 'เขียน';
                        } else {
                            $Add = '';
                        }
                        if ($qrr['XBDmnIsDelete'] == 1) {
                            $Del = 'ลบ';
                        } else {
                            $Del = '';
                        }
                        if ($qrr['XBDmnIsControl'] == 1) {
                            $Contr = 'ควบคุม';
                        } else {
                            $Contr = '';
                        } ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $qrr['XVUsrCode']; ?></td>
                            <td><?php
                                $qnm = "SELECT *  FROM [NWL_SpeedWayTest2].[dbo].[TSysSMenu] WHERE XVMnuCode='" . $qrr['XVMnuCode'] . "'";
                                $qm = sqlsrv_query($conn, $qnm);
                                $qmrr = sqlsrv_fetch_array($qm, SQLSRV_FETCH_ASSOC);
                                echo $qmrr['XVMnuName']; ?>
                            </td>
                            <td><code><?php echo  '[' . $Read . ' ' . $Add . ' ' . $Del . ' ' . $Contr . ']'; ?></code></td>
                            <td><?php echo $qrr['XVWhoCreate']; ?></td>
                            <td style="text-align: center;"><?php echo date_format($qrr['XTWhenCreate'], 'Y-m-d H:i:s',); ?></td>
                            <td>
                                <div style="text-align:center;">
                                    <ul class="nav navbar-right panel_toolbox">
                                        <!--<li><a href=""  target="_blank" ><i class="fa fa-search"></i></a> </li>-->
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true"><i class="glyphicon glyphicon-option-vertical"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li role="presentation"><a onclick="editpri('<?php echo $qrr['XVUsrCode']; ?>','<?php echo $qrr['XVMnuCode']; ?>','<?php echo $qrr['XVUsrCode']; ?>','<?php echo $qrr['XVMnuCode']; ?>')"><i class="fa fa-pencil"></i>แก้ไข</a> </li>
                                                <li role="presentation" class="divider"></li>
                                                <li role="presentation"><a onclick="deltpri('<?php echo $qrr['XVUsrCode']; ?>','<?php echo $qrr['XVMnuCode']; ?>','<?php echo $qrr['XVUsrCode']; ?>','<?php echo $qrr['XVMnuCode']; ?>')"><i class="fa fa-trash"></i>ลบ</a> </li>
                                            </ul>

                                        </li>

                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php $i++;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include("../User/subpage/user_privilege_edit_popup.php"); ?>
<?php include("../User/subpage/user_privilege_new_popup.php"); ?>
<?php include("../core/modalfacebox.php"); ?>