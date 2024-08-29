<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<?php /*
//////////// Log Edit ////////////////
FILE NAME : module_user.php 
Create By : Sivadol.J 
Log Edit  : Create 07/25/2024    
/////////////////////////////////////
*/

$m = 'project';
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
if(!isset($_GET['XVPrjCodef'])){ $XVPrjCodef='All';}else{ $XVPrjCodef=$_GET['XVPrjCodef']; }
?>
<script type="text/JavaScript"> $(document).ready(function() { 
   //alert('test');
     $('#tlbproj').DataTable( { 
     } );  }); 
     </script>
<style>

 th,td,span{
    font-size: 13px;
 }
 input[type="email"],input[type="text"],input[type="number"],textarea[type="text"],select[class="form-control"]{
        color:#1f1f60;
     }
</style>
<script src="http://127.0.0.1/speedback/Project/js/project.js"></script>
<div class="title_left" style="padding-left: 2%;" >
<h3><a href="?m=project">Project Manager</a>  <small>(Project Control)</small></h3>
</div>
<div style="text-align: right;">
<a href="#newproject" class="btn btn-primary" role="button" data-toggle="modal" data-target="#newproject" > <i class="fa fa-pencil"></i>เพิ่มโครงการ</a>

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
                        โครงการ : </button>
                </span>

                <select name="XVPrjCodef" id="XVPrjCodef" class="form-control" style="width:auto;">
                    <option value="All">เลือกโครงการ</option>
                     <?php
                     $o="SELECT XVPrjCode,XVPrjName FROM  [NWL_SpeedWayTest2].[dbo].[TMstMProject] ORDER BY XVPrjName DESC ";
                     $oi=sqlsrv_query($conn,$o);
                     while($oi1=sqlsrv_fetch_array($oi,SQLSRV_FETCH_ASSOC)){ ?>
                        <option <?php if($XVPrjCodef==$oi1['XVPrjCode']){ echo 'selected=selected';}?> value="<?php echo $oi1['XVPrjCode']; ?>"><?php echo $oi1['XVPrjName']; ?></option>
                 <?php } ?>
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
        <table id="tlbproj" class="table table-striped table-bordered dataTable no-footer">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>รหัสโครงการ</th>
                    <th>ชื่อโครงการ</th>
                    <th>รหัสลูกค้า / ชื่อลูกค้า</th>
                    <th>รายละเอียดโครงการ</th>
                    <th>ประเภทโครงการ</th>
                    <th style="text-align: center;">Line Token</th>
                    <th>ผู้สร้าง</th>
                    <th>เวลาที่สร้าง</th>
                    <th>เครื่องมือ</th>
                </tr>
            </thead>
            <tbody>
     <?php
     $conditions1 = [];
     $WHERE1="";
     if($XVPrjCodef!='All'){ $conditions1[] ="XVPrjCode ='$XVPrjCodef'";} 
     $dstr = date('Y-m-d',strtotime($DBS));
     $dend = date('Y-m-d', strtotime($DBF));
     if ($reservation!=''){  $conditions1[] = "XTWhenCreate  between CONVERT(datetime,'$dstr') AND CONVERT(datetime,'$dend 23:59:59:998')";}
     if(count($conditions1)>0){$WHERE1 =  'WHERE '.implode(' AND ', $conditions1); }
     $i=1;
     $qpro="SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMProject] $WHERE1";
     $qproj = sqlsrv_query($conn,$qpro);
     if ($qproj === false) {die(print_r(sqlsrv_errors(), true));}
     while($arrpro = sqlsrv_fetch_array($qproj, SQLSRV_FETCH_ASSOC)){ 
     ?>             <th scope="row"><?php echo  $i; ?></th>
                    <td><?php echo $arrpro['XVPrjCode']; ?></td>
                    <td><?php echo $arrpro['XVPrjName']; ?></td>
                    <td><?php
                    $qcust="SELECT XVCstName FROM  [NWL_SpeedWayTest2].[dbo].[TMstMCustomer] WHERE XVCstCode='".$arrpro['XVCstCode']."'";
                    $qcustl=sqlsrv_query($conn,$qcust);
                    $qar=sqlsrv_fetch_array($qcustl,SQLSRV_FETCH_ASSOC);
                    echo $arrpro['XVCstCode'].'/ '.$qar['XVCstName'];  ?></td>  
                    <td><?php echo $arrpro['XVPrjDescription']; ?></td>
                  
                    <td>
                    <?php 
                    if($arrpro['XVPrjType']==1){ echo "LoRa";
                    }elseif($arrpro['XVPrjType']==2){ echo "EMM"; 
                    }elseif($arrpro['XVPrjType']==3){ echo "NB Node";
                    }elseif($arrpro['XVPrjType']==4){ echo "VMS";} ?>
                    </td> 
                 
                    <td style="width:9%; text-align: center;"><?php if($arrpro['XVPrjLineToken1'] || $arrpro['XVPrjLineToken2'] !=""){ ?>
                        <img src="../img/linenoti.png" style="width:25%;">
                     <?php }else{ ?>
                        <img src="../img/linenoti.png" style="width:25%;filter: grayscale(1);">
                    <?php } ?></td>
                    <td><?php echo $arrpro['XVWhoCreate'];?></td>
                    <td><?php echo date_format($arrpro['XTWhenCreate'],"Y/m/d H:i:s");?></td>
                    <?php /* ประเภทโครงการ 1:LoRa  2:EMM  3.NB Node  4:VMS*/  ?>
                    <td><div style="text-align:center;">
                            <ul class="nav navbar-right panel_toolbox"> 
                            <li><a href=""  target="_blank" ><i class="fa fa-search"></i></a>
                             </li>
                            <li class="dropdown">
                                
                                 <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true"><i class="glyphicon glyphicon-option-vertical"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                    <li role="presentation"><a tabindex="-1" role="dialog" data-toggle="modal" onclick="editproj('<?php echo $arrpro['XVPrjCode'];?>')" ><i class="fa fa-pencil"></i>แก้ไข</a> </li>
                                    <li role="presentation" class="divider"></li>
                                    <li role="presentation"><a onclick="delproj('<?php echo $arrpro['XVPrjCode'];?>');"><i class="fa fa-trash"></i> Delete</a>  </li>
                                    </ul>
                             </li>
                            </ul>

                        </div>
                    </td>
                 </tr>
                <?php  $i++; } ?>
            </tbody>
        </table>
    </div>
</div>
</div>
<?php include("../Project/subpage/project_edit_popup.php"); ?>
<?php include("../Project/subpage/project_new_popup.php"); ?>
<?php include("../core/modalfacebox.php"); ?>
