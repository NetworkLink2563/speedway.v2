<!-- new pouup modal -->

<div id="newprivl" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <input hidden="hidden" type="text" value="" id="prival" >
     
                <h4 class="modal-title">ตั้งค่าสิทธิ์การใช้งาน</h4>
            </div><!-- end modal-header -->
            <div class="modal-body">
                <form  class="form-horizontal form-label-left" >
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">ผู้ขอสิทธิ์
                        </label>
                        <div class="col-md-9 col-sm-9 ">

                            <select id="usrpri" name="usrpri" class="form-control" style="width:100%;">
                            <option value="">เลือกผู้ขอสิทธิ์</option>
                                <?php
                                $upri = "SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMUser]";
                                $uq = sqlsrv_query($conn, $upri);
                                while ($qur = sqlsrv_fetch_array($uq, SQLSRV_FETCH_ASSOC)) { ?>
                                    <option value="<?php echo $qur['XVUsrCode'];?>"><?php echo $qur['XVUsrCode'];?></option>
                                <?php  }    ?>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">สิทธิ์การใช้งาน
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <select id="pri_user" multiple="multiple" class="form-control" style="width:100%;">
                                <option value="0" data="0">ทั้งหมด</option>
                                <option value="1" data="1" >อ่าน</option>
                                <option value="2" data="2" >เขียน</option>
                                <option value="3" data="3" >ลบ</option>
                                <option value="4" data="4">ควบคุม</option>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">เมนู
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <select id="menuid" name="menuid" class="form-control"> 
                                <option value="">เลือก</option>
                                <option value="AllMenu">ทุกเมนู</option>
                                <?php
                                $qmenu = " SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TSysSMenu]  ORDER BY XVMnuName DESC";
                                $qarm = sqlsrv_query($conn, $qmenu);
                                while ($rqm = sqlsrv_fetch_array($qarm, SQLSRV_FETCH_ASSOC)) { ?>
                                    <option value="<?php echo $rqm['XVMnuCode']; ?>"><?php echo $rqm['XVMnuName']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">ผู้สร้างทะเบียน
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" id="nameq" disabled name="datedep" value="<?php echo $_SESSION['XVUsrCode']; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">เวลาที่ลงทะเบียน
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" id="dateuser" disabled name="dateuser" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="item form-group" style=" text-align: center;">
                        <div class="col-md-12 col-sm-12 offset-md-6">
                            <button class="btn btn-primary" type="button">ยกเลิก</button>
                            <button class="btn btn-primary" type="reset">ตั้งค่าเดิม</button>
                            <a onclick="addpri();" class="btn btn-success" >เพิ่มสิทธิ์</a>
                        </div>
                    </div>
                </form>

            </div><!-- end modal-body -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog modal-md -->
</div><!-- end popupNew -->
<!-- end popup modal -->