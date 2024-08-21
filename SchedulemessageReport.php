<?php
date_default_timezone_set("Asia/Bangkok");
include 'header.php';
include "lib/DatabaseManage.php";
include "permission.php";
include "service/privilege.php";


$menucode="019";
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
// if(checkmenu($user,'009')==0){
   
//     header( "location: dashboard.php" );
//     exit(0);
// }
$sql = "SELECT * FROM TMstMItmVMS ORDER BY XVVmsCode ASC";
$query = sqlsrv_query($conn, $sql);
$XVVmsCode=base64_decode($_REQUEST["vmc"]) ;
//enddate
if(!isset($_GET['vmschk'])){$vms='ALL';}else{$vms=$_GET['vmschk'];}
if(!isset($_GET['enddate'])){$enddate=date('Y-m-d');}else{$enddate=$_GET['enddate'];}
if(!isset($_GET['strdate'])){$strdate=date('Y-m-01');}else{$strdate=$_GET['strdate'];}
if(!isset($_GET['creat_user'])){$creat_user='ALL';}else{$creat_user=$_GET['creat_user'];}

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
            jQuery('.datetimepicker').datetimepicker({
              format:'Y-m-d '
            });

               //new DataTable('#UserTable');
    //new DataTable('#VMSTable');

    new DataTable('#example', {
        ordering: false,
        "oLanguage": {
            "sSearch": "กรอกข้อความที่ต้องการค้นหา"
        }
    });

    /*
    new DataTable('#VMSTable'', {
        ordering: false
    });
    */
        });


function MM_jumpMenu(targ,selObj,restore){ //v3.0
eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
 if (restore) selObj.selectedIndex=0;
 }
function PrintReport() {
    $.ajax({
        type: 'POST',
          url: 'SchedulemessageReportPdf.php',
            data: {'vmsID':document.getElementById("vms").value},
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
               url: 'SchedulemessageData.php',
               data: {
              'vms': document.getElementById("vms").value
               },
               success: function(msg) {
                 
                   $('#ShowData').html(msg);
               },
           });
           new DataTable('#UserTable', {
               ordering: false,
               "oLanguage": {
                   "sSearch": "กรอกข้อความที่ต้องการค้นหา"
               }
           });
       }
