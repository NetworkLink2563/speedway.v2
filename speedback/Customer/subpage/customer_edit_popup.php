


<style>
     input[type="email"],input[type="text"],input[type="number"],textarea[type="text"],select[class="form-control"]{
        color:#1f1f60;
     }
</style>

<div id="editcustomer" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">แก้ไขข้อมูลลูกค้า</h4>
            </div><!-- end modal-header -->
            <div class="modal-body">
                <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                    <input hidden value="" id="m">
                    <input hidden value="" id="c">
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">รหัสลูกค้า <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="XVCstCodex"  name="XVCstCodex" value="<?php echo 'CST-'.$formattedSum ; ?>" disabled class="form-control ">
                        </div>
                    </div>
                    
                    <div class="item form-group">

                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">ชื่อลูกค้า <span class="required">*</span>
                        </label>

                        <div class="col-md-6 col-sm-6  form-group has-feedback">
                            <input type="hidden" class="form-control has-feedback-left" id="XVCstNamechkx" name="XVCstNamechkx" placeholder="ชื่อลูกค้า">
                            <input type="text"  class="form-control has-feedback-left" id="XVCstNamex" name="XVCstNamex" placeholder="ชื่อลูกค้า">
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>

                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">รายละเอียดลูกค้า <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <textarea type="text"  required="required" id="XVCstDescriptionx" name="XVCstDescriptionx" class="form-control "></textarea>

                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">เบอร์โทรลูกค้า <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="number" class="form-control" id="XVCstPhonex" name="XVCstPhonex" placeholder="เบอร์โทรลูกค้า" maxlength="10">
                            <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">อีเมลลูกค้า <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="email" class="form-control has-feedback-left" id="XVCstEmailx" name="XVCstEmailx" placeholder="อีเมลลูกค้า">
                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">สถานะการใช้งาน <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <select class="form-control" id="XBCstIsActivex" name="XBCstIsActivex">
                                <option value="">เลือกสถานะ</option>
                                <option value="1">ใช้งาน</option>
                                <option value="0">ยกเลิกใช้งาน</option>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">ผู้แก้ไข
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="XVUsrCode" disabled name="XVUsrCode" value="<?php echo $_SESSION['XVUsrCode']; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">เวลาที่แก้ไข
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="XTWhenEdit" disabled name="XTWhenEdit" value="<?php echo date('Y-m-d H:i:s') ?>" class="form-control">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="item form-group" style=" text-align: center;">
                        <div class="col-md-12 col-sm-12 offset-md-6">
                            <button class="btn btn-primary" data-dismiss="modal" type="button">ยกเลิก</button>
                            <button class="btn btn-primary" type="reset">ตั้งค่าเดิม</button>
                            <a onclick="editdetail();" class="btn btn-success">แก้ไข</a>
                        </div>
                    </div>
                

                </form>

            </div><!-- end modal-body -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog modal-md -->
</div><!-- end popupNew -->
<!-- end popup modal -->