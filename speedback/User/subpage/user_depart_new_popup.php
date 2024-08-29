<!-- new pouup modal -->

<div id="newDepartment" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">ตั้งค่าแผนก</h4>
            </div><!-- end modal-header -->
            <div class="modal-body">
                <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
               
                    <?php
                
                    function countdtp($id){
                        $i=1;
                        $arrsum=array();
                        require("../config/config.NWL_SpeedWayTest2.php");
                       $qf="SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMUser] WHERE XVDptCode='$id'";
                       $qi=sqlsrv_query($conn,$qf);
                       while($udp=sqlsrv_fetch_array($qi , SQLSRV_FETCH_ASSOC)){
                        $arrsum[]=$i;
                       // print_r($i);
                        $i++;
                       }   return $arrsum;
                    } ?>
                    <div class="item form-group">
                         <div class="col-md-12 col-sm-12 ">
                         <select class="select2_multiple form-control" id="dptcode" name="dptcode"  multiple="multiple" style="height:20%;">
                           <?php $shift="SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMDepartment]"; 
                           $shiftq=sqlsrv_query($conn,$shift);
                           while($rowsh=sqlsrv_fetch_array($shiftq,SQLSRV_FETCH_ASSOC)){
                              //  echo $rowsh['XVDptCode'] ;
                            if(empty(countdtp($rowsh['XVDptCode']))){ $countd= '(0)'; // Function นับจำนวนที่ผู้ใช้งานอยู่ใน Department กี่คน
                            }else{ $countd= '('.max(countdtp($rowsh['XVDptCode'])).')'; }
                            ?>
                             <option value="<?php echo $rowsh['XVDptCode']; ?>" r="<?php echo $rowsh['XVDptName']; ?>" ><?php echo $rowsh['XVDptName'];print_r($countd); ?></option>
                          <?php } ?>
                        </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">ชื่อแผนก
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" id="XVDptName"  name="XVDptName" value="" class="form-control">
                        </div>

                    </div>
                    <div class="item form-group" style="text-align: right;">
                        <input id="XVDptcodechk" hidden >
                        
                    <button type="button" id="adddpt" disabled name="adddpt" class="btn btn-active-color-white"><i class="fa fa-plus"></i>&nbsp;เพิ่ม</button>
                    <button type="button" id="deldpt"  disabled name="deldpt" class="btn btn-active-color-white"><i class="fa fa-minus"></i>&nbsp;ลบ</button>
                 
                    </div>

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">ผู้สร้างทะเบียน
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" id="last-name" disabled name="last-name" value="<?php echo $_SESSION['XVUsrCode']; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">เวลาที่ลงทะเบียน
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" id="datedep" disabled name="datedep" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control">
                        </div>
                    </div>
                  
                </form>

            </div><!-- end modal-body -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog modal-md -->
</div><!-- end popupNew -->
<!-- end popup modal -->