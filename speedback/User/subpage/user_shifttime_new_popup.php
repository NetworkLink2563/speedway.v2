<!-- new pouup modal -->
<div id="newshifttime" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">ตั้งค่ากะการทำงาน</h4>
            </div><!-- end modal-header -->
            <div class="modal-body">
                <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                
                        <?php
                    function countshift($id){
                        $i=1;
                        $arrsum=array();
                        require("../config/config.NWL_SpeedWayTest2.php");
                       $qf="SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMUser] WHERE XVShfCode='$id'";
                       //echo $qf;
                       $qi=sqlsrv_query($conn,$qf);
                       while($udp=sqlsrv_fetch_array($qi , SQLSRV_FETCH_ASSOC)){
                        $arrsum[]=$i;
                        $i++;
                       }   return $arrsum;
                    } ?>
                    <div class="item form-group">
                         <div class="col-md-12 col-sm-12 ">
                         <select class="select2_multiple form-control" id="codeshiftlist" name="codeshiftlist"  multiple="multiple" style="height:20%;">
                           <?php 
                           $shift="SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMShift]"; 
                           $shiftq=sqlsrv_query($conn,$shift);
                           while($rowsh=sqlsrv_fetch_array($shiftq,SQLSRV_FETCH_ASSOC)){

                            if(empty(countshift($rowsh['XVShfCode']))){ $countd= '(0)'; // Function นับจำนวนที่ผู้ใช้งานอยู่ใน shifttime กี่คน
                            }else{ $countd= '('.max(countshift($rowsh['XVShfCode'])).')'; }

                            $timeshf='[&nbsp;'.str_pad($rowsh['XIShfStartHour'],2,"0",STR_PAD_LEFT).':'
                            .str_pad($rowsh['XIShfStartMin'],2,"0",STR_PAD_LEFT).'&nbsp;|&nbsp;'
                            .str_pad($rowsh['XIShfEndHour'],2,"0",STR_PAD_LEFT).':'
                            .Str_pad($rowsh['XIShfEndMin'],2,"0",STR_PAD_LEFT).'&nbsp;]'; ?>
                             <option value="<?php echo $rowsh['XVShfCode']; ?>" ><?php echo  $rowsh['XVShfName'].'&nbsp;'.$timeshf; print_r($countd);?></option>
                          <?php } ?>
                        </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">ชื่อกะทำงาน
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" id="XVshiftname"  name="XVshiftname" value="" class="form-control">
                        </div>

                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">ชั่วโมงทำงาน [เริ่ม]
                        </label>
                        <div class="col-md-4 col-sm-4 ">
                            <input type="time" id="timestart"  name="timestart" value="" class="form-control">
                        </div>
                        <label class="col-form-label col-md-1 col-sm-1 label-align" for="last-name">[จบ]
                        </label>
                        <div class="col-md-4 col-sm-4 ">
                            <input type="time" id="timeend"  name="timeend" value="" class="form-control">
                        </div>
                    </div>
                    <div class="item form-group" style="text-align: right;">
                        <input id="codeshift" hidden >
                        
                    <button type="button" id="addshift" disabled name="addshift" class="btn btn-secondary"><i class="fa fa-plus"></i>&nbsp;เพิ่ม</button>
                    <button type="button" id="delshift"  disabled name="delshift" class="btn btn-secondary"><i class="fa fa-minus"></i>&nbsp;ลบ</button>
                 
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
                  
                </form>

            </div><!-- end modal-body -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog modal-md -->
</div><!-- end popupNew -->
<!-- end popup modal -->