<?php
date_default_timezone_set('Asia/Bangkok');
include 'header.php';
include "lib/DatabaseManage.php";
include "permission.php";
include "service/privilege.php";


$menucode="020";
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
// if(checkmenu($user,'010')==0){
   
//     header( "location: dashboard.php" );
//     exit(0);
// }
if(!isset($_GET['vmschk'])){$vms='ALL';}else{$vms=$_GET['vmschk'];}
if(!isset($_GET['enddate'])){$enddate=date('Y/m/d');}else{$enddate=$_GET['enddate'];}
if(!isset($_GET['strdate'])){$strdate=date('Y-m-01');}else{$strdate=$_GET['strdate'];}
if(!isset($_GET['TSysSCommand'])){$TSysSCommand='ALL';}else{$TSysSCommand=$_GET['TSysSCommand'];}
if(isset($_GET['page'])){$page=$_GET['page'];}else{$page=1;}
if(isset($_GET['pagechk'])){$pagechk=$_GET['page'];}else{$pagechk=1;}

?>



<script src="dist/js/jquery-3.7.1.js"></script>
<script src="dist/js/popper.min.js"></script>
<script src="dist/js/main_speed.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script src="dist/js/dataTables5.js"></script>
<script src="dist/js/dataTables.bootstrap5.js"></script>
<script src="dist/js/jquery.datetimepicker.full.min.js"></script>


    <script>
     $(document).ready(function() {
     new DataTable('#vsmtable', {
                ordering: false,
                "oLanguage": {
                    "sSearch": "กรอกข้อความที่ต้องการค้นหา"
                }
            });
        });


        function PrintReport() {
             
            $.ajax({
                type: 'POST',
                url: 'VmsStatusReportPdf.php',
                data: {
                    'vms': document.getElementById("vms").value
                },
                success: function(msg) {
                 
                    $("#iframe_modal").attr("src", msg);
                    $('#myModalOpen').modal('show');
                },
            });
        }
        function ShowData() {
           
            $('#ShowData').empty();
            $.ajax({
                type: 'POST',
                url: 'VmsStatusReportData.php',
                data: {
                    'vms': document.getElementById("vms").value
                },
                success: function(msg) {
                
                    $('#ShowData').html(msg);
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
            $(".datetimepicker").each(function () {
                $(this).datetimepicker();
            });
            $('#vms').select2()
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
        
        /* .select2-container--default .select2-results>.select2-results__options {
            max-height: 400px;
        } */
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
        background: #e1f0fa!important;
    }

    .container{
        background-color:  white;
    
    }

    .flex-container{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 1rem;
    }

    .flex-btn{
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 1rem;
    }

    .shadow{
    box-shadow: 3px 3px 3px #aaaaaa !important;
}

/* .select2{
    width: 100%;
    font-size: 1rem;
    font-weight: 400;
} */

.btn:hover{
        opacity: 0.8;
        transition: 0.5s;
    }
    table, td, th {
  border: 1px solid;
}

table {
  width: 100%;
  border-collapse: collapse;
}
hr {
    display: block;
    height: 1px;
    border: 0;
    border-top: 1px solid #595959;
    margin: 1em 0;
    padding: 0;
}
    </style>


<div class="container" style="position: relative; top: 75;">


<div style=" text-align: center; padding: 1rem; border-bottom: 3px double #cccc; margin: .4rem;">
          
</div>


    <div class="col-12 shadow" style="display: flex; flex-direction: column; align-items: center; padding: 0.5rem; background-color: #034672; color: white; font-size: 1.2rem; border-radius: 5px;">
            <a class="tablinks2 active " style="cursor: context-menu; color: white;"><img src="./img/icon/report.png" height="25" alt="Responsive image"> รายงานสถานะป้าย</a>
    </div>

    <?php if($pri_r != 0){?>
<div class="flex-head" style="margin: 1rem;">

<div class="col">
 <form method="get" encrypted="multipart/form-data">
   <div class="input-group mb-3">

<span class="input-group-text" id="basic-addon3">เลือกป้าย</span>
<select class="form-control" id="vmschk" name="vmschk" >
<option value="ALL">เลือก</option>
<?php
$sql='SELECT XVVmsCode, XVVmsName FROM TMstMItmVMS order by XVVmsCode';
$query = sqlsrv_query($conn, $sql);
while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){ ?>
<option <?php if($vms==$row['XVVmsCode']){ echo 'selected=selected';}?> value="<?php echo $row['XVVmsCode']; ?>"> <?php echo $row['XVVmsName']; ?></option>
<?php  }  ?>   
</select>&nbsp;
<span class="input-group-text" id="basic-addon3">สถานะคำสั่ง</span>
<select class="form-control" id="TSysSCommand" name="TSysSCommand">
<option value="ALL">เลือก</option>
<?php 
$u="SELECT XVCmdCode,XVCmdName FROM [NWL_SpeedWayTest2].[dbo].[TSysSCommand] ";
$uq=sqlsrv_query($conn,$u);
while($arr=sqlsrv_fetch_array($uq, SQLSRV_FETCH_ASSOC)){ ?>
<option <?php if($TSysSCommand==$arr['XVCmdCode']){ echo 'selected=selected';} ?> value="<?php echo $arr['XVCmdCode'];?>"><?php echo $arr['XVCmdName']; ?></option>
<?php } ?>
</select>&nbsp;
<span class="input-group-text" id="basic-addon3">วันที่ <i style="width: 25%; text-align: left; margin-left: .3rem;" class="fa"></i></span>
<input type="text" class="datetimepicker form-control" value="<?php echo $strdate;?>" placeholder="วันที่เริ่ม" id="strdate" name="strdate" aria-describedby="basic-addon3">
<input type="text" class="datetimepicker form-control" value="<?php echo $enddate;?>"  placeholder="วันที่จบ" id="enddate"  name="enddate" aria-describedby="basic-addon3">&nbsp;


&nbsp;
<button  type="submit" name="submit" class="btn btn-primary"><i  class="fa fa-search" aria-hidden="true"></i>ค้นหา</button>
</div>


</form>
</div>

</div>

            <div class="flex-container">
                <div class="col-6" style="display: flex; align-items: center; justify-content: center;  flex-direction: column; font-size: 1.2rem;">

              
    </div>
    <br>
    <div style="padding-left:76%"><a href="Report_status.php?vmschk=<?php echo $vms; ?>&strdate=<?php echo $strdate; ?>&enddate=<?php echo $enddate;  ?>&TSysSCommand=<?php echo $TSysSCommand; ?>" target="_blank" title="พิมพ์รายงาน"><i style="width: 17%; color:black" class="fa fa-print" aria-hidden="true"></i></a>
    </div>


    <?php }else{echo'<div style="text-align:center;padding: 10%;"">ไม่มีสิทธิ์การเข้าถึงข้อมูล หรือติดต่อเจ้าหน้าที่เพื่อขอสิทธิ์</div>';} ?>
    </div>
    <?php include "footer.php"; ?>
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
        echo '</div><hr><br>';
        echo $h;
        $count++;
        $r += $sum;
  } 
}


  ?>
   


   
    </body>
    </html>
