<?php

$pcode="SELECT XVPrjCode  FROM [NWL_SpeedWayTest2].[dbo].[TMstMProject] ORDER BY XVPrjCode DESC ";
$pqcode = sqlsrv_query($conn,$pcode);
$pqarr =sqlsrv_fetch_array($pqcode,SQLSRV_FETCH_ASSOC);
$pcdoe1=explode('-',$pqarr['XVPrjCode']);
$XVPrjCode=$pcdoe1[1]; 
$num1 = $XVPrjCode;
$num2 = 1;
$sum = $num1 + $num2;
// Format the sum with leading zeros
$formattedSum = sprintf('%04d', $sum);
//echo $formattedSum; // This will output 006
?>

<!-- new pouup modal --> 
<div id="newproject" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">สร้างข้อมูลโครงการ</h4>
            </div><!-- end modal-header -->
            <div class="modal-body">
                <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                <input hidden value=""  id="m">
                <input hidden value=">"  id="c">
                <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">รหัสโครงการ <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="XVPrjCodex" name="XVPrjCodex" value="<?php echo 'PRJ24-'.$formattedSum; ?>" disabled="disabled" class="form-control ">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">ชื่อลูกค้า <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <select class="form-control" id="XVCstCodex" name="XVCstCodex" >     
                            <option value="">เลือกชื่อลูกค้า</option>                     
                           <?php 
                            $cus="SELECT XVCstCode,XVCstName FROM [NWL_SpeedWayTest2].[dbo].[TMstMCustomer] WHERE XBCstIsActive ='1'";
                            $qcus=sqlsrv_query($conn,$cus);
                            while($qcust=sqlsrv_fetch_array($qcus, SQLSRV_FETCH_ASSOC)){ ?>
                                <option value="<?php echo $qcust['XVCstCode']; ?>" ><?php echo $qcust['XVCstName']; ?></option>
                          <?php } ?>
                          </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">ชื่อโครงการ <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="XVPrjNamex" name="XVPrjNamex" required="required" class="form-control ">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">รายละเอียดโครงการ <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <textarea type="text" id="XVPrjDescriptionx" name="XVPrjDescriptionx" required="required" class="form-control "></textarea>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">ประเภทโครงการ <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <select  id="XVPrjTypex" name="XVPrjTypex" class="form-control ">
                                <option value="">เลือกประเภทโครงการ</option>  /*ประเภทโครงการ 1:LoRa  2:EMM  3.NB Node  4:VMS */
                                <option value="1">LoRa</option>
                                <option value="2">EMM</option>
                                <option value="3">NB Node</option>
                                <option value="4">VMS</option>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Line Token 1 <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="XVPrjLineToken1x" name="XVPrjLineToken1x" required="required" class="form-control ">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Line Token 2 <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="XVPrjLineToken2x" name="XVPrjLineToken2x" required="required" class="form-control ">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">ผู้สร้าง
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="XVWhoCreate" disabled name="XVWhoCreate" value="<?php echo $_SESSION['XVUsrCode']; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">เวลาที่สร้าง
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="XTWhenCreate" disabled name="XTWhenCreate" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="item form-group" style=" text-align: center;">
                        <div class="col-md-12 col-sm-12 offset-md-6">
                            <button class="btn btn-primary" type="button">ยกเลิก</button>
                            <button class="btn btn-primary" type="reset">ตั้งค่าเดิม</button>
                            <a  onclick="newproj();" class="btn btn-success">บันทึก</a>
                        </div>
                    </div>
                </form>

            </div><!-- end modal-body -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog modal-md -->
</div><!-- end popupNew -->
<!-- end popup modal -->