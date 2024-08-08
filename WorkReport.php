<?php
include 'header.php';
include "lib/DatabaseManage.php";
include "permission.php";
include "service/privilege.php";

$menucode="018";
$pri=pri_($_SESSION['user'],$menucode);  
$pri_w=$pri[0]['pri_w'];  // สิทธิ์การเขียน
$pri_r=$pri[0]['pri_r'];  // สิทธิ์การอ่าน
$pri_del=$pri[0]['pri_del'];  // สิทธิ์การลบ
$pri_contr=$pri[0]['pri_del'];  // สิทธิ์การควบคุม


// if(checkmenu($user,'001')==0)
// {
//     session_destroy();
//     header( "location: index.php" );
//     exit(0);
// }
// if(checkmenu($user,'008')==0){
   
//     header( "location: dashboard.php" );
//     exit(0);
// }

$sql = "SELECT * FROM TMstMItmVMS ORDER BY XVVmsCode ASC";

$query = sqlsrv_query($conn, $sql);
$XVVmsCode=base64_decode($_REQUEST["vmc"]) ;

if(!isset($_GET['dtpc'])){$dptm='ALL';}else{$dptm=$_GET['dtpc'];}
if(!isset($_GET['shift'])){$shift='ALL';}else{$shift=$_GET['shift'];}
if(!isset($_GET['customer'])){$customer='ALL';}else{$customer=$_GET['customer'];}
if(!isset($_GET['enddate'])){$enddate=date('Y-m-d');}else{$enddate=$_GET['enddate'];}
if(!isset($_GET['strdate'])){$strdate=date('Y-m-01');}else{$strdate=$_GET['strdate'];}
?>


    <!-- Bootstrap core JavaScript
================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->



  
<script src="dist/js/jquery-3.7.1.js"></script>
<script src="dist/js/popper.min.js"></script>
<script src="dist/js/main_speed.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script src="dist/js/dataTables5.js"></script>
<script src="dist/js/dataTables.bootstrap5.js"></script>
<script src="dist/js/jquery.datetimepicker.full.min.js"></script>

    <script>

