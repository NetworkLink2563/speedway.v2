<!-- new pouup modal -->
<?php
$codecus="SELECT XVCstCode  FROM [NWL_SpeedWayTest2].[dbo].[TMstMCustomer] ORDER BY XVCstCode DESC ";
$codex = sqlsrv_query($conn,$codecus);
$arrcodelast =sqlsrv_fetch_array($codex,SQLSRV_FETCH_ASSOC);
$code1=explode('-',$arrcodelast['XVCstCode']);
$XVCstCode=$code1[1]; 
$num1 = $XVCstCode;
$num2 = 1;
$sum = $num1 + $num2;
// Format the sum with leading zeros
$formattedSum = sprintf('%04d', $sum);
//echo $formattedSum; // This will output 006
?>
<style>
  input[type="email"],input[type="text"],input[type="number"],textarea[type="text"],select[class="form-control"]{
        color: #1f1f60;
     }
</style>
<div id="newcustomer" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">สร้างข้อมูลลูกค้า</h4>
            </div><!-- end modal-header -->
            <div class="modal-body">
                <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                    <input hidden value="" id="m">
                    <input hidden value=">" id="c">
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">รหัสลูกค้า <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">

                            <input type="text" id="XVCstCode"  name="XVCstCode" value="<?php echo 'CST-'.$formattedSum ; ?>" disabled class="form-control ">
                        </div>
                    </div>
                    
                    <div class="item form-group">

                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">ชื่อลูกค้า <span class="required">*</span>
                        </label>

                        <div class="col-md-6 col-sm-6  form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" id="XVCstName" name="XVCstName" placeholder="ชื่อลูกค้า">
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>

                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">รายละเอียดลูกค้า <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <textarea type="text"  required="required" id="XVCstDescription" name="XVCstDescription" class="form-control "></textarea>

                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">เบอร์โทรลูกค้า <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="number" class="form-control" id="XVCstPhone" name="XVCstPhone" placeholder="เบอร์โทรลูกค้า" maxlength="10">
                            <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">อีเมลลูกค้า <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="email" class="form-control has-feedback-left" id="XVCstEmail" name="XVCstEmail" placeholder="อีเมลลูกค้า">
                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">สถานะการใช้งาน <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <select class="form-control" id="XBCstIsActive" name="XBCstIsActive">
                                <option value="">เลือกสถานะ</option>
                                <option value="1">ใช้งาน</option>
                                <option value="2">ยกเลิกใช้งาน</option>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">ผู้สร้าง
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="last-name" disabled name="last-name" value="<?php echo $_SESSION['XVUsrCode']; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">เวลาที่สร้าง
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="XTWhenCreate" disabled name="XTWhenCreate" value="<?php echo date('Y-m-d H:i:s') ?>" class="form-control">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="item form-group" style=" text-align: center;">
                        <div class="col-md-12 col-sm-12 offset-md-6">
                            <button class="btn btn-primary" data-dismiss="modal" type="button">ยกเลิก</button>
                            <button class="btn btn-primary" type="reset">ตั้งค่าเดิม</button>
                            <a onclick="newcus();" class="btn btn-success">บันทึก</a>
                        </div>
                    </div>
                

                </form>

            </div><!-- end modal-body -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog modal-md -->
</div><!-- end popupNew -->
<!-- end popup modal -->