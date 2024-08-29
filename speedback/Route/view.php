<style>
.bg-success {
    --bs-bg-rgb-color: var(--bs-success-rgb);
    background-color: #f6f2f0 !important;
}
</style>
<!--begin::Main-->
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
                <!--begin::Row-->
                <div class="row g-5 g-xl-10 g-xl-10">

                    <div class="card pt-3">
                        <div class="text-center">
                            <h3>เเส้นทาง </h3>
                        </div>
                        <div>
                        <?php
                            if( $_SESSION["CstCode"]=="CUS22-00001"){ 
                        ?>
                            <button style="position: absolute; top: 5%; z-index: 10;" type="button" id="BtnAdd" class="btn btn-dark ms-4 py-1 fs-8"> <i class=""
                                    <?php echo $Permis[1];?>></i>
                                เพิ่มเส้นทาง</button>
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
                            <div class="table-responsive pt-1">
                                <table class="table table-striped" id="table">
                                    <thead>
                                        <tr>

                                            <th class="p-1" style="color: black;font-size: 14px;font-weight: bold;">รหัสเส้น</th>
                                            <th class="p-1" style="color: black;font-size: 14px;font-weight: bold;">ชื่อเส้นทาง</th>
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
                                    <form id="Form" class="user" method="POST" action="Controller.php">
                                        <div class="form-group row m-1">
                                            <div class="col-sm-12 mb-3 mb-sm-0 ">
                                                <label class="m-0">รหัสเส้นทาง:</label>
                                                <input type="text" class=" form-control w-25" value="ROUYY-XXXXX"
                                                    placeholder="" id="TxtRouteCode" autocomplete="off" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row m-1">
                                            <div class="col-sm-12 mb-3 mb-sm-0 m-0">
                                                <label class="m-0">ป้ายVms:</label>
                                                <select id="SelVmsCode" class=" form-control w-50" required>
                                                    <?php //echo InPutSelect_Vms("");?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row m-1">
                                            <div class="col-sm-12 mb-3 mb-sm-0 m-0">
                                                <label class="m-0">จุดติดตั้ง:</label>
                                                <select id="SelSupCode" class=" form-control w-50" required>
                                                    <?php //echo InPutSelect_SetupPoint("");?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row m-1">
                                            <div class="col-sm-6 mb-3 mb-sm-0 ">
                                                <label class="m-0">ชื่อเส้นทาง:</label>
                                                <input type="text" class=" form-control w-75" placeholder=""
                                                    id="TxtName" autocomplete="off" required>
                                            </div>
                                            <div class="col-sm-6 mb-3 mb-sm-0 ">
                                                <label class="m-0">หมายเลขถนน:</label>
                                                <input type="text" class=" form-control w-50" placeholder=""
                                                    id="TxtRoadnumber" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="form-group row m-1">
                                            <div class="col-sm-6 mb-6 mb-sm-0 ">
                                                <label class="m-0">ละติจุดเริ่มต้น:</label>
                                                <input type="text" class=" form-control w-50" id="TxtLa"
                                                    autocomplete="off" required>
                                            </div>
                                            <div class="col-sm-6 mb-6 mb-sm-0 ">
                                                <label class="m-0">ลองติจุดเริ่มต้น:</label>
                                                <input type="text" class=" form-control w-50" id="TxtLong"
                                                    autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="form-group row m-1">
                                            <div class="col-sm-6 mb-6 mb-sm-0 ">
                                                <label class="m-0">ละติจุดสิ้นสุด:</label>
                                                <input type="text" class=" form-control w-50" id="TxtLaend"
                                                    autocomplete="off" required>
                                            </div>
                                            <div class="col-sm-6 mb-6 mb-sm-0 ">
                                                <label class="m-0">ลองติจุดสิ้นสุด:</label>
                                                <input type="text" class=" form-control w-50" id="TxtLongend"
                                                    autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="form-group row m-1">
                                            <div class="col-sm-12 mb-3 mb-sm-0">
                                                <label class="m-0">สถานะ:</label>
                                                <select class=" form-control input-sm w-25" id="SelIsActive">
                                                    <option value="1">ใช้งาน</option>
                                                    <option value="0">ยกเลิก</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row m-1 pt-3">
                                            <div class="col-sm-12 mb-3 mb-sm-0 text-center">
                                                <input type="hidden" id="txtmode">
                                                <button class=" btn btn-success " type="submit"
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

                    <!-- The Modal -->
                    <div class="modal fade" id="myModalPoint">
                        <div class="modal-dialog  modal-lg card shadow">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h5 id="HeaderTitleH" class="modal-title">เพิ่มถนนบนแผนที่</h5>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body card shadow">
                                    <form id="FormPoint" class="user" method="POST" action="Controller.php">
                                        <div class="form-group row m-1">
                                            <div class="col-sm-12 mb-3 mb-sm-0 ">
                                                <label class="m-0">รหัสเส้นทาง:</label>
                                                <input type="text" class=" form-control " placeholder=""
                                                    id="TxtRouteCodeDt" autocomplete="off" disabled required>
                                            </div>
                                        </div>
                                        <div class="form-group row m-1">
                                            <div class="col-sm-12 mb-3 mb-sm-0 ">
                                                <label class="m-0">ชื่อจุด (X,Y):</label>
                                                <input type="text" class=" form-control " placeholder=""
                                                    id="TxtPointName" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="form-group row m-1">
                                            <div class="col-sm-6 mb-6 mb-sm-0 ">
                                                <label class="m-0">จุด X:</label>
                                                <input type="number" step="0.1" class=" form-control " placeholder=""
                                                    id="NumLa" autocomplete="off" required>
                                            </div>
                                            <div class="col-sm-6 mb-6 mb-sm-0 ">
                                                <label class="m-0">จุด Y:</label>
                                                <input type="number" step="0.1" class=" form-control " placeholder=""
                                                    id="NumLo" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="form-group row m-1">
                                            <div class="col-sm-12 mb-3 mb-sm-0 text-center">
                                                <input type="hidden" id="txtmodepoint">
                                                <button class=" btn btn-success badge badge-pill" type="submit"
                                                    id="BtnSavePoint" name="BtnSavePoint">บันทึก</button>
                                            </div>
                                        </div>
                                    </form>
                                    <hr style="border-top: 1px solid gray;">
                                    <div class="table-responsive">
                                        <table style="width:100%" class="table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="p-1">ไอดี</th>
                                                    <th class="p-1">ลำดับที่</th>
                                                    <th class="p-1 text-center">จุด X</th>
                                                    <th class="p-1 text-center">จุด Y</th>
                                                    <th class="p-1 text-center">สี</th>
                                                    <th class="p-1"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="TableBodyPointDT">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger badge badge-pill"
                                        data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- The Modal -->
                    <div class="modal fade" id="myModalSetMonitor">
                        <div class="modal-dialog  modal-lg card shadow">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h5 id="HeaderTitleH" class="modal-title">
                                        ตั้งค่าตำแหน่งในการแสดงชื่อถนนและหมายเลขถนน</h5>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body card shadow">
                                    <form id="FormXY" class="user" method="POST" action="Controller.php">
                                        <input type="hidden" id="TxtRoutCode">
                                        <div class="row mb-1">
                                            <div class="col-sm-3 mb-3 mb-sm-0 m-0">
                                                <label class="m-0"></label>
                                            </div>
                                            <div class="col-sm-2 mb-3 mb-sm-0 m-0">
                                                <label class="m-0">ปรับค่า X:</label>
                                            </div>
                                            <div class="col-sm-2 mb-3 mb-sm-0 m-0">
                                                <label class="m-0">ปรับค่า Y:</label>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-sm-3 mb-3 mb-sm-0 m-0">
                                                <label class="m-0">ชื่อถนน:</label>
                                            </div>
                                            <div class="col-sm-2 mb-3 mb-sm-0 m-0">
                                                <input type="Number" id="NumRouteNameAdjX" class="form-control"
                                                    value="0">
                                            </div>
                                            <div class="col-sm-2 mb-3 mb-sm-0 m-0">
                                                <input type="Number" id="NumRouteNameAdjY" class="form-control"
                                                    value="0">
                                            </div>
                                        </div>
                                        <hr style="border: 0.5px solid gray;">
                                        <div class="row mb-1">
                                            <div class="col-sm-3 mb-3 mb-sm-0 m-0">
                                                <label class="m-0"></label>
                                            </div>
                                            <div class="col-sm-2 mb-3 mb-sm-0 m-0">
                                                <label class="m-0">เริ่ม X:</label>
                                            </div>
                                            <div class="col-sm-2 mb-3 mb-sm-0 m-0">
                                                <label class="m-0">เริ่ม Y:</label>
                                            </div>
                                            <div class="col-sm-2 mb-3 mb-sm-0 m-0">
                                                <label class="m-0">สิ้นสุด X:</label>
                                            </div>
                                            <div class="col-sm-2 mb-3 mb-sm-0 m-0">
                                                <label class="m-0">สิ้นสุด Y:</label>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-sm-3 mb-3 mb-sm-0 m-0">
                                                <label class="m-0">หมายเลขถนน:</label>
                                            </div>
                                            <div class="col-sm-2 mb-3 mb-sm-0 m-0">
                                                <input type="Number" id="NumRoadNumberStartX" class="form-control"
                                                    value="0">
                                            </div>
                                            <div class="col-sm-2 mb-3 mb-sm-0 m-0">
                                                <input type="Number" id="NumRoadNumberStartY" class="form-control"
                                                    value="0">
                                            </div>
                                            <div class="col-sm-2 mb-3 mb-sm-0 m-0">
                                                <input type="Number" id="NumRoadNumberEndX" class="form-control"
                                                    value="0">
                                            </div>
                                            <div class="col-sm-2 mb-3 mb-sm-0 m-0">
                                                <input type="Number" id="NumRoadNumberEndY" class="form-control"
                                                    value="0">
                                            </div>
                                        </div>
                                        <div class="form-group row m-1">
                                            <div class="col-sm-12 mb-3 mb-sm-0 text-center">
                                                <input type="hidden" id="txtmodepoint">
                                                <button class=" btn btn-success badge badge-pill" type="submit"
                                                    id="BtnSaveXY" name="BtnSaveXY">บันทึก</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger badge badge-pill"
                                        data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->

</div>
<!--end:::Main-->

</div>
<script src="view.js"></script>