$(document).ready(function() {
new DataTable('#tabuser', {
                ordering: false,
                "oLanguage": {
                    "sSearch": "กรอกข้อความที่ต้องการค้นหา"
                }
            });
        });



        function PrintReport() {
            var datestart=document.getElementById('ds').value;
                var dateend=document.getElementById('de').value;
                if(datestart==""){
                    Swal.fire("กรุณากรอกวันที่เริ่ม", "", "warning");
                    return false;
                }
                if(dateend==""){
                    Swal.fire("กรุณากรอกวันที่สิ้นสุด", "", "warning");
                    return false;
                }
                var tmp=datestart.split(" ");
                var dt1=tmp[0]+","+tmp[1]+":00";
                var d1=new Date(dt1);
                var tmp=dateend.split(" ");
                var dt2=tmp[0]+","+tmp[1]+":00";
                var d2=new Date(dt2);
                if(d2<d1){
                    Swal.fire("กรุณากรอกวันที่สิ้นสุด มากกว่าหรือเท่ากับวันที่เริ่มต้น", "", "warning");
                    return false;
                }
            $.ajax({
                type: 'POST',
                url: 'WorkReportPdf.php',
                data: {
                    'ds': document.getElementById("ds").value,'de': document.getElementById("de").value
                },
                success: function(msg) {
                
                    $("#iframe_modal").attr("src", msg);
                    $('#myModalOpen').modal('show');
                },
            });
        }
        function ShowData() {
            var datestart=document.getElementById('ds').value;
                var dateend=document.getElementById('de').value;
                if(datestart==""){
                    Swal.fire("กรุณากรอกวันที่เริ่ม", "", "warning");
                    return false;
                }
                if(dateend==""){
                    Swal.fire("กรุณากรอกวันที่สิ้นสุด", "", "warning");
                    return false;
                }
                var tmp=datestart.split(" ");
                var dt1=tmp[0]+","+tmp[1]+":00";
                var d1=new Date(dt1);
                var tmp=dateend.split(" ");
                var dt2=tmp[0]+","+tmp[1]+":00";
                var d2=new Date(dt2);
                if(d2<d1){
                    Swal.fire("กรุณากรอกวันที่สิ้นสุด มากกว่าหรือเท่ากับวันที่เริ่มต้น", "", "warning");
                    return false;
                }
            $('#ShowData').empty();
            $.ajax({
                type: 'POST',
                url: 'WorkReportData.php',
                data: {
                    'ds': document.getElementById("ds").value,'de': document.getElementById("de").value
                },
                success: function(msg) {
                    console.log(msg);
                    $('#ShowData').html(msg);
                    new DataTable('#Table', {
                        ordering: false,
                        "oLanguage": {
                            "sSearch": "กรอกข้อความที่ต้องการค้นหา"
                        }
                    });
                },
            });
            
  
        }

        function filterFunction() {
            const input = document.getElementById("myInput");
            const filter = input.value.toUpperCase();
            const div = document.getElementById("myDropdown");
            const a = div.getElementsByTagName("a");
            for (let i = 0; i < a.length; i++) {
                txtValue = a[i].textContent || a[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    a[i].style.display = "";
                } else {
                    a[i].style.display = "none";
                }
            }
        }
        
        $(document).ready(function() {
            jQuery('.datetimepicker').datetimepicker({
   
              format:'Y-m-d H:i'
            });
          
        });

    </script>

    <style>
        a.del-item:link {
            color: #595959 !important;
        }
        
        a.del-item:visited {
            color: #595959 !important;
        }
        
        a.del-item:hover {
            color: #FF0000 !important;
        }
        
        a.del-item:focus {
            color: #FF0000 !important;
        }
        
        a.del-item:active {
            color: #595959 !important;
        }
        
        a.del-VMS:link {
            color: #595959 !important;
        }
        
        a.del-VMS:visited {
            color: #595959 !important;
        }
        
        a.del-VMS:hover {
            color: #FF0000 !important;
        }
        
        a.del-VMS:focus {
            color: #FF0000 !important;
        }
        
        a.del-VMS:active {
            color: #595959 !important;
        }
        
        a.activeUser-item:link {
            color: #595959 !important;
        }
        
        a.activeUser-item:visited {
            color: #595959 !important;
        }
        
        a.activeUser-item:hover {
            color: #66CC00 !important;
        }
        
        a.activeUser-item:focus {
            color: #66CC00 !important;
        }
        
        a.activeUser-item:active {
            color: #595959 !important;
        }
        
        .select2-container--default .select2-results>.select2-results__options {
            max-height: 400px;
        }
    </style>
    <style>
        .dropbtn {
            background-color: #04AA6D;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }
        
        .dropbtn:hover,
        .dropbtn:focus {
            background-color: #3e8e41;
        }
        
        #myInput {
            box-sizing: border-box;
            background-image: url('searchicon.png');
            background-position: 14px 12px;
            background-repeat: no-repeat;
            font-size: 16px;
            padding: 14px 20px 12px 45px;
            border: none;
            border-bottom: 1px solid #ddd;
        }
        
        #myInput:focus {
            outline: 3px solid #ddd;
        }
        
        .dropdown {
            position: relative;
            display: inline-block;
        }
        /*
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f6f6f6;
  min-width: 230px;
  overflow: auto;
  border: 1px solid #ddd;
  z-index: 1;
}
*/
        
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            height: 100%;
        }
        
        .dropdown a:hover {
            background-color: #ddd;
        }
        
        .show {
            display: block;
        }
        
        .modal-fullscreen {
            height: 400px;
        }
        
        .iframe-container {
            position: relative;
            height: 100%;
            min-height: 100vh;
            iframe {
                height: 100%;
                width: 100%;
                left: 0;
                top: 0;
                position: absolute;
                body,
                html {
                    height: 100%;
                    overflow: hidden;
                    background: transparent;
                }
            }
        }

        body {
        background: #e1f0fa;
    }

    .container{
        background-color:  white;
        
    }

    .shadow{
    box-shadow: 3px 3px 3px #aaaaaa !important;
}

.flex-head{
    display: flex;
    align-items: center;
    justify-content:center;
}

*{
    box-sizing: border-box;
}

.form-inline{
    align-items: center;
    justify-content: center;
    flex-direction: column;
}


