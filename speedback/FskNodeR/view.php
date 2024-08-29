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

                <div class="row g-5 g-xl-10 mb-xl-10">

                    <div class="card pt-3">
                        <div class="text-center">
                            <h3>ตารางแสดงสถานะโคมไฟ</h3>
                        </div>
                        
                       
                        <span class="label label-default" id="LabelSearch">ค้นหา</span>
                        <div class="row mb-1">
                            <div class="col-sm-6 mb-3 mb-sm-0 m-0">
                                <label class="m-0">โครงการ:</label>
                                <select id="Sel_PrjCode" class="form-control " required>
                                    <?php
                                    	include '../lib/DatabaseManage.php';  
                                        echo InPutSelect_Project();
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0 m-0">
                                <label class="m-0">Gate:</label>
                                <select id="SelGate" class="form-control " >
                                    
                                </select>
                            </div>

                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped" id="table">
                                <thead>
                                    <tr>

                                        <th class="p-1" style="color: black;font-size: 14px;font-weight: bold;">รหัสเครื่อง</th>
                                        <th class="p-1" style="color: black;font-size: 14px;font-weight: bold;">ชื่อเครื่อง</th>
                                        <th class="p-1" style="color: black;font-size: 14px;font-weight: bold;">ละติจูด</th>
                                        <th class="p-1" style="color: black;font-size: 14px;font-weight: bold;">ลองจิจูด</th>
                                        <th class="p-1" style="color: black;font-size: 14px;font-weight: bold;">สถานะ</th>
                                        
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
                <form id="FormFsk" class="user" method="POST" action="Controller.php">
                    <div class="form-group row m-1">
                        <div class="col-sm-12 mb-3 mb-sm-0 ">
                            <label class="m-0">รหัสFSKโหนด:</label>
                            <input type="text" class="<?php echo $Permis[1];?> form-control w-25" value="FSKYY-XXXXX"
                                placeholder="" id="TxtFskNodeCode" autocomplete="off" disabled>
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
                        <div class="col-sm-12 mb-3 mb-sm-0 m-0">
                            <label class="m-0">Fsk คอนโทรล:</label>
                            <select id="SelFskCode" class="<?php echo $Permis[1];?> form-control w-50" required>
                                <?php //echo InPutSelect_Fsk("");?>
                            </select>

                        </div>
                    </div>

                    <div class="form-group row m-1">
                        <div class="col-sm-12 mb-3 mb-sm-0 ">
                            <label class="m-0">ชื่อFSKโหนด:</label>
                            <input type="text" class="<?php echo $Permis[1];?> form-control w-50" placeholder=""
                                id="TxtFskNodeName" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row m-1">
                        <div class="col-sm-12 mb-3 mb-sm-0 m-0">
                            <label class="m-0">SN:</label>
                            <input type="text" class="<?php echo $Permis[1];?> form-control w-25" placeholder=""
                                id="TxtFskNodeSN" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row m-1">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <label class="m-0">สถานะ:</label>
                            <select class="<?php echo $Permis[1];?> form-control input-sm w-25" id="SelIsActive">
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