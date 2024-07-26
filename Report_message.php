<?php 
date_default_timezone_set("Asia/Bangkok");

include "lib/DatabaseManage.php";


if(!isset($_GET['vmschk'])){$vms='ALL';}else{$vms=$_GET['vmschk'];}
if(!isset($_GET['enddate'])){$enddate=date('Y-m-d');}else{$enddate=$_GET['enddate'];}
if(!isset($_GET['strdate'])){$strdate=date('Y-m-01');}else{$strdate=$_GET['strdate'];}
if(!isset($_GET['creat_user'])){$creat_user='ALL';}else{$creat_user=$_GET['creat_user'];}

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
             <div style=" text-align:left; font-size: .875rem"><b>รหัสป้าย  / ชื่อป้าย : </b><?php echo $qrx['XVVmsCode'].'  / '.$qrx['XVVmsName']; ?></div>
            <br>
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
                   <p>รหัสป้าย <?php echo $arrfq['XVMsfCode']; ?> | ชื่อป้าย <?php echo $arrfq['XVMsfName']; ?></p>
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
</div>

</page>

<?php 
            function msgxx($id){
            include "lib/DatabaseManage.php";
            $fnq="SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMMessage] WHERE [NWL_SpeedWayTest2].[dbo].[TMstMMessage].XVMsgCode='".$id."'";
            $fnx= sqlsrv_query($conn, $fnq);
            $fnar=sqlsrv_fetch_array($fnx,SQLSRV_FETCH_ASSOC);

              return $fnar;
            }

?>