.flex-btn{
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 1rem;
}

.btn:hover{
        opacity: 0.8;
        transition: 0.5s;
    }
    th{
   font-size: 14px;;
}

    </style>

<div class="container" style="position: relative; top: 75;">

<?php if($pri_r != 0){ ?>
<div style=" text-align: center; padding: 1rem; border-bottom: 3px double #cccc; margin: .4rem;">

        </div>
<div class=" shadow" style="display: flex; flex-direction: column; align-items: center; padding: 0.5rem; background-color: #034672; color: white; font-size: 1.2rem; border-radius: 5px;">
            <a class="tablinks2 active " style="cursor: context-menu;"> <img src="/speedway/img/icon/report.png" height="25" alt="Responsive image">รายงานการปฏิบัติงาน</a>
        </div>


            <div class="flex-head" style="margin: 1rem;">
                        <div class="col">
                        <form class="form-inline " action=""> 
                        <form method="get" encrypted="multipart/form-data">
<div class="input-group mb-3">
<span class="input-group-text" id="basic-addon3">ช่วงเวลาเข้าใช้งานระบบ <i style="width: 25%; text-align: left; margin-left: .3rem;" class="fa"></i></span>
<input width="5%" type="text" class="datetimepicker form-control" value="<?php echo $strdate;?>" placeholder="วันที่เริ่ม" id="strdate" name="strdate" aria-describedby="basic-addon3">
<input width="5%" type="text" class="datetimepicker form-control" value="<?php echo $enddate;?>"  placeholder="วันที่จบ" id="enddate"  name="enddate" aria-describedby="basic-addon3">&nbsp;

<span class="input-group-text" id="basic-addon3"> แผนก</span>
<select class="form-control" id="dtpc" name="dtpc" style="width:3%;">
  <option value="ALL">เลือก</option>
 <?php  $dpt='SELECT XVDptCode,XVDptName FROM [NWL_SpeedWayTest2].[dbo].[TMstMDepartment] order by XVDptCode,XVDptName';
  $dptq = sqlsrv_query($conn, $dpt);
  while($rdpt = sqlsrv_fetch_array($dptq, SQLSRV_FETCH_ASSOC)){ ?>
  <option <?php if($dptm==$rdpt['XVDptCode']){ echo 'selected=selected';}?> value="<?php echo $rdpt['XVDptCode']; ?>"> <?php echo $rdpt['XVDptName']; ?></option>
 <?php  }  ?>   
</select>&nbsp;
<span class="input-group-text" id="basic-addon3">กะเวลาทำงาน</span> 
<select class="form-control" id="shift" name="shift" style="width:6%;">
<option value="ALL">เลือก</option>
  <?php 
   $shf="SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMShift]";
   $shfq=sqlsrv_query($conn,$shf);
  while($sh=sqlsrv_fetch_array($shfq, SQLSRV_FETCH_ASSOC)){
   
     $timeshift='[&nbsp;'.str_pad($sh['XIShfStartHour'],2,"0",STR_PAD_LEFT).':'
     .str_pad($sh['XIShfStartMin'],2,"0",STR_PAD_LEFT).'&nbsp;|&nbsp;'.str_pad($sh['XIShfEndHour'],2,"0",STR_PAD_LEFT)
     .':'.Str_pad($sh['XIShfEndMin'],2,"0",STR_PAD_LEFT).'&nbsp;]';
 ?>
      <option <?php if($shift==$sh['XVShfCode']){ echo 'selected=selected';} ?> value="<?php echo $sh['XVShfCode'];?>"><?php echo $sh['XVShfName'].'&nbsp;-&nbsp;'.$timeshift; ?></option>
<?php } ?>
</select>
  &nbsp;
  <span class="input-group-text" id="basic-addon3">ลูกค้า</span> 
<select class="form-control" id="customer" name="customer" style="width:5%;">
<option value="ALL">เลือก</option>
  <?php 
   $cstf="SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMCustomer]";
     $cstfq=sqlsrv_query($conn,$cstf);
     while($cst=sqlsrv_fetch_array($cstfq, SQLSRV_FETCH_ASSOC)){
     ?>
      <option <?php if($customer==$cst['XVCstCode']){ echo 'selected=selected';} ?> value="<?php echo $cst['XVCstCode'];?>"><?php echo $cst['XVCstName']; ?></option>
<?php } ?>
</select>
<button  type="submit" name="submit" class="btn btn-primary"><i  class="fa fa-search" aria-hidden="true"></i>ค้นหา</button>
</div>

</form>
                        </form>
                    </div>
                </div>
                <div hidden style="text-align:right";><a href="Report_work.php?shift=<?php echo $shift; ?>&customer=<?php echo $customer; ?>&dtpc=<?php echo $dptm; ?>&strdate=<?php echo $strdate; ?>&enddate=<?php echo $enddate;  ?>&creat_user=<?php echo $creat_user; ?>" target="_blank" title="พิมพ์รายงาน"><i style="width: 17%; color:black" class="fa fa-print" aria-hidden="true"></i></a>
                </div>
              <table id="tabuser" class="table table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Username | ชื่อผูัใช้</th>
                <th>Division | แผนก</th>
                <th>Customer | ลูกค้า </th>
                <th width="20%">Shift | กะเวลาทำงาน</th>
                <th width="30%" style="text-align: center;">ประวัติเข้าใช้งานระบบ</th>
                <th  style="text-align: center;">เครื่องมือ</th>
               
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
                <td ><?php echo $shf['XVShfName'].'&nbsp;|&nbsp;'.$timeshf; ?> </td>
          <td  style="text-align: center;">  

          <?php $tmc=Logtime($UCode,$strdate,$enddate); // function Logtime 
               if(count($tmc)!=0){
               foreach($tmc as $k){
                  echo '<code>'.$k.'</code><br>';
                 }  // end foreach
               }else{
                echo "<div style='color:red;'>ไม่พบประวัติเข้าใช้งานระบบ<div>";
            
               } // if check null array function
               ?>
          </td>
            
          <td  style="text-align: center;">
            <div>
            <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle bi bi-three-dots-vertical" 
        href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        
          </a>
           <ul style="background-color: white;" class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
               <li><a class="dropdown-item" href="Report_work.php?userid=<?php echo $UCode; ?>&strdate=<?php echo $strdate; ?>&enddate=<?php echo $enddate;  ?>&creat_user=<?php echo $creat_user; ?>" target="_blank" title="พิมพ์รายงาน">เรียกดูรายงาน</a></li>
               <li><hr class="dropdown-divider"></li>
              
            </ul>
         </li>
         </div>
            </td>
           
            </tr>
          <?php $i++;} ?>
        </tfoot>
        
    </table>


    <?php }else{echo'<div style="text-align:center;padding: 10%;"">ไม่มีสิทธิ์การเข้าถึงข้อมูล หรือติดต่อเจ้าหน้าที่เพื่อขอสิทธิ์</div>';} ?>
                </div>



          

  

    <div id="myModalOpen" class="modal" id="myModal" role="dialog" a>
        <div class="modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="Example_Title" class="modal-title">รายงานข้อความป้าย</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center">

                    <div class="iframe-container">
                        <iframe id="iframe_modal" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>


                        </iframe>
                    </div>


                </div>
            </div>
        </div>
    </div>

    </body>

    </html>

    
    <?php  /// timelogin table [NWL_SpeedWayTest2].[dbo].[TLogLogIn] : check range datetime   
                  
                  function Logtime($UCode,$strdate,$enddate){
                  $data=array();
                  $dstr = date('Y-m-d',strtotime($strdate));
                  $dend = date('Y-m-d', strtotime($enddate));
                  include "lib/DatabaseManage.php";
                  $tstm="SELECT  * FROM [NWL_SpeedWayTest2].[dbo].[TLogLogIn] WHERE XVUsrCode ='$UCode'AND
                   XTLogInTime   between CONVERT(datetime,'$dstr') AND CONVERT(datetime,'$dend 23:59:59:998') "; 
                  $tstmq=sqlsrv_query($conn,$tstm);
                  while($tm=sqlsrv_fetch_array($tstmq, SQLSRV_FETCH_ASSOC)){
                    $data[]= date_format($tm['XTLogInTime'],"Y/m/d H:i:s");
                  }
                      return $data;
                  }
  ?>
