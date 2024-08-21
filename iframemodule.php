<?php
$XVVmsCode = $_GET['XVVmsCode'];

include "lib/DatabaseManage.php";
?>
<style>
table, td, th {
  border: 1px solid black;
  padding: 1%;
}
th{
    font-size: 14px;

}
td{
    text-align: center;
    font-size: 12px;
}
table {
  border-collapse: collapse;
  width: 100%;
}
</style>
<div class="modal py-5 show" id="ModalExample" style="display: block;" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
<table class="table">
  <thead>
    <tr>
      <th style="background-color: #74b3da;" scope="col">No.</th>
      <th style="background-color: #74b3da;" scope="col">Module X</th>
      <th style="background-color: #74b3da;" scope="col">Module Y</th>
      <th style="background-color: #74b3da;" scope="col">Module No</th>
      <th style="background-color: #74b3da;" scope="col">Date Time</th>
    </tr>
  </thead>
 
         <?php 
         $i=1;
    $q = "SELECT * FROM TMstMItmVMS_ModuleStatus WHERE XVVmsCode ='$XVVmsCode'";
    $qr = sqlsrv_query($conn, $q);
   while($qd = sqlsrv_fetch_array($qr, SQLSRV_FETCH_ASSOC)){ ?>
 <tbody>
    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td><?php echo $qd['XIVdtModuleX']; ?></td>
      <td><?php echo $qd['XIVdtModuleY']; ?></td>
      <td><?php echo $qd['XIVdtModuleNo']; ?></td>
      <td><?php echo date_format($qd['XTWhenCreate'],"Y/m/d H:i:s"); ?></td>
    </tr>
  </tbody>
  <?php  $i++;}?>       
                </div>
            </div>
        </div>
    </div>

