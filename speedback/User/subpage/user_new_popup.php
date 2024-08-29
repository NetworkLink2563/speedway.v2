
<div id="newuser" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">สร้างข้อมูลผู้ใช้งาน</h4>
            </div><!-- end modal-header -->
            <div class="modal-body">
                <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                

                    <div class="x_content">
                        <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">ข้อมูลผู้ใช้งาน</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">สถานะการใช้งาน</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">กะเวลาการทำงาน</a>
                            </li>
                           
                        </ul>
                        <div class="tab-content" id="myTabContent">
                       <br>
                            <div class="tab-pane fade active in" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">อีเมลผู้ใช้งาน<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="XVUsrCode" name="XVUsrCode"  class="form-control has-feedback-left">
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">รหัสผ่าน<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="password" id="XVUsrPwd" name="XVUsrPwd" value="NWL"  class="form-control ">
                           
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">ชื่อผู้ใช้งาน<span class="required">*</span>
                        
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="XVUsrName" name="XVUsrName"  class="form-control has-feedback-left">
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">เบอร์โทร <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="XVUsrPhone" name="XVUsrPhone"  class="form-control has-feedback-right" maxlength="10">
                            <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">แผนก <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <select  id="XVDptCode" name="XVDptCode"  class="form-control" >
                            <option value="">เลือกแผนก</option>
                                <?php 
                                $qdpt3="SELECT *  FROM [NWL_SpeedWayTest2].[dbo].[TMstMDepartment] ORDER BY XVDptCode ASC"; 
                                $qr3=sqlsrv_query($conn,$qdpt3);
                                while($qra3=sqlsrv_fetch_array($qr3)){ ?>
                                     <option value="<?php echo $qra3['XVDptCode'] ?>"><?php echo $qra3['XVDptName']; ?></option>
                               <?php } ?>
                            </select>
                            
                        </div>
                    </div>
                    
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">ชื่อลูกค้า<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <select class="form-control" id="idcust" name="idcust" onchange="getproj();">
                                <option value="">เลือกชื่อลูกค้า</option>
                                <?php
                                $qcust = "SELECT * FROM [dbo].[TMstMCustomer] ORDER BY XVCstCode ASC";
                                $qr = sqlsrv_query($conn, $qcust);
                                while ($qio = sqlsrv_fetch_array($qr, SQLSRV_FETCH_ASSOC)) { ?>
                                    <option value="<?php echo $qio['XVCstCode']; ?>"><?php echo $qio['XVCstName']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                  <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"><span class="required">ชื่อโครงการ*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <select class="form-control" id="XVUsrDefaultPrj" name="XVUsrDefaultPrj" >
                                <option value="">เลือกชื่อโครงการ</option>
                            </select>
                        </div>
                    </div>
                </div>

                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">กะเวลาทำงาน <span class="required">*</span>
                        </label> <!-- สถานะจาก Admin Customer อนุญาต -->
                        <div class="col-md-6 col-sm-6 ">
                            <select class="form-control" id="XVShfCode" name="XVShfCode">
                                <option value="">เลือกกะเวลาทำงาน</option>
                                <?php
                                $shf = "SELECT * FROM  [NWL_SpeedWayTest2].[dbo].[TMstMShift] ORDER BY XVShfCode ASC";
                                $qshf = sqlsrv_query($conn, $shf);
                                while ($shq = sqlsrv_fetch_array($qshf, SQLSRV_FETCH_ASSOC)) {
                                    $timeshf = '[&nbsp;' . str_pad($shq['XIShfStartHour'], 2, "0", STR_PAD_LEFT) . ':'
                                        . str_pad($shq['XIShfStartMin'], 2, "0", STR_PAD_LEFT) . '&nbsp;|&nbsp;'
                                        . str_pad($shq['XIShfEndHour'], 2, "0", STR_PAD_LEFT) . ':'
                                        . Str_pad($shq['XIShfEndMin'], 2, "0", STR_PAD_LEFT) . '&nbsp;]'; ?>
                                    <option value="<?php echo $shq['XVShfCode']; ?>"><?php echo  $shq['XVShfName'] . $timeshf; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                            </div>

                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">สถานะการใช้งาน <span class="required">*</span>
                        </label> <!-- สถานะจาก Admin Customer อนุญาต -->
                        <div class="col-md-6 col-sm-6 ">
                            <select class="form-control" id="XBUsrIsActive" name="XBUsrIsActive">
                               
                                <option value="1">ใช้งาน</option>
                                <option value="2">ยกเลิกใช้งาน</option>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">สถานะผู้ใช้งาน <span class="required">*</span>
                        </label> <!-- สถานะจาก Admin Customer อนุญาต -->
                        <div class="col-md-6 col-sm-6 ">
                            <select class="form-control" id="XBUsrIsCstAdmin" name="XBUsrIsCstAdmin">
                                <option value="">เลือกสถานะผู้ใช้งาน</option>
                                <option value="1">ผู้ดูแลระบบ</option>
                                <option value="2">ผู้ใช้งานทั่วไป</option>
                            </select>
                          </div>
                         </div>

                        </div>
                    </div>
                </div>
                    
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">ผู้สร้างทะเบียน
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="nameregis" disabled name="nameregis" value="<?php echo date('d-m-Y H:i:s'); ?>" class="form-control">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">เวลาที่ลงทะเบียน
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="datetimechk" disabled name="date" value="<?php echo $_SESSION['XVUsrCode']; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="item form-group" style=" text-align: center;">
                        <div class="col-md-12 col-sm-12 offset-md-6">
                            <button class="btn btn-primary" type="button">ยกเลิก</button>
                            <button class="btn btn-primary" type="reset">ตั้งค่าเดิม</button>
                            <a onclick="newuser();" class="btn btn-success">บันทึก</a>
                        </div>
                    </div>
                </form>

            </div><!-- end modal-body -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog modal-md -->
</div><!-- end popupNew -->
<!-- end popup modal -->