</script>
<style>
    .dt-container{
        width: 100%;
    }
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

    .flex-content{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin: 1rem;
    }

    .flex-btn {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>


      <div class="container" style="position: relative; top: 75;">
    
        
       <div style=" text-align: center; padding: 1rem; border-bottom: 3px double #cccc; margin: .4rem;">

        </div>

       <div class=" shadow" style="display: flex; flex-direction: column; align-items: center; padding: 0.5rem; background-color: #034672; color: white; font-size: 1.2rem; border-radius: 5px;">
            <a class="tablinks2 active " style="cursor: context-menu; color: white;"><img src="./img/icon/report.png" height="25" alt="Responsive image"> รายงานข้อความป้าย
        </div>

        
        <?php if($pri_r != 0){ ?>
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
<span class="input-group-text" id="basic-addon3">วันที่ <i style="width: 25%; text-align: left; margin-left: .3rem;" class="fa"></i></span>
<input type="text" class="datetimepicker form-control" value="<?php echo $strdate;?>" placeholder="วันที่เริ่ม" id="strdate" name="strdate" aria-describedby="basic-addon3">
<input type="text" class="datetimepicker form-control" value="<?php echo $enddate;?>"  placeholder="วันที่จบ" id="enddate"  name="enddate" aria-describedby="basic-addon3">&nbsp;

<span class="input-group-text" id="basic-addon3">ผู้สร้าง</span>
<select class="form-control" id="creat_user" name="creat_user">
<option value="ALL">เลือก</option>
<?php 
$u="SELECT XVusrCode FROM [NWL_SpeedWayTest2].[dbo].[TMstMPlaylistDTReport] GROUP BY  XVusrCode ";
$uq=sqlsrv_query($conn,$u);
while($arr=sqlsrv_fetch_array($uq, SQLSRV_FETCH_ASSOC)){ ?>
<option <?php if($creat_user==$arr['XVusrCode']){ echo 'selected=selected';} ?> value="<?php echo $arr['XVusrCode'];?>"><?php echo $arr['XVusrCode']; ?></option>
<?php } ?>
</select>
&nbsp;
<button  type="submit" name="submit" class="btn btn-primary"><i  class="fa fa-search" aria-hidden="true"></i>ค้นหา</button>
</div>


</form>
</div>

</div>



        <div id="VMSALL">
            <div class="flex-content">
            <?php
             $dstr = date('Y-m-d',strtotime($strdate));
             $dend = date('Y-m-d', strtotime($enddate));
             $j=1;
             $Q="";
             $QU="";
             if($vms!='ALL'){  $Qc="WHERE XVVmsCode ='$vms' "; }else{ $Qc="WHERE XVVmsCode =''";}
               $vmsx="SELECT *  FROM [NWL_SpeedWayTest2].[dbo].[TMstMItmVMS]  $Qc";
           
               $qvmsx= sqlsrv_query($conn,$vmsx);
               $qrx=  sqlsrv_fetch_array($qvmsx,SQLSRV_FETCH_ASSOC);         
            ?>
             <div class="input-group mb-3">
             <div style=" text-align:right; font-size: .875rem"><b>รหัสป้าย  / ชื่อป้าย : </b><?php echo $qrx['XVVmsCode'].'  / '.$qrx['XVVmsName']; ?></div>
             
             <div style="padding-left:76%"><a href="Report_message.php?vmschk=<?php echo $vms; ?>&strdate=<?php echo $strdate; ?>&enddate=<?php echo $enddate;  ?>&creat_user=<?php echo $creat_user; ?>" target="_blank" title="พิมพ์รายงาน"><i style="width: 17%; color:black" class="fa fa-print" aria-hidden="true"></i></a>
             </div>
             </div>
               <table class="table table-striped" style="width:100%">
                    <thead>
            <tr>
            <th width="5%">No.</th>
              
                <th>ผู้ส่งข้อความขึ้นป้าย&nbsp;|&nbsp;วันเวลาขึ้นป้าย</th>
                <th>ข้อมูล</th>
            </tr>
        </thead>
        <tbody>
            <?php
       
        


            if($creat_user!='ALL'){$QU="AND XVUsrCode='$creat_user'";}
            $hj="SELECT * FROM  [NWL_SpeedWayTest2].[dbo].[TMstMPlaylistDTReport] WHERE  XTSendPlaylist   between CONVERT(datetime,'$dstr') AND CONVERT(datetime,'$dend 23:59:59:998') AND XVVmsCode ='". $qrx['XVVmsCode']."' $QU ";
  
            $kq=sqlsrv_query($conn,$hj);
            while($qa=sqlsrv_fetch_array($kq,SQLSRV_FETCH_ASSOC)){?>
            <tr>
                <td><?php echo $j; ?></td>
                
                <td><?php echo $qa['XVUsrCode'].'&nbsp;|&nbsp;'. date_format($qa['XTSendPlaylist'],"Y/m/d H:i:s");?></td>
                <?php // XVMsfCode ?>
                <td> 
                   <?php
                    $MsfCode="SELECT *  FROM [NWL_SpeedWayTest2].[dbo].[TMstMMessageFrame] WHERE XVMsfCode ='".$qa['XVMsfCode']."'";
                    $Msfq= sqlsrv_query($conn,$MsfCode);
                    $arrfq=  sqlsrv_fetch_array($Msfq,SQLSRV_FETCH_ASSOC); 
                   ?>
                   <p>ชุดข้อความ <?php echo $arrfq['XVMsfCode']; ?> | ชื่อชุดข้อความ <?php echo $arrfq['XVMsfName']; ?></p>
                   <code>ข้อความ</code> 
                    <?php
                    $y1=msgxx($arrfq['XVMsgCodeF1']);
                    $y2=msgxx($arrfq['XVMsgCodeF2']);
                    $y3=msgxx($arrfq['XVMsgCodeF3']);
                    $y4=msgxx($arrfq['XVMsgCodeF4']);
                    $y5=msgxx($arrfq['XVMsgCodeF5']);
                    ?>
                    <ol>

<?php if($y1['XVMsgName']!=""){ ?><li><code style="color:black; font-size:.875rem" ><?php print_r($y1['XVMsgName']); ?></code> </li><?php } ?>
<?php if($y2['XVMsgName']!=""){ ?><li><code style="color:black; font-size:.875rem"> <?php print_r($y2['XVMsgName']); ?></code> </li><?php } ?>
<?php if($y3['XVMsgName']!=""){ ?><li><code style="color:black; font-size:.875rem"><?php print_r($y3['XVMsgName']); ?></code> </li><?php } ?>
<?php if($y4['XVMsgName']!=""){ ?><li><code style="color:black; font-size:.875rem" > <?php print_r($y4['XVMsgName']); ?></code> </li><?php } ?>
<?php if($y5['XVMsgName']!=""){ ?><li><code style="color:black; font-size:.875rem" ><?php print_r($y5['XVMsgName']); ?></code> </li><?php } ?>

</ol>
                    

                </td>
           
            </tr>
            <?php $j++; } ?>
        </tbody>
        
    </table>
    </div>



 <?php }else{echo'<div style="text-align:center;padding: 10%;"">ไม่มีสิทธิ์การเข้าถึงข้อมูล หรือติดต่อเจ้าหน้าที่เพื่อขอสิทธิ์</div>';}  ?>
</div>
<?php include "footer.php"; ?>

<div id="myModalOpen" class="modal" id="myModal" role="dialog" a>
    <div class="modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="Example_Title" class="modal-title">รายงานข้อความป้าย</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center">

                <div class="iframe-container">
                    <iframe id="iframe_modal" frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>


            </div>
        </div>
    </div>
</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->


</body>

</html>

<?php 
            function msgxx($id){
            include "lib/DatabaseManage.php";
            $fnq="SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMMessage] WHERE [NWL_SpeedWayTest2].[dbo].[TMstMMessage].XVMsgCode='".$id."'";
            $fnx= sqlsrv_query($conn, $fnq);
            $fnar=sqlsrv_fetch_array($fnx,SQLSRV_FETCH_ASSOC);

              return $fnar;
            }

?>
