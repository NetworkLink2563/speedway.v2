<style>
.bg-success {
    --bs-bg-rgb-color: var(--bs-success-rgb);
    background-color: #f6f2f0 !important;
}
</style>
<!--begin::Main-->
<?php 


echo $Permis[2];?>
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar pt-6 pb-2">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                <!--begin::Toolbar wrapper-->
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                       
                    </div>
                    <!--end::Page title-->
                    <!--begin::Actions-->
                    <div class="d-flex align-items-center gap-2 gap-lg-3">

                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Toolbar wrapper-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
       
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">

                <div class="row g-5 g-xl-10 mb-xl-10">

                    <div class="card pt-3">
                    <div class="text-center">
                           <h3>ป้ายVms</h3>
                        </div>
                        <div>
                        <?php
                            if( $_SESSION["CstCode"]=="CUS22-00001"){ 
                        ?>
                          <button style="position: absolute; top: 5%; z-index: 10;" type="button" id="BtnAdd" class="btn btn-dark ms-4 py-1 fs-8"> <i
                                    class="" <?php echo $Permis[1];?>></i>
                                เพิ่มป้ายVms</button>
                        <?php
                            }
                        ?>
                         </div>
                         <br>
                         <br>
                         <span class="label label-default" id="LabelSearch">ค้นหา</span>
                        <div class="row mb-1">
                            <div class="col-sm-12 mb-3 mb-sm-0 m-0">
                                <label class="m-0">โครงการ:</label>
                                <select id="Sel_PrjCode" class="form-control " required>
                                    <?php
                                    	include '../lib/DatabaseManage.php';  
                                        echo InPutSelect_Project();
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="table-responsive pt-1">
                            <table class="table table-striped" id="table">
                                <thead>
                                    <tr>
                                        <th class="p-1" style="color: black;font-size: 14px;font-weight: bold;">รหัสป้าย</th>
                                        <th class="p-1" style="color: black;font-size: 14px;font-weight: bold;">ชื่อป้าย</th>
                                        <th class="p-1" style="color: black;font-size: 14px;font-weight: bold;">จุดติดตั้ง</th>
                                        <th class="p-1" style="color: black;font-size: 14px;font-weight: bold;">สถานะ</th>
                                        <th class="p-1"></th>
                                        <th class="p-1"></th>

                                    </tr>
                                </thead>
                                <tbody id="TableBody">
                                    <?php //echo ShowBodyTable("");?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--end::Body-->

                </div>

            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->

</div>
<!--end:::Main-->

</div>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog  modal-lg card shadow">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 id="HeaderTitle" class="modal-title">
                    </h4>
                    <!--
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
-->
            </div>

            <!-- Modal body -->
            <div class="modal-body card shadow">
                <form id="FormVms" class="user" method="POST" action="Controller.php">
                    <div class="form-group row m-1">
                        <div class="col-sm-12 mb-3 mb-sm-0 ">
                            <label class="m-0">รหัสป้าย VMS:</label>
                            <input type="text" class="<?php echo $Permis[1];?> form-control w-25" value="VMSYY-XXXXX"
                                placeholder="" id="TxtVmsCode" autocomplete="off" disabled>
                        </div>
                    </div>
                    <div class="form-group row m-1">
                        <div class="col-sm-12 mb-3 mb-sm-0 m-0">
                            <label class="m-0">จุดติดตั้ง:</label>
                            <select id="SelSupCode" class="<?php echo $Permis[1];?> form-control w-50" required>
                                <?php //echo InPutSelect_SetupPoint("");?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row m-1">
                        <div class="col-sm-12 mb-3 mb-sm-0 ">
                            <label class="m-0">ชื่อป้าย:</label>
                            <input type="text" class="<?php echo $Permis[1];?> form-control w-75" placeholder=""
                                id="TxtVmsName" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row m-1">
                        <div class="col-sm-12 mb-3 mb-sm-0 m-0">
                            <label class="m-0">SN:</label>
                            <input type="text" class="<?php echo $Permis[1];?> form-control w-25" placeholder=""
                                id="TxtVmsSN" autocomplete="off" >
                        </div>
                    </div>

                    <div class="form-group row m-1" hidden>
                        <div class="col-sm-12 mb-3 mb-sm-0 m-0">
                            <label class="m-0">URL:</label>
                            <input type="text" class="<?php echo $Permis[1];?> form-control " placeholder=""
                                id="TxtVmsURL" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row m-1">
                        <div class="col-sm-6 mb-3 mb-sm-0 m-0">
                            <label class="m-0">PixelWidth:</label>
                            <input type="number" class="<?php echo $Permis[1];?> form-control " placeholder=""
                                id="NumVmsPixelWidth" autocomplete="off" >
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0 m-0">
                            <label class="m-0">PixelHeight:</label>
                            <input type="number" class="<?php echo $Permis[1];?> form-control " placeholder=""
                                id="NumVmsPixelHeight" autocomplete="off" >
                        </div>
                    </div>
                    <div class="form-group row m-1">
                        <div class="col-sm-6 mb-3 mb-sm-0 m-0">
                            <label class="m-0">SizeWidth:</label>
                            <input type="number" class="<?php echo $Permis[1];?> form-control " step="0.1"
                                placeholder="" id="NumVmsSizeWidth" autocomplete="off" >
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0 m-0">
                            <label class="m-0">SizeHeight:</label>
                            <input type="number" class="<?php echo $Permis[1];?> form-control " step="0.1"
                                placeholder="" id="NumVmsSizeHeight" autocomplete="off" >
                        </div>
                    </div>
                    <div class="form-group row m-1">
                        <div class="col-sm-12 mb-3 mb-sm-0 m-0">
                            <label class="m-0">Size:</label>
                            <input type="text" class="<?php echo $Permis[1];?> form-control w-50" placeholder=""
                                id="TxtVmsSize" autocomplete="off" >
                        </div>
                    </div>
                    <div class="form-group row m-1">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <label class="m-0">Google Map:</label>
                            <select class="<?php echo $Permis[1];?> form-control input-sm w-50"
                                id="SelIsActiveGoogleMap">
                                <option value="1">ใช้</option>
                                <option value="0">ไม่ใช้</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row m-1">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <label class="m-0">วัดสภาพอากาศ:</label>
                            <select class="<?php echo $Permis[1];?> form-control input-sm w-50"
                                id="SelIsActiveWeatherSensor">
                                <option value="1">ใช้</option>
                                <option value="0">ไม่ใช้</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row m-1 pt-3">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <label class="m-0">ประเภทป้าย:</label>
                            <select class="<?php echo $Permis[1];?> form-control input-sm w-50" id="SelType">
                                <option value="">...</option>
                                <option value="1">ป้าย VMS</option>
                                <option value="2">ป้าย LMS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row m-1 pt-3">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <label class="m-0">สถานะ:</label>
                            <select class="<?php echo $Permis[1];?> form-control input-sm w-50" id="SelIsActive">
                                <option value="1">ใช้งาน</option>
                                <option value="0">ยกเลิก</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row m-1">
                        <div class="col-sm-12 mb-3 mb-sm-0 text-center">
                            <input type="hidden" id="txtmode">
                            <button class="<?php echo $Permis[1];?> btn btn-success" type="submit"
                                id="BtnSave" name="BtnSave">บันทึก</button>
                        </div>
                    </div>

                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>



<script src="view.js"